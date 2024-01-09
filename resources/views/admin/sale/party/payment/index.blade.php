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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Party</strong></label>
                                <select name="party_id" id="select2-dropdown" class="form-control">
                                    <option value="">Select Party Name</option>
                                    @foreach($parties as $party)
                                    <option value="{{$party->id}}" {{ request('party_id')==$party->id?'SELECTED':''
                                        }}>{{$party->party_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Bank Account</strong></label>
                                   <select name="bank_account" id="" class="form-control">
                                    <option value="">Select Bank Account</option>
                                    @foreach($bank_accounts as $bank)
                                    <option value="{{$bank->id}}" {{ request('bank_account')==$bank->id?'SELECTED':'' }}>{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Payment Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="payment_date"
                                    autocomplete="off" value="{{ request('payment_date') }}">
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
                <h4 class="card-title">Party Payments List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>Party Name</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>T.Invoice</strong></th>
                                    <th><strong>Bank Account</strong></th>
                                    <th><strong>Invoices</strong></th>
                                    <th><strong>Discount</strong></th>
                                    <th><strong>Total Amount</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th class="print_hidden"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($sale_payments as $payment)
                                <tr>
                                    <td><strong>{{$payment->id}}</strong></td>
                                    <td>{{ $payment->party->party_name}}</td>
                                    <td>{{date('d M, Y', strtotime($payment->payment_date))}}</td>
                                    <td>{{$payment->total_invoice}}</td>
                                    <td>{{ $payment->account->name}}</td>
                                    <td>
                                        <ul>
                                            @foreach($payment->items as  $item)
                                                <li>
                                                    <a href="{{ route('party-sale.invoice',$item->paymentable_id) }}" class="text-light" target="_blank">S.Invoice No : {{$item->paymentable_id}}</a>
                                                </li>
                                            @endforeach
                                        </ul>   

                                    </td>
                                    <td>BDT {{$payment->discount_amount}}</td>
                                    <td>BDT {{$payment->pay_amount}}</td>
                                    <td>{{ $payment->note }}</td>
                                    <td class="print_hidden">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">
                                                @can('delete-party_sale')
                                                <a class="dropdown-item" href="" data-bs-toggle="modal"
                                                    data-bs-target=".delete-modal" onclick="handle({{ $payment->id }})"><i
                                                        class="fas fa-trash"></i> Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $sale_payments->appends(Request::except('_token'))->links() !!}
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
       var url = "{{ route('party-sale-payment.destroy', 'payment_id') }}".replace('payment_id', id);
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

    //Side Menu Hidden
    // $('#main-wrapper').toggleClass("menu-toggle");
</script>
@endsection