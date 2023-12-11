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
</style>
@endsection
<div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setting</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ route('update_setting') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Company<span class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control input-rounded" name="company" value="{{ $setting->company }}" placeholder="company">
                                            @if($errors->has('company'))
                                                <span class="invalid-feedback">{{ $errors->first('company') }}</span>
                                            @endif
                                        </div>
                                         <div class="mb-3 col-md-6">
                                            <label class="form-label">Phone :</label>
                                            <input type="text" class="form-control input-rounded" name="phone" value="{{ $setting->phone }}" placeholder="Phone">
                                            @if($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email :</label>
                                            <input type="text" class="form-control input-rounded" name="email" value="{{ $setting->email }}" placeholder="Email">
                                            @if($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Invoice logo type :</label>
                                             <select name="invoice_logo_type" id="" class="form-control">
                                                <option value="Logo">Logo</option>
                                                <option value="Name">Name</option>
                                                <option value="Both">Both</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Logo</label>
                                            <div class="holder">
                                                <img id="imgPreview" src="{{ asset($setting->logo) }}" alt="placeholder" class="upload_img "/>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control" name="logo" id="photo">
                                                </div>
                                                <span class="input-group-text search_icon">Upload</span>
                                            </div>
                                        </div>
                                              <div class="mb-3 col-md-6">
                                            <label class="form-label">Address :</label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="10">{{$setting->address}}</textarea>
                                            @if($errors->has('address'))
                                                <span class="invalid-feedback">{{ $errors->first('address') }}</span>
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
$(document).ready(()=>{
      $('#photo').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
    });
</script>
@endsection
