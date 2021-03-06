<?php

use App\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as Auth;


Route::middleware(['auth.shopify'])->group(function () {

    Route::get('/', function () {
        $shop = Auth::user();
        $settings = Setting::where('shop_id', $shop->name)->first();
        return view('dashboard', compact('settings'));
    })->name('home');

    Route::view('/products', 'products');
    Route::view('/customers', 'customers');
    Route::view('/settings', 'settings');

    Route::post('configureTheme', 'SettingController@configureTheme');

});
