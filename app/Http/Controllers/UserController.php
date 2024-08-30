<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profileImage' => $user->profileImage,
                'role' => $user->roles->first()->name ?? 'No role',
            ]);

        $availableRoles = Role::pluck('name');

        return Inertia::render('Backend/Users', [
            'users' => $users,
            'filters' => $request->only('search'),
            'availableRoles' => $availableRoles,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|string|exists:roles,name',
            'password' => 'required|string|min:8|confirmed',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            \DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            $user->assignRole($data['role']);

            if ($request->hasFile('profileImage')) {
                $folder = 'user-profileImages';
                if (!Storage::disk('public')->exists($folder)) {
                    Storage::disk('public')->makeDirectory($folder);
                }
                $profileImagePath = $request->file('profileImage')->store($folder, 'public');
                $user->profileImage = $profileImagePath;
                $user->save();
            }

            \DB::commit();

            return redirect()->route('users')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Failed to create user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }
    }


    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
            'password' => 'nullable|string|min:8|confirmed',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            \DB::beginTransaction();

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if (!empty($data['password'])) {
                $user->update(['password' => bcrypt($data['password'])]);
            }

            $user->syncRoles([$data['role']]);

            if ($request->hasFile('profileImage')) {
                $folder = 'user-profileImages';
                if (!Storage::disk('public')->exists($folder)) {
                    Storage::disk('public')->makeDirectory($folder);
                }
                $profileImagePath = $request->file('profileImage')->store($folder, 'public');

                if ($user->profileImage) {
                    Storage::disk('public')->delete($user->profileImage);
                }

                $user->profileImage = $profileImagePath;
                $user->save();
            }

            \DB::commit();

            return redirect()->route('users')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Failed to update user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update user. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        try {
            // Delete the user's profile image if it exists
            if ($user->profileImage) {
                Storage::disk('public')->delete($user->profileImage);
            }

            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            \Log::error('Failed to delete user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete user'], 500);
        }
    }
}
