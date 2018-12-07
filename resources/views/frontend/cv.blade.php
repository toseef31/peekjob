<!DOCTYPE html>

 <html lang="ko">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
@font-face {
  font-family: 'Jeju Myeongjo';
  font-style: normal;
  font-weight: 400;
  src: url("{{asset('frontend-assets/fonts/korean/JejuMyeongjo-Regular.eot')}}");
  src: url("{{asset('frontend-assets/fonts/korean/JejuMyeongjo-Regular (1).eot')}}") format('embedded-opentype'),
       url("{{asset('frontend-assets/fonts/korean/JejuMyeongjo-Regular.woff2')}}") format('woff2'),
       url("{{asset('frontend-assets/fonts/korean/JejuMyeongjo-Regular.woff')}}") format('woff'),
       url("{{asset('frontend-assets/fonts/korean/JejuMyeongjo-Regular.ttf')}}") format('truetype');
}
body{
   font-family: 'Jeju Myeongjo', serif;
}

</style>
</head>


<body>

 <section class="personal-info-section" id="personal-information">
                 
    <div class="row">
        <div class="col-md-3 personal-info-left">
            <div class="re-img-box">
                <img src="{{ $userImage }}" class="img-circle">
               
            </div>
            <h3 class="hidden-md hidden-lg" style="font-weight: 400">{{ $user->firstName.' '.$user->lastName }}</h3>
            <p><span class="pi-title">@lang('home.fathername'):</span> {{ $meta->fatherName }}</p>
            <p><span class="pi-title">@lang('home.email'):</span> {{ $user->email }}</p>
            <p><span class="pi-title">@lang('home.mobile'):</span> {{ $user->phoneNumber }}</p>
            <p><span class="pi-title">@lang('home.cnic'):</span> {{ $meta->cnicNumber }}</p>
            <p><span class="pi-title">@lang('home.address'):</span> {!! $meta->address.' ,'.JobCallMe::cityName($user->city).' ,'.JobCallMe::countryName($user->country) !!}</p>
        </div>
        <div class="col-md-9 personal-info-right">
           
           
            <p><span class="pi-title">@lang('home.age'):</span> {{ JobCallMe::timeInYear($meta->dateOfBirth) }}, <span class="pi-title">Gender:</span>{{ $meta->gender }},<span class="pi-title">Status:</span>{{ $meta->maritalStatus }}</p>
            <p><span class="pi-title">@lang('home.education'):</span> {{ $meta->education }}</p>
            <p><span class="pi-title">@lang('home.experience'):</span> {{ $meta->experiance }}</p>
            <p><span class="pi-title">@lang('home.industry'):</span> {{ JobCallMe::categoryTitle($meta->industry) }}</p>
            <p><span class="pi-title">@lang('home.salary'):</span> {{ number_format($meta->currentSalary != '' ? $meta->currentSalary : '0',2).' '.$meta->currency }}</p>
            <div class="professional-summary">
                <div>@lang('home.p_summary')</div>
                <p>{!! $user->about !!}</p>
                <p><span class="pi-title">@lang('home.furtherexpertise')</span></p>
                <ul style="margin-left: 50px;padding-left: 0;">
                    @if($meta->expertise != '')
                        @foreach(@explode(',',$meta->expertise) as $exper)
                            <li>{!! $exper !!}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="resume-box" id="academic">

<div>@lang('home.academic') </div>
<?php //print_r($resume); ?>
<ul class="resume-details">
    @if(count($resume['academic']) > 0)
        @foreach($resume['academic'] as $resumeId => $academic)
            <li id="resume-{{ $resumeId }}">
                <div class="col-md-12">
                   
                    <p class="rd-date">{!! date('M, Y',strtotime($academic->completionDate)) !!}</p>
                    <p class="rd-title">{!! $academic->degree !!}</p>
                    <p class="rd-organization">{!! $academic->institution !!}</p>
                    <p class="rd-location">{!! ucfirst($academic->country) !!}</p>
                    <p class="rd-grade">Grade/GPA : {!! $academic->grade !!}</p>
                </div>
            </li>
        @endforeach
    @endif
