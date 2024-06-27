<?php

use Illuminate\Support\Facades\Route;

Route::view("/", "index")->name("index");
Route::view("/cms", "cms")->name("cms");
Route::view('/auth', "auth")->name("auth");
