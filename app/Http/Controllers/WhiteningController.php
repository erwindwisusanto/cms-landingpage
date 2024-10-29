<?php

namespace App\Http\Controllers;

use App\Http\Services\CampaignService;
use Illuminate\Http\Request;

class WhiteningController extends Controller
{
    protected $campaignService;
    private $tableName = "whitening_clinic";

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function UpdateCounterLanding(Request $request)
    {
        $url = $request->url;
        $source = $request->source;
        $campaign = $request->campaign ?? "organic";

        $isValidCampaign = $this->campaignService->checkCampName($campaign, $source);

        if ($isValidCampaign || $campaign === "organic") {

            $visit = $this->campaignService->checkRecordLog($campaign, $source, $this->tableName);
            $message = "error !!!";

            if ($visit) {
                $this->campaignService->updateRecordLog($visit->id, $visit->total, $this->tableName);
                $message = "update record";
            } else {
                $this->campaignService->newRecordLog($campaign, $url, $source, $this->tableName);
                $message = "new record";
            }

            return response()->json(["message" => "[VALID CAMPAIGN] $message"], 201);
        } else {
            return response()->json(["message" => "[INVALID CAMPAIGN] counter update failed"], 400);
        }
    }
}
