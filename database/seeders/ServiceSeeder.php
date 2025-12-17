<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Category;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // IDs depend on CategorySeeder running first.
        // Assuming IDs 1-5 regarding the order in CategorySeeder.

        $services = [
            [
                'category_id' => 1, // Service Rutin
                'name' => 'Ganti Oli Mesin Mobil',
                'price' => 50000,
                'description' => 'Jasa ganti oli mesin (belum termasuk harga oli).'
            ],
            [
                'category_id' => 1,
                'name' => 'Tune Up Mesin',
                'price' => 250000,
                'description' => 'Pembersihan ruang bakar, throttle body, dan pengecekan sensor.'
            ],
            [
                'category_id' => 3, // Kaki-kaki
                'name' => 'Service Rem 4 Roda',
                'price' => 200000,
                'description' => 'Pembersihan kampas rem, pelumasan kaliper, dan penyetelan.'
            ],
            [
                'category_id' => 4, // Kelistrikan
                'name' => 'Ganti Aki & Pengecekan',
                'price' => 35000,
                'description' => 'Jasa pasang aki baru dan pengecekan alternator.'
            ],
            [
                'category_id' => 1,
                'name' => 'Service Ringan Motor',
                'price' => 75000,
                'description' => 'Service rutin untuk sepeda motor (karbu/injeksi).'
            ],
            [
                'category_id' => 5, // Body
                'name' => 'Poles Body Full',
                'price' => 400000,
                'description' => 'Poles body kendaraan agar mengkilap kembali.'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
