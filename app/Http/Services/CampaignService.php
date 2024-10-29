<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CampaignService
{
    private $tableCampaign = "campaign";

    public function checkCampName($campaign, $source)
    {
        $camp = DB::table($this->tableCampaign)
            ->where("name", $campaign)
            ->where("source", $source)
            ->first();
        return $camp;
    }

    public function checkRecordLog($campaign, $source, $tableName)
    {
        $today = Carbon::today();

        $visit = DB::table($tableName)
            ->whereDate('date', $today)
            ->where('campaign', $campaign)
            ->where('source', $source)
            ->first();

        return $visit;
    }

    public function updateRecordLog($recordId, $visit, $tableName)
    {
        $count = 1;

        $queryUpdate = DB::table($tableName)
            ->where('id', $recordId)
            ->update(['total' => $visit + $count]);

        return $queryUpdate;
    }

    public function newRecordLog($campaign, $url, $source, $tableName)
    {
        $count = 1;
        $today = Carbon::today();

        try {
            $query = DB::table($tableName)->insert([
                'campaign' => $campaign,
                'source_url' => $url,
                'source' => $source,
                'total' => $count,
                'date' => $today
            ]);

            return $query;
        } catch (\Exception $e) {
            return "500";
        }
    }

    public function updateRecordButtonClick($recordId, $btnType, $tableName)
    {
        $count = 1;

        if ($btnType === "whatsapp") {
            $column = 'wa_clicks';
        } elseif ($btnType === "telegram") {
            $column = 'telegram_clicks';
        } else {
            return response()->json(["message" => "Invalid button type"], 400);
        }

        try {
            $record = DB::table($tableName)->where('id', $recordId)->first();

            if (!$record) {
                return response()->json(['message' => 'Record not found'], 404);
            }

            $newCount = $record->{$column} + $count;

            $updated = DB::table($tableName)
                ->where('id', $recordId)
                ->update([$column => $newCount]);

            return $updated
                ? response()->json(['message' => 'Record updated successfully'], 200)
                : response()->json(['message' => 'Failed to update record'], 500);
        } catch (\Exception $e) {
            return "500";
        }
    }

    public function wording($campaign, $source, $locale)
    {
        try {
            $camp = DB::table('campaign')
                ->where('name', $campaign)
                ->where('source', $source)
                ->when($campaign === 'organic', function ($query) use ($locale) {
                    return $query->where('locale', $locale);
                })
                ->select('whatsapp_wording')
                ->first();

            return $camp ? $camp->whatsapp_wording : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
