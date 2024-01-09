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
        <div class="card print" id="print-area">
            <div class="card-header">
                <h4 class="card-title">Add Party Payment</h4>
            </div>
            <form action="{{route('party-sale-payment.store')}}" method="POST">
              @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="party_id">Party Name<span class="text-danger">*</span>:</label>
                                <select name="party_id" id="party_id" class="form-control" required>
                                    <option value="">Select Party Name</option>
                                    @foreach($parties as $party)
                                        <option value="{{$party->id}}">{{$party->party_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('party_id'))
                                    <span class="invalid-feedback">{{ $errors->first('party_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_date">Payment Date<span class="text-danger">*</span>:</label>
                                <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" type="text" readonly name="payment_date" style="width: 100%" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    @if($errors->has('payment_date'))
                                        <span class="invalid-feedback">{{ $errors->first('payment_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_amount">Discount<span class="text-danger">*</span>:</label>
                                <input class="form-control" type="number" id="discount_amount" name="discount_amount" step="any" />
                                @if($errors->has('discount_amount'))
                                    <span class="invalid-feedback">{{ $errors->first('discount_amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pay_amount">Pay Amount<span class="text-danger">*</span>:</label>
                                <input class="form-control" type="number" id="pay_amount" name="pay_amount" step="any" />
                                <input type="hidden" name="current_due" id="current_due">

                                @if($errors->has('pay_amount'))
                                    <span class="invalid-feedback">{{ $errors->first('pay_amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid_amount">Bank Account<span class="text-danger">*</span>:</label>
                                <select name="bank_account_id" id="bank_account_id" class="form-control">
                                    @foreach ($bank_accounts as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="note">Note:</label>
                                <textarea name="note" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="total_invoice_display">
                                <strong class="text-success" id="total_invoice_label">Total Due Invoice: 0</strong>
                            </div>
                            <div id="total_due_display">
                                <strong class="text-success" id="total_quantity_label">Total Due Amount: 0</strong>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 py-3 text-center">
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select2-dropdown').select2();
        });
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).datepicker('update', new Date());
        });
    </script>
    <script>
        $(function() {
            $("#datepicker2").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).datepicker('update', new Date());
        });
    </script>
@include('admin.sale.party.payment.script')
@endsection
