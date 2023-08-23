<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(): View
    {

        $coupons = Coupon::get();
        return view('admin.pages.coupons')->with(['coupons' => $coupons]);
    }


    public function store(Request $request)
    {


        $request->validate([
            'code' => 'required|string',
            'type' => 'required|string',
            'coupon_val' => 'required|numeric',
            'cart_val' => 'required|numeric',
            'exp_date' => 'required|date',
        ]);

        try {
            $coupon = new Coupon();
            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->value = $request->coupon_val;
            $coupon->cart_value = $request->cart_val;
            $coupon->expire_date = $request->exp_date;

            $coupon->save();

            return redirect()->route('coupons.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function update(Request $request)
    {


        $request->validate([
            'code' => 'required|string',
            'type' => 'required|string',
            'coupon_val' => 'required|numeric',
            'cart_val' => 'required|numeric',
            'exp_date' => 'required|date',
            'coupon_id' => 'required|numeric'
        ]);


        try {
            $coupon = Coupon::findOrFail($request->coupon_id);
            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->value = $request->coupon_val;
            $coupon->cart_value = $request->cart_val;
            $coupon->expire_date = $request->exp_date;

            $coupon->save();

            return redirect()->route('coupons.index');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function destroy(Request $request)
    {

        if ($request->isMethod('delete') && $request->ajax()) {
            $request->validate(['id' => 'required|numeric']);

            try {
                Coupon::findOrFail($request->id)->delete();

                return response()->json(true);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(true);
            }
        }
        return $request->input();
    }
}
