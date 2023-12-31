@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title">Roles List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table id="datatable" class="table table-striped table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->users->count() }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-eye"></i> Show</a>
                                            @can('edit-role')
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                            @endcan
                                            {{-- @can('delete-role')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                                            $role->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $roles->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')

@endsection
