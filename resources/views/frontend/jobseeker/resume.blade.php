@extends('frontend.layouts.app')

@section('title','Job Seeker')

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
<section id="myResume" style="margin-bottom:70px">
	<div class="container">

	<div class="follow-companies5" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
					<h3 style="margin-left: 15px">@lang('home.resume')</h3>
				</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-9">
					<!--Personal Info Start-->
					<section class="personal-info-section" id="personal-information">
						<a class="btn btn-primary edit-btn" title="Edit Personal Information" onclick="$('#personal-information').hide();$('#personal-information-edit').fadeIn()">
							<i class="fa fa-edit"></i>
						</a>
						<div class="row">
							<div class="col-md-3 personal-info-left">
								<div class="re-img-box">
									<img src="{{ $userImage }}" class="img-target">
									<div class="re-img-toolkit">
										<div class="re-file-btn">
											@lang('home.change') <i class="fa fa-camera"></i>
											<input type="file" class="upload profile-pic" name="image" />
										</div>
										<span id="remove-re-image" style="margin-right: 42px;" onclick="removeResumePic('profile')">@lang('home.remove') <i class="fa fa-remove"></i></span>
										<p id="remove-re-image" style="margin-right: 71px;" onclick="editResumeProPic()">@lang('home.Edit') <i class="fa fa-edit"><input type="hidden" value="{{ session()->get('jcmUser')->userId }}" id="userID" ></i></p>
									</div>
								</div>
								<h3 class="hidden-md hidden-lg" style="font-weight: 600">{{ $user->firstName.' '.$user->lastName }}</h3>
								<p class="user-sns">
									<a href="{{ $meta->twitter }}"><i class="fa fa-twitter-square"></i></a>
									<a href="{{ $meta->linkedin }}"><i class="fa fa-linkedin-square"></i></a>
									<a href="{{ $meta->facebook }}"><i class="fa fa-facebook-square"></i></a>
								</p>
								<p><span class="pi-title">@lang('home.email'):</span>  {{ $user->email }}</p>
								<p><span class="pi-title">@lang('home.mobile'):</span>  {{ $user->phoneNumber }}</p>
								<p><span class="pi-title">@lang('home.cnic'):</span>  {{ $meta->cnicNumber }}</p>
								<p><span class="pi-title">@lang('home.address'):</span>  {!! $meta->address !!}} @lang('home.'.JobCallMe::cityName($user->city)) ,@lang('home.'.JobCallMe::countryName($user->country))</p>
							 </div>
							<div class="col-md-9 personal-info-right">
								<h3 class="hidden-sm hidden-xs">{{ $user->firstName.' '.$user->lastName }}</h3>
								<p><span class="pi-title">@lang('home.fathername'):</span>  {{ $meta->fatherName }}</p>
								<p><span class="pi-title">@lang('home.age'):</span>  {{ JobCallMe::timeInYear($meta->dateOfBirth) }}, <span class="pi-title"> @lang('home.gender'):</span> @if(app()->getLocale() == "kr") @if($meta->gender == 'Male') 남성 @else @lang('home.'.$meta->gender) @endif @else @lang('home.'.$meta->gender) @endif,<span class="pi-title"> @lang('home.maritalstatus'):</span> @lang('home.'.$meta->maritalStatus)</p>
								<p><span class="pi-title">@lang('home.education'):</span>  @lang('home.'.$meta->education)</p>
								<p><span class="pi-title">@lang('home.experiance'):</span>  @lang('home.'.$meta->experiance)</p>
								<p><span class="pi-title">@lang('home.industry'):</span> @lang('home.'.JobCallMe::categoryTitle($meta->industry))</p>
								<p><span class="pi-title">@lang('home.currentsalary'):</span> @if($meta->currency == 'KRW'){{ number_format($meta->currentSalary != '' ? $meta->currentSalary : '0',0).' '.$meta->currency }}@endif @if($meta->currency != 'KRW'){{ number_format($meta->currentSalary != '' ? $meta->currentSalary : '0',2).' '.$meta->currency }}@endif</p>
								<p><span class="pi-title">@lang('home.expectedsalary'):</span>  @if($meta->expectedSalary == "") @lang('home.'.$meta->expectedSalary2) @else @if($meta->currency == 'KRW'){{ number_format($meta->currentSalary != '' ? $meta->expectedSalary : '0',0).' '.$meta->currency }}@endif			 @if($meta->currency != 'KRW'){{ number_format($meta->currentSalary != '' ? $meta->expectedSalary : '0',2).' '.$meta->currency }}@endif @endif </p>
								<div class="professional-summary">
									<h4>@lang('home.p_summary')</h4>
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
					<section class="personal-info-section" id="personal-information-edit" style="display: none;">
						<h4><i class="fa fa-edit r-icon bg-primary"></i>@lang('home.editpersonalinfo')</h4>
						<form action="" method="post" class="form-horizontal form-personal-info">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="metaId" value="{{ $meta->metaId }}">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.name') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<div class="col-md-6 f-name" style="margin-bottom: 5px;padding-left: 0;">
										<input type="text" class="form-control input-sm" name="firstName" value="{{ $user->firstName }}" required>
									</div>
									<div class="col-md-6 l-name" style="margin-bottom: 5px;padding-right: 0;">
										<input type="text" class="form-control input-sm" name="lastName" value="{{ $user->lastName }}" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.fathername') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="fatherName" value="{{ $meta->fatherName }}" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.cnic') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" placeholder="@lang('home.cnicNumber')" name="cnicNumber" value="{{ $meta->cnicNumber }}" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.gender') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="gender">
										<option value="Male" {{ $meta->gender == 'Male' ? 'selected="selected"' : '' }}>@lang('home.male')</option>
										<option value="Female" {{ $meta->gender == 'Female' ? 'selected="selected"' : '' }}>@lang('home.female')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.maritalstatus') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="maritalStatus">
									@if(app()->getLocale() == "kr")
										<option value="Single" {{ $meta->maritalStatus == 'Single' ? 'selected="selected"' : '' }}>@lang('home.single')</option>
										<option value="Married" {{ $meta->maritalStatus == 'Married' ? 'selected="selected"' : '' }}>@lang('home.married')</option>
									@else
										<option value="Single" {{ $meta->maritalStatus == 'Single' ? 'selected="selected"' : '' }}>@lang('home.single')</option>
										<option value="Engaged" {{ $meta->maritalStatus == 'Engaged' ? 'selected="selected"' : '' }}>@lang('home.engaged')</option>
										<option value="Married" {{ $meta->maritalStatus == 'Married' ? 'selected="selected"' : '' }}>@lang('home.married')</option>
										<option value="Widowed" {{ $meta->maritalStatus == 'Widowed' ? 'selected="selected"' : '' }}>@lang('home.widowed')</option>
										<option value="Divorced" {{ $meta->maritalStatus == 'Divorced' ? 'selected="selected"' : '' }}>@lang('home.divorced')</option>
									@endif            
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.datebirth') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm date-pickers" name="dateOfBirth" value="{{ $meta->dateOfBirth }}" onkeypress="return false" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.email') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="email" value="{{ $user->email }}" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.phonenumber') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="phoneNumber" value="{{ $user->phoneNumber }}" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.address') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" name="address" class="form-control" id="Address" value="<?php if ( isset($meta->address) != "" ){ print $meta->address;}?>"  placeholder="주소, 우편 번호, 경계표, 면적 입력" required />
									<!-- <textarea class="form-control input-sm" name="address">{{ $meta->address }} </textarea> -->
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.address2') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="address2" value="{{ $meta->address2 }}"  placeholder="@lang('home.address2')">
								</div>
							</div>
						   <div class="form-group">
							<label class="control-label col-sm-3 text-right">@lang('home.country') <span style="color:red">*</span></label>
							<div class="col-md-6">
							
								<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ $user->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 text-right">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control select2 job-state" name="state" data-state="{{ $user->state }}" required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 text-right">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control select2 job-city" name="city" data-city="{{ $user->city }}" required>
								</select>
							</div>
						</div>
						<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.experiences') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control select2" name="experiance">
										@foreach(JobCallMe::getExperienceLevel() as $el)
											@if($el == "No Need Career")
												
											@else
												<option value="{{ $el }}" {{ $meta->experiance == $el ? 'selected="selected"' : '' }}>@lang('home.'.$el)</option>
											
											@endif
										@endforeach
									</select>

							  <!--    <select class="form-control input-sm select2" name="experiance">
										@foreach(JobCallMe::getExperienceLevel() as $el)
											<option value="{{ $el }}" {{ $meta->experiance == $el ? 'selected="selected"' : '' }}>@lang('home.'.$el)</option>
										@endforeach
									</select> -->
							   </div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.education') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control" name="education">                                    
										<option value="">@lang('home.degreeLevel-text')</option>
										<option value="highschool" {{ $meta->education == 'highschool' ? 'selected="selected"' : '' }}>@lang('home.highschool')</option>
										<option value="college" {{ $meta->education == 'college' ? 'selected="selected"' : '' }}>@lang('home.college')</option>
										<option value="university" {{ $meta->education == 'university' ? 'selected="selected"' : '' }}>@lang('home.university')</option>
										<option value="graduateschool" {{ $meta->education == 'graduateschool' ? 'selected="selected"' : '' }}>@lang('home.graduateschool')</option>
										<option value="Doctorate(phd)" {{ $meta->education == 'Doctorate(phd)' ? 'selected="selected"' : '' }}>@lang('home.Doctorate(phd)')</option>
										<option value="Vocational" {{ $meta->education == 'Vocational' ? 'selected="selected"' : '' }}>@lang('home.Vocational')</option>
										<option value="Associate Degree" {{ $meta->education == 'Associate Degree' ? 'selected="selected"' : '' }}>@lang('home.Associate Degree')</option>
										<option value="Certification" {{ $meta->education == 'Certification' ? 'selected="selected"' : '' }}>@lang('home.Certification')</option>
									
									</select>

								  <!--   <input type="text" class="form-control input-sm" name="education" value="{{ $meta->education }}"> -->
								</div>
							</div> 
							<!-- <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.experiancelevel') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="experiance">
										@foreach(JobCallMe::getExperienceLevel() as $el)
											<option value="{{ $el }}" {{ $meta->experiance == $el ? 'selected="selected"' : '' }}>{{ $el }}</option>
										@endforeach
									</select>
								</div>
							</div>-->
							<!-- <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.education') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="education" value="{{ $meta->education }}">
								</div>
							</div> -->
							   <div class="form-group">
							<label class="control-label col-md-3 text-right">@lang('home.s_category') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control select2 job-category" name="industry" onchange="getSubCategories(this.value)">
									@foreach(JobCallMe::getCategories() as $cat)
									@if($cat->categoryId < 17)
									 
										<option value="{!! $cat->categoryId !!}" {{ $meta->industry == $cat->categoryId ? 'selected="selected"' : '' }}>@lang('home.'.$cat->name)</option>
									   
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">@lang('home.Subcategory') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control select2 job-sub-category" name="subCategoryId" onchange="getSubCategories2(this.value)">
							   
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">@lang('home.Subcategory2') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control select2 job-sub-category2" name="subCategoryId2">
									
								</select>
							</div>
						</div>
						  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.hopejobtype') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control select2" name="shift" required>
									<option value="">@lang('home.hopejobtype')</option>
										@foreach(JobCallMe::getJobType() as $shift)
											<option value="{!! $shift->name !!}" {{ $meta->shift == $shift->name ? 'selected="selected"' : '' }}>@lang('home.'.$shift->name)</option>
										@endforeach
									</select>

							  <!--    <select class="form-control input-sm select2" name="experiance">
										@foreach(JobCallMe::getExperienceLevel() as $el)
											<option value="{{ $el }}" {{ $meta->experiance == $el ? 'selected="selected"' : '' }}>@lang('home.'.$el)</option>
										@endforeach
									</select> -->
							   </div>
							</div>
						   
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.currentsalary') </label>
								<div class="col-md-6">
									<input type="number" class="form-control input-sm" name="currentSalary" value="{{ $meta->currentSalary }}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.expectedsalary') </label>
								<div class="col-md-6">
									<input type="number" class="form-control input-sm" name="expectedSalary" value="{{ $meta->expectedSalary }}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right"></label>      
								
								<div class="col-md-4">
										<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="expectedSalary2" value="expectedSalary-check" @if($meta->expectedSalary2 == "expectedSalary-check") checked @else @endif>@lang('home.expectedSalary-check')&nbsp;&nbsp;&nbsp;

										<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="expectedSalary2" value="Decision after interview" @if($meta->expectedSalary2 == "Decision after interview") checked @else @endif >@lang('home.Decision after interview')									

										
								</div>
								
								<!-- 
								<div class="col-md-2">
										<input id="expectedSalary" type="checkbox" class="cbx-field" name="expectedSalary" value="yes">
										<label class="cbx" for="expectedSalary"></label>
										<label class="lbl" for="expectedSalary">@lang('home.expectedSalary-check')</label>

										
								</div>
								<div class="col-md-2">									

										<input id="expectedSalary2" type="checkbox" class="cbx-field" name="expectedSalary2" value="yes">
										<label class="cbx" for="expectedSalary2"></label>
										<label class="lbl" for="expectedSalary2">@lang('home.Decision after interview')</label>
								</div>
								-->
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.currency') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="currency">
										@foreach(JobCallMe::siteCurrency() as $currency)
											<option value="{{ $currency }}" {{ $meta->currency == $currency ? 'selected="selected"' : '' }}>{{ $currency }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.expertise') </label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="expertise" value="{{ $meta->expertise }}">
									<p class="help-block">@lang('home.commaexpertise')</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.p_summary') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<textarea class="form-control input-sm tex-editor" name="about">{{ $user->about }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">Facebook</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="facebook" value="{{ $meta->facebook }}">
									<p class="help-block">https://facebook.com/user</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">Linkedin</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="linkedin" value="{{ $meta->linkedin }}">
									<p class="help-block">https://linkedin.com/user</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">Twitter</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="twitter" value="{{ $meta->twitter }}">
									<p class="help-block">https://twitter.com/user</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">Website/Blog</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="website" value="{{ $meta->website }}">
									<p class="help-block">https://example.com</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>

									<button type="submit" class="btn btn-default" name="draft" onclick="saveOption('d')">@lang('home.draft')</button>
									<button class="btn btn-default" type="button" onclick="cancelProfile()">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Personal Info End-->

					<!--Academic Section Start-->
					<section class="resume-box" id="academic">
						<a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.academic')</h4>
						<?php //print_r($resume); ?>
						<ul class="resume-details">
							@if(count($resume['academic']) > 0)
								@foreach($resume['academic'] as $resumeId => $academic)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getAcademic('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-date">@if(app()->getLocale() == "kr")
							{!! date('Y-m',strtotime($academic->enterDate)) !!},  {!!  date('Y-m',strtotime($academic->completionDate)) !!} 
						@else
							{!! date('M, Y',strtotime($academic->enterDate)) !!},  {!!  date('M, Y',strtotime($academic->completionDate)) !!}
						@endif</p>
											<p class="rd-title">{!! $academic->degree !!}</p>
											<p class="rd-organization">{!! $academic->institution !!}</p>
											<p class="rd-location">@lang('home.'.JobCallMe::cityName($academic->city)),@lang('home.'.JobCallMe::countryName($academic->country))</p>
											<p class="rd-grade">@lang('home.GradeGPA') : {!! $academic->grade !!}</p>
											<a href="{{ url('/resume_images/'.$academic->academicfile)}}" target="_blank">{!! $academic->academicfile !!}</a>
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="academic-edit" style="display: none;">
						<h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.addacademic')</c></h4>
						<form class="form-horizontal form-academic" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.degreelevel') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="degreeLevel">
									   
										<option value="">@lang('home.degreeLevel-text')</option>
										<option value="highschool" {{ $meta->education == 'highschool' ? 'selected="selected"' : '' }}>@lang('home.highschool')</option>
										<option value="college" {{ $meta->education == 'college' ? 'selected="selected"' : '' }}>@lang('home.college')</option>
										<option value="university" {{ $meta->education == 'university' ? 'selected="selected"' : '' }}>@lang('home.university')</option>
										<option value="graduateschool" {{ $meta->education == 'graduateschool' ? 'selected="selected"' : '' }}>@lang('home.graduateschool')</option>
										<option value="Doctorate(phd)" {{ $meta->education == 'Doctorate(phd)' ? 'selected="selected"' : '' }}>@lang('home.Doctorate(phd)')</option>
										<option value="Vocational" {{ $meta->education == 'Vocational' ? 'selected="selected"' : '' }}>@lang('home.Vocational')</option>
										<option value="Associate Degree" {{ $meta->education == 'Associate Degree' ? 'selected="selected"' : '' }}>@lang('home.Associate Degree')</option>
										<option value="Certification" {{ $meta->education == 'Certification' ? 'selected="selected"' : '' }}>@lang('home.Certification')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.graduationstatus') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm" name="graduationstatus">
										<option value="graduation">@lang('home.graduation')</option>
										<option value="completion">@lang('home.completion')</option>
										<option value="expectedtograduate">@lang('home.expectedtograduate')</option>
										<option value="leaveofabsence">@lang('home.leaveofabsence')</option>
										<option value="dropoutofschool">@lang('home.dropoutofschool')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.transferstatus') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm" name="transferstatus">
										<option value="Yes">@lang('home.Yes')</option>
										<option value="No">@lang('home.No')</option>                                        
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.degree') </label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="degree">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.minor')</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="minor">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Entrance date') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="date" class="form-control input-sm date-picker" name="enterDate" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.completiondate') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="date" class="form-control input-sm date-picker" name="completionDate" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.GradeGPA')</label>
								<div class="col-md-6">
									<div class="col-md-6">
										<input type="text" class="form-control input-sm" name="grade">
									</div>
									<div class="col-md-6">
									<select class="form-control input-sm" name="grade2">
										<option value="">@lang('home.grade2')</option> 
										<option value="4.5">4.5</option>
										<option value="4.3">4.3</option>
										<option value="4.0">4.0</option>
										<option value="100">100</option>                                        
									</select>
									</div>
								</div>
								
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.institution') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="institution" required>
								</div>
							</div>
						   <div class="form-group">
							<label class="control-label col-sm-3">@lang('home.country') <span style="color:red">*</span></label>
							<div class="col-sm-6 ">
								<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-state" name="state">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-city" name="city">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">@lang('home.acadetails') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<textarea class="form-control input-sm tex-editor" name="details"></textarea>
								<div>@lang('home.details_text')</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">@lang('home.academic_file') </label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="academicfile">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
							<div class="col-md-6" id="academic-file">
							   <a href="" target="_blank"></a>
							   <input type="hidden" name="old_academicfile" value="">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 text-right">&nbsp;</label>
							<div class="col-md-6">
								<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
								<button class="btn btn-default" type="button" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">@lang('home.cancel')</button>
							</div>
						</div>
						</form>
					</section>
					<!--Academic Section End-->

					<!--Certification Section Start-->
					<section class="resume-box" id="certification">
						<a class="btn btn-primary r-add-btn" onclick="addCertification()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-certificate r-icon bg-primary"></i>  @lang('home.certification')</h4>
						<ul class="resume-details">
							@if(count($resume['certification']) > 0)
								@foreach($resume['certification'] as $resumeId => $certification)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getCertification('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-date">@if(app()->getLocale() == "kr")
							{!! date('Y-m',strtotime($certification->completionDate)) !!}
						@else
							{!! date('M, Y',strtotime($certification->completionDate)) !!}
						@endif</p>
											<p class="rd-title">{!! $certification->certificate !!}</p>
											<p class="rd-organization">{!! $certification->institution !!}</p>
											<p class="rd-location">@lang('home.'.JobCallMe::cityName($certification->city)),@lang('home.'.JobCallMe::countryName($certification->country))</p>
											<p class="rd-grade">@lang('home.cerscore') : {!! $certification->score !!}</p>
											 <a href="{{ url('/resume_images/'.$certification->certificatefile)}}" target="_blank">{!! $certification->certificatefile !!}</a>
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="certification-edit" style="display: none;">
						<h4><i class="fa fa-certificate r-icon bg-primary"></i>  <c>@lang('home.addcertification')</c></h4>
						<form class="form-horizontal form-certification" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.certificationtitle') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="certificate" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.cercompletiondate') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm date-picker" name="completionDate" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.cerscore') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="score" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.cerinstitution') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="institution" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.country') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
								</div>
							</div>
							   <div class="form-group">
							<label class="control-label col-sm-3">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-state" name="state">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-city" name="city">
								</select>
							</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.details') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<textarea class="form-control input-sm tex-editor" name="details"></textarea>
									<div>@lang('home.certification_text')</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.certification_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="certificatefile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="certificate-file">
									<a href="" target="_blank"></a>
									<input type="hidden" name="old_certificatefile" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#certification').fadeIn();$('#certification-edit').hide();$('html, body').animate({scrollTop:$('#certification').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Certification Section End-->

					<!--Experience Section Start-->
					<section class="resume-box" id="experience">
						<a class="btn btn-primary r-add-btn" onclick="addExperience()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-briefcase r-icon bg-primary"></i>  @lang('home.experiences')</h4>
						<ul class="resume-details">
							@if(count($resume['experience']) > 0)
								@foreach($resume['experience'] as $resumeId => $experience)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getExperience('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-date">@if(app()->getLocale() == "kr")
							{!! date('Y-m',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('Y-m',strtotime($experience->endDate)) }}
						@else
							{!! date('M, Y',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($experience->endDate)) }}
						@endif</p>
											<p class="rd-title">{!! $experience->jobTitle !!}</p>
											<p class="rd-organization">{!! $experience->organization !!}</p>
											<p class="rd-location">@lang('home.'.JobCallMe::cityName($experience->city)),@lang('home.'.JobCallMe::countryName($experience->country))</p>
											 <a href="{{ url('/resume_images/'.$experience->experiencefile)}}" target="_blank">{!! $experience->experiencefile !!}</a>
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="experience-edit" style="display: none;">
						<h4><i class="fa fa-briefcase r-icon bg-primary"></i>  <c>@lang('home.addexperience')</c></h4>
						<form class="form-horizontal form-experience" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.exptitle') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="jobTitle" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.exporganization') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="organization" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.expsdate') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm date-picker" name="startDate" required>
								</div>
							</div>
							<div class="form-group" id="enddate">
								<label class="control-label col-md-3 text-right">@lang('home.expedate') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm date-picker" name="endDate" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.expleaving') </label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="reasonleaving">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<div class="cntr">
										<input id="Currently" type="checkbox" class="cbx-field" name="currently" value="yes">
										<label class="cbx" for="Currently"></label>
										<label class="lbl" for="Currently">@lang('home.currentlyworking') <span style="color:red">*</span></label>
									</div>
								</div>
							</div>

							<div class="form-group" id="enddate">
								<label class="control-label col-md-3 text-right">@lang('home.expptitle')</label>
								<div class="col-md-6">
									<select class="form-control" name="expptitle">  									
										<option value="exp Employee" {{ $meta->expptitle == 'exp Employee' ? 'selected="selected"' : '' }}>@lang('home.exp Employee')</option>  
										
										<option value="exp Chief/Senior Staff" {{ $meta->expptitle == 'exp Chief/Senior Staff' ? 'selected="selected"' : '' }}>@lang('home.exp Chief/Senior Staff')</option>

										<option value="exp Assistant Manager" {{ $meta->expptitle == 'exp Assistant Manager' ? 'selected="selected"' : '' }}>@lang('home.exp Assistant Manager')</option>

										<option value="exp Manager" {{ $meta->expptitle == 'exp Manager' ? 'selected="selected"' : '' }}>@lang('home.exp Manager')</option>

										<option value="exp Deputy General Manger" {{ $meta->expptitle == 'exp Deputy General Manger)' ? 'selected="selected"' : '' }}>@lang('home.exp Deputy General Manger')</option>

										<option value="exp General Manger" {{ $meta->expptitle == 'exp General Manger' ? 'selected="selected"' : '' }}>@lang('home.exp General Manger')</option>

										<option value="exp Board of Director" {{ $meta->expptitle == 'exp Board of Director' ? 'selected="selected"' : '' }}>@lang('home.exp Board of Director')</option>

										<option value="exp Researcher" {{ $meta->expptitle == 'exp Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Researcher')</option>

										<option value="exp Chief Researcher" {{ $meta->expptitle == 'exp Chief Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Chief Researcher')</option>

										<option value="exp Senior Researcher" {{ $meta->expptitle == 'exp Senior Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Senior Researcher')</option>

										<option value="exp Head Researcher" {{ $meta->expptitle == 'exp Head Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Head Researcher')</option>

										<option value="exp Principal Researcher" {{ $meta->expptitle == 'exp Principal Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Principal Researcher')</option>

										<option value="exp Director of Research" {{ $meta->expptitle == 'exp Director of Research' ? 'selected="selected"' : '' }}>@lang('home.exp Director of Research')</option>
									
									</select>
								</div>
							</div>							
							<div class="form-group" id="enddate">
								<label class="control-label col-md-3 text-right">@lang('home.expposition')</label>
								<div class="col-md-6">
									<select class="form-control" name="expposition">  									
										<option value="expp Team members" {{ $meta->expposition == 'expp Team members' ? 'selected="selected"' : '' }}>@lang('home.expp Team members')</option>  
										
										<option value="expp Team Leader" {{ $meta->expposition == 'expp Team Leader' ? 'selected="selected"' : '' }}>@lang('home.expp Team Leader')</option>

										<option value="expp Manager" {{ $meta->expposition == 'expp Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Manager')</option>

										<option value="expp Part Manager" {{ $meta->expposition == 'expp Part Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Part Manager')</option>

										<option value="expp General Manger" {{ $meta->expposition == 'expp General Manger)' ? 'selected="selected"' : '' }}>@lang('home.expp General Manger')</option>

										<option value="expp Branch Manager" {{ $meta->expposition == 'expp Branch Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Branch Manager')</option>

										<option value="expp Branch office President" {{ $meta->expposition == 'expp Branch office President' ? 'selected="selected"' : '' }}>@lang('home.expp Branch office President')</option>

										<option value="expp Director" {{ $meta->expposition == 'expp Director' ? 'selected="selected"' : '' }}>@lang('home.expp Director')</option>

										<option value="expp Director of a bureau" {{ $meta->expposition == 'expp Director of a bureau' ? 'selected="selected"' : '' }}>@lang('home.expp Director of a bureau')</option>

										<option value="expp Head Director" {{ $meta->expposition == 'expp Head Director' ? 'selected="selected"' : '' }}>@lang('home.expp Head Director')</option>

										<option value="expp Center Chief" {{ $meta->expposition == 'expp Center Chief' ? 'selected="selected"' : '' }}>@lang('home.expp Center Chief')</option>

										<option value="expp Production Director" {{ $meta->expposition == 'expp Production Director' ? 'selected="selected"' : '' }}>@lang('home.expp Production Director')</option>

										<option value="expp Group Head" {{ $meta->expposition == 'expp Group Head' ? 'selected="selected"' : '' }}>@lang('home.expp Group Head')</option>
									
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Responsibilities')</label>
								<div class="col-md-6">
									<textarea class="form-control input-sm" name="responsibilities"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.country') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
								</div>
							</div>
							   <div class="form-group">
							<label class="control-label col-sm-3">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-state" name="state">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-city" name="city">
								</select>
							</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.details') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<textarea class="form-control input-sm tex-editor" name="details"></textarea>
									<div>@lang('home.experiencedtails_text')</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.upload') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="experiencefile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="experience-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_experiencefile" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#experience').fadeIn();$('#experience-edit').hide();$('html, body').animate({scrollTop:$('#experience').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Experience Section End-->

					<!--Skills Section Start-->
					<section class="resume-box" id="skills">
						<a class="btn btn-primary r-add-btn" onclick="addSkills()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-graduation-cap r-icon bg-primary"></i> @lang('home.skills')</h4>
						<ul class="resume-details">
							@if(count($resume['skills']) > 0)
								@foreach($resume['skills'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getSkills('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">{!! $skills->skill !!}</p>
											<p class="rd-location">@lang('home.'.$skills->level)</p>
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="skills-edit" style="display: none;">
						<h4><i class="fa fa-graduation-cap r-icon bg-primary"></i>  <c>@lang('home.addexperience')</c></h4>
						<form class="form-horizontal form-skills" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.skill') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="skill" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.skilllevel') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="level">
										<option value="Beginner">@lang('home.Beginner')</option>
										<option value="Intermediate">@lang('home.Intermediate')</option>
										<option value="Expert">@lang('home.Expert')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#skills').fadeIn();$('#skills-edit').hide();$('html, body').animate({scrollTop:$('#skills').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!---Project -->
					   <section class="resume-box" id="ski">
						<a class="btn btn-primary r-add-btn" onclick="addProject()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-tasks r-icon bg-primary"></i> @lang('home.project')</h4>
						<ul class="resume-details">
							@if(count($resume['project']) > 0)
								@foreach($resume['project'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getProject('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
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
												@endif<!-- As {!! $skills->position !!} - {!! $skills->occupation !!} at {!! $skills->organization !!} --></p>
																	
										   <p class="rd-location">{!! $skills->detail !!}</p>
											<a href="{{ url('/resume_images/'.$skills->projectfile)}}" target="_blank">{!! $skills->projectfile !!}</a>
										  
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="ski-edit" style="display: none;">
						<h4><i class="fa fa-tasks r-icon bg-primary"></i>  <c>@lang('home.project')</c></h4>
						<form class="form-horizontal form-ski" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.title') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="title" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.projectposition') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="position" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.type') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="type">
										<option value="@lang('home.academic')">@lang('home.projectacademic')</option>
										<option value="@lang('home.academicsearch')">@lang('home.projectacademicacademicsearch')</option>
										<option value="@lang('home.professional')">@lang('home.projectacademicprofessional')</option>
										<option value="@lang('home.professionalsearch')">@lang('home.projectacademicprofessionalsearch')</option>
										
									</select>
								</div>
							</div>
							 
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.occupation') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="occupation" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.projectorganization') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="organization" required>
								</div>
							</div>
							  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.startyear') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="syear" name="startyear" required>
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.startmonth') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="smonth" name="startmonth" required>
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<div class="cntr">
										<input id="currently" type="checkbox" class="cbx-field" name="currently" value="yes">
										<label class="cbx" for="currently"></label>
										<label class="lbl" for="currently">@lang('home.currentlyworking')</label>
									</div>
								</div>
							</div>
								<div class="form-group" id="projectendyear">
								<label class="control-label col-md-3 text-right">@lang('home.endyear')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="eyear" name="endyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group" id="projectendmonth">
								<label class="control-label col-md-3 text-right">@lang('home.endmonth')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="emonth" name="endmonth">
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3 text-right">@lang('home.details') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<textarea name="detail" class="form-control tex-editor" ></textarea>
									<div>@lang('home.projectdetails_text')</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.project_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="projectfile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="project-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_projectfile" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#ski').fadeIn();$('#ski-edit').hide();$('html, body').animate({scrollTop:$('#ski').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Project Section End-->
					
					<!---Affilation -->
					   <section class="resume-box" id="aff">
						<a class="btn btn-primary r-add-btn" onclick="addAffi()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-houzz r-icon bg-primary"></i> @lang('home.Affiliation')</h4>
						<ul class="resume-details">
							@if(count($resume['affiliation']) > 0)
								@foreach($resume['affiliation'] as $resumeId => $afflls)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getAffi('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">{!! $afflls->pos !!}</p>
											<p class="rd-location"> @if(app()->getLocale() == "kr")
							{!! $afflls->stayear !!}년 @lang('home.'.$afflls->stamonth) - {!! $afflls->enyear !!} @lang('home.'.$afflls->enmonth)
						@else
							{!! $afflls->stamonth !!} {!! $afflls->stayear !!} - {!! $afflls->enmonth !!} {!! $afflls->enyear !!}
						@endif </p>
											<p class="rd-location">{!! $afflls->org !!} , @lang('home.'.JobCallMe::cityName($afflls->city)),@lang('home.'.JobCallMe::countryName($afflls->country))</p>
											  <a href="{{ url('/resume_images/'.$afflls->affiliationfile)}}" target="_blank">{!! $afflls->affiliationfile !!}</a>
										  
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="aff-edit" style="display: none;">
						<h4><i class="fa fa-houzz r-icon bg-primary"></i>  <c>@lang('home.Affiliation')</c></h4>
						<form class="form-horizontal form-aff" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							 
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.organization_resume') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="org" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.affiposition') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="pos" required>
								</div>
							</div>
							
							
							  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.startyear') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="ssyear" name="stayear" required>
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.startmonth') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="startmonth" name="stamonth" required>
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									   
										
									</select>
								</div>
							</div>
								<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.endyear') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="esyear" name="enyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.endmonth') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="endmonth" name="enmonth">
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<div class="cntr">
										<input id="affcurrently" type="checkbox" class="cbx-field" name="currently" value="yes">
										<label class="cbx" for="affcurrently"></label>
										<label class="lbl" for="affcurrently">@lang('home.currentlyworking')</label>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.country') <span style="color:red">*</span></label>
							<div class="col-sm-6 ">
								<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-state" name="state">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-city" name="city">
								</select>
							</div>
						</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.upload') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="affiliationfile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="affiliation-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_affiliationfile" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#aff').fadeIn();$('#aff-edit').hide();$('html, body').animate({scrollTop:$('#aff').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Affilation Section End-->


					<!--Preference Section Start-->
					<section class="resume-box" id="preference">
						<a class="btn btn-primary r-add-btn" onclick="addPreference()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-graduation-cap r-icon bg-primary"></i> @lang('home.preference')</h4>
						<ul class="resume-details">
							@if(count($resume['preference']) > 0)
								@foreach($resume['preference'] as $resumeId => $preference)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="Edit" onclick="getPreference('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">@lang('home.Veteran') : @lang('home.'.$preference->veteran)</p>
											<p class="rd-title">@lang('home.Job protection') : @lang('home.'.$preference->subsidy)</p>
											<p class="rd-title">@lang('home.Employment subsidy') : @lang('home.'.$preference->disability)</p>
											<p class="rd-title">@lang('home.Disability') : @lang('home.'.$preference->disability)</p>
											<p class="rd-title">@lang('home.Disability grade') : {!! $preference->disabilitygrade !!}</p>
											<p class="rd-title">@lang('home.Military service') : @lang('home.'.$preference->militaryservice)</p>
											<p class="rd-title">@lang('home.Militarystartyear') : {!! $preference->militarystartyear !!}</p>
											<p class="rd-title">@lang('home.Militarystartmonth') : @lang('home.'.$preference->militarystartmonth)</p>
											<p class="rd-title">@lang('home.Militaryendyear') : {!! $preference->militaryendyear !!}</p>
											<p class="rd-title">@lang('home.Militaryendmonth') : @lang('home.'.$preference->militaryendmonth)</p>
											<p class="rd-title">@lang('home.Military type') : @lang('home.'.$preference->militarytype)</p>
											<p class="rd-title">{!! $resumeId !!}</p>

											
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="preference-edit" style="display: none;">
						<h4><i class="fa fa-graduation-cap r-icon bg-primary"></i>  <c>@lang('home.addPreference')</c></h4>
						<form class="form-horizontal form-preference" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Veteran')</label>
								<div class="col-md-6">
									<select class="form-control" name="veteran">  		
										<option value="Veteran yes" {{ $meta->Veteran == 'Veteran yes' ? 'selected="selected"' : '' }}>@lang('home.Veteran yes')</option>

										<option value="Veteran no" {{ $meta->Veteran == 'Veteran no' ? 'selected="selected"' : '' }}>@lang('home.Veteran no')</option>
									</select>
										
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Job protection')</label>
								<div class="col-md-6">
									<select class="form-control" name="jobprotection">  		
										<option value="Job protection yes" {{ $meta->education == 'Job protection yes' ? 'selected="selected"' : '' }}>@lang('home.Job protection yes')</option>

										<option value="Job protection no" {{ $meta->education == 'Job protection no' ? 'selected="selected"' : '' }}>@lang('home.Job protection no')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Employment subsidy')</label>
								<div class="col-md-6">
									<select class="form-control" name="subsidy">  		
										<option value="subsidy yes" {{ $meta->subsidy == 'subsidy yes' ? 'selected="selected"' : '' }}>@lang('home.subsidy yes')</option>

										<option value="subsidy no" {{ $meta->subsidy == 'subsidy no' ? 'selected="selected"' : '' }}>@lang('home.subsidy no')</option>
									</select>
										
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Disability')</label>
								<div class="col-md-6">
									<select class="form-control" name="disability">  		
										<option value="disability yes" {{ $meta->Veteran == 'disability yes' ? 'selected="selected"' : '' }}>@lang('home.disability yes')</option>

										<option value="disability no" {{ $meta->Veteran == 'disability no' ? 'selected="selected"' : '' }}>@lang('home.disability no')</option>
									</select>
										
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Disability grade')</label>
								<div class="col-md-6">
									<select class="form-control" name="disabilitygrade">  		
										<option value="">@lang('home.disabilitygrade-text')</option>
										<option value="1" {{ $meta->disabilitygrade == '1' ? 'selected="selected"' : '' }}>1</option>
										<option value="2" {{ $meta->disabilitygrade == '2' ? 'selected="selected"' : '' }}>2</option>
										<option value="3" {{ $meta->disabilitygrade == '3' ? 'selected="selected"' : '' }}>3</option>
										<option value="4" {{ $meta->disabilitygrade == '4' ? 'selected="selected"' : '' }}>4</option>
										<option value="5" {{ $meta->disabilitygrade == '5' ? 'selected="selected"' : '' }}>5</option>
										<option value="6" {{ $meta->disabilitygrade == '6' ? 'selected="selected"' : '' }}>6</option>
									</select>
										
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Military service')</label>
								<div class="col-md-6">
									<select class="form-control" name="militaryservice">  		
										<option value="militaryservice yes" {{ $meta->militaryservice == 'militaryservice yes' ? 'selected="selected"' : '' }}>@lang('home.militaryservice yes')</option>
										<option value="militaryservice no" {{ $meta->militaryservice == 'militaryservice no' ? 'selected="selected"' : '' }}>@lang('home.militaryservice no')</option>
										<option value="militaryservice exemption" {{ $meta->militaryservice == 'militaryservice exemption' ? 'selected="selected"' : '' }}>@lang('home.militaryservice exemption')</option>
										<option value="militaryservice Not" {{ $meta->militaryservice == 'militaryservice Not' ? 'selected="selected"' : '' }}>@lang('home.militaryservice Not')</option>
									</select>
										
								</div>
							</div>
							<div class="form-group" id="projectendyear">
								<label class="control-label col-md-3 text-right">@lang('home.Militarystartyear')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="Militarysyear" name="militarystartyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group" id="projectendmonth">
								<label class="control-label col-md-3 text-right">@lang('home.Militarystartmonth')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="emonth" name="militarystartmonth">
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="projectendyear">
								<label class="control-label col-md-3 text-right">@lang('home.Militaryendyear')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="Militaryeyear" name="militaryendyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group" id="projectendmonth">
								<label class="control-label col-md-3 text-right">@lang('home.Militaryendmonth')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="emonth" name="militaryendmonth">
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Military type')</label>
								<div class="col-md-6">
									<select class="form-control" name="militarytype">  		
										<option value=''>@lang('home.militarytype-text')</option>
										<option value="Army" {{ $meta->militarytype == 'Army' ? 'selected="selected"' : '' }}>@lang('home.Army')</option>

										<option value="Navy" {{ $meta->militarytype == 'Navy' ? 'selected="selected"' : '' }}>@lang('home.Navy')</option>

										<option value="Air Force" {{ $meta->militarytype == 'Air Force' ? 'selected="selected"' : '' }}>@lang('home.Air Force')</option>

										<option value="Marine" {{ $meta->militarytype == 'Marine' ? 'selected="selected"' : '' }}>@lang('home.Marine')</option>

										<option value="Police" {{ $meta->militarytype == 'Police' ? 'selected="selected"' : '' }}>@lang('home.Police')</option>

										<option value="conscripted policeman" {{ $meta->militarytype == 'conscripted policeman' ? 'selected="selected"' : '' }}>@lang('home.conscripted policeman')</option>

										<option value="public service worker" {{ $meta->militarytype == 'public service worker' ? 'selected="selected"' : '' }}>@lang('home.public service worker')</option>

										<option value="Military etc" {{ $meta->militarytype == 'Military etc' ? 'selected="selected"' : '' }}>@lang('home.Military etc')</option>
									</select>
										
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Military Classes')</label>
								<div class="col-md-6">
									<select class="form-control" name="militaryclasses">  		
										<option value=''>@lang('home.militaryclasses-text')</option>
										<option value="Private" {{ $meta->militaryclasses == 'Private' ? 'selected="selected"' : '' }}>@lang('home.Private')</option>										

										<option value="Private First Class" {{ $meta->militaryclasses == 'Private First Class' ? 'selected="selected"' : '' }}>@lang('home.Private First Class')</option>

										<option value="Corporal" {{ $meta->militaryclasses == 'Corporal' ? 'selected="selected"' : '' }}>@lang('home.Corporal')</option>

										<option value="Sergeant" {{ $meta->militaryclasses == 'Sergeant' ? 'selected="selected"' : '' }}>@lang('home.Sergeant')</option>

										<option value="Staff Sergeant" {{ $meta->militaryclasses == 'Staff Sergeant' ? 'selected="selected"' : '' }}>@lang('home.Staff Sergeant')</option>

										<option value="Sergeant First Class" {{ $meta->militaryclasses == 'Sergeant First Class' ? 'selected="selected"' : '' }}>@lang('home.Sergeant First Class')</option>

										<option value="Master Sergeant" {{ $meta->militaryclasses == 'Master Sergeant' ? 'selected="selected"' : '' }}>@lang('home.Master Sergeant')</option>

										<option value="Sergeant Major" {{ $meta->militaryclasses == 'Sergeant Major' ? 'selected="selected"' : '' }}>@lang('home.Sergeant Major')</option>

										<option value="Warrant Officer" {{ $meta->militaryclasses == 'Warrant Officer' ? 'selected="selected"' : '' }}>@lang('home.Warrant Officer')</option>

										<option value="2nd Lieutenant" {{ $meta->militaryclasses == '2nd Lieutenant' ? 'selected="selected"' : '' }}>@lang('home.2nd Lieutenant')</option>

										<option value="1st Lieutenant" {{ $meta->militaryclasses == '1st Lieutenant' ? 'selected="selected"' : '' }}>@lang('home.1st Lieutenant')</option>

										<option value="Captain" {{ $meta->militaryclasses == 'Captain' ? 'selected="selected"' : '' }}>@lang('home.Captain')</option>

										<option value="Major" {{ $meta->militaryclasses == 'Major' ? 'selected="selected"' : '' }}>@lang('home.Major')</option>

										<option value="Lieutenant Colonel" {{ $meta->militaryclasses == 'Lieutenant Colonel' ? 'selected="selected"' : '' }}>@lang('home.Lieutenant Colonel')</option>

										<option value="Colonel" {{ $meta->militaryclasses == 'Colonel' ? 'selected="selected"' : '' }}>@lang('home.Colonel')</option>

										<option value="Brigadier General" {{ $meta->militaryclasses == 'Brigadier General' ? 'selected="selected"' : '' }}>@lang('home.Brigadier General')</option>

										<option value="Major General" {{ $meta->militaryclasses == 'Major General' ? 'selected="selected"' : '' }}>@lang('home.Major General')</option>

										<option value="Lieutenant General" {{ $meta->militaryclasses == 'Lieutenant General' ? 'selected="selected"' : '' }}>@lang('home.Lieutenant General')</option>

										<option value="General" {{ $meta->militaryclasses == 'General' ? 'selected="selected"' : '' }}>@lang('home.General')</option>

										<option value="General of the Army" {{ $meta->militaryclasses == 'General of the Army' ? 'selected="selected"' : '' }}>@lang('home.General of the Army')</option>
									</select>
										
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#preference').fadeIn();$('#preference-edit').hide();$('html, body').animate({scrollTop:$('#skills').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Preference Section End -->

					
					<!---Project -->
					   <section class="resume-box" id="sk">
						<a class="btn btn-primary r-add-btn" onclick="addLanguage()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-language r-icon bg-primary"></i> @lang('home.language')</h4>
						<ul class="resume-details">
							@if(count($resume['language']) > 0)
								@foreach($resume['language'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getLanguage('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
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
					<section class="resume-box" id="sk-edit" style="display: none;">
						<h4><i class="fa fa-language r-icon bg-primary"></i>  <c>@lang('home.language')</c></h4>
						<form class="form-horizontal form-sk" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.language') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="language">
										  <option value="Afrikanns">@lang('home.Afrikanns')</option>
										  <option value="Albanian">@lang('home.Albanian')</option>
										  <option value="Arabic">@lang('home.Arabic')</option>
										  <option value="Armenian">@lang('home.Armenian')</option>
										  <option value="Basque">@lang('home.Basque')</option>
										  <option value="Bengali">@lang('home.Bengali')</option>
										  <option value="Bulgarian">@lang('home.Bulgarian')</option>
										  <option value="Catalan">@lang('home.Catalan')</option>
										  <option value="Cambodian">@lang('home.Cambodian')</option>
										  <option value="Chinese (Mandarin)">@lang('home.Chinese (Mandarin)')</option>
										  <option value="Croation">@lang('home.Croation')</option>
										  <option value="Czech">@lang('home.Czech')</option>
										  <option value="Danish">@lang('home.Danish')</option>
										  <option value="Dutch">@lang('home.Dutch')</option>
										  <option value="English">@lang('home.English')</option>
										  <option value="Estonian">@lang('home.Estonian')</option>
										  <option value="Fiji">@lang('home.Fiji')</option>
										  <option value="Finnish">@lang('home.Finnish')</option>
										  <option value="French">@lang('home.French')</option>
										  <option value="Georgian">@lang('home.Georgian')</option>
										  <option value="German">@lang('home.German')</option>
										  <option value="Greek">@lang('home.Greek')</option>
										  <option value="Gujarati">@lang('home.Gujarati')</option>
										  <option value="Hebrew">@lang('home.Hebrew')</option>
										  <option value="Hindi">@lang('home.Hindi')</option>
										  <option value="Hungarian">@lang('home.Hungarian')</option>
										  <option value="Icelandic">@lang('home.Icelandic')</option>
										  <option value="Indonesian">@lang('home.Indonesian')</option>
										  <option value="Irish">@lang('home.Irish')</option>
										  <option value="Italian">@lang('home.Italian')</option>
										  <option value="Japanese">@lang('home.Japanese')</option>
										  <option value="Javanese">@lang('home.Javanese')</option>
										  <option value="Korean">@lang('home.Korean')</option>
										  <option value="Latin">@lang('home.Latin')</option>
										  <option value="Latvian">@lang('home.Latvian')</option>
										  <option value="Lithuanian">@lang('home.Lithuanian')</option>
										  <option value="Macedonian">@lang('home.Macedonian')</option>
										  <option value="Malay">@lang('home.Malay')</option>
										  <option value="Malayalam">@lang('home.Malayalam')</option>
										  <option value="Maltese">@lang('home.Maltese')</option>
										  <option value="Maori">@lang('home.Maori')</option>
										  <option value="Marathi">@lang('home.Marathi')</option>
										  <option value="Mongolian">@lang('home.Mongolian')</option>
										  <option value="Nepali">@lang('home.Nepali')</option>
										  <option value="Norwegian">@lang('home.Norwegian')</option>
										  <option value="Persian">@lang('home.Persian')</option>
										  <option value="Polish">@lang('home.Polish')</option>
										  <option value="Portuguese">@lang('home.Portuguese')</option>
										  <option value="Punjabi">@lang('home.Punjabi')</option>
										  <option value="Quechua">@lang('home.Quechua')</option>
										  <option value="Romanian">@lang('home.Romanian')</option>
										  <option value="Russian">@lang('home.Russian')</option>
										  <option value="Samoan">@lang('home.Samoan')</option>
										  <option value="Serbian">@lang('home.Serbian')</option>
										  <option value="Slovak">@lang('home.Slovak')</option>
										  <option value="Slovenian">@lang('home.Slovenian')</option>
										  <option value="Spanish">@lang('home.Spanish')</option>
										  <option value="Swahili">@lang('home.Swahili')</option>
										  <option value="Swedish">@lang('home.Swedish')</option>
										  <option value="Tamil">@lang('home.Tamil')</option>
										  <option value="Tatar">@lang('home.Tatar')</option>
										  <option value="Telugu">@lang('home.Telugu')</option>
										  <option value="Thai">@lang('home.Thai')</option>
										  <option value="Tibetan">@lang('home.Tibetan')</option>
										  <option value="Tonga">@lang('home.Tonga')</option>
										  <option value="Turkish">@lang('home.Turkish')</option>
										  <option value="Ukranian">@lang('home.Ukranian')</option>
										  <option value="Urdu">@lang('home.Urdu')</option>
										  <option value="Uzbek">@lang('home.Uzbek')</option>
										  <option value="Vietnamese">@lang('home.Vietnamese')</option>
										  <option value="Welsh">@lang('home.Welsh')</option>
										  <option value="Xhosa">@lang('home.Xhosa')</option>
										
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.proficiencylevel') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="level">
									<option value="Everyday conversation">@lang('home.Everyday conversation')</option>
										<option value="Business Conversation">@lang('home.Business Conversation')</option>
										<option value="Native Speaker">@lang('home.Native Speaker')</option>

										
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Certified Examination')</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="certifiedexam">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.classscore')</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="classscore">
								</div>
							</div>
							<div class="form-group" id="projectendyear">
								<label class="control-label col-md-3 text-right">@lang('home.languageyear')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="languageyear" name="languageyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group" id="projectendmonth">
								<label class="control-label col-md-3 text-right">@lang('home.languagemonth')</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="languagemonth" name="languagemonth">
										<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.language_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="languagefile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="language-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_languagefile" value="">
								</div>
							</div>
							 
							 
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#sk').fadeIn();$('#sk-edit').hide();$('html, body').animate({scrollTop:$('#sk').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
						   <section class="resume-box" id="skill">
						<a class="btn btn-primary r-add-btn" onclick="addSkill()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-users r-icon bg-primary"></i> @lang('home.references')</h4>
						<ul class="resume-details">
							@if(count($resume['reference']) > 0)
								@foreach($resume['reference'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getSkill('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">{!! $skills->name !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
											<p class="rd-location"> @lang('home.refjobtitle') : {!! $skills->jobtitle !!}</p>
											<p class="rd-location">@lang('home.reforganization') : {!! $skills->organization !!}, @lang('home.'.JobCallMe::cityName($skills->city)),@lang('home.'.JobCallMe::countryName($skills->country))</p>
										   <p class="rd-location">@lang('home.phone') : {!! $skills->phone !!}</p>
										   <p class="rd-location">@lang('home.email') : {!! $skills->email !!}</p>
										    <a href="{{ url('/resume_images/'.$afflls->referencesfile)}}" target="_blank">{!! $afflls->referencesfile !!}</a>
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="skill-edit" style="display: none;">
						<h4><i class="fa fa-users r-icon bg-primary"></i>  <c>@lang('home.addexperience')</c></h4>
						<form class="form-horizontal form-skill" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.name') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="name" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.refjobtitle') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="jobtitle" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.reforganization') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="organization" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.phone') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="number" class="form-control input-sm" name="phone" required>
								</div>
							</div>
							  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.email') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="email" class="form-control input-sm" name="email" required>
								</div>
							</div>
								<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.country') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
								</div>
							</div>
							   <div class="form-group">
							<label class="control-label col-sm-3">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-state" name="state">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-city" name="city">
								</select>
							</div>
							</div>
														<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.type') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="type">
										<option value="@lang('home.professional')">@lang('home.refProfessional')</option>
										<option value="@lang('home.Personal')">@lang('home.refPersonal')</option>
										<option value="@lang('home.Superior')">@lang('home.refSuperior')</option>
										<option value="@lang('home.Peer')">@lang('home.refPeer')</option>
										<option value="@lang('home.Subordinate')">@lang('home.refSubordinate')</option>
										<option value="@lang('home.Professor')">@lang('home.refProfessor')</option>
										<option value="@lang('home.Client')">@lang('home.refClient')</option>
										<option value="@lang('home.other')">@lang('home.refOther')</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.references_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="referencesfile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="references-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_referencesfile" value="">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#skill').fadeIn();$('#skill-edit').hide();$('html, body').animate({scrollTop:$('#skill').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!---Publication -->
					   <section class="resume-box" id="skil">
						<a class="btn btn-primary r-add-btn" onclick="addSkil()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-newspaper-o r-icon bg-primary"></i> @lang('home.publication')</h4>
						<ul class="resume-details">
							@if(count($resume['publish']) > 0)
								@foreach($resume['publish'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getSkil('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->pu_type !!})</span></p>
											<p class="rd-location"> {!! $skills->month !!}-{!! $skills->year !!}</p>
											<p class="rd-location"> @lang('home.Author') : {!! $skills->author !!}</p>
											<p class="rd-location">@lang('home.publisher') : {!! $skills->publisher !!}, @lang('home.'.JobCallMe::cityName($skills->city)),@lang('home.'.JobCallMe::countryName($skills->country))</p>
										   <p class="rd-location">{!! $skills->detail !!}</p>
										   <a href="{{ url('/resume_images/'.$skills->publicationfile)}}" target="_blank">{!! $skills->publicationfile !!}</a>
										  
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="skil-edit" style="display: none;">
						<h4><i class="fa fa-newspaper-o r-icon bg-primary"></i>  <c>@lang('home.publication')</c></h4>
						<form class="form-horizontal form-skil" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.pubtype') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="pu_type">
										<option value="book">@lang('home.book')</option>
										<option value="bookchapter">@lang('home.bookchapter')</option>
										<option value="Peer-reviewed">@lang('home.Peer-reviewed')</option>
										<option value="Non-peer-reviewed">@lang('home.Non-peer-reviewed')</option>
										<option value="Report">@lang('home.Report')</option>
										<option value="Patents">@lang('home.Patents')</option>
										<option value="home.Etc')">@lang('home.Etc')</option>
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.title') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="title" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.Author') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="author" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.publisher') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="publisher" required>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.country') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
									@endforeach
								</select>
								</div>
							</div>
							   <div class="form-group">
							<label class="control-label col-sm-3">@lang('home.state') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-state" name="state">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">@lang('home.city') <span style="color:red">*</span></label>
							<div class="col-sm-6">
								<select class="form-control select2 job-city" name="city">
								</select>
							</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.year') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="year">
								</div>
							</div>
							  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.month') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<!-- <input type="text" class="form-control input-sm" name="month" required> -->
									<select class="form-control input-sm select2" id="month" name="month">
										<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									</select>
								</div>
							</div>
							<div class="form-group">
							<label class="control-label col-sm-3 text-right">@lang('home.publishdtails') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<textarea name="detail" class="form-control tex-editor"></textarea>
								<div>@lang('home.publishdtails_text')</div>
							</div>
						</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.publish_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="publicationfile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="publication-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_publicationfile" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#skil').fadeIn();$('#skil-edit').hide();$('html, body').animate({scrollTop:$('#skil').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					
					 <section class="resume-box" id="s">
						<a class="btn btn-primary r-add-btn" onclick="addAward()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-trophy r-icon bg-primary"></i> @lang('home.award')</h4>
						<ul class="resume-details">
							@if(count($resume['award']) > 0)
								@foreach($resume['award'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getAward('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">{!! $skills->title !!}</p>
											<p class="rd-location"> {!! $skills->type !!},@if(app()->getLocale() == "kr")
													{!! $skills->startyear !!}년 @lang('home.'.$skills->startmonth)
												@else
													{!! $skills->startmonth !!} {!! $skills->startyear !!}
												@endif</p>
											<p class="rd-location"> <!-- {!! $skills->occupation !!} at --> {!! $skills->organization !!}</p>
											
										   <p class="rd-location">{!! $skills->detail !!}</p>
										    <a href="{{ url('/resume_images/'.$skills->awardfile)}}" target="_blank">{!! $skills->awardfile !!}</a>
										  
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="s-edit" style="display: none;">
						<h4><i class="fa fa-trophy r-icon bg-primary"></i>  <c>@lang('home.award')</c></h4>
						<form class="form-horizontal form-s" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.awardtitle') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="title" required>
								</div>
							</div>
							<!-- 
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.type') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="type">
										<option value="@lang('home.academic')">@lang('home.academic')</option>
										<option value="@lang('home.professional')">@lang('home.professional')</option>
										<option value="@lang('home.Extracurricular')">@lang('home.Extracurricular')</option>
										
									</select>
								</div>
							</div>
							 
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.occupation') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="occupation" required>
								</div>
							</div>
							-->
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.awardorganization') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="organization" required>
								</div>
							</div>
							  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.year') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="years" name="startyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.month') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="smonth" name="startmonth">
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option> 
									   
										
									</select>
								</div>
							</div>
							<div class="form-group">
							<label class="control-label col-sm-3 text-right">@lang('home.awarddetails') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<textarea name="detail" class="form-control tex-editor"></textarea>
								<div>@lang('home.awarddetails_text')</div>
							</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.award_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="awardfile">
								</div>
							 </div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="award-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_awardfile" value="">
								</div>
							 </div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#s').fadeIn();$('#s-edit').hide();$('html, body').animate({scrollTop:$('#s').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Project Section End-->
					
					<!--Portfolio Section-->
					<section class="resume-box" id="port">
						<a class="btn btn-primary r-add-btn" onclick="addPortfolio()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.Portfolio')</h4>
						<ul class="resume-details">
							@if(count($resume['portfolio']) > 0)
								@foreach($resume['portfolio'] as $resumeId => $skills)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="@lang('home.Edit')" onclick="getPortfolio('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="@lang('home.Delete')" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">{!! $skills->title !!}<span class="rd-location">({!! $skills->type !!})</span></p>
											<p class="rd-location">@if(app()->getLocale() == "kr")
							{!! $skills->startyear !!}년 @lang('home.'.$skills->startmonth)
						@else
							{!! $skills->startmonth !!} {!! $skills->startyear !!}
						@endif </p>
											<p class="rd-location">http://{!! $skills->website !!}</p>
											<p class="rd-location"> {!! $skills->occupation !!}</p>
											
										   <p class="rd-location">{!! $skills->detail !!}</p>
										   <a href="{{ url('/resume_images/'.$skills->portfoliofile)}}" target="_blank">{!! $skills->portfoliofile !!}</a>
										  
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="port-edit" style="display: none;">
						<h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.Portfolio')</c></h4>
						<form class="form-horizontal form-port" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.title') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="title" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.type') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" name="type">
										<option value="Academic">@lang('home.portacademic')</option>
										<option value="Professional">@lang('home.portprofessional')</option>
										<option value="Extracurricular">@lang('home.portExtracurricular')</option>
										
									</select>
								</div>
							</div>
							 
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.occupation') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="occupation" required>
								</div>
							</div>
							 
							  <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.year') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="yearss" name="startyear">
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.month') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2" id="smonth" name="startmonth">
									<option value=''>@lang('home.Select Month')</option>
										<option value='Jan'>@lang('home.Jan')</option>
										<option value='Feb'>@lang('home.Feb')</option>
										<option value='Mar'>@lang('home.Mar')</option>
										<option value='Apr'>@lang('home.Apr')</option>
										<option value='May'>@lang('home.May')</option>
										<option value='Jun'>@lang('home.Jun')</option>
										<option value='Jul'>@lang('home.Jul')</option>
										<option value='Aug'>@lang('home.Aug')</option>
										<option value='Sep'>@lang('home.Sep')</option>
										<option value='Oct'>@lang('home.Oct')</option>
										<option value='Nov'>@lang('home.Nov')</option>
										<option value='Dec'>@lang('home.Dec')</option>
									   
										
									</select>
								</div>
							</div>
							 <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.website') <span style="color:red">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="website" required>
								</div>
							</div>
							<div class="form-group">
							<label class="control-label col-sm-3 text-right">@lang('home.portfoliodetails') <span style="color:red">*</span></label>
							<div class="col-md-6">
								<textarea name="detail" class="form-control tex-editor"></textarea>
								<div>@lang('home.portfoliodetails_text')</div>
							</div>
						</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.portfolio_file') </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="portfoliofile">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.uploadedFile') </label>
								<div class="col-md-6" id="portfolio-file">
								   <a href="" target="_blank"></a>
								   <input type="hidden" name="old_portfoliofile" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#port').fadeIn();$('#port-edit').hide();$('html, body').animate({scrollTop:$('#port').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
						</form>
					</section>
					<!--Project Section End-->


					<!--Hope Working Section Start-->
					<section class="resume-box" id="hopeworking">
						<a class="btn btn-primary r-add-btn" onclick="addHopeworking()"><i class="fa fa-plus"></i> </a>
						<h4><i class="fa fa-graduation-cap r-icon bg-primary"></i> @lang('home.hopeworking')</h4>
						<ul class="resume-details">
							@if(count($resume['hopeworking']) > 0)
								@foreach($resume['hopeworking'] as $resumeId => $hopeworking)
									<li id="resume-{{ $resumeId }}">
										<div class="col-md-12">
											<span class="pull-right li-option">
												<a href="javascript:;" title="Edit" onclick="getHopeworking('{{ $resumeId }}')">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;
												<a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
													<i class="fa fa-trash"></i>
												</a>&nbsp;
											</span>
											<p class="rd-title">@lang('home.'.$hopeworking->hopejobtype)</p>
											<p class="rd-location">@lang('home.'.JobCallMe::cityName($hopeworking->city)),@lang('home.'.JobCallMe::stateName($hopeworking->state)),@lang('home.'.JobCallMe::countryName($hopeworking->country))</p>										
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</section>
					<section class="resume-box" id="hopeworking-edit" style="display: none;">
						<h4><i class="fa fa-graduation-cap r-icon bg-primary"></i>  <c>@lang('home.addHopeworking')</c></h4>
						<form class="form-horizontal form-hopeworking" method="post" action="">
							<input type="hidden" name="_token" value="">
							<input type="hidden" name="resumeId" value="">
							<div class="form-group error-group" style="display: none;">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6"><div class="alert alert-danger"></div></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.hopejobtype')</label>
								<div class="col-md-6">
									<select class="form-control select2" name="hopejobtype">
										@foreach(JobCallMe::getJobType() as $hopejtype)
										  
										  @if($hopejtype->name == 'Disabled' or $hopejtype->name == 'Full Time Three Months Later')											
										  @else
											<option value="{!! $hopejtype->name !!}">@lang('home.'.$hopejtype->name)</option>
										  @endif
										@endforeach
								   </select>
										
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.hopecountry')</label>
								<div class="col-md-6">
									<select class="form-control select2 job-country" name="country">
									@foreach(JobCallMe::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)<!-- {{ $cntry->name }} --></option>
									@endforeach
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">@lang('home.hopestate')</label>
								<div class="col-sm-6">
									<select class="form-control select2 job-state" name="state">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">@lang('home.hopecity')</label>
								<div class="col-sm-6">
									<select class="form-control select2 job-city" name="city">
									</select>
								</div>
							</div>


							<!-- <div class="form-group">
								<label class="control-label col-md-3 text-right">@lang('home.hoperegion')</label>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" name="hoperegion">
								</div>
							</div> -->

							<div class="form-group">
								<label class="control-label col-md-3 text-right">&nbsp;</label>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
									<button class="btn btn-default" type="button" onclick="$('#hopeworking').fadeIn();$('#hopeworking-edit').hide();$('html, body').animate({scrollTop:$('#hopeworking').position().top}, 700);">@lang('home.cancel')</button>
								</div>
							</div>
							
						</form>
					</section>

					<!--Hope Working Section End -->
                    
					<div class="review">
						<div class="review-header">
							<span class="bell">
								<i class="fa fa-bell fa-3x"></i>
								<span class="badge" id="reviewbell">{{ $totalReview }}</span>
								Reviews On Resume 
							</span>
							
							<span class="pull-right"><button onclick="changebtn(this)" class="btn btn-primary" style="border-radius: 50%;box-shadow: 0px 1px 13px rgba(0,0,0,0.5)"> <i class="fa fa-plus"></i> </button></span>
							
						</div>
					</div>


					
                    <div id="show-review" style="display: none">
                        @foreach($comments as $comment)
                        <?php $companyDetail = Sajid::getReviewCompany($comment->employeer_id);?>
                        <div class="row ">
                          <div class="col-md-12">
                                <div class="jobs-suggestions">
                                    <div class="pic col-md-1" align="center">
                                      <div class="circle">
                                          <img src="{{ url('compnay-logo/'.$companyDetail->companyLogo)}}" class="circle-img">
                                      </div>
                                    </div>
                                    <div class="col-md-11">
                                      <span class="heading"><a target="_blank" href="{{url('companies/company/'.$companyDetail->companyId)}}">{{ $companyDetail->companyName }}</a></span>
                                      <span class="pull-right"><button onclick="deleteReview(this,{{$comment->comment_id}})" class="btn btn-danger">delete</button></span>
                                      <p>{{ substr($comment->comment,0,150) }}</p>
                                        <span>{{ date('d M,Y',strtotime($comment->comment_date)) }}</span>
                                    </div>
                                </div>
                          </div>
                        </div>
                        @endforeach
                        
                    </div> 

						<div class="review"  style="margin-top: 16px;"> 

						<div class="review-header">
							<span class="bell">
								<i class="fa fa-bell fa-3x"></i>
								<span class="badge" id="offerbell">{{ count($offers) }}</span>
								Offer Interviews
							</span>
							<span class="pull-right"><button onclick="changeoffer(this)" class="btn btn-primary" style="border-radius: 50%;box-shadow: 0px 1px 13px rgba(0,0,0,0.5)"> <i class="fa fa-plus"></i> </button></span>
							
						</div>
					</div>
                    <div id="show-offer" style="display: none">
                        @foreach($offers as $comment)
                        <?php $companyDetail = Sajid::getReviewCompany($comment->emp_id);?>
                        <div class="row ">
                          <div class="col-md-12">
                                <div class="jobs-suggestions">
                                    <div class="pic col-md-1" align="center">
                                      <div class="circle">
                                          <img src="{{ url('compnay-logo/'.$companyDetail->companyLogo)}}" class="circle-img">
                                      </div>
                                    </div>
                                    <div class="col-md-11">
                                      <span class="heading"><a target="_blank" href="{{url('companies/company/'.$companyDetail->companyId)}}">{{ $companyDetail->companyName }}</a></span>
                                      <span class="pull-right"><button onclick="deleteOffer(this,{{$comment->offer_id}})" class="btn btn-danger">delete</button></span>
                                      <p>{{ substr($comment->offer_msg,0,150) }}</p>
                                        <span>{{ $comment->created_at }}</span>
                                    </div>
                                </div>
                          </div>
                        </div>
                        @endforeach
                        
                    </div>
					
				</div>
				<div class="col-md-3 hidden-xs">
					<div class="resume-listing-section hidden-sm hidden-xs">
						<h4>@lang('home.resumesections')</h4>
						<hr>
						<?php 
							   /*count user info*/
							$usercount = 0;
							$useremcount =0;
							/* this loop count the empty and fill record */
							foreach ($user as $key => $value) {
							   if($value != ''){
								$usercount += 1;
							   }else{
								$useremcount += 1; 
							   }
							}

							/* this if check if fill record greater then empty then assign 10% */
							if($usercount > $useremcount){
								$userhis = 16.6666;
							}else{
								$userhis = 0;
							}
							/*count whole resume record is percentage */
							foreach ($resume as $key => $value) {
								if($key == 'academic' || $key == 'skills' || $key == 'experience' || $key == 'project' || $key == 'language'){
									$re += 16.6666;
								}
							}
							$width = round($re + $userhis);
						?>
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $width?>"
						  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $width?>%">
							<?php echo $width?>%
						  </div>
						</div>
						<ul class="rls" style="padding-left: 0;">
							<li>
								<a id="#" onclick="$('#personal-information').fadeIn();$('#personal-information-edit').hide();">@lang('home.personalinformation')</a> 
								<a id="#" onclick="$('#personal-information').hide();$('#personal-information-edit').fadeIn()"><i class="fa fa-edit pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">@lang('home.academic')</a> 
								<a id="#" onclick="addAcademic();$('html, body').animate({scrollTop:$('#academic-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#certification').fadeIn();$('#certification-edit').hide();$('html, body').animate({scrollTop:$('#certification').position().top}, 700);">@lang('home.certifications')</a> 
								<a id="#" onclick="addCertification();$('html, body').animate({scrollTop:$('#certification-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#experience').fadeIn();$('#experience-edit').hide();$('html, body').animate({scrollTop:$('#experience').position().top}, 700);">@lang('home.experiences')</a> 
								<a id="#" onclick="addExperience();$('html, body').animate({scrollTop:$('#experience-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#skills').fadeIn();$('#skills-edit').hide();$('html, body').animate({scrollTop:$('#skills').position().top}, 700);">@lang('home.skills')</a> 
								<a id="#" onclick="addSkills();$('html, body').animate({scrollTop:$('#skills-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#skill').fadeIn();$('#skill-edit').hide();$('html, body').animate({scrollTop:$('#skill').position().top}, 700);">@lang('home.references')</a> 
								<a id="#" onclick="addSkill();$('html, body').animate({scrollTop:$('#skill-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#skil').fadeIn();$('#skil-edit').hide();$('html, body').animate({scrollTop:$('#skil').position().top}, 700);">@lang('home.publication')</a> 
								<a id="#" onclick="addSkil();$('html, body').animate({scrollTop:$('#skil-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#ski').fadeIn();$('#ski-edit').hide();$('html, body').animate({scrollTop:$('#ski').position().top}, 700);">@lang('home.project')</a> 
								<a id="#" onclick="addProject();$('html, body').animate({scrollTop:$('#ski-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#s').fadeIn();$('#s-edit').hide();$('html, body').animate({scrollTop:$('#s').position().top}, 700);">@lang('home.award')</a> 
								<a id="#" onclick="addAward();$('html, body').animate({scrollTop:$('#s-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#sk').fadeIn();$('#sk-edit').hide();$('html, body').animate({scrollTop:$('#sk').position().top}, 700);">@lang('home.language')</a> 
								<a id="#" onclick="addLanguage();$('html, body').animate({scrollTop:$('#sk-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#aff').fadeIn();$('#aff-edit').hide();$('html, body').animate({scrollTop:$('#aff').position().top}, 700);">@lang('home.Affiliation')</a> 
								<a id="#" onclick="addAffi();$('html, body').animate({scrollTop:$('#aff-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#preference').fadeIn();$('#preference-edit').hide();$('html, body').animate({scrollTop:$('#preference').position().top}, 700);">@lang('home.preference')</a> 
								<a id="#" onclick="addPreference();$('html, body').animate({scrollTop:$('#preference-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#port').fadeIn();$('#port-edit').hide();$('html, body').animate({scrollTop:$('#port').position().top}, 700);">@lang('home.Portfolio')</a> 
								<a id="#" onclick="addPortfolio();$('html, body').animate({scrollTop:$('#port-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
							<li>
								<a id="#" onclick="$('#hopeworking').fadeIn();$('#hopeworking-edit').hide();$('html, body').animate({scrollTop:$('#port').position().top}, 700);">@lang('home.hopeworking')</a> 
								<a id="#" onclick="addHopeworking();$('html, body').animate({scrollTop:$('#hopeworking-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
							</li>
						</ul>
					</div>
					<div class="download-resume">
						<a href="cv" class="btn btn-primary btn-block ">@lang('home.DOWNLOADRESUME')</a>
					</div>
					 <!--privacy-->
				<div id="privacy-show" class="ja-content-item mc-item resume-listing-section" style="">
					<form class="form-horizontal privacy-form" method="post" action="">
						<input type="hidden" name="_token" value="">
						<h4>@lang('home.privacysettings')</h4>
						
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="profile-visible" class="switch-field" name="profile" {{ $privacy->profile != 'No' ? 'checked=""' : '' }}>
								<label for="profile-visible" class="switch-label"></label> <span>@lang('home.profilevisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="gender-visible" class="switch-field" name="gender" {{ $privacy->gender != 'No' ? 'checked=""' : '' }}>
								<label for="gender-visible" class="switch-label"></label> <span>@lang('home.gendervisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="dfb-visible" class="switch-field" name="dateofbirth" {{ $privacy->dateofbirth != 'No' ? 'checked=""' : '' }}>
								<label for="dfb-visible" class="switch-label"></label> <span>@lang('home.birthvisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="image-visible" class="switch-field" name="profileImage" {{ $privacy->profileImage != 'No' ? 'checked=""' : '' }}>
								<label for="image-visible" class="switch-label"></label> <span>@lang('home.picturevisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="academic-visible" class="switch-field" name="academic" {{ $privacy->academic != 'No' ? 'checked=""' : '' }}>
								<label for="academic-visible" class="switch-label"></label> <span>@lang('home.academicvisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="experience-visible" class="switch-field" name="experience" {{ $privacy->experience != 'No' ? 'checked=""' : '' }}>
								<label for="experience-visible" class="switch-label"></label> <span>@lang('home.experiencevisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="skills-visible" class="switch-field" name="skills" {{ $privacy->skills != 'No' ? 'checked=""' : '' }}>
								<label for="skills-visible" class="switch-label"></label> <span>@lang('home.skillsvisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="project-visible" class="switch-field" name="projectVisible" {{ $privacy->projectVisible != 'No' ? 'checked=""' : '' }}>
								<label for="project-visible" class="switch-label"></label> <span>@lang('home.projectsvisible')</span>
							</p>
						</div>
						<div class="col-md-12">
							<p style="margin-top: 4px">
								<input type="checkbox" id="publication-visible" class="switch-field" name="publicationsVisible" {{ $privacy->publicationsVisible != 'No' ? 'checked=""' : '' }}>
								<label for="publication-visible" class="switch-label"></label> <span>@lang('home.publicationsvisible')</span>
							</p>
						</div>
					</form>
				</div>
				 <div class="ja-content-item mc-item resume-listing-section">
					<h4>@lang('home.Video & Chat Image')</h4>
					<div class="re-img-box" style="left: 50px;">
						<img src="<?= ($user->chatImage != '') ? url('profile-photos/'.$user->chatImage) : asset('profile-photos/profile-logo.jpg') ?>" class="chat-img-target">
						<div class="re-img-toolkit">
							<div class="re-file-btn" style="left:35px">
								@lang('home.change') <i class="fa fa-camera"></i>
								<input type="file" class="upload chatImage" name="image">
							</div>
							<span id="remove-re-image" style="margin-left: 35px;" onclick="removeResumePic('chat')">@lang('home.remove') <i class="fa fa-remove"></i></span>
							<p id="remove-re-image" style="margin-left: 35px;" onclick="editResumeChatPic()">@lang('home.Edit') <i class="fa fa-edit"><input type="hidden" value="1" id="userID"></i></p>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="nickName" id="nickName" class="form-control" value="{{$user->nickName}}" placeholder="@lang('home.Enter your Nick Name')">
					</div>
					<button type="button" id="chat-save" class="btn btn-primary">@lang('home.save')</button>
					<div class="form-group" style="margin-top:10px">
						<span><img src="/frontend-assets/images/info-icon.png"> @lang('home.video-text')</span>
					</div>
					
				</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="editProResumeModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modal Header</h4>
	  </div>
	  <div class="modal-body">
	   <div class="row">
		   <div class="col-md-9">
				<div id="proEditImg">
					<img src="" class="img-responsive">
				</div>
		   </div>
		   <div class="col-md-3">
			   <div id="custom-preview-wrapper"></div>
		   </div>
	   </div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Crop</button>
	  </div>
	</div>

  </div>
</div>
@endsection
@section('page-footer')
<style type="text/css">
.edit-btn{z-index: 5;}
.li-option{display: none;}
.li-option a{color: #cccccc;text-decoration: none;}
.li-option a:hover{color: #286090;}
.resume-details li:hover .li-option{display:block;}
textarea.form-control{resize: vertical;}
.personal-info-left p {font-size: 12px;}
@media screen and (max-width: 992px){
	.f-name, .l-name{padding-left: 15px !important;padding-right: 15px !important;}
}
</style>
<script type="text/javascript">
function changebtn(current){
    if($(current).hasClass('btn-primary')){
        $(current).removeClass('btn-primary').addClass('btn-danger');
        $(current).html('<i class="fa fa-minus"></i>');
        $('#show-review').show();
    }else{
        $(current).removeClass('btn-danger').addClass('btn-primary');
        $(current).html('<i class="fa fa-plus"></i>');
         $('#show-review').hide();
    }
}

function changeoffer(current){
    if($(current).hasClass('btn-primary')){
        $(current).removeClass('btn-primary').addClass('btn-danger');
        $(current).html('<i class="fa fa-minus"></i>');
        $('#show-offer').show();
    }else{
        $(current).removeClass('btn-danger').addClass('btn-primary');
        $(current).html('<i class="fa fa-plus"></i>');
         $('#show-offer').hide();
    }
}

function deleteReview(current,comment_id){
    $.ajax({
        url:jsUrl()+"/jobseeker/resume/review/delete",
        type:"post",
        data:{commentId:comment_id,_token:jsCsrfToken()},
        success:function(res){
            $(current).closest('.row').remove();
            var noti = $('#reviewbell').text();
            noti = parseInt(noti) - 1;
            $('#reviewbell').text(noti);

        }
    });
}

function deleteOffer(current,comment_id){
    $.ajax({
        url:jsUrl()+"/jobseeker/resume/offer/delete",
        type:"post",
        data:{offerId:comment_id,_token:jsCsrfToken()},
        success:function(res){
            $(current).closest('.row').remove();
            var noti = $('#offerbell').text();
            noti = parseInt(noti) - 1;
            $('#offerbell').text(noti);

        }
    });
}

getStates($('.job-country option:selected:selected').val());
var pageToken = '{{ csrf_token() }}';
$(document).ready(function(){
   
   $('.date-pickers').datetimepicker({
				format:'yyyy-mm-dd',
				endDate: '+0d',
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0});
});
$('.job-country').on('change',function(){
	var countryId = $(this).val();
	getStates(countryId)
})
function getStates(countryId){
	$.ajax({
		url: "{{ url('account/get-state') }}/"+countryId,
		success: function(response){
			var currentState = $('.job-state').attr('data-state');
			console.log(response);
			/*var obj = $.parseJSON(response);*/
			$(".job-state").html('').trigger('change');
			/*var newOption = new Option('Select State', '0', true, false);*/
			$(".job-state").append(response).trigger('change');
			var selected = "selected";
			
			/*for (var i =0; i < obj.length; i++) {
				if(obj[i].id == currentState){
					var option = "<option value='"+obj[i].id+"' selected='selected'>"+obj[i].name+"</option>";
					$(".job-state").append(option);
				}else{
					var option = "<option value='"+obj[i].id+"'>"+obj[i].name+"</option>";
					$(".job-state").append(option);
				}
				
			};*/
			/*$(".job-state").trigger('change');*/
			/*$.each(obj,function(i,k){
				var vOption = k.id == currentState ? true : false;
				console.log(vOption);
				var newOption = new Option(k.name, k.id, true, true);
				$(".job-state").append(newOption);
			})
			$(".job-state").trigger('change');*/
		}
	})
}
$('.job-state').on('change',function(){
	var stateId = $(this).val();
	getCities(stateId)
})
function getCities(stateId){
	$.ajax({
		url: "{{ url('account/get-city') }}/"+stateId,
		success: function(response){
			var currentCity = $('.job-city').attr('data-city');
			console.log(response);
			/*var obj = $.parseJSON(response);*/
			$(".job-city").html('').trigger('change');
			/*var newOption = new Option('Select City', '0', true, false);*/
			$(".job-city").append(response).trigger('change');
			/*$.each(obj,function(i,k){
				var vOption = k.id == currentCity ? true : false;
				var newOption = new Option(k.name, k.id, true, vOption);
				$(".job-city").append(newOption).trigger('change');
			})*/
		}
	})
}

 $('#Currently').on('change', function() {
  // process= $('#addprocess').val();
	if(this.checked)
	{
		//alert("hi nabeel");
	   // $('#addlable').show();
		$('#enddate').hide();
	}
	else{
	   // $('#addlable').hide();
		$('#enddate').show();
	}
});

 $('#currently').on('change', function() {
  // process= $('#addprocess').val();
	if(this.checked)
	{
		//alert("hi nabeel");
	   // $('#addlable').show();
		$('#projectendmonth').hide();
		$('#projectendyear').hide();
	}
	else{
	   // $('#addlable').hide();
		$('#projectendmonth').show();
		 $('#projectendyear').show();
	}
});

 getSubCategories($('.job-category option:selected:selected').val());

 getSubCategories2($('.job-category option:selected:selected').val());
function cancelProfile(){
	$('#personal-information').fadeIn();
	$('#personal-information-edit').hide();
	$('html, body').animate({scrollTop:$('#personal-information').position().top}, 700);
}

$('form.form-personal-info').submit(function(e){
	$('.form-personal-info input[name="_token"]').val(pageToken);
	$('.form-personal-info button[name="save"]').prop('disabled',true);
	$('.form-personal-info .error-group').hide();
	$.ajax({
		type: 'post',
		data: $('.form-personal-info').serialize(),
		url: "{{ url('account/jobseeker/resume/personal/save') }}",
		success: function(response){
			console.log(response);
			if($.trim(response) != '1'){
				$('.form-personal-info .error-group').show();
				$('.form-personal-info .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#personal-information-edit').position().top}, 1000);
				$('.form-personal-info button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			console.log(errors);
			var vErrors = '';
			$.each(errors, function(i,k){
				vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			 console.log(vErrors);
			$('.form-personal-info .error-group').show();
			$('.form-personal-info .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-personal-info button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#personal-information-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function firstCapital(myString){
	firstChar = myString.substring( 0, 1 );
	firstChar = firstChar.toUpperCase();
	tail = myString.substring( 1 );
	return firstChar + tail;
}
function addAcademic(){
	$('.form-academic input').val('');
	$('#academic-edit h4 c').text('@lang("home.addacademics")');
	$('#academic').hide();
	$('#academic-edit').fadeIn();
}
$('form.form-academic').submit(function(e){
	$('.form-academic input[name="_token"]').val(pageToken);
	$('.form-academic button[name="save"]').prop('disabled',true);
	$('.form-academic .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/academic/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-academic .error-group').show();
				$('.form-academic .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
				$('.form-academic button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-academic .error-group').show();
			$('.form-academic .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-academic button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getAcademic(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);


			$('.form-academic input[name="resumeId"]').val(resumeId);
			$('.form-academic select[name="degreeLevel"] option[value='+obj.degreeLevel+']').attr('selected','selected').trigger('change.select2');
			$('.form-academic select[name="graduationstatus"]').val(obj.graduationstatus).trigger('change');
			$('.form-academic select[name="transferstatus"]').val(obj.transferstatus).trigger('change');
			$('.form-academic input[name="degree"]').val(obj.degree);
			$('.form-academic input[name="minor"]').val(obj.minor);
			$('.form-academic input[name="old_academicfile"]').val(obj.academicfile);
			$('.form-academic input[name="enterDate"]').val(obj.enterDate);
			$('.form-academic input[name="completionDate"]').val(obj.completionDate);
			$('.form-academic input[name="grade"]').val(obj.grade);
			$('.form-academic select[name="grade2"]').val(obj.grade2).trigger('change');
			$('.form-academic input[name="institution"]').val(obj.institution);
			$('.form-academic select[name="country"]').val(obj.country).trigger('change');
			$('.form-academic select[name="state"]').val(obj.state).trigger('change');
			$('.form-academic select[name="city"] option[value='+obj.city+']').attr('selected','selected').trigger('change.select2');
			tinymce.get('details').setContent(obj.details);
			$('.form-academic #academic-file a').attr('href',jsUrl()+"/resume_images/"+obj.academicfile);
			$('.form-academic #academic-file a').text(obj.academicfile);
			$('.form-academic #academic-file input[name="old_academicfile"]').val(obj.academicfile);
			$('#academic-edit h4 c').text('@lang("home.Edit Academics")');
			$('#academic').hide();
			$('#academic-edit').fadeIn();
		}
	})
}
function deleteElement(resumeId){
	if(confirm('@lang("home.Are you sure to delete this?")')){
		$.ajax({
			url: "{{ url('account/jobseeker/resume/delete') }}/"+resumeId,
			success: function(response){
				$('#resume-'+resumeId).remove();
			}
		})
	}
}
function addCertification(){
	$('.form-certification input').val('');
	$('#certification-edit h4 c').text('@lang("home.Add Certificate")');
	$('#certification').hide();
	$('#certification-edit').fadeIn();
}
$('form.form-certification').submit(function(e){
	$('.form-certification input[name="_token"]').val(pageToken);
	$('.form-certification button[name="save"]').prop('disabled',true);
	$('.form-certification .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/certification/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-certification .error-group').show();
				$('.form-certification .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#certification-edit').position().top}, 1000);
				$('.form-certification button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-certification .error-group').show();
			$('.form-certification .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-certification button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#certification-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getCertification(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-certification input[name="resumeId"]').val(resumeId);
			$('.form-certification input[name="certificate"]').val(obj.certificate);
			$('.form-certification input[name="completionDate"]').val(obj.completionDate);
			$('.form-certification input[name="score"]').val(obj.score);
			$('.form-certification input[name="institution"]').val(obj.institution);
			$('.form-certification select[name="country"]').val(obj.country).trigger('change');
			$('.form-certification select[name="state"]').val(obj.state).trigger('change');
			$('.form-certification select[name="city"]').val(obj.city).trigger('change');
			tinymce.get('details').setContent(obj.details);
			$('.form-certification #certificate-file a').attr('href',jsUrl()+"/resume_images/"+obj.certificatefile);
			$('.form-certification #certificate-file a').text(obj.certificatefile);
			$('.form-certification #certificate-file input[name="old_certificatefile"]').val(obj.certificatefile);
			$('#certification-edit h4 c').text('@lang("home.Edit Certificate")');
			$('#certification').hide();
			$('#certification-edit').fadeIn();
		}
	})
}
function addExperience(){
	$('.form-experience input').val('');
	$('.form-experience input[name="currently"]').val('yes');
	$('#experience-edit h4 c').text('@lang("home.Add Experience")');
	$('#experience').hide();
	$('#experience-edit').fadeIn();
}
$('form.form-experience').submit(function(e){
	$('.form-experience input[name="_token"]').val(pageToken);
	$('.form-experience button[name="save"]').prop('disabled',true);
	$('.form-experience .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/experience/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-experience .error-group').show();
				$('.form-experience .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#experience-edit').position().top}, 1000);
				$('.form-experience button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-experience .error-group').show();
			$('.form-experience .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-experience button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#experience-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getExperience(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-experience input[name="resumeId"]').val(resumeId);
			$('.form-experience input[name="jobTitle"]').val(obj.jobTitle);
			$('.form-experience input[name="organization"]').val(obj.organization);
			$('.form-experience input[name="startDate"]').val(obj.startDate);
			$('.form-experience input[name="currently"]').prop('checked',true);
			$('.form-experience input[name="endDate"]').val('');
			if(obj.currently == 'no'){
				$('.form-experience input[name="endDate"]').val(obj.endDate);
				$('.form-experience input[name="currently"]').prop('checked',false);
				$('.form-experience input[name="reasonleaving"]').val(obj.reasonleaving);
			}
			$('.form-experience select[name="expptitle"]').val(obj.expptitle).trigger('change');
			$('.form-experience select[name="expptitle"]').val(obj.expptitle).trigger('change');
			$('.form-experience textarea[name="responsibilities"]').val(obj.responsibilities);
			$('.form-experience select[name="country"]').val(obj.country).trigger('change');
			$('.form-experience select[name="state"]').val(obj.state).trigger('change');
			$('.form-experience select[name="city"]').val(obj.city).trigger('change');
			
			$('.form-experience textarea[name="details"]').val(obj.details);

			$('.form-experience #experience-file a').attr('href',jsUrl()+"/resume_images/"+obj.experiencefile);
			$('.form-experience #experience-file a').text(obj.experiencefile);
			$('.form-experience #experience-file input[name="old_experiencefile"]').val(obj.experiencefile);
			$('#experience-edit h4 c').text('@lang("home.Edit Experience")');
			$('#experience').hide();
			$('#experience-edit').fadeIn();
		}
	})
}
function addSkills(){
	$('.form-skills input').val('');
	$('#skills-edit h4 c').text('@lang("home.Add Skill")');
	$('#skills').hide();
	$('#skills-edit').fadeIn();
}
$('form.form-skills').submit(function(e){
	$('.form-skills input[name="_token"]').val(pageToken);
	$('.form-skills button[name="save"]').prop('disabled',true);
	$('.form-skills .error-group').hide();
	$.ajax({
		type: 'post',
		data: $('.form-skills').serialize(),
		url: "{{ url('account/jobseeker/resume/skills/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-skills .error-group').show();
				$('.form-skills .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#skills-edit').position().top}, 1000);
				$('.form-skills button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-skills .error-group').show();
			$('.form-skills .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-skills button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#skills-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getSkills(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-skills input[name="resumeId"]').val(resumeId);
			$('.form-skills input[name="skill"]').val(obj.skill);
			$('.form-skills select[name="level"]').val(obj.level).trigger('change');
			$('#skills-edit h4 c').text('@lang("home.Edit Skill")');
			$('#skills').hide();
			$('#skills-edit').fadeIn();
		}
	})
}
//
function addSkill(){
	$('.form-skill input').val('');
	$('#skill-edit h4 c').text('@lang("home.Add Reference")');
	$('#skill').hide();
	$('#skill-edit').fadeIn();
}
$('form.form-skill').submit(function(e){
	$('.form-skill input[name="_token"]').val(pageToken);
	$('.form-skill button[name="save"]').prop('disabled',true);
	$('.form-skill .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/refer/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-skill .error-group').show();
				$('.form-skill .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#skill-edit').position().top}, 1000);
				$('.form-skill button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-skill .error-group').show();
			$('.form-skill .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-skill button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#skill-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getSkill(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-skill input[name="resumeId"]').val(resumeId);
			$('.form-skill input[name="name"]').val(obj.name);
			$('.form-skill input[name="jobtitle"]').val(obj.jobtitle);
			$('.form-skill input[name="organization"]').val(obj.organization);
			$('.form-skill input[name="phone"]').val(obj.phone);
			$('.form-skill input[name="email"]').val(obj.email);
			$('.form-skill select[name="country"]').val(obj.country).trigger('change');
			$('.form-skill select[name="state"]').val(obj.state).trigger('change');
			$('.form-skill select[name="city"]').val(obj.city).trigger('change');
			$('.form-skill select[name="type"]').val(obj.type).trigger('change');

			$('.form-ski #references-file a').attr('href',jsUrl()+"/resume_images/"+obj.referencesfile);
			$('.form-ski #references-file a').text(obj.referencesfile);
			$('.form-ski #references-file input[name="old_referencesfile"]').val(obj.referencesfile);

			$('#skill-edit h4 c').text('@lang("home.Edit Reference")');
			$('#skill').hide();
			$('#skill-edit').fadeIn();
		}
	})
}
//
//
function addSkil(){
	$('.form-skil input').val('');
	$('#skil-edit h4 c').text('@lang("home.Add Publisher")');
	$('#skil').hide();
	$('#skil-edit').fadeIn();
}
$('form.form-skil').submit(function(e){
	$('.form-skil input[name="_token"]').val(pageToken);
	$('.form-skil button[name="save"]').prop('disabled',true);
	$('.form-skil .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/publish/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-skil .error-group').show();
				$('.form-skil .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#skil-edit').position().top}, 1000);
				$('.form-skil button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-skill .error-group').show();
			$('.form-skill .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-skill button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#skil-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getSkil(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-skil input[name="resumeId"]').val(resumeId);
			$('.form-skil select[name="pu_type"]').val(obj.pu_type).trigger('change');
			$('.form-skil input[name="title"]').val(obj.title);
			$('.form-skil input[name="author"]').val(obj.author);
			$('.form-skil input[name="publisher"]').val(obj.publisher);
			$('.form-skil input[name="year"]').val(obj.year);
			$('.form-skil input[name="month"]').val(obj.month);
			$('.form-skil select[name="country"]').val(obj.country).trigger('change');
			$('.form-skil select[name="state"]').val(obj.state).trigger('change');
			$('.form-skil select[name="city"]').val(obj.city).trigger('change');
			$('.form-skil textarea[name="detail"]').val(obj.detail);
			$('.form-skil #publication-file a').attr('href',jsUrl()+"/resume_images/"+obj.publicationfile);
			$('.form-skil #publication-file a').text(obj.publicationfile);
			$('.form-skil #publication-file input[name="old_publicationfile"]').val(obj.publicationfile);
			$('#skil-edit h4 c').text('@lang("home.Edit Publisher")');
			$('#skil').hide();
			$('#skil-edit').fadeIn();
		}
	})
}
//

//
function addProject(){
	$('.form-ski input').val('');
	$('.form-ski input[name="currently"]').val('yes');
	$('#ski-edit h4 c').text('@lang("home.Add Project")');
	$('#ski').hide();
	$('#ski-edit').fadeIn();
}
$('form.form-ski').submit(function(e){
	$('.form-ski input[name="_token"]').val(pageToken);
	$('.form-ski button[name="save"]').prop('disabled',true);
	$('.form-ski .error-group').hide();
	$.ajax({
		type:'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/project/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-ski .error-group').show();
				$('.form-ski .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#ski-edit').position().top}, 1000);
				$('.form-ski button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-ski .error-group').show();
			$('.form-ski .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-ski button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#ski-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getProject(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-ski input[name="resumeId"]').val(resumeId);
			$('.form-ski input[name="title"]').val(obj.title);
			$('.form-ski input[name="position"]').val(obj.position);
			$('.form-ski select[name="type"]').val(obj.type).trigger('change');
			$('.form-ski input[name="occupation"]').val(obj.occupation);
			$('.form-ski input[name="organization"]').val(obj.organization);
			$('.form-ski select[name="startyear"]').val(obj.startyear).trigger('change');
			$('.form-ski select[name="startmonth"]').val(obj.startmonth).trigger('change');
			$('.form-ski input[name="currently"]').prop('checked',true);
			 if(obj.currently == 'no'){
				$('.form-ski select[name="endyear"]').val(obj.endyear).trigger('change');
				$('.form-ski select[name="endmonth"]').val(obj.endmonth).trigger('change');
				$('.form-ski input[name="currently"]').prop('checked',false);
			} 
			$('.form-ski #project-file a').attr('href',jsUrl()+"/resume_images/"+obj.projectfile);
			$('.form-ski #project-file a').text(obj.projectfile);
			$('.form-ski #project-file input[name="old_projectfile"]').val(obj.projectfile);
			$('.form-ski textarea[name="detail"]').val(obj.detail);
			$('#ski-edit h4 c').text('@lang("home.Edit Project")');
			$('#ski').hide();
			$('#ski-edit').fadeIn();
		}
	})
}
//

//Affilation
function addAffi(){
	$('.form-aff input').val('');
	$('.form-aff input[name="currently"]').val('yes');
	$('#aff-edit h4 c').text('@lang("home.Add Affiliation")');
	$('#aff').hide();
	$('#aff-edit').fadeIn();
}
$('form.form-aff').submit(function(e){
	$('.form-aff input[name="_token"]').val(pageToken);
	$('.form-aff button[name="save"]').prop('disabled',true);
	$('.form-aff .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/affiliation/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-aff .error-group').show();
				$('.form-aff .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#aff-edit').position().top}, 1000);
				$('.form-aff button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				 vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-aff .error-group').show();
			$('.form-aff .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-aff button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#aff-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getAffi(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-aff input[name="resumeId"]').val(resumeId);
			//$('.form-aff input[name="title"]').val(obj.title);
			$('.form-aff input[name="pos"]').val(obj.pos);
			//$('.form-aff select[name="type"]').val(obj.type).trigger('change');
			//$('.form-aff input[name="occupation"]').val(obj.occupation);
			$('.form-aff input[name="org"]').val(obj.org);
			$('.form-aff select[name="stayear"]').val(obj.stayear).trigger('change');
			$('.form-aff select[name="stamonth"]').val(obj.stamonth).trigger('change');
			$('.form-aff select[name="enyear"]').val(obj.enyear).trigger('change');
			$('.form-aff select[name="enmonth"]').val(obj.enmonth).trigger('change');
			$('.form-aff input[name="currently"]').prop('checked',true);
			if(obj.currently == 'no'){                
				$('.form-aff input[name="currently"]').prop('checked',false);
			}
			$('.form-aff select[name="country"]').val(obj.country).trigger('change');
			$('.form-aff select[name="state"]').val(obj.state).trigger('change');
			$('.form-aff select[name="city"]').val(obj.city).trigger('change');

			$('.form-aff #affiliation-file a').attr('href',jsUrl()+"/resume_images/"+obj.affiliationfile);
			$('.form-aff #affiliation-file a').text(obj.affiliationfile);
			$('.form-aff #affiliation-file input[name="old_affiliationfile"]').val(obj.affiliationfile);
			
			//$('.form-aff textarea[name="detail"]').val(obj.detail);
			$('#aff-edit h4 c').text('@lang("home.Edit Affiliation")');
			$('#aff').hide();
			$('#aff-edit').fadeIn();
		}
	})
}
//Affilation end



//Preference start
function addPreference(){
	$('.form-preference input').val('');
	$('#preference-edit h4 c').text('@lang("home.Add Preference")');
	$('#preference').hide();
	$('#preference-edit').fadeIn();
}
$('form.form-preference').submit(function(e){
	$('.form-preference input[name="_token"]').val(pageToken);
	$('.form-preference button[name="save"]').prop('disabled',true);
	$('.form-preference .error-group').hide();
	$.ajax({
		type: 'post',
		data: $('.form-preference').serialize(),
		url: "{{ url('account/jobseeker/resume/preference/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-preference .error-group').show();
				$('.form-preference .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#preference-edit').position().top}, 1000);
				$('.form-preference button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				vErrors += '<li>'+k+'</li>';
			})
			$('.form-preference .error-group').show();
			$('.form-preference .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-preference button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#preference-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getPreference(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-preference input[name="resumeId"]').val(resumeId);
			$('.form-preference select[name="veteran"]').val(obj.veteran).trigger('change');
			$('.form-preference select[name="jobprotection"]').val(obj.jobprotection).trigger('change');
			$('.form-preference select[name="subsidy"]').val(obj.subsidy).trigger('change');
			$('.form-preference select[name="disability"]').val(obj.disability).trigger('change');
			$('.form-preference select[name="disabilitygrade"]').val(obj.disabilitygrade).trigger('change');
			$('.form-preference select[name="militaryservice"]').val(obj.militaryservice).trigger('change');
			$('.form-preference select[name="militarystartyear"]').val(obj.militarystartyear).trigger('change');
			$('.form-preference select[name="militarystartmonth"]').val(obj.militarystartmonth).trigger('change');
			$('.form-preference select[name="militaryendyear"]').val(obj.militaryendyear).trigger('change');
			$('.form-preference select[name="militaryendmonth"]').val(obj.militaryendmonth).trigger('change');
			$('.form-preference select[name="militarytype"]').val(obj.militarytype).trigger('change');
			$('.form-preference select[name="militaryclasses"]').val(obj.militaryclasses).trigger('change');
			$('#preference-edit h4 c').text('@lang("home.Edit Preference")');
			$('#preference').hide();
			$('#preference-edit').fadeIn();
		}
	})
}
//Preference End




function addLanguage(){
	$('.form-sk input').val('');
	$('#sk-edit h4 c').text('@lang("home.Add Language")');
	$('#sk').hide();
	$('#sk-edit').fadeIn();
}
$('form.form-sk').submit(function(e){
	$('.form-sk input[name="_token"]').val(pageToken);
	$('.form-sk button[name="save"]').prop('disabled',true);
	$('.form-sk .error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/language/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-sk .error-group').show();
				$('.form-sk .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#sk-edit').position().top}, 1000);
				$('.form-sk button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-sk .error-group').show();
			$('.form-sk .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-sk button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#ski-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getLanguage(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-sk input[name="resumeId"]').val(resumeId);
			$('.form-sk select[name="language"]').val(obj.language).trigger('change');
			$('.form-sk select[name="level"]').val(obj.level).trigger('change');
			$('.form-sk input[name="certifiedexam"]').val(obj.certifiedexam);
			$('.form-sk input[name="classscore"]').val(obj.classscore);
			$('.form-sk select[name="languageyear"]').val(obj.languageyear).trigger('change');
			$('.form-sk select[name="languagemonth"]').val(obj.languagemonth).trigger('change');
			
			$('.form-ski #language-file a').attr('href',jsUrl()+"/resume_images/"+obj.languagefile);
			$('.form-ski #language-file a').text(obj.languagefile);
			$('.form-ski #language-file input[name="old_languagefile"]').val(obj.languagefile);

			$('#sk-edit h4 c').text('@lang("home.Edit Language")');
			$('#sk').hide();
			$('#sk-edit').fadeIn();
		}
	})
}
//
//
function addAward(){
	$('.form-s input').val('');
	$('#s-edit h4 c').text('@lang("home.Add Honours & Awards")');
	$('#s').hide();
	$('#s-edit').fadeIn();
}
$('form.form-s').submit(function(e){
	$('.form-s input[name="_token"]').val(pageToken);
	$('.form-s button[name="save"]').prop('disabled',true);
	$('.form-s.error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/award/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-s.error-group').show();
				$('.form-s.error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#sk-edit').position().top}, 1000);
				$('.form-s button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-s .error-group').show();
			$('.form-s .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-s button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#s-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getAward(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-s input[name="resumeId"]').val(resumeId);
			$('.form-s input[name="title"]').val(obj.title);
			$('.form-s select[name="type"]').val(obj.type).trigger('change');
			$('.form-s input[name="occupation"]').val(obj.occupation);
			$('.form-s input[name="organization"]').val(obj.organization);
			$('.form-s select[name="startyear"]').val(obj.startyear).trigger('change');
			$('.form-s select[name="startmonth"]').val(obj.startmonth).trigger('change');
			
			$('.form-s #award-file a').attr('href',jsUrl()+"/resume_images/"+obj.awardfile);
			$('.form-s #award-file a').text(obj.awardfile);
			$('.form-s #award-file input[name="old_awardfile"]').val(obj.awardfile);
			$('#s-edit h4 c').text('@lang("home.Edit Honours & Awards")');
			$('#s').hide();
			$('#s-edit').fadeIn();
		}
	})
}
//
//
function addPortfolio(){
	$('.form-port input').val('');
	$('#port-edit h4 c').text('@lang("home.Add Portfolio")');
	$('#port').hide();
	$('#port-edit').fadeIn();
}
$('form.form-port').submit(function(e){
	$('.form-port input[name="_token"]').val(pageToken);
	$('.form-port button[name="save"]').prop('disabled',true);
	$('.form-prt.error-group').hide();
	$.ajax({
		type: 'post',
		data: new FormData(this),
		cache:false,
		contentType: false,
		processData: false,
		url: "{{ url('account/jobseeker/resume/portfolio/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-port.error-group').show();
				$('.form-port.error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#sk-edit').position().top}, 1000);
				$('.form-port button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				  vErrors += '<li style="list-style-type: none;">' +i+ ' field is requried</li>';
			})
			$('.form-port .error-group').show();
			$('.form-port .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-port button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#port-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getPortfolio(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-port input[name="resumeId"]').val(resumeId);
			$('.form-port input[name="title"]').val(obj.title);
			$('.form-port select[name="type"]').val(obj.type).trigger('change');
			$('.form-port input[name="occupation"]').val(obj.occupation);
			$('.form-port select[name="startyear"]').val(obj.startyear).trigger('change');
			$('.form-port select[name="startmonth"]').val(obj.startmonth).trigger('change');
			$('.form-port input[name="website"]').val(obj.organization);
			$('.form-port #portfolio-file a').attr('href',jsUrl()+"/resume_images/"+obj.portfoliofile);
			$('.form-port #portfolio-file a').text(obj.portfoliofile);
			$('.form-port #portfolio-file input[name="old_portfoliofile"]').val(obj.portfoliofile);
			$('#port-edit h4 c').text('@lang("home.Edit Portfolio")');
			$('#port').hide();
			$('#port-edit').fadeIn();
		}
	})
}
//



