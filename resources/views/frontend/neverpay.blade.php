@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<?php
$headerC = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
?>
<section id="company-box">
    <div class="container">
    <div class="col-md-10 company-box-left">
	<h3>@lang('home.Safety Tips for Safe Online Job Search in') @lang('home.'.JobCallMe::countryName(JobCallMe::getHomeCountry()))</h3>
    <h4>@lang('home.Employment Scams Warning - Tips for Safer Online Job Search') </h4>
<span style="color:red">@lang('home.Very Important You Must Read')</span><br>

@lang('home.safety_text')
<br>
<br>
<span>
@lang('home.Thank you')<br>
@lang('home.Customer Care')<br>
@lang('home.Jobcallme.com')
</span>
</span>


	</div>
        
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection