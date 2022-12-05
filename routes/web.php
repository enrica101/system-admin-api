<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponderController;
use App\Http\Controllers\RequestsInfoController;

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

Route::get('/responders', function () {
    return view('responders');
});

Route::get('/requests', function () {
    return view('requests');
});

Route::get('/accounts', [AdminController::class, 'getRoleUsers']);

Route::post('/create', [AdminController::class, 'store']);
Route::get('/register', [AdminController::class, 'create']);
Route::post('/users/authenticate', [AdminController::class, 'authenticate']);

Route::get('/responders', [ResponderController::class, 'getRoleResponders']);
Route::get('/requests', [RequestsInfoController::class, 'getRequestsInfos']);
Route::get('/dashboard', [AdminController::class, 'getData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});