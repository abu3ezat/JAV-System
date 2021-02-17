<?php

namespace App\Http\Controllers;

use App\Pending;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendingController extends Controller
{


    public function pendingsubmit(Request $req){
        $pendings = new Pending();

        $pendings->name = $req->name;
        $pendings->pnr = $req->pnr;
        $pendings->destination = $req->destination;
        $pendings->date = $req->date;
        $pendings->discount = $req->discount;
        $pendings->total = $req->total;
        $pendings->notes = $req->notes;
        $pendings->save();

        return redirect('show');
    }

    public function pendingshow(){
        $pen = Pending::all();
        return view('pending' , ['pendings'=> $pen]);
    }

    public function move($id){

        $first = Pending::wherein('id', [$id])->first();

//        return $first->name;

        $name = $first->name;
        $pnr = $first->pnr;
        $destination = $first->destination;
        $date = $first->date;
        $discount = $first->discount;
        $total = $first->total;
        $notes = $first->notes;
        $first->delete;

        DB::delete('delete from pendings where id = ?',[$id]);


        $record = new Record();
        $record->name = $name;
        $record->pnr = $pnr;
        $record->destination = $destination;
        $record->date = $date;
        $record->discount = $discount;
        $record->total = $total;
        $record->notes = $notes;
        $record->save();



        return redirect('/pendingshow')->with('message', 'Record was accepted , go to the records table to view it');
    }

    public function delete($id){
        DB::delete('delete from pendings where id = ?',[$id]);
        return redirect('/pendingshow')->with('message', 'record was deleted successfully');
    }

    public function notify(){
        $count = Pending::count();
        return redirect('/pendingshow' ,  ['count'=>$count]);
    }

}
