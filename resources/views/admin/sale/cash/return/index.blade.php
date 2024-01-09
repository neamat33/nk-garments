@extends('admin.admin-dashboard')
@section('extra_css')
<link href="{{asset('asset/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<style>
    @media print {
        body * {
            visibility: visible !important;
            color: #000 !important;
        }

        h4.card-title {
            color: #000 !important;
        }

        .print_hidden {
            display: none !important;
        }
    }
</style>
@endsection
@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <form action="#" method="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label"><strong>Customer Name</strong></label>
                                <input class="form-control" type="text" name="customer_name" autocomplete="off"
                                    value="{{ request('customer_name') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label"><strong>Customer Phone</strong></label>
                                <input class="form-control" type="text" name="phone" autocomplete="off"
                                    value="{{ request('phone') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label"><strong>Sale Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="sale_date"
                                    autocomplete="off" value="{{ request('sale_date') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label"><strong>Return Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="return_date"
                                    autocomplete="off" value="{{ request('return_date') }}">
                            </div>
                        </div>

                    </div>
                    <div class="row text-end">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                Filter</button>
                            <a href="{{ request()->url() }}" class="btn btn-warning btn-sm"><i
                                    class="fa fa-refresh"></i> Reset</a>
                            <button class="btn btn-primary btn-sm print_hidden print_button"
                                onclick="print_receipt('print-area')">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card print" id="print-area">
            <div class="card-header">
                <h4 class="card-title">Cash Sales Return List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>Sale No</strong></th>
                                    <th><strong>Customer Name</strong></th>
                                    <th><strong>Customer Phone</strong></th>
                                    <th><strong>Sale Date</strong></th>
                                    <th><strong>Return Date</strong></th>
                                    <th><strong>Items</strong></th>
                                    <th><strong>Return Amount</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th class="print_hidden"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($sale_returns as $sale_return)
                                <tr>
                                    <td><strong>{{$sale_return->id}}</strong></td>
                                    <td>{{$sale_return->sale_id}}</td>
                                    <td>{{$sale_return->customer_name}}</td>
                                    <td>{{$sale_return->phone}}</td>
                                    <td>{{date('d M, Y', strtotime($sale_return->sale_date))}}</td>
                                    <td>{{date('d M, Y', strtotime($sale_return->return_date))}}</td>
                                    <td>
                                        <ul>
                                            @foreach($sale_return->items as $item)
                                            <li>{{$item->items->name}} @if($item->variation) - V : {{
                                                $item->variation->name }}@endif * {{ $item->qty}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>BDT {{$sale_return->return_amount}}</td>
                                    <td>{{$sale_return->note}}</td>
                                    <td class="print_hidden">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">

                                                @can('delete-cash_sale_return')
                                                <a class="dropdown-item" href="" data-bs-toggle="modal"
                                                    data-bs-target=".delete-modal"
                                                    onclick="handle({{$sale_return->id}})"><i class="fas fa-trash"></i>
                                                    Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $sale_returns->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.inc.delete-modal')
@endsection

@section('extra_js')
<script src="{{asset('asset/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('asset/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('asset/js/plugins-init/bs-daterange-picker-init.js')}}"></script>

<script>
    //Delete Code
    function handle(id) {
       var url = "{{ route('cash-sale-return.destroy', 'sale_id') }}".replace('sale_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
     }

     function print_receipt(divName) {
        let printDoc = $('#' + divName).html();
        let originalContents = $('body').html();
        $("body").html(printDoc);
        window.print();
        $('body').html(originalContents);
    }

</script>
@endsection