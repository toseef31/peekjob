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

date_default_timezone_set("Asia/Seoul");
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@yield('title') &raquo; {{ $headerWeb['webTitle'] }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="_token" constant="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ $headerFavicon }}">
		
         <!-- Bootstrap -->
         <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('frontend-assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/rcrop.min.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ asset('frontend-assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/sajid.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/css/select2.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend-assets/css/select3.css') }}" rel="stylesheet">
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
		<style>
		
		.mat-card{transition:box-shadow 280ms cubic-bezier(.4,0,.2,1);display:block;position:relative;padding:24px;border-radius:2px}.mat-card:not([class*=mat-elevation-z]){box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}@media screen and (-ms-high-contrast:active){.mat-card{outline:solid 1px}}.mat-card-flat{box-shadow:none}.mat-card-actions,.mat-card-content,.mat-card-subtitle,.mat-card-title{display:block;margin-bottom:16px}.mat-card-actions{margin-left:-16px;margin-right:-16px;padding:8px 0}.mat-card-actions-align-end{display:flex;justify-content:flex-end}.mat-card-image{width:calc(100% + 48px);margin:0 -24px 16px -24px}.mat-card-xl-image{width:240px;height:240px;margin:-8px}.mat-card-footer{display:block;margin:0 -24px -24px -24px}.mat-card-actions .mat-button,.mat-card-actions .mat-raised-button{margin:0 4px}.mat-card-header{display:flex;flex-direction:row}.mat-card-header-text{margin:0 8px}.mat-card-avatar{height:40px;width:40px;border-radius:50%;flex-shrink:0}.mat-card-lg-image,.mat-card-md-image,.mat-card-sm-image{margin:-8px 0}.mat-card-title-group{display:flex;justify-content:space-between;margin:0 -8px}.mat-card-sm-image{width:80px;height:80px}.mat-card-md-image{width:112px;height:112px}.mat-card-lg-image{width:152px;height:152px}@media (max-width:600px){.mat-card{padding:24px 16px}.mat-card-actions{margin-left:-8px;margin-right:-8px}.mat-card-image{width:calc(100% + 32px);margin:16px -16px}.mat-card-title-group{margin:0}.mat-card-xl-image{margin-left:0;margin-right:0}.mat-card-header{margin:-8px 0 0 0}.mat-card-footer{margin-left:-16px;margin-right:-16px}}.mat-card-content>:first-child,.mat-card>:first-child{margin-top:0}.mat-card-content>:last-child:not(.mat-card-footer),.mat-card>:last-child:not(.mat-card-footer){margin-bottom:0}.mat-card-image:first-child{margin-top:-24px}.mat-card>.mat-card-actions:last-child{margin-bottom:-16px;padding-bottom:0}.mat-card-actions .mat-button:first-child,.mat-card-actions .mat-raised-button:first-child{margin-left:0;margin-right:0}.mat-card-subtitle:not(:first-child),.mat-card-title:not(:first-child){margin-top:-4px}.mat-card-header .mat-card-subtitle:not(:first-child){margin-top:-8px}.mat-card>.mat-card-xl-image:first-child{margin-top:-8px}.mat-card>.mat-card-xl-image:last-child{margin-bottom:-8px}</style>
    </head>
    <body>
        @include('frontend.includes.header')

        @yield('inner-header')

        @yield('content')

        @include('frontend.includes.footer')
    
    <a href="{{ url('/subscribe')}}" class="job-notification" style="@if(session()->has('bell_color')) background:{{ session()->get('bell_color') }} @endif">
        <i class="fa fa-bell" style=" @if(session()->has('bell_color')) background:{{ session()->get('bell_color') }} @endif"></i>
        <span class="notification-label">@if(session()->has('bell_color')) @if(session()->get('bell_color') == '#45c536') @lang('home.Subscribed') @else @lang('home.Subscribeforjobnotifications') @endif @else @lang('home.Subscribeforjobnotifications') @endif</span>
    </a>

    <a href="#" class="back-to-top" style="display: inline;">
        <i class="fa fa-arrow-up"></i>
    </a>
    <input type="hidden" value="{{$app->userId}}" id="hide_value">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
        
         <script src="{{ asset('frontend-assets/js/rcrop.min.js') }}" ></script>
        <script src="{{ asset('frontend-assets/js/sajid.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('frontend-assets/js/select2.js') }}"></script>
		<script src="{{ asset('frontend-assets/js/select3.js') }}"></script>
        @if(app()->getLocale() == "kr")
			<script src="{{ asset('frontend-assets/js/bootstrap-datetimepicker_kr.js') }}"></script>
		@else
			<script src="{{ asset('frontend-assets/js/bootstrap-datetimepicker.js') }}"></script>
		@endif 
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
       <!-- check if session is set then not include else include -->
        @if(!session()->has('jcmUser'))<script src="{{ asset('frontend-assets/js/feedBackBox.js') }}"></script>@endif
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
    function session_id(){
        var sess=$('#hide_value').val();
        console.log(sess+'sdada');
       }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".location").select2();
    });
