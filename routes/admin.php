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

$prefix = config('admin.prefix', '/admins');

Route::prefix($prefix)->name('admins.')->group(function () use ($prefix) {
    Route::redirect('/', $prefix . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/protected-test', function () {
            return 'You are authenticated as an admin.';
        })->name('protected.test');

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

        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', action: MessagesIndex::class)->name('index');
            Route::get('/create', action: MessagesCreate::class)->name('create');
            Route::get('/{uuid}', action: MessagesShow::class)->name('show');
        });

        Route::redirect('/settings', '/settings/profile');
        Route::get('/settings/profile', action: function () {
            return 'TODO: Profile';
        })->name('settings.profile');
        Route::get('/settings/password', function () {
            return 'TODO: Password';
        })->name('settings.password');
        Route::get('/settings/appearance', function () {
            return 'TODO: Appearance';
        })->name('settings.appearance');
    });
});

