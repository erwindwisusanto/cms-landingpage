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
        $locale = $request->input('locale');
        $source = $request->input('source');
        $campaignName = $request->input('name');
        $whatsAppWording = $request->input('wa_word');

        DB::table('campaign')->insert([
            'source' => $source,
            'name' => $campaignName,
            'locale' => $locale,
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
                'locale' => $data->locale,
                'name' => $data->name,
                'wa_word' => $data->whatsapp_wording,
                'created_by' => $data->created_by,
                'created_at' => Carbon::parse($data->created_at)->format('d-m-Y'),
                'updated_at' => Carbon::parse($data->updated_at)->format('d-m-Y'),
            ];
        }

        return DataTables::of($return)->make(true);
    }

    public function campaignsLog(Request $request, $source)
    {

        if ($source == "pharmacy_jakarta" || $source == "apotek_jakarta") {
            $return = $this->pharmacyAndApotekJakarta($source);
        } else if ($source === "balihomelab") {
            $return = $this->baliHomeLab($source);
        } else if ($source === "pharmacy_bali") {
            $return = $this->pharmacybaliLog($source);
        } else {
            $return = $this->NonPharmacyAndApotekJakarta($source);
        }

        return DataTables::of($return)->make(true);
    }

    private function NonPharmacyAndApotekJakarta($source)
    {
        $return = [];
        $datas = DB::table('campaign_logs')
            ->select('*')
            ->where('source', $source)
            ->orderBy('date', 'desc')
            ->get();

        for ($i = 0; $i < count($datas); $i++) {
            $data = $datas[$i];
            $return[] = [
                'row_number' => $i + 1,
                'id' => $data->id,
                'campaign_name' => $data->campaign_name,
                'visit_landingpage' => $data->visit_landingpage,
                'whatsapp_hit' => !empty($data->whatsapp_hit) ? $data->whatsapp_hit : 0,
                'telegram_hit' => !empty($data->telegram_hit) ? $data->telegram_hit : 0,
                'source_url' => $data->source_url,
                'date' => $data->date,
            ];
        }

        return $return;
    }

    private function pharmacyAndApotekJakarta($source)
    {
        $return = [];
        $datas = DB::table('ap_ph_jakarta_landing_logs')
            ->select('*')
            ->where('source', $source)
            ->orderBy('date', 'desc')
            ->get();

        for ($i = 0; $i < count($datas); $i++) {
            $data = $datas[$i];
            $return[] = [
                'row_number' => $i + 1,
                'id' => $data->id,
                'campaign_name' => $data->campaign,
                'visit_landingpage' => $data->total,
                'whatsapp_hit' => !empty($data->wa_clicks) ? $data->wa_clicks : 0,
                'telegram_hit' => !empty($data->telegram_clicks) ? $data->telegram_clicks : 0,
                'source_url' => $data->source_url,
                'date' => $data->date,
            ];
        }

        return $return;
    }

    private function baliHomeLab($source)
    {
        $return = [];
        $datas = DB::table('homelab_logs')
            ->select('*')
            ->where('source', $source)
            ->orderBy('date', 'desc')
            ->get();

        for ($i = 0; $i < count($datas); $i++) {
            $data = $datas[$i];
            $return[] = [
                'row_number' => $i + 1,
                'id' => $data->id,
                'campaign_name' => $data->campaign,
                'visit_landingpage' => $data->total,
                'whatsapp_hit' => !empty($data->wa_clicks) ? $data->wa_clicks : 0,
                'telegram_hit' => !empty($data->telegram_clicks) ? $data->telegram_clicks : 0,
                'source_url' => $data->source_url,
                'date' => $data->date,
            ];
        }

        return $return;
    }

    private function pharmacybaliLog($source)
    {
        $return = [];
        $datas = DB::table('pharmacybali_log')
            ->select('*')
            ->where('source', $source)
            ->orderBy('date', 'desc')
            ->get();

        for ($i = 0; $i < count($datas); $i++) {
            $data = $datas[$i];
            $return[] = [
                'row_number' => $i + 1,
                'id' => $data->id,
                'campaign_name' => $data->campaign,
                'visit_landingpage' => $data->total,
                'whatsapp_hit' => !empty($data->wa_clicks) ? $data->wa_clicks : 0,
                'telegram_hit' => !empty($data->telegram_clicks) ? $data->telegram_clicks : 0,
                'source_url' => $data->source_url,
                'date' => $data->date,
            ];
        }

        return $return;
    }

    public function deleteCampaign(Request $request) {
        $campaignId = $request->input('campaign_id');
        $deleted = DB::table('campaign')->where('id', $campaignId)->delete();

        if (!$deleted) {
            return response()->json(['status' => false, 'message' => 'failed delete campaign']);
        }

        return response()->json(['status' => true, 'message' => 'campaign delete successfully']);
    }

    public function updateCampaign(Request $request) {
        $campaignName = $request->input('update-name');
        $whatsAppWording = $request->input('update-wa_word');
        $campId = $request->input('campaign-id');

        $updated = DB::table('campaign')
                    ->where('id', $campId)
                    ->update([
                        'name' => $campaignName,
                        'whatsapp_wording' => $whatsAppWording,
                        'updated_at' => Carbon::now(),
                    ]);

        if (!$updated) {
            return response()->json(['status' => false, 'message' => 'failed updated campaign']);
        }

        return response()->json(['status' => true, 'message' => 'campaign update successfully']);
    }
}
