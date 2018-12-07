@extends('frontend.layouts.app')

@section('title', "$job->title")

@section('content')
<section id="jobs">
    <div class="container">
        <div class="col-md-10">
            <div class="jobs-suggestions">
            	@include('frontend.includes.alerts')
                <h4><span style="color:#e2ae0c"><b>@lang('home.jobtitle')</b></span> : {{ $job->title }}</h4>
                <p class="text-success">@lang('home.almostdone')</p>
                <hr>
                <form action="" method="post">
                	{{ csrf_field() }}
                	<input type="hidden" name="jobId" value="{{ $job->jobId }}">
                    <div class="ja-question-box">
                        <div class="pull-right ja-check">
                            <input type="checkbox" id="qualification" class="switch-field" name="qualification" value="yes"/>
                            <label for="qualification" class="switch-label"><span class="ui"></span></label>
                        </div>
                        <p class="ja-question">@lang('home.q1')</p>
                        <div class="ja-specification">
                            <span style="color:#e2ae0c"><b>A.</b></span> {{ $job->qualification }}
                        </div>
                    </div>
                    <div class="ja-question-box">
                        <div class="pull-right ja-check">
                            <input type="checkbox" id="experience" class="switch-field" name="experience" value="yes" />
                            <label for="experience" class="switch-label"><span class="ui"></span></label>
                        </div>
                        <p class="ja-question">@lang('home.q2')</p>
						<div class="ja-specification"><span style="color:#e2ae0c"><b>A.</b></span> @lang('home.'.$job->experience)</div>
                    </div>
                    <div class="ja-question-box">
                        <div class="pull-right ja-check">
                            <input type="checkbox" id="skills" class="switch-field" name="skills" value="yes" />
                            <label for="skills" class="switch-label"><span class="ui"></span></label>
                        </div>
                        <p class="ja-question">@lang('home.q3')</p>
                        <div class="ja-specification"><span style="color:#e2ae0c"><b>A.</b></span> {!! $job->skills !!}</div>
                    </div>
                    <div class="ja-question-box">
                        <div class="pull-right ja-check">
                            <input type="checkbox" id="location" class="switch-field" name="location"/>
                            <label for="location" class="switch-label"><span class="ui"></span></label>
                        </div>
                        <p class="ja-question">@lang('home.q4')</p>
                        <div class="ja-specification">
                            <span style="color:#e2ae0c"><b>A.</b></span> @lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))
                        </div>
                    </div>
                    @if(strtotime($job->expiryDate) < strtotime(date('Y-m-d')))
                        <button type="button" class="btn btn-danger" disabled="disabled">@lang('home.hasbeenclose')</button>
                    @elseif($jobApplied == true)
                        <button type="button" class="btn btn-success">@lang('home.alreadyapply')</button>
                        <a href="{{ url('jobs/'.$job->jobId) }}" class="btn btn-default">@lang('home.CANCEL')</a>
                    @else
                        <button type="submit" class="btn btn-primary" id="submitbutton" disabled="disabled">@lang('home.apply')</button>
                        <a href="{{ url('jobs/'.$job->jobId) }}" class="btn btn-default">@lang('home.CANCEL')</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
})
$('.switch-field').click(function(){
	var totalLength = $('.switch-field').length;
	var checkedLength = $('.switch-field:checked:checked').length;
	if(totalLength == checkedLength){
		$('#submitbutton').prop('disabled',false);
	}else{
		$('#submitbutton').prop('disabled',true);
	}
})
</script>
@endsection