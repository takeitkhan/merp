<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Create permissions
        $permissions = [
            'create post',
            'edit post',
            'delete post',
            'publish post'
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo(['create post']);


        $user = User::create([
            'name' => 'Samrat Khan',
            'email' => 'admin@system.com',
            'password' => Hash::make('password'),
        ]);

        // Assign the 'admin' role to Samrat Khan
        $user->assignRole('admin');
    }
}
