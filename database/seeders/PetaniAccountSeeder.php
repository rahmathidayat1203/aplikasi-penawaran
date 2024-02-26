<?php

namespace Database\Seeders;

use App\Models\Petani; // Asumsi nama model yang benar adalah `Petani`
use App\Models\Petanis;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Gunakan Hash facade untuk hashing password
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PetaniAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listPetani = [
            [
                'name' => 'petani1',
                'no_hp' => '08765644324',
                'email' => 'petani1@mail.com',
            ],
            [
                'name' => 'petani2',
                'no_hp' => '08765644325',
                'email' => 'petani2@mail.com',
            ]
        ];

        foreach ($listPetani as $petaniData) {
            $petani = Petanis::create([
                'name' => $petaniData["name"],
                'no_hp' => $petaniData['no_hp'],
                'email' => $petaniData['email']
            ]);

            $user = User::create([
                'name' => $petani->name,
                'email' => $petani->email,
                'password' => Hash::make('12341234'), // Hashing password
            ]);

            // Mengecek dan/atau membuat role 'petani'
            $role = Role::firstOrCreate(['name' => 'petani']);

            // Mendapatkan ID dari permission yang diinginkan
            $permissions = Permission::whereIn('name', ['approve-penawaran', 'cancel-penawaran'])->pluck('id');
            $role->syncPermissions($permissions);

            $user->assignRole($role);
        }
    }
}
