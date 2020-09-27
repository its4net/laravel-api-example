<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('users', [UserController::class, 'store']);
Route::get('users', [UserController::class, 'show']);
Route::get('stock/{symbol}/{price}', [StockController::class, 'stockLookup']);
Route::put('notifications/{id}/read', [NotificationController::class, 'read']);
Route::put('notifications/{id}/unread', [NotificationController::class, 'unread']);
Route::apiResource('notifications', NotificationController::class);
