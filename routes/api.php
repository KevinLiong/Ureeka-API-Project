<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\KoleksiBukuController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [UserController::class, 'registerUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/logout', [UserController::class, 'logOutUser']);//->middleware('auth');

Route::get('/allbook', [KoleksiBukuController::class, 'getAllBook'])->middleware('auth');
Route::post('/addbook', [KoleksiBukuController::class, 'addBook'])->middleware('isAdmin');
Route::update('/updatebook', [KoleksiBukuController::class, 'updateBook'])->middleware('isAdmin');
Route::delete('/deletebook', [KoleksiBukuController::class, 'deleteBook'])->middleware('isAdmin');