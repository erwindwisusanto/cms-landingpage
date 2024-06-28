<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::view('/', "auth")->name("auth");
Route::post("signin", [MainController::class, 'auth'])->name("signin");
Route::post('/logout', [MainController::class, 'logout'])->name('logout');

Route::view("/dashboard", "index")->name("index")->middleware('auth');
Route::view("/cms", "cms")->name("cms")->middleware('auth');

Route::post("/add-campaign", [MainController::class, "addCampaign"])->name("add-campign")->middleware("auth");
Route::get("/campaign/{source}", [MainController::class, "campaigns"])->name("campaigns")->middleware("auth");
