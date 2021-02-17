<?php

namespace App\Http\Controllers;

use App\Record;
use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Test::where('code' , $request->coupon_code)->first();
         if (!$coupon){
             return redirect('show')->withErrors('Invalid coupon code. Please try again');
         }

         session()->put('coupon', [
             'name' => $coupon->code,
             'discount' => $coupon->discount($coupon),
         ]);

         return redirect('show')->with('success_message', 'Coupon Has been applied');

    }




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
