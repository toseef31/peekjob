@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<?php
$lToken = csrf_token();
?>
    <section class="main-slide">
        <div class="container">
            <!-- <div class="hp_strip">
                <div class="wrapper">
                    <h2 class="text-center" style="padding-top:85px;">
                        @if(app()->getLocale() == "kr")
						    <div id="hp_text"></div>@lang('home.headerHeading')
						@else
						    <div id="hp_text2"></div>@lang('home.headerHeading')
						@endif
                    </h2>
                </div>
            </div> -->
            <div class="col-md-12 job-search">
                <!--<h1 class="second">Your Future Starts Here Now</h1>
                <h3 class="third">Finding your next job or career more 1000+ availabilities</h3>-->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#search_tab_1" data-toggle="tab">@lang('home.jobs')</a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_2" data-toggle="tab">@lang('home.companies') </a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_3" data-toggle="tab">@lang('home.peoples')</a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_4" data-toggle="tab">@lang('home.read_search')</a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_5" data-toggle="tab">@lang('home.learn')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="search_tab_1">
                                        <form method="get" action="{{ url('jobs') }}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingjob')" name="keyword">
                                                </div>
                                               
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="width:100%">
                                                </div>
                                                
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="search_tab_2">
                                        <form role="form" method="POST" action="{{ url('companies')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingcompany')" name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="width: 100%">
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="search_tab_3">
                                        <form role="form" method="POST" action="{{url('account/people')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingpeople')" name="keyword" >
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="width: 100%">
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- read tab starts from here -->
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #cccccc !important;
    line-height: 28px; }
</style>
                                    <div class="tab-pane" id="search_tab_4">
                                        <form role="form" method="POST" action="{{url('read')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingread')" name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <select class="form-control" id="home-cat" name="category" style="background: transparent;color: #fff">
                                                        <option value="0">@lang('home.category')</option>
                                                        @foreach(JobCallMe::getReadCategories() as $cat)
                                                        <option value="{{$cat->id}}">@lang('home.'.$cat->name)</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- learn tab starts from here -->
                                    <div class="tab-pane" id="search_tab_5">
                                        <form role="form" method="POST" action="{{url('learn/search')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookinglearn')" name="keyword" >
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="width: 100%">
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
     <span style="padding-left:10px"><button type="submit" class="btn btn-warning btn-sm" id="Quickbutton" onclick="myFunction()"> @lang('home.Open Quick View V')</span>  </button>
