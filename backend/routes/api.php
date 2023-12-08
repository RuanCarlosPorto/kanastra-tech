<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('ticket')->group(function() {
    Route::post('/', [TicketController::class, 'generate']);
});

Route::prefix('file')->group(function() {
    Route::get('/', [FileController::class, 'index']);
});