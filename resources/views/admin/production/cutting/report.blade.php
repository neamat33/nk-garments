@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="#" method="GET">
                            <div class="card-body">
                                <div class="form row">
                                    <div class="form-group col-md-3">
                                        <input type="text" name="cutting_id" name="cutting_id" class="form-control" placeholder="Enter Production ID" value="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" name="start_date" data-provide="datepicker"
                                            data-date-today-highlight="true" data-orientation="bottom"
                                            data-date-format="yyyy-mm-dd" data-date-autoclose="true"
                                            class="form-control datepicker" placeholder="Enter Start Date"
                                            autocomplete="off" value="{{ $start_date }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" name="end_date" data-provide="datepicker"
                                            data-date-today-highlight="true" data-orientation="bottom"
                                            data-date-format="yyyy-mm-dd" data-date-autoclose="true"
                                            class="form-control datepicker" placeholder="Enter End Date" autocomplete="off"
                                            value="{{ $end_date }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                        <a href="{{ request()->url() }}" class="btn btn-info">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Raw Items</h4>
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th><strong>#</strong></th>
                                                <th><strong>Item</strong></th>
                                                <th><strong>Quantity</strong></th>
                                                <th><strong>Weight</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($raw_items as $key => $item)
                                                <tr>
                                                    <td><strong>{{ isset($_GET['page']) ? ($_GET['page'] - 1) * $items->count() + $key + 1 : $key + 1 }}</strong>
                                                    </td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->total_qty }} Pcs</td>
                                                    <td>{{ $item->total_weight }} Kg</td>
                                                    
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {!! $raw_items->appends(Request::except('_token'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Fnish Items</h4>
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th><strong>#</strong></th>
                                                <th><strong>Item</strong></th>
                                                <th><strong>Quantity</strong></th>
                                                <th><strong>Weight</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $key => $item)
                                                <tr>
                                                    <td><strong>{{ isset($_GET['page']) ? ($_GET['page'] - 1) * $raw_items->count() + $key + 1 : $key + 1 }}</strong>
                                                    </td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->total_qty }} Pcs</td>
                                                    <td>{{ $item->total_weight }} Kg</td>
                                                    
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {!! $items->appends(Request::except('_token'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
@endsection