//Hopeworking start
function addHopeworking(){
	$('.form-hopeworking input').val('');
	$('#hopeworking-edit h4 c').text('@lang("home.Add Hopeworking")');
	$('#hopeworking').hide();
	$('#hopeworking-edit').fadeIn();
}
$('form.form-hopeworking').submit(function(e){
	$('.form-hopeworking input[name="_token"]').val(pageToken);
	$('.form-hopeworking button[name="save"]').prop('disabled',true);
	$('.form-hopeworking .error-group').hide();
	$.ajax({
		type: 'post',
		data: $('.form-hopeworking').serialize(),
		url: "{{ url('account/jobseeker/resume/hopeworking/save') }}",
		success: function(response){
			if($.trim(response) != '1'){
				$('.form-hopeworking .error-group').show();
				$('.form-hopeworking .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
				$('html, body').animate({scrollTop:$('#hopeworking-edit').position().top}, 1000);
				$('.form-hopeworking button[name="save"]').prop('disabled',false);
			}else{
				window.location.href = "{{ url('account/jobseeker/resume') }}";
			}
			Pace.stop;
		},
		error: function(data){
			var errors = data.responseJSON;
			var vErrors = '';
			$.each(errors, function(i,k){
				vErrors += '<li>'+k+'</li>';
			})
			$('.form-hopeworking .error-group').show();
			$('.form-hopeworking .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
			$('.form-hopeworking button[name="save"]').prop('disabled',false);
			Pace.stop;
			$('html, body').animate({scrollTop:$('#hopeworking-edit').position().top}, 1000);
		}
	})
	e.preventDefault();
})
function getHopeworking(resumeId){
	$.ajax({
		url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
		success: function(response){
			var obj = $.parseJSON(response);
			$('.form-hopeworking input[name="resumeId"]').val(resumeId);
			$('.form-hopeworking select[name="hopejobtype"]').val(obj.hopejobtype).trigger('change');
			$('.form-hopeworking select[name="country"]').val(obj.country).trigger('change');
			$('.form-hopeworking select[name="state"]').val(obj.state).trigger('change');
			$('.form-hopeworking select[name="city"]').val(obj.city).trigger('change');

			$('#hopeworking-edit h4 c').text('@lang("home.Edit Hope Working")');
			$('#hopeworking').hide();
			$('#hopeworking-edit').fadeIn();
		}
	})
}
//hopeworking End



$('.profile-pic').on('change',function(){
	var formData = new FormData();
	formData.append('profilePicture', $(this)[0].files[0]);
	formData.append('_token', pageToken);

	$.ajax({
		url : "{{ url('account/jobseeker/profile/picture') }}",
		type : 'POST',
		data : formData,
		processData: false,
		contentType: false,
		timeout: 30000000,
		success : function(response) {
			if($.trim(response) != '1'){
				$('img.img-target').attr('src',response);
			}else{
				alert('Following format allowed (PNG/JPG/JPEG)');
			}
		}
	});
});

$('#chat-save').on('click',function(e){
	e.preventDefault();
	var formData = new FormData();
	var nickName = $('#nickName').val();
	formData.append('profilePicture', $('.chatImage')[0].files[0]);
	formData.append('_token', pageToken);
	formData.append('chat', 'yes');
	formData.append('nickName', nickName);

	$.ajax({
		url : "{{ url('account/jobseeker/profile/picture') }}",
		type : 'POST',
		data : formData,
		processData: false,
		contentType: false,
		timeout: 30000000,
		success : function(response) {
			if($.trim(response) == 'noUrl'){
			}
			else{
				$('img.chat-img-target').attr('src',response);
			}
			if($.trim(response) == '1'){
				alert('Following format allowed (PNG/JPG/JPEG)');
			}
		}
	});
});
tinymce.init({
	selector: '.tex-editor',
	setup: function (editor) {
		editor.on('change', function () {
			editor.save();
		});
	},
	height: 200,
	menubar: false,
	plugins: [
		'advlist autolink lists link image charmap print preview anchor',
		'searchreplace visualblocks code fullscreen',
		'insertdatetime media table contextmenu paste code'
	],
	toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
$('.privacy-form input[type="checkbox"]').click(function(){
	$('.privacy-form input[name="_token"]').val(pageToken);
	$.ajax({
		type: 'post',
		data: $('.privacy-form').serialize(),
		url: "{{ url('account/privacy/save') }}",
		success: function(response){
		}
	})
})

var start = 1950;
var end = new Date().getFullYear();
var options = "";
for(var year = end ; year >=start; year--){
  options += "<option value="+year+">"+ year +"</option>";
}
document.getElementById("syear").innerHTML = options;
//
var start = 1950;
var end = new Date().getFullYear();
var options = "";
for(var year = end ; year >=start; year--){
  options += "<option value="+year+">"+ year +"</option>";
}
document.getElementById("ssyear").innerHTML = options;
//

var start = 1950;
var end = new Date().getFullYear();
var options = "";
for(var year = end ; year >=start; year--){
  options += "<option value="+year+">"+ year +"</option>";
}
document.getElementById("esyear").innerHTML = options;

var estart = 1950;
var eend = new Date().getFullYear();
var eoptions = "";
for(var eyear = eend ; eyear >=estart; eyear--){
  eoptions += "<option value="+eyear+">"+ eyear +"</option>";
}
document.getElementById("eyear").innerHTML = eoptions;
//

var estart = 1950;
var eend = new Date().getFullYear();
var eoptions = "";
eoptions += "<option value=''>@lang('home.militarysyear-text')</option>";
for(var eyear = eend ; eyear >=estart; eyear--){
  eoptions += "<option value="+eyear+">"+ eyear +"</option>";
}
document.getElementById("Militarysyear").innerHTML = eoptions;
//

var estart = 1950;
var eend = new Date().getFullYear();
var eoptions = "";
eoptions += "<option value=''>@lang('home.militaryeyear-text')</option>";
for(var eyear = eend ; eyear >=estart; eyear--){
  eoptions += "<option value="+eyear+">"+ eyear +"</option>";
}
document.getElementById("Militaryeyear").innerHTML = eoptions;
//

var starts = 1950;
var ends = new Date().getFullYear();
var option = "";
for(var years = ends ; years >=starts; years--){
  option += "<option value="+years+">"+ years +"</option>";
}
document.getElementById("years").innerHTML = option;

var starts = 1950;
var ends = new Date().getFullYear();
var option = "";
for(var years = ends ; years >=starts; years--){
  option += "<option value="+years+">"+ years +"</option>";
}
document.getElementById("yearss").innerHTML = option;


var sta = 1950;
var en = new Date().getFullYear();
var op = "";
for(var ye= en ; ye >=sta; ye--){
  option += "<option value="+ye+">"+ ye +"</option>";
}
/*document.getElementById("stayear").innerHTML = op;*/


var estart = 1950;
var eend = new Date().getFullYear();
var eoptions = "";
for(var eyear = eend ; eyear >=estart; eyear--){
  eoptions += "<option value="+eyear+">"+ eyear +"</option>";
}
document.getElementById("languageyear").innerHTML = eoptions;
//

var estart = 1950;
var eend = new Date().getFullYear();
var eoptions = "";
for(var eyear = eend ; eyear >=estart; eyear--){
  eoptions += "<option value="+eyear+">"+ eyear +"</option>";
}
document.getElementById("year").innerHTML = eoptions;
//

function getSubCategories(categoryId){
	$.ajax({
		url: "{{ url('account/get-subCategory') }}/"+categoryId,
		success: function(response){
			console.log(response);
			/*var obj = $.parseJSON(response);*/
			$(".job-sub-category").html('').trigger('change');
			$(".job-sub-category").append(response).trigger('change');
			/*$.each(obj,function(i,k){
				var vOption = false;
				var newOption = new Option(k.subName, k.subCategoryId, true, vOption);
				$(".job-sub-category").append(newOption).trigger('change');
			})*/
		}
	})
}

function getSubCategories2(categoryId2){

	$.ajax({
		url: "{{ url('account/get-subCategory2') }}/"+categoryId2,
		success: function(response){

			/*var obj = $.parseJSON(response);*/
			$(".job-sub-category2").html('').trigger('change');
			$(".job-sub-category2").html(response).trigger('change');
			/*$.each(obj,function(i,k){
				var vOption = false;
				var newOption = new Option(k.subName, k.subCategoryId2, true, vOption);
				$(".job-sub-category2").append(newOption).trigger('change');
			})*/
		}
	})
}

//**dataURL to blob**
	function dataURLtoBlob(dataurl) {
		var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
			bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
		while(n--){
			u8arr[n] = bstr.charCodeAt(n);
		}
		return new Blob([u8arr], {type:mime});
	}

	//**blob to dataURL**
	function blobToDataURL(blob, callback) {
		var a = new FileReader();
		a.onload = function(e) {callback(e.target.result);}
		a.readAsDataURL(blob);
	}
	function editResumeProPic(){
		var proImg = $('.img-target').attr('src');
	   $('#editProResumeModel').modal('show');
	   $('#proEditImg img').attr('src',proImg);
	   $('#proEditImg img').rcrop({
			minSize : [100,100],
			preserveAspectRatio : true,
			
			preview : {
				display: true,
				size : [100,100],
				wrapper : '#custom-preview-wrapper'
			}
		});
	  
	}
	$('#proEditImg img').on('rcrop-changed', function(){
		var srcOriginal = $(this).rcrop('getDataURL');
		var srcResized = $(this).rcrop('getDataURL', 50,50);
		var userId = "{{ session()->get('jcmUser')->userId }}";
		$('.img-target').attr('src',srcOriginal);
		//test:
		var blob = dataURLtoBlob(srcOriginal);
		var imagelink = $('#proEditImg img').attr('src');

		/*blobToDataURL(blob, function(dataurl){
			console.log(dataurl);
		});*/
		var fd = new FormData();
		fd.append('profileImage', blob);
		fd.append('_token', "{{ csrf_token() }}");
		fd.append('userId', userId);
		fd.append('imagelink', imagelink);
		$.ajax({
			type: 'POST',
			url: '{{ url("cropProfileImage") }}',
			data: fd,
			processData: false,
			contentType: false
		}).done(function(data) {
			   console.log(data);
		});
		
	});
	function removeResumePic(){
	   var userId = $('#userID').val();
	   //alert(userId);
	   $.ajax({
		url:'{{ url("account/manage/removeProPic") }}',
		data:{userId:userId,_token:'{{ csrf_token() }}'},
		type:'POST',
		success:function(res){
			if(res == 1){
				toastr.success('Profile Pic Remove');
				$('.img-target').attr('src','{{ asset("profile-photos/profile-logo.jpg") }}');
			}
		}
	   });
	}
 function editResumeChatPic(){
		var proImg = $('.chat-img-target').attr('src');
	   $('#editchatModel').modal('show');
	   $('#editchatModel #proEditImg img').attr('src',proImg);
	   $('#editchatModel #proEditImg img').rcrop({
			minSize : [100,100],
			preserveAspectRatio : true,
			
			preview : {
				display: true,
				size : [100,100],
				wrapper : '#custom-preview-wrapper'
			}
		});
	  
	}
	$('#editchatModel #proEditImg img').on('rcrop-changed', function(){
		var srcOriginal = $(this).rcrop('getDataURL');
		var srcResized = $(this).rcrop('getDataURL', 50,50);
		var userId = "{{ session()->get('jcmUser')->userId }}";
		$('.chat-img-target').attr('src',srcOriginal);
		//test:
		var blob = dataURLtoBlob(srcOriginal);
		var imagelink = $('#editchatModel #proEditImg img').attr('src');

		/*blobToDataURL(blob, function(dataurl){
			console.log(dataurl);
		});*/
		var fd = new FormData();
		fd.append('profileImage', blob);
		fd.append('_token', "{{ csrf_token() }}");
		fd.append('userId', userId);
		fd.append('imagelink', imagelink);
		$.ajax({
			type: 'POST',
			url: '{{ url("cropProfileImage") }}',
			data: fd,
			processData: false,
			contentType: false
		}).done(function(data) {
			   console.log(data);
		});
		
	});
	$('#editProResumeModel #proEditImg img').on('rcrop-changed', function(){
		var srcOriginal = $(this).rcrop('getDataURL');
		var srcResized = $(this).rcrop('getDataURL', 50,50);
		var userId = "{{ session()->get('jcmUser')->userId }}";
		$('.img-target').attr('src',srcOriginal);
		//test:
		var blob = dataURLtoBlob(srcOriginal);
		var imagelink = $('#editProResumeModel #proEditImg img').attr('src');

		/*blobToDataURL(blob, function(dataurl){
			console.log(dataurl);
		});*/
		var fd = new FormData();
		fd.append('profileImage', blob);
		fd.append('_token', "{{ csrf_token() }}");
		fd.append('userId', userId);
		fd.append('imagelink', imagelink);
		$.ajax({
			type: 'POST',
			url: '{{ url("cropProfileImage") }}',
			data: fd,
			processData: false,
			contentType: false
		}).done(function(data) {
			   console.log(data);
		});
		
	});
	function removeResumePic(req){
	   var userId = $('#userID').val();
	   //alert(userId);
	   var data;
	   if(req == 'chat'){
		 data = {userId:userId,_token:'{{ csrf_token() }}',chat:'yes'};
	   }
	   if(req == 'profile'){
		data = {userId:userId,_token:'{{ csrf_token() }}'};
	   }
	   $.ajax({
		url:'{{ url("account/manage/removeProPic") }}',
		data:data,
		type:'POST',
		success:function(res){
			if(res == 1){
				toastr.success('Profile Pic Remove');
				if(req == 'chat'){
				$('.chat-img-target').attr('src','{{ asset("profile-photos/profile-logo.jpg") }}');
				} 
				if(req == 'profile'){
				$('.img-target').attr('src','{{ asset("profile-photos/profile-logo.jpg") }}');
				}   
			}
		}
	   });
	}
</script>



<script src="{{ asset('frontend-assets/js/jquery-address.min.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAE8bSbiIU4MWVBb9f9de-tzX5qg7YPw6g"></script>
<script src="{{ asset('frontend-assets/js/jquery.ui.addresspicker.js') }}"></script>
<script>
jQuery(function() {
	var addresspicker = jQuery( "#Address" ).addresspicker({
		
	});
	jQuery('#reverseGeocode').change(function(){
	  jQuery("#addresspicker_map").addresspicker("option", "reverseGeocode", (jQuery(this).val() === 'true'));
	});
	function showCallback(geocodeResult, parsedGeocodeResult){
	  jQuery('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
	}
});
</script>



@endsection