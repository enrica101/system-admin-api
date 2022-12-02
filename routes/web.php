<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/map', function () {
    return view('map');
});

Route::get('/accounts', function () {
    return view('accounts');
});
Route::get('/accounts', [AdminController::class, 'getRoleUsers']);

Route::post('/create', [AdminController::class, 'store']);
Route::get('/register', [AdminController::class, 'create']);
Route::post('/users/authenticate', [AdminController::class, 'authenticate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});