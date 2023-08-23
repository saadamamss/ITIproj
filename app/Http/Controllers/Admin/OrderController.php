<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::paginate(10);


        //return $orders;

        return view('admin.pages.orders')->with(['orders' => $orders]);
    }

    public function orderDetials($id)
    {
        try {
            $order = Order::findOrFail($id);

            return view('admin.pages.orderdetails')->with([
                'order' => $order

            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function orderStatus(Request $request)
    {
        try {
            $order = Order::findOrFail($request->orderId);
            $order->status = $request->status;
            $order->save();

            return response()->json(true);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
