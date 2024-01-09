@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Knitting List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>Delivery To</strong></th>
                                    <th><strong>Item</strong></th>
                                    <th><strong>Quantity</strong></th>
                                    <th><strong>Weight</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($knittings as $key => $item)
                                <tr>
                                    <td><strong>{{ (isset($_GET['page']))? ($_GET['page']-1)*$knittings->count()+$key+1 : $key+1 }}</strong></td>
                                    <td>{{ date('d-m-Y',strtotime($item->date)) }}</td>
                                    <td>{{ $item->department_to }}</td>
                                    <td>
                                        {{ $item->item . ($item->size ? ', Size-' . $item->size : '') . ($item->color ? ', Color-' . $item->color : '') }}

                                    </td>
                                    <td>{{ $item->qty }} Pcs</td>
                                    <td>{{ $item->weight }} Kg</td>
                                    <td>{{ $item->note }}</td>
                                    <td>
                                        @if($item->status==1)
                                          <span class="badge bg-info">Receive</span>
                                        @elseif($item->status==2)
                                          <span class="badge bg-primary">Send</span>
                                        @endif
                                    </td>
                                <td>
                                    @if($item->status==1)
                                        <a href="{{ route('knitting.edit',$item->detail_id)}}" class="btn btn-info mb-2">
                                        <i class="fa fa-pencil" title="Edit"></i>
                                        </a>
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $knittings->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
