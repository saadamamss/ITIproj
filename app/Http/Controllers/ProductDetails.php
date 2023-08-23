<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductDetails extends Controller
{
    public function index($slug)
    {
        
        try {
            $product = Product::where('slug', $slug)->first();

            $relatedprod = Product::where('cat_id', $product->cat_id)->limit(4)->get();

            return view('pages.productdetails')->with(['product' => $product, 'relatedprod' => $relatedprod]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
