@extends('frontend.layouts.app')

@section('title','Employer')

@section('inner-header')
    <!-- @include('frontend.includes.employer-nav') -->
@endsection

@section('content')

<?php
$userImage = url('profile-photos/profile-logo.jpg');
if($user->profilePhoto != ''){

    $pos = strpos($user->profilePhoto,"ttp");
    if($pos == 1)
    {
        $userImage = url($user->profilePhoto);
    } 
    else{
        $userImage = url('profile-photos/'.$user->profilePhoto);
        }
    }
?>

<!--related-job-->
<section id="relate-to-job" class="employee-dashboard">
    <div class="container">
        <div class="row">
            <!-- left sideBar -->
            <div class="col-md-3">
              <div class="left-sideBar">
                <div class="timeline-cover">
                  <img src="../frontend-assets/images/timelineCover.svg">
                </div>
                <div class="user-section text-center">
                  <a href="{{url('account/manage?profiles')}}">
                    <div class="user-profile-img">
                      <img src="{{ $userImage }}">
                    </div>
                    <h5><strong>{{ $user->firstName.' '.$user->lastName }}</strong></h5>
                    <span>Designation</span>
                  </a>  
                </div>
                <div class="user-section text-center">
                  <a href="{{ url('account/employer/organization') }}">
                    <div class="profile-img">
                      <i class="fa fa-building fa-2x"></i>
                    </div>
                    <h5><strong>My company</strong></h5>
                  </a>  
                </div>
                <div class="user-section text-center">
                  <a href="{{ url('account/employer/job/new') }}">
                    <div class="profile-img">
                      <i class="fa fa-edit fa-2x"></i>
                    </div>
                    <h5><strong>Post a job</strong></h5>
                  </a>  
                </div>
                <div class="user-section text-center">
                  <a href="{{ url('download') }}">
                    <div class="profile-img">
                      <i class="fa fa-download fa-2x"></i>
                    </div>
                    <h5><strong>Download</strong></h5>
                  </a>  
                </div>
                <div class="user-section text-center">
                  <a href="{{ url('account/jobseeker') }}">
                    <div class="profile-img">
                      <i class="fa fa-search-plus fa-2x"></i>
                    </div>
                    <h5><strong>Jobseeker</strong></h5>
                  </a>  
                </div>
              </div>
            </div>
            <!-- End LeftSide Bar -->
            <!--RTJ- Left start-->
            <div class="col-md-6 employee-job-section">
				<div class="emplyee-jobs" style="background:#57768a;color:#fff;">
                    <!-- <ul class="nav nav-tabs"> -->
					<ul class="nav nav-tabs">
                       <li class="active" style="width:33.3%">
                            <a href="#rtj_tab_posted_jobs" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-bars" aria-hidden="true"></i> @lang('home.postedjobs')
                         
                                <span class="badge badge-pill badge-primary">{{sizeof($postedJobs)}}</span>
                           

                            </a>
                        </li>
                        <li style="width:33.3%">
                            <a href="#rtj_tab_recent_application" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-address-book"></i> @lang('home.recentapplicant')

                            
                                <span class="badge badge-pill badge-danger">{{sizeof($applicant)}}</span>
                           

                            </a>
                        </li>
                        <li style="width:33.3%">
                            <a href="#rtj_tab_interview" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-calendar"></i> @lang('home.upcominginterviews') 
                                 
                                <span class="badge badge-pill badge-success">{{sizeof($upcommingInterviews)}}</span>
                        

                            </a>
                        </li>
                   </ul>
				</div>
                <div class="rtj-box">                    
                    <div class="tab-content employe-joblisting">
                        <div class="tab-pane active" id="rtj_tab_posted_jobs">
						<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
                            @foreach($postedJobs as $key=>$pjobs)
							
                                <div class="col-xs-10 col-md-11 rtj-item">
							
                                    <div class="rtj-details">
                                        <p><strong><a href="{{ url('jobs/'.$pjobs->jobId) }}">{!! $pjobs->title !!}</a></strong> <i class="fa fa-check-circle-o"></i></p>
										<?php ($opcl = strtotime($pjobs->expiryDate) <= strtotime(date('Y-m-d')) ? 'Closed' : 'Open')?>
                                         <p>@lang('home.'.$opcl)                                        
										 <span class="label" style="background-color: {{ $colorArr[array_rand($colorArr)] }}">{!! $pjobs->p_title !!}</span>
										 
										
										@if ($pjobs->p_title =='Basic')
											<a href="{{ url('account/employer/jobupdate/'.$pjobs->jobId) }}">(@lang('home.upgrade'))</a>
                                         @else
											 @endif
										 </p>
										 <p><i class="fa fa-users"></i> {{ $pjobs->count}}</p>
                                    </div>
									
                                </div>

									<div class="col-xs-2 col-md-1"><div class="dropdown">
									  <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 21px;"></i>
                                      <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 21px;"></i>

									  <div class="dropdown-content">
										<a href="{{url('account/employer/job_update/'.$pjobs->jobId)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> @lang('home.edit')</a>
										<a href="{{url('account/employer/setfilter/'.$pjobs->jobId)}}"><i class="fa fa-filter" aria-hidden="true"></i> @lang('home.filters')</a>
										<a href="{{url('account/employer/job/share/'.$pjobs->jobId)}}"><i class="fa fa-share-alt" aria-hidden="true"></i> @lang('home.share')</a>
										<a href="{{url('account/employer/status/'.$pjobs->jobId)}}"><i class="fa fa-bar-chart" aria-hidden="true"></i> @lang('home.status')</a>
										<a href="{{url('account/employer/evalution/'.$pjobs->jobId)}}"><i class="fa fa-question" aria-hidden="true"></i> @lang('home.evaluation')</a>
                                        <a href="#" onclick="return false;" class="active_deactive{{$pjobs->jobId}}" id="active_deactive{{$key}}"><i class="fa fa-eye" aria-hidden="true"></i> @lang('home.Active')</a>
                                        <input type="hidden" class="JobId" value="{{$pjobs->jobId}}">
                                        <input type="hidden" class="check{{$pjobs->jobId}}" value="{{$pjobs->jobStatus}}">
										<a href="{{ url('account/employer/delete/'.$pjobs->jobId) }}"><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('home.delete')</a>
									  </div>
									</div></div>
                            @endforeach
							 <div class="col-md-12">
                                <a href="{{ url('jobs')}}" class="pull-right" style="padding-top: 5px">@lang('home.jobviewall')</a>
                            </div>
						<div style="text-align:center"><?php	echo $postedJobs->render(); ?></div>
                        </div>
                        <!--Recent Applicant Start-->
                        <div class="tab-pane" id="rtj_tab_recent_application">
                            @foreach($applicant as $appl)
                                <div class="col-md-12 rtj-item">
                                    <img src="{{ url('profile-photos/'.$appl->profilePhoto) }}" style="width: 50px">
                                    <div class="rtj-details">
                                        <p><strong><a href="{{ url('account/employer/application/candidate/'.$appl->userId) }}?jobId={{$appl->jobId}}">{!! $appl->firstName.' '.$appl->lastName !!}</a></strong></p>
                                        <p>{!! $appl->title !!}</p>
                                        <p>{{ $appl->applyTime }}</p>
                                    </div>
                                </div>
                            @endforeach
							 <div class="col-md-12">
                                <a href="{{ url('account/employer/application')}}" class="pull-right" style="padding-top: 5px">@lang('home.applyviewall')</a>
                            </div>
							<div style="text-align:center"><?php	echo $postedJobs->render(); ?></div>
                        </div>
                        <!--Recent Applicant End-->

                        <!--Upcoming Interviews Start-->
                        
                        
                        <div class="tab-pane" id="rtj_tab_interview">
                        @foreach( $upcommingInterviews as $interview)
                            <div class="col-md-12 rtj-item">
                                <img src="{{ url('profile-photos/'.$interview->profilePhoto)}}" style="width: 50px">
                                <div class="rtj-details">
                                    <p><strong><a href="{{ url('account/employer/application/candidate/'.$interview->jobseekerId) }}">{{ $interview->firstName." ".$interview->lastName}}</a></strong></p>
                                    <p><a href="{{ url('jobs/'.$interview->jobId) }}">{{ $interview->title }}</a> <span class="label" style="background-color:{{ $colorArr[array_rand($colorArr)] }}"><a style="color:#fff" href="{{ url('account/employer/application/candidate/'.$interview->jobseekerId) }}">@lang('home.interview Details')</a></span></p>
                                    <p><i class="fa fa-clock-o"></i> Date {{ $interview->fromDate }} Time {{ $interview->toDate }}   <i class="fa fa-map-marker"></i> @lang('home.'.$interview->country), @lang('home.'.$interview->state), @lang('home.'.$interview->city)</p>
                                </div>
                            </div>
                             @endforeach
                            <div class="col-md-12">
                                <a href="{{ url('account/employer/application?show=interview')}}" class="pull-right" style="padding-top: 5px">@lang('home.interviewall')</a>
                            </div>
                        </div>
                       
                        <!--Upcoming Interviews End-->
                    </div>
                </div>
            </div>
            <!--RTJ- Left end-->

            <!--RTJ- Right start-->
            <div class="col-md-3 follow-companies-side" style="margin-bottom:20px">
                <!--Follow Companies - Start -->
                <div class="follow-companies2" style="background:#57768a;color:#fff;">
                    <h4>@lang('home.suggestedpeople')</h4>
				</div>
				<div class="follow-companies">	
                    <div class="row">
					@foreach($applicants as $appl)
					<?php
                        $pImage = url('profile-photos/profile-logo.jpg');
                        if($appl->profilePhoto != '' && $appl->profilePhoto != NULL){
                        $pos = strpos($appl->profilePhoto,"ttp");
                            if($pos == 1){
                                $pImage = url($appl->profilePhoto);
                            } 
                            else{
                                $pImage = url('profile-photos/'.$appl->profilePhoto);
                            }
                                    
                        }
                    ?>
                        <div class="col-md-12 col-xs-12 sp-item" style="padding-top:10px">
						    <div class="col-md-3 col-xs-3 sp-item-img">
                                <img src="@if($appl->privacyImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg') }}@endif">
                            </div>
							
						    <div class="col-md-9 col-xs-9 sp-item-descriptn">
                                <p><a href="{{ url('account/employer/application/applicant/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></p>
                                <p>{!! $appl->companyName !!}</p>
                                <p>@lang('home.'.JobCallMe::cityName($appl->city)), @lang('home.'.JobCallMe::countryName($appl->country))</p>
                            </div>	
						</div>
						 @endforeach
                        <hr>
                        <div class="col-md-12">
                            <a href="people" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                        </div>
                    </div>
                </div>


				<!--  <div class="follow-companies2" style="background:#605e63;color:#fff;">
                    <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.write')</span></a>
                    <h4>@lang('home.suggestedreading')</h4>
				</div>
				<div class="suggested-reading">
                    
					   @foreach($read_record as $rec)
					   <?php
                        $pImage = url('profile-photos/profile-logo.jpg');
                        if($rec->wIcon != '' && $rec->wIcon != NULL){
                            $pImage = url('article-images/'.$rec->wIcon);
                        }
                        ?>
                    <div class="col-md-12 sr-item">
						<div class="col-md-4 col-xs-12">
                            <div class="suggestedreading-img-mbl">
							    <img src="{{ $pImage }}" style="width: 100%;height:auto !important;">
                            </div>    
						</div>
						<div class="col-md-8 col-xs-12" style="padding-top:10px">
							<div class="sr-details">
								<p class="sr-title"><a href="{{ url('read/article/'.$rec->writingId) }}">{!! $rec->title !!} </a> </p>
								<p class="sr-author"><a href="{{ url('read/article/'.$rec->writingId) }}"><span class="glyphicon glyphicon-user"></span>@lang('home.read_writer') <span style="color:#337ab7">{{ $rec->firstName.' '.$rec->lastName }}</span></a> </p>
							</div>
						</div>
                    </div>
					   @endforeach

                    <div class="col-md-12">
                        <a href="{{ url('read') }}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                    </div>
                </div> -->


				<!-- <div class="follow-companies2" style="background:#8a9fa0;color:#fff;">
                    <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.ADVERTISE')</span></a>
                    <h4>@lang('home.ImproveCompetitiveAdvantage')</h4>					
				</div>
				<div class="follow-companies"> -->
                    <!-- <h4 class="pull-left">@lang('home.ImproveCompetitiveAdvantage')</h4><h5 class="pull-right">@lang('home.ADVERTISE')</h5>
                    <hr style="margin-top:44px !important"> -->
                    <!-- <div class="row">
				            @foreach($lear_record as $rec)
                   
                      <div class="col-md-12 sr-item">
				      <div class="col-md-4 col-xs-12">

                        <div class="suggestedreading-img-mbl">
                            @if($rec->upskillImage != '')
                            <img class=" img-responsive sp-item" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="" style="width: 100%;height:auto !important;">
                            @else
                            <img src="{{ url('upskill-images/d-cover.jpg') }}" style="width: 100%;height:auto !important;">
                            @endif
                        </div>
						</div>
                        <div class="col-md-8 col-xs-12" style="margin-top: 10px;">
                            <p> <a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId) }}" class="la-title">{!! $rec->title !!}</a></p>
                            
                            <span>@lang('home.'.$rec->type)</span>
                            <p><i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($rec->startDate))}} <i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}}</p>
                            
                            <span><i class="fa fa-map-marker"></i> @lang('home.'.JobCallMe::cityName($rec->city)), @lang('home.'.JobCallMe::countryName($rec->country))</span>
                            
                       </div>
                   </div>
                
            @endforeach

                      

                        <hr>
                        <div class="col-md-12">
                            <a href="{{url('learn/search')}}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                        </div>
                    </div>
                </div> -->



		</div>
                
			
        </div>
    </div>
