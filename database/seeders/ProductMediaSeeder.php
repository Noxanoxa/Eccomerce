<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\ProductMedia;

class ProductMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::limit(100)->get();
        $files = File::files(public_path('assets/products'));
        $fileCount = count($files);

        foreach ($products as $index => $product) {
            $file = $files[$index % $fileCount];
            ProductMedia::create([
                'product_id' => $product->id,
                'file_name' => $file->getFilename(),
                'real_file_name' => $file->getFilename(),
                'file_type' => $file->getExtension(),
                'file_size' => $file->getSize(),
            ]);
        }
    }
}
