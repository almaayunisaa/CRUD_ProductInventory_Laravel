<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Royal Canin',
            'price' => 400
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Cat Hat',
            'price' => 1000
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Cat Choize',
            'price' => 100
        ]);
    }
}
