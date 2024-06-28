<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::view("/", "index")->name("index");
Route::view("/cms", "cms")->name("cms");
Route::view('/auth', "auth")->name("auth");

Route::get("/campigns", [MainController::class, 'campaigns'])->name("campigns");
