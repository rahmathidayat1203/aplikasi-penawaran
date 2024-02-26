<?php

namespace Database\Seeders;

use App\Models\Images;
use App\Models\Offer_petanis;
use App\Models\Petanis; // Pastikan ini sesuai dengan nama model Petani Anda
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Apel',
                'description' => 'Apel merah segar dari kebun lokal.',
                'price' => '30.000',
                'image' => 'https://images.unsplash.com/photo-1619546813926-a78fa6372cd2?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Contoh placeholder, ganti dengan link gambar aktual Anda
            ],
            [
                'name' => 'Kentang',
                'description' => 'Kentang organik, cocok untuk aneka masakan.',
                'price' => '20.000',
                'image' => 'https://images.unsplash.com/photo-1552661397-4233881ea8c8?q=80&w=1330&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Contoh placeholder, ganti dengan link gambar aktual Anda
            ],
            [
                'name' => 'Wortel',
                'description' => 'Wortel segar penuh nutrisi, panen dari kebun lokal.',
                'price' => '15.000',
                'image' => 'https://images.unsplash.com/photo-1589927986089-35812388d1f4?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Contoh placeholder, ganti dengan link gambar aktual Anda
            ],
            [
                'name' => 'Tomat',
                'description' => 'Tomat merah, segar, dan juicy. Ideal untuk salad dan saus.',
                'price' => '10.000',
                'image' => 'https://images.unsplash.com/photo-1607305387299-a3d9611cd469?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Contoh placeholder, ganti dengan link gambar aktual Anda
            ],
            [
                'name' => 'Jagung',
                'description' => 'Jagung manis segar, siap dikirim dari petani langsung.',
                'price' => '5.000',
                'image' => 'https://images.unsplash.com/photo-1615485291262-eee9f6529056?q=80&w=1335&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Contoh placeholder, ganti dengan link gambar aktual Anda
            ]
        ];


        $petanis = Petanis::all();

        // Memeriksa apakah ada petani di database
        if ($petanis->isEmpty()) {
            echo "Tidak ada petani di database.\n";
            return;
        }

        foreach ($products as $product) {
            // Memilih petani secara acak dari koleksi
            $petani = $petanis->random();

           $offerpetanis = Offer_petanis::create([
                'id_petani' => $petani->id, // Menggunakan id petani yang dipilih secara acak
                'name_product' => $product[ 'name' ],
                'quantity' => 100, // Contoh jumlah, sesuaikan sesuai kebutuhan
                'price_start_sell' => $product[ 'price' ],
            ]);

            Images::create([
                'id_offering_petani' => $offerpetanis->id,
                'link_images' => $product["image"]
            ]);
        }
    }
}
