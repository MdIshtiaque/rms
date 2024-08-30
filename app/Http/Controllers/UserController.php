<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $users = User::query()
      ->when($request->input('search'), function ($query, $search) {
        $query->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      })
      ->paginate(10)
      ->appends($request->query());

    return Inertia::render('Backend/Users', [
      'users' => $users,
      'filters' => $request->only(['search']),
    ]);
  }


  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'role' => 'required|string|in:admin,user',
      'password' => 'required|string|min:8|confirmed',
      'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('profileImage')) {
      try {
        $folder = 'user-profileImages';
        if (!Storage::disk('public')->exists($folder)) {
          Storage::disk('public')->makeDirectory($folder);
        }
        $profileImagePath = $request->file('profileImage')->store($folder, 'public');
        $data['profileImage'] = $profileImagePath;
      } catch (\Exception $e) {
        // Log the error
        \Log::error('Failed to upload profile image: ' . $e->getMessage());
        // You might want to add an error message to the response
        return redirect()->back()->with('error', 'Failed to upload profile image. Please try again.');
      }
    }

    User::create($data);
    return redirect()->route('users')->with('success', 'User created successfully');
  }


  public function update(Request $request, User $user)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'role' => 'required|string|in:admin,user',
      'password' => 'nullable|string|min:8|confirmed',
      'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('profileImage')) {
      try {
        $folder = 'user-profileImages';
        if (!Storage::disk('public')->exists($folder)) {
          Storage::disk('public')->makeDirectory($folder);
        }
        $profileImagePath = $request->file('profileImage')->store($folder, 'public');
        $data['profileImage'] = $profileImagePath;
      } catch (\Exception $e) {
        \Log::error('Failed to upload profile image: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to upload profile image. Please try again.');
      }
    }
    $user->update($data);

    return redirect()->route('users')->with('success', 'User updated successfully');
  }
}
