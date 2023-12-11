@extends('admin.admin-dashboard')
@section('extra_css')
<link href="{{asset('asset/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<style>
      @media print {
            body * {
                visibility: visible !important;
                color:#000 !important;
            }

            h4.card-title{
                color:#000 !important;   
            }

            .print_hidden{
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Customer Name</strong></label>
                                <input class="form-control" type="text" name="customer_name" autocomplete="off" value="{{ request('customer_name') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Sale Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="sale_date" autocomplete="off" value="{{ request('sale_date') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Delivery Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="delivery_date" autocomplete="off" value="{{ request('delivery_date') }}">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Showroom</strong></label>
                                <select name="showroom" id="" class="form-control">
                                    <option value="">Select Showroom</option>
                                    @foreach($showrooms as $showroom)
                                    <option value="{{$showroom->name}}" {{ request('showroom')==$showroom->name?'SELECTED':'' }}>{{$showroom->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Sold By</strong></label>
                                <select name="sold_by" id="" class="form-control">
                                    <option value="">Select Sold By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{ request('sold_by')==$employee->id?'SELECTED':'' }}>{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Order By</strong></label>
                                <select name="order_by" id="" class="form-control">
                                    <option value="">Select Order By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{ request('order_by')==$employee->employee_name?'SELECTED':'' }}>{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row text-end">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i> Filter</button>
                            <a href="{{ request()->url() }}" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Reset</a>
                            <button class="btn btn-primary btn-sm print_hidden print_button" onclick="print_receipt('print-area')"> 
                            <i class="fa fa-print"></i> Print
                            </button>
                        </div>   
                    </div>
                </div>
            </form>
        </div>
        <div class="card print" id="print-area">
            <div class="card-header">
                <h4 class="card-title">Cash Sales List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th class="width80"><strong>#</strong></th>
                                   <th><strong>Customer Name</strong></th>
                                   <th><strong>Address</strong></th>
                                   <th><strong>Phone</strong></th>
                                   <th><strong>Sold By</strong></th>
                                   <th><strong>Branch</strong></th>
                                   <th><strong>Delivery Date</strong></th>
                                   <th><strong>Total Price</strong></th>
                                   <th><strong>Paid</strong></th>
                                   <th><strong>Due</strong></th>
                                   <th class="print_hidden"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($sales as $sale)
                                <tr>
                                   <td><strong>{{$sale->id}}</strong></td>
                                   <td>{{ $sale->customer_name}}</td>
                                   <td>{{ $sale->customer_address}}</td>
                                   <td>{{ $sale->phone}}</td>
                                   <td>{{ $sale->sold_by_employee->employee_name}}</td>
                                    <td>{{ $sale->showroom}}</td>
                                   <td>{{date('d M, Y', strtotime($sale->delivery_date))}}</td>
                                   <td>{{$sale->receivable}}</td>
                                   <td>{{$sale->paid}}</td>
                                   <td>{{$sale->due}}</td>
                                   <td class="print_hidden">
                                       <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('cash-sale.invoice',$sale->id) }}">Invoice</a>
                                                <a class="dropdown-item" href="{{ route('cash-sale.edit',$sale->id) }}">Edit</a>
                                                @if ($sale->due > 0)
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-id="{{ $sale->id }}" id="add-payment" data-bs-target="#payment-modal">Add Payment</a>
                                                @endif
                                                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target=".delete-modal" onclick="handle({{ $sale->id }})">Delete</a>
                                            </div>
                                        </div>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $sales->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="payment-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cash Sale Payment</h5>
                <hr>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="payment-form" action="{{ route('cash-sale.invoice_payment') }}" method="POST">
                @csrf
                <div class="row px-5">
                    <div class="col-md-12" hidden>
                        <label class="col-form-label text-white">Invoice Number :</label>
                        <input type="text" name="invoice_id" id="invoice_id" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label text-white">Total Due :</label>
                        <input type="text" name="" id="due_amount" class="form-control" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label text-white">Pay Amount :</label>
                        <input type="number" name="pay_amount" id="pay_amount" class="form-control" step="any" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="col-form-label text-white">Bank Account :</label>
                        <select name="bank_account_id" id="bank_account_id" class="form-control">
                            @foreach ($bank_accounts as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No. Back !</button>
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
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
       var url = "{{ route('cash-sale.destroy', 'sale_id') }}".replace('sale_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
    }

    $(document).ready(function () {
        $('body').on('click', '#add-payment', function () {
            var sale_id = $(this).data('id');
            $.get('cash-sale/'+sale_id, function (data) {
            $('#payment-modal').modal('show');
            $('#invoice_id').val(data.id);
            $("#due_amount").val(data.due);
            })
        });
    });

     $(document).ready(function () {
        $("#pay_amount").on("input", function () {
            var receivableTotal = parseFloat($("#due_amount").val());
            var partyAmount = parseFloat($(this).val());

            if (partyAmount > receivableTotal) {
                toastr.warning('Cannot exceed Total Invoice Due Amount!');

                $(this).val(receivableTotal.toFixed(2));
            }
        });
    });

    function print_receipt(divName) {
        let printDoc = $('#' + divName).html();
        let originalContents = $('body').html();
        $("body").html(printDoc);
        window.print();
        $('body').html(originalContents);
    }

    //Side Menu Hidden
    // $('#main-wrapper').toggleClass("menu-toggle");
</script>
@endsection
