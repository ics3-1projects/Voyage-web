<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::resource('/trip', 'ApiTripController');
    Route::post('/bookingPhase/pickSeat', 'ApiBookingPhasesController@pickSeat')
        ->name('api.pickSeat');
    Route::post('/bookingPhase/pay', 'ApiMpesaController@pay')
        ->name('api.pay');
});

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');

Route::post('/mpesa/stkpushcallback', 'MpesaController@stkPushCallback');
