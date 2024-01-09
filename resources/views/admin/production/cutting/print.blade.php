@extends('admin.admin-dashboard')
@section('extra_css')
    <style>
        .print_button {
            width: 100px;
        }

        .invoice-header {}

        .party_info {
            color: #ffffff;
        }

        .company_info {
            float: right;
        }

        .company_info .address {
            color: #ffffff;
        }

        .table:not(.table-bordered) thead th {
            font-weight: 800;
            font-size: medium;
        }


        @media print {
            body * {
                visibility: visible !important;
                color: #000 !important;
            }

        }
    </style>
@endsection
@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-header">
                    <h3><strong>Cutting Invoice</strong></h3>
                    <button class="btn btn-primary print_hidden print_button" onclick="print_receipt('print-area')">
                        <i class="fa fa-print"></i>
                        Print
                    </button>
                </div>
                <div id="print-area" class="card-body print">
                    <div class="invoice-header">
                        <div class="row mb-5">
                            <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="party_info">
                                    <div class="name"><strong>Production ID : # {{ $cutting->id }}</strong></div>
                                    <div class="name"><strong>Department To : {{ $cutting->department->name }}</strong>
                                    </div>
                                    <div class="phone_no"><strong>Note : {{ $cutting->note }}</strong></div>
                                </div>
                            </div>
                            <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right">
                                <div class="company_info">
                                    <div class="company_name">
                                        {{-- <img class="" src="{{asset('asset/images/logo.png')}}" alt="logo" width="250px"> --}}
                                        <h3><strong>{{ $setting->company }}</strong></h3>
                                    </div>
                                    <div class="address">
                                        <span><strong>{{ $setting->address }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pb-3">
                        <h5><strong> RAW ITEMS </strong></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width: 40%"><strong>Item Name</strong></th>
                                    <th class="text-center"><strong>Quantity</strong></th>
                                    <th class="text-center"><strong>Weight </strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cutting->raw_items as $raw_item)
                                    <tr>
                                        <td>
                                            @if($raw_item->item_variation_id!=null)
                                            {{ $raw_item->items->name.' , '. $raw_item->variation->name }}
                                            @else
                                            {{ $raw_item->items->name }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $raw_item->qty }} Pcs</td>
                                        <td class="text-center">{{ $raw_item->weight }} Kg</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4 pb-3">
                        <h5><strong>FINISH OUTPUT ITEMS </strong></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width: 40%"><strong>Item Name</strong></th>
                                    <th class="text-center"><strong>Quantity</strong></th>
                                    <th class="text-center"><strong> Weight </strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cutting->items as $item)
                                    <tr>
                                        <td>
                                            @if($item->item_variation_id!=null)
                                            {{ $item->items->name.' , '. $item->variation->name }}
                                            @else
                                                {{ $item->items->name }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->dozen }} Dozen, {{ round($item->qty) }} Pcs</td>
                                        <td class="text-center">{{ $item->weight }} Kg</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.inc.delete-modal')
@endsection

@section('extra_js')
    <script>
        // clear localstore
        function print_receipt(divName) {
            let printDoc = $('#' + divName).html();
            let originalContents = $('body').html();
            $("body").html(printDoc);
            window.print();
            $('body').html(originalContents);
        }
    </script>
@endsection