</script>
<!--FeedBack Form-->
<!-- <script src="js/feedBackBox.js"></script> -->
@if(!session()->has('jcmUser'))<script type="text/javascript">
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

    <script type="text/javascript">

         $(document).ready(function()
        {

            $("#hp_text").cooltext({
                cycle:true,
                sequence:[

                    {action:"update", text:"전세계 회원 모두 무료 정보열람 등록 지원 제공!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},

					{action:"update", text:"실시간 화상채팅으로 전세계 회원과 무료면접 지원!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},
					
					{action:"update", text:"회원가입 순간 정보열람 등록 지원 실시간 지원!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},

					{action:"update", text:"세계최초 화상면접으로 전세계 회원들과 실시간 인터뷰 지원!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},

					{action:"update", text:"다중ㆍ다자간 화상채팅면접 해외 실시간 인터뷰 지원!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

        });



        $(document).ready(function()
        {

            $("#hp_text2").cooltext({
                cycle:true,
                sequence:[
                    {action:"update", text:"Jobcallme provides free information access, registration, and support to all members of the world!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:4, animation:"cool266", stagger:600},

					{action:"update", text:"Jobcallme Live video chatting is the best interview,you can trust among members around the world!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:4, animation:"cool266", stagger:600},
					
					{action:"update", text:"You can view, register and support the information on a real-time basis for free when joined!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:4, animation:"cool266", stagger:600},

					{action:"update", text:"You can interview global member via Jobcallme the world's first video chat!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:4, animation:"cool266", stagger:600},

					{action:"update", text:"Available with multi-party video chatting from all over the world through real-time interviews!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:4, animation:"cool266", stagger:600}
                ]
            });

        });



		 $(document).ready(function()
        {

            $("#hp_text3").cooltext({
                cycle:true,
                sequence:[

                    {action:"update", text:"전세계 잡콜미 회원들께서 회원님의 실시간 기사를 기다리고 있습니다!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},					

					{action:"update", text:"지금 등록해서 핫이슈를 전세계 회원들에게 알리십시오!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

        });



        $(document).ready(function()
        {

            $("#hp_text4").cooltext({
                cycle:true,
                sequence:[
                    {action:"update", text:"JCM Members around the world are waiting for your real-time article!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:2, animation:"cool266", stagger:600},
					
					{action:"update", text:"Register now and let your JCM world members know about hot issues!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

        });


		$(document).ready(function()
        {

            $("#hp_text5").cooltext({
                cycle:true,
                sequence:[

                    {action:"update", text:"지식홍보는 사업주님의 성공 키워드입니다!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},					

					{action:"update", text:"지금 지식등록 홍보를 전세계에 알리십시오!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

        });



        $(document).ready(function()
        {

            $("#hp_text6").cooltext({
                cycle:true,
                sequence:[
                    {action:"update", text:"Knowledge PR is the keyword of success for your business!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:2, animation:"cool266", stagger:600},
					
					{action:"update", text:"Announce your knowledge registration promotion worldwide!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

        });

		$(document).ready(function()
        {

            $("#hp_text7").cooltext({
                cycle:true,
                sequence:[

                    {action:"update", text:"채용정보!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600},					

					{action:"update", text:"지금 지식등록 홍보를 전세계에 알리십시오!"},
					{action:"animation", animation:"cool16", stagger:600},					
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

        });



        $(document).ready(function()
        {

            $("#hp_text8").cooltext({
                cycle:true,
                sequence:[
                    {action:"update", text:"Knowledge PR is the keyword of success for your business!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:2, animation:"cool266", stagger:600},
					
					{action:"update", text:"Announce your knowledge registration promotion worldwide!"},
					{action:"animation", animation:"cool16", stagger:600},
					{action:"animation", animation:"cool103", stagger:600},
					{action:"animation", delay:2, animation:"cool266", stagger:600}
                ]
            });

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
			$(".select3").select3();
            @if(!session()->has('jcmUser'))$('#feedback-Form').feedBackBox();@endif
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
<script type="text/javascript">
   var isFirst = 0;
var token = "{{ csrf_token() }}";
/*$(document).ready(function(){
    $('.search-job').submit();
    getStates($('.job-country option:selected:selected').val());
})*/
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            console.log(response);
            /*var obj = $.parseJSON(response);*/
            $(".job-state").html('').trigger('change');
            /*var newOption = new Option('@lang("home.s_state")', '0', true, false);*/
            $(".job-state").append(response).trigger('change');
            /*$.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(firstCapital(k.name), k.id, true, vOption);
                $(".job-state").append(newOption);
            })
            $(".job-state").trigger('change');*/
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId)
})
function getCities(stateId){
    if(stateId == '0'){
        $(".job-city").html('').trigger('change');
        /*var newOption = new Option('@lang("home.s_city")', '0', true, false);*/
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            console.log(response);
            /*var obj = $.parseJSON(response);*/
            $(".job-city").html('').trigger('change');
            /*var newOption = new Option('@lang("home.s_city")', '0', true, false);*/
            $(".job-city").append(response).trigger('change');
            /*$.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })*/
        }
    })
}
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
$('form.search-job').submit(function(e){
    //$('.search-job button[name="save"]').prop('disabled',true);
    $('.search-job .token').val(token);
    $.ajax({
        type: 'post',
        data: $('.search-job').serialize(),
        url: "{{ url('jobs/search') }}?_find="+isFirst,
        success: function(response){
            $('.show-jobs').html(response);
            $('.search-job button[name="save"]').prop('disabled',false);

            $('.jobs-suggestions').hover(function () {
                $(this).children(".js-action").fadeIn('slow');

            });
            $('.jobs-suggestions').mouseleave(function () {
                $(this).children(".js-action").fadeOut('fast');
            });

            $('.search-job select option[value=""]').prop('selected',true);
            $('.search-job input').val('');
            $('.search-job .job-city').html('<option value="">@lang("home.s_city")</option>');
        }
    })
    isFirst = 1;
    e.preventDefault();
})
function saveJob(jobId,obj){
    if($(obj).hasClass('btn-default')){
        var type = 'save';
    }else{
        var type = 'remove';
    }
    $.ajax({
        url: "{{ url('account/jobseeker/job/action') }}?jobId="+jobId+"&type="+type,
        success: function(response){
            if($.trim(response) == 'redirect'){
                window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
                if($(obj).hasClass('btn-default')){
                    $(obj).removeClass('btn-default');
                    $(obj).addClass('btn-success');
                    $(obj).text('@lang("home.saved")');
                }else{
                    $(obj).removeClass('btn-success');
                    $(obj).addClass('btn-default');
                    $(obj).text('@lang("home.save")');
                }
            }
        }
    })
}


$("#footinfobutton").click(function(){
    $("#footinfodiv").toggle();
});

function myfootinfo() {
    var x = document.getElementById("footinfobutton");
	var x2 = document.getElementById("footinfobutton2");
    if (x.innerHTML === "@lang('home.jcm-foot2')") {
        x.innerHTML = "@lang('home.jcm-foot1')";
		x2.innerHTML = "@lang('home.jcm-foot1-1')";
    } else {
        x.innerHTML = "@lang('home.jcm-foot2')";
		x2.innerHTML = "@lang('home.jcm-foot2-1')";
    }
}
    
</script>

@if(Session()->has('fNotice'))
<div class="popup" data-popup="popup-1010" style="z-index: 99;">
    <div class="popup-inner">
        <p>@lang('home.'.Session()->get('fNotice'))</p>
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