<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('/', function () {
    return redirect()->route('foods.index');
});

Route::resource('foods', FoodController::class);