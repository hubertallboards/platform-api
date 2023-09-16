<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['id' => Str::uuid()->toString(), 'name' => 'view products',  'guard_name' => 'web',]);
        Permission::create(['id' => Str::uuid()->toString(), 'name' => 'edit products',  'guard_name' => 'web',]);
        Permission::create(['id' => Str::uuid()->toString(), 'name' => 'view orders',  'guard_name' => 'web',]);
        Permission::create(['id' => Str::uuid()->toString(), 'name' => 'edit orders',  'guard_name' => 'web',]);
        Permission::create(['id' => Str::uuid()->toString(), 'name' => 'view users',  'guard_name' => 'web',]);
        Permission::create(['id' => Str::uuid()->toString(), 'name' => 'edit users',  'guard_name' => 'web',]);

        $adminRole = Role::create(['id' => Str::uuid()->toString(), 'name' => 'admin', 'guard_name' => 'web',]);
        $employeeRole = Role::create(['id' => Str::uuid()->toString(), 'name' => 'employee', 'guard_name' => 'web',]);
        $clientRole = Role::create(['id' => Str::uuid()->toString(), 'name' => 'client', 'guard_name' => 'web',]);

        $adminRole->givePermissionTo(Permission::all());
        $employeeRole->syncPermissions(['view products', 'edit products', 'view orders', 'edit orders', 'view users']);
        $clientRole->givePermissionTo('view products');

        $admin = User::find('32c9ce94-018a-4b30-9347-a4768dcc9068');
        $admin->assignRole('admin');

        $employee = User::find('4531289f-7fba-4ce9-90f2-79d9f1e7cff2');
        $employee->assignRole('employee');

        $client = User::find('7fc39a0a-86d5-4cda-b429-33757f5c1501');
        $client->assignRole('client');
    }
}
