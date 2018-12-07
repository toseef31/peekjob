@extends('frontend.layouts.app')

@section('title', "$job->title")

@section('content')
 <?php 
     $cLogo = url('compnay-logo/default-logo.jpg');
       if($job->companyLogo != ''){
          $cLogo = url('compnay-logo/'.$job->companyLogo);
             }
              ?>
<?php
$head='';
$travelFound=false;			
$dispatch='';

  if($job->head == "yes")		
					{		
				$head='<span class="label" style="background-color:green">Headhunting</span>';		
				}		
				else{		
					$head="";		
				}		
					if($job->dispatch == "yes")		
					{		
						$dispatch='<span class="label" style="background-color:blue">Dispatch & Agency</span>';		
					}						else{		
					$dispatch="";		
				}
?>
<section id="jobs">
    <div class="container">
        <div class="col-md-9">
		
            <div class="jobs-suggestions">
			<div style="display: -webkit-box;" class="suggestions-user-info">
			    <img src="{{ $cLogo }}"  style="width:118px;">	<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
    			<div style="padding-left: 42px;">
    			    <span style="text-transform: uppercase;font-size: 26px;">{{$job->companyName}}</span>
                    <p style="font-size: 18px;margin-top: 24px; margin-left: 6px;">{{ $job->title }},  &nbsp;<span style="font-size: 13px; padding-top: 9px;">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country)) </span>
    				<!-- </span><span style="font-size:9px;margin-left:13px">@lang('home.Never pay for job application, test or interview') <a href="{{ url('/safety')}}">@lang('home.More')</a></span> -->
                    </p>
    				
    			</div>
				   
			</div>
			 
			@if($job->userId == $userId )
                <div class="jd-action-btn">

                </div>
			
			@else
				  <div class="jd-action-btn">
                    @if(strtotime($job->expiryDate) < strtotime(date('Y-m-d')))
                        <button class="btn btn-danger">@lang('home.s_close')</button>
                    @else
						@if($job->jobreceipt02 == 'yes')
							<a href="{{$job->jobhomgpage}}" class="btn btn-primary" style="margin-right: 10px;" target="_blank">@lang('home.jobhomepageapply')</a>
						@endif

						@if($job->jobreceipt01 == 'yes')
							@if($jobApplied == true)
								<a href="{{ url('jobs/apply/'.$job->jobId) }}" class="btn btn-success">@lang('home.applied')</a>
							@else
								<a href="{{ url('jobs/apply/'.$job->jobId) }}" class="btn btn-primary">@lang('home.apply')</a>
							@endif
						@endif

                        @if(in_array($job->jobId, $savedJobArr))
                            <a href="javascript:;" onclick="saveJob({{ $job->jobId }},this)" class="btn btn-success" style="margin-left: 10px;">@lang('home.saved')</a>
                        @else
                            <a href="javascript:;" onclick="saveJob({{ $job->jobId }},this)" class="btn btn-default" style="margin-left: 10px;">@lang('home.save')</a>
                        @endif
                    @endif
					
                </div>
			@endif
			
			
		
                
                <div class="jd-share-btn">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('jobs/'.$job->jobId) }}">
                    	<i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('jobs/'.$job->jobId) }}&title=&summary=&source=">
                    	<i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                    </a>
                    <a href="https://twitter.com/home?status={{ url('jobs/'.$job->jobId) }}">
                    	<i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                    </a>
                    <a href="https://plus.google.com/share?url={{ url('jobs/'.$job->jobId) }}">
                    	<i class="fa fa-google-plus" style="background: #F63E28;"></i> 
                    </a>
                </div>
                <ul class="js-listing">
                    <li>
                        <p class="js-title">@lang('home.jobtype')</p>
                        <p>@lang('home.'.$job->jobType)</p>
                    </li>
                    <li>
                        <p class="js-title">@lang('home.shift')</p>
                        <p>@lang('home.'.$job->jobShift)</p>
                    </li>
                    <li>
                        <p class="js-title">@lang('home.experience')</p>
                        <p>@lang('home.'.$job->experience)</p>
                    </li>
                    <li>
                        <p class="js-title">@lang('home.salary')</p>
                        <p>
						<p>
						@if($job->afterinterview != "")
							@lang('home.'.$job->afterinterview)
						@else
							{{ number_format($job->minSalary) }} - {{ number_format($job->maxSalary) }} @if($job->currency == "KRW" or $job->currency == "KRW|대한민국 원")
								원
							@else
								  {{ $job->currency }}
							@endif
						@endif
						</p>
                    </li>
					<li>
                        <p class="js-title">@lang('home.poston')</p>
                        <p>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($job->createdTime))}}
						@endif</p>
                    </li>
					<li>
                        <p class="js-title">@lang('home.lastdate')</p>
                        <p>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->expiryDate))}}
						@else
							  {{ date('M d, Y',strtotime($job->expiryDate))}}
						@endif</p>
                    </li>
                </ul>
            </div>

            <!--JOB Details-->
            <div class="jd-job-details">
                <h4>{{ $job->title }} @if(app()->getLocale() == "kr")
							  @lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))
						@else
							  at {{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}
						@endif</h4>

                <!--Large Screen-->
                <table class="table table-bordered hidden-xs hidden-sm">
                    <tbody>
                    <tr>
                        <td class="active">@lang('home.category')</td>
                        <td colspan="3">@lang('home.'.JobCallMe::categoryTitle($job->category)) / @lang('home.'.JobCallMe::subcategoryTitle($job->subCategory)) / @lang('home.'.JobCallMe::subcategoryTitle2($job->subCategory2))</td>                        
                    </tr>
					<tr>
                        <td class="active">@lang('home.jobaddr')</td>
                        <td colspan="3">{{ $job->jobaddr }}</td>                     
                    </tr>


					

					<tr>
                        <td class="active">@lang('home.Responsibilities')</td>
                        <td>{{ $job->responsibilities }}</td>
                        <td class="active">@lang('home.expptitle')</td>
                        <td>@lang('home.'.$job->expptitle)
							@if($job->expptitle == "")
							  @lang('home.'.$job->expposition)
							@else	
							  &nbsp;|@lang('home.'.$job->expposition)
							@endif
						
						</td>
                    </tr>
					<tr>
						<td class="active">@lang('home.careerlevel')</td>
                        <td>@lang('home.'.$job->careerLevel)</td>
                        <td class="active">@lang('home.Working day')</td>
                        <td>@lang('home.'.$job->jobdayval) {{ $job->jobdayval_text }}</td>                        
                    </tr>
					<tr>
                        <td class="active">@lang('home.Working hours')</td>
                        <td>@lang('home.'.$job->jobhoursval) {{ $job->jobhoursval_text }}</td>
                        <td class="active">@lang('home.jobacademic')</td>
                        <td>
						@if($job->jobacademic_not == "yes")
							  @lang('home.Regardless Education')
						@else	
							  @lang('home.'.$job->jobacademic)
						@endif
						@if($job->jobgraduate == "yes")
							  @lang('home.jobgraduate')
						@else							 
						@endif</td>
                    </tr>
					<tr>
                        <td class="active">@lang('home.gender')</td>
                        <td>@lang('home.'.$job->gender)</td>
                        <td class="active">@lang('home.age')</td>
                        <td>{{ $job->jobage1 }} {{ $job->jobage2 }} 
						@if($job->jobage1 != "" or $job->jobage2 != "")
							  &nbsp;| @lang('home.jobnoage')
						@else		
							  @lang('home.jobnoage')
						@endif</td>
                    </tr>

                    <tr>
                        <td class="active">@lang('home.location')</td>
                        <td>@lang('home.'.JobCallMe::cityName($job->city)),@lang('home.'.JobCallMe::countryName($job->country))</td>
                        <td class="active">@lang('home.totalvacancies')</td>
                        <td>{{ $job->vacancies }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.poston')</td>
                        <td>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($job->createdTime))}}
						@endif</td>
                        <td class="active">@lang('home.lastdate')</td>
                        <td>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->expiryDate))}}
						@else
							  {{ date('M d, Y',strtotime($job->expiryDate))}}
						@endif</td>
						
                    </tr>
                    <tr>
					 <td class="active">@lang('home.location')</td>
                        <td>@lang('home.'.JobCallMe::cityName($job->city)),@lang('home.'.JobCallMe::countryName($job->country))</td>
                        <td class="active">@lang('home.travelling')</td>
                        <td>@if($benefits != '')
							@foreach( $benefits as $benefit)
						     @if($benefit == 'Travelling')
							   <?php $travelFound = true; ?>
						     @endif
						    @endforeach
							
							@endif
							<?php if($travelFound){
								 echo Yes;
							}
							else{
								echo No;
							}
							?>
							
						</td>
						
                    </tr>
					
                    </tbody>
                </table>

                <!--Small Screen-->
                <table class="table table-bordered table-responsive hidden-md hidden-lg">
                    <tbody>
                    <tr>
                        <td class="active">@lang('home.category')</td>
                        <td>@lang('home.'.JobCallMe::categoryTitle($job->category))</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.careerlevel')</td>
                        <td>@lang('home.'.$job->careerLevel)</td>
                    </tr>
					
                    <tr>
                        <td class="active">@lang('home.jobacademic')</td>
                        <td>@lang('home.'.$job->jobacademic)
						@if($job->jobacademic_not == "yes")
							  &nbsp;| @lang('home.Regardless Education')
						@else							 
						@endif
						@if($job->jobgraduate == "yes")
							  &nbsp;| @lang('home.jobgraduate')
						@else							 
						@endif</td>
                    </tr>

					<tr>
                        <td class="active">@lang('home.age')</td>
                        <td>{{ $job->jobage1 }} {{ $job->jobage2 }} 
						@if($job->jobnoage == "yes")
							  &nbsp;| @lang('home.jobnoage')
						@else							 
						@endif</td>
                    </tr>
					<tr>
                        <td class="active">@lang('home.gender')</td>
                        <td>@lang('home.'.$job->gender)</td>
                    </tr>

                    <tr>
                        <td class="active">@lang('home.poston')</td>
                        <td>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($job->createdTime))}}
						@endif</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.lastdate')</td>
                        <td>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->expiryDate))}}
						@else
							  {{ date('M d, Y',strtotime($job->expiryDate))}}
						@endif</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.location')</td>
                        <td>@lang('home.'.JobCallMe::cityName($job->city)),@lang('home.'.JobCallMe::countryName($job->country))</td>
                    </tr>
					
                    </tbody>
                </table>
                <h4>@lang('home.description')</h4>
                <p><strong>@lang('home.We are conveniently located in') {{ JobCallMe::getCompany($job->companyId)->companyAddress }}.</strong></p>
                <p class="job-descrptn-img">{!! $job->description !!}</p>
				<br>
                <h4>@lang('home.skills')</h4>

                <p>{!! $job->skills !!}</p>				
				<br>
				<h4><b>@lang('home.qualification')</b></h4>
                <p>{!! $job->qualification !!}</p>			



                <br>
				<div>
                  <h4><b>@lang('home.admissionsprocess')</b></h4>

                @if($process != '')
	                <ul class="jd-rewards" style="margin-bottom: 32px;">
	                	@foreach( $process as $pro)
							<li>
							@if($pro == 'Document Screening')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)						
							@elseif($pro == 'human nature test')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Chat')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Video & Chat')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'First Interview')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Second Interview')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Examination for Employment')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Final Pass')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@else
								<i class="fa fa-check-circle"></i> {!! $pro !!}
							@endif
							
							</li>
	                		
	                	@endforeach
	                </ul>
                @endif
				</div>
				<br><br>
				<br><br><br><br class="hidden-lg"><br class="hidden-lg"><br class="hidden-lg">	
				<div>
                <h4><b>@lang('home.How to register')<b></h4>
               
	                <ul class="jd-rewards">
	                	
						@if($job->jobreceipt01 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt01')</li>
	                	@endif
						@if($job->jobreceipt02 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt02')</li>
	                	@endif
						@if($job->jobreceipt07 == 'yes')
							<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt07')</li>
						@endif
						@if($job->jobreceipt03 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt03')</li>
	                	@endif
						@if($job->jobreceipt04 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt04')</li>
	                	@endif
						@if($job->jobreceipt05 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt05')</li>
	                	@endif
						@if($job->jobreceipt06 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt06')</li>
	                	@endif

	                </ul>
				</div>
                <br>
                <br><br><br>
                <div>
                <h4><b>@lang('home.rewardsbenefits')</b></h4>
                @if($benefits != '')
	                <ul class="jd-rewards">
	                	@foreach( $benefits as $benefit)
						
	                		<li>
							@if($benefit == 'National pension')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)							
							@elseif($benefit == 'Employment Insurance')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Industrial accident insurance')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Health Insurance')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Severance Pay')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Lunch offer')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Vehicle oil subsidy')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Overtime pay')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@else
								<i class="fa fa-check-circle"></i> {{ $benefit }}
							@endif
						
	                		</li>
	                	@endforeach
	                </ul>
                @endif
                </div> -->
                <br>
              
            </div>

            <!--ABOUT Organization-->
            <!-- <div class="jobs-suggestions">
                <div class="jd-action-btn">
                    @if(in_array($job->companyId,$followArr))
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-success">@lang('home.following')</a>
                    @else
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-primary">@lang('home.follow')</a>
                    @endif
                </div>
                <h4>{{ $job->companyName }} </h4>
                <p>{{ JobCallMe::cityName($job->companyCity) }}, {{ JobCallMe::countryName($job->companyCountry) }}</p>
                <div class="jd-about-organization">
                    <p>{!! $job->companyAbout !!}
                    </p>
                </div>
            </div> -->
            <?php 
            //print_r($companyReview);
            $overallreview = array();
            $career = array();
            $benefit = array();
            $lifebalance = array();
            $management = array();
            $culture = array();
            $recommend_ceo = array();
            $recommend = array();
            $future = array();
            foreach($companyReview as $review)
            {
                $overallreview[] = $review->overall_review;
                $career[] = $review->career_opportunity;
                $benefit[] = $review->benefits;
                $lifebalance[] = $review->work_lifebalance;
                $management[] = $review->rate_management;
                $culture[] = $review->rate_culture;
                $recommend_ceo[] = $review->recommend_ceo;
                $recommend[] = $review->recommend;
                $future[] = $review->future;
            }
            if(sizeof($overallreview) > 0){
                $result = array_count_values($overallreview);
                $max = max($result);
                $star = array_search($max, $result);
            
                /*career*/
                $career_result = array_count_values($career);
                $career_max = max($career_result);
                $career_star = array_search($career_max, $career_result);
                /*benefit*/
                $benefit_result = array_count_values($benefit);
                $benefit_max = max($benefit_result);
                $benefit_star = array_search($benefit_max, $benefit_result);
                /*work/life banlance*/
                $lifebalance_result = array_count_values($lifebalance);
                $lifebalance_max = max($lifebalance_result);
                $lifebalance_star = array_search($lifebalance_max, $lifebalance_result);
                /*Management*/
                $management_result = array_count_values($management);
                $management_max = max($management_result);
                $management_star = array_search($management_max, $management_result);
                 /*Culture*/
                $culture_result = array_count_values($culture);
                $culture_max = max($culture_result);
                $culture_star = array_search($culture_max, $culture_result);
                 /*Ceo recommend*/
                $ceo_recommend_result = array_count_values($recommend_ceo);
                $ceo_recommend_max = max($ceo_recommend_result);
                $ceo_recommend_star = array_search($ceo_recommend_max, $ceo_recommend_result);
                /*recommend to friend*/
                $recommend_result = array_count_values($recommend);
                $recommend_max = max($recommend_result);
                $recommend_star = array_search($recommend_max, $recommend_result);
                /*future*/
                $future_result = array_count_values($future);
                $future_max = max($future_result);
                $future_star = array_search($future_max, $future_result);
            }
            ?>
            <div class="jobs-suggestions">
                <div class="jd-action-btn">
                    @if(in_array($job->companyId,$followArr))
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-success">@lang('home.following')</a>
                    @else
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-primary">@lang('home.follow')</a>
                    @endif   
                    <a href="{{ url('account/employeer/companies/company/review?CompanyId='.$job->companyId) }}" class="btn btn-default">@lang('home.Write Review')</a>   
                </div>
                <a href="{{url('companies/company/'.$job->companyId)}}"><h4>{{ $job->companyName }}</h4></a>
                <p>@lang('home.'.JobCallMe::cityName($job->companyCity)), @lang('home.'.JobCallMe::countryName($job->companyCountry))</p>
                <div class="jd-about-organization">
                    <p>{!! $job->companyAbout !!}</p>
                </div>
                <p align="center">
                   <span  style="color:#d6a707"><?= checkreview($star)?></span><br>
                   <span><a href="{{url('companies/company/'.$job->companyId)}}">@lang('home.View all Review')</a> <span class="badge"><?= count($companyReview)?></span></span>
                </p>
                <hr>
                <p>
                    <table>
                        <tr>
                            <td>@lang('home.Career Growth')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($career_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Compensation & Benefits')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($benefit_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Work/Life Balance')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($lifebalance_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Management')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($management_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Culture')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($culture_star)?>
                            </td>
                        </tr>
                    </table>
                </p>
                <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                        <div class="row" align="center">
                            <div class="col-md-4">
                                <span style="font-size:12px">{{$ceo_recommend_star}}</span>
                                <p>@lang('home.CEO Recommended')</p>
                            </div>
                            <div class="col-md-4">
                                <span style="font-size:12px">@if($recommend_star == 'on') Yes @else @lang('home.Not recommend') @endif</span>
                                <p>@lang('home.Recommend to a friend')</p>
                            </div>
                            <div class="col-md-4">
                                <span style="font-size:12px">{{$future_star}}</span>
                                <p>@lang('home.Future Expectations')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="jobs-suggestions">

                <div style="position: relative;overflow: auto;padding: 10px 20px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border: 1px solid #cccccc; margin-bottom: 20px;background: #ffffff;">
                	<input id="pac-input" class="controls" type="hidden" value="{!! $job->Address !!}" >

                	<!-- google map code html -->
                	<div id="map" style="width: 100%; height: 500px;"></div>
                </div>

            </div>
        </div>

        <div class="col-md-3">
            <!--Follow Companies - Start -->
            <div class="similar-jobs">
                <h4>@lang('home.similarjob') {{JobCallMe::countryName(JobCallMe::getHomeCountry())}}</h4>
                <hr>
                <div class="row">
                    @foreach($suggest as $appl)
                    <?php

                    $cLogo = url('compnay-logo/default-logo.jpg');
                    if($appl->companyLogo != ''){
                        $cLogo = url('compnay-logo/'.$appl->companyLogo);
                    }
                    ?>
                    <div class="col-md-12 col-xs-12 sp-items">
                        <div class="col-md-4 col-xs-4 sp-item-img">
                            <img src="{{ $cLogo }}" style="">
                        </div>
                        <div class="col-md-8 col-xs-8 sp-item" style="text-align:left !important">
                            <p><a href="{{ url('jobs/'.$appl->jobId) }}">{!! $appl->title!!}</a></p>
                            <p>{!! $appl->companyName !!}</p>

                            <p>{{ JobCallMe::cityName($appl->city) }}, {{ JobCallMe::countryName($appl->country) }}</p>
                            <span class="rtj-action">
                                <a href="{{ url('jobs/apply/'.$sJob->jobId) }}" title="Apply">
                                    <i class="fa fa-paper-plane"></i>
                                </a>&nbsp;
                                <a href="javascript:;" onclick="removeJob({{ $sJob->jobId }})" title="Remove" class="application-remove">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </span>

                        </div>

                    </div>
                    @endforeach
                    <hr>
                </div>
            </div>

        </div>
        
    </div>
   <?php  function checkreview($val){
      if($val == "Excellent"){
        return '<span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>';
      }
      else if($val == "Verygood"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
      else if($val == "Good"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
      else if($val == "Fair"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
      else if($val == "Poor"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }else{
        return '<span>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
    }
    ?>
    <style type="text/css">
      
      /* Optional: Makes the sample page fill the window. */
      
       #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
      
</style>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
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
function followCompany(companyId,obj){
    if($(obj).hasClass('btn-primary')){
        var type = 'follow';
    }else{
        var type = 'remove';
    }
    if($(obj).hasClass('btn-primary')){
        $(obj).removeClass('btn-primary');
        $(obj).addClass('btn-success');
        $(obj).text('@lang("home.following")');
    }else{
        $(obj).removeClass('btn-success');
        $(obj).addClass('btn-primary');
        $(obj).text('@lang("home.follow")');
    }
    $.ajax({
        url: "{{ url('account/jobseeker/company/action') }}?companyId="+companyId+"&type="+type,
        success: function(response){
            if($.trim(response) == 'redirect'){
                window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
            }
        }
    })
}
</script>
<!-- google map code start from there  -->
<script>
$(document).ready(function(){
 
});
 
    var addr=$('#pac-input').val();
        
   


      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
               var geocoder = new google.maps.Geocoder();
               var address = addr;
               var longitude="";
               var latitude="";
               var myLatLng="";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
         myLatLng={lat: latitude, lng: longitude}
    //alert(latitude);
     var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: latitude, lng: longitude},
          zoom: 14,
          mapTypeId: 'roadmap'
        });

  } 
   var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: addr
        });
});
     
      }

    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initAutocomplete" async defer></script>

@endsection