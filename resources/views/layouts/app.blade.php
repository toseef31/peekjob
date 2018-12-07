<?php 
$headerWeb = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$headerFavicon = url('/website/favicon.ico');
if(file_exists('/website/'.$headerWeb['webFavicon'])){
    $headerFavicon = url('/website/'.$headerWeb['webFavicon']);
}
$navArr = array('jobseeker','manage','resume','employer');
$navPage =  Request::segment(2);

$app = Session::get('jcmUser');
$next = Request::route()->uri;
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@yield('title') &raquo; {{ $headerWeb['webTitle'] }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ $headerFavicon }}">
		
         <!-- Bootstrap checking -->
        <link href="{{ asset('frontend-assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/sajid.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/select2.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	    <link href="{{ asset('frontend-assets/css/component.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/hover-min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/ihover.css') }}" rel="stylesheet">
    	<link href="{{ asset('frontend-assets/css/ticker.css') }}" rel="stylesheet">
    	<link href="{{ asset('frontend-assets/css/font-awesome.css') }}" rel="stylesheet">
    <!--FeedBack Form-->
    	<link href="{{ asset('frontend-assets/css/feedBackBox.css') }}" rel="stylesheet">
        <!--Latest Job Slide -->
        <!-- <link href="{{ asset('frontend-assets/css/ticker.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('frontend-assets/css/toastr.css') }}" rel="stylesheet">
        <!--FeedBack Form-->
        <link href="{{ asset('frontend-assets/css/feedBackBox.css') }}" rel="stylesheet">
        <!-- pace -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/pace/pace-theme-flat-top.css') }}">
		
        <?php if(in_array($navPage, $navArr)){ if(!Session::has('jcmUser')){ ?>
            <script type="text/javascript"> window.location.href = "{{ url('account/login?next='.$next) }}"</script>
        <?php }} ?>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9433529110214297",
    enable_page_level_ads: true
  });
</script>
        <style type="text/css">
            .mce-branding-powered-by {display: none;}
            .udp-items li {width: 9%;}
			
        </style>
		
    </head>
    <body>
        @include('frontend.includes.header')

        @yield('inner-header')

        @yield('content')

        @include('frontend.includes.footer')

       <a href="#" class="job-notification">
        <i class="fa fa-bell"></i>
        <span class="notification-label">Subscribe for job notifications</span>
    </a>

    <a href="#" class="back-to-top" style="display: inline;">
        <i class="fa fa-arrow-up"></i>
    </a>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('frontend-assets/js/jquery.min.js') }}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('frontend-assets/js/sajid.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/select2.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/bootstrap-datetimepicker.js') }}"></script>
		<!--For Text animation-->
         <script src="{{ asset('frontend-assets/js/TweenMax.min.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/cooltext.animate.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/cooltext.min.js') }}"></script>
    <!--Sliding Latest Job-->
<script src="{{ asset('frontend-assets/js/ticker.js') }}"></script>
        <!--Sliding Latest Job-->
        <!-- <script src="{{ asset('frontend-assets/js/ticker.js') }}"></script> -->
        <script src="{{ asset('frontend-assets/js/toastr.min.js') }}"></script>
        <!--FeedBack Form-->
        <script src="{{ asset('frontend-assets/js/feedBackBox.js') }}"></script>
        <!-- pace -->
        <script type="text/javascript" src="{{ asset('frontend-assets/pace/pace.js') }}"></script>
        <script src="{{ asset('frontend-assets/tinymce/tinymce.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
		
<!--Top Navigation active li-->
<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".location").select2();
    });
</script>
<!--FeedBack Form-->
<script src="js/feedBackBox.js"></script>
@if(!session()->has('jcmUser'))
<script type="text/javascript">
    $(document).ready(function () {
        $('#feedback-Form').feedBackBox();
    });
</script>
@endif
<!--Scroll to top Button-->
<script>
    jQuery(document).ready(function() {
        var offset = 250;
        var duration = 300;
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.back-to-top').fadeIn(duration);
            } else {
                jQuery('.back-to-top').fadeOut(duration);
            }
        });
        jQuery('.back-to-top').click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        })
    });
</script>

   
        <!--Scroll to top Button-->
        <script>
        $(document).ready(function () {
            var url = window.location;
            $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
            $('ul.nav a').filter(function() {
                return this.href == url;
            }).parent().addClass('active');
        });
        $(document).ready(function() {
            $(".location,.select2").select2();
            $('#feedback-Form').feedBackBox();
            var offset = 250;
            var duration = 300;
            $(window).scroll(function() {
                if ($(this).scrollTop() > offset) {
                    $('.back-to-top').fadeIn(duration);
                } else {
                    $('.back-to-top').fadeOut(duration);
                }
            });
            $('.back-to-top').click(function(event) {
                event.preventDefault();
                $('html, body').animate({scrollTop: 0}, duration);
                return false;
            })
            $('.date-picker').datetimepicker({
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: 'yyyy-mm-dd'
            });
        });
        $(document).ajaxStart(function() { Pace.restart(); });
        </script>
        @yield('page-footer')
    </body>
</html>
@if(Session()->has('fNotice'))
<div class="popup" data-popup="popup-1010">
    <div class="popup-inner">
        <p>{!! Session()->get('fNotice') !!}</p>
        <a class="popup-close" data-popup-close="popup-1010" href="#">&times;</a>
    </div>
</div>
<button class="btn btn-block" data-popup-open="popup-1010" style="display: none;" id="popup-1010">ONotice</button>
<script type="text/javascript">
    $('[data-popup="popup-1010"]').fadeIn(300);
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
        e.preventDefault();
    });
    
   
</script>
{{ Session()->forget('fNotice') }}
@endif