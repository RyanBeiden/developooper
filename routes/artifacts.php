<?php

use Illuminate\Support\Facades\Route;

Route::prefix('artifacts')
    ->name('artifacts.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::livewire('/', 'artifacts::dashboard')->name('dashboard');
    });
