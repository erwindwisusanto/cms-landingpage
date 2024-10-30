<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', "auth")->name("auth");
Route::post("signin", [MainController::class, 'auth'])->name("signin");
Route::post('/logout', [MainController::class, 'logout'])->name('logout');

Route::view("/dashboard", "index")->name("index")->middleware('auth');
Route::view("/cms", "cms")->name("cms")->middleware('auth');

Route::post("/add-campaign", [MainController::class, "addCampaign"])->name("add-campign")->middleware("auth");
Route::get("/campaigns/{source}", [MainController::class, "campaigns"])->name("campaigns")->middleware("auth");
Route::get("/campaignsLog/{source}", [MainController::class, "campaignsLog"])->name("campaignslogs")->middleware("auth");
Route::post("/delete-campaign", [MainController::class, "deleteCampaign"])->name("delete-campaign")->middleware("auth");
Route::post("/update-campaign", [MainController::class, "updateCampaign"])->name("update-campaign")->middleware("auth");



