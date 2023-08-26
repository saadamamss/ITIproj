<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featured = Product::where('featured', 1)->limit(8)->get();
        $popular = Product::where('rating', '>=', 3)->limit(8)->get();
        $newadded = Product::orderBy('created_at')->limit(8)->get();
        
        $popularcat = Category::limit(12)->get();


        return view('home')->with([
            'featured' => $featured,
            'popular' => $popular,
            'newadded' => $newadded,
            'popularcat' => $popularcat
        ]);
    }
}
