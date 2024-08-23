<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // PRODUCTS
    Route::get('/products/search', [\App\Http\Controllers\Admin\ProductController::class, 'search'])->name('admin.products.search');
    Route::post('/products/update-positions', [\App\Http\Controllers\Admin\ProductController::class, 'updatePositions'])->name('admin.products.updatePositions');
    Route::get('/products/draw', [\App\Http\Controllers\Admin\ProductController::class, 'draw'])->name('admin.products.draw');
    Route::any('/products/bulk-actions', [\App\Http\Controllers\Admin\ProductController::class, 'bulkActions']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // DETAILS
    Route::get('/details/search', [\App\Http\Controllers\Admin\DetailsController::class, 'search'])->name('admin.details.search');
    Route::post('/details/update-positions', [\App\Http\Controllers\Admin\DetailsController::class, 'updatePositions'])->name('admin.details.updatePositions');
    Route::get('/details/draw', [\App\Http\Controllers\Admin\DetailsController::class, 'draw'])->name('admin.details.draw');
    Route::any('/details/bulk-actions', [\App\Http\Controllers\Admin\DetailsController::class, 'bulkActions']);
    Route::resource('details', \App\Http\Controllers\Admin\DetailsController::class);

    //USERS //ROLES
    Route::get('/users/draw', [\App\Http\Controllers\Admin\UserController::class, 'draw'])->name('admin.user.draw');
    Route::get('/users/export/all', [\App\Http\Controllers\Admin\UserController::class, 'exportAll'])->name('admin.users.export.all');
    Route::get('/users/search', [\App\Http\Controllers\Admin\UserController::class, 'search'])->name('admin.users.search');
    Route::get('/users/general-news', [\App\Http\Controllers\Admin\UserController::class, 'generalNews'])->name('users.generalNews');
    Route::post('/users/general-news', [\App\Http\Controllers\Admin\UserController::class, 'generalNewsStore'])->name('users.generalNews.store');
    Route::get('/users/list', [\App\Http\Controllers\Admin\UserController::class, 'getUsers'])->name('admin.users.search-all');
    Route::any('/users/bulk-actions', [\App\Http\Controllers\Admin\UserController::class, 'bulkActions']);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('/roles/draw', [\App\Http\Controllers\Admin\RoleController::class, 'draw'])->name('admin.role.draw');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::get('/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout'])->name('admin.user.logout');

    //Settings
    Route::get('settings/weight', function () {return view('admin.settings.weight');})->name('settings.weight');
    Route::get('settings/general', function () {return view('admin.settings.general');})->name('settings.general');
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);

    // QUESTIONS
    Route::get('/questions/search', [\App\Http\Controllers\Admin\QuestionController::class, 'search'])->name('admin.questions.search');
    Route::post('/questions/update-positions', [\App\Http\Controllers\Admin\QuestionController::class, 'updatePositions'])->name('admin.questions.updatePositions');
    Route::get('/questions/draw', [\App\Http\Controllers\Admin\QuestionController::class, 'draw'])->name('admin.questions.draw');
    Route::any('/questions/bulk-actions', [\App\Http\Controllers\Admin\QuestionController::class, 'bulkActions']);
    Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class);

    //ATTACHMENTS
    Route::resource('attachments', \App\Http\Controllers\Admin\AttachmentController::class);

    //MEDIA
    Route::post('/upload-file', [\App\Http\Controllers\Admin\MediaController::class, 'uploadFile'])->name('media.uploadFile');
    Route::post('/slugify', [\App\Http\Controllers\Admin\DashboardController::class, 'slugify'])->name('text.slugify');

});
