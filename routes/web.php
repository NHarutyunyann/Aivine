<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'sitemap']);

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/contacts', [HomeController::class, 'contacts']);
Route::post('/send_message', [HomeController::class, 'sendMessage']);



