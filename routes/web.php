<?php

use App\Http\Controllers\ShortenedLinkController;
use Illuminate\Support\Facades\Route;

Route::post('shorten', [ShortenedLinkController::class, 'shorten'])->name('links.shorten');
Route::get('{token}', [ShortenedLinkController::class, 'redirect'])->name('links.redirect');
