<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;

// USER : login & sign up
Route::post('/auth/register', [AuthController::class, 'register']); // sign up
Route::post('/auth/login', [AuthController::class, 'login']); // login

// EVENT /////////////////////////////////////////////////////////////////
// Event : index
Route::get('/events', [EventController::class, 'index']);
// Event : single
Route::get('/events/{event_id}', [EventController::class, 'singleEvent']);
// Event : search
Route::get('/events/search/{key}', [EventController::class, 'search']);

// Company ///////////////////////////////////////////////////////////////
// Company : index
Route::get('/companies', [CompanyController::class, 'index']);
// Company : single
Route::get('/companies/{company_id}', [CompanyController::class, 'singleCompany']);
// Company : search
Route::get('/companies/search/{key}', [CompanyController::class, 'search']);



// Protected Routes <=== AUTH:NEEDED
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // EVENT ////////////////////////////////////////////////////////////////
    // Event : create
    Route::post('/events/add', [EventController::class, 'createEvent']);
    // Event : edit
    Route::post('/events/{event_id}', [EventController::class, 'editEvent']);
    // Event : delete
    Route::delete('/events/{event_id}', [EventController::class, 'deleteEvent']);

    // Company ///////////////////////////////////////////////////////////////
    // Company : create
    Route::post('/companies/add', [CompanyController::class, 'createCompany']);
    // Company : edit
    Route::post('/companies/{company_id}', [CompanyController::class, 'editCompany']);
    // Company : delete
    Route::delete('/companies/{company_id}', [CompanyController::class, 'deleteCompany']);

    // Profile ///////////////////////////////////////////////////////////////
    Route::post('/profile/edit', [ProfileController::class, 'editProfile']);
    Route::post('/profile/get', [ProfileController::class, 'getProfile']);

    //  ///////////////////////////////////////////////////////////////

    




    //
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