</section>
<!--Graph Section-->

<section id="employer-graph">
    <div class="container">
        <div class="row">
        @if (Session::has('message'))
   <div class="alert alert-success  alert-dismissable" style="position: absolute;z-index: 999;width: 86%;"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>{{ Session::get('message') }}</div>
@endif
            <div class="col-md-4">
                <div class="eg-job-response">
                    <h4>@lang('home.jobresponse')</h4>
                    <canvas id="job-response" style="margin-top: 79px;"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="eg-job-response">
                    <h4>@lang('home.experiencelevel')</h4>
                    <canvas id="experience-level" ></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="eg-job-response">
                    <h4>@lang('home.recruitmentactivity')</h4>
                    <canvas id="recruitment-activity" style="margin-top: 79px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
var jArray = <?php echo json_encode($postedJobs); ?>;

var oye='';
//var id='';
var i='';
var token = "{{ csrf_token() }}";
$(document).ready(function(){


     for(i=0;i<jArray.data.length;i++){
         console.log(jArray.data[i].jobStatus);
         // id = jArray.data[i].jobId;
           // alert(id);
            oye = jArray.data[i].jobStatus;
           // alert(oye);
         if(oye=='Publish'){
            $('#active_deactive'+i).html('<i class="fa fa-eye" id="active"></i> @lang("home.Active")');
            }else{
            $('#active_deactive'+i).html('<i class="fa fa-eye-slash" id="deactive"></i> @lang("home.Deactive")');
            }

         var jobstatus = '';
$('#active_deactive'+i).click(function(e){
    var id=$(e.target).siblings('input').val();
    var yes=$('.check'+id).val();
   // var id=$('.JobId').val();
    //alert(yes);
  
  if(yes=='Publish'){
      $('.active_deactive'+id).html('<i class="fa fa-eye-slash" id="deactive"></i> @lang("home.Deactive")');
      yes=$('.check'+id).val('Draft');
      //alert(oye);
      var token = "{{ csrf_token() }}";
       jobstatus = 'Draft';
        $.ajax({
            url:'{{url("account/jobs/status")}}',
            data:{id:id,jobstatus:jobstatus,_token:token },
            type:'POST',
            success:function(res){
              //alert(res);
               if(res == 1){
                toastr.success('@lang("home.status deactivate")');
               }else{
                alert('error in controller admin/Cms/jobstatupdate line no 469');
               }
            }
        });
  }
  else if(yes=='Draft'){
      
       $('.active_deactive'+id).html('<i class="fa fa-eye" id="active"></i> @lang("home.Active")');
      //  yes='Publish';
        yes=$('.check'+id).val('Publish');
           jobstatus = 'Publish';
             var token = "{{ csrf_token() }}";
        
        $.ajax({
            url:'{{url("account/jobs/status")}}',
            data:{id:id,jobstatus:jobstatus,_token:token },
            type:'POST',
            success:function(res){
             //  alert(res);
               if(res == 1){
                toastr.success('@lang("home.status active")');
               }else{
                alert('error in controller admin/Cms/jobstatupdate line no 469');
               }
            }
        });
  }
})
       }


});

    var ctx = document.getElementById('job-response').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [{!! implode(',',$response[0]) !!}],
            datasets: [{
                label: "@lang('home.jobresponse')",
                //backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [{!! implode(',',$response[1]) !!}],
            }]
        },

        // Configuration options go here
        options: {}
    });
    var ctx = document.getElementById("experience-level");
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
           labels: [{!! implode(',',$experience[0]) !!}],
            datasets: [{
                label: '# of Votes',
                data: [{!! implode(',',$experience[1]) !!}],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 170, 125, 1)',
                    'rgba(75, 120, 225, 1)',
                    'rgba(54, 120, 54, 1)',
                    'rgba(220,60,232,1)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 170, 64, 1)',
                    'rgba(75, 120, 225, 1)',
                    'rgba(54, 120, 54, 1)',
                    'rgba(220,60,232,1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById("recruitment-activity");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [{!! implode(',',$recruit[0]) !!}],
            datasets: [{
                label: "@lang('home.recruitmentactivity')",
                data: [{!! implode(',',$recruit[1]) !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection