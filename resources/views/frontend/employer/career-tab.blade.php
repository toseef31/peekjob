		@extends('frontend.layouts.app')

		@section('title', 'Career Tab')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">

			<div class="follow-companies6" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px">@lang('home.APPLICATION')</h3>
				</div>



				<div class="col-md-12 company-box-left">
				<span><b>@lang('home.facebookcareerstab')</b></span>
				<br>
				<br>
				
				<span><b>@lang('home.addcareerstab')</b></span>
				<br>
				<span style="font-size: 12px;">@lang('home.careertab1')<b>@lang('home.careerstab')</b> @lang('home.careertab2')</span>
				<br>
				<br>
				<br>
				   <button type="submit" class="btn btn-primary">@lang('home.facebookcareerstab')</button>
				</div>
			   
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
		</script>
		@endsection