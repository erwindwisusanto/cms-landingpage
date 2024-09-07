<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscooterController extends Controller
{
    public function UpdateCounterLanding() {
        $date = Carbon::today();
        $camp = 'organic';

        try {
            DB::table('escooter_landing_logs')->updateOrInsert(
                ['date' => $date, 'camp' => $camp],
                ['total' => DB::raw('COALESCE(total, 0) + 1')]
            );

            return response()->json(['message' => 'Counter updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function UpdateCounterButton(Request $request) {
        $date = Carbon::today();
        $camp = 'organic';
        $type = $request->input('type');
        $model = $request->input('model');

        try {
            DB::table('escooter_wa_logs')->updateOrInsert(
                ['date' => $date, 'camp' => $camp, 'type' => $type, 'model' => $model],
                ['total' => DB::raw('COALESCE(total, 0) + 1')]
            );

            return response()->json(['message' => 'Counter updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
