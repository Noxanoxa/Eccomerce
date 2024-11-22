<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Fashion', 'status' => 1]);
        Category::create(['name' => 'Electronic', 'status' => 1]);
        // Health & Beauty
        Category::create(['name' => 'Health & Beauty', 'status' => 1]);
        // Books
        Category::create(['name' => 'Books', 'status' => 1]);
    }
}
