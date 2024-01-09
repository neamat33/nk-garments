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
        <div class="card-header mb-3 pl-3">
            <h4 class="card-title">Details </h4>
            <a href="{{ route('production_send.index')}}" class="btn btn-sm btn-info">Production List </a>
        </div>
        <div class="basic-form">
            
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Production ID :</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" value="# {{ $production->id}}" readonly>
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Department To :</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" value="{{ $production->department->name}}" readonly>
                               
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Note :</label>
                            <div class="col-sm-8">
                                <textarea name="note" id="" class="form-control" readonly>{{ $production->note }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label"> Date :</label>
                            <div class="col-sm-8">
                                <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" value="{{ date('d-m-Y',strtotime($production->date)) }}" type="text" readonly
                                        name="date" style="width: 100%" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card">
                    <div class="card-header pt-3 pb-3">
                        <h5><span class="fa-solid fa-qrcode"></span> PRODUCTION ITEMS</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width: 5%"><strong>SN.</strong></th>
                                        <th><strong>Item Name</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>Weight </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($production->items as $key => $item)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->items->name}}</td>
                                        <td class="text-center">{{$item->qty}} Pcs</td>
                                        <td class="text-center">{{$item->weight}} Kg</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>

                
        </div>
    </div>
</div>
@endsection

