<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SparePart;
use App\Models\Category;

class SparePartSeeder extends Seeder
{
    public function run(): void
    {
        $spareParts = [
            [
                'category_id' => 1,
                'name' => 'Oli Shell Helix HX6 10W-40',
                'stock' => 24,
                'price' => 85000,
                'description' => 'Oli mesin sintetik untuk mobil bensin.'
            ],
            [
                'category_id' => 1,
                'name' => 'Oli Yamalube Sport 1L',
                'stock' => 50,
                'price' => 65000,
                'description' => 'Oli motor sport Yamaha.'
            ],
            [
                'category_id' => 2, // Mesin
                'name' => 'Busi NGK Iridium',
                'stock' => 20,
                'price' => 95000,
                'description' => 'Busi performa tinggi untuk pembakaran sempurna.'
            ],
            [
                'category_id' => 3, // Kaki-kaki
                'name' => 'Kampas Rem Depan Avanza',
                'stock' => 10,
                'price' => 250000,
                'description' => 'Kampas rem original Toyota Avanza.'
            ],
            [
                'category_id' => 4, // Kelistrikan
                'name' => 'Aki GS Astra Hybrid 60Ah',
                'stock' => 5,
                'price' => 850000,
                'description' => 'Aki basah hybrid, minim perawatan.'
            ],
            [
                'category_id' => 1,
                'name' => 'Filter Oli Avanza/Xenia',
                'stock' => 30,
                'price' => 35000,
                'description' => 'Filter oli original.'
            ]
        ];

        foreach ($spareParts as $part) {
            SparePart::create($part);
        }
    }
}
