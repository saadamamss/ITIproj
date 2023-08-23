<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrders extends Controller
{
    public function index()
    {

        $orders = Auth::user()->orders;
        return view('pages.orders')->with(['orders' => $orders]);
    }
    public function orderDetails($id)
    {
        try {
            $orderitems = Auth::user()->orders->find($id)->orderitem;

            return view('pages.orderdetails')->with(['orderitems' => $orderitems]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
