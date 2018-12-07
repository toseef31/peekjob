
@extends('frontend.layouts.app')

@if($pageType == 'register')
    @section('title', 'Register')
@else
    @section('title','Login')
@endif

@section('content')
<?php
$next = Request::input('next') != '' ? '?next='.Request::input('next') : '';
?>
<section id="loginRegistration">
    <div class="container">
        <div id="loginBox" class="col-md-6 col-md-offset-3 loginBox" style="display:{{ $pageType != 'register' ? 'block' : 'none' }}">
            <h3>@lang('home.loginaccount')</h3>
            <form id="loginForm" action="{{ url('account/login'.$next) }}" method="post">
                @if(Session::has('loginAlert'))
                    <div class="alert alert-danger">
                        {{Session::get('loginAlert')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                 @if(Session::has('emailAlert'))
                    <div class="alert alert-success">
                        {{Session::get('emailAlert')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('subscribeAlert'))
                    <div class="alert alert-danger">
                        {{Session::get('subscribeAlert')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{ csrf_field() }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('home.email-text')">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="@lang('home.Password-text')">
                 <span toggle="#password-field" class="fa fa-fw fa-eye field-icon " id="toggle-passwords"></span>
                </div>
				<div class="">
				<h5><a href="{{url('password/reset')}}">@lang('home.forgetpassword')</a></h5>
				</div>
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1">@lang('home.remember')
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block login-btn" name="login">@lang('home.login')</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default btn-block" onClick="switchPage('register')">@lang('home.register')</button>
                    </div>
                </div>
               
            </form>
            <div class="col-md-12 sns-box">
                <p>@lang('home.loginusing')</p>
                <button class="fb-btn">
                    <a style="color:white" href="{{url('/fbApi')}}">FACEBOOK</a>
                </button> 
                <button class="google-btn">
                    <a style="color:white" href="{{url('/googleApi')}}">GOOGLE</a>
                </button>
                <button class="in-btn">
                    <a style="color:white" href="{{url('/lnApi')}}">LINKEDIN</a>
                </button>
                <!--<button class="insta-btn">
                    <a style="color:white" href="{{url('/instaApi')}}">Instagram</a>
                </button>-->
            </div>
			<div>
				<p class="text-center show-loginBox" style="color:#2e6da4">※ @lang('home.singupinfo')</p>
			</div>
        </div> 		

        <div id="signupBox" class="col-md-6 col-md-offset-3 signupBox" style="display:{{ $pageType == 'register' ? 'block' : 'none' }}">
            <h3>@lang('home.createaccount')</h3>
            <form id="signUpForm" action="{{ url('account/register') }}" method="post">
                @if(Session::has('registerAlert'))
                    <div class="alert alert-danger">
                        {{Session::get('registerAlert')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('fNotice'))
                    <div class="alert alert-danger">
                        {{Session::get('fNotice')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul style="list-style:none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ csrf_field() }}
                
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('home.email-text')" requried>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd" onblur="sendpassword(this.value)" name="password" value="{{ old('password') }}" placeholder="@lang('home.Password-text')">
                    <!-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon " id="toggle-password"></span> -->
                    <p style="color:#2e6da4;font-size:12px;" id="errorpass"></p>
                </div>
                    <div class="form-group">
                    <input type="password" class="form-control" id="confirm_password"   value="{{ old('password') }}" placeholder="@lang('home.Re-enter Password-text')">
                     <span id='message' style="font-size:12px;"></span>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" placeholder="@lang('home.fname')" requried>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="@lang('home.lname')" requried>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <select class="form-control select2 job-country" name="country">
                             <option value="">@lang('home.selectCountry')</option>
                        @foreach(JobCallMe::getJobCountries() as $country)
                            <option value="{{ $country->id }}">@lang('home.'.$country->name)</option>
                        @endforeach
                    </select>
					<p class="terms-condition" style="padding-top:5px;color:#2e6da4;"><img src="../frontend-assets/images/info-icon.png"> @lang('home.alphabetical order')</p>
                </div>
                <div class="form-group">
                    <select class="form-control select2 job-state" name="state"><option value="">@lang('home.s_state')</option></select>
                </div>
                <div class="form-group">
                    <select class="form-control select2 job-city" name="city"><option value="">@lang('home.s_city')</option></select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="@lang('home.phonenumber-text')" requried>
                </div>
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="job-alert" type="checkbox" name="jobalert" value="Y"> @lang('home.jobalert')
                        </label>
                    </div>
                </div>
                <div>
                    <input type="checkbox" name="agree" value="agree" id="agree" required>
                    <label for="agree">
                        <p class="terms-condition"><a href="{{ url('terms-conditions') }}">@lang('home.term')</a> @lang('home.tos') <a href="{{ url('privacy-policy') }}">@lang('home.privacy')</a> @lang('home.agree')<!-- @lang('home.website') --></p>    
                    </label>
                </div>
                <button id="regbtn" type="submit" class="btn btn-primary btn-block" name="register">@lang('home.register')</button>
                <p class="text-center show-loginBox">@lang('home.alreadyaccount') <a href="javascript:;" onclick="switchPage('login')">@lang('home.loginhere')</a></p>

                <div class="col-md-12 sns-box"> 
                    <p>@lang('home.loginusing')</p> 
                    <button class="fb-btn">
                        <a style="color:white" href="{{url('/fbApi')}}">FACEBOOK</a>
                    </button> 
                    <button class="google-btn">
                        <a style="color:white" href="{{url('/googleApi')}}">GOOGLE</a>
                    </button>
                    <button class="in-btn">
                        <a style="color:white" href="{{url('/lnApi')}}">LINKEDIN</a>
                    </button>
					 
                </div>
				<div style="padding-top:20px">
				   <p class="text-center show-loginBox" style="color:#2e6da4"><img src="../frontend-assets/images/info-icon.png">@lang('home.singupinfo')</p>
				</div>
            </form>
        </div>
		<div class="col-md-12" style="padding-top:20px">
				<p class="text-center show-loginBox" style="color:#2e6da4"><img src="../frontend-assets/images/info-icon.png"> @lang('home.videochat_text')</p>
			</div>
    </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.field-icon {
  float: right;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  right: 10px;
}

/*.select2-selection__rendered {background-color: #fff;}*/
</style>
<script type="text/javascript">
$(document).ready(function(){
    function shows() {
    var p = document.getElementById('login-password');
    p.setAttribute('type', 'text');
}

function hides() {
    var p = document.getElementById('login-password');
    p.setAttribute('type', 'password');
}

var pwShowns = 0;

document.getElementById("toggle-passwords").addEventListener("click", function () {
    if (pwShowns == 0) {
        pwShowns = 1;
        shows();
    } else {
        pwShowns = 0;
        hides();
    }
}, false);

/*function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("toggle-password").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);*/

$('#pwd, #confirm_password').on('keyup', function () {
    if ($('#pwd').val() == $('#confirm_password').val()) {
        $('#message').html('@lang("home.Password Matching")').css('color', 'green');
    } else 
        $('#message').html('@lang("home.Not Matching")').css('color', '#2e6da4');
});

    setTimeout(function(){
        getStates($('.job-country option:selected:selected').val());
    },700);
})
$(document).ready(function(){
    setTimeout(function(){
        getStates($('.job-country option:selected:selected').val());
    },700);
})
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            console.log(response);
            /*var obj = $.parseJSON(response);*/
            $(".job-state").html('').trigger('change');
            /*var newOption = new Option('Select State', '0', true, false);*/
            $(".job-state").append(response).trigger('change');
            /*$.each(obj,function(i,k){
                var newOption = new Option(k.name, k.id, true, false);
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
function getCities(countryId){
    $.ajax({
        url: "{{ url('account/get-city') }}/"+countryId,
        success: function(response){
            console.log(response);
            /*var obj = $.parseJSON(response);*/
            $(".job-city").html('').trigger('change');
            /*var newOption = new Option('Select City', '0', true, false);*/
            $(".job-city").append(response).trigger('change');
            /*$.each(obj,function(i,k){
                var newOption = new Option(k.name, k.id, true, false);
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
function switchPage(page){
    if(page == 'login'){
        $('#signupBox').hide(); 
        $('#loginBox').show();
        var href = "{{ url('account/login'.$next) }}";
    }else{
        $('#loginBox').hide(); 
        $('#signupBox').show();
        var href = "{{ url('account/register') }}";
    }
    window.parent.history.pushState({path:href},'',href);
}
function sendpassword(pass){
 $.ajax({
    url:"{{ url('passwordValidate') }}",
    data:{password:pass,_token:"{{ csrf_token() }}"},
    type:"post",
    success:function(res){
        if(res == 1){
            $('#errorpass').text("@lang('home.passwordway')");
            $('#regbtn').attr('disabled','disabled');
        }else{
            $('#errorpass').text(" ");
            $('#regbtn').removeAttr('disabled');
        }
       
    }
 });
}
</script>
@endsection