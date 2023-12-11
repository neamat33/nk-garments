@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Roles</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-xs-8 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 my-5">
                                            <h4 class="text-center">All Permission Lists </h4>
                                            <div class="form-group my-5">
                                                <div class="row">
                                                    @foreach($permission->groupBy('feature') as $groupName => $groupedPermissions)
                                                        <div class="col-md-3">
                                                            <h6 class="mt-5 mb-2">{{ $groupName }}</h6>
                                                            @foreach($groupedPermissions as $value)
                                                                <label>
                                                                    {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                                    {{ $value->name }}
                                                                </label>
                                                                <br />
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
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
