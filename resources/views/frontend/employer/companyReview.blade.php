@extends('frontend.layouts.app')

@section('title', "CompanyReview")

@section('content')
<?php 
$reviewSelect = ['Excellent','Verygood','Good','Fair','Poor'];
$jobtype = ['Part Time','Intership','Seasonal','Temporary/Contract','Work Study'];
?>

<div class="container margintop bg-white content-area">
	<form method="post" action="{{ url('account/employer/company/addreview')}}">
		@if(Session::has('review-message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('review-message') }}</p>
		@endif
	  <h4><strong>@lang('home.Add Review')</strong></h4><br>
	  <div class="form-group">
	    <label for="exampleInputEmail1">@lang('home.Overall Review')</label>
	    <select class="form-control" name="overall_review" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
	    	<option value="">@lang('home.Select Review')</option>
	    	@foreach($reviewSelect as $select)
	    		<option value="{{ $select }}" @if($companydata->overall_review == $select) selected @endif>@lang('home.'.$select)</option>
	    	@endforeach
	    </select>
	    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">@lang('home.Employed Since')</label>
	    <input type="text" value="{{ $companydata->employee_sience}}" name="employee_sience" class="form-control date-picker" placeholder="@lang('home.Employed Since')">
	    <input type="hidden" name="company_id" value="{{$companyId}}">
	    <input type="hidden" name="user_id" value="{{$userid}}">
	    <input type="hidden" name="type" value="<?php echo $_GET['type']?>">
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	  </div>
	  <div class="form-group" @if($companydata->employer_upto == 'NULL') style='display:none' @endif id="upto">
	    <label for="exampleInputPassword1">@lang('home.Employed Upto')</label>
	    <input type="text" value="@if($companydata->employer_upto != 'NULL') {{$companydata->employer_upto}} @endif" name="employer_upto" class="form-control date-picker" placeholder="@lang('home.Employed Upto')">
	  </div>
	  <div class="form-check">
	    <input type="checkbox" @if($companydata->current_working == 'Yes') checked @endif class="form-check-input" name="current_working" value="Yes" id="current_working">
	    <label class="form-check-label" for="current_working"> @lang('home.i am working currently')</label>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">@lang('home.Designation')</label>
	    <input type="text" value="{{ $companydata->designation}}" name="designation" class="form-control" placeholder="@lang('home.Designation')">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">@lang('home.Job type')</label>
	    <select class="form-control" name="job_type" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
	    	<option value="">@lang('home.Select type')</option>
	    	@foreach($jobtype as $type)
	    	<option value="{{$type}}" @if($type == $companydata->job_type) selected @endif>@lang('home.'.$type)</option>
	    	@endforeach

	    </select>
	    </div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Review title')</label>
	  	  <input type="text" value="{{ $companydata->review_title}}" name="review_title" class="form-control" placeholder="@lang('home.Review title')">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Pros')</label>
	  	  <input type="text" name="pros" value="{{ $companydata->pros}}" class="form-control" placeholder="@lang('home.Pros')">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Cons')</label>
	  	  <input type="text" name="cons" value="{{ $companydata->cons}}" class="form-control" placeholder="@lang('home.Cons')">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Advice to Management')</label>
	  	  <input type="text" value="{{ $companydata->advice_management}}" name="advice_management" class="form-control" placeholder="@lang('home.Advice to Management')">
	  	</div>
	  	<div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Career Opportunities')</label>
		    <select class="form-control" name="career_opportunity" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Career Opportunities')</option>
		    	@foreach($reviewSelect as $select)
	    		<option value="{{ $select }}" @if($companydata->career_opportunity == $select) selected @endif>@lang('home.'.$select)</option>
	    		@endforeach
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Compensation & Benefits')</label>
		    <select class="form-control" name="benefits" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Compensation & Benefits')</option>
		    	@foreach($reviewSelect as $select)
	    		<option value="{{ $select }}" @if($companydata->benefits == $select) selected @endif>@lang('home.'.$select)</option>
	    		@endforeach
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Work/Life Balance')</label>
		    <select class="form-control" name="work_lifebalance" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Work/Life Balance')</option>
		    	@foreach($reviewSelect as $select)
	    		<option value="{{ $select }}" @if($companydata->work_lifebalance == $select) selected @endif>@lang('home.'.$select)</option>
	    		@endforeach
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Rate Management')</label>
		    <select class="form-control" name="rate_management" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Rate Management')</option>
		    	@foreach($reviewSelect as $select)
	    		<option value="{{ $select }}" @if($companydata->rate_management == $select) selected @endif>@lang('home.'.$select)</option>
	    		@endforeach
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Rate Organization Culture')</label>
		    <select class="form-control" name="rate_culture" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Rate Organization Culture')</option>
		    	@foreach($reviewSelect as $select)
	    		<option value="{{ $select }}" @if($companydata->rate_culture == $select) selected @endif>@lang('home.'.$select)</option>
	    		@endforeach
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Recommend CEO')</label>
		    <select class="form-control" name="recommend_ceo" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Recommend CEO')</option>
		    	<option value="Recommended" @if($companydata->recommend_ceo == "Recommended") selected @endif >@lang('home.Recommended')</option>
		    	<option value="Natural" @if($companydata->recommend_ceo == "Natural") selected @endif >@lang('home.Natural')</option>
		    	<option value="Not Recommended" @if($companydata->recommend_ceo == "Not Recommended") selected @endif >@lang('home.Not Recommended')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Expectations About Future')</label>
		    <select class="form-control" name="future" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Expectations About Future')</option>
		    	<option value="Growing Up" @if($companydata->future == "Growing Up") selected @endif >@lang('home.Growing Up')</option>
		    	<option value="Remain Same" @if($companydata->future == "Remain Same") selected @endif >@lang('home.Remain Same')</option>
		    	<option value="Growing Down" @if($companydata->future == "Growing Down") selected @endif >@lang('home.Growing Down')</option>
		    </select>
	  </div>
	  <div class="form-check">
	    <input type="checkbox" name="recommend" class="form-check-input" id="exampleCheck1" @if($companydata->recommend == "on") checked @endif>
	    <label class="form-check-label" for="exampleCheck1"> @lang('home.I recommended working in this organization')</label>
	  </div>
	  <div class="form-check">
	    <input type="checkbox" name="anonymous" class="form-check-input" id="exampleCheck1" @if($companydata->anonymous == "on") checked @endif>
	    <label class="form-check-label" for="exampleCheck1"> @lang('home.Post as Anonymous')</label>
	  </div>
	  <button type="submit" class="btn btn-primary">@lang('home.Submit')</button>
	</form>
</div>



@endsection
@section('page-footer')
<script type="text/javascript">
	$('#current_working').on('change',function(){

		if($('#current_working').is(':checked')){
			$('#upto').hide();
		}else{
			$('#upto').show();
		}
	})
	
</script>

@endsection