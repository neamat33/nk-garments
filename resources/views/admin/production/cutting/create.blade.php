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
        #addrow1{
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
            <h4 class="card-title">Create Cutting </h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('cutting.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Department To<span class="text-danger">*</span> :</label>
                            <div class="col-sm-8">
                                <select name="department_to" id="" class="form-control form-control-sm" required>
                                    @foreach($departments as $dep)
                                        <option @if($dep->id == 3) selected @endif value="{{$dep->id}}">{{$dep->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('department_to'))
                                    <span class="invalid-feedback">{{ $errors->first('department_to') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Note :</label>
                            <div class="col-sm-8">
                                <textarea name="note" id="" class="form-control"></textarea>
                                @if($errors->has('note'))
                                    <span class="invalid-feedback">{{ $errors->first('note') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label"> Date :</label>
                            <div class="col-sm-8">
                                <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="date" style="width: 100%" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                @if($errors->has('date'))
                                    <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card">
                    <div class="card-header pt-3 pb-3">
                        <h5><span class="fa-solid fa-qrcode"></span> RAW ITEMS</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" id="addrow">Add</button>
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 15%"><strong>Item</strong></th>
                                        <th><strong>Item Details</strong></th>
                                        <th>Available Stock</th>
                                        <th><strong>Variation</strong></th>
                                        <th style="width: 15%"><strong>Quantity</strong></th>
                                        <th style="width:15%"><strong> Weight </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="raw_item[]" class="item-select select2">
                                                <option value="">Select Item</option>
                                                @foreach ($raw_item as $val)
                                                    <option value="{{ $val->id }}" data-details="{{ "Name: " . $val->name . ", Type: " . $val->type}}" data-stock="{{$val->readable_qty($val->stock())}}" data-mainunit-name="{{ $val->main_unit->name }}" data-subunit-name="{{ $val->sub_unit_name->name }}" data-subunit-related="{{ $val->unit_related_by->related_by }}" data-price="{{ $val->unit_price }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </td>
                                        <td>
                                            <textarea name="item_details[]" id="item_details" cols="60" rows="1" class="form-control form-control-sm item-details"></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="raw_stock[]" id="raw_stock" class="form-control form-control-sm stock" readonly>
                                        </td>

                                        <td>
                                            <select class="form-control form-control-sm variation"
                                                name="item_variation_id[]">
                                                <option value="">Select</option>
                                            </select>
                                        </td>
                                        
                                        <td>
                                            <input type="number" name="raw_qty[]" id="raw_qty" placeholder="Pcs" class="form-control form-control-sm qty">
                                        </td>

                                        <td>
                                            <input type="number" name="raw_weight[]" id="raw_weight" placeholder="Kg" class="form-control form-control-sm raw_weight">
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pt-3 pb-3">
                        <h5><span class="fa-solid fa-qrcode"></span> FINISH OUTPUT ITEMS</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" id="addrow1">Add</button>
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable1">
                                <thead>
                                    <tr>
                                        <th style="width: 15%"><strong>Item</strong></th>
                                        <th><strong>Item Details</strong></th>
                                        <th>Available Stock</th>
                                        <th><strong>Variation</strong></th>
                                        <th style="width: 15%"><strong>Dozen</strong></th>
                                        <th style="width: 15%"><strong>Quantity</strong></th>
                                        <th style="width:15%"><strong> Weight </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="new_item[]" class="item-select select2">
                                                <option value="">Select Item</option>
                                                @foreach ($item as $val)
                                                    <option value="{{ $val->id }}" data-details="{{ "Name: " . $val->name . ", Type: " . $val->type}}" data-stock="{{$val->readable_qty($val->stock())}}" data-mainunit-name="{{ $val->main_unit->name }}" data-subunit-name="{{ $val->sub_unit_name->name }}" data-subunit-related="{{ $val->unit_related_by->related_by }}" data-price="{{ $val->unit_price }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </td>
                                        <td>
                                            <textarea name="item_details[]" id="item_details" cols="60" rows="1" class="form-control form-control-sm item-details"></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="stock[]" id="stock" class="form-control form-control-sm stock" readonly>
                                        </td>

                                        <td>
                                            <select class="form-control form-control-sm variation"
                                                name="item_variation_id[]">
                                                <option value="">Select</option>
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="dozen[]" id="dozen" placeholder="Pcs" class="form-control form-control-sm qty">
                                        </td> 

                                        <td>
                                            <input type="number" name="qty[]" id="qty" placeholder="Pcs" class="form-control form-control-sm qty">
                                        </td>
                                        <td>
                                            <input type="number" name="weight[]" id="weight" placeholder="Kg" class="form-control form-control-sm weight">
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 mb-3">
                    <button class="btn btn-success" type="submit">Save</button>
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
        $(document).ready(function() {
            $('.select2').select2();
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
        
   @include('admin.production.cutting.scripts')
   @include('admin.production.cutting.finish_scripts')
    
@endsection
