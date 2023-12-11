@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="width80"><strong>#</strong></th>
                                            <th><strong>Name</strong></th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($users as $item)
                                        <tr>
                                            <td><strong>{{$i++}}</strong></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>
                                                @foreach($item->getRoleNames() as $role)
                                                    {{ ucfirst($role) }}
                                                @endforeach
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg{{$item->id}}">Edit</button>
                                                <button type="button" class="btn btn-danger mb-2" href="" data-bs-toggle="modal" data-bs-target=".delete-modal" onclick="handle({{ $item->id }})">Delete</button>
                                                <div class="modal fade bd-example-modal-lg{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit {{$item->name}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('user.update', $item->id) }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Name<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" value="{{$item->name}}"
                                                                            name="name">

                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Email<span class="text-danger">*</span> :</label>
                                                                        <input type="text" class="form-control input-rounded" name="email" value="{{$item->email}}" placeholder="Email">
                                                                        @if($errors->has('email'))
                                                                            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Department<span class="text-danger">*</span> :</label>
                                                                        <select name="department_id" id="" class="form-control">
                                                                            <option value="">Select Department</option>
                                                                            @foreach($departments as $department)
                                                                            <option value="{{$department->id}}" {{ $item->department_id ? 'selected' : '' }}>{{$department->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('department_id'))
                                                                            <span class="invalid-feedback">{{ $errors->first('department_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Role<span class="text-danger">*</span> :</label>
                                                                        <select name="role" id="" class="form-control">
                                                                            @foreach($roles as $role)
                                                                            <option value="{{$role->name}}" {{ $item->hasRole($role->name) ? 'selected' : '' }}>{{$role->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('role'))
                                                                            <span class="invalid-feedback">{{ $errors->first('role') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                                                <button type="sumit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
    </div>
@include('admin.inc.delete-modal')
@endsection

@section('extra_js')
<script>
    //Delete Code
    function handle(id) {
       var url = "{{ route('user.destroy', 'user_id') }}".replace('user_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
    }
</script>
@endsection
