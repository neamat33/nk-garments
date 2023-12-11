@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ route('user.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name<span class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control input-rounded" name="name" value="{{ old('name') }}" placeholder="Name">
                                            @if($errors->has('name'))
                                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email<span class="text-danger">*</span> :</label>
                                            <input type="email" class="form-control input-rounded" name="email" value="{{ old('email') }}" placeholder="Email">
                                            @if($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Department :</label>
                                             <select name="department_id" id="" class="form-control">
                                                <option value="">Select Department</option>
                                                @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
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
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('role'))
                                                <span class="invalid-feedback">{{ $errors->first('role') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Password<span class="text-danger">*</span> :</label>
                                            <input type="password" class="form-control input-rounded" name="password" placeholder="******" autocomplete="off">
                                            @if($errors->has('password'))
                                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Password Confirmation<span class="text-danger">*</span> :</label>
                                            <input type="password" class="form-control input-rounded" name="password_confirmation" placeholder="******" autocomplete="off">
                                            @if($errors->has('password_confirmation'))
                                                <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <h4 class="final_text" style="text-align:center;"></h4>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
   <script>
 
        $('select[name="related_to_unit_id"]').change(function(){
            update_final_text();
        });

        $('select[name="related_sign"]').change(function(){
            update_final_text();
        });

        $('input[name="related_by"]').change(function(){
            update_final_text();
        });

        function update_final_text(){
            // alert("HELLO");
            var string ="1 ";
            string+=$('input[name="name"]').val();
            string+=" = 1";
            string+=$('select[name="related_to_unit_id"]').find(":selected").text();
            string+=" ";
            string+=$('select[name="related_sign"]').find(":selected").val();
            string+=" ";
            string+=$('input[name="related_by"]').val();
            $('.final_text').html(string);
        }
    </script>
@endsection
