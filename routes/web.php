<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubcategoryController;
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

    //sub categories
    Route::get('subcategories', [SubcategoryController::class, 'index'])->name('subcategories');
    Route::post('subcategory/add', [SubcategoryController::class, 'addCategory'])->name('subcatg.add');
    Route::post('subcategory/edit', [SubcategoryController::class, 'editCategory'])->name('subcatg.edit');
    Route::delete('subcategory/delete/', [SubcategoryController::class, 'delCategory'])->name('subcatg.del');

    //products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('products/add', [ProductController::class, 'addProduct'])->name('addproducts');
    Route::post('product/edit', [ProductController::class, 'Productedit'])->name('productedit');
    Route::delete('product/delete/', [ProductController::class, 'Productdel'])->name('productdel');

    //gallery
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery/add', [GalleryController::class, 'store'])->name('gallery.store');
    Route::post('gallery/update', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/delete', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::delete('gallery/deletemulti', [GalleryController::class, 'multidestroy'])->name('gallery.destroy.multi');

    //reviews
    Route::get('reviews', [ReviewsController::class, 'index'])->name('reviews.index');
    Route::delete('review/delete', [ReviewsController::class, 'destroy'])->name('review.destroy');

});
