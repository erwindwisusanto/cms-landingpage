<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class MainController extends Controller
{
    public function auth(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return response()->json(["status" => true, "message" => "success"]);
        }

        return response()->json(["status" => false, "message" => "error"]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth');
    }

    public function addCampaign(Request $request)
    {
        $campaignName = $request->input('name');
        $whatsAppWording = $request->input('wa_word');
        $source = $request->input('source');

        DB::table('campaign')->insert([
            'source' => $source,
            'name' => $campaignName,
            'whatsapp_wording' => $whatsAppWording,
            'created_by' => auth()->user()->username,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['status' => true, 'message' => 'Campaign added successfully']);
    }

    public function campaigns(Request $request, $source)
    {
        $return = [];
        $datas = DB::table('campaign')
            ->select('*')
            ->where('source', $source)
            ->orderBy('created_at', 'desc')
            ->get();

        for ($i = 0; $i < count($datas); $i++) {
            $data = $datas[$i];
            $return[] = [
                'row_number' => $i + 1,
                'id' => $data->id,
                'name' => $data->name,
                'wa_word' => $data->whatsapp_wording,
                'created_by' => $data->created_by,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ];
        }

        return DataTables::of($return)->make(true);
    }
}
