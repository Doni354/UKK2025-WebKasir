<?php

use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SesiController::class, 'index'])->name('login');
