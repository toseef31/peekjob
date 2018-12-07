<?php 
$headerWeb = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$headerFavicon = url('/website/favicon.ico');
if(file_exists('/website/'.$headerWeb['webFavicon'])){
    $headerFavicon = url('/website/'.$headerWeb['webFavicon']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') &middot; {{ $headerWeb['webTitle'] }}</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <meta name="theme-color" content="#ffffff">
        <link rel="shortcut icon" href="{{ $headerFavicon }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/vendor.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap-toggle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/elephant.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/cropper.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/application.min.css') }}">
        <style type="text/css"> .pagination {float: right;} </style>
        @if(!JobCallMe::isAdminLoggedIn())
            <script type="text/javascript">window.location.href = "{{ url('admin/login') }}"</script>
        @endif
    </head>
    <body class="layout layout-header-fixed layout-sidebar-fixed layout-footer-fixed">
        @include('admin.includes.header')
        <div class="layout-main">
            @include('admin.includes.nav')

            @yield('content')

            @include('admin.includes.footer')
        </div>
        <script src="{{ asset('admin-assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('admin-assets/js/elephant.min.js') }}"></script>
        <script src="{{ asset('admin-assets/js/application.min.js') }}"></script>
        <script src="{{ asset('admin-assets/js/bootstrap-toggle.min.js') }}"></script>
        <script src="{{ asset('admin-assets/js/cropper.js') }}"></script>

        @yield('page-footer');

        @if(Session::has('alert') && isset(Session::get('alert')['message']))
            @if(Session::get('alert')['type'] == 'success')
                <script type="text/javascript">
                    $(document).ready(function(){
                        toastr.success('{{Session::get('alert')['message']}}');
                    })
                </script>
            @endif
        @endif
    </body>
</html>
<div class="ajax-laoding" style="display:none;"> Please Wait ... </div>
<style type="text/css">
.ajax-laoding {background-color: #e08e0b;border-radius: 3px;color: #ffffff;height: auto;left: 46%;opacity: 0.99;padding: 5px 13px;position: fixed;top: 10%;width: auto;z-index: 100001;}
.ajax-class { opacity: 0.5 }
.is-loading {cursor: wait;}
</style>
<script type="text/javascript">

var isAjaxRunning = false;
$( document ).ajaxStart(function() {
    $('.ajax-laoding').show();
    $('.layout-content').addClass('ajax-class');
    $('body').addClass('is-loading');
    isAjaxRunning = true;
});
$( document ).ajaxStop(function() {
    $('.ajax-laoding').hide();
    $('.layout-content').removeClass('ajax-class');
    $('body').removeClass('is-loading');
    isAjaxRunning = false;
});
</script>