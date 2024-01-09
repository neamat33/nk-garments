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
                                    <div class="form-group col-md-4">
                                        <input type="text" id="production_id" name="production_id" class="form-control"
                                            placeholder="Enter Production ID">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="party_id" id="party_id" class="form-control select2">
                                            <option value="">Select Party..</option>
                                            @foreach ($parties as $party)
                                                <option value="{{ $party->id }}">{{ $party->party_name }}</option>
                                            @endforeach

                                        </select>
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
                    @if ($send_items)
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Send Items</h4>
                            </div>

                            <div class="row">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th><strong>#</strong></th>
                                                    <th><strong>Item</strong></th>
                                                    <th><strong>Dozen</strong></th>
                                                    <th><strong>Quantity</strong></th>
                                                    <th><strong>Weight</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $send_dozen = 0;
                                                    $send_qty = 0;
                                                    $send_weight = 0;
                                                @endphp
                                                @foreach ($send_items as $key => $item)
                                                    @foreach ($item->send_items as $prod)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                @if ($prod->item_variation_id != null)
                                                                    {{ $prod->items->name . ' , ' . $prod->variation->name }}
                                                                @else
                                                                    {{ $prod->items->name }}
                                                                @endif

                                                            </td>
                                                            <td>{{ $prod->dozen ? $prod->dozen . ' dozen' : '-' }} </td>
                                                            <td>{{ $prod->qty ? $prod->qty . ' Pcs' : '-' }} </td>
                                                            <td>{{ $prod->weight ? $prod->weight . ' Kg' : '-' }}</td>

                                                        </tr>
                                                        @php
                                                            $send_dozen += $prod->dozen;
                                                            $send_qty += $prod->qty;
                                                            $send_weight += $prod->weight;
                                                        @endphp
                                                    @endforeach
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-dark">
                                                    <td colspan="2" class="text-right"><strong>Total Send Item :
                                                        </strong></td>
                                                    <td><strong>{{ $send_dozen }} Dozen</strong></td>
                                                    <td><strong>{{ $send_qty }} Pcs</strong></td>
                                                    <td><strong>{{ $send_weight }} Kg</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-6">
                    @if ($receive_items)
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Received Items</h4>
                            </div>

                            <div class="row">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th><strong>#</strong></th>
                                                    <th><strong>Item</strong></th>
                                                    <th><strong>Dozen</strong></th>
                                                    <th><strong>Quantity</strong></th>
                                                    <th><strong>Weight</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $tolal_dozen = 0;
                                                    $tolal_qty = 0;
                                                    $tolal_weight = 0;
                                                @endphp
                                                @foreach ($receive_items as $key => $item)
                                                    @foreach ($item->items as $pro)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                @if ($pro->item_variation_id != null)
                                                                    {{ $pro->items->name . ' , ' . $pro->variation->name }}
                                                                @else
                                                                    {{ $pro->items->name }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $pro->dozen ? $pro->dozen . ' dozen' : '-' }} </td>
                                                            <td>{{ $pro->qty ? $pro->qty . ' Pcs' : '-' }} </td>
                                                            <td>{{ $pro->weight ? $pro->weight . ' Kg' : '-' }}</td>

                                                        </tr>

                                                        @php
                                                            $tolal_dozen += $pro->dozen;
                                                            $tolal_qty += $pro->qty;
                                                            $tolal_weight += $pro->weight;
                                                        @endphp
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-dark">
                                                    <td colspan="2" class="text-right"><strong>Total Receive Item Qty :
                                                        </strong></td>
                                                    <td><strong>{{ $tolal_dozen }} Dozen</strong></td>
                                                    <td><strong>{{ $tolal_qty }} Pcs</strong></td>
                                                    <td><strong>{{ $tolal_weight }} Kg</strong></td>
                                                </tr>
                                                <tr class="bg-info">
                                                    <td colspan="2" class="text-right"><strong>Total Receivable Item Qty :
                                                        </strong></td>
                                                    <td><strong>{{ $send_dozen - $tolal_dozen }} Dozen</strong></td>
                                                    <td><strong>{{ $send_qty-$tolal_qty }} Pcs</strong></td>
                                                    <td><strong>{{ $send_weight-$tolal_weight }} Kg</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        {{-- {!! $knittings->appends(Request::except('_token'))->links() !!} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
@section('extra_js')
@endsection
