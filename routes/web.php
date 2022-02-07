<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
// Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('details');
// Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
// Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

// Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');

// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
// Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard');
// Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-create');
// Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard-product');

// Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
// Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');

// Route::get('/dashboard/settings', [App\Http\Controllers\DashboardSettingsController::class, 'store'])->name('dashboard-settings-store');
// Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingsController::class, 'account'])->name('dashboard-settings-account');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');
Route::get('/details/{id}', 'DetailController@index')->name('details');
Route::post('/details/{id}', 'DetailController@add')->name('details-add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('callback');

Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-create');
    Route::post('/dashboard/products', 'DashboardProductController@store')->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', 'DashboardSettingsController@store')->name('dashboard-settings-store');
    Route::get('/dashboard/account', 'DashboardSettingsController@account')->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingsController@update')->name('dashboard-settings-redirect');
});

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth','admin'])
        ->group(function() {
            Route::get('/', 'DashboardController@index')->name('admin-dashboard');
            Route::resource('category', 'CategoryController');
            Route::resource('user', 'UserController');
            Route::resource('products', 'ProductController');
            Route::resource('product-gallery', 'ProductGalleryController');
            Route::resource('transaction', 'TransactionController');
        });

Auth::routes();
