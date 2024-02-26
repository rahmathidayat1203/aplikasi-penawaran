<?php

namespace Database\Seeders;

use App\Models\Distributor; // Pastikan ini sesuai dengan nama model Anda
use App\Models\Distributors;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk hashing password
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DistributorAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listDistributor = [
            [
                'name' => 'Distributor',
                'no_hp' => '0811176564736',
                'email' => 'distributor@mail.com'
            ],
            [
                'name' => 'Distributor2',
                'no_hp' => '0811176564737',
                'email' => 'distributor2@mail.com'
            ],
        ];

        foreach ($listDistributor as $key => $value) {
            $distributor = Distributors::create([ // Pastikan ini sesuai dengan nama model Anda
                'name' => $value["name"],
                'no_hp' => $value["no_hp"],
                'email' => $value["email"]
            ]);
    
            $user = User::create([
                'name' => $distributor->name,
                'email' => $distributor->email,
                'password' => Hash::make('12341234'), // Gunakan Hash facade untuk hashing password
            ]);
    
            // Mengecek apakah role distributor sudah ada, jika tidak maka buat
            $role = Role::firstOrCreate(['name' => 'distributor']);
    
            // Mendapatkan permission yang diinginkan
            $permissionIds = Permission::whereIn('name', ['list-penawaran', 'create-penawaran', 'edit-penawaran'])->pluck('id');
            $role->syncPermissions($permissionIds);
            $user->assignRole($role);
        }
        

        // Tidak perlu menggunakan array untuk assignRole karena kita hanya memiliki satu role
    }
}
