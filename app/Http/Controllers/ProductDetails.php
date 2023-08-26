<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function addReview(Request $request, $productId)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'comment' => 'required|string'
        ]);
        $review = new Review();

        $review->user_id = Auth::user()->id;
        $review->product_id = $productId;
        $review->rate = $request->rate;
        $review->review = $request->comment;

        $review->save();

        return response()->json(true);
        
    }
}
