<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Product;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code',  $request->coupon_code)->first();
        
        if ($coupon->type == 'fixed')
        {
            $discountcoupon = $coupon->value;
        }
        else
        {
            $discountcoupon = ($coupon->percent_off / 100) * $request->total_price;
        }
        
        //var_dump($coupon->percent_off);
        if (!$coupon) 
          {
            return redirect()->back()->with('success','Invalid Coupon');
          }

        session()->put('coupon', [
            'namecoupon'=>$coupon->code,
            'discountcoupon'=>$discountcoupon,
        ]); 

        return redirect()->back()->with('success', 'Coupon Applied');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
