<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\Private\TestimonyController as PrivateTestimonyController;
use App\Http\Controllers\Me\TestimonyController as MeTestimonyController;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;

// Public Testimonies
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{uuid}', 'show')->name('testimony.public');
});

// Authenticated Private Testimonies (any author)
Route::middleware('auth')->prefix('testimonies/private')->name('private.')->controller(PrivateTestimonyController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{uuid}', 'show')->name('show');
});

Route::middleware('auth')->prefix('me/my-published-testimonies')->name('me.published.')->controller(MeTestimonyController::class)->group(function () {
    Route::get('/', 'index')->name('index');         // /me/my-published-testimonies
    Route::get('/{uuid}', 'show')->name('show');     // /me/my-published-testimonies/{uuid}
});

// Creator Panel (CRUD)
Route::middleware(['auth', 'verified'])->prefix('me/testimonies')->name('me.testimonies.')->controller(TestimonyController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::put('/{uuid}', 'update')->name('update');
    Route::delete('/{uuid}', 'destroy')->name('destroy');
});

// Settings
Route::middleware(['auth'])->group(function () {
    Route::redirect('/settings', '/settings/profile');
    Route::get('/settings/profile', Profile::class)->name('settings.profile');
    Route::get('/settings/password', Password::class)->name('settings.password');
    Route::get('/settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
