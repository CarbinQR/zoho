<?php

use App\Http\Controllers\DealController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::get('/create-deal', [DealController::class, 'createDealWithTaskRelation']);
