<?php

namespace Database\Seeders;

use App\Enums\RoleEnums;
use App\Enums\Permissions\UserPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        foreach (UserPermission::cases() as $permission) {
            Permission::create(['name' => $permission->value]);
        }

        // Create roles and assign permissions
        $superAdminRole = Role::create(['name' => RoleEnums::SUPER_ADMIN->value]);
        $superAdminRole->givePermissionTo(Permission::all());

        $bachelorRole = Role::create(['name' => RoleEnums::BACHELOR->value]);
        $bachelorRole->givePermissionTo([
            UserPermission::VIEW_USERS,
            UserPermission::EDIT_USER,
        ]);

        Role::create(['name' => RoleEnums::ADMIN->value]);
        Role::create(['name' => RoleEnums::FLAT_OWNER->value]);
    }
}
