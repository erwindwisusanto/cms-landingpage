<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\PharmacybaliLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PharmacyBaliController extends Controller
{
    public function UpdateCounterLanding(Request $request)
    {
        $count = 1;
        $today = Carbon::today();

        $url = $request->input('url');
        $source = $request->input('source');
        $campaign = $request->input('campaign') ?? "organic";

        $isValidCampaign = Campaign::where('name', $campaign)
            ->where('source', $source)
            ->select('id')
            ->first();

        if ($isValidCampaign || $campaign === "organic") {
            $visit = PharmacybaliLog::whereDate('date', $today)
                ->where('campaign', $campaign)
                ->where('source', $source)
                ->first();

            if ($visit) {
                $visit->source_url = $url;
                $visit->total += $count;
                $visit->save();
            } else {
                $visit = new PharmacybaliLog();
                $visit->campaign = $campaign;
                $visit->source_url = $url;
                $visit->source = $source;
                $visit->total = $count;
                $visit->date = $today;
                $visit->save();
            }

            return response()->json(['message' => '[VALID CAMPAIGN] counter update successfully'], 200);
        } else {
            return response()->json(['message' => '[INVALID CAMPAIGN] counter update failed'], 404);
        }
    }

    public function ButtonClick(Request $request)
    {
        $count = 1;
        $today = Carbon::today();

        $type = $request->input('type');
        $source  = $request->input('source');
        $campaign = $request->input('campaign') ?? "organic";

        $isValidCampaign = Campaign::where('name', $campaign)
            ->where('source', $source)
            ->select('id')
            ->first();

        if ($isValidCampaign || $campaign === "organic") {
            $camplog = PharmacybaliLog::whereDate('date', $today)
                ->where('campaign', $campaign)
                ->where('source', $source)
                ->first();

            if ($camplog) {
                if ($type === "whatsapp") {
                    $camplog->wa_clicks += $count;
                } elseif ($type === "telegram") {
                    $camplog->telegram_clicks += $count;
                }

                $camplog->save();
            }

            return response()->json(
                [
                    'message' => '[VALID CAMPAIGN] update button log successfully',
                    'success' => true
                ],
                200);
        } else {
            return response()->json(
                [
                    'message' => '[INVALID CAMPAIGN] update button log failed',
                    'success' => false
                ],
                404);
        }
    }

    public function GetWordingCampaign(Request $request)
    {
        $source = $request->source;
        $campaign = !empty($request->campaign) ? $request->campaign : 'organic';
        $locale = $request->locale;

        $camp = Campaign::where('name', $campaign)
            ->where('source', $source)
            ->when($campaign === 'organic', function ($query) use ($locale) {
                return $query->where('locale', $locale);
            })
            ->select('whatsapp_wording')
            ->first();

        if ($camp || $camp === "organic") {
            return response()->json(
                [
                    'wording' => $camp,
                    'message' => 'success'
                ],
                200);
        }

        return response()->json(
            [
                'wording' => null,
                'message' => 'failed'],
                404);
    }
}
