<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Testimonies\Index as PublicTestimonyIndex;
use App\Livewire\Testimonies\Show as PublicTestimonyShow;
use App\Livewire\PrivateTestimonies\Index as PrivateTestimonyIndex;
use App\Livewire\PrivateTestimonies\Show as PrivateTestimonyShow;
use App\Livewire\Me\PublishedTestimonies\Index as MyPublishedTestimonyIndex;
use App\Livewire\Me\Testimonies\Index as MeTestimonyIndex;
use App\Livewire\Me\Testimonies\Create as MeTestimonyCreate;
use App\Livewire\Me\Testimonies\Show as MeTestimonyShow;
use App\Livewire\Me\Testimonies\Edit as MeTestimonyEdit;
use App\Livewire\Me\Dashboard as Dashboard;
use App\Livewire\Me\Information as Information;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Livewire\TermsAndConditions\Show as TermsAndConditionsShow;
use App\Livewire\TermsAndConditions\Me as MeTermsAndConditions;
use App\Livewire\PrivacyPolicy\Show as PrivacyPolicyShow;
use App\Livewire\PrivacyPolicy\Me as MePrivacyPolicy;
use App\Livewire\Feedback\Show as FeedbackShow;
use App\Livewire\Feedback\Me as MeFeedback;
use App\Livewire\Temp;

// Public
Route::get('/', PublicTestimonyIndex::class)->name('home');
Route::get('/testimonies/{uuid}', PublicTestimonyShow::class)->name('testimonies.public');

Route::get('/terms-and-conditions', TermsAndConditionsShow::class)->name('terms-and-conditions.show');
Route::get('/privacy-policy', PrivacyPolicyShow::class)->name('privacy-policy.show');
Route::get('/feedback', FeedbackShow::class)->name('feedback.show');

// TODO: Remove
Route::get('/temp', Temp::class)->name('temp');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Dashboard & Info
    Route::get('/me', Dashboard::class)->name('me.dashboard');
    Route::get('/me/information', Information::class)->name('me.information');

    // Private Testimonies (view-only, all authors)
    Route::prefix('private-testimonies')->name('private-testimonies.')->group(function () {
        Route::get('/', PrivateTestimonyIndex::class)->name('index');
        Route::get('/{uuid}', PrivateTestimonyShow::class)->name('show');
    });

    // My Published Testimonies (view-only)
    Route::prefix('me/my-published-testimonies')->name('me.published.')->group(function () {
        Route::get('/', MyPublishedTestimonyIndex::class)->name('index');
    });

    Route::get('me/terms-and-conditions', MeTermsAndConditions::class)->name('me.terms-and-conditions');
    Route::get('me/privacy-policy', MePrivacyPolicy::class)->name('me.privacy-policy');
    Route::get('me/feedback', MeFeedback::class)->name('me.feedback');

    // Settings
    Route::prefix('me')->name('me.')->group(function () {
        Route::redirect('/settings', '/settings/profile');
        Route::get('/settings/profile', Profile::class)->name('settings.profile');
        Route::get('/settings/password', Password::class)->name('settings.password');
        Route::get('/settings/appearance', Appearance::class)->name('settings.appearance');
    });

    // Creator Panel (CRUD) - Verified Users
    Route::middleware('verified')->prefix('me/testimonies')->name('me.testimonies.')->group(function () {
        Route::get('/', MeTestimonyIndex::class)->name('index');
        Route::get('/create', MeTestimonyCreate::class)->name('create');
        Route::get('/{uuid}', MeTestimonyShow::class)->name('show');
        Route::get('/{uuid}/edit', MeTestimonyEdit::class)->name('edit');
        // Note: store, update, destroy handled by Livewire
    });

});

require __DIR__.'/auth.php';
