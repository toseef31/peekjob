@extends('frontend.layouts.app')

@section('title','Applicant')

@section('content')
 <?php
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
<section id="myResume" class="reume-section">
    <div class="container">
    
        <div class="row">
            <div class="col-md-12">
            @if($privacy->profile == 'Yes')
                <div class="col-md-9">
                    <!--Personal Info Start-->
                    <section class="personal-info-section" id="personal-information">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="profile-img">
                                    <img src="@if($privacy->profileImage == 'Yes') {{ $pImage}} @else {{url('profile-photos/profile-logo.jpg')}} @endif" style="width: 100%">
                                </div>
                                <h3 class="text-center hidden-md hidden-lg" style="font-weight: 600">{{$applicant->firstName}} {{$applicant->lastName}}</h3>
                                <p class="text-center hidden-md hidden-lg jp-profession-heading">@lang('home.'.JobCallMe::categoryTitle($applicant->industry))</p>
                                <a href="#" class="btn btn-primary btn-block jp-contact-btn">@lang('home.CONTACT DETAILS')</a>
								<div class="" style="text-align:center">
                                   <a href="{{ url('account/jobseeker/cv/'.$applicant->userId)}}" style="color:#737373" class=""><i class="fa fa-download"></i> @lang('home.DOWNLOAD')</a>
                                  </div>
                            </div>
                            <div class="col-md-9 personal-info-right">
                                <h3 class="hidden-sm hidden-xs">{{$applicant->firstName}} {{$applicant->lastName}}<span class="pull-right"><button class="btn btn-primary" onclick="$('#offerdModel').modal('show')"><i class="fa fa-bullhorn"></i> Offerd Interview</button></span></h3>
                                <p class="jp-profession-heading hidden-sm hidden-xs">@lang('home.'.JobCallMe::categoryTitle($applicant->industry))</p>
                                <p><span class="pi-title">@lang('home.experiences'):</span>@lang('home.'.$applicant->experiance)</p>
                                @if($privacy->dateofbirth == 'Yes')
                                 <p><span class="pi-title">@lang('home.age'):</span>  {{ JobCallMe::timeInYear($applicant->dateOfBirth) }},
                                 @else
                                 @endif @if($privacy->gender == 'Yes')<span class="pi-title"> @lang('home.gender'):</span> @lang('home.'.$applicant->gender)@endif</p>
                                
                                <p><span class="pi-title">@lang('home.currentsalary'):</span> @if($applicant->currency == 'KRW'){{ number_format($applicant->currentSalary != '' ? $applicant->currentSalary : '0',0).' '.$applicant->currency }}@endif @if($applicant->currency != 'KRW'){{ number_format($applicant->currentSalary != '' ? $applicant->currentSalary : '0',2).' '.$applicant->currency }}@endif</p>
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
                    @if($pckg > 0)
            <div>
                    <!--Academic Section Start-->
                    @if($privacy->academic == 'Yes')
                    <section class="resume-box" id="academic">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.academic')</h4>
                        <ul class="resume-details">
                           @if(count($resume['academic']) > 0)
                                @foreach($resume['academic'] as $resumeId => $academic)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            
                                            <p class="rd-date">@if(app()->getLocale() == "kr")
						    {!! date('Y-m',strtotime($academic->enterDate)) !!},  {!!  date('Y-m',strtotime($academic->completionDate)) !!} 
						@else
						    {!! date('M, Y',strtotime($academic->enterDate)) !!},  {!!  date('M, Y',strtotime($academic->completionDate)) !!}
						@endif</p>
                                            <p class="rd-title">{!! $academic->degree !!}</p>
                                            <p class="rd-organization">{!! $academic->institution !!}</p>
                                            <p class="rd-location">@lang('home.'.JobCallMe::cityName($academic->city)),@lang('home.'.JobCallMe::countryName($academic->country))</p>
                                            <p class="rd-grade">@lang('home.GradeGPA') : {!! $academic->grade !!}/{!! $academic->grade2 !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    @endif
                    <!--Academic Section End-->

                    <!--experience Section Start-->
                    @if($privacy->experience == 'Yes')
                    <section class="resume-box" id="experience">
                        <h4><i class="fa fa-star r-icon bg-primary"></i>  @lang('home.experiences')</h4>
                        <ul class="resume-details">
                         @if(count($resume['experience']) > 0)
                                @foreach($resume['experience'] as $resumeId => $experience)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                         
                                            <p class="rd-date">@if(app()->getLocale() == "kr")
						    {!! date('Y-m',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? '현재 재직중' : date('Y-m',strtotime($experience->endDate)) }}
						@else
						    {!! date('M, Y',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($experience->endDate)) }}
						@endif</p>
                                            <p class="rd-title">{!! $experience->jobTitle !!}</p>
                                            <p class="rd-organization">{!! $experience->organization !!}</p>
                                            <p class="rd-location">@lang('home.'.JobCallMe::cityName($experience->city)),@lang('home.'.JobCallMe::countryName($experience->country))</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    @endif
                    
                   <!--Skills Section Start-->
                   @if($privacy->skills == 'Yes')
                    <section class="resume-box" id="skills">
                        <h4><i class="fa fa-graduation-cap r-icon bg-primary"></i> @lang('home.skills')</h4>
                        <ul class="resume-details">
                            @if(count($resume['skills']) > 0)
                                @foreach($resume['skills'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <p class="rd-title">{!! $skills->skill !!}</p>
                                            <p class="rd-location">{!! $skills->level !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    @endif
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
                    @if($privacy->projectVisible == 'Yes')
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
						@endif</p>
											<p class="rd-location"> @if(app()->getLocale() == "kr")
						    @lang('home.projectposition') : {!! $skills->position !!}, @lang('home.occupation') : {!! $skills->occupation !!}, @lang('home.projectorganization') : {!! $skills->organization !!}
						@else
						    @lang('home.projectposition') :  {!! $skills->position !!}, @lang('home.occupation') : {!! $skills->occupation !!}, @lang('home.projectorganization') : {!! $skills->organization !!}
						@endif</p>
											
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    @endif
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
						@endif</p>
											<p class="rd-location">{!! $afflls->org !!} , @lang('home.'.JobCallMe::cityName($afflls->city)),@lang('home.'.JobCallMe::countryName($afflls->country))
											
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>

					<section class="resume-box" id="sk">
                        
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.preference')</h4>
                        <ul class="resume-details">
							@if(count($resume['preference']) > 0)
                                @foreach($resume['preference'] as $resumeId => $preference)
                            
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            
                                            <p class="rd-location">@lang('home.Veteran') : @lang('home.'.$preference->veteran)</p>
											<p class="rd-location">@lang('home.Job protection') : @lang('home.'.$preference->subsidy)</p>
											<p class="rd-location">@lang('home.Employment subsidy') : @lang('home.'.$preference->disability)</p>
											<p class="rd-location">@lang('home.Disability') : @lang('home.'.$preference->disability)</p>
											<p class="rd-location">@lang('home.Disability grade') : {!! $preference->disabilitygrade !!}</p>
											<p class="rd-location">@lang('home.Military service') : @lang('home.'.$preference->militaryservice)</p>
											<p class="rd-location">@lang('home.Militarystartyear') : {!! $preference->militarystartyear !!}</p>
											<p class="rd-location">@lang('home.Militarystartmonth') : @lang('home.'.$preference->militarystartmonth)</p>
											<p class="rd-location">@lang('home.Militaryendyear') : {!! $preference->militaryendyear !!}</p>
											<p class="rd-location">@lang('home.Militaryendmonth') : @lang('home.'.$preference->militaryendmonth)</p>
											<p class="rd-location">@lang('home.Military type') : @lang('home.'.$preference->militarytype)</p>
											<p class="rd-location">@lang('home.Military Classes') : @lang('home.'.$preference->militaryclasses)</p>
											
										  
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
                                            
                                            <p class="rd-title">@lang('home.'.$skills->language)</p>
											<p class="rd-location">@lang('home.'.$skills->level)</p>
											<p class="rd-location">{!! $skills->certifiedexam !!}</p>
											<p class="rd-location">{!! $skills->classscore !!}</p>
											<p class="rd-location">@if(app()->getLocale() == "kr")
						    {!! $skills->languageyear !!}년 @lang('home.'.$skills->languagemonth)
						@else
						   @lang('home.'.$skills->languagemonth), {!! $skills->languageyear !!}
						@endif </p>
											
										  
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
                    @if($privacy->publicationsVisible == 'Yes')
					<section class="resume-box" id="skil">
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.publication')</h4>
                        <ul class="resume-details">
                            @if(count($resume['publish']) > 0)
                                @foreach($resume['publish'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                           
                                            <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->pu_type !!})</span></p>
											<p class="rd-location"> {!! $skills->month !!}-{!! $skills->year !!}</p>
											<p class="rd-location"> @lang('home.Author'): {!! $skills->author !!}</p>
											<p class="rd-location">@lang('home.publisher'): {!! $skills->publisher !!}, @lang('home.'.JobCallMe::cityName($skills->city)),@lang('home.'.JobCallMe::countryName($skills->country))</p>
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    @endif
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
											<p class="rd-location"> {!! $skills->organization !!}<!-- {!! $skills->occupation !!} at {!! $skills->organization !!} --></p>
											
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
					
					<!--Portfolio Section-->
					<section class="resume-box" id="port">
                        
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
						@endif</p>
											<p class="rd-location">http://{!! $skills->website !!}</p>
											<p class="rd-location"> {!! $skills->occupation !!}</p>
											
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>


					<!--hopeworking Section-->
					<section class="resume-box" id="port">
                        
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.hopeworking')</h4>
                        <ul class="resume-details">
                            @if(count($resume['hopeworking']) > 0)
                                @foreach($resume['hopeworking'] as $resumeId => $hopeworking)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                           
                                            <p class="rd-title">@lang('home.'.$hopeworking->hopejobtype)</p>
                                            <p class="rd-location">@lang('home.'.JobCallMe::cityName($hopeworking->city)),@lang('home.'.JobCallMe::stateName($hopeworking->state)),@lang('home.'.JobCallMe::countryName($hopeworking->country))</p>	
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>



					<!-- 설명 -->
<?php


   $yo = array("SUN","MON","TUE","WED","THU","FRI","SAT");
   
   $resume_yo = $yo[date("w",strtotime(date(strtotime($applicant->createdTime))))];

?>
					<section class="resume-box">   								
                                   
                                        <div class="col-md-12 text-center" style="padding-top:20px;padding-bottom:20px;">                                            
                                            <p class="rd-location">@lang('home.All of the above is true.')</p>
                                            <p class="rd-title">@lang('home.Resume entry date') : @if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($applicant->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($applicant->createdTime))}}
						@endif (<?php echo trans('home.'.$resume_yo) ?>)</p>		
											<p class="rd-title">@lang('home.Writer') : {{$applicant->firstName}} {{$applicant->lastName}}</p>
                                        </div>	
										
										<div class="col-md-12 text-center" style="background:#f7f7f7;padding-top:20px;padding-bottom:10px;">                                            
                                            <p class="rd-location">@lang('home.By registering forged documents, you may be legally liable for use in employment activities.')</p>
                                            <p class="rd-location">@lang('home.JobCallMe Co., Ltd. does not guarantee or assume any responsibility for the documents registered by the applicant.')</p>
											<p class="rd-location">@lang('home.We are not responsible for any legal disputes that arise from trusting the attached document. (Related with Article 14 of Terms of Use)')</p>
											<p class="rd-location">@lang('home.In addition, resumes may be deleted or closed for use outside the job seeking / employment field.')</p>
										
                                        </div>	
                                
									
                               
                       
                    </section>
					<!-- 설명 끝 -->


                </div>
            @else 
                <div class="col-md-9">
                <div class="alert alert-danger"> this profile is restricted</div>
                </div>
            @endif

				<div class="col-md-3 follow-companies-side">

            @endif
                    <div class="pnj-box">
                        <div class="follow-companies2">
                            <h4>Similar People</h4>
                        </div>
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
                              <div class="col-md-4 applicant-SimilarImg">
                                <img src="@if($appl->privacyImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg') }} @endif">
                                </div>
                                <div class="col-md-8 sp-item">
                                <p><a href="{{ url('account/employer/application/applicant/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></p>
                                <p>{!! $appl->companyName !!}</p>
                                <p>@lang('home.'.JobCallMe::cityName($appl->city)), @lang('home.'.JobCallMe::countryName($appl->country))</p>
                            </div>
                            </div>
                             @endforeach                         
                        </div>
                    
                    </div>            
                </div>
               
				
            </div>
        </div>
    </div>
    <div id="offerdModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><i class="fa fa-bullhorn"></i> Offerd Interview</h4>
          </div>
          <div class="modal-body">
           <form id="offerd-form">
             <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <label for="offerd">Offerd Interview:</label>
               <textarea type="offerd" name="offer_msg" rows="5" class="form-control" id="offerd"></textarea>
               <input type="hidden" name="jobseeker_id" value="{{$applicant->userId}}">
               
               <input type="hidden" name="emp_id" value="{{ Session::get('jcmUser')->userId }}">
             </div>
           </form>
          </div>
          <div class="modal-footer">
             <button type="submit" id="btn-offerd" class="btn btn-success">Submit</button>
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
    $('#btn-offerd').on('click',function(){
       var data = $('#offerd-form').serialize();
       $.ajax({
        url:jsUrl()+"/account/employer/application/candidate/offer",
        type:"post",
        data:data,
        success:function(res){
            if(res == 1){
                toastr.success('offerd interview submit successfully');
                $('#offerd-form #offerd').val('');
                $('#offerdModel').modal('hide');
            }
            else{
             
                window.location.href = "{{ url('account/manage?plan') }}";
            }
        }
       });
    })
$(document).ready(function(){
    $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
})
</script>
@endsection