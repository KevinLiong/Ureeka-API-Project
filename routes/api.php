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
Route::post('/login', [UserController::class, 'loginUser'])->name('/');
Route::post('/logout', [UserController::class, 'logOutUser'])->middleware('isLogin');

Route::get('/allbook', [KoleksiBukuController::class, 'getAllBook']);//->middleware('isLogin');
Route::post('/addbook', [KoleksiBukuController::class, 'addBook']);//->middleware('isAdmin');
Route::put('/updatebook', [KoleksiBukuController::class, 'updateBook']);//->middleware('isAdmin');
Route::delete('/deletebook', [KoleksiBukuController::class, 'deleteBook']);//->middleware('isAdmin');