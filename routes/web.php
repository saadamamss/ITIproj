<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerOrders;
use App\Http\Controllers\ProductDetails;
use App\Http\Controllers\ShopController;
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

Route::get('/shop', [ShopController::class, 'index'])->name("shop");
Route::get('/cart', [CartController::class, 'index'])->name("cart");


Route::post('/cart/add', [CartController::class, 'addToCart'])->name("addtocart");
Route::post('/cart/del', [CartController::class, 'deleteItem'])->name("cart.delitem");
Route::post('/cart/destroy', [CartController::class, 'clearCart'])->name("cart.destroy");
Route::post('/cart/update', [CartController::class, 'updateCart'])->name("cart.update");
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name("applycoupon");


Route::get('/category/{slug}', [ShopController::class, 'shopByCategory'])->name("category.shop");

Route::get('products/search', [ShopController::class, 'search'])->name("product.search");
Route::get('product/{slug}', [ProductDetails::class, 'index'])->name("product.details");



Route::get('/contact', function () {
    return view('pages.contact');
})->name("contact");
Route::get('/blog', function () {
    return view('pages.blog');
})->name("blog");
Route::get('/about', function () {
    return view('pages.about');
})->name("about");




Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return '<h1>user.dashboard</h1>';
    });
    Route::get('orders', [CustomerOrders::class, 'index'])->name('orders.index');
    Route::get('order/{id}', [CustomerOrders::class, 'orderDetails'])->name('order.show')->whereNumber('id');

    Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name("checkout");
    Route::post('/cart/checkout', [CheckoutController::class, 'placeOrder'])->name("placeorder");
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
    Route::post('product/upload/', [ProductController::class, 'uploadproductImages'])->name('uploadproductimage');

    //gallery
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('gallery/{dir}', [GalleryController::class, 'getfiles'])->name('gallery.dir');

    Route::post('gallery/add', [GalleryController::class, 'store'])->name('gallery.store');
    Route::post('gallery/update', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/delete', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::delete('gallery/deletemulti', [GalleryController::class, 'multidestroy'])->name('gallery.destroy.multi');



    //reviews
    Route::get('reviews', [ReviewsController::class, 'index'])->name('reviews.index');
    Route::delete('review/delete', [ReviewsController::class, 'destroy'])->name('review.destroy');


    //coupon
    Route::get('coupon', [CouponController::class, 'index'])->name('coupons.index');
    Route::post('coupon/add', [CouponController::class, 'store'])->name('coupon.store');
    Route::post('coupon/update', [CouponController::class, 'update'])->name('coupon.update');
    Route::delete('coupon/delete', [CouponController::class, 'destroy'])->name('coupon.destroy');


    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('order/{id}', [OrderController::class, 'orderDetials'])->name('order.details')->whereNumber('id');
    Route::post('order/status', [OrderController::class, 'orderStatus'])->name('order.status');
});
