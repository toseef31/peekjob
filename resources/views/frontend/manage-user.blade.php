@extends('frontend.layouts.app')

@section('title', 'Manage')

@section('content')
<?php
$userImage = url('profile-photos/profile-logo.jpg');

if($user->profilePhoto != ''){
    $userImage = url('profile-photos/'.$user->profilePhoto);
}
?>
<section id="jobs" style="margin-bottom:70px">
    <div class="container">
        <div class="follow-companies6" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px">@lang('home.manage')</h3>
				</div>

		
        <!-- Mobile View -->
        <div class="col-md-2 jobApp-tabs2 jobMblTabs">
            <h5 class="mtab-heading">@lang('home.account')</h5>
            <ul class="jobMblTabs">
                <ul class="nav nav-tabs jobMblTabs">
                    <li>
                        <a id="password" class="mblTabBtn nav-tab-active" data-toggle="tab" href="#password" role="tab" aria-controls="password">@lang('home.changepassword')</a>
                    </li>
                    <li>
                        <a id="profile" class=" mblTabBtn" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">@lang('home.editprofile')</a>
                    </li>
                    <li>
                        <a id="notification" class="mblTabBtn" data-toggle="tab" href="#notification" role="tab" aria-controls="notification">@lang('home.notification')</a>
                    </li>
                    <li>
                        <a id="privacy" class="mblTabBtn" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy">@lang('home.p_privacy')</a>
                    </li>
                </ul>
                <h5 class="mtab-heading">@lang('home.organization')</h5>
                <ul class="nav nav-tabs jobMblTabs">
                    <li>
                        <a href="{{ url('account/employer/departments') }}" class="">@lang('home.departments')</a>
                    </li>
                    <li>
                        <a href="{{ url('account/employer/organization') }}" class=" ext-link">@lang('home.editorganization')</a>
                    </li>
                    <li>
                        <a href="{{ url('account/employer/interview-venues/') }}" class="  ext-link">@lang('home.interviewvenues')</a>
                    </li>
                    <li>
                        <a href="{{ url('account/employer/users/') }}" class=" ext-link">@lang('home.users')</a>
                    </li>
                    <li>
                        <a href="{{ url('account/employer/addevaluation/') }}" class="  ext-link">@lang('home.evaluationforms')</a>
                    </li>
                    <li>
                        <a href="{{ url('account/employer/questionnaires') }}" class=" ext-link">@lang('home.questionnaires')</a>
                    </li>
                </ul>

                <a class="btn btn-block jaTabBtn">Users{{$user->userId}}</a>
                <a class="btn btn-block jaTabBtn">Evaluation Form</a>
                <a class="btn btn-block jaTabBtn">Questionnaires</a>
                <h5 class="mtab-heading" id="credit_plan">@lang('home.subscription')</h5>
                <ul class="nav nav-tabs jobMblTabs">
                    <li>
                        <a id="credit" class="mblTabBtn" data-toggle="tab" href="#credit" role="tab" aria-controls="credit">@lang('home.credits')</a>
                    </li>
                    <li>
                        <a href="{{ url('account/employer/orders') }}" class="  ext-link">@lang('home.orders')</a>
                    </li>
                </ul>
                
                <h5 class="mtab-heading">@lang('home.deactivation')</h5>
                <ul class="nav nav-tabs jobMblTabs">
                    <li>
                        <a class="btn btn-block" data-popup-open="popup-1" style="margin-bottom:10px">@lang('home.deactivateaccount')</a>
                    </li>
                </ul>
            </ul>
        
            <h5 class="mtab-heading"><img src="/frontend-assets/images/manage_icon1.png" style="padding-top:0px; width: 16%;"><span style="padding-left:10px;font-size:15px;">@lang('home.account')</span></h5>
            <a id="password" class="btn btn-block jaTabBtn ja-tab-active"><img src="/frontend-assets/images/manage_icon2.png" style="padding-top:0px"> @lang('home.changepassword')</a>
            <a id="profile" class="btn btn-block jaTabBtn"><img src="/frontend-assets/images/manage_icon3.png" style="padding-top:0px"> @lang('home.editprofile')</a>
            <a id="notification" class="btn btn-block jaTabBtn"><img src="/frontend-assets/images/manage_icon4.png" style="padding-top:0px"> @lang('home.notification')</a>
            <a id="privacy" class="btn btn-block jaTabBtn"><img src="/frontend-assets/images/manage_icon5.png" style="padding-top:0px"> @lang('home.p_privacy')</a>
            <!-- <h5 class="mtab-heading"><img src="/frontend-assets/images/manage_icon6.png" style="padding-top:0px"><span style="padding-left:10px;font-size:15px;">@lang('home.organization')</span></h5>
            <a href="{{ url('account/employer/departments') }}" class="btn btn-block jaTabBtn"><img src="/frontend-assets/images/manage_icon7.png" style="padding-top:0px"> @lang('home.departments')</a>
            <a href="{{ url('account/employer/organization') }}" class="btn btn-block jaTabBtn ext-link"><img src="/frontend-assets/images/manage_icon8.png" style="padding-top:0px"> @lang('home.editorganization')</a>
            <a href="{{ url('account/employer/interview-venues/') }}" class="btn btn-block jaTabBtn ext-link"><img src="/frontend-assets/images/manage_icon9.png" style="padding-top:0px"> @lang('home.interviewvenues')</a>
			<a href="{{ url('account/employer/users/') }}" class="btn btn-block jaTabBtn ext-link">@lang('home.users')</a>
			<a href="{{ url('account/employer/addevaluation/') }}" class="btn btn-block jaTabBtn ext-link">@lang('home.evaluationforms')</a>
			<a href="{{ url('account/employer/questionnaires') }}" class="btn btn-block jaTabBtn ext-link">@lang('home.questionnaires')</a> -->

            <!-- <a class="btn btn-block jaTabBtn">Users</a>
            <a class="btn btn-block jaTabBtn">Evaluation Form</a>
            <a class="btn btn-block jaTabBtn">Questionnaires</a> -->
			<h5 class="mtab-heading"><img src="/frontend-assets/images/manage_icon13.png" style="padding-top:0px">@lang('home.subscription')</h5>
			<a id="credit" class="btn btn-block jaTabBtn "><img src="/frontend-assets/images/manage_icon14.png" style="padding-top:0px">@lang('home.credits')</a>
			<a href="{{ url('account/employer/orders') }}" class="btn btn-block jaTabBtn ext-link"><img src="/frontend-assets/images/manage_icon15.png" style="padding-top:0px">@lang('home.orders')</a>
			
			
            <h5 class="mtab-heading"><img src="/frontend-assets/images/manage_icon16.png" style="padding-top:0px">@lang('home.deactivation')</h5>
            <a class="btn btn-block" data-popup-open="popup-1" style="margin-bottom:10px"><img src="/frontend-assets/images/manage_icon17.png" style="padding-top:0px">@lang('home.deactivateaccount')</a>
        </div>
        <div class="col-md-10">
            <div class="tab-content">
                <div class="ja-content">
                    <!--Change Password-->
                    <div id="password-show" class="ja-content-item mc-item" role="tabpanel">
                        <h4>@lang('home.changepassword')</h4>
                        <form class="form-horizontal password-form" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.oldpassword')</label>
                                <div class="col-md-6">
                                    <input type="password" name="oldPassword" class="form-control input-sm" placeholder="@lang('home.oldpassword')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.newpassword')</label>
                                <div class="col-md-6">
                                    <input type="password" name="password" onblur="sendpassword(this.value)" class="form-control input-sm" placeholder="@lang('home.newpassword')">
                                <p style="color:red" id="erpass"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.confirmpassword')</label>
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" class="form-control input-sm" placeholder="@lang('home.confirmpassword')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button id="passbtn" class="btn btn-primary btn-block" type="submit" name="save">@lang('home.save')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- credits -->
                    <div id="credit-show" class="ja-content-item mc-item" role="tabpanel" style="display: none">
                        <h4>@lang('home.employerAccount')</h4>
                        <table class="table">
							<tr>
                             <form action="{{ action('frontend\Employer@package') }}" method="post">
                              {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit2.png" style="padding-top:0px"> &nbsp;@lang('home.Resume Downloads')</td>
                                <input type="hidden" value="Resume Download" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                            <tr>
                            <form action="{{ action('frontend\Employer@package') }}" method="post">
                            {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit1.png" style="padding-top:0px"> @lang('home.Premium Jobs')</td>
                                <input type="hidden" value="Premium" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                             <tr>
                             <form action="{{ action('frontend\Employer@package') }}" method="post">
                              {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit1.png" style="padding-top:0px"> @lang('home.Top Jobs')</td>
                                <input type="hidden" value="Top" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                             <tr>
                            <form action="{{ action('frontend\Employer@package') }}" method="post">
                             {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit1.png" style="padding-top:0px"> @lang('home.Hot Jobs')</td>
                                <input type="hidden" value="Hot" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                             <tr>
                            <form action="{{ action('frontend\Employer@package') }}" method="post">
                             {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit1.png" style="padding-top:0px"> @lang('home.Latest Jobs')</td>
                                <input type="hidden" value="Latest" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                            <tr>
                             <form action="{{ action('frontend\Employer@package') }}" method="post">
                              {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit1.png" style="padding-top:0px"> @lang('home.Special Jobs')</td>
                                <input type="hidden" value="Special" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                            <tr>
                             <form action="{{ action('frontend\Employer@package') }}" method="post">
                              {!! csrf_field() !!} 
                                <td> <img src="/frontend-assets/images/manage_credit1.png" style="padding-top:0px"> @lang('home.Goldan Jobs')</td>
                                <input type="hidden" value="Goldan" name="type">
                                <td><input type="submit" class="btn btn-info" style value="@lang('home.Buy Now')"></td>
                                </form>
                            </tr>
                            
                        </table>
                    </div>
                    <!--Edit Profile-->
                    <div id="profile-show" class="ja-content-item mc-item" role="tabpanel" style="display: none">
                        <h4>@lang('home.editprofile')</h4>
                        <form class="form-horizontal profile-form">
                            <input type="hidden" name="_token" value="">
                            <div class="form-group">
                                 <label class="control-label col-md-3 text-right">@lang('home.profilephoto')</label>
                                <div class="col-md-6 text-center">
                                    <div class="re-img-box">
                                        <img src="{{ $userImage }}">
                                        <div class="re-img-toolkit">
                                            <div class="mc-file-btn">
                                                 <i class="fa fa-camera"></i>&nbsp;@lang('home.change')
                                                <input class="upload profile-pic" name="image" type="file" onchange="changeProfile()">
                                            </div>
                                            <div style="color:white;padding-left:42px;cursor: pointer;" onclick="editpic()">
                                                 <i class="fa fa-pencil"></i> @lang('home.Edit')
                                            </div>
                                            <div style="color:white;text-align: center;cursor: pointer;" onclick="removepic()">
                                                 <i class="fa fa-remove"></i> @lang('home.remove')
                                                 <input type="hidden" name="userID" id="userID" value="{{ Session::get('jcmUser')->userId }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.name')</label>
                                <div class="col-md-6">
                                    <div class="col-md-6 f-name" style="margin-bottom: 5px;padding-left: 0px;">
                                        <input type="text" class="form-control input-sm" name="firstName" value="{{ $user->firstName }}">
                                    </div>
                                    <div class="col-md-6 l-name" style="margin-bottom: 5px;padding-right: 0px;">
                                        <input type="text" class="form-control input-sm" name="lastName" value="{{ $user->lastName }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.email')</label>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control input-sm" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.phonenumber')</label>
                                <div class="col-md-6">                          
                                    <div class="ph-nmbr" style="padding-right: 0px;">
                                        <input type="text" name="phoneNumber" class="form-control inpu<option>t-sm" value="{{ $user->phoneNumber }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.address')</label>
                                <div class="col-md-6">
                                    <textarea name="address" class="form-control input-sm">{{ $meta->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.country')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-country" name="country" required>
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->id }}" {{ $user->country == $cntry->id ? 'selected="selected"' : ''}}>@lang('home.'.$cntry->name)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.state')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-state" name="state" data-state="{{ $user->state }}" required></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.city')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-city" name="city" data-city="{{ $user->city }}" required></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block" type="submit" name="save">@lang('home.save')</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--Notification-->
                    <div id="notification-show" class="ja-content-item mc-item" role="tabpanel" style="display: none;">
                        <form class="form-horizontal notification-form" method="post" action="">
                            <h4>@lang('home.account')</h4>
                            <input type="hidden" name="_token" value="">
                            <div class="form-group">
                                <div class="col-md-12 mc-notification">
                                    <label class="col-md-3 control-label">@lang('home.servicealerts')</label>
                                    <div class="col-md-9">
                                        <p style="margin-top: 4px">
                                            <input type="checkbox" id="service-alert" class="switch-field" name="serviceAlert" {{ $noti->serviceAlert == 'Yes' ? 'checked=""' : '' }} >
                                            <label for="service-alert" class="switch-label"><span class="ui"></span></label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 mc-notification">
                                    <label class="col-md-3 control-label">@lang('home.messages')</label>
                                    <div class="col-md-9">
                                        <p style="margin-top: 4px">
                                            <input type="checkbox" id="message-alert" class="switch-field" name="messageAlert" {{ $noti->messageAlert == 'Yes' ? 'checked=""' : '' }}>
                                            <label for="message-alert" class="switch-label"><span class="ui"></span></label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <h4>@lang('home.employeraccount')</h4>
                            <div class="form-group">
                                <div class="col-md-12 mc-notification">
                                    <label class="col-md-3 control-label">@lang('home.newapplications')</label>
                                    <div class="col-md-9">
                                        <p style="margin-top: 4px">
                                            <input type="checkbox" id="new-application" class="switch-field" name="newApplication" {{ $noti->newApplication == 'Yes' ? 'checked=""' : '' }}>
                                            <label for="new-application" class="switch-label"><span class="ui"></span></label>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 mc-notification">
                                    <label class="col-md-3 control-label">@lang('home.closingjobs')</label>
                                    <div class="col-md-9">
                                        <p style="margin-top: 4px">
                                            <input type="checkbox" id="closing-jobs" class="switch-field" name="closingJobs" {{ $noti->closingJobs == 'Yes' ? 'checked=""' : '' }}>
                                            <label for="closing-jobs" class="switch-label"><span class="ui"></span></label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <h4>@lang('home.jobalerts')</h4>
                            <div class="col-md-12 mc-notification">
                                <label class="col-md-3 control-label">@lang('home.dailyalerts')</label>
                                <div class="col-md-9">
                                    <p style="margin-top: 4px">
                                        <input type="checkbox" id="job-alert" class="switch-field" name="jobAlert" {{ $noti->jobAlert == 'Yes' ? 'checked=""' : '' }}>
                                        <label for="job-alert" class="switch-label"><span class="ui"></span></label>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">@lang('home.country')</label>
                                <div class="col-md-9">
                                    <select class="form-control input-sm mc-field  job-country" name="country">
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->id }}" {{ $noti->country == $cntry->id ? 'selected="selected"' : ''}}>@lang('home.'.$cntry->name)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">@lang('home.state')</label>
                                <div class="col-md-9">
                                    <select class="form-control input-sm mc-field job-state" name="state" data-state="{{ $noti->state }}">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">@lang('home.city')</label>
                                <div class="col-md-9">
                                    <select class="form-control input-sm mc-field job-city" name="city" data-city="{{ $noti->city }}">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">@lang('home.category')</label>
                                <div class="col-md-9">
                                    <select class="form-control input-sm mc-field" name="category">
                                        @foreach(JobCallMe::getCategories() as $cat)
                                            <option value="{{ $cat->categoryId }}" {{ $noti->category == $cat->categoryId ? 'selected="selected"' : '' }}>@lang('home.'.$cat->name)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--privacy-->
                    <div id="privacy-show" class="ja-content-item mc-item" role="tabpanel" style="display: none;">
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
                                    <input type="checkbox" id="image-visible" class="switch-field" name="profileImage" {{ $privacy->profileImage != 'No' ? 'checked=""' : '' }}>
                                    <label for="image-visible" class="switch-label"></label> <span>@lang('home.picturevisible')</span>
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
                                    <input type="checkbox" id="dateofbirth-visible" class="switch-field" name="dateofbirth" {{ $privacy->dateofbirth != 'No' ? 'checked=""' : '' }}>
                                    <label for="dateofbirth-visible" class="switch-label"></label> <span>@lang('home.birthvisible')</span>
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
                            <!-- add two extra category 2/23/2018 -->
                            <div class="col-md-12">
                                <p style="margin-top: 4px">
                                    <input type="checkbox" id="project-visible" class="switch-field" name="projectVisible" {{ $privacy->projectVisible != 'No' ? 'checked=""' : '' }}>
                                    <label for="project-visible" class="switch-label"></label> <span>@lang('home.projectVisible')</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p style="margin-top: 4px">
                                    <input type="checkbox" id="publications-visible" class="switch-field" name="publicationsVisible" {{ $privacy->publicationsVisible != 'No' ? 'checked=""' : '' }}>
                                    <label for="publications-visible" class="switch-label"></label> <span>@lang('home.publicationsvisible')</span>
                                </p>
                            </div>
                        </form>
                    </div>

                    <!--Deactivate account-->
                    <div class="popup" data-popup="popup-1">
                        <div class="popup-inner">
                            <h4>@lang('home.deactivateaccount')</h4>
                            <p>@lang('home.warningdeactive')</p>
                            <button href="#" onclick="deactive({{session()->get('jcmUser')->userId}})" class="btn btn-danger">@lang('home.yesdeactive')</button>
                            <button class="btn btn-default" data-popup-close="popup-1" >@lang('home.close')</button>
                            <a class="popup-close" data-popup-close="popup-1" href="#">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div id="editProModel" class="modal fade" role="dialog">
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
.text-danger{color: #ff0000 !important;}
</style>
<script type="text/javascript">
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
    function editpic(){
        var proImg = $('.img-circle').attr('src');
       $('#editProModel').modal('show');
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
        $('.img-circle').attr('src',srcOriginal);
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
        /*$.ajax({
            url:'{{ url("cropProfileImage") }}',
            type:'POST',
            data:{profileImage:blob,_token:"{{ csrf_token() }}",userId:userId},
            success:function(res){
                console.log(res);
            }

        });*/
        
        /*$('#cropped-resized').append('<img src="'+srcResized+'">');*/
    });
    function removepic(){
       var userId = $('#userID').val();
       //alert(userId);
       $.ajax({
        url:'{{ url("account/manage/removeProPic") }}',
        data:{userId:userId,_token:'{{ csrf_token() }}'},
        type:'POST',
        success:function(res){
            if(res == 1){
                toastr.success('Profile Pic Remove');
                $('.img-circle').attr('src','{{ asset("profile-photos/profile-logo.jpg") }}');
            }
        }
       });
    }
var pageToken = '{{ csrf_token() }}';
$(document).ready(function(){

	 var url = window.location.href;
    // alert(url);
    var id = url.substring(url.lastIndexOf('?') + 1);
	//alert(id);
	if(id=='noti'){
        $('#notification').addClass( "ja-tab-active" );
        $('#password').removeClass( "ja-tab-active" );
        $('#notification-show').show();
        $('#password-show').hide();
	}

    if(id=='plan'){
        $('#credit_plan').addClass( "ja-tab-active" );
        $('li #password').removeClass( "ja-tab-active" );
        $('#credit-show').show();
        $('#password-show').hide();
    }

	if(id=='profiles'){
        $('#profile').addClass( "ja-tab-active" );
        $('li #password').removeClass( "ja-tab-active" );
        $('#profile-show').show();
        $('#password-show').hide();
	}
    getStates($('.job-country option:selected:selected').val(),'job-state');
    getStates($('.job-country option:selected:selected').val(),'jjob-state');
})
$(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

        e.preventDefault();
    });

    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

        e.preventDefault();
    });
});
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId,'job-state')
})
$('.jjob-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId,'jjob-state')
})
function getStates(countryId,cType){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.'+cType).attr('data-state');
            var obj = $.parseJSON(response);
            $('.'+cType).html('');
            var newOption = new Option('Select State', '0', true, false);
            $('.'+cType).append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $('.'+cType).append(newOption);
            })
            $('.'+cType).trigger('change');
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId,'job-city');
})
$('.jjob-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId,'jjob-city');
})
function getCities(stateId,cType){
    if(stateId == '0'){
        $('.'+cType).html('').trigger('change');
        var newOption = new Option('Select City', '0', true, false);
        $('.'+cType).append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.'+cType).attr('data-city');
            var obj = $.parseJSON(response);
            $('.'+cType).html('').trigger('change');
            var newOption = new Option('Select City', '0', true, false);
            $('.'+cType).append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $('.'+cType).append(newOption).trigger('change');
            })
        }
    })
}
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
function changeProfile(){

    var formData = new FormData();
    formData.append('profilePicture', $(".profile-pic")[0].files[0]);
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
                $('img.img-circle').attr('src',response);
            }else{
                toastr.error('Following format allowed (PNG/JPG/JPEG)', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    });
};

