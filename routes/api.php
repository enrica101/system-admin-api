<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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



//Public Routes
// @ Register - create user account
// @ Login - to log in user into his account for access & provide his token for authorization of actions

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);



// Private Routes
// @ Index - list of requests info (GET)
// @ Show - single list of request info (GET)
// @ Create  - add a single list (POST)
// @ Update - update a single list (PUT)
// @ Delete - delete a single list (DELETE)
// @ Search - serach or find a single list among others (GET)
// @ Logout - user has to provide his token to be able to logout (POST -token delete from personal_access_tokens table)


//Private Routes for users
// @ Profile - show user details (GET - user and/or responder)
// @ All Users - list of all users regardless accountTypes (GET)
// @ Update - update user and/or responder info (PUT)
// @ Delete - delete user and/or responder info (DELETE)

//User <=> Requests
// @ userCurrentRequest - show user ongoing request details with nullable responder details (GET)
// @ usersRequestHistory - show user's all request history (GET)

//Responder => Request <= User
// @ assignedResponderToRequest - update ongoing request by adding assigned Responder (PUT)
// @ removeResponderFromRequest - remove responder from assigned its request, set responder status to avail (PUT)
// @ responderForceCancellingRequest - set request status to "Cancelled" then add to archives (POST)
// @ create - create responder details (POST)
// @ allAvailable - show list of available/on standby responders (GET)
// @ allHandlingRequest - show list of on duty responders (GET)
// @ Show - a single responder info (GET)
// @ Update - update responder info (PUT)
// @ Delete - delete responder account (DELETE)
// @ Search - search a single responder (GET)

//Archives
// @ Index - all rchive list (GET)
// @ Show - single archived list info (GET)
// @ Create  - add a single archived list (POST)
// @ Update - update a single archived list (PUT)
// @ Search - serach or find a single list among other archives (GET)

// Route::group(['middleware' => ['auth:sanctum']], function (){ 
    //     //Users
    Route::get('/users', [UserController::class, 'indexUsers']);
    Route::get('/users/responders', [UserController::class, 'indexResponders']);
    Route::get('/users/admins', [UserController::class, 'indexAdmins']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    //     //Requests
        Route::get('/requests', [RequestsInfoController::class, 'index']);
        Route::get('/requests/{id}', [RequestsInfoController::class, 'show']);
        Route::post('/requests', [RequestsInfoController::class, 'store']); //A.K.A create
        Route::put('/requests/{id}', [RequestsInfoController::class, 'update']);
        Route::delete('/requests/{id}', [RequestsInfoController::class, 'destroy']);
        Route::get('/requests/search/type/{type}', [RequestsInfoController::class, 'searchType']); //search for single listing
        Route::get('/requests/search/status/{status}', [RequestsInfoController::class, 'searchStatus']);
        Route::get('/requests/search/location/{location}', [RequestsInfoController::class, 'searchLocation']);
    
    // });
    
    // Route::prefix('responder')->middleware('auth')->group(function(){
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
// });

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     //once logged in, you have to return the token to get the users information from this route.

 
//     // return $request->user();
// });
