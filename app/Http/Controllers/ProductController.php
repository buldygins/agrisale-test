<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOffer;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProductController extends Controller
{

    public function getProductList()
    {
        $products = Product::all();
        $options = ProductVariation::query()->select('option')->distinct()->get()->pluck('option');
        $units = ProductVariation::query()->select('unit')->distinct()->get()->pluck('unit');
        return view('product.all',compact('products','options','units'));
    }

    public function getProduct(Product $product)
    {
        return view('product.price-list',compact('product'));
    }
}
