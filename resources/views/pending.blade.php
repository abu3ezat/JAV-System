@extends('layouts.admin')
@section('content')
    @can('users_manage')
        <div class="card-body">
            <h2>Pending Records</h2>
            @foreach($pendings as $pen)
                <p>Record Number : {{ $pen->id ?? ''}}</p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pendingcard" style="background-color: #3097D1">
                                <p>Name : {{ $pen->name ?? '' }}</p>
                                <p>PNR : {{ $pen->pnr ?? '' }}</p>
                                <p>Destination : {{ $pen->destination ?? '' }}</p>
                                <p>Date : {{ $pen->date ?? '' }}</p>
                                <p>Discount/Free : {{ $pen->discount ?? '' }}</p>
                                <p>Total Price : {{ $pen->total ?? '' }}</p>
                                <p>Notes : {{ $pen->notes ?? '' }}</p>
                                <a style="margin: 0 20px 0 20px" href="pendingaccept/{{$pen->id}}" class="btn btn-success">Accept</a>
                                <a style="margin: 0 20px 0 20px" href="pendingdelete/{{$pen->id}}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br><br><br>
    @endcan
@endsection
