<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {

        $products = DB::table('products')->get();
        $catgs = DB::table('categories')->get();



        return view('admin.pages.products')->with([
            'products' => $products,
            'catgs' => $catgs
        ]);
    }


    public function addProduct(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|min:1|max:100',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string',
            'category' => 'required|string',
            'stock' => 'required|string',
            'featured' => 'required|boolean',
        ]);

        $product = new Product();


        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->price = $request->input('price');
        $product->sale_price = $request->input('sale_price');
        $product->quantity = $request->input('quantity');
        $product->desc = $request->input('desc');
        $product->stock = $request->input('stock');
        $product->featured = $request->input('featured');
        $product->image = "product.png";
        $product->images = Null;
        $product->cat_id = $request->input('category');

        try {
            $product->save();
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    public function Productdetails(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {
            $validated = $request->validate([
                'id' => 'required|numeric',
            ]);

            $product = Product::findOrFail($request->input('id'));
            return $product;
        }
    }

    public function Productedit(Request $request)
    {

        //return $request->input();
        if ($request->isMethod('post') && $request->ajax()) {
            $validated = $request->validate([
                'product_id' => 'required|numeric',
                'name' => 'required|string|min:1|max:100',
                'price' => 'required|numeric',
                'sale_price' => 'nullable|numeric',
                'quantity' => 'required|numeric',
                'desc' => 'required|string',
                'category' => 'required|string',
                'stock' => 'required|string',
                'featured' => 'required|boolean',
            ]);
        }


        $product = Product::findOrFail($request->input('product_id'));

        if ($product) {
            $product->name = $request->input('name');
            $product->slug = Str::slug($request->input('name'));
            $product->price = $request->input('price');
            $product->sale_price = $request->input('sale_price');
            $product->quantity = $request->input('quantity');
            $product->desc = $request->input('desc');
            $product->cat_id = $request->input('category');
            $product->stock = $request->input('stock');
            $product->featured = $request->input('featured');
        }

        try {
            $product->save();
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
}
