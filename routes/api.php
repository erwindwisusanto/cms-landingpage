<?php

use App\Http\Controllers\ApotekJakartaController;
use App\Http\Controllers\DengueController;
use App\Http\Controllers\EscooterController;
use App\Http\Controllers\HomeLabController;
use App\Http\Controllers\JakartaHomeLabController;
use App\Http\Controllers\PharmacyBaliController;
use App\Http\Controllers\WhiteningController;
use App\Http\Controllers\WhiteningDotClinicController;
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

Route::post('ap-ph-jakarta-landing', [ApotekJakartaController::class, 'UpdateCounterLanding']);
Route::post('ap-ph-jakarta-button', [ApotekJakartaController::class, 'ButtonClick']);
Route::get('ap-ph-jakarta-wording', [ApotekJakartaController::class, 'GetWordingCampaign']);

Route::get('/products', [ApotekJakartaController::class, 'Products']);

Route::post('homelab', [HomeLabController::class, 'UpdateCounterLanding']);
Route::get('homelab-wording', [HomeLabController::class, 'GetWordingCampaign']);
Route::post('homelab-logs-button', [HomeLabController::class, 'ButtonClick']);


Route::post('/pharmacybali/log-landing', [PharmacyBaliController::class, 'UpdateCounterLanding']);
Route::post('/pharmacybali/log-button', [PharmacyBaliController::class, 'ButtonClick']);
Route::get('/pharmacybali/campaign-wording-prewritten', [PharmacyBaliController::class, 'GetWordingCampaign']);

Route::post('/dengue/log-landing', [DengueController::class, 'UpdateCounterLanding']);
Route::post('/dengue/log-button', [DengueController::class, 'ButtonClick']);
Route::get('/dengue/campaign-wording-prewritten', [DengueController::class, 'GetWordingCampaign']);

Route::prefix('whitening')->controller(WhiteningController::class)->group(function () {
    Route::post('/log-landing', 'UpdateCounterLanding');
    Route::post('/log-button', 'ButtonClick');
    Route::get('/campaign-wording-prewritten', 'GetWordingCampaign');
});

Route::prefix('whitening-dot-clinic')->controller(WhiteningDotClinicController::class)->group(function () {
    Route::post('/log-landing', 'UpdateCounterLanding');
    Route::post('/log-button', 'ButtonClick');
    Route::get('/campaign-wording-prewritten', 'GetWordingCampaign');
});

Route::prefix('jakarta-homelab')->controller(JakartaHomeLabController::class)->group(function () {
    Route::post('/log-landing', 'UpdateCounterLanding');
    Route::post('/log-button', 'ButtonClick');
    Route::get('/campaign-wording-prewritten', 'GetWordingCampaign');
});