</ul>
</section>
<section class="resume-box" id="certification">

<div> @lang('home.certification')</div>
<ul class="resume-details">
    @if(count($resume['certification']) > 0)
        @foreach($resume['certification'] as $resumeId => $certification)
            <li id="resume-{{ $resumeId }}">
                <div class="col-md-12">
                    <span class="pull-right li-option">
                        <a href="javascript:;" title="Edit" onclick="getCertification('{{ $resumeId }}')">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                            <i class="fa fa-trash"></i>
                        </a>&nbsp;
                    </span>
                    <p class="rd-date">{!! date('M, Y',strtotime($certification->completionDate)) !!}</p>
                    <p class="rd-title">{!! $certification->certificate !!}</p>
                    <p class="rd-organization">{!! $certification->institution !!}</p>
                    <p class="rd-location">{!! ucfirst($certification->country) !!}</p>
                    <p class="rd-grade">Score : {!! $certification->score !!}</p>
                </div>
            </li>
        @endforeach
    @endif
</ul>
</section>
<section class="resume-box" id="experience">

<div>@lang('home.experiences')</div>
<ul class="resume-details">
    @if(count($resume['experience']) > 0)
        @foreach($resume['experience'] as $resumeId => $experience)
            <li id="resume-{{ $resumeId }}">
                <div class="col-md-12">
                    <span class="pull-right li-option">
                        <a href="javascript:;" title="Edit" onclick="getExperience('{{ $resumeId }}')">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                            <i class="fa fa-trash"></i>
                        </a>&nbsp;
                    </span>
                    <p class="rd-date">{!! date('M, Y',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($experience->endDate)) }}</p>
                    <p class="rd-title">{!! $experience->jobTitle !!}</p>
                    <p class="rd-organization">{!! $experience->organization !!}</p>
                    <p class="rd-location">{!! ucfirst($experience->country) !!}</p>
                </div>
            </li>
        @endforeach
    @endif
</ul>
</section>
<!--Skills Section Start-->
<section class="resume-box" id="skills">

<div> @lang('home.skills')</div>
<ul class="resume-details">
    @if(count($resume['skills']) > 0)
        @foreach($resume['skills'] as $resumeId => $skills)
            <li id="resume-{{ $resumeId }}">
                <div class="col-md-12">
                    <span class="pull-right li-option">
                        <a href="javascript:;" title="Edit" onclick="getSkills('{{ $resumeId }}')">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                            <i class="fa fa-trash"></i>
                        </a>&nbsp;
                    </span>
                    <p class="rd-title">{!! $skills->skill !!}</p>
                    <p class="rd-location">{!! $skills->level !!}</p>
                </div>
            </li>
        @endforeach
    @endif
