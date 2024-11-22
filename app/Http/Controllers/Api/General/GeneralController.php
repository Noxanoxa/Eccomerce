<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;

class GeneralController extends Controller
{
    public function get_products()
    {
        $products = Product::whereRelation('category', 'status', 1)
            ->active()->orderBy('id', 'desc')->paginate(10);

        if($products->count() > 0){
            return ProductResource::collection($products);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No products found',
            ], 404);
        }

    }
    public function get_categories()
    {
        $categories = Category::active()->orderBy('id', 'desc')->get();

        if($categories->count() > 0){
            return CategoryResource::collection($categories);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No categories found',
            ], 404);
        }
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->active()->first();
        if ($category) {
            $products = Product::whereCategoryId($category->id)
                         ->active()
                         ->orderBy('id', 'desc')
                         ->get();

            if ($products->count() > 0) {
                return response()->json(
                    [
                        'products' => ProductResource::collection($products),
                        'error' => false,
                    ],
                    200
                );
            } else {
                return response()->json(
                    ['message' => 'No post found', 'error' => true],
                    201
                );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
            }
        }

        return response()->json(
            ['message' => 'Something was Wrong', 'error' => true],
            201
        );// 201 or 200 success for mobile app developer they have problem with status 400.* or 500.*
    }
    public function show_product($code){
        $product = Product::whereRelation('category', 'status', 1)
                          ->whereCode($code)->active()->first();
        if($product){
            return new ProductResource($product);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No product found',
            ], 404);
        }
    }
}
