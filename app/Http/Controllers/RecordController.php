<?php

namespace App\Http\Controllers;

use App\Pending;
use App\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class RecordController extends Controller
{
    public  function create(){
        return view('record.create');
    }

    public function submit(Request $req){
        $record = new Record();

        $record->name = $req->name;
        $record->pnr = $req->pnr;
        $record->destination = $req->destination;
        $record->date = $req->date;
        $record->discount = $req->discount;
        $record->total = $req->total;
        $record->notes = $req->notes;
        $record->save();

        return redirect('show')->with('message', 'Record Created Successfully , Waiting for the administrator approval ');
    }


    public function show(){
        $data = Record::all();
        return view('record.index' , ['records'=>$data]);
    }


    public function massDestroy(Request $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function delete($id){
//       $delete = Record::wherein('id', [$id])->first();
        DB::delete('delete from records where id= ?', [$id]);

        return redirect('show')->with('message', 'record was deleted successfully');
    }



}