</ul>
</section>
<!---Project -->
   <section class="resume-box" id="ski">
    <a class="btn btn-primary r-add-btn" onclick="addProject()"><i class="fa fa-plus"></i> </a>
    <div> @lang('home.project')</div>
    <ul class="resume-details">
        @if(count($resume['project']) > 0)
            @foreach($resume['project'] as $resumeId => $skills)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getProject('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
						<p class="rd-location"> {!! $skills->startmonth !!} {!! $skills->startyear !!} - {{ $skills->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($skills->endDate)) }}</p>
						<p class="rd-location"> As {!! $skills->position !!} - {!! $skills->occupation !!} at {!! $skills->organization !!}</p>
						
                       <p class="rd-location">{!! $skills->detail !!}</p>
					  
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>
<!---Affilation -->
   <section class="resume-box" id="aff">
    <a class="btn btn-primary r-add-btn" onclick="addAffi()"><i class="fa fa-plus"></i> </a>
    <div> @lang('home.Affiliation')</div>
    <ul class="resume-details">
        @if(count($resume['affiliation']) > 0)
            @foreach($resume['affiliation'] as $resumeId => $afflls)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getAffi('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $afflls->pos !!}</p>
						<p class="rd-location"> {!! $afflls->stamonth !!} {!! $afflls->stayear !!} - {!! $afflls->enmonth !!} {!! $afflls->enyear !!}</p>
						<p class="rd-location">{!! $afflls->org .', '.JobCallMe::cityName($afflls->city).' ,'.JobCallMe::countryName($afflls->country) !!}
						
					  
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>

 <section class="resume-box" id="sk">
    <a class="btn btn-primary r-add-btn" onclick="addLanguage()"><i class="fa fa-plus"></i> </a>
    <div><i class="fa fa-book r-icon bg-primary"></i> @lang('home.language')</div>
    <ul class="resume-details">
        @if(count($resume['language']) > 0)
            @foreach($resume['language'] as $resumeId => $skills)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getLanguage('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $skills->language !!}</p>
						<p class="rd-location"> ({!! $skills->level !!})</p>
						
					  
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>

  <section class="resume-box" id="skill">
    <a class="btn btn-primary r-add-btn" onclick="addSkill()"><i class="fa fa-plus"></i> </a>
    <div><i class="fa fa-book r-icon bg-primary"></i> @lang('home.references')</div>
    <ul class="resume-details">
        @if(count($resume['reference']) > 0)
            @foreach($resume['reference'] as $resumeId => $skills)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getSkill('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $skills->name !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
						<p class="rd-location"> Job Title: {!! $skills->jobtitle !!}</p>
						<p class="rd-location">Organization: {!! $skills->organization .', '.JobCallMe::cityName($skills->city).', '.JobCallMe::countryName($skills->country)  !!}</p>
                       <p class="rd-location">Phone Number : {!! $skills->phone !!}</p>
					   <p class="rd-location">Email : {!! $skills->email !!}</p>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>

	<!---Publication -->
   <section class="resume-box" id="skil">
    <a class="btn btn-primary r-add-btn" onclick="addSkil()"><i class="fa fa-plus"></i> </a>
    <div><i class="fa fa-book r-icon bg-primary"></i> @lang('home.publication')</div>
    <ul class="resume-details">
        @if(count($resume['publish']) > 0)
            @foreach($resume['publish'] as $resumeId => $skills)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getSkil('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->pu_type !!})</span></p>
						<p class="rd-location"> {!! $skills->month !!}-{!! $skills->year !!}</p>
						<p class="rd-location"> Author: {!! $skills->author !!}</p>
						<p class="rd-location">Publisher: {!! $skills->publisher.', '.JobCallMe::cityName($skills->city).' ,'.JobCallMe::countryName($skills->country)  !!}</p>
                       <p class="rd-location">{!! $skills->detail !!}</p>
					  
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>
 <section class="resume-box" id="s">
    <a class="btn btn-primary r-add-btn" onclick="addAward()"><i class="fa fa-plus"></i> </a>
    <div><i class="fa fa-book r-icon bg-primary"></i> @lang('home.award')</div>
    <ul class="resume-details">
        @if(count($resume['award']) > 0)
            @foreach($resume['award'] as $resumeId => $skills)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getAward('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $skills->title !!}</p>
						<p class="rd-location"> {!! $skills->type !!},{!! $skills->startmonth !!} {!! $skills->startyear !!}</p>
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
    <a class="btn btn-primary r-add-btn" onclick="addPortfolio()"><i class="fa fa-plus"></i> </a>
    <div><i class="fa fa-book r-icon bg-primary"></i> @lang('home.Portfolio')</div>
    <ul class="resume-details">
        @if(count($resume['portfolio']) > 0)
            @foreach($resume['portfolio'] as $resumeId => $skills)
                <li id="resume-{{ $resumeId }}">
                    <div class="col-md-12">
                        <span class="pull-right li-option">
                            <a href="javascript:;" title="Edit" onclick="getPortfolio('{{ $resumeId }}')">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                        </span>
                        <p class="rd-title">{!! $skills->title !!}<span class="rd-location">({!! $skills->type !!})</span></p>
						<p class="rd-location">{!! $skills->startmonth !!} {!! $skills->startyear !!}</p>
						<p class="rd-location">http://{!! $skills->website !!}</p>
						<p class="rd-location"> {!! $skills->occupation !!}</p>
						
                       <p class="rd-location">{!! $skills->detail !!}</p>
					  
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>

</body>
</html>