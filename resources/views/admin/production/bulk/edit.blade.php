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
            <h4 class="card-title">Update Bulk Send </h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('bulk_send.update',$single->id) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 15%"><strong>Item</strong></th>
                                        <th style="width: 15%"><strong>Stock</strong></th>
                                        <th style="width: 15%"><strong>Quantity (kg)</strong></th>
                                        <th style="width:15%"><strong> Cone (pcs) </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                           
                                            <select name="item_id" id="select2-dropdown" class="item-select">
                                                @foreach ($item as $val)
                                                @php $rawStock = $val->raw_stock(); @endphp
                                                    <option @if($single->item_id==$val->id) selected @endif value="{{ $val->id }}" data-details="{{ "Name: " . $val->name . ", Type: " . $val->type}}" data-qty="{{ $rawStock['qty'] }}" data-cone="{{ $rawStock['cone'] }}" data-mainunit-name="{{ $val->main_unit->name }}" data-subunit-name="{{ $val->sub_unit_name->name }}" data-subunit-related="{{ $val->unit_related_by->related_by }}" data-price="{{ $val->unit_price }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="stock" id="stock" class="form-control form-control-sm stock" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="qty" id="qty" placeholder="Kg" value="{{ $single->qty }}" class="form-control form-control-sm qty">
                                        </td>

                                        <td>
                                            <input type="number" name="cone" id="cone" placeholder="Pcs"  value="{{ $single->cone }}"  class="form-control form-control-sm cone">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                     <div class="col-xl-12 col-lg-12 px-5 mb-3">
                        <button class="btn btn-success" type="submit">Update</button>
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
        
   @include('admin.production.bulk.scripts')
    
@endsection
