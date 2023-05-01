<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResponderController;
use App\Http\Controllers\RequestsInfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;

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


Route::post('/send-email', [AdminController::class, 'sendEmail']);

Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/map', function () {
    return view('map');
})->middleware('auth');

Route::get('/accounts', function () {
    return view('accounts');
})->middleware('auth');

Route::get('/responders', function () {
    return view('responders');
})->middleware('auth');

Route::get('/requests', function () {
    return view('requests');
})->middleware('auth');

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth');

Route::get('/mail', function () {
    return view('mail');
})->middleware('auth');

Route::get('/success-restore', function () {
    return view('success-restore');
});

Route::get('/user-entry', [AccountController::class, 'create'])->name('account.create');
Route::put('/user-manage/{user}', [AdminController::class, 'updateInfo'])->name('account.manage');
// Route::get('/{id}', [AdminController::class, 'editUser'])->name('account.edit');
Route::get('/user-update/{id}', [AdminController::class, 'editUser'])->name('account.edit');


Route::get('/accounts', [AdminController::class, 'getRoleUsers'])->middleware('auth');

Route::put('/settings',[AdminController::class, 'update'])->middleware('auth');

Route::post('/create', [AdminController::class, 'store']);
Route::get('/register', [AdminController::class, 'create']);
Route::post('/users/authenticate', [AdminController::class, 'authenticate']);
Route::post('/logout', [AdminController::class, 'logout'])->middleware('auth');

Route::get('/export', [AdminController::class, 'exportPDF']);

Route::get('/responders', [ResponderController::class, 'getRoleResponders'])->middleware('auth');

Route::get('/requests', [RequestsInfoController::class, 'getRequestsInfos'])->middleware('auth');





