@extends('layouts.admin')
@section('content')


{{--    @if(session()->has('message'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session()->get('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}



    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
        </div>

        <div class="card-body">
            <form action="pendingsubmit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label for="">PNR</label>
                    <input class="form-control" type="text" name="pnr" required>
                </div>
                    <div class="form-group">
                    <label for="permission">Destination</label>
                    <select name='destination' class="form-control select2" required>
                        <option selected="selected"></option>
                        <option value="Cairo"> Cairo </option>
                        <option value="Sharjah"> Sharjah </option>
                        <option value="Aqaba"> Aqaba </option>
                        <option value="Kuwait"> Kuwait </option>
                        <option value="Cairo"> Baghdad </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Date</label>
                    <input  class="form-control" type="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="">Discount/Free</label>
                    <select name='discount' class="form-control select2"  required>
                        <option selected="selected"></option>
                        <option value="Discount"> Discount </option>
                        <option value="Free"> Free </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Total Price</label>
                    <input class="form-control col-md-4" type="text" name="total" required>
                </div>
                <div class="form-group">
                    <label for="">Notes</label>
                    <input class="form-control" type="text" name="notes" required>
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit"> Submit</button>
                </div>
            </form>


        </div>
    </div>
@endsection