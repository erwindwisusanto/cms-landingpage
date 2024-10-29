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

            if ($visit) {
                $this->campaignService->updateRecordLog($visit->id, $visit->total, $this->tableName);
                $message = "update record successfully";
            } else {
                $this->campaignService->newRecordLog($campaign, $url, $source, $this->tableName);
                $message = "new record successfully";
            }

            return response()->json(["message" => "[VALID CAMPAIGN] $message"], 201);
        } else {
            return response()->json(["message" => "[INVALID CAMPAIGN] counter update failed"], 400);
        }
    }

    public function ButtonClick(Request $request)
    {
        $type = $request->type;
        $source  = $request->source;
        $campaign = $request->campaign ?? "organic";

        $isValidCampaign = $this->campaignService->checkCampName($campaign, $source);


        if ($isValidCampaign || $campaign === "organic") {
            $campLog = $this->campaignService->checkRecordLog($campaign, $source, $this->tableName);

            if ($campLog) {
                $urbc = $this->campaignService->updateRecordButtonClick($campLog->id, $type, $this->tableName);

                if ($urbc) {
                    return response()->json(["message" => "Button click recorded successfully"], 201);
                } else {
                    return response()->json(["message" => "Button click recorded failed"], 500);
                }
            } else {
                return response()->json(["message" => "Log record not found for the specified campaign and source"], 404);
            }
        } else {
            return response()->json(["message" => "Invalid campaign or source provided."], 400);
        }
    }

    public function GetWordingCampaign(Request $request)
    {
        $source = $request->source;
        $locale = $request->locale;
        $campaign = !empty($request->campaign) ? $request->campaign : 'organic';

        $wording = $this->campaignService->wording($campaign, $source, $locale);

        if ($wording) {
            return response()->json([
                "wording" => $wording,
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "wording" => null,
                "message" => "No wording found for the specified campaign and source."
            ], 400);
        }
    }
}
