<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ShopService
{
    public function GetProducts($searchProducts, $sortPrice, $category)
    {
      try {
        $cacheKey = 'products';

        $products = Cache::remember($cacheKey, now()->addHours(1), function () {
          return DB::table('product')->get();
        });

        $query = DB::table('product');

        if ($searchProducts) {
            $query->where(function($query) use ($searchProducts) {
                $query->where('name', 'like', '%' . $searchProducts . '%')
                      ->orWhere('type', 'like', '%' . $searchProducts . '%');
            });
        }

        if ($category) {
          $query->where('type', $category);
        }

        if ($sortPrice === 'low_to_high') {
          $query->orderBy('price', 'asc');
        } elseif ($sortPrice === 'high_to_low') {
          $query->orderBy('price', 'desc');
        }

        $products = $query->get();

        foreach ($products as $product) {
          $product->id = encryptId($product->id);
        }

        return $products;
      } catch (\Exception $e) {
        return [];
      }
    }
}
