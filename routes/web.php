<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
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


Route::middleware(['auth'])->group(function(){
    Route::get('dashboard' , function(){
        return '<h1>user.dashboard</h1>';
    });
});

Route::prefix('admin')->middleware(['auth', 'authadmin'])->group(function(){
    Route::get('dashboard' , [AdminDashboard::class , 'index'])->name('admindashboard');
    Route::get('products' , [ProductController::class , 'index'])->name('products');
    Route::post('products/add' , [ProductController::class , 'addProduct'])->name('addproducts');
    Route::post('product/details' , [ProductController::class , 'Productdetails'])->name('productdetails');
    Route::post('product/edit' , [ProductController::class , 'Productedit'])->name('productedit');
    Route::delete('product/delete/' , [ProductController::class , 'Productdel'])->name('productdel');



});

