<?php

namespace App\Http\Controllers;

use App\Http\Services\ShopService;
use App\Models\Campaign;
use App\Models\ModelApPhJakarta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApotekJakartaController extends Controller
{
    protected $shopService;
    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

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
            $visit = ModelApPhJakarta::whereDate('date', $today)
                ->where('campaign', $campaign)
                ->where('source', $source)
                ->first();

            if ($visit) {
                $visit->source_url = $url;
                $visit->total += $count;
                $visit->save();
            } else {
                $visit = new ModelApPhJakarta();
                $visit->campaign = $campaign;
                $visit->source_url = $url;
                $visit->source = $source;
                $visit->total = $count;
                $visit->date = $today;
                $visit->save();
            }

            return response()->json(['message' => 'valid campaign'], 200);
        } else {
            return response()->json(['message' => 'invalid campaign'], 400);
        }
    }

    public function ButtonClick(Request $request)
    {
        $count = 1;
        $today = Carbon::today();
        $type = $request->input('type');
        $source = $request->input('source');
        $campaign = $request->input('campaign') ?? "organic";

        $isValidCampaign = Campaign::where('name', $campaign)
            ->where('source', $source)
            ->select('id')
            ->first();

        if ($isValidCampaign || $campaign === "organic") {
            $camplog = ModelApPhJakarta::whereDate('date', $today)
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

            return response()->json(['message' => 'valid campaign'], 200);
        } else {
            return response()->json(['message' => 'invalid campaign'], 500);
        }
    }

    public function GetWordingCampaign(Request $request) {
        $source = $request->source;
        $campaign = !empty($request->campaign) ? $request->campaign : 'organic';
        $locale = $request->locale;

        $camp = Campaign::where('name', $campaign)
                ->when($campaign === 'organic', function ($query) use ($locale) {
                    return $query->where('locale', $locale);
                })
                ->where('source', $source)
                ->select('whatsapp_wording')->first();

        if ($camp || $camp === "organic") {
            return response()->json(['wording' => $camp, 'message' => 'success'], 200);
        }

        return response()->json(['wording' => null, 'message' => 'success'], 404);
    }

    public function Products(Request $request) {
        $searchProducts = $request->search_products;
        $sortPrice = $request->sort_price;
        $filterCategory = $request->category;

        $products = $this->shopService->GetProducts($searchProducts, $sortPrice, $filterCategory);

        if (empty($products)) {
          return response()->json(['data' => null, 'success' => false]);
        }

        return response()->json(['message' => true, 'data' => $products]);
    }
}
