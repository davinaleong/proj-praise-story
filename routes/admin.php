<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\Auth\LogoutController;
use App\Livewire\Admins\Auth\Login;
use App\Livewire\Admins\Dashboard;
use App\Livewire\Admins\Users\Index as UsersIndex;
use App\Livewire\Admins\Users\Show as UsersShow;
use App\Livewire\Admins\Users\SendResetLink as UsersSendResetLink;
use App\Livewire\Admins\Users\SendEmailVerification as UsersSendEmailVerification;
use App\Livewire\Admins\Users\Testimonies\Index as UsersTestimoniesIndex;
use App\Livewire\Admins\Users\Testimonies\Show as UsersTestimoniesShow;
use App\Livewire\Admins\Messages\Index as MessagesIndex;
use App\Livewire\Admins\Messages\Create as MessagesCreate;
use App\Livewire\Admins\Messages\Show as MessagesShow;
use App\Livewire\Admins\Testimonies\Index as TestimoniesIndex;
use App\Livewire\Admins\Testimonies\Show as TestimoniesShow;
use App\Livewire\Admins\ContactMessages\Index as ContactMessagesIndex;
use App\Livewire\Admins\ContactMessages\Show as ContactMessagesShow;
use App\Livewire\Admins\FeedbackMessages\Index as FeedbackMessagesIndex;
use App\Livewire\Admins\FeedbackMessages\Show as FeedbackMessagesShow;
use App\Livewire\Admins\Settings\Profile as SettingsProfile;
use App\Livewire\Admins\Settings\Password as SettingsPassword;
use App\Livewire\Admins\Settings\Appearance as SettingsAppearance;
use App\Livewire\Admins\SpecialContents\Index as SpecialContentsIndex;
// use App\Livewire\Admins\SpecialContentGroups\Index as SpecialContentGroupsIndex;
// use App\Livewire\Admins\SpecialContentGroups\Create as SpecialContentGroupsCreate;
// use App\Livewire\Admins\SpecialContentGroups\Show as SpecialContentGroupsShow;
// use App\Livewire\Admins\SpecialContentGroups\Edit as SpecialContentGroupsEdit;

$prefix = config('admin.prefix', '/admins');

Route::prefix($prefix)->name('admins.')->group(function () use ($prefix) {
    Route::redirect('/', $prefix . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        Route::post('/logout', LogoutController::class)->name('logout');

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', action: UsersIndex::class)->name('index');
            Route::get('/{uuid}', UsersShow::class)->name('show');
            Route::get('/{uuid}/send-reset-link', UsersSendResetLink::class)->name('send-reset-link');
            Route::get('/{uuid}/send-verification-link', UsersSendEmailVerification::class)->name('send-verification-link');

            Route::prefix('{uuid}/testimonies')->name('testimonies.')->group(function () {
                Route::get('/', UsersTestimoniesIndex::class)->name('index');
                Route::get('/{testimony_uuid}', UsersTestimoniesShow::class)->name('show');
            });
        });

        Route::prefix('testimonies')->name('testimonies.')->group(function () {
            Route::get('/', action: TestimoniesIndex::class)->name('index');
            Route::get('/{uuid}', action: TestimoniesShow::class)->name('show');
        });

        Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
            Route::get('/', action: ContactMessagesIndex::class)->name('index');
            Route::get('/{uuid}', action: ContactMessagesShow::class)->name('show');
        });

        Route::prefix('feedback-messages')->name('feedback-messages.')->group(function () {
            Route::get('/', action: FeedbackMessagesIndex::class)->name('index');
            Route::get('/{uuid}', action: FeedbackMessagesShow::class)->name('show');
        });

        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', action: MessagesIndex::class)->name('index');
            Route::get('/create', action: MessagesCreate::class)->name('create');
            Route::get('/{uuid}', action: MessagesShow::class)->name('show');
        });

        Route::get('/special-contents', action: SpecialContentsIndex::class)->name('special-contents.index');

        Route::prefix('special-content-groups')->name('special-content-groups.')->group(function () {
            // Route::get('/', action: SpecialContentGroupsIndex::class)->name('index');
            // Route::get('/create', action: SpecialContentGroupsCreate::class)->name('create');
            // Route::get('/{uuid}', action: SpecialContentGroupsShow::class)->name('show');
            // Route::get('/{uuid}/edit', action: SpecialContentGroupsEdit::class)->name('edit');
        });

        Route::redirect('/settings', '/settings/profile');
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/profile', action: SettingsProfile::class)->name('profile');
            Route::get('/password', action: SettingsPassword::class)->name('password');
            Route::get('/appearance', action: SettingsAppearance::class)->name('appearance');
        });
    });
});

