<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $products = [
            ['name'=>'labtop Dell inspiron 15 5000 Series' , 'image'=>"" , 'price'=> "10000" , 'stock'=> "" ,'count'=>'20', 'color'=> 'black'],
            ['name'=>'headphone apple' , 'image'=>"" , 'price'=> "1000" , 'stock'=> "" ,'count'=>'10', 'color'=> 'red'],
            ['name'=>'canon camera ' , 'image'=>"" , 'price'=> "25000" , 'stock'=> "" ,'count'=>'15', 'color'=> 'black'],
            ['name'=>'Smartwatch apple' , 'image'=>"" , 'price'=> "4000" , 'stock'=> "" ,'count'=>'25', 'color'=> 'yellow']
        ];


        return view('admin.pages.products')->with('products',$products);
    }
}
