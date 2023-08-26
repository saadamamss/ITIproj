<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {

        if (Cart::instance('cart')->content()->count() > 0) {
            return view('pages.checkout');
        } else {
            return view('pages.cart');
        }
    }

    public function placeOrder(Request $request)
    {

        //return $request;
        try {

            // place order
            $order = new Order();
            $order->firstname = $request->fname;
            $order->lastname = $request->lname;
            $order->email = $request->email;
            $order->mobile = $request->phone;
            $order->country = $request->country;
            $order->city = $request->city;
            $order->line1 = $request->billing_address;
            $order->line2 = $request->billing_address2;
            $order->zipcode = $request->zipcode;

            $cart = Cart::instance('cart');

            $order->tax = preg_replace('/,/i', '', $cart->tax());
            
            if (session('coupon')) {
                if (session('coupon')->type === 'fixed') {
                    $discount = session('coupon')->value;
                } else {
                    $discount = (session('coupon')->value / 100) * $cart->total();
                }
                $order->discount = $discount;
            } else {
                $order->discount = 0;
            }

            $order->subtotal = preg_replace('/,/i', '', $cart->subtotal());
            $order->total = preg_replace('/,/i', '', $cart->subtotal());

            $userId = Auth::user()->id;
            $order->user_id = $userId;

            $order->save();

            // place transaction
            $trans = new Transaction();
            $trans->mode = $request->payment_option;
            $trans->status = 'pending';
            $trans->user_id = $userId;
            $trans->order_id = $order->id;

            $trans->save();

            
            //order items
            $items = $cart->content();
            foreach ($items as $key => $value) {
                $orderitem = new OrderItem();
                $orderitem->order_id = $order->id;
                $orderitem->product_id = $value->id;
                $orderitem->price = preg_replace('/,/i', '', $value->price);
                $orderitem->quantity = $value->qty;

                $orderitem->save();
            }

            // clear cart

            $cart->destroy();

            // flush coupon session

            if (session('coupon')) {
                session()->forget('coupon');
            }

            session()->put('thank-you', 'thank you for your order & Order ID:' . $order->id);

            return redirect()->route('cart');
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
