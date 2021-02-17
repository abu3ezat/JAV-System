@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
        </div>

        <div class="card-body">
            <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Code</label>
                    <input class="form-control" type="text" name="code" id="code">
                    <label for="">Discount Amount</label>
                    <input class="form-control" type="text" name="amount" id="amount">
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit"> Submit</button>
                </div>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body text-center">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Code
                        </th>
                        <th>
                            Discount Amount
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $co)
                        <tr data-entry-id="{{ $co->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $co->id ?? '' }}
                            </td>
                            <td>
                                {{ $co->code ?? '' }}
                            </td>
                            <td>
                                {{ $co->amount ?? '' }}
                            </td>

                            <td>
                                <a href="coupondelete/{{ $co->id }}" class="btn btn-danger text-center" >Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
@endsection