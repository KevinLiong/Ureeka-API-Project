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

Route::post('/allbook', [KoleksiBukuController::class, 'getAllBook']);
Route::post('/addbook', [KoleksiBukuController::class, 'addBook']);
<<<<<<< Updated upstream
Route::post('/updatebook', [KoleksiBukuController::class, 'updateBook']);
Route::post('/deletebook', [KoleksiBukuController::class, 'deleteBook']);
=======
Route::update('/updatebook', [KoleksiBukuController::class, 'updateBook']);
Route::delete('/deletebook', [KoleksiBukuController::class, 'deleteBook']); 
>>>>>>> Stashed changes
