@extends('admin.admin-dashboard')
@section('content')
@section('extra_css')
<style>
    .holder {
        height: 150px;
        width: 200px;
        border: 2px solid rgb(255, 251, 251);
    }
    .upload_img {
        max-width: 190px;
        max-height: 140px;
        min-width: 190px;
        min-height: 140px;
    }
    /* input[type="file"] {
        margin-top: 5px;
    } */
    .heading {
        font-family: Montserrat;
        font-size: 45px;
        color: green;
    }
</style>
@endsection
<div class="content-body default-height">
    <div class="container-fluid">
        <!-- Profile Section -->
        <div class="row">
            <!-- Profile Card -->
            <div class="col-xl-3 col-lg-4">
                <div class="clearfix">
                    <div class="card profile-card author-profile m-b30">
                        <div class="card-body">
                            <div class="p-5">
                                <div class="author-profile text-center">
                                    <div class="author-media mb-2">
                                        <img src="{{ asset($user->image) }}" alt="User Image" style="border-radius: 50%">
                                    </div>
                                    <div class="author-info">
                                        <h6 class="title text-light"><strong>{{$user->name}}</strong></h6>
                                        <span class="text-light">
                                            @foreach(auth()->user()->getRoleNames() as $role)
                                            {{ ucfirst($role) }}
                                            @endforeach
                                        </span>
								<div class="change_profile mt-2">
                                    @can('profile')
									<a href="{{route('profile.index')}}" class="btn btn-primary"> Profile</a>
                                    @endcan
                                    @can('change_password')
									<a href="{{route('change.password')}}" class="btn btn-primary"> Password</a>
                                    @endcan
								</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-3">
                                <div class="form-control rounded text-center" style="line-height: 35px"><strong>Profile</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Section -->
            <div class="col-xl-9 col-lg-8">
                <div class="card profile-card m-b30">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-key"></i> Update Password</h4>
                    </div>
                    <form class="profile-form" method="POST" action="{{ route('update.password') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Name Input -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="Name">Current Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="current_password" value="" placeholder="Current Password">
                                        @if($errors->has('current_password'))
                                            <span class="invalid-feedback">{{ $errors->first('current_password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="Email">New Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" value="" placeholder="New Password">
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="Email">Confirm Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" value="" placeholder="Confirm Password">
                                        @if($errors->has('password_confirmation'))
                                            <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra_js')

@endsection
