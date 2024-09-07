<?php

use App\Http\Controllers\EscooterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('escooter-updatecounter', [EscooterController::class, 'UpdateCounterLanding']);
Route::post('escooter-updatecounterButon', [EscooterController::class, 'UpdateCounterButton']);
