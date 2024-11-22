<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $categories = Category::all()->modelKeys();
        $products = [];

        for ($i = 0; $i < 100; $i++) {
            $product_name = $faker->sentence(mt_rand(3, 6), true);

            $product = Product::create([
                'code' => $faker->unique()->randomNumber(8),
                'product_name' => $product_name,
                'category_id' => Arr::random($categories),
                'product_size' => $faker->randomElement(['S', 'M', 'L', 'XL']),
                'product_price' => $faker->randomFloat(2, 10, 1000),
                'product_brand' => $faker->company,
                'date' => $faker->date("Y-m-d"),
                'product_quantity' => $faker->numberBetween(1, 100),
                'product_description' => $faker->paragraph(mt_rand(3, 6), true),
                'status' => $faker->randomElement([0, 1]),
            ]);

            $products[] = $product->id;
        }

    }
}
