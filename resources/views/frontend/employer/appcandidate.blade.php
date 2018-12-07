@extends('frontend.layouts.app')
@section('title','Applicant')
@section('content')
  <?php
  $job=$_GET['jobId'];
 // echo $job;
 // die();
     $pImage = url('profile-photos/profile-logo.jpg');
      if($applicant->profilePhoto != '' && $applicant->profilePhoto != NULL){
       $pos = strpos($applicant->profilePhoto,"ttp");
        if($pos == 1)
        {
          $pImage = url($applicant->profilePhoto);
         } 
          else{
            $pImage = url('profile-photos/'.$applicant->profilePhoto);
              }
                           
                }
                   ?>

<section id="myResume">
    <div class="container"> 
        <ul class="nav nav-tabs" style="margin-top:20px">
            <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-user" aria-hidden="true"></i> @lang('home.resume')</a></li>
            <li><a data-toggle="tab" class='openConversation' href="#menu1" ><i class="fa fa-comments" aria-hidden="true"></i> @lang('home.conversation')</a></li>
            <li><a data-toggle="tab" href="#menu2"><i class="fa fa-clipboard" aria-hidden="true"></i> @lang('home.questionnaires')</a></li>
            <li><a data-toggle="tab" href="#evaluation"><i class="fa fa-star" aria-hidden="true"></i> @lang('home.evaluation')</a></li>
            <li><a data-toggle="tab" href="#menu4"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('home.interviews')</a></li>
        </ul>
        <div class="row">
            <div class="col-md-9">
                <div class="tab-content">
                    <!-- evaluation tab -->
                    <div id="evaluation" class="tab-pane fade in">
                        <form method="post" id="evaluation-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="candidate_id" value="{{$userId}}">
                            <input type="hidden" name="job_id" value="{{ $jobId }}">
                        <section class="personal-info-section">
                           <p class="bold">{{$evaluationData[0]->title}}</p>
                           <input type="hidden" name="evaluation_title" value="{{$evaluationData[0]->title}}">
                           <?php $No = 2;?>
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>@lang('home.evaNo')</th>
                                       <th>@lang('home.Factor')</th>
                                       <th>@lang('home.Rating')</th>
                                       <th>@lang('home.Score')</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <td>1</td>
                                       <td>@lang('home.Does the candidate meet the minimum qualification required for this job')</td>
                                       <td>
                                            <p style="margin-top: 4px">
                                                <input type="checkbox" id="qualification" class="switch-field" value="Yes" name="qualification" onchange="restrict(this)" @if($eva_ans[0]->qualification == 'Yes') checked @endif>
                                                <label for="qualification" class="switch-label">Yes</label>
                                            </p>  
                                        </td> 
                                   </tr>
                                   @foreach($evaluationData as $key => $evaluation)
                                   <tr>
                                        <td>{{ $No++ }} <input type="hidden" name="eva_ans_id[]" value="{{ $eva_ans[$key]->eva_ans_id}}"></td>
                                        <td>
                                            {{ $evaluation->evaluation_factor }}
                                            <input type="hidden" name="evaluation_factor[]" value="{{ $evaluation->evaluation_factor }}">
                                        </td>
                                        <td>
                                            <select class="form-control score">
                                                <option value="<?= $evaluation->weight * 1 ?>">1</option>
                                                <option value="<?= $evaluation->weight * 2 ?>">2</option>
                                                <option value="<?= $evaluation->weight * 3 ?>">3</option>
                                                <option value="<?= $evaluation->weight * 4 ?>">4</option>
                                                <option value="<?= $evaluation->weight * 5 ?>">5</option>
                                                <option value="<?= $evaluation->weight * 6 ?>">6</option>
                                                <option value="<?= $evaluation->weight * 7 ?>">7</option>
                                                <option value="<?= $evaluation->weight * 8 ?>">8</option>
                                                <option value="<?= $evaluation->weight * 9 ?>">9</option>
                                                <option value="<?= $evaluation->weight * 10 ?>">10</option>
                                            </select>
                                        </td>
                                        <td class="point">{{ $eva_ans[$key]->point}}</td>
                                        <input type="hidden" name="point[]" value="{{ $eva_ans[$key]->point}}">
                                   </tr>
                                   @endforeach
                               </tbody>
                           </table>
                           <hr>
                           <span class="pull-right margin-right"><strong>@lang('home.Total'):<span id="total">{{ $eva_ans[0]->total}}</span></strong></span>
                           <input type="hidden" name="total" value="{{ $eva_ans[0]->total}}">
                           <button type="button" class="btn btn-info save" disabled="disabled">@lang('home.Save Changes')</button>
                        </section>
                        </form>
                    </div>
                    <!-- main tab start resume -->
                    <div id="home" class="tab-pane fade in active">
        
                        <!--Personal Info Start-->
                        <section class="personal-info-section" id="personal-information">
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <img src="{{ $pImage}}" style="width: 100%;height:221px;">
                                    </div>
                                    <h3 class="text-center hidden-md hidden-lg" style="font-weight: 600">$applicant->firstName</h3>
                                    <p class="text-center hidden-md hidden-lg jp-profession-heading">@lang('home.'.JobCallMe::categoryTitle($applicant->industry))</p>
                                    <a href="#" class="btn btn-primary btn-block jp-contact-btn">@lang('home.CONTACT DETAILS')</a>
                                    <div class="" style="text-align:center">
                                    <a href="{{ url('account/jobseeker/cv/'.$applicant->userId)}}" style="color:#737373" class=""><i class="fa fa-download"></i> @lang('home.DOWNLOAD')</a>
                                    </div>
                                </div>
                                <div class="col-md-9 personal-info-right">
                                    <h3 class="hidden-sm hidden-xs">{{$applicant->firstName}} {{$applicant->lastName}} <span class="pull-right"><button class="btn btn-primary" onclick="$('#reviewModel').modal('show')">Write Review</button></span></h3>
                                    <p class="jp-profession-heading hidden-sm hidden-xs">@lang('home.'.JobCallMe::categoryTitle($applicant->industry))</p>
                                    <p><span class="pi-title">@lang('home.experiance'):</span>@lang('home.'.$applicant->experiance)</p>
                                    <p><span class="pi-title">@lang('home.salary'):</span> @if($applicant->currency == 'KRW'){{ number_format($applicant->currentSalary != '' ? $applicant->currentSalary : '0',0).' '.$applicant->currency }}@endif @if($applicant->currency != 'KRW'){{ number_format($applicant->currentSalary != '' ? $applicant->currentSalary : '0',2).' '.$applicant->currency }}@endif  </p>
                                    <p><span class="pi-title">@lang('home.location'):</span> @lang('home.'.JobCallMe::cityName($applicant->city)), @lang('home.'.JobCallMe::countryName($applicant->country))</p>
                                    <div class="professional-summary">
                                        <h4>@lang('home.p_summary')</h4>
                                        <p>{!! $applicant->about !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--Personal Info End-->

                        <!--Academic Section Start-->
                        <section class="resume-box" id="academic">
                            <h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.academic')</h4>
                            <ul class="resume-details">
                            @if(count($resume['academic']) > 0)
                                    @foreach($resume['academic'] as $resumeId => $academic)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-date">@if(app()->getLocale() == "kr")
						    {!! date('Y-m',strtotime($academic->completionDate)) !!}
						@else
						    {!! date('M, Y',strtotime($academic->completionDate)) !!}
						@endif</p>
                                                <p class="rd-title">{!! $academic->degree !!}</p>
                                                <p class="rd-organization">{!! $academic->institution !!}</p>
                                                <p class="rd-location">@lang('home.'.JobCallMe::cityName($academic->city)),@lang('home.'.JobCallMe::countryName($academic->country))</p>
                                                <p class="rd-grade">@lang('home.GradeGPA') : {!! $academic->grade !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!--Academic Section End-->

                        <!--Academic Section Start-->
                        <section class="resume-box" id="experience">
                            <h4><i class="fa fa-star r-icon bg-primary"></i>  @lang('home.experience')</h4>
                            <ul class="resume-details">
                            @if(count($resume['experience']) > 0)
                                    @foreach($resume['experience'] as $resumeId => $experience)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-date">@if(app()->getLocale() == "kr")
						    {!! date('Y-m',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? '현재 재직중' : date('M, Y',strtotime($experience->endDate)) }}
						@else
						    {!! date('M, Y',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($experience->endDate)) }}
						@endif</p>
                                                <p class="rd-title">{!! $experience->jobTitle !!}</p>
                                                <p class="rd-organization">{!! $experience->organization !!}</p>
                                                <p class="rd-location">@lang('home.'.JobCallMe::cityName($experience->city)),@lang('home.'.JobCallMe::countryName($experience->country)) </p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!--Academic Section End-->

                        <!--Academic Section Start-->
                    
                        <!--Academic Section End-->

                        <!--Academic Section Start-->
                        <section class="resume-box" id="certification">
                            <h4><i class="fa fa-certificate r-icon bg-primary"></i>  @lang('home.certification')</h4>
                            <ul class="resume-details">
                                @if(count($resume['certification']) > 0)
                                    @foreach($resume['certification'] as $resumeId => $certification)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-date">@if(app()->getLocale() == "kr")
						    {!! date('Y-m',strtotime($certification->completionDate)) !!}
						@else
						    {!! date('M, Y',strtotime($certification->completionDate)) !!}
						@endif</p>
                                                <p class="rd-title">{!! $certification->certificate !!}</p>
                                                <p class="rd-organization">{!! $certification->institution !!}</p>
                                                <p class="rd-location">@lang('home.'.JobCallMe::cityName($certification->city)),@lang('home.'.JobCallMe::countryName($certification->country))</p>
                                                <p class="rd-grade">@lang('home.cerscore') : {!! $certification->score !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!--Academic Section End-->
                        <!---Project -->
                        <section class="resume-box" id="ski"> 
                            <h4><i class="fa fa-edit r-icon bg-primary"></i> @lang('home.project')</h4>
                            <ul class="resume-details">
                                @if(count($resume['project']) > 0)
                                    @foreach($resume['project'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                            
                                                <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
                                                <p class="rd-location"> @if(app()->getLocale() == "kr")
						    {!! $skills->startyear !!}년 @lang('home.'.$skills->startmonth) - {{ $skills->currently == 'yes' ? '현재 재직중' : $skills->endyear.'년' }} @lang('home.'.$skills->endmonth) 
						@else
						    {!! $skills->startmonth !!} {!! $skills->startyear !!} - {{ $skills->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($skills->endDate)) }}
						@endif </p>
                                                <p class="rd-location"> @if(app()->getLocale() == "kr")
						    @lang('home.projectposition') : {!! $skills->position !!}, @lang('home.occupation') : {!! $skills->occupation !!}, @lang('home.projectorganization') : {!! $skills->organization !!}
						@else
						    @lang('home.projectposition') :  {!! $skills->position !!}, @lang('home.occupation') : {!! $skills->occupation !!}, @lang('home.projectorganization') : {!! $skills->organization !!}
						@endif 
                                            <p class="rd-location">{!! $skills->detail !!}</p>
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!---Affilation -->
                        <section class="resume-box" id="aff"> 
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.Affiliation')</h4>
                            <ul class="resume-details">
                                @if(count($resume['affiliation']) > 0)
                                    @foreach($resume['affiliation'] as $resumeId => $afflls)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-title">{!! $afflls->pos !!}</p>
                                                <p class="rd-location"> @if(app()->getLocale() == "kr")
						    {!! $afflls->stayear !!}년 @lang('home.'.$afflls->stamonth) - {!! $afflls->enyear !!} @lang('home.'.$afflls->enmonth)
						@else
						    {!! $afflls->stamonth !!} {!! $afflls->stayear !!} - {!! $afflls->enmonth !!} {!! $afflls->enyear !!}
						@endif  </p>
                                                <p class="rd-location">{!! $afflls->org !!} , @lang('home.'.JobCallMe::cityName($afflls->city)),@lang('home.'.JobCallMe::countryName($afflls->country))</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <section class="resume-box" id="sk">                        
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.language')</h4>
                            <ul class="resume-details">
                                @if(count($resume['language']) > 0)
                                    @foreach($resume['language'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                                
                                                <p class="rd-title">{!! $skills->language !!}</p>
                                                <p class="rd-location"> ({!! $skills->level !!})</p>
                                                
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <section class="resume-box" id="skill">    
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.references')</h4>
                            <ul class="resume-details">
                                @if(count($resume['reference']) > 0)
                                    @foreach($resume['reference'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                            
                                                <p class="rd-title">{!! $skills->name !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
                                                <p class="rd-location"> @lang('home.refjobtitle'): {!! $skills->jobtitle !!}</p>
                                                <p class="rd-location">@lang('home.reforganization'): {!! $skills->organization !!}, @lang('home.'.JobCallMe::cityName($skills->city)),@lang('home.'.JobCallMe::countryName($skills->country))</p>
                                            <p class="rd-location">@lang('home.phone') : {!! $skills->phone !!}</p>
                                            <p class="rd-location">@lang('home.email') : {!! $skills->email !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                            <!---Publication -->
                        <section class="resume-box" id="skil">
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.publication')</h4>
                            <ul class="resume-details">
                                @if(count($resume['publish']) > 0)
                                    @foreach($resume['publish'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                            
                                                <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >(@lang('home.'.$skills->pu_type))</span></p>
                                                <p class="rd-location"> {!! $skills->year !!}-{!! $skills->month !!}</p>
                                                <p class="rd-location"> @lang('home.Author'): {!! $skills->author !!}</p>
                                                <p class="rd-location">@lang('home.publisher'): {!! $skills->publisher !!}, @lang('home.'.JobCallMe::cityName($skills->city)),@lang('home.'.JobCallMe::countryName($skills->country))</p>
                                            <p class="rd-location">{!! $skills->detail !!}</p>
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <section class="resume-box" id="s"> 
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.award')</h4>
                            <ul class="resume-details">
                                @if(count($resume['award']) > 0)
                                    @foreach($resume['award'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                                
                                                <p class="rd-title">{!! $skills->title !!}</p>
                                                <p class="rd-location"> {!! $skills->type !!},@if(app()->getLocale() == "kr")
						    {!! $skills->startyear !!}년 @lang('home.'.$skills->startmonth)
						@else
						    {!! $skills->startmonth !!} {!! $skills->startyear !!}
						@endif</p>
                                                <p class="rd-location"> {!! $skills->occupation !!} at {!! $skills->organization !!}</p>
                                                
                                            <p class="rd-location">{!! $skills->detail !!}</p>
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <!--Portfolio Section-->
                        <section class="resume-box" id="port"> 
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.Portfolio')</h4>
                            <ul class="resume-details">
                                @if(count($resume['portfolio']) > 0)
                                    @foreach($resume['portfolio'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-title">{!! $skills->title !!}<span class="rd-location">({!! $skills->type !!})</span></p>
                                                <p class="rd-location">@if(app()->getLocale() == "kr")
						    {!! $skills->startyear !!}년 @lang('home.'.$skills->startmonth)
						@else
						    {!! $skills->startmonth !!} {!! $skills->startyear !!}
						@endif </p>
                                                <p class="rd-location">http://{!! $skills->website !!}</p>
                                                <p class="rd-location"> {!! $skills->occupation !!}</p> 
                                            <p class="rd-location">{!! $skills->detail !!}</p> 
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>

				    </div>
					<div id="menu1" class="tab-pane fade">
						<section class="personal-info-section" id="personal-information">
                            <div class="row">
                                <div id="cometchat_embed_synergy_container" style="width:959px;height:500px;max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;" ></div>
                                <script src="/cometchat/js.php?type=core&name=embedcode" type="text/javascript"></script>
                                <script>var iframeObj = {};iframeObj.module="synergy";iframeObj.style="min-height:420px;min-width:350px;";iframeObj.width="959px";iframeObj.height="500px";iframeObj.src="/cometchat/cometchat_embedded.php"; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(iframeObj);}</script>

                                <!--<div class="col-md-12">
                                    <textarea class="form-control area"  placeholder="Message"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Send on enter
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <button  type="button" class="btn btn-success pull-right" style="margin-top:12px">@lang('home.send')</button>
                                </div>-->
                            </div>
						</section>
					</div>
                    <div id="menu2" class="tab-pane fade">
                        <section class="personal-info-section" id="personal-information">
                            <div class="row">
                                <div class="col-md-12">
                                @if(count($questionData) == 0)
                                    <p>@lang('home.No Questionnaire or Test scheduled yet.')</p>
                                @endif
                                    <ol type="1" style="margin-left:30px;">
                                    <?php $i =0 ;?>
                                    @foreach($questionData as $question)
                                        <li><strong>{{$question->question}}</strong><br>
                                            @lang('home.Ans') <strong>{{$question->answer}}</strong>
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </section>
                    </div>
					<div id="menu4" class="tab-pane fade">
                        <!-- schedule interview -->
                        <div class="col-md-12 ea-scheduleInerview">
                            <div class="col-md-12" style="margin-top: 10px;">
                                <form action="#" method="" class="form-horizontal interview">
                                    <input type="hidden" name="_token" class="token">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.applicants')</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control date-picker" value="{{$applicant->firstName}} {{$applicant->lastName}}" onkeypress="return false">
                                            <input type="hidden" class="form-control date-picker" name="applicantInter[]" value="{{$applicant->userId}}_{{ $job }}" onkeypress="return false">
                                            <input type="hidden" name="interviewId" value="{{ $interviewData->interviewId }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">Date to</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control date-picker" name="toDate" value="{{ $interviewData->toDate }}" onkeypress="return false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">Date from</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control date-picker" name="fromDate" value="{{ $interviewData->fromDate }}" onkeypress="return false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">Time to</label>
                                        <div class="col-md-6">
                                            <select name="timeto" class="form-control">
                                                @foreach(JobCallMe::timeArray() as $time)
                                                    <option value="{!! $time !!}" @if($time == $interviewData->time_to) selected @endif>{!! $time !!}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">Time from</label>
                                        <div class="col-md-6">
                                            <select name="timefrom" class="form-control">
                                                @foreach(JobCallMe::timeArray() as $time)
                                                    <option value="{!! $time !!}" @if($time == $interviewData->time_from) selected @endif>{!! $time !!}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.timeinterview')</label>
                                        <div class="col-md-6">
                                            <select class="form-control select2" name="perInterview">
                                                @for($i = 1; $i < 10; $i++)
                                                    <option value="{{ $i * 20 }}" @if(($i * 20) == $interviewData->perInterview) selected @endif>{{ ($i * 20).trans('home.Minutes') }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.interviewvenue')</label>
                                        <div class="col-md-6">
                                            <select class="form-control select2" name="venue">
                                                @foreach(JobCallMe::interviewVenue() as $venue)
                                                    <option value="{{ $venue->venueId }}">{!! $venue->title !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">&nbsp;</label>
                                        <div class="col-md-6">
                                            <button type="submit" name="save" class="btn btn-primary pull-right">@lang('home.save')</button>
                                        <!-- <button type="button" class="btn btn-default" onclick="$('.ea-scheduleInerview').fadeOut()">Cancel</button> !-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
            </div>
			<div class="pnj-box">
				<h4>@lang('home.similarpeople') @lang('home.'.JobCallMe::countryName(JobCallMe::getHomeCountry()))</h4>
				<div class="row" style="margin-right: 0 !important;">
					@foreach($Query as $appl) 
                        <?php
                        $pImage = url('profile-photos/profile-logo.jpg');
                        if($appl->profilePhoto != '' && $appl->profilePhoto != NULL){
                        $pos = strpos($appl->profilePhoto,"ttp");
                            if($pos == 1)
                            {
                            $pImage = url($appl->profilePhoto);
                            } 
                            else{
                                $pImage = url('profile-photos/'.$appl->profilePhoto);
                                }
                                            
                                    }
                                    ?>
                        <div class="col-md-12 sr-item">
					        <div class="col-md-4">
                                <img src="@if($appl->privacyImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg') }} @endif" style="width: 70px;height:75px;">
							</div>
							<div class="col-md-8 sp-item">
                                <p><a href="{{ url('account/employer/application/candidate/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></p>
                                <p>{!! $appl->companyName !!}</p>
                                <p>@lang('home.'.JobCallMe::cityName($appl->city)), @lang('home.'.JobCallMe::countryName($appl->country))</p>
                            </div>
						</div>
					@endforeach 
                </div>
			</div>
        </div>
    </div>
<div id="reviewModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Review on Resume</h4>
          </div>
          <div class="modal-body">
           <form id="review-form">
             <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <label for="review">Review:</label>
               <textarea type="review" name="comment" rows="5" class="form-control" id="review"></textarea>
               <input type="hidden" name="jobseeker_id" value="{{$applicant->userId}}">
               <input type="hidden" name="job_id" value="<?php echo $_GET['jobId']; ?>">
               <input type="hidden" name="employeer_id" value="{{ Session::get('jcmUser')->userId }}">
             </div>
           </form>
          </div>
          <div class="modal-footer">
             <button type="submit" id="btn-review" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.input-error{color: red;}
</style>
<script type="text/javascript">
  var token = "{{ csrf_token() }}";

   $('form.interview').submit(function(e){
        $('.interview button[name="save"]').prop('disabled',true);

        $('.interview .token').val(token);
        $.ajax({
            type: 'post',
            data: $('.interview').serialize(),
            url: "{{ url('account/employer/application/interview/save') }}",
            success: function(response){
                if($.trim(response) != '1'){
                    toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
                }else{
                    toastr.success('@lang("home.Action perform successfully")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
                    //$("li:first").addClass("active");
                }
                $('.interview button[name="save"]').prop('disabled',false);
            }
        })
        e.preventDefault();
    })
    $('#btn-review').on('click',function(){
       var data = $('#review-form').serialize();
       $.ajax({
        url:jsUrl()+"/account/employer/application/candidate/review",
        type:"post",
        data:data,
        success:function(res){
            if(res == 1){
                toastr.success('review submit successfully');
                $('#review-form #review').val('');
                $('#reviewModel').modal('hide');
            }
        }
       });
    })
    restrict($('#qualification'));
    function restrict(el){
        if($(el).is(':checked')){ 
            $('.save').removeAttr('disabled')
        }else{
            $('.save').attr('disabled','disabled')
        }
    }
    $('.score').on('change',function(){
        var selectval = $(this).val();
        $(this).closest('tr').find('td').eq(3).text(selectval);
        $(this).closest('tr').find('input[name="point[]"]').val(selectval);
        var total = $('#total').text();
        var all = $('.point').toArray();
        $('#total').text(disp(all));
        $('input[name="total"]').val(disp(all));

    })
    function disp( divs ) {
          var a = 0;
          for ( var i = 0; i < divs.length; i++ ) {
             a += +divs[ i ].innerHTML ;
          }
          return a;
      }
    $('.save').on('click',function(){
        var formData = $('#evaluation-form').serialize();
        $.ajax({
            url:jsUrl()+"/evaluation/candidate/save",
            type:"post",
            data:formData,
            success:function(res){
               if(res != 1){
                $('#evaluation-form').find('input[name="eva_ans_id[]"]').remove();
                $('#evaluation-form').append(res);
                toastr.success("evaluation Done");
               }else{
                toastr.success("evaluation Data Updated");
               }
            }
        });

    });
    
  
    $(document).ready(function(){
        $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
    })
   

    $(document).on('click','.openConversation',function(){
        $("#cometchat_synergy_iframe").contents().find("#cometchat_userlist_"+"<?=$userId?>").click(); 
    });
</script>
@endsection