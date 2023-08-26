<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::query();
        $catgs = Category::get();

        $products = $this->filtering($products, $request);

        $products = $products->paginate(12);

        return view('pages.shop')->with(['products' => $products, 'catgs' => $catgs]);
    }

    public function shopByCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categories = Category::get();

        $products = Product::where('cat_id', $category->id);

        $products = $this->filtering($products, $request);


        $products = $products->paginate(12);

        return view('pages.shop')->with(['products' => $products, 'catgs' => $categories]);
        
    }

    public function search(Request $request)
    {

        $products = Product::where('name', 'LIKE', '%' . $request->q . '%');
        $catgs = Category::get();

        $products = $this->filtering($products, $request);


        $products = $products->paginate(12);

        return view('pages.shop')->with(['products' => $products, 'catgs' => $catgs]);
    }


    function filtering($products, $request)
    {
        if ($request->color) {
            $products = $products->where('color', $request->color);
        }

        if ($request->size) {
            $products = $products->where('size', $request->size);
        }


        if ($request->minprice) {
            $products = $products->whereBetween('price', [$request->minprice, $request->maxprice]);
        }


        return $products;
    }
}
