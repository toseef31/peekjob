@extends('admin.layouts.app')

@section('title', 'Website')

@section('content')
<?php
$webLogo = url('/website/logo.png');
if(file_exists('/website/'.$web['webLogo'])){
    $webLogo = url('/website/'.$web['webLogo']);
}
$favicon = url('/website/favicon.ico');
if(file_exists('/website/'.$web['webFavicon'])){
    $favicon = url('/website/'.$favicon['webFavicon']);
}
?>

    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Website</span>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Website Title</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="webTitle" value="{{ $web['webTitle'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="phoneNumber" value="{{ $web['phoneNumber'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="email" value="{{ $web['email'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="address" value="{{ $web['address'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Website Logo</label>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-file">
                                            <input class="form-control p-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="webLogo" class="file-upload-input" type="file" onchange="getFileName(this,'p-image')">
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
                                            <img src="{{ $webLogo }}" alt="M" style="max-width: 200px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Website Favicon</label>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-file">
                                            <input class="form-control t-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="webFavicon" class="file-upload-input" type="file" onchange="getFileName(this,'t-image')">
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
                                            <img src="{{ $favicon }}" alt="M" style="max-width: 200px;">
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
function getFileName(obj,aClass){
    var vValue = $(obj).val();
   // alert(vValue);
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.'+aClass).val(vValue);
}
</script>
@endsection