</div>
                                               
    <!--Slider Section End-->

    <section class="login-type-section" id="QuickView" style="display:none;">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6 login-type ">
                    <div class=" hi-icon-effect-8">
                    <a href="{{ url('account/jobseeker') }}" class="hi-icon"> <img src="frontend-assets/images/jobseek_icon.png"></a>
                    </div>
                    <p style="font-size:17px;padding-top:5px;"><b>@lang('home.ijobseeker')</b></p>
                    <span>@lang('home.postresume')</span>
                </div>
                <div class="col-md-6 login-type ">
                    <div class="hi-icon-effect-8">
                        <a href="{{ url('account/employer') }}" class="hi-icon"> <img src="frontend-assets/images/employer_icon.png"></a>
                    </div>
                    <p style="font-size:17px;padding-top:5px;"><b>@lang('home.iemployer')</b></p>
                    <span>@lang('home.postjob_main')</span>
                </div>
            </div>
			<?php $colorArr = array('#57768a','#96aaa8','#a09d8e','#605e63','#9e947b','#8a9fa0','#695244','#5b5c5e','#7b767d','#a0b1b9','#6d846f','#a8b3b9') ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="job-locations-box">

						<a class="job-location" href="{{ url('jobs?country='.JobCallMe::getHomeCountry() )}}" style="background-color: {{ $colorArr[array_rand($colorArr)] }}"><span class="shine"></span><span class="text">@lang('home.All')<!-- @lang('home.jobsin') --></span></a>
					@foreach(JobCallMe::getJobStates(JobCallMe::getHomeCountry()) as $loca2)
                        <a class="job-location" href="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca2->id )}}" style="background-color: {{ $colorArr[array_rand($colorArr)] }}"><span class="shine"></span><span class="text">@lang('home.'.$loca2->name)</span></a>
                    @endforeach
                       
                    </div>
                    <div class="clearfix"></div>
                    <div class="job-schedule-box">
					 @foreach(JobCallMe::getJobType() as $shift)
                        <a href="{{ url('jobs?type='.$shift->name) }}" class="hvr-shutter-in-horizontal">@lang('home.'.ucfirst($shift->name))</a>
                    @endforeach
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
	<div class="hidden-xs" style="margin-top:10px">&nbsp;</div>
        <div class="ticker-container" style="margin-top:25px;">
			
            <!--<div class="ticker-caption">
                <p>Breaking News</p>
            </div>-->
            <ul>
			@foreach($premium as $job)
                <div><li><span>{!! $job->title !!} &ndash; <a href="{{ url('jobs/'.$job->jobId) }}">@lang('home.Latest Job')</a></span></li></div>
				@endforeach
               
            </ul>
        </div>
    </section>

    <!--Premium Jobs Section Start-->
    <div class="container" style="background: #fff;
                                    margin-top: -12px;
                                    /* margin-bottom: -10px; */
                                    width: 100%;
                                    /* margin-left: 64px; */
                                    padding-left: 20px;
                                    padding-bottom: 27px;">
              <div class="col-md-offset-2">
                <span style="padding-left:8px"><button type="submit" class="btn btn-success btn-sm" id="mainbutton" onclick="myFunctions()"> @lang('home.Open AD View')</span>  </button>
                    </div>
                    </div>
    <div id="maindiv" style="display:none">
     
    <section class="job-types-section" style="background:#fff;margin-top:-12px;margin-bottom:-10px;">
   
        <div class="container">
		<div>
            <p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.prjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
			</div>
            <!-- Left to right-->
            <div class="row">
                <!--Premium Job Single item Start-->
				@foreach($premium as $job)
				<?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box" style="background:#a09d8e">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img pj-type-job" style="background:#fff">
                            <div class="" style="height: 60px; width:100%"> 
                                <img class="img-responsive" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:70px;margin: 0 auto;width: auto !important;padding-top:5px;" alt="img">
                               </div>
                                <b class="pull-right" style="margin-top:7px;padding-right:5px;">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
                                <!-- <hr> -->
                                <div class="lj-single-details" style="background:#a09d8e;padding-top:5px;padding-bottom:5px;margin-top:5px;">
                                    <p style="padding-left:5px">{!! $string !!}</p>
                                    <p style="padding-left:5px">
										@if($job->jobreceipt01 == 'yes')
											@lang('home.jobreceipt01')ㆍ
										@endif
										@if($job->jobreceipt02 == 'yes')
											@lang('home.jobreceipt02')ㆍ
										@endif
										@if($job->jobreceipt07 == 'yes')
											@lang('home.jobreceipt07')ㆍ
										@endif
										@if($job->jobreceipt03 == 'yes')
											@lang('home.jobreceipt03')ㆍ
										@endif
										@if($job->jobreceipt04 == 'yes')
											@lang('home.jobreceipt04')ㆍ
										@endif
										@if($job->jobreceipt05 == 'yes')
											@lang('home.jobreceipt05')ㆍ
										@endif
										@if($job->jobreceipt06 == 'yes')
											@lang('home.jobreceipt06')ㆍ
										@endif								
									</p>
                                    <p style="padding-left:5px;padding-top:2px;">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))</p>							
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}<br>@lang('home.jobtype') : [@lang('home.'.$job->jobType)]<br>@lang('home.experience') : [@lang('home.'.$job->experience)]<br>@lang('home.lastdate') : @if(app()->getLocale() == "kr")
							  [{{ date('Y-m-d',strtotime($job->expiryDate))}}]
						@else
							  [{{ date('M d, Y',strtotime($job->expiryDate))}}]
						@endif<!-- {!! $job->description !!} --></p>
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--Premium Job Single item End-->
@endforeach
                <!--Premium Job Single item End-->
            </div>
        </div>
    </section>
    <!--Premium Jobs Section End-->

    <!--Top Companies Section Start-->
    <section class="feature-companies">
        <div class="container" style="padding-top:10px;padding-bottom:10px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.topcompanies')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
            
            <!--<p class="text-center" id="feature-companies-caption">Sigh ever way now many. Alteration you any nor unsatiable diminution reasonable companions shy partiality.</p>-->
            <!-- Scale up-->
            <div class="row">
			@foreach($top_jobs as $comp)
				<?php
			 $string = $comp->title;
			 if (strlen($string) > 46) {

                        // truncate string
                            $stringCut = substr($string, 0, 46);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <!-- colored -->
                    <div class="ih-item square effect8 scale_up tc-box" style="background:#a09d8e">
                        <a href="{{ url('jobs/'.$comp->jobId) }}">
						  <div style="background:#fff">
                            <div class="" style="height: 50px; width:100%;background:#fff">
                                <img class="img-responsive img-inner" src="{!! $comp->companyLogo != '' ? url('/compnay-logo/'.$comp->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:60px !important;margin: 0 auto;width: auto !important;padding-top:5px;"  alt="img">
                            </div>
                            <b class="pull-right" style="background:#fff;margin-top:10px;padding-right:5px;margin-bottom:5px;">{!! $comp->companyName !!}</b>
                            <div class="clearfix"></div>
						  </div>
                                <!-- <hr> -->
							<span class="lj-single-details">
								<p style="padding-left:5px">{!! $string !!}<!-- {!! $comp->title !!} --></p>
                                <p style="padding-left:5px">
										@if($comp->jobreceipt01 == 'yes')
											@lang('home.jobreceipt01')ㆍ
										@endif
										@if($comp->jobreceipt02 == 'yes')
											@lang('home.jobreceipt02')ㆍ
										@endif
										@if($comp->jobreceipt07 == 'yes')
											@lang('home.jobreceipt07')ㆍ
										@endif
										@if($comp->jobreceipt03 == 'yes')
											@lang('home.jobreceipt03')ㆍ
										@endif
										@if($comp->jobreceipt04 == 'yes')
											@lang('home.jobreceipt04')ㆍ
										@endif
										@if($comp->jobreceipt05 == 'yes')
											@lang('home.jobreceipt05')ㆍ
										@endif
										@if($comp->jobreceipt06 == 'yes')
											@lang('home.jobreceipt06')
										@endif					
								</p>
                                <p style="padding-left:5px">@lang('home.'.JobCallMe::cityName($comp->city)), @lang('home.'.JobCallMe::countryName($comp->country))</p>
							</span>
                            <div class="info">
                                <h3>{!! $comp->companyName !!}</h3>
                                <p>{!! $string !!}<br>@lang('home.jobtype') : [@lang('home.'.$comp->jobType)]<br>@lang('home.experience') : [@lang('home.'.$comp->experience)]<br>@lang('home.lastdate') : @if(app()->getLocale() == "kr")
							  [{{ date('Y-m-d',strtotime($comp->expiryDate))}}]
						@else
							  [{{ date('M d, Y',strtotime($comp->expiryDate))}}]
						@endif</p>


								<div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $comp->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($comp->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span><!-- {{ JobCallMe::timeInDays($comp->expiryAd) }}@lang('home.days left') --></span>
                                </div>
                              
                            </div>
							  
                        </a>
                    </div>
                    <!-- end colored -->
                </div>
@endforeach
            </div>
            <!-- end Scale up-->

        </div>
    </section>
    <!--Top Companies Section End-->

    <!--Hot Jobs Section Start-->
    <section class="job-types-section" id="latest-jobs">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
			<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.hotjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
          
            <div class="row">
                <!--Hot Job Single item Start-->
				 @foreach($hot as $job)
				 <?php
			 $string = $job->title;
			 if (strlen($string) > 46) {

                        // truncate string
                            $stringCut = substr($string, 0, 46);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>

                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box" style="height:auto;background:#7c98a7;">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img hj-type-job">
							<div style="background:#fff">
								<div class="" style="height: 50px; width:100%;background:#fff">
									<img class="img-responsive" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:50px !important;margin: 0 auto;width: auto !important;padding-top:5px;" alt="img"> 
                                </div>
                                <b class="pull-right" style="background:#fff;padding-right:5px;margin-bottom:5px;">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
							</div>
                                <!-- <hr> -->
                                
                                <div class="pj-single-details">
                                    <p style="padding-left:5px">{!! $string !!}</p>
                                    <p style="padding-left:5px">
										@if($job->jobreceipt01 == 'yes')
											@lang('home.jobreceipt01')ㆍ
										@endif
										@if($job->jobreceipt02 == 'yes')
											@lang('home.jobreceipt02')ㆍ
										@endif
										@if($job->jobreceipt07 == 'yes')
											@lang('home.jobreceipt07')ㆍ
										@endif
										@if($job->jobreceipt03 == 'yes')
											@lang('home.jobreceipt03')ㆍ
										@endif
										@if($job->jobreceipt04 == 'yes')
											@lang('home.jobreceipt04')ㆍ
										@endif
										@if($job->jobreceipt05 == 'yes')
											@lang('home.jobreceipt05')ㆍ
										@endif
										@if($job->jobreceipt06 == 'yes')
											@lang('home.jobreceipt06')
										@endif
									</p>
                                    <p style="padding-left:5px;padding-top:2px;">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
                                <p style="padding-top:5px;">{!! $string !!}<br>@lang('home.jobtype') : [@lang('home.'.$job->jobType)]<br>@lang('home.experience') : [@lang('home.'.$job->experience)]<br><!-- @lang('home.lastdate') : @if(app()->getLocale() == "kr")
							  [{{ date('Y-m-d',strtotime($job->expiryDate))}}]
						@else
							  [{{ date('M d, Y',strtotime($job->expiryDate))}}]
						@endif --></p>
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span><!-- {{ JobCallMe::timeInDays($job->expiryAd) }} @lang('home.days left') --></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--Hot Job Single item End-->

 @endforeach
            </div>
        </div>
    </section>
    <!--Hot Jobs Section End-->

    <!--Latest Jobs Section Start-->
    <section class="job-types-section">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.latestjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
          
            <div class="row">
                <!--Latest Job Single item Start-->
				@foreach($latest as $job)
				<?php
			 $string = $job->title;
			 if (strlen($string) > 46) {

                        // truncate string
                            $stringCut = substr($string, 0, 46);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box" style="height:auto;background:#7c98a7;">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img lj-type-job">
							<div style="background:#fff">
                            <div class="" style="height: 45px; width:100%">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:45px !important;margin: 0 auto;width: auto !important;" alt="img">
                               </div>
                                <b class="pull-right" style="background:#fff;padding-right:5px;padding-bottom:5px;">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
							</div>
                                <!-- <hr> -->
                                <div class="lj-single-details">
                                    <p style="padding-left:5px;padding-top:5px;">{!! $string !!}</p>
                                    <p style="padding-left:5px;padding-top:2px;">
										@if($job->jobreceipt01 == 'yes')
											@lang('home.jobreceipt01')ㆍ
										@endif
										@if($job->jobreceipt02 == 'yes')
											@lang('home.jobreceipt02')ㆍ
										@endif
										@if($job->jobreceipt07 == 'yes')
											@lang('home.jobreceipt07')ㆍ
										@endif
										@if($job->jobreceipt03 == 'yes')
											@lang('home.jobreceipt03')ㆍ
										@endif
										@if($job->jobreceipt04 == 'yes')
											@lang('home.jobreceipt04')ㆍ
										@endif
										@if($job->jobreceipt05 == 'yes')
											@lang('home.jobreceipt05')ㆍ
										@endif
										@if($job->jobreceipt06 == 'yes')
											@lang('home.jobreceipt06')
										@endif										
									</p>
                                    <p style="padding-left:5px;color:#fff;padding-top:2px;">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
                                <p style="padding-top:5px">{!! $string !!}<br>@lang('home.jobtype') : [@lang('home.'.$job->jobType)]<br>@lang('home.experience') : [@lang('home.'.$job->experience)]</p>
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span><!-- {{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left') --></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--Latest Job Single item End-->

          @endforeach
                <!--Latest Job Single item End-->
            </div>
        </div>
    </section>
    <!--Latest Jobs Section End-->

    <!--Special Jobs Section Start-->
    <section class="job-types-section" id="latest-jobs">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.specialjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>

            <div class="row">
			@foreach($special as $job)
			<?php
			 $string = $job->title;
			 if (strlen($string) > 46) {

                        // truncate string
                            $stringCut = substr($string, 0, 46);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <!--Special Job Single item Start-->
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box" style="height:auto;background:#7c98a7">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                        <div class="img sj-job-type">
						<div style="background:#fff">
                        <div class="" style="height: 35px; width:100%">
                            <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:35px !important;margin: 0 auto;width: auto !important;"  alt="img">
                          </div>
                            <b class="pull-right" style="padding-top:5px;padding-right:5px;padding-bottom:5px;">{!! $job->companyName !!}</b>
                            <div class="clearfix"></div>
						</div>
                            <!-- <hr> -->
                            <div class="lj-single-details">
                                <p style="padding-left:5px;padding-top:5px">{!! $string !!}</p>
                                <p style="padding-left:5px">
										@if($job->jobreceipt01 == 'yes')
											@lang('home.jobreceipt01')ㆍ
										@endif
										@if($job->jobreceipt02 == 'yes')
											@lang('home.jobreceipt02')ㆍ
										@endif
										@if($job->jobreceipt07 == 'yes')
											@lang('home.jobreceipt07')ㆍ
										@endif
										@if($job->jobreceipt03 == 'yes')
											@lang('home.jobreceipt03')ㆍ
										@endif
										@if($job->jobreceipt04 == 'yes')
											@lang('home.jobreceipt04')ㆍ
										@endif
										@if($job->jobreceipt05 == 'yes')
											@lang('home.jobreceipt05')ㆍ
										@endif
										@if($job->jobreceipt06 == 'yes')
											@lang('home.jobreceipt06')
										@endif			
								</p>
                                <p style="padding-left:5px;color:#fff">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))</p>
                            </div>
                        </div>
                        <div class="info">
                            <h3>{!! $job->companyName !!}</h3>
                            <p style="padding-top:5px;font-size:11px;">{!! $string !!}<br>@lang('home.jobtype') : [@lang('home.'.$job->jobType)]<br>@lang('home.experience') : [@lang('home.'.$job->experience)]</p>
                            <div class="job-status eye-icon">
                                <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                            </div>
                            <div class="job-status days-left">
                                <span><!-- {{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left') --></span>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <!--Special Job Single item End-->
   @endforeach
                <!--Special Job Single item Start-->
          
                <!--Special Job Single item End-->
            </div>
        </div>
    </section>
    <!--Special Jobs Section End-->

    <!--Golden Jobs Section Start-->
    <section class="job-types-section">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.goldjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>

            <div class="row">
                <div id="check"></div>
                <!--Golden Job Single item Start-->
					@foreach($golden as $job)
					<?php
			 $string = $job->title;
			 if (strlen($string) > 46) {

                        // truncate string
                            $stringCut = substr($string, 0, 46);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box" style="height:auto;background:#a09d8e;">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img sj-job-type">
							  <div style="background:#fff">
                               <div class="" style="height: 30px; width:100%">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:30px !important;margin: 0 auto;width: auto !important;padding-top:5px;" alt="img">
                               </div>
                                <b class="pull-right" style="padding-top:8px;padding-right:5px;">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
							  </div>
                                <!-- <hr> -->
                                <div class="lj-single-details">
                                    <p style="padding-left:5px;padding-top:5px">{!! $string !!}</p>
                                    <p style="padding-left:5px;padding-top:2px;">
										@if($job->jobreceipt01 == 'yes')
											@lang('home.jobreceipt01')ㆍ
										@endif
										@if($job->jobreceipt02 == 'yes')
											@lang('home.jobreceipt02')ㆍ
										@endif
										@if($job->jobreceipt07 == 'yes')
											@lang('home.jobreceipt07')ㆍ
										@endif
										@if($job->jobreceipt03 == 'yes')
											@lang('home.jobreceipt03')ㆍ
										@endif
										@if($job->jobreceipt04 == 'yes')
											@lang('home.jobreceipt04')ㆍ
										@endif
										@if($job->jobreceipt05 == 'yes')
											@lang('home.jobreceipt05')ㆍ
										@endif
										@if($job->jobreceipt06 == 'yes')
											@lang('home.jobreceipt06')
										@endif
									</p>
                                    <p style="padding-left:5px;color:#fff;padding-top:2px;">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
                                <p style="padding-top:5px;font-size:11px;">{!! $string !!}<br>@lang('home.jobtype') : [@lang('home.'.$job->jobType)]<br>@lang('home.experience') : [@lang('home.'.$job->experience)]</p>
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span><!-- {{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left') --></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--Golden Job Single item End-->
  @endforeach
               
            </div>
        </div>
    </section>
    </div>
    <!--Golden Jobs Section End-->
@endsection
@section('page-footer')
<script type="text/javascript">

    $(document).ready(function(){
        $('#home-cat').select2();
        $('#feed').on('mouseover',function(){
            $('#fpi_content form input[type="hidden"]').remove();
            $('#fpi_content form').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
        });
        $('#homeJobSearch').on('submit',function(e){
            e.preventDefault();
            window.location.href = 'jobs/homeJobSearch';
            /*$.ajax({
                url:'jobs/homeJobSearch',
                data:new FormData(this),
                type:'POST',
                processData: false,
                contentType: false,
                cache:false,
                success:function(res){
                    $('#check').html(res);
                    console.log(res);
                }
            });*/
        });  
    });
  $("#Quickbutton").click(function(){
    $("#QuickView").toggle();
});
 $("#mainbutton").click(function(){
    $("#maindiv").toggle();
});
function myFunction() {
    var x = document.getElementById("Quickbutton");
    if (x.innerHTML === "@lang('home.Close Quick View V')") {
        x.innerHTML = "@lang('home.Open Quick View V')";
    } else {
        x.innerHTML = "@lang('home.Close Quick View V')";
    }
}
function myFunctions() {
    var x = document.getElementById("mainbutton");
    if (x.innerHTML === "@lang('home.Close AD View')") {
        x.innerHTML = "@lang('home.Open AD View')";
    } else {
        x.innerHTML = "@lang('home.Close AD View')";
    }
}


</script>
@endsection
<style type="text/css">
    select option{
        color:#000;
    }
</style>