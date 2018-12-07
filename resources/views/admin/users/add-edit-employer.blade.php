@extends('admin.layouts.app')

@if($rPath == 'edit')
    @section('title', 'Update User')
@else
    @section('title', 'Add User')
@endif
@section('content')
<?php 
$profilePhoto = '';
if($user['profilePhoto'] != ''){
    $profilePhoto = url('/profile-photos/'.$user['profilePhoto']);
}
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">{{ $rPath == 'edit' ? 'Update User' : 'Add User' }}</span>
                    <a class="btn btn-default pull-right" href="{{ url('admin/users/view') }}">Back</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal employers-form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="userId" value="{{ $userId }}">
                                <input type="hidden" name="prevLogo" value="{{ $user['profilePhoto'] }}">
                                <input type="password" name="upassword" value="" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        Required fields are marked *
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">First Name : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="firstName" required="" value="{{ $user['firstName'] != '' ? $user['firstName'] : old('firstName') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Last Name : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="lastName" required="" value="{{ $user['lastName'] != '' ? $user['lastName'] : old('lastName') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Email : *</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" required="" value="{{ $user['email'] != '' ? $user['email'] : old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Username : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="username" required="" value="{{ $user['username'] != '' ? $user['username'] : old('username') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Phone Number : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="phoneNumber" required="" value="{{ $user['phoneNumber'] != '' ? $user['phoneNumber'] : old('phoneNumber') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">password : *</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Profile Photo : *</label>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-file">
                                            <input class="form-control p-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="profilePhoto" class="file-upload-input" type="file" onchange="getFileName(this,'p-image')">
                                                    <span class="icon icon-image icon-lg"></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                            <img src="{{ $profilePhoto }}" alt="{{ $user['firstName'].' '.$user['lastName'] }}" style="max-width: 200px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">About Employer : *</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="about" style="resize: vertical;" required="">{{ $user['about'] != '' ? $user['about'] : old('about') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Company</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="companyId">
                                            <option value="0">Select Company</option>
                                            @foreach($companies as $x => $y)
                                                <option value="{{ $y->companyId }}" @if($user['companyId'] == $y->companyId) selected @endif>{{ $y->companyName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ url('admin/users/company/add') }}">Add Company</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Status :</label>
                                    <div class="col-md-6">
                                        <label class="custom-control custom-control-primary custom-radio">
                                            <input name="status" class="custom-control-input" type="radio" value="Y" {{ $user['user_status'] == 'Y' ? 'checked="checked"' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-label">Active</span>
                                        </label>
                                        <label class="custom-control custom-control-primary custom-radio">
                                            <input name="status" class="custom-control-input" type="radio" value="N" {{ $user['user_status'] != 'Y' ? 'checked="checked"' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-label">Inactive</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-primary do-save" type="submit" name="save">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();
    $('.date-picker').datepicker({format:'yyyy-mm-dd'})
})
function getFileName(obj,aClass){
    var vValue = $(obj).val();
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.'+aClass).val(vValue);
}
$('form.employers-form').submit(function(e){
    $('.employers-form .do-save').prop('disabled',true);
    $('.employers-form .do-save').addClass('spinner spinner-default');
})
</script>
@endsection