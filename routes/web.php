<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Testimonies\Index as PublicTestimonyIndex;
use App\Livewire\Testimonies\Show as PublicTestimonyShow;
use App\Livewire\PrivateTestimonies\Index as PrivateTestimonyIndex;
use App\Livewire\PrivateTestimonies\Show as PrivateTestimonyShow;
use App\Livewire\Me\PublishedTestimonies\Index as MyPublishedTestimonyIndex;
use App\Livewire\Me\PublishedTestimonies\Show as MyPublishedTestimonyShow;
use App\Livewire\Me\Testimonies\Index as MeTestimonyIndex;
use App\Livewire\Me\Testimonies\Create as MeTestimonyCreate;
use App\Livewire\Me\Testimonies\Show as MeTestimonyShow;
use App\Livewire\Me\Testimonies\Edit as MeTestimonyEdit;
use App\Livewire\Me\Dashboard as Dashboard;
use App\Livewire\Me\Information as Information;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Livewire\Temp;

// Homepage & Public Testimonies
Route::get('/', PublicTestimonyIndex::class)->name('home');
Route::get('/testimonies/{uuid}', PublicTestimonyShow::class)->name('testimonies.public');

// Private Testimonies (view-only, any author)
Route::middleware('auth')->prefix('private-testimonies')->name('private-testimonies.')->group(function () {
    Route::get('/', PrivateTestimonyIndex::class)->name('index');
    Route::get('/{uuid}', PrivateTestimonyShow::class)->name('show');
});

// My Published Testimonies (view-only)
Route::middleware('auth')->prefix('me/my-published-testimonies')->name('me.published.')->group(function () {
    Route::get('/', MyPublishedTestimonyIndex::class)->name('index');
    Route::get('/{uuid}', MyPublishedTestimonyShow::class)->name('show');
});

// Creator Panel (CRUD)
Route::middleware(['auth', 'verified'])->prefix('me/testimonies')->name('me.testimonies.')->group(function () {
    Route::get('/', MeTestimonyIndex::class)->name('index');
    Route::get('/create', MeTestimonyCreate::class)->name('create');
    Route::get('/{uuid}', MeTestimonyShow::class)->name('show');
    Route::get('/{uuid}/edit', MeTestimonyEdit::class)->name('edit');
    // Note: store, update, destroy actions are handled inside Livewire
});

// Settings
Route::middleware(['auth'])->prefix('me')->name('me.')->group(function () {
    Route::redirect('/settings', '/settings/profile');
    Route::get('/settings/profile', Profile::class)->name('settings.profile');
    Route::get('/settings/password', Password::class)->name('settings.password');
    Route::get('/settings/appearance', Appearance::class)->name('settings.appearance');
});

// Temp
// TODO: Remove
Route::get('/temp', Temp::class)->name('temp');

// Dashboard
Route::middleware(['auth', 'verified'])->get('/me', Dashboard::class)->name('me.dashboard');

Route::middleware(['auth', 'verified'])->get('/me/information', Information::class)->name('me.information');

require __DIR__.'/auth.php';
