<?php
namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CampaignService
{
    private $tableCampaign = "campaign";

    public function checkCampName($campaign, $source) {
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

    public function updateRecordLog($recordId, $visit, $tableName) {
        $count = 1;

        $queryUpdate = DB::table($tableName)
                            ->where('id', $recordId)
                            ->update(['total' => $visit + $count]);

        return $queryUpdate;
    }

    public function newRecordLog($campaign, $url, $source, $tableName) {
        $count = 1;
        $today = Carbon::today();

        $query = DB::table($tableName)->insert([
                        'campaign' => $campaign,
                        'source_url' => $url,
                        'source' => $source,
                        'total' => $count,
                        'date' => $today
                    ]);

        return $query;
    }
}
