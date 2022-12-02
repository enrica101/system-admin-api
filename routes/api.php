<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponderController;
use App\Http\Controllers\RequestsInfoController;

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

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    //once logged in, you have to return the token to get the users information from this route.
    return $request->user();
});

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


 //Users
    Route::get('/users', [UserController::class, 'indexUsers']);
    Route::get('/users/responders', [UserController::class, 'indexResponders']);
    Route::get('/users/admins', [UserController::class, 'indexAdmins']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

  //Requests
        Route::get('/requests', [RequestsInfoController::class, 'index']);
        Route::get('/requests/available', [RequestsInfoController::class, 'indexAvailable']);
        Route::get('/requests/{id}', [RequestsInfoController::class, 'show']);
        Route::post('/requests', [RequestsInfoController::class, 'store']); //A.K.A create
        Route::put('/requests/{id}', [RequestsInfoController::class, 'update']);
        Route::delete('/requests/{id}', [RequestsInfoController::class, 'destroy']);
        Route::get('/requests/search/type/{type}', [RequestsInfoController::class, 'searchType']); //search for single listing
        Route::get('/requests/search/status/{status}', [RequestsInfoController::class, 'searchStatus']);
        Route::get('/requests/search/location/{location}', [RequestsInfoController::class, 'searchLocation']);
    

        Route::get('/responders', [ResponderController::class, 'index']);
        Route::get('/responders/{id}', [ResponderController::class, 'show']);
        Route::put('/responders/{id}', [ResponderController::class, 'update']);
        Route::delete('/responders/{id}', [ResponderController::class, 'destroy']);
        Route::get('/responders/search/{type}', [ResponderController::class, 'responderType']);

        Route::get('/responders/responses/all', [ResponseController::class, 'index']);
        Route::get('/responders/responses/{id}', [ResponseController::class, 'show']);
        Route::post('/responders/responses', [ResponseController::class, 'store']);
        Route::put('/responders/responses/status/{id}', [ResponseController::class, 'updateStatus']);
        Route::put('/responders/responses/location/{id}', [ResponseController::class, 'updateLocation']);
        Route::delete('/responders/responses/{id}', [ResponseController::class, 'destroy']);

        Route::get('/archive/users', [ArchiveController::class, 'usersArchive']);
        Route::get('/archive/responders', [ArchiveController::class, 'respondersArchive']);
        Route::get('archive/requests', [ArchiveController::class, 'requestsArchive']);
        Route::get('archive/responses', [ArchiveController::class, 'responsesArchive']);

        Route::get('/archive/users/{id}', [ArchiveController::class, 'findArchivedUser']);
        Route::get('/archive/responders/{id}', [ArchiveController::class, 'findArchivedResponder']);
        Route::get('archive/requests/{id}', [ArchiveController::class, 'findArchivedRequest']);
        Route::get('archive/responses/{id}', [ArchiveController::class, 'findArchivedResponses']);
        
        Route::get('archive/requests/search/{id}', [ArchiveController::class, 'searchRequestArchive']);
        Route::get('archive/responses/search/{id}', [ArchiveController::class, 'searchResponsesArchive']);


        // Route::get('accounts/{id}', [AdminController::class, 'getRoleUsers']);

