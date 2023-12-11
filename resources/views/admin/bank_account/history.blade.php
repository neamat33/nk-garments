@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  $account->name  }} - Transection History</h4>
                <div>
                    <table >
                        <tr>
                            <td><strong>Opening Blance <strong></td>
                            <td> : </td>
                            <td><span class="text-success"> {{ $account->opening_balance }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Previous Blance <strong></td>
                            <td> : </td>
                            <td><span class="text-success"> {{ number_format($previous_blance,2) }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th class="width80"><strong>#</strong></th>
                                   <th><strong>Date</strong></th>
                                   <th><strong>Department</strong></th>
                                   <th><strong>Payment Source</strong></th>

                                   <th><strong>Type</strong></th>
                                   <th><strong>Credit</strong></th>
                                   <th><strong>Debit</strong></th>
                                   <th><strong>Blance</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                               @if($history->currentPage()==1)
                                    {{-- <tr>
                                    <td>0</td>
                                    <td>{{ date("d/m/Y",strtotime($account->created_at)) }}</td>
                                    <td colspan="2">Opening Balance</td>
                                    <td><span class="text-success">{{ $account->opening_balance }}</span></td>
                                    <td colspan="2">Previous Balance</td>
                                    <td><span class="text-success" >{{ $previous_blance }}</span></td>
                                </tr> --}}
                                @endif
                                @php $counter=1;

                                $total_blance = 0;
                                @endphp

                                @foreach($history as $key => $item)
                                @php
                                $model=$item['model'];
                                $debit = 0;
                                $credit = 0;
                                $blance = 0;
                                @endphp
                                <tr>
                                   <td><strong>{{ $history->currentPage()!=1?$history->currentPage()*$history->perPage()+$counter+1:$counter++ }}</strong></td>
                                   <td>{{ date("d/m/Y",strtotime($item['payment_date'])) }}</td>
                                   <td>{{ $item['department_name'] }}</td>
                                   <td>{{ $item['payment_source'] }}</td>
                                   <td>{{ $item['type']=="pay"?"Spent / Pay":"Received" }}</td>
                                    <td>
                                        @if($model == "App\Payment" && $item['type'] == "receive")
                                        <span class="text-success">{{ $debit=$item['amount'] }}</span>
                                        @else
                                        <span class="text-success">0</span>
                                        @endif
                                   </td>
                                   <td>
                                        @if($model == "App\Payment" && $item['type'] == "pay")
                                        <span class="text-danger">{{ $credit=$item['amount'] }}</span>
                                        @else
                                        <span class="text-danger">0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php $blance=$debit-$credit; @endphp
                                        {{ number_format($blance,2) }}
                                    </td>
                                </tr>
                                @php $total_blance += $debit-$credit;; @endphp
                                @endforeach
                                <tr >
                                    <td colspan="6"></td>
                                    <td ><b>Total Blance </b></td>
                                    <td> ৳&nbsp;{{ number_format($total_blance,2) }}</td>
                                </tr>
                            </tbody>

                        </table>
                        {{ $history->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection