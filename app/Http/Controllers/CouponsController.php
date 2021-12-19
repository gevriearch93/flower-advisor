<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;

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
        
        $current = Carbon::now();
        $today = Carbon::today();
        //var_dump($today);

        $dt = Carbon::now();

        $tampung = $dt->addHour(7);
        $currenttime = $tampung->format('h:i');
        //echo $dt->format('l');
        if ($coupon->code == 'FA444' && $dt->format('l') !== 'Tuesday')
        {
            return redirect()->back()->with('success','Invalid coupon. Coupon can be used in Tuesday 13:00 - 15:00');
        }       
        elseif ($coupon->code == 'FA333' && $request->total_price < 400000)
        {
            return redirect()->back()->with('success','Invalid coupon. Minimum Order 400.000');
        }
        else
        {
            if ($coupon->type == 'fixed')
                {
                    $discountcoupon = $coupon->value;
                }
                else
                {
                    $discountcoupon = ($coupon->percent_off / 100) * $request->total_price;
                }
            
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
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Session()->forget('coupon');
        return redirect()->back()->with('success', 'Coupon Removed');
    }
}
