<?php

use App\Http\Controllers\ImageCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageItemController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [ImageCategoryController::class, 'index'])
        ->name('categories.index');

    Route::post('/categories', [ImageCategoryController::class, 'store'])
        ->name('categories.store');

    Route::post('/categories/update/{id}', [ImageCategoryController::class, 'update'])
        ->name('categories.update');

    Route::get('/categories/destroy/{id}', [ImageCategoryController::class, 'destroy'])
        ->name('categories.destroy');

    Route::post('/categories/status/{id}', [ImageCategoryController::class, 'updateStatus'])
        ->name('categories.status');

    Route::get('/image-items', [ImageItemController::class, 'index'])
        ->name('image-items.index');

    Route::post('/image-item', [ImageItemController::class, 'store'])
        ->name('image-items.add');

    Route::get('/image-item/add', [ImageItemController::class, 'create'])
        ->name('image-items.create');

    Route::get('/image-item/edit/{id}', [ImageItemController::class, 'edit'])
        ->name('image-items.edit');

    Route::put('/image-item/{id}', [ImageItemController::class, 'update'])
        ->name('image-items.update');

    Route::get('/image-item/delete/{id}', [ImageItemController::class, 'destroy'])
        ->name('image-items.delete');

    Route::post('/image-items/status/{id}', [ImageItemController::class, 'updateStatus'])
        ->name('image-items.status');

    Route::get('/image-items/{id}', [ImageItemController::class, 'show'])
        ->name('image-items.show');

});

require __DIR__ . '/auth.php';
