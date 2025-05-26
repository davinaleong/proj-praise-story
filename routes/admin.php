<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;

Route::prefix(config('admin.prefix', '/admin'))->name('admin.')->group(function () {
    Route::redirect('/', config('admin.prefix', '/admin') . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');
});
