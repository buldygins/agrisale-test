<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOffer;
use App\Models\ProductVariation;
use DataTables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductData(Request $request)
    {
        $request = $request->all();
        unset($request['_token']);
        $query = ProductVariation::query();
        foreach ($request as $field => $value){
            $query->where($field,$value);
        }
        $product_variation = $query->first();
        if (!$product_variation){
            return response()->json('Такой продукт не найден', 200, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->json($product_variation->getData(), 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getProductPrices(Product $product)
    {
        $offers = ProductOffer::query()
            ->join('dealers', 'dealers.id', 'dealer_id')
            ->with(['dealer', 'product_variation'])
            ->whereIn('product_variation_id', $product->variations->pluck('id'), 'or')
            ->select([
                'product_offers.*',
                'dealers.*',
                'product_offers.id as id'
            ]);
        return Datatables::eloquent($offers)
            ->addIndexColumn()
            ->addColumn('action', function ($offer) {
                return '<button class="btn btn-primary show-product-offer-id" data-id="'.$offer->id.'">Показать id</button>';
            })
            ->make(true);
    }
}
