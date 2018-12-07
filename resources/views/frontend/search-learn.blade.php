@extends('frontend.layouts.app')

@section('title', 'Search')

@section('content')
<!--Read upskills-->
<section id="postNewJob">
    <div class="container">
	<div class="row">
        <div class="col-md-4">
            <div class="search-courses-box">
                <h3>				

					@if($_GET[type] == 'forum · conference')
						@lang('home.Forum · Conference')
					@endif
					@if($_GET[type] == 'course · education · academy')
						@lang('home.Course · Education · Academy')
					@endif
					@if($_GET[type] == 'seminar · exhibition · webinar')
						@lang('home.Seminar · Exhibition · Webinar')
					@endif
					@if($_GET[type] == 'training · workshop')
						@lang('home.Training · Workshop')
					@endif
				</h3>
                <form class="" class="search-form" method="post">
                    {{ csrf_field() }}
					<div class="form-group">
                          <input type="text" class="form-control" id="keyword" name="keyword" placeholder="@lang('home.key')" value="{{ Request::input('keyword') }}">
						</div>	  
						<div class="form-group">
				           <input type="text" class="form-control select2" id="city" name="city" placeholder="@lang('home.city')" value="{{ Request::input('city') }}">
							    </div>
								<div class="form-group">
					         <select class="form-control select2 job-country" name="type" >
                                     <option value="">@lang('home.s_type')</option>
                              @foreach(JobCallMe::getUpkillsType() as $skill)

                                <option value="{!! $skill->name !!}" {{ $skill->name == Request::input('type') ? 'selected="selected"' : '' }}>@lang('home.'.$skill->name)</option>

                              @endforeach
                               </select>
							      </div>
						    <div class="form-group">
                                <select class="form-control select2 job-country" name="country">
								 <option value="" >@lang('home.country')</option>
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" >@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                                <select class="form-control select2 job-state" name="state">
                                </select>
                        </div>
                        <div class="form-group">
                                <select class="form-control select2 job-city" name="city">
                                </select>
                          
                        </div>
                    <button style="width: 100%;" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>
                </form>
            </div>
            
        </div>
        <div class="col-md-8">
<!--Search Item-->
            @foreach($record as $rec)
                <div class="sc-item" style="overflow: hidden;">
                    <div class="sc-thumbnail">
                        @if($rec->upskillImage != '')
                            <img src="{{ url('upskill-images/'.$rec->upskillImage) }}" style="height: auto !important;">
                        @else
                            <img src="{{ url('d-cover.jpg') }}">
                        @endif
                    </div>
                    <div class="sc-desc">
                        <h4><a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId)}}">{{ $rec->title }}</a></h4>
                        <ul>
                            <li>
                                <strong>@lang('home.type'):</strong>@lang('home.'.$rec->type)
                            </li>
                            <li><i class="fa fa-calendar-check-o"></i> @if(app()->getLocale() == "kr")
						    {{ date('Y-m-d',strtotime($rec->startDate)) }}
						@else
						    {{ date('d F, Y',strtotime($rec->startDate)) }}
						@endif </li>
                            <li><i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}}</li>
                            <li class="hidden-sm hidden-md hidden-lg text-success"><i class="fa fa-map-marker"></i> online, {{ JobCallMe::cityName($rec->city).' '.JobCallMe::countryName($rec->country)}}</li>
                        </ul>
                        <p class="hidden-xs"><i class="fa fa-map-marker"></i> online, @lang('home.'.JobCallMe::cityName($rec->city)), @lang('home.'.JobCallMe::countryName($rec->country))</p>
                    </div>
                    <div class="sc-cost">
                        {{ $rec->currency.' '.number_format($rec->cost).'/-'}}
                    </div>
                </div>
            @endforeach

            {!! $record->render() !!}
        </div>
    </div>
	</div>
</section>
<style type="text/css">
.sc-thumbnail img {margin-left: 0;}
.sc-desc ul li {margin-right: 40px;}
</style>
@endsection
@section('page-footer')
<script type="text/javascript">
$('i.fa').hover(function () {
    $(this).addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function () {
        $(this).removeClass('animated bounceIn');
    });
});
</script>
@endsection