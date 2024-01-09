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

        #addrow {
            display: none;
        }

        #addrow1 {
            display: none;
        }

        .table>thead {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <form method="POST" action="{{ route('tp_production_receive.store') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Receive Third Party Production</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <label for=""><strong class="text-white">Search by Production ID: </strong></label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="production_id" name="production_id"  onchange="getSendInfo()"
                                    class="form-control col-sm-3" placeholder="Enter Production ID" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div id="send_item">

                </div>
                <div class="col-md-12 mt-2">
                    <div class="card">
                        <div class="card-header pt-3 pb-3">
                            <h5><span class="fa-solid fa-qrcode"></span> RECEIVE ITEMS</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mb-2" id="addrow1">Add</button>
                            <div class="table-responsive">
                                <table class="table table-responsive-md mytable1">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%"><strong>Item</strong></th>
                                            <th><strong>Item Details</strong></th>
                                            <th><strong>Variation</strong></th>
                                            <th style="width: 15%"><strong>Dozen</strong></th>
                                            <th style="width: 15%"><strong>Quantity</strong></th>
                                            <th style="width: 15%"><strong> Weight </strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="new_item[]" class="item-select select2">
                                                    <option value="">Select Item</option>
                                                    @foreach ($item as $val)
                                                        <option value="{{ $val->id }}"
                                                            data-details="{{ 'Name: ' . $val->name . ', Type: ' . $val->type }}"
                                                            data-stock="{{ $val->readable_qty($val->stock()) }}"
                                                            data-mainunit-name="{{ $val->main_unit->name }}"
                                                            data-subunit-name="{{ $val->sub_unit_name->name }}"
                                                            data-subunit-related="{{ $val->unit_related_by->related_by }}"
                                                            data-price="{{ $val->unit_price }}">{{ $val->name }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <textarea name="item_details[]" id="item_details" cols="60" rows="1"
                                                    class="form-control form-control-sm item-details"></textarea>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm variation"
                                                    name="item_variation_id[]">
                                                    <option value="">Select</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="number" name="dozen[]" id="dozen" placeholder="Pcs"
                                                    class="form-control form-control-sm qty">
                                            </td>
                                            <td>
                                                <input type="number" name="qty[]" id="qty" placeholder="Pcs"
                                                    class="form-control form-control-sm qty">
                                            </td>
                                            <td>
                                                <input type="number" name="weight[]" id="weight" placeholder="Kg"
                                                    class="form-control form-control-sm weight">
                                            </td>

                                        </tr>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="pt-5">
                                                <span class="text-bold text-white"><input type="checkbox" name="all_receive"
                                                        style="transform: scale(1.5);" />&nbsp; All Items Received</span>
                                            </td>
                                        </tr>

                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 mb-3">

                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection




@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

            $("#party_id").on('change', function() {
                let selectedOption = $(this).find('option:selected'); // Get the selected option
                let address = selectedOption.data('address'); // Retrieve the data-address attribute value
                if (address !== undefined) {
                    $("#company_address").text(address);
                }
            });


        });
    </script>

    @include('admin.production.tp_production_receive.scripts')
@endsection
