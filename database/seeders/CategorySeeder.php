<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Service Rutin',
                'description' => 'Perawatan berkala kendaraan seperti ganti oli dan tune up.'
            ],
            [
                'name' => 'Mesin & Transmisi',
                'description' => 'Perbaikan berat pada mesin dan sistem transmisi.'
            ],
            [
                'name' => 'Kaki-kaki & Suspensi',
                'description' => 'Perbaikan shockbreaker, rem, ban, dan kemudi.'
            ],
            [
                'name' => 'Kelisrikan',
                'description' => 'Perbaikan sistem kelistrikan, aki, lampu, dan ecu.'
            ],
            [
                'name' => 'Body & Aksesoris',
                'description' => 'Perbaikan body kendaraan dan pemasangan aksesoris.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
