<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $role = Role::findByName('admin');
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }
}
