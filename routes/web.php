<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/shop', function () {
    return view('pages.shop');
})->name("shop");
Route::get('/contact', function () {
    return view('pages.contact');
})->name("contact");
Route::get('/blog', function () {
    return view('pages.blog');
})->name("blog");



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return '<h1>user.dashboard</h1>';
    });
});

Route::prefix('admin')->middleware(['auth', 'authadmin'])->group(function () {

    Route::get('dashboard', [AdminDashboard::class, 'index'])->name('admindashboard');

    //main settings
    Route::get('mainsettings', [SettingsController::class, 'index'])->name('mainsettings');
    Route::post('mainsettings/edit', [SettingsController::class, 'mainSettingsedit'])->name('mainsettings.edit');
    
    //categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('category/add', [CategoryController::class, 'addCategory'])->name('catg.add');
    Route::post('category/edit', [CategoryController::class, 'editCategory'])->name('catg.edit');
    Route::delete('category/delete/', [CategoryController::class, 'delCategory'])->name('catg.del');
    
    //products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('products/add', [ProductController::class, 'addProduct'])->name('addproducts');
    Route::post('product/edit', [ProductController::class, 'Productedit'])->name('productedit');
    Route::delete('product/delete/', [ProductController::class, 'Productdel'])->name('productdel');

});
