<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageItemController;

Route::get('/ping', function () {
    return ['status' => 'API is working'];
});

Route::get('/gallery', [ImageItemController::class, 'getGalleryItemsForAPI'])
        ->name('image-items.getGalleryItemsForAPI');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
