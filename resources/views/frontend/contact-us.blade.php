@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<?php
$headerC = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
?>
<section id="company-box">
    <div class="container">
    <div class="col-md-8 company-box-left">
		<h4>@lang('home.Have queries? We are here to help!')</h4>
<h5>@lang('home.Frequently Asked Questions')</h5>
<span>@lang('home.Save time and find answers to popular users queries, visit Frequently Asked Questions.')</span>
<hr>
<h4>@lang('home.Want to Apply for Jobs?')</h4>
@lang('home.Very simple and takes only few minutes.')
<ul style="margin-left:36px">
<li>@lang("home.Create your Account by visiting<a href='account/register'> New User Registration</a>")</li>
<li>@lang("home.Logon to your account and visit<a href='account/jobseeker/resume'>  Resume Builder</a>")</li>
<li>@lang("home.Visit<a href='jobs'>  Jobs</a> section apply online for jobs of your interest.")</li>
</ul>
<hr>
<h4>@lang('home.Want to Hire?')</h4>
@lang("home.Explore various<a href='account/employer'>  Online Recruitment </a> solutions, including <a href='account/employer/job/new'> Job Posting</a> and<a href='account/employer'>  Resumes Database Search.")</a>
<hr>
<h4>@lang('home.Legal Stuff')</h4>
<ul style="margin-left:36px">
<li><a href='privacy-policy'>@lang('home.Privacy Policy')</a></li>
<li><a href='picture-policy'>@lang('home.Picture Policy')</a></li>
<li><a href='terms-conditions'>@lang('home.Terms of Services')</a></li>
<!-- <li><a href='refund-policy'>@lang('home.Refund Policy')</a></li> -->
</ul>

	</div>
        <div class="col-md-4">
            <div class="company-box-right">
                <h4>@lang('home.contactdetail')</h4>
                <hr>
                <div class="row">
                    <div class="col-md-3"><strong>@lang('home.phone')</strong></div>
                    <div class="col-md-9">{{ $headerC['phoneNumber'] }}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"><strong>@lang('home.email')</strong></div>
                    <div class="col-md-9"><a href="#">{{ $headerC['email'] }}</a> </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"><strong>@lang('home.address')</strong></div>
                    <div class="col-md-9">
                        {{ $headerC['address'] }}
                    </div>
                </div>
            </div>
			    <div class="company-box-right">
            <h3>@lang('home.helpquery')</h3>
           
            <hr>
            
            <form class="contact-us-form" method="post" action="{{ url('sendquery')}}">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                         </ul>
                    </div>
                @endif
                  @if ($message = Session::get('query'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('query');?>
                @endif
                {{ csrf_field() }}
            	<div class="form-group">
            		<label>@lang('home.yourname')</label>
            		<input type="text" class="form-control" name="name" required="" value="{{ old('name') }}">
            	</div>
            	<div class="form-group">
            		<label>@lang('home.youremail')</label>
            		<input type="email" class="form-control" name="email" required="" value="{{ old('email') }}">
            	</div>
            	<div class="form-group">
            		<label>@lang('home.yourquery')</label>
            		<textarea class="form-control" name="msg" style="resize: vertical;" placeholder="@lang('home.typequery')" rows="10" required="">{{ old('query') }}</textarea>
            	</div>
            	<div class="form-group">
            		<button class="btn btn-block btn-primary" type="submit" name="submit">@lang('home.submit')</button>
            	</div>
            </form>
        </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection