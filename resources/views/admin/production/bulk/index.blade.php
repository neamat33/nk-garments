@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Bulk Send List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>Sent From</strong></th>
                                    <th><strong>Delivery To</strong></th>
                                    <th><strong>Item</strong></th>
                                    <th><strong>Quantity</strong></th>
                                    <th><strong>Cone</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($send_items as $key => $item)
                                <tr>
                                    <td><strong>{{ (isset($_GET['page']))? ($_GET['page']-1)*$send_items->count()+$key+1 : $key+1 }}</strong></td>
                                    <td>{{ date('d-m-Y',strtotime($item->date)) }}</td>
                                    <td>{{ $item->department_from }}</td>
                                    <td>{{ $item->department_to }}</td>
                                    <td>{{ $item->item }}</td>
                                    <td>{{ $item->qty }} Kg</td>
                                    <td>{{ $item->cone }} Pcs</td>
                                    <td>
                                        @if($item->status==1)
                                          <span class="badge bg-info">Send</span>
                                        @elseif($item->status==2)
                                          <span class="badge bg-primary">Receive</span>
                                        @endif
                                    </td>
                                <td>
                                    @if($item->status==1)
                                        <a href="{{ route('bulk_send.edit',$item->bulk_detail_id)}}" class="btn btn-info mb-2">
                                        <i class="fa fa-pencil" title="Edit"></i>
                                        </a>
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $send_items->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
