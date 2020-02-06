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

Route::get('resToday', 'CountTodaysGuest');
Route::apiResources([
    'reservation' => 'Reservations',
    'userdata' => 'API\UserController',
    'room' => 'FloorsController',
    'checkin' => 'Rooms',
    'house' => 'Rooms',
    'guest' => 'Guests',
    'inventory' => 'InventoryController',
    'occu' => 'OccuController',
    'rate' => 'RatesController',
    'charge' => 'ChargesController',
    'pay' => 'PaymentController',
    'reports' => 'ReportsController',
]);
