@extends('admin.admin-dashboard')
@section('extra_css')
    <style>
        .datepicker.datepicker-dropdown th.datepicker-switch,
        .datepicker.datepicker-dropdown th.next,
        .datepicker.datepicker-dropdown th.prev {
            color: #FFFFFF;
        }
        .quantity {
            width: 100%;
            text-align: center;
        }

        .quantity .main_unit {
            width: 48%;
            float: left;
            margin-right: 5px;
        }

        .quantity .sub_unit {
            width: 48%;
            float: left;
            margin-right: 5px;
        }
        
        .main_unit_name,
        .sub_unit_name {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .table > thead {
            text-align: center;
        }
    </style>
@endsection
@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card-header mb-3">
            <h4 class="card-title">Return Cash Sale</h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('cash-sale-return.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Invoice Number :</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" type="text" value="{{ $cash_sale->id }}" readonly name="sale_id" />
                            </div>
                        </div>
                    </div>
                     <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Return Commission :</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" type="text" value="{{ $cash_sale->total_commission }}" name="return_commission" />
                            </div>
                        </div>
                    </div>
                     <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Return Discount :</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" type="text" value="{{ $cash_sale->total_discount }}" name="return_discount" />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Note :</label>
                            <div class="col-sm-9">
                                <textarea name="note" id="" cols="60" rows="2" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 15%"><strong>Item Name</strong></th>
                                        <th><strong>Item Details</strong></th>
                                        <th style="width: 35%"><strong>Qty</strong></th>
                                        <th style="width:10%"><strong>Rate</strong></th>
                                        {{-- <th style="width:10%"><strong>Commission</strong></th> --}}
                                        <th style="width: 10%"><strong>Sub Total</strong></th>
                                        <th style="width: 10%"><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cash_sale->items as $key => $item )
                                  
                                    <tr>
                                        <td>
                                           <p>{{ $item->items->name }} @if($item->item_variation_id)- V : {{ $item->variation->name }}@endif</p>
                                            
                                            @if($item->item_variation_id) 
                                            <input name="item_variation_id[]" type="hidden" value="{{$item->item_variation_id}}">
                                            @endif
                                           <input type="hidden" name="new_item[]" value="{{ $item->item_id}}">
                                            <input type="hidden" name="sale_item_id[]" value="{{ $item->id}}">
                                        </td>
                                        <td>
                                            <textarea name="item_details[]"  cols="60" rows="1" class="form-control form-control-sm item-details">{{ $item->details }}</textarea>
                                        </td>

                                        <td>
                                            <div class="quantity">
                                                <div class="main_unit">
                                                    <label class="main_unit_name">{{ $item->items->main_unit->name }}</label>
                                                    <input type="text" data-sub_qty="{{ $item->main_unit_qty}}" name="main_unit_qty[]" id="main_unit_qty" class="form-control form-control-sm main_unit_qty" value="{{ $item->main_unit_qty}}">
                                                </div>
                                                <div class="sub_unit">
                                                    <label class="sub_unit_name">{{ $item->items->sub_unit_name?$item->items->sub_unit_name->name:'' }}</label>
                                                    <input type="text" data-sub_qty="{{ $item->sub_unit_qty}}" name="sub_unit_qty[]" id="sub_unit_qty" class="form-control form-control-sm sub_unit_qty" value="{{ $item->sub_unit_qty}}">
                                                    <input type="hidden" class="related_by" value="">
                                                </div>
                                                </div>   
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="rate[]" value="{{ $item->rate}}" id="rate" class="form-control form-control-sm rate" readonly>
                                        </td>
                                        {{-- <td>
                                            <input type="number" name="commission[]" value="{{ $item->commission}}" id="commission" class="form-control form-control-sm commission" readonly>
                                        </td> --}}
                                        <td>
                                            <input type="number" name="sub_total[]" value="{{ $item->sub_total}}" id="sub_total" class="form-control form-control-sm sub_total" readonly>
                                        </td>
                                        <td>
                                           <button type="button" class="btn btn-danger btn-sm no-return">
                                                <i class="fa fa-times"></i> No Return
                                            </button>
                                        </td>
                                        <td>
                                    </tr>
                                    @endforeach

                                </tbody>

                                <tfoot>
                                
                                    <tr class="">
                                        <th class="text-end" colspan="2"></th>
                                        <th class="text-center" id="total_qty">Total Qty: {{ $cash_sale->items->sum('sub_unit_qty') }}</th>
                                        <th></th>
                                        {{-- <th class="text-center" id="total_commission" colspan="">Total C: {{ $cash_sale->items->sum('commission') }}</th> --}}
                                        <th class="text-center" id="totalsubtotal">S. Total: {{ $cash_sale->items->sum('sub_total') }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                          
                        </div>
                    </div>
                     <div class="col-xl-12 col-lg-12 px-5 mb-3">
                        <button class="btn btn-success" type="submit">Save</button>
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
    
    @include('admin.sale.cash.return.script')

@endsection
