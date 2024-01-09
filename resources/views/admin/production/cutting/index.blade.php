@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cutting List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>SN.</strong></th>
                                    <th style="width: 15%"><strong>Production ID</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>Delivery To</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuttings as $key => $item)
                                <tr>
                                    <td><strong>{{ (isset($_GET['page']))? ($_GET['page']-1)*$cuttings->count()+$key+1 : $key+1 }}</strong></td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ date('d-m-Y',strtotime($item->date)) }}</td>
                                    <td>{{ $item->department->name }}</td>
                                    <td>{{ $item->note ?? "N/A" }}</td>
                                    
                                <td>
                                    @if($item->status==1)
                                        <a href="{{ route('cutting.show',$item->id)}}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye" title="View"></i>
                                        </a>
                                        <a href="{{ route('cutting.print',$item->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-print" title="Print"></i>
                                        </a>
                                        {{-- <a href="{{ route('cutting.destroy', $item->id) }}" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete this item?'))">
                                            <i class="fa fa-trash" title="Delete"></i>
                                        </a> --}}
                                        @can('delete-cutting')
                                        <a class="btn btn-sm btn-danger" href="" data-bs-toggle="modal"
                                            data-bs-target=".delete-modal" onclick="handle({{ $item->id }})"><i
                                                class="fas fa-trash"></i></a>
                                        @endcan
                                        
                                       
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $cuttings->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.inc.delete-modal')
<script>
    function handle(id) {
       var url = "{{ route('cutting.destroy', 'id') }}".replace('id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
    }
</script>
@endsection
