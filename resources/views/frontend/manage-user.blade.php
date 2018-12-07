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
        <div class="col-md-2 jobApp-tabs2 jobMblTabs hidden-sm hidden-md hidden-lg">
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
                <!-- <h5 class="mtab-heading">@lang('home.organization')</h5>
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
                </ul> -->
                <!-- <a class="btn btn-block jaTabBtn">Users</a>
                <a class="btn btn-block jaTabBtn">Evaluation Form</a>
                <a class="btn btn-block jaTabBtn">Questionnaires</a> -->
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
        </div>
        <!-- End Mobile View -->

        <div class="col-md-2 jobApp-tabs hidden-xs">
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
                        <form class="form-horizontal profile-form" method="post" action="">
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
                                    <div class="col-md-6 mb-nmbr" style="padding-left: 0px; margin-bottom: 5px;">
                                        <select class="form-control">
                                            <option>South Korea (+82)</option>
											<option>Afghanistan (+93)</option>
                                            <option>Albania (+355)</option>
                                            <option>Algeria (+213)</option>
                                            <option>American Samoa (+1684)</option>
                                            <option>Andorra (+376)</option>
                                            <option>Angola (+244)</option>
                                            <option>Anguilla (+1264)</option>
                                            <option>Antarctica (+672)</option>
                                            <option>Antigua and Barbuda (+1268)</option>
                                            <option>Argentina (+54)</option>
                                            <option>Armenia (+374)</option>
                                            <option>Aruba (+297)</option>
                                            <option>Australia (+61)</option>
                                            <option>Austria (+43)</option>
                                            <option>Azerbaijan (+994)</option>
                                            <option>Bahamas (+1242)</option>
                                            <option>Bahrain (+973)</option>
                                            <option>Bangladesh (+880)</option>
                                            <option>Barbados (+1246)</option>
                                            <option>Belarus (+375)</option>
                                            <option>Belgium (+32)</option>
                                            <option>Belize (+501)</option>
                                            <option>Benin (+229)</option>
                                            <option>Bermuda (+1441)</option>
                                            <option>Bhutan (+975)</option>
                                            <option>Bolivia (+591)</option>
                                            <option>Bosnia and Herzegovina (+387)</option>
                                            <option>Botswana (+267)</option>
                                            <option>Bouvet Island (+47)</option>
                                            <option>Brazil (+55)</option>
                                            <option>British Indian Ocean Territories (+246)</option>
                                            <option>Brunei Darussalam (+673)</option>
                                            <option>Bulgaria (+359)</option>
                                            <option>Burkina Faso (+226)</option>
                                            <option>Burundi (+257)</option>
                                            <option>Cambodia (+855)</option>
                                            <option>Cameroon (+237)</option>
                                            <option>Canada (+1)</option>
                                            <option>Cape Verde (+238)</option>
                                            <option>Cayman Islands (+1345)</option>
                                            <option>Central African Republic (+236)</option>
                                            <option>Chad (+235)</option>
                                            <option>Chile (+56)</option>
                                            <option>China, People's Republic of (+86)</option>
                                            <option>Christmas Island (+61)</option>
                                            <option>Cocos Islands (+61)</option>
                                            <option>Colombia (+57)</option>
                                            <option>Comoros (+269)</option>
                                            <option>Congo (+243)</option>
                                            <option>Cook Islands (+682)</option>
                                            <option>Costa Rica (+506)</option>
                                            <option>Cote D'ivoire (+225)</option>
                                            <option>Croatia (+385)</option>
                                            <option>Cuba (+53)</option>
                                            <option>Cyprus (+357)</option>
                                            <option>Czech Republic (+420)</option>
                                            <option>Denmark (+45)</option>
                                            <option>Djibouti (+253)</option>
                                            <option>Dominica (+1767)</option>
                                            <option>Dominican Republic (+1809)</option>
                                            <option>East Timor (+670)</option>
                                            <option>Ecuador (+593)</option>
                                            <option>Egypt (+20)</option>
                                            <option>El Salvador (+503)</option>
                                            <option>Equatorial Guinea (+240)</option>
                                            <option>Eritrea (+291)</option>
                                            <option>Estonia (+372)</option>
                                            <option>Ethiopia (+251)</option>
                                            <option>Falkland Islands (+500)</option>
                                            <option>Faroe Islands (+298)</option>
                                            <option>Fiji (+679)</option>
                                            <option>Finland (+358)</option>
                                            <option>France (+33)</option>
                                            <option>France, Metropolitan (+33)</option>
                                            <option>French Guiana (+594)</option>
                                            <option>French Polynesia (+689)</option>
                                            <option>French Southern Territories (+33)</option>
                                            <option>FYROM (+389)</option>
                                            <option>Gabon (+241)</option>
                                            <option>Gambia (+220)</option>
                                            <option>Georgia (+995)</option>
                                            <option>Germany (+49)</option>
                                            <option>Ghana (+233)</option>
                                            <option>Gibraltar (+350)</option>
                                            <option>Greece (+30)</option>
                                            <option>Greenland (+299)</option>
                                            <option>Grenada (+1473)</option>
                                            <option>Guadeloupe (+590)</option>
                                            <option>Guam (+1671)</option>
                                            <option>Guatemala (+502)</option>
                                            <option>Guinea (+224)</option>
                                            <option>Guinea-Bissau (+245)</option>
                                            <option>Guyana (+592)</option>
                                            <option>Haiti (+509)</option>
                                            <option>Heard Island And Mcdonald Islands (+61)</option>
                                            <option>Honduras (+504)</option>
                                            <option>Hong Kong (+852)</option>
                                            <option>Hungary (+36)</option>
                                            <option>Iceland (+354)</option>
                                            <option>India (+91)</option>
                                            <option>Indonesia (+62)</option>
                                            <option>Iran (+98)</option>
                                            <option>Iraq (+964)</option>
                                            <option>Ireland (+353)</option>
                                            <option>Israel (+972)</option>
                                            <option>Italy (+39)</option>
                                            <option>Jamaica (+1876)</option>
                                            <option>Japan (+81)</option>
                                            <option>Jordan (+962)</option>
                                            <option>Kazakhstan (+7)</option>
                                            <option>Kenya (+254)</option>
                                            <option>Kiribati (+686)</option>  
                                            <option>Kuwait (+965)</option>
                                            <option>Kyrgyzstan (+996)</option>
                                            <option>Lao Peoples Democratic Republic (+856)</option>
                                            <option>Latvia (+371)</option>
                                            <option>Lebanon (+961)</option>
                                            <option>Lesotho (+266)</option>
                                            <option>Liberia (+231)</option>
                                            <option>Libyan Arab Jamahiriya (+218)</option>
                                            <option>Liechtenstein (+423)</option>
                                            <option>Lithuania (+370)</option>
                                            <option>Luxembourg (+352)</option>
                                            <option>Macau (+853)</option>
                                            <option>Madagascar (+261)</option>
                                            <option>Malawi (+265)</option>
                                            <option>Malaysia (+60)</option>
                                            <option>Maldives (+960)</option>
                                            <option>Mali (+223)</option>
                                            <option>Malta (+356)</option>
                                            <option>Marshall Islands (+692)</option>
                                            <option>Martinique (+596)</option>
                                            <option>Mauritania (+222)</option>
                                            <option>Mauritius (+230)</option>
                                            <option>Mayotte (+262)</option>
                                            <option>Mexico (+52)</option>
                                            <option>Micronesia (+691)</option>
                                            <option>Moldova (+373)</option>
                                            <option>Monaco (+377)</option>
                                            <option>Mongolia (+976)</option>
                                            <option>Montserrat (+1664)</option>
                                            <option>Morocco (+212)</option>
                                            <option>Mozambique (+258)</option>
                                            <option>Myanmar (+95)</option>
                                            <option>Namibia (+264)</option>
                                            <option>Nauru (+674)</option>
                                            <option>Nepal (+977)</option>
                                            <option>Netherlands (+31)</option>
                                            <option>Netherlands Antilles (+599)</option>
                                            <option>New Caledonia (+687)</option>
                                            <option>New Zealand (+64)</option>
                                            <option>Nicaragua (+505)</option>
                                            <option>Niger (+227)</option>
                                            <option>Nigeria (+234)</option>
                                            <option>Niue (+683)</option>
                                            <option>Norfolk Island (+672)</option>
                                            <option>Northern Mariana Islands (+1670)</option>
                                            <option>Norway (+47)</option>
                                            <option>Oman (+968)</option>
                                            <option>Pakistan (+92)</option>
                                            <option>Palau (+680)</option>
                                            <option>Panama (+507)</option>
                                            <option>Papua New Guinea (+675)</option>
                                            <option>Paraguay (+595)</option>
                                            <option>Peru (+51)</option>
                                            <option>Philippines (+63)</option>
                                            <option>Pitcairn (+870)</option>
                                            <option>Poland (+48)</option>
                                            <option>Portugal (+351)</option>
                                            <option>Puerto Rico (+1)</option>
                                            <option>Qatar (+974)</option>
                                            <option>Reunion (+262)</option>
                                            <option>Romania (+40)</option>
                                            <option>Russian Federation (+7)</option>
                                            <option>Rwanda (+250)</option>
                                            <option>Saint Helena (+290)</option>
                                            <option>Saint Kitts and Nevis (+1869)</option>
                                            <option>Saint Lucia (+1758)</option>
                                            <option>Saint Pierre and Miquelon (+508)</option>
                                            <option>Saint Vincent and The Grenadines (+1784)</option>
                                            <option>Samoa (+685)</option>
                                            <option>San Marino (+378)</option>
                                            <option>Sao Tome and Principe (+239)</option>
                                            <option>Saudi Arabia (+966)</option>
                                            <option>Senegal (+221)</option>
                                            <option>Seychelles (+248)</option>
                                            <option>Sierra Leone (+232)</option>
                                            <option>Singapore (+65)</option>
                                            <option>Slovakia (+421)</option>
                                            <option>Slovenia (+386)</option>
                                            <option>Solomon Islands (+677)</option>
                                            <option>Somalia (+252)</option>
                                            <option>South Africa (+27)</option>
                                            <option>South Georgia and Sandwich Islands (+500)</option>
                                            <option>Spain (+34)</option>
                                            <option>Sri Lanka (+94)</option>
                                            <option>Sudan (+249)</option>
                                            <option>Suriname (+597)</option>
                                            <option>Svalbard and Jan Mayen (+47)</option>
                                            <option>Swaziland (+268)</option>
                                            <option>Sweden (+46)</option>
                                            <option>Switzerland (+41)</option>
                                            <option>Syrian Arab Republic (+963)</option>
                                            <option>Taiwan (+886)</option>
                                            <option>Tajikistan (+992)</option>
                                            <option>Tanzania (+255)</option>
                                            <option>Thailand (+66)</option>
                                            <option>Togo (+228)</option>
                                            <option>Tokelau (+690)</option>
                                            <option>Tonga (+676)</option>
                                            <option>Trinidad and Tobago (+1868)</option>
                                            <option>Tunisia (+216)</option>
                                            <option>Turkey (+90)</option>
                                            <option>Turkmenistan (+993)</option>
                                            <option>Turks and Caicos Islands (+1649)</option>
                                            <option>Tuvalu (+688)</option>
                                            <option>Uganda (+256)</option>
                                            <option>Ukraine (+380)</option>
                                            <option>United Arab Emirates (+971)</option>
                                            <option>United Kingdom (+44)</option>
                                            <option>United States (+1)</option>
                                            <option>United States Minor Outlying Islands (+699)</option>
                                            <option>Uruguay (+598)</option>
                                            <option>Uzbekistan (+998)</option>
                                            <option>Vanuatu (+678)</option>
                                            <option>Vatican City State (+39)</option>
                                            <option>Venezuela (+58)</option>
                                            <option>Vietnam (+84)</option>
                                            <option>Virgin Islands (British) (+1284)</option>
                                            <option>Virgin Islands (U.S.) (+1340)</option>
                                            <option>Wallis And Futuna Islands (+681)</option>
                                            <option>Western Sahara (+212)</option>
                                            <option>Yemen (+967)</option>
                                            <option>Yugoslavia (+381)</option>
                                            <option>Zaire (+243)</option>
                                            <option>Zambia (+260)</option>
                                            <option>Zimbabwe (+263)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 ph-nmbr" style="padding-right: 0px;">
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
                                    <select class="form-control input-sm select2 job-country" name="country">
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->id }}" {{ $user->country == $cntry->id ? 'selected="selected"' : ''}}>@lang('home.'.$cntry->name)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.state')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-state" name="state" data-state="{{ $user->state }}"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.city')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-city" name="city" data-city="{{ $user->city }}"></select>
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