@extends('frontend.layouts.app')

@section('title','Organization')

@section('content')
<?php
$cCover = url('compnay-logo/default-cover.jpg');
if($company->companyCover != ''){
  $cCover = url('compnay-logo/'.$company->companyCover);
}
$cLogo = url('compnay-logo/default-logo.jpg');
if($company->companyLogo != ''){
  $cLogo = url('compnay-logo/'.$company->companyLogo);
}
?>
 
<section id="edit-organization" class="organization-section">
  <div class="container">
    <!-- left sideBar -->
    <div class="col-md-3">
      <div class="left-sideBar">
        <div class="timeline-cover">
          <img src="{{ $cCover }}">
        </div>
        <div class="user-section text-center">
          <a href="{{url('account/employer/organization')}}">
            <div class="user-profile-img">
              <img src="{{ $cLogo }}">
            </div>
            <h5><strong>{{ $company->companyName }}</strong></h5>
            <!-- <span>Designation</span> -->
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/organization') }}">
            <div class="profile-img">
              <span class="text-info"><strong>{{$totalPosted}}</strong></span>
            </div>
            <h5><strong>My posted jobs</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/job/new') }}">
            <div class="profile-img">
              <i class="fa fa-edit fa-2x"></i>
            </div>
            <h5><strong>Post a new job</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('download') }}">
            <div class="profile-img">
              <span class="text-info"><strong>10</strong></span>
            </div>
            <h5><strong>Followers</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/departments') }}">
            <div class="profile-img">
              <i class="fa fa-book fa-2x"></i>
            </div>
            <h5><strong>Departments</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/interview-venues') }}">
            <div class="profile-img">
              <i class="fa fa-calendar-o fa-2x"></i>
            </div>
            <h5><strong>Interview venues</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/users') }}">
            <div class="profile-img">
              <i class="fa fa-user-o fa-2x"></i>
            </div>
            <h5><strong>Add users</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/addevaluation') }}">
            <div class="profile-img">
              <i class="fa fa-wpforms fa-2x"></i>
            </div>
            <h5><strong>Evalution form</strong></h5>
          </a>  
        </div>
        <div class="user-section text-center">
          <a href="{{ url('account/employer/questionnaires') }}">
            <div class="profile-img">
              <i class="fa fa-question fa-2x"></i>
            </div>
            <h5><strong>Questionnaire</strong></h5>
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
    <div class="col-md-9">
      @if(Session::has('companyAlert'))
      <div class="alert alert-danger">
        {{Session::get('companyAlert')}} 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="eo-box">
        <div class="eo-timeline">
          <img src="{{ $cCover }}" class="eo-timeline-cover">
          <input type="file" id="eo-timeline" class="compnay-cover">
          <div class="eo-timeline-toolkit">
            <label for="eo-timeline"><i class="fa fa-camera"></i> &nbsp;@lang('home.change')</label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-2 eo-dp-box">
              <img src="{{ $cLogo }}" class="eo-dp eo-c-logo">
              <div class="eo-dp-toolkit">
                <input type="file" id="eo-dp" class="compnay-logo">
                <label for="eo-dp"><i class="fa fa-camera"></i> @lang('home.change')</label><br>
                <label  style="margin-left:-23px" onclick="editcompanypic()"><i class="fa fa-edit"></i> @lang('home.Edit')</label><br>
                <label onclick="removecompanypic()"><i class="fa fa-remove">
                  <input type="hidden" value="{{ session()->get('jcmUser')->userId }}" id="userID">
                </i> @lang('home.Remove')</label>
              </div>

            </div>

                   <div class="col-md-10 eo-timeline-details">
                       <h1><a href="">{{ $company->companyName }}</a></h1>
                       <div class="col-md-6 eo-section">
                           <h4>@lang('home.basicinformation')</h4>
                          <!--  <div class="eo-details">
                               <span>@lang('home.designation'):</span> HR
                           </div>  -->                          
                           <div class="eo-details">
                               <span>@lang('home.industry'):</span> @lang('home.'.JobCallMe::categoryName($company->category))
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.address'):</span> {{ $company->companyAddress }}, @lang('home.'.JobCallMe::cityName($company->companyCity)), @lang('home.'.JobCallMe::countryName($company->companyCountry))
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.email'):</span> {{ $company->companyEmail }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.phone'):</span> {{ $company->companyPhoneNumber }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.website'):</span> <a href="{{ $company->companyWebsite }}">{{ $company->companyWebsite }}</a>
                           </div>
                           <div class="eo-details">
                               <span>@lang('Facebook'):</span> <a href="{{ $company->companyFb }}">{{ $company->companyFb }}</a>
                           </div>
                           <div class="eo-details">
                               <span>@lang('Twitter'):</span> <a href="{{ $company->companyTwitter }}">{{ $company->companyTwitter }}</a>
                           </div>
                           <div class="eo-details">
                               <span>@lang('LinkedIn'):</span> <a href="{{ $company->companyLinkedin }}">{{ $company->companyLinkedin }}</a>
                           </div>
                           
                           <div class="eo-details">
                               <span>@lang('home.noemployees'):</span> {{ $company->companyNoOfUsers }}
                           </div>
                       </div>
                       <div class="col-md-6 eo-section">
                           <a class="btn btn-primary eo-edit-btn" onClick="
                           $('.eo-section,.conpany-info-sec').hide();
                           $('.eo-edit-section').show()"><i class="fa fa-edit"></i> </a>
                           <h4>@lang('home.operationhours')</h4>
                           <?php $opHour = json_decode($company->companyOperationalHour,true); ?>
                           <table class="table">
                               <tbody>
                                   <tr>
                                       <td>@lang('home.monday')</td>
                                       <td>{!! $opHour['mon']['from'] !!} - {!! $opHour['mon']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.tuesday')</td>
                                       <td>{!! $opHour['tue']['from'] !!} - {!! $opHour['tue']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.wednesday')</td>
                                       <td>{!! $opHour['wed']['from'] !!} - {!! $opHour['wed']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.thursday')</td>
                                       <td>{!! $opHour['thu']['from'] !!} - {!! $opHour['thu']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.friday')</td>
                                       <td>{!! $opHour['fri']['from'] !!} - {!! $opHour['fri']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.saturday')</td>
                                       <td>{!! $opHour['sat']['from'] !!} - {!! $opHour['sat']['to'] !!} </td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.sunday')</td>
                                       <td>{!! $opHour['sun']['from'] !!} - {!! $opHour['sun']['to'] !!} </td>
                                   </tr>
                               </tbody>
                           </table>
                       </div>
                    </div>   
                       <div class="eo-edit-section">
                          <form class="organization-form">
                   <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                               <div class="pnj-form-section">
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.company') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control companyName" name="companyName" id="companyName" placeholder="Company Title" value="{{ $company->companyName }}" required>
                                       </div>
                                   </div>
                                 
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.industry') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <select class="form-control select2" name="industry" required>
                                              
                                               @foreach(JobCallMe::getCategories() as $cat)
                                               @if($cat->categoryId < 17)
                                                <option value="{{ $cat->categoryId }}" {{ $cat->categoryId == $company->category ? 'selected="selected"' : '' }}>@lang('home.'.$cat->name)</option>
                                              @endif
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.address') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <textarea required class="form-control companyAddress" placeholder="Address" name="companyAddress" style="resize: vertical">{{ $company->companyAddress }}</textarea>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.country') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                            <select class="form-control input-sm select2 job-country companyCountry" name="companyCountry" required>
                                                @foreach(JobCallMe::getJobCountries() as $cntry)
                                                    <option value="{{ $cntry->id }}" {{ $company->companyCountry == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                                @endforeach
                                            </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.state') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                            <select class="form-control input-sm select2 job-state companyState" name="companyState" data-state="{{ $company->companyState }}" required> 
                                            </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.city') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                            <select class="form-control input-sm select2 job-city companyCity" name="companyCity" data-city="{{ $company->companyCity }}" required></select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.phone') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control companyPhoneNumber" name="companyPhoneNumber" id="companyPhoneNumber" placeholder="Phone" value="{{ $company->companyPhoneNumber }}" required>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.email') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="email" class="form-control companyEmail" name="companyEmail" id="companyEmail" placeholder="Email" value="{{ $company->companyEmail }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.website')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyWebsite" name="companyWebsite" id="companyWebsite" placeholder="https://www.example.com" value="{{ $company->companyWebsite }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">Facebook</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyFb" name="companyFb" id="companyFb" placeholder="Facebook" value="{{ $company->companyFb }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">Linkedin</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyLinkedin" name="companyLinkedin" id="companyLinkedin" placeholder="Linkedin" value="{{ $company->companyLinkedin }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">Twitter</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyTwitter" name="companyTwitter" id="twitter" placeholder="Twitter" value="{{ $company->companyTwitter }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3 col-xs-12">@lang('home.noemployees') *</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="number" class="form-control companyNoOfUsers" name="companyNoOfUsers" id="companyNoOfUsers" placeholder="Total Employees" value="{{ $company->companyNoOfUsers }}" required>
                                       </div>
                                   </div>                                
                        </div>                  
                  
                  
                    <!--Monday Schedule-->                 
                      
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.monday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[mon][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['mon']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[mon][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['mon']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>                    
                    <!--Tuesday Schedule-->
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.tuesday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[tue][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['tue']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field ">
                        <select name="opHours[tue][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['tue']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                        <!--Wednesday Schedule-->
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.wednesday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[wed][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['wed']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field ">
                        <select name="opHours[wed][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['wed']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>                    
                    <!--Thursday Schedule-->
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.thursday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[thu][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['thu']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field ">
                        <select name="opHours[thu][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['thu']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--Friday Schedule-->
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.friday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[fri][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['fri']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field ">
                        <select name="opHours[fri][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['fri']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--Saturday Schedule-->
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.saturday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[sat][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['sat']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field ">
                        <select name="opHours[sat][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['sat']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                     <!--Sunday Schedule-->
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-xs-12">@lang('home.sunday')</label>
                      <div class="col-sm-4 pnj-form-field">
                        <select name="opHours[sun][]" class="form-control">
                          <option value="">@lang('home.from')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['sun']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 pnj-form-field ">
                        <select name="opHours[sun][]" class="form-control">
                          <option value="">@lang('home.to')</option>
                          @foreach(JobCallMe::timeArray() as $time)
                          <option value="{!! $time !!}" {!! $time == $opHour['sun']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                       <div class="col-sm-4 pnj-form-field ">
                         <button class="btn btn-success" id="save-company-detail" type="button"> @lang('home.SAVE')</button>
                       </div>
                    </div>
              </div>
            </form>
        </div>
      </div>
    </div>

      <div class="eo-box eo-about">
        <a class="btn btn-primary r-add-btn hideThis" onClick="$('.eo-about-org').hide(); $('.hideThis').hide();$('.eo-about-editor').show(); "><i class="fa fa-edit"></i> </a>
        <h3 class="eo-about-heading">@lang('home.aboutorganization')</h3>
        <div class="eo-about-org">
          <p>{!! $company->companyAbout !!}</p>
        </div>
        <div class="eo-about-editor">
          <form  id="pnj-form" class="organization-desc-form">
            <input type="hidden" name="_token" class="token">
            <div class="form-group">
              <label class="control-label col-sm-3">&nbsp;</label>
              <div class="col-sm-7 pnj-form-field">
                <textarea id="aboutComp" class="form-control tex-editor" name="companyAbout" rows="10" style="resize: vertical;">{!! $company->companyAbout !!}</textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn btn-primary col-md-3" id="saveAboutCompany" name="save" style="margin-right:5px">@lang('home.SAVE')</button>
                  <button type="button" class="btn btn-default col-md-3" onClick="$('.eo-about-org').show(); $('.hideThis').show();$('.eo-about-editor').hide();">@lang('home.CANCEL')</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="eo-box eo-about">
        <h3 class="eo-about-heading">@if(Lang::has(home.companypics))@lang('home.companypics') @else @lang('home.Edit Company Pictures') @endif</h3>
        <div class="eo-about-org">
          <textarea id="editor1" name="companypics">{!! $company->companypics !!}</textarea>
          <button class="btn btn-success" id="save-company"> @lang('home.SAVE')</button>
        </div>

      </div>
      <div class="eo-box eo-about">

        <h3 class="eo-about-heading">@lang('home.organizationmap')</h3>
        <div class="eo-about-org">
          <form action="" id="pnj-form" method="post" class="organization-desc-map">
            <input type="hidden" name="_token" class="token">
            <input id="p-input" class="form-control controls" type="text" name="address" value="{!! $company->companyMap !!}" >


            <div id="map" style="width: 100%; height: 500px;">

            </div>
            <button type="submit" class="btn btn-primary col-md-3" name="save" style="margin-right:5px;margin-top: 13px;">@lang('home.SAVE')</button>

          </form>
        </div>

      </div>
  </div>
</section>
<div id="editProCompanyModel" class="modal fade" role="dialog">
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
.input-error{color: red;}
</style>


<style type="text/css">
     #map {
        height: 0px;
      }
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

      /*#pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        
      }*/

      #pac-input:focus {
        border-color: #4d90fe;
      }

      
</style>


<script type="text/javascript">

    $('.date-pickers').datetimepicker({
                format:'yyyy-mm-dd',
                endDate: '+0d',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
                });

 CKEDITOR.replace( 'editor1',{
  filebrowserBrowseUrl : "{{ url('frontend-assets/js/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files')}}",
   filebrowserImageBrowseUrl : "{{ url('frontend-assets/js/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images')}}",
   filebrowserFlashBrowseUrl : "{{ url('frontend-assets/js/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash')}}",
   filebrowserUploadUrl : "{{ url('frontend-assets/js/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files')}}",
   filebrowserImageUploadUrl : "{{ url('frontend-assets/js/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images')}}",
   filebrowserFlashUploadUrl : "{{ url('frontend-assets/js/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash')}}",
   height: '500px',
 });
var token = "{{ csrf_token() }}";
$(document).ready(function(){

    $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
    getStates($('.job-country option:selected:selected').val());
    /*get ckeditor data and save it to database*/
    $('#save-company').on('click',function(){
      var value = CKEDITOR.instances.editor1.getData();
      $.ajax({
        url:"{{ url('account/employer/savecompic') }}",
        type:"post",
        data:{comppics:value,_token:"{{ csrf_token() }}"},
        success:function(res){
          if(res == 1){
            toastr.success('@lang("home.company pics update successfully")');
          }
        }
      });
    })


  $('#save-company-detail').on('click',function(){
       
     $.ajax({
        type: 'post',
        data:  $('.organization-form').serialize(),
        url: "{{ url('account/employer/save') }}",
        success: function(response){
          $('.eo-section,.conpany-info-sec').show();
           $('.eo-edit-section').hide()
          toastr.success('@lang("home.company info update successfully")');
          location.reload(true);     
        },
        error: function(response){

          $('.eo-section,.conpany-info-sec').hide();
          $('.eo-edit-section').show();             
        }      

      });
  });


})
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    if(countryId == 0){
        var newOption = new Option('Select State', '0', true, false);
        $(".job-state").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            console.log(response);
            /*var obj = $.parseJSON(response);*/
            $(".job-state").html('').trigger('change');
           /* var newOption = new Option('Select State', '0', true, false);*/
            $(".job-state").append(response).trigger('change');
            /*$.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
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
    if(stateId == 0){
        var newOption = new Option('Select City', '0', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
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
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
$('form.organization-form').submit(function(e){
    $('.organization-form .token').val(token);
    $('.organization-form button[name="save"]').prop('disabled',true);
    $.ajax({
        type: 'post',
        data: $('.organization-form').serialize(),
        url: "{{ url('account/employer/organization/save') }}",
        success: function(response){
            if(response == '1'){
                window.location.reload();
            }else{
                $('.organization-form button[name="save"]').prop('disabled',false);
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        },
        error: function(data){
            var errors = data.responseJSON;
            var x = 1;
            var vError = '';
            $.each(errors, function(i,k){
                var vParent = $('.organization-form .'+i+'').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                if(x == 1){
                    vError = k;
                }
                x++;
            })
            toastr.error(vError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            $('.organization-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
tinymce.init({
    selector: '.tex-editor',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
var formOp = 1;


$('form.organization-desc-form').submit(function(e){
  // alert("in about"); exit();
  //   if(formOp == 1){
  //       formOp++
  //       return false;
  //   }
    $('.organization-desc-form .token').val(token);
    $('.organization-desc-form button[name="save"]').prop('disabled',true);
    $.ajax({
        type: 'post',
        data: $('.organization-desc-form').serialize(),
        url: "{{ url('account/employer/organization/about') }}",
        success: function(response){
            if($.trim(response) == '1'){
                window.location.reload();
            }else{
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    })
    e.preventDefault();
});





$('form.organization-desc-map').submit(function(e){
    // if(formOp == 1){
    //     formOp++
    //     return false;
    // }
    $('.organization-desc-map .token').val(token);
    $('.organization-desc-map button[name="save"]').prop('disabled',true);
    $.ajax({
        type: 'post',
        data: $('.organization-desc-map').serialize(),
        url: "{{ url('account/employer/organization/map') }}",
        success: function(response){
            if($.trim(response) == '1'){
                window.location.reload();
            }else{
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    })
    e.preventDefault();
})
$('.compnay-logo').on('change',function(){
    var formData = new FormData();
    formData.append('cLogo', $(this)[0].files[0]);
    formData.append('_token', token);

    $.ajax({
        url : "{{ url('account/employer/company/logo') }}",
        type : 'POST',
        data : formData,
        processData: false,
        contentType: false,
        timeout: 30000000,
        success : function(response) {
            if($.trim(response) != '1'){
                $('img.eo-c-logo').attr('src',response);
            }else{
                toastr.error('@lang("home.Following format allowed (PNG/JPG/JPEG)")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    });
})
$('.compnay-cover').on('change',function(){
    var formData = new FormData();
    formData.append('cLogo', $(this)[0].files[0]);
    formData.append('_token', token);

    $.ajax({
        url : "{{ url('account/employer/company/cover') }}",
        type : 'POST',
        data : formData,
        processData: false,
        contentType: false,
        timeout: 30000000,
        success : function(response) {
            if($.trim(response) != '1'){
                $('img.eo-timeline-cover').attr('src',response);
            }else{
                toastr.error('@lang("home.Following format allowed (PNG/JPG/JPEG)")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    });
})
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
    function editcompanypic(){
        var proImg = $('.eo-dp').attr('src');
       $('#editProCompanyModel').modal('show');
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
        $('.eo-dp').attr('src',srcOriginal);
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
            url: '{{ url("cropCompanyProfileImage") }}',
            data: fd,
            processData: false,
            contentType: false
        }).done(function(data) {
               console.log(data);
        });
        
    });
    function removecompanypic(){
       var userId = $('#userID').val();
       $.ajax({
        url:'{{ url("RemCompProImage") }}',
        data:{userId:userId,_token:'{{ csrf_token() }}'},
        type:'POST',
        success:function(res){
            if(res == 1){
                toastr.success('@lang("home.Profile Pic Remove")');
                $('.eo-dp').attr('src','{{ asset("compnay-logo/default-logo.jpg") }}');
            }
        }
       });
    }

  
     // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      
      var addr=$('#p-input').val();
      //alert(addr);
      
      function initMap() {
             var geocoder = new google.maps.Geocoder();
              
               var address = addr;
               var long="";
               var lati="";
               var myLatLng="";
        if(addr== ''){
               var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 37.532600, lng: 127.024612},
          zoom: 13
        });
        
        var card = document.getElementById('pac-card');
        var input = document.getElementById('p-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            }); 

        }   
        else{
             geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
        lati = results[0].geometry.location.lat();
        long = results[0].geometry.location.lng();
        myLatLng={lat: lati, lng: long}
      
        var map = new google.maps.Map(document.getElementById('map'), {
            // /  alert(longitude);
          center: {lat: lati, lng: long},
          zoom: 13
        });
        
        var card = document.getElementById('pac-card');
        var input = document.getElementById('p-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: addr,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
      });

        }    
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initMap" async defer></script>


@endsection