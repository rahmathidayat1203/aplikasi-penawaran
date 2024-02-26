<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use function PHPSTORM_META\map;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'product-list',
            'create-product',
            'edit-product',
            'delete-product',
            'list-petani',
            'create-petani',
            'edit-prtani',
            'delete-petani',
            'list-distributor',
            'create-distributor',
            'edit-distributor',
            'delete-distributor',
            'list-penawaran',
            'create-penawaran',
            'edit-penawaran',
            'delete-penawaran',
            'approve-penawaran',
            'cancel-penawaran'
        ];

        foreach ($permissions as $v) {
            Permission::create([
                'name' => $v
            ]);
        }
    }
}
