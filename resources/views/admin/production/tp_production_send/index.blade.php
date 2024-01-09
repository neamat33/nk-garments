@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Send Third Party Production List</h4>
                </div>
                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-md">
                                <thead>
                                    <tr class="text-center">
                                        <th class="width80"><strong>#</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Department</strong></th>
                                        <th><strong>Party Name</strong></th>
                                        <th><strong>Mobile No.</strong></th>
                                        <th><strong>Transation Details</strong></th>
                                        <th><strong>Note</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productions as $key => $item)
                                        <tr>
                                            <td class="text-center">
                                                <strong>{{ isset($_GET['page']) ? ($_GET['page'] - 1) * $productions->count() + $key + 1 : $key + 1 }}</strong>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                            <td>{{ $item->department->name }}</td>
                                            <td>{{ $item->party->party_name }}</td>
                                            <td>{{ $item->party->phone }}</td>
                                            <td>{{ $item->transport_detail }}</td>
                                           
                                            <td>{{ $item->note ?? 'N/A' }}</td>
                                            <td>
                                                @if($item->status==1)
                                                  <span class="badge bg-info">Pending</span>
                                                @elseif($item->status==2)
                                                  <span class="badge bg-warning">Partial</span>
                                                @elseif($item->status==3)
                                                  <span class="badge bg-success">Complete</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('tp_production_send.show', $item->id) }}"
                                                    class="btn-sm btn-info"><i class="fa fa-eye" title="View"></i></a>
                                                {{-- <a href="{{ route('tp_production_send.print', $item->id) }}"
                                                    class="btn-sm btn-primary"><i class="fa fa-print"
                                                        title="Print"></i></a> --}}
                                                @can('delete-production_send')
                                                    <a class="btn-sm btn-danger" href="" data-bs-toggle="modal"
                                                        data-bs-target=".delete-modal" onclick="handle({{ $item->id }})"><i
                                                            class="fas fa-trash"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $productions->appends(Request::except('_token'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.inc.delete-modal')
    <script>
        function handle(id) {
            var url = "{{ route('production_send.destroy', 'id') }}".replace('id', id);
            $("#delete-form").attr('action', url);
            $("#confirm-modal").modal('show');
        }
    </script>
@endsection
