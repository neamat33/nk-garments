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
                        <div class="row mb-5 d-flex">
                            <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="party_info">
                                    <div class="name"><strong>Production ID : # {{ $production->id }}</strong></div>
                                    <div class="name"><strong>Department To : {{ $production->department->name }}</strong>
                                        <div class="name"><strong>Head Of Department : {{ $production->employee->employee_name }}</strong></div>
                                        <div class="phone_no"><strong>Note : {{ $production->note }}</strong></div>
                                    </div>
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
                        <div class="text-center mb-3">
                            <h5><strong> PRODUCTION SEND ITEMS </strong></h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width: 40%"><strong>Item Name</strong></th>
                                        <th class="text-center"><strong>Quantity</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($production->items as $item)
                                        <tr>
                                            <td>{{ $item->items->name }}</td>
                                            <td class="text-center">{{ $item->dozen }} Dozen, {{ round($item->qty) }} Pcs</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
