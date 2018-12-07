@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
<?php 
$profileLogo = url('/profile-photos/profile-logo.jpg');
if(file_exists('profile-photos/'.$user->profilePhoto)){
    $profileLogo = url('/profile-photos/'.$user->profilePhoto);
}
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Profile</span>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="password" name="upassword" value="" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">First Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="firstName" value="{{ $user->firstName }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Last Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="lastName" value="{{ $user->lastName }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="username" value="{{ $user->username }}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="phoneNumber" value="{{ $user->phoneNumber }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Profile Photo</label>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-file">
                                            <input class="form-control p-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="profileImage" class="file-upload-input" type="file" onchange="getFileName(this)">
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
                                            <img src="{{ $profileLogo }}" alt="M" style="max-width: 200px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-primary" type="submit" name="save">Save</button>
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
function getFileName(obj){
    var vValue = $(obj).val();
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.p-image').val(vValue);
}
</script>
@endsection