<?php

use App\Http\Controllers\jasaController;
use App\Http\Controllers\komponenController;
use App\Http\Controllers\productController;
use App\Http\Controllers\productKastemisasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name('home');
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/about', fn() => view('about'))->name('about');

// ===================
// ADMIN ROUTES
// ===================
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/user', fn() => view('admin.user'))->name('admin.user');
    Route::get('/setting', fn() => view('admin.setting'))->name('admin.setting');

    // ORDERS
    Route::prefix('order')->group(function () {
        Route::get('/', fn() => view('admin.order.orders'))->name('admin.orders');
        Route::get('/detail', fn() => view('admin.order.order-detail'))->name('admin.order-detail');
        Route::get('/tracking', fn() => view('admin.order.orders-tracking'))->name('admin.order-tracking');
    });

    // PRODUCT KOSTUMISASI
    Route::prefix('product-kastemisasi')->controller(productKastemisasiController::class)->group(function () {
        Route::get('/', 'index')->name('admin.product.kastemisasi');
        Route::get('/create', 'create')->name('admin.product.kastemisasi.create');
        Route::post('/', 'store')->name('admin.product.kastemisasi.store');
        Route::get('/{productKastemisasi}/edit', 'edit')->name('admin.product.kastemisasi.edit');
        Route::put('/{productKastemisasi}', 'update')->name('admin.product.kastemisasi.update');
        Route::delete('/{productKastemisasi}', 'destroy')->name('admin.product.kastemisasi.destroy');
    });

    // PRODUCT
    Route::prefix('product')->controller(productController::class)->group(function () {
        Route::get('/', 'index')->name('admin.product');
        Route::get('/create', [productController::class, 'create'])->name('admin.product.create');
        Route::post('/', [productController::class, 'store'])->name('admin.product.store');
        Route::get('/{product}/edit', [productController::class, 'edit'])->name('admin.product.edit');
        Route::put('/{product}', [productController::class, 'update'])->name('admin.product.update');
        Route::delete('/{product}', [productController::class, 'destroy'])->name('admin.product.destroy');
    });

    // KOMPONEN
    Route::prefix('komponen')->controller(komponenController::class)->group(function () {
        Route::get('/', 'index')->name('admin.komponen.komponenBarang');

        // BAHAN
        Route::prefix('bahan')->group(function () {
            Route::get('/', 'bahanindex')->name('admin.komponen.bahan');
            Route::get('/create', 'bahancreate')->name('admin.komponen.bahan.create');
            Route::post('/', 'bahanstore')->name('admin.komponen.bahan.store');
            Route::get('/{bahan}/edit', 'bahanedit')->name('admin.komponen.bahan.edit');
            Route::put('/{bahan}', 'bahanupdate')->name('admin.komponen.bahan.update');
            Route::delete('/{bahan}', 'bahandestroy')->name('admin.komponen.bahan.destroy');
        });

        // UKURAN
        Route::prefix('ukuran')->group(function () {
            Route::get('/', 'ukuranindex')->name('admin.komponen.ukuran');
            Route::get('/create', 'ukurancreate')->name('admin.komponen.ukuran.create');
            Route::post('/', 'ukuranstore')->name('admin.komponen.ukuran.store');
            Route::get('/{ukuran}/edit', 'ukuranedit')->name('admin.komponen.ukuran.edit');
            Route::put('/{ukuran}', 'ukuranupdate')->name('admin.komponen.ukuran.update');
            Route::delete('/{ukuran}', 'ukurandestroy')->name('admin.komponen.ukuran.destroy');
        });

        // WARNA
        Route::prefix('warna')->group(function () {
            Route::get('/', 'warnaindex')->name('admin.komponen.warna');
            Route::get('/create', 'warnacreate')->name('admin.komponen.warna.create');
            Route::post('/', 'warnastore')->name('admin.komponen.warna.store');
            Route::get('/{warna}/edit', 'warnaedit')->name('admin.komponen.warna.edit');
            Route::put('/{warna}', 'warnaupdate')->name('admin.komponen.warna.update');
            Route::delete('/{warna}', 'warnadestroy')->name('admin.komponen.warna.destroy');
        });

        // SABLON
        Route::prefix('sablon')->group(function () {
            Route::get('/', 'sablonindex')->name('admin.komponen.sablon');
            Route::get('/create', 'sabloncreate')->name('admin.komponen.sablon.create');
            Route::post('/', 'sablonstore')->name('admin.komponen.sablon.store');
            Route::get('/{sablon}/edit', 'sablonedit')->name('admin.komponen.sablon.edit');
            Route::put('/{sablon}', 'sablonupdate')->name('admin.komponen.sablon.update');
            Route::delete('/{sablon}', 'sablondestroy')->name('admin.komponen.sablon.destroy');
        });
    });

    // JASA
    Route::prefix('jasa')->controller(jasaController::class)->group(function () {
        Route::get('/', 'index')->name('admin.jasa');
        Route::get('/create', 'create')->name('admin.jasa.create');
        Route::post('/', 'store')->name('admin.jasa.store');
        Route::get('/{jasa}/edit', 'edit')->name('admin.jasa.edit');
        Route::put('/{jasa}', 'update')->name('admin.jasa.update');
        Route::delete('/{jasa}', 'destroy')->name('admin.jasa.destroy');
    });

    // LAPORAN
    Route::get('/laporan', [productController::class, 'cetakLaporan'])->name('admin.laporan');
});

Route::middleware(['auth', 'isCustomer'])->group(function () {

    Route::prefix('cart')->group(function () {

        Route::get('/cart', [App\Http\Controllers\cartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [App\Http\Controllers\cartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{id}', [App\Http\Controllers\cartController::class, 'remove'])->name('cart.remove');
    });

    Route::get('/user/dashboard', function () {
        return view('user.accounts.account-dashboard');
    })->name('account-dashboard');

    Route::get('/user/account-detail', function () {
        return view('user.accounts.account-detail');
    })->name('account-detail');

    Route::get('/user/account/account-address', function () {
        return view('user.accounts.account-address');
    })->name('account-address');

    Route::get('/user/account/account-orders', function () {
        return view('user.accounts.account-orders');
    })->name('account-orders');

    Route::get('/user/account/account-riview', function () {
        return view('user.accounts.account-review');
    })->name('account-riview');

    Route::get('/user/account/account-orders-detail', function () {
        return view('user.accounts.account-orders-detail');
    })->name('account-order-detail');

    Route::get('/user/account/account-address', [App\Http\Controllers\RajaOngkirController::class, 'showAddresses'])->name('account-address');
    Route::get('/user/account/account-address/add-address', [App\Http\Controllers\RajaOngkirController::class, 'index'])->name('account-add-address');
    Route::get('/user/account/account-address/cities/{provinceId}', [App\Http\Controllers\RajaOngkirController::class, 'getCities']);
    Route::get('/user/account/account-address/districts/{cityId}', [App\Http\Controllers\RajaOngkirController::class, 'getDistricts']);
    Route::post('/user/account/account-address', [App\Http\Controllers\RajaOngkirController::class, 'store'])->name('account-address.store');
});
