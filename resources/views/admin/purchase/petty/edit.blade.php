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
            max-width: 48%;
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

        #addrow{
            display: none;
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
            <h4 class="card-title">Edit Petty Purchase</h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('petty-purchase.update',$petty_purchase->id) }}">
                @csrf
                @method('PUT')
            
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Purchase Form<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" placeholder="Purchase Form"
                                name="purchase_form" required value="{{$petty_purchase->purchase_form}}">
                                @if($errors->has('purchase_form'))
                                    <span class="invalid-feedback">{{ $errors->first('purchase_form') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Address :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" placeholder="Address" name="address" value="{{$petty_purchase->address}}">
                                @if($errors->has('address'))
                                    <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Phone :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" placeholder="Phone" name="phone" value="{{$petty_purchase->phone}}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery Date :</label>
                            <div class="col-sm-9">
                                <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="delivery_date" style="width: 100%" value="{{$petty_purchase->delivery_date}}" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                @if($errors->has('delivery_date'))
                                    <span class="invalid-feedback">{{ $errors->first('delivery_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Purchase Date<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="purchase_date" value="{{$petty_purchase->purchase_date}}" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                @if($errors->has('purchase_date'))
                                    <span class="invalid-feedback">{{ $errors->first('purchase_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery To</label>
                            <div class="col-sm-9">
                                <textarea name="delivery_to" class="form-control form-control-sm" id="" cols="30" rows="1">{{$petty_purchase->delivery_to}}</textarea>
                                @if($errors->has('delivery_to'))
                                    <span class="invalid-feedback">{{ $errors->first('delivery_to') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Order By :</label>
                            <div class="col-sm-9">
                                <select name="order_by" id="" class="form-control form-control-sm">
                                    <option value="">Select Order By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{ $petty_purchase->order_by == $employee->id ? 'selected' : '' }}>{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('order_by'))
                                    <span class="invalid-feedback">{{ $errors->first('order_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Purchase By :</label>
                            <div class="col-sm-9">
                                <select name="purchase_by" id="" class="form-control form-control-sm">
                                    <option value="">Select Purchase By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{ $petty_purchase->purchase_by == $employee->id ? 'selected' : '' }}>{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('purchase_by'))
                                    <span class="invalid-feedback">{{ $errors->first('purchase_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <textarea name="note" id="" cols="60" rows="1" class="form-control form-control-sm">{{$petty_purchase->note}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" id="addrow">Add</button>
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 10%"><strong>Item</strong></th>
                                        <th><strong>Item Details</strong></th>
                                        <th><strong>Variation</strong></th>
                                        <th style="width: 25%"><strong>Qty</strong></th>
                                        <th style="width:10%"><strong>Rate</strong></th>
                                        <th style="width: 15%"><strong>Sub Total</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($petty_purchase->items as $key => $old_item )
                                    <tr>
                                         <td>
                                           <p>{{ $old_item->items->name }} @if($old_item->item_variation_id)- V : {{ $old_item->variation->name }}@endif</p>
                                            <input type="hidden" class="main-price" name="new_item[]" value="{{ $old_item->item_id}}" data-price="{{ $old_item->items->unit_price }}" >
                                        </td>
                                        <td>
                                            <textarea name="item_details[]"  cols="60" rows="1" class="form-control form-control-sm item-details">{{ $old_item->details }}</textarea>
                                        </td>
                                        <td>
                                            <select name="item_variation_id[]" id="" class="form-control form-control-sm">
                                                <option value="">Select</option>
                                                @foreach($old_item->items->variations as $size)
                                                <option value="{{ $size->id}}" {{$old_item->item_variation_id == $size->id  ? 'selected' : ''}}>{{ $size->name  }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="quantity">
                                                <div class="main_unit">
                                                    <label class="main_unit_name">{{ $old_item->items->main_unit->name }}</label>
                                                    <input type="text" name="main_unit_qty[]" id="main_unit_qty" class="form-control form-control-sm main_unit_qty" value="{{ $old_item->main_unit_qty}}">
                                                </div>
                                                <div class="sub_unit">
                                                    <label class="sub_unit_name">{{ $old_item->items->sub_unit_name?$old_item->items->sub_unit_name->name:'' }}</label>
                                                    <input type="text" name="sub_unit_qty[]" id="sub_unit_qty" class="form-control form-control-sm sub_unit_qty" value="{{ $old_item->sub_unit_qty}}">
                                                </div>
                                                </div>   
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="rate[]" id="rate" class="form-control form-control-sm rate" value="{{ $old_item->rate}}">
                                        </td>
                                        <td>
                                            <input type="number" name="sub_total[]" id="sub_total" class="form-control form-control-sm sub_total" value="{{ $old_item->sub_total}}" readonly>
                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr style="width: 100%">
                                            <th class="text-end" style="width: 70%;font-size: 15px">Total Invoice Amount :</th>
                                            <th>
                                                <input type="text" name="payable" id="input_payable" class="form-control form-control-sm" value="{{$petty_purchase->final_payable}}" readonly>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
        
   @include('admin.purchase.edit-scripts')
    
@endsection
