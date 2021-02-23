@extends('layouts.admin')
@section('content')

    <head>

{{--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">--}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <style>
            .btn.btn-danger{
                display: none !important;
            }
            .select-checkbox{
                display: none !important;
            }
        </style>
    </head>

{{--    @if(session()->has('message'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session()->get('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}


    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="/create">
                <span>+</span> Add
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
        </div>
        <form method="POST" id="frm_filter">
            @csrf
            <br>
            <div class="container">
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group row input-daterange">
                            <lable for="date" class="col-form-label"> From Date</lable>
                            <div class="col-sm-2">
                                <input type="date" class="form-control input-sm" id="from_date" name="from_date" required>
                            </div>
                            <lable for="date" class="col-form-label"> To Date</lable>
                            <div class="col-sm-2">
                                <input type="date" class="form-control input-sm" id="to_date" name="to_date" required>
                            </div>
                            <label for="permission">Destination</label>
                            <div class="col-sm-2">
                                <select name='filter_dist' class="form-control select2">
                                    <option selected="selected"></option>
                                    <option value="Cairo"> Cairo </option>
                                    <option value="Sharjah"> Sharjah </option>
                                    <option value="Aqaba"> Aqaba </option>
                                    <option value="Kuwait"> Kuwait </option>
                                    <option value="Cairo"> Baghdad </option>
                                </select>
                            </div>
                            <div class="col-sm-2 text-center center">
                                <button type="submit" class="btn btn-success btn-filter"> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="card-body text-center">
            <div class="table-responsive">
                <table id="table_records" class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>

                        <th>
                            Name
                        </th>
                        <th>
                            PNR
                        </th>
                        <th>
                            Destination
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Discount/Free
                        </th>
                        <th>
                            Total Price
                        </th>
                        <th>
                            Notes
                        </th>
                        <th>
                            &nbsp;Coupon
                        </th>
                        <th>
                            &nbsp; Delete
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)


                        <tr data-entry-id="{{ $record->id }}">
                            <td>

                            </td>

                            <td>
                                {{ $record->name ?? '' }}
                            </td>
                            <td>
                                {{ $record->pnr ?? '' }}
                            </td>
                            <td>
                                {{ $record->destination ?? '' }}
                            </td>
                            <td>
                                {{ $record->date ?? '' }}
                            </td>
                            <td>
                                {{ $record->discount ?? '' }}
                            </td>
                            <td>
                                {{ $record->total ?? '' }}
                            </td>
                            <td>
                                {{ $record->notes ?? '' }}
                            </td>
                            <td>
                                <div class="flex" style="display: flex;flex-direction: row; justify-content: space-around">
                                <!-- Button trigger modal -->
                                <form action="/couponsubmit/{{ $record->id ?? ''}}" method="post">
                                    @csrf
                                    <div class="flex" style="display: flex; flex-direction: row; justify-content: start">
                                        <div class="modal-body">
                                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter Coupon {{ $record->id ?? '' }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </form>

                                </div>
                            </td>
                            <td>
                                @can('users_manage')
                                    <a href="recorddelete/{{ $record->id }}" class="btn btn-secondary" style="background-color: #f86c6b;">Delete</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/couponsubmit/{{ $record->id ?? ''}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <label for="">Enter Coupon</label>
                                <input type="text" name="coupon_code" id="coupon_code" placeholder="{{ $record->id ?? '' }}">
                            </div>
                            <div class="modal-footer">
                                {{--                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>--}}
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('delete') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

        $('#frm_filter').on('submit',function (e) {

            var formContent = $(this).serialize();
            console.log(formContent);
            var url = $('meta[name=base_url]').attr('content');

            $.ajax({

                url:url+'/getFilterData',
                method:"POST",
                data:formContent,

                success:function (response) {
                    if(response.status == 200){
                        $('#table_records tbody').empty();

                        $.each(response.records, function (i,item) {

                            $('#table_records tbody').append('<tr>');
                            $('#table_records tbody').append('<td>'+response.records[i].name+'</td>');
                            $('#table_records tbody').append('<td>'+response.records[i].pnr+'</td>');
                            $('#table_records tbody').append('<td>'+response.records[i].destination+'</td>');
                            $('#table_records tbody').append('<td>'+response.records[i].date+'</td>');
                            $('#table_records tbody').append('<td>'+response.records[i].discount+'</td>');
                            $('#table_records tbody').append( '<td>'+response.records[i].total+'</td>');
                            $('#table_records tbody').append('<td>'+response.records[i].notes+'</td>');
                            $('#table_records tbody').append('<td>'+ '<form method="post" action="couponsubmit/'+response.records[i].id+'">' +
                                '<label for="">Enter Coupon</label>'+ '<input type="text" name="coupon_code" id="coupon_code">' + '<div class="modal-footer">'+ '<button type="submit" class="btn btn-primary">'+'Apply'+'</button>'+ '</div>'
                                + '</form>' + '</td>');
                            $('#table_records tbody').append('<td>'+'<a class="btn btn-secondary" style="background-color: #f86c6b;" href="recorddelete/'+response.records[i].id+'" >'+'Delete'+'</a>'+ '</td>')

                            $('#table_records tbody').append('</tr>');

                        });
                    }
                },

                error:function (xhr) {
                    console.log(xhr.responseText);
                }

            });

            return false;
            e.preventDefault();
        })




    </script>
@endsection