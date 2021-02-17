<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Record;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{


    public function index(){
        return view('coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
       $coupon = new Coupon();
       $coupon->code = $req->code;
       $coupon->amount = $req->amount;
       $coupon->save();

       return redirect('couponshow')->with('message', 'Coupon was created successfully');
    }

    public function show(){
        $data = Coupon::all();
        return view('coupon' , ['coupons'=> $data]);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id){
        DB::delete('delete from coupons  where id = ?',[$id]);
        return redirect('couponshow')->with('message', 'Coupon was Deleted');
    }

    public function couponsub(Request $req , $id){

        $coupon = Coupon::where('code' , $req->coupon_code)->first();
        if (!$coupon){
            return redirect('show')->withErrors('Invalid coupon code. Please try again');
        }
        $amount = $coupon->amount;
        $code = $coupon->code;

        $record = Record::wherein('id',[$id])->first();
        $total = $record->total;
        $final = $total - ($total * $amount/100);
        $newnotes = $record->notes.'  *(Discount'.$amount.'% was added)';

        $new = Record::find($req->id);
        $new->total = $final;
        $new->notes = $newnotes;
        $new->save();
        return redirect('/show')->with('message', 'Coupon ('.$code.') was added successfully');
    }
}