$('.mblTabBtn').click(function () {
    $(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
    if($(this).hasClass('ext-link')){
    }else{
        $('.ja-content-item').hide();
        $("#"+$(this).attr("id")+"-show").fadeIn();
        if($(this).attr('id') == 'password'){
            $('.password-form').find('.text-danger').remove();
            $('.password-form input').val('');
        }
    }
});

$('.jaTabBtn').click(function () {
    $(this).addClass('ja-tab-active').siblings().removeClass('ja-tab-active');
    if($(this).hasClass('ext-link')){
    }else{
        $('.ja-content-item').hide();
        $("#"+$(this).attr("id")+"-show").fadeIn();
        if($(this).attr('id') == 'password'){
            $('.password-form').find('.text-danger').remove();
            $('.password-form input').val('');
        }
    }
});
$('form.password-form').submit(function(e){
    $('.password-form input[name="_token"]').val(pageToken);
    $('.password-form button[name="save"]').prop('disabled',true);
    $('.password-form').find('.text-danger').remove();
    $.ajax({
        type: 'post',
        data: $('.password-form').serialize(),
        url: "{{ url('account/password/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                var vParent = $('.password-form input[name="oldPassword"]').parent();
                vParent.append('<p class="text-danger">'+response+'</p>');
            }else{
                toastr.success('@lang("home.Password Updated")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
            $('.password-form button[name="save"]').prop('disabled',false);
        },
        error: function(data){
            var errors = data.responseJSON;
            $.each(errors, function(i,k){
                var vParent = $('.password-form input[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
            })
            $('.password-form button[name="save"]').prop('disabled',false);
        }
		
    })
    e.preventDefault();
})
$('form.profile-form').submit(function(e){
    $('.profile-form button[name="save"]').prop('disabled',true);
    $('.profile-form input[name="_token"]').val(pageToken);
    $('.profile-form').find('.text-danger').remove();
    $.ajax({
        type: 'post',
        data: $('.profile-form').serialize(),
        url: "{{ url('account/profile/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                var vParent = $('.profile-form input[name="email"]').parent();
                vParent.append('<p class="text-danger">'+response+'</p>');
            }else{
                toastr.success('@lang("home.Profile Updated")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
            $('.profile-form button[name="save"]').prop('disabled',false);
        },
        error: function(data){
            var errors = data.responseJSON;
            $.each(errors, function(i,k){
                if(i == 'city'){
                    var vParent = $('.profile-form select[name="'+i+'"]').parent();
                }else if(i == 'address'){
                    var vParent = $('.profile-form textarea[name="'+i+'"]').parent();
                }else{
                    var vParent = $('.profile-form input[name="'+i+'"]').parent();
                }
                vParent.append('<p class="text-danger">'+k+'</p>');
            })
            $('.profile-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
$('form.notification-form').submit(function(e){
    $('.notification-form button[name="save"]').prop('disabled',true);
    $('.notification-form input[name="_token"]').val(pageToken);
    $.ajax({
        type: 'post',
        data: $('.notification-form').serialize(),
        url: "{{ url('account/notification/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }else{
                toastr.success('@lang("home.Updated")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
            $('.notification-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
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
function deactive(id){
    var postURL = "{{ url('deactiveUser')}}";
    var usertoken = "{{ csrf_token() }}";
    $.ajax({
        url:postURL,
        data:{id:id,_token:usertoken},
        type:"POST",
        success:function(res){
            if(res ==1){
                window.location.href ='login';
            }
            else{
                alert(res);
            }
        }

    });
    
}
function sendpassword(pass){
    alert("hello");
 $.ajax({
    url:"{{ url('passwordValidate') }}",
    data:{password:pass,_token:"{{ csrf_token() }}"},
    type:"post",
    success:function(res){
        if(res == 1){
            $('#erpass').text("@lang('home.passwordway')");
            $('#passbtn').attr('disabled','disabled');
        }else{
            $('#erpass').text(" ");
            $('#passbtn').removeAttr('disabled');
        }
       
    }
 });
}
</script>
@endsection