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
use App\Livewire\Admins\SpecialContents\Index as ScIndex;
use App\Livewire\Admins\SpecialContents\Groups\Index as ScGroupsIndex;
use App\Livewire\Admins\SpecialContents\Groups\Create as ScGroupsCreate;
use App\Livewire\Admins\SpecialContents\Groups\Show as ScGroupsShow;
use App\Livewire\Admins\SpecialContents\Groups\Edit as ScGroupsEdit;
use App\Livewire\Admins\SpecialContents\Items\Index as ScItemsIndex;
use App\Livewire\Admins\SpecialContents\Items\Create as ScItemsCreate;
use App\Livewire\Admins\SpecialContents\Items\Show as ScItemsShow;
use App\Livewire\Admins\SpecialContents\Items\Edit as ScItemsEdit;

$prefix = config('admin.prefix', '/admins');

Route::prefix($prefix)->name('admins.')->group(function () use ($prefix) {
    Route::redirect('/', $prefix . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        Route::post('/logout', LogoutController::class)->name('logout');

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', UsersIndex::class)->name('index');
            Route::get('/{uuid}', UsersShow::class)->name('show');
            Route::get('/{uuid}/send-reset-link', UsersSendResetLink::class)->name('send-reset-link');
            Route::get('/{uuid}/send-verification-link', UsersSendEmailVerification::class)->name('send-verification-link');

            Route::prefix('{uuid}/testimonies')->name('testimonies.')->group(function () {
                Route::get('/', UsersTestimoniesIndex::class)->name('index');
                Route::get('/{testimony_uuid}', UsersTestimoniesShow::class)->name('show');
            });
        });

        Route::prefix('testimonies')->name('testimonies.')->group(function () {
            Route::get('/', TestimoniesIndex::class)->name('index');
            Route::get('/{uuid}', TestimoniesShow::class)->name('show');
        });

        Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
            Route::get('/', ContactMessagesIndex::class)->name('index');
            Route::get('/{uuid}', ContactMessagesShow::class)->name('show');
        });

        Route::prefix('feedback-messages')->name('feedback-messages.')->group(function () {
            Route::get('/', FeedbackMessagesIndex::class)->name('index');
            Route::get('/{uuid}', FeedbackMessagesShow::class)->name('show');
        });

        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', MessagesIndex::class)->name('index');
            Route::get('/create', MessagesCreate::class)->name('create');
            Route::get('/{uuid}', MessagesShow::class)->name('show');
        });

        Route::get('/special-contents', ScIndex::class)->name('special-contents.index');

        Route::prefix('special-contents/groups')->name('special-contents.groups.')->group(function () {
            Route::get('/', ScGroupsIndex::class)->name('index');
            Route::get('/create', ScGroupsCreate::class)->name('create');
            Route::get('/{uuid}', ScGroupsShow::class)->name('show');
            Route::get('/{uuid}/edit', ScGroupsEdit::class)->name('edit');
        });

        Route::prefix('special-contents/items')->name('special-contents.items.')->group(function () {
            Route::get('/', ScItemsIndex::class)->name('index');
            Route::get('/create', ScItemsCreate::class)->name('create');
            // Route::get('/{uuid}', ScItemsShow::class)->name('show');
            // Route::get('/{uuid}/edit', ScItemsEdit::class)->name('edit');
        });

        Route::redirect('/settings', '/settings/profile');
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/profile', SettingsProfile::class)->name('profile');
            Route::get('/password', SettingsPassword::class)->name('password');
            Route::get('/appearance', SettingsAppearance::class)->name('appearance');
        });
    });
});

