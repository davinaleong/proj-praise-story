<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DebugOnly;
use App\Livewire\Temp;


Route::middleware(DebugOnly::class)->group(function() {
    Route::get('/temp', Temp::class)->name('temp');
});

if (app()->environment('testing')) {
    Route::get('/middleware-test', function () {
        return 'debug route works';
    })->middleware(DebugOnly::class);
}
