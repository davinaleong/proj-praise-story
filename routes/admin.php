<?php

use Illuminate\Support\Facades\Route;

Route::prefix(config('admin.prefix', '/admin'))->name('admin.')->group(function () {
    Route::get('/', function () {
        return 'Admin route is working!';
    })->name('home');
});
