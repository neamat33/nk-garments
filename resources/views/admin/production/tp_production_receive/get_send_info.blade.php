<div class="basic-form">

    <div style=" border-radius:10px; border: 2px solid #242d61; padding:20px;">
        <div class="row">
            <input type="hidden" name="tp_production_send_id" value="{{ $production->id }}">
            <input type="hidden" name="party_id" value="{{ $production->party_id }}">
            <div class="row mb-5 d-flex">
                <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="party_info">
                        <div class="name"><strong>Production ID : # {{ $production->id }}</strong></div>
                        <div class="name"><strong>Department : {{ $production->department->name }}</strong>
                            <div class="name"><strong>Party name : {{ $production->party->party_name }}</strong></div>
                            <div class="name"><strong>Company Address : {{ $production->company_address }}</strong>
                            </div>
                            <div class="name"><strong>Transaction Details :
                                    {{ $production->transport_detail }}</strong></div>
                            <div class="phone_no"><strong>Note : {{ $production->note }}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right">
                    <div class="company_info">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label"> Date :</label>
                            <div class="col-sm-8">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" name="date"
                                        style="width: 100%" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Transport Details :</label>
                            <div class="col-sm-8">
                                <textarea name="transport_detail" id="transport_detail" class="form-control" required></textarea>
                                @if ($errors->has('transport_detail'))
                                    <span class="invalid-feedback">{{ $errors->first('transport_detail') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Note :</label>
                            <div class="col-sm-8">
                                <textarea name="note" id="note" class="form-control"></textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">{{ $errors->first('note') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
        <div class="row">
            <div class="text-center mb-3">
                <h5><strong> SEND ITEMS </strong></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-md">
                    <thead>
                        <tr>
                            <th style="width: 40%"><strong>Item Name</strong></th>
                            <th style="width: 20%" class="text-center"><strong>Quantity</strong></th>
                            <th style="width: 20%" class="text-center"><strong>Weight </strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($production->send_items as $item)
                            <tr>
                                <td>{{ $item->items->name }}</td>

                                <td class="text-center">
                                    @if ($item->dozen != null)
                                        {{ $item->dozen }} Dozen,
                                        {{ round($item->qty) }} Pcs
                                    @else
                                        {{ round($item->qty) }} Pcs
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->weight ? $item->weight . 'Kg' : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4 pb-3">
                <h5><strong>EXPECTED OUTPUT ITEMS </strong></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-md">
                    <thead>
                        <tr>
                            <th style="width: 40%"><strong>Item Name</strong></th>
                            <th style="width: 20%" class="text-center"><strong>Quantity</strong></th>
                            <th style="width: 20%" class="text-center"><strong>Weight </strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($production->items as $item)
                            <tr>
                                <td>
                                    @if ($item->item_variation_id != null)
                                        {{ $item->items->name . ' , ' . $item->variation->name }}
                                    @else
                                        {{ $item->items->name }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($item->dozen != null)
                                        {{ $item->dozen }} Dozen,
                                        {{ round($item->qty) }} Pcs
                                    @else
                                        {{ round($item->qty) }} Pcs
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->weight ? $item->weight . 'Kg' : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());
    });
</script>
