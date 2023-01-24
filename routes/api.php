<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;


// USER : login & sign up
Route::post('/auth/register', [AuthController::class, 'register']); // sign up
Route::post('/auth/login', [AuthController::class, 'login']); // login

// EVENT /////////////////////////////////////////////////////////////////
// Event : index : lists all events
Route::get('/events', [EventController::class, 'index']);
// Event : get info about a single event
Route::get('/events/{event_id}', [EventController::class, 'singleEvent']);
// Event : search accross events using a KEY var
Route::get('/events/search/{key}', [EventController::class, 'search']);

// Company ///////////////////////////////////////////////////////////////
// Company : index : lists all companies
Route::get('/companies', [CompanyController::class, 'index']);
// Company : get info about a single company
Route::get('/companies/{company_id}', [CompanyController::class, 'singleCompany']);
// Company : search : search accross companies using a KEY var
Route::get('/companies/search/{key}', [CompanyController::class, 'search']);



// Protected Routes <=== AUTHENTICATION NEEDED to acces these routes
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

    // Booking ///////////////////////////////////////////////////////////////
    // order matters !!
    Route::post('/bookings/mine', [BookingController::class, 'myBookings']); // my bookings
    Route::post('/bookings/add', [BookingController::class, 'createBooking']); // create booking
    Route::get('/bookings/{id}', [BookingController::class, 'getBooking']); // get booking by ID
    Route::post('/bookings/{id}', [BookingController::class, 'editBooking']); // update booking

    // x ///////////////////////////////////////////////////////////////
    




    //
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
