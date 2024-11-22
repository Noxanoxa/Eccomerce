<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\Backend;
use App\Http\Controllers\Api\Backend\Auth;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(GeneralController::class)->group(function () {
    Route::get('/all_products', 'get_products');
    Route::get('/product/{code}', 'show_product');
    // categories
    Route::get('/all_categories', 'get_categories');

    Route::get('/search', 'search');
    Route::get('/category/{category_slug}', 'category')->name('category.show');

    Route::post('/contact-us', 'do_contact');
    Route::get('/contact-info', 'settings');
});

Route::group(['prefix' =>'admin', 'as' => 'admin'], function (){

Route::controller(Auth\LoginController::class)->group(function () {
    Route::get('/login',                                'showLoginForm')->name('show_login_form');
    Route::post('login',                                'login')->name('login');
    Route::post('logout',                               'logout')->name('logout');
});

Route::resource('products',  Backend\ProductController::class);
Route::resource('categories', Backend\CategoryController::class);


});


