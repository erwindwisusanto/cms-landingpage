<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MainController extends Controller
{
    public function campaigns() {
        $campaigns = DB::table("campign")->get();
        dd($campaigns);
    }
}
