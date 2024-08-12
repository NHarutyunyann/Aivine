<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    //PROJECTS
    Route::get('/projects/search', [\App\Http\Controllers\Admin\ProjectController::class, 'search'])->name('admin.products.search');
    Route::post('/projects/update-positions', [\App\Http\Controllers\Admin\ProjectController::class, 'updatePositions'])->name('admin.products.updatePositions');
    Route::get('/projects/draw', [\App\Http\Controllers\Admin\ProjectController::class, 'draw'])->name('admin.products.draw');
    Route::any('/projects/bulk-actions', [\App\Http\Controllers\Admin\ProjectController::class, 'bulkActions']);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);

    //Services
    Route::get('/services/search', [\App\Http\Controllers\Admin\ServiceController::class, 'search'])->name('admin.services.search');
    Route::post('/services/update-positions', [\App\Http\Controllers\Admin\ServiceController::class, 'updatePositions'])->name('admin.services.updatePositions');
    Route::get('/services/draw', [\App\Http\Controllers\Admin\ServiceController::class, 'draw'])->name('admin.services.draw');
    Route::any('/services/bulk-actions', [\App\Http\Controllers\Admin\ServiceController::class, 'bulkActions']);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

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

    //POSTS
    Route::get('/posts/draw', [\App\Http\Controllers\Admin\PostController::class, 'draw'])->name('admin.posts.draw');
    Route::post('/posts/bulk-actions', [\App\Http\Controllers\Admin\PostController::class, 'bulkActions']);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);


    //PARTNERS
    Route::get('/partners/draw', [\App\Http\Controllers\Admin\PartnerController::class, 'draw'])->name('admin.partners.draw');
    Route::post('/partners/bulk-actions', [\App\Http\Controllers\Admin\PartnerController::class, 'bulkActions']);
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);

    //Menus
    Route::get('/menus/draw', [\App\Http\Controllers\Admin\MenuController::class, 'draw'])->name('admin.menus.draw');
    Route::post('/menus/deleteSelected', [\App\Http\Controllers\Admin\MenuController::class, 'deleteSelected'])->name('admin.menus.deleteSelected');
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);

    //ATTACHMENTS
    Route::resource('attachments', \App\Http\Controllers\Admin\AttachmentController::class);

    //MEDIA
    Route::post('/upload-file', [\App\Http\Controllers\Admin\MediaController::class, 'uploadFile'])->name('media.uploadFile');
    Route::post('/slugify', [\App\Http\Controllers\Admin\DashboardController::class, 'slugify'])->name('text.slugify');

    // SLIDERS
    Route::get('/sliders/draw', [\App\Http\Controllers\Admin\SliderController::class, 'draw'])->name('admin.sliders.draw');
    Route::post('/sliders/bulk-actions', [\App\Http\Controllers\Admin\SliderController::class, 'bulkActions']);
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);
});
