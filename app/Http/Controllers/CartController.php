<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Error;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    public function index()
    {


        //Cart::instance('cart')->destroy();
        //Cart::instance('cart')->add(150,'product 1',1, 4000)->associate('App\Models\Product');

        //return Cart::instance('cart')->content();
        return view('pages.cart');
    }

    public function updateCart(Request $request)
    {

        if ($request->isMethod('post') && $request->ajax()) {
            try {
                $cart = Cart::instance('cart')->update($request->rowId, intval($request->qty));

                return response()->json([
                    $cart->subtotal,
                    Cart::instance('cart')->subtotal(),
                    Cart::instance('cart')->total(),
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
    public function addToCart(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {

            try {
                Cart::instance('cart')->add($request->id, $request->name, $request->qty , $request->price)->associate('App\Models\Product');

                return Cart::instance('cart')->content()->count();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public function deleteItem(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {

            try {
                Cart::instance('cart')->remove($request->rowId);

                return response()->json([
                    Cart::instance('cart')->subtotal(),
                    Cart::instance('cart')->total(),
                    Cart::instance('cart')->content()->count(),
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
    public function clearCart()
    {
        try {

            Cart::instance('cart')->destroy();

            return response()->json(true);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function applyCoupon(Request $request)
    {

        $total = preg_replace('/,/i' ,'' ,Cart::instance('cart')->total());

        $coupon = Coupon::where('code', $request->coupon)->first();


        if ($coupon) {
            if ($coupon->expire_date > Carbon::now()) {
                if ($total >= $coupon->cart_value) {

                    session()->put('coupon', $coupon);

                    return response()->json(true);
                    
                    
                } else {
                    return 'increase the cart value';
                }
            } else {
                return 'coupon expired';
            }
        } else {
            return 'this coupon does not exist';
        }
    }
}
