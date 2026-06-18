<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('/', function () {
    return redirect()->route('foods.index');
});

// Route Khusus Trash & Restore (HARUS SEBELUM resource)
Route::get('/foods/trash', [FoodController::class, 'trash'])->name('foods.trash');
Route::post('/foods/{id}/restore', [FoodController::class, 'restore'])->name('foods.restore');
Route::delete('/foods/{id}/force', [FoodController::class, 'forceDelete'])->name('foods.forceDelete');

// Resource Route
Route::resource('foods', FoodController::class);