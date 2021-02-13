<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        // create permissions
       /* Permission::create(['name' => 'category_edit']);
        Permission::create(['name' => 'category_delete']);
        Permission::create(['name' => 'category_create']);
        Permission::create(['name' => 'category_view']);*/

        // create roles and assign existing permissions
       /* $role1 = Role::create(['name' => 'moderateur']);
        $role1->givePermissionTo('category_edit');
        $role1->givePermissionTo('category_view');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('category_edit');
        $role2->givePermissionTo('category_view');
        $role2->givePermissionTo('category_create');*/

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'root',
            'email' => 'root@gmail.com',
            'password' => Hash::make('open'),
        ]);
        $user->assignRole($role3);

       /* $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);*/
    }
}