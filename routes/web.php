<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Testimonies\Index as PublicTestimonyIndex;
use App\Livewire\Testimonies\Show as PublicTestimonyShow;
use App\Livewire\Me\PublishedTestimonies\Index as MyPublishedTestimonyIndex;
use App\Livewire\Me\Testimonies\Index as MeTestimonyIndex;
use App\Livewire\Me\Testimonies\Create as MeTestimonyCreate;
use App\Livewire\Me\Testimonies\Show as MeTestimonyShow;
use App\Livewire\Me\Testimonies\Edit as MeTestimonyEdit;
use App\Livewire\Me\Dashboard as Dashboard;
use App\Livewire\Me\Information as Information;
use App\Livewire\Me\FeedbackForm as FeedbackForm;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Livewire\TermsAndConditions\Show as TermsAndConditionsShow;
use App\Livewire\TermsAndConditions\Me as MeTermsAndConditions;
use App\Livewire\PrivacyPolicy\Show as PrivacyPolicyShow;
use App\Livewire\PrivacyPolicy\Me as MePrivacyPolicy;
use App\Livewire\Private\Testimonies\Index as PrivateTestimonyIndex;
use App\Livewire\Private\Testimonies\Show as PrivateTestimonyShow;
use App\Livewire\Contact;
use App\Livewire\Temp;

// Public Routes
Route::get('/', PublicTestimonyIndex::class)->name('home');
Route::get('/testimonies/{uuid}', PublicTestimonyShow::class)->name('testimonies.public');

Route::get('/contact', Contact::class)->name('contact');

Route::get('/terms-and-conditions', TermsAndConditionsShow::class)->name('terms-and-conditions.show');
Route::get('/privacy-policy', PrivacyPolicyShow::class)->name('privacy-policy.show');

// Temporary / Test Route
Route::get('/temp', Temp::class)->name('temp');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Private content
    Route::prefix('/private')->name('private.')->group(function () {
        Route::prefix('/testimonies')->name('testimonies.')->group(function() {
            Route::get('/', PrivateTestimonyIndex::class)->name('index');
            Route::get('/{uuid}', PrivateTestimonyShow::class)->name('show');
        });
    });

    // /me routes
    Route::prefix('me')->name('me.')->group(function () {

        // Informative
        Route::redirect('/me', '/me/dashboard');
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/information', Information::class)->name('information');
        Route::get('/feedback', FeedbackForm::class)->name('feedback');

        // Settings
        Route::redirect('/settings', '/me/settings/profile');
        Route::get('/settings/profile', Profile::class)->name('settings.profile');
        Route::get('/settings/password', Password::class)->name('settings.password');
        Route::get('/settings/appearance', Appearance::class)->name('settings.appearance');

        // Policy pages (user-facing)
        Route::get('/terms-and-conditions', MeTermsAndConditions::class)->name('terms-and-conditions');
        Route::get('/privacy-policy', MePrivacyPolicy::class)->name('privacy-policy');

        // My Published Testimonies (view-only)
        Route::get('/my-published-testimonies', MyPublishedTestimonyIndex::class)->name('published.index');

        // Creator Panel (CRUD) - Verified Users Only
        Route::middleware('verified')->prefix('testimonies')->name('testimonies.')->group(function () {
            Route::get('/', MeTestimonyIndex::class)->name('index');
            Route::get('/create', MeTestimonyCreate::class)->name('create');
            Route::get('/{uuid}', MeTestimonyShow::class)->name('show');
            Route::get('/{uuid}/edit', MeTestimonyEdit::class)->name('edit');
        });
    });
});

require __DIR__.'/auth.php';
