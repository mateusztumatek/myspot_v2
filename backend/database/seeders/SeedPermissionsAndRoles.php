<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedPermissionsAndRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesPermissions = [
            'admin' => [
                'create_user',
                'edit_user',
                'delete_user',
                'view_user',
                'manage_roles',
                'manage_permissions',
                'create_event',
                'edit_event',
                'delete_event',
                'view_event',
            ],
            'creator' => [
                'create_event',
                'edit_event',
                'delete_event',
                'view_event',
            ],
            'viewer' => [
                'view_event',
            ],
        ];

        // First create all permissions
        foreach ($rolesPermissions as $role => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        // Then create roles and assign permissions
        foreach ($rolesPermissions as $role => $permissions) {
            $roleModel = Role::firstOrCreate(['name' => $role]);
            $roleModel->syncPermissions($permissions);
        }
    }
}
