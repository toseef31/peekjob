@extends('frontend.layouts.app')

@section('title', 'Upskills')

@section('content')
<?php
$opHour = @json_decode($upskill->timing,true);
$gCountry = Session()->get('jcmUser')->country;
$gState = Session()->get('jcmUser')->state;
$gCity = Session()->get('jcmUser')->city;
$gEmail = Session()->get('jcmUser')->email;
$gPhone = Session()->get('jcmUser')->phoneNumber;
if($upskill->country != 0){
    $gCountry = $upskill->country;
    $gState = $upskill->state;
    $gCity = $upskill->city;
    $gEmail = $upskill->email;
    $gPhone = $upskill->phone;
}
?>
<section id="postNewJob">
    <div class="container">
        <!-- <div class="col-md-10 mbl-view-upskills"> -->
            <h3 class="text-center"><!-- @lang('home.up_heading') --></h3>
            <div class="pnj-box row">
                <form id="pnj-form" action="" method="post" class="upskill-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="skillId" value="{{ $upskill->skillId }}">
                    <input type="hidden" name="prevIcon" value="{{ $upskill->upskillImage }}">
					<input type="hidden" name="paycurrency" value="KRW">
                    <h3>@lang('home.basicinformation')</h3>

			               	@if($upskill->skillId)
			
                    @else
                       <div>
                    <span style="padding-left:30px">@lang('home.selectcurrency'): &nbsp;</span>
                      <input type="radio" name="gender" id="up_kr" value="kr" checked="checked"> @lang('home.paykorean')
                      &nbsp;&nbsp;<input type="radio" name="gender" id="up_us" value="us"> @lang('home.US$')
                      </div>
                    <div class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;">
                            <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid">
                            
 
                        <ul id="post-job-ad-types-upskill" class="text-center">
							
							
							
							@foreach($uppayment as $key=> $payment)
														
								@if($payment->title == "Seminar · Fair · Exhibition")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/upskill-1.png');">
								@endif
								@if($payment->title == "Forum · Conference")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/upskill-2.png');">
								@endif
								@if($payment->title == "Training · Workshop")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/upskill-3.png');">
								@endif
								@if($payment->title == "Course · Education · Academy")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/upskill-4.png');">
								@endif
								@if($payment->title == "Contest · Show")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/upskill-5.png');">
								@endif

                          <span class="pay_skill text-left">
							   <div style="padding-left:10px;padding-top:5px;">
                               <input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="cat_id" value="{!! $payment->cat_id!!}" style="padding-top:15px;">
							   <input class="mat-radio-input cdk-visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
							   </div></span>
							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span></div>
                                <div>
                                    <!----><label for="{!! $payment->id!!}">
                                        <!-- <ul class="list-unstyled desc" >
                                            <li>@lang('home.Featuredonhomepage') --><!-- {!! $payment->tag1!!} --><!-- </li>
                                            <li>@lang('home.adcost') --><!-- {!! $payment->tag2!!} --><!-- </li>
                                        </ul> -->
										<div class="text-left" style="font-size: 13px;color:#fff;padding-left:10px;margin-top:-10px;"><span style="color:#fff;font-size:17px;margin-top:20px;" id="up_text{{number_format($key)}}"></span>&nbsp;<span style="color:#fff;font-size: 11px;">/1 @lang('home.days')</span></div>

										<div style="font-size: 13px;color:#fff;padding-left:90px;margin-top:-20px;"><span style="color:#fff;padding-left:28px;">@lang('home.pay_buynow')</span></div>

									<div class="col-md-12">
										<div style="font-size: 11px;padding-top:15px;margin-right:-9px;color:#fff;float:right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('home.'.$payment->title)</div>
									</div>
                                        <div style="color:#fff;font-size: 11px;padding-top:5px;padding-left:110px;">
										@lang('home.upskill-pay-text')</div>									
									
									
                                    </label>
                                    
                                </div>
                            </li>
							@endforeach

							
                                    </ul>
                            </div>
                        </div>

              @endif

                    <div class="pnj-form-section" style="padding-top:30px">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title" placeholder="@lang('home.title')" value="{{ $upskill->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.category')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="type" required="">
                                    <option value="">@lang('home.s_type')</option>
                                    @foreach(JobCallMe::getUpkillsType() as $skill)
                                        <option value="{!! $skill->name !!}" {{ $skill->name == $upskill->type ? 'selected="selected"' : '' }}>@lang('home.'.$skill->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.organiser')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="oType" onchange="orgFun(this.value)">
                                    <option value="user">{{ Session()->get('jcmUser')->firstName.' '.Session()->get('jcmUser')->lastName}}</option>
                                    <option value="other" {{ $upskill->organiser != '' ? 'selected="selected="' : ''}}>@lang('home.Other')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-organiser" style="display: none;">
                            <label class="control-label col-sm-3">@lang('home.organiser')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="organiser" value="{{ $upskill->organiser }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor">{{ $upskill->description }}</textarea>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.cost')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">                                    
                                    <div class="col-md-10 pnj-salary">
                                        <div class=" benefits-checks">
											<input type="radio" name="accommodation" id="cost_method1" value="on" {{ $upskill->accommodation == 'on' ? 'checked=""' : '' }}> @lang('home.free')&nbsp;&nbsp;
											<input type="radio" name="accommodation" id="cost_method2" value="Contact" {{ $upskill->accommodation == 'Contact' ? 'checked=""' : '' }}> @lang('home.Contact person')&nbsp;&nbsp;
											<input type="radio" name="accommodation" id="cost_method3" value="Yes" {{ $upskill->accommodation == 'Yes' ? 'checked=""' : '' }}> @lang('home.notfree')&nbsp;&nbsp;
                                            <!-- <input id="free" type="checkbox" class="cbx-field" name="accommodation" {{ $upskill->cost == '0' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="free"></label>
                                            <label class="lbl" for="free">@lang('home.free')</label> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="cost_method_pay"  @if($upskill->accommodation != 'Yes') style="display:none" @endif>
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 pnj-salary">
                                        <input type="number" class="form-control" name="cost" placeholder="@lang('home.cost')" value="{{ $upskill->cost }}">
                                    </div>

                                    <div class="col-md-4">
                                        <select class="form-control col-md-4 select2" name="currency">
                                            @foreach(JobCallMe::siteCurrency() as $currency)
                                         	
                                            <option value="{!! $currency !!}" {{ $currency == $upskill->currency ? 'selected="selected"' : '' }}>{!! $currency !!}</option>
                                             @endforeach
                                        </select>
                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.CostofDescription')</label>
                            <div class="col-sm-9 pnj-form-field">                                
                                    
                                        <textarea name="costdescription" class="form-control" id="costdescription" placeholder="@lang('home.typeonyourdetailsofcost')">{{ $upskill->costdescription }}</textarea>
                            </div>
                        </div>


					


                    </div>

                    <h3>@lang('home.venue')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input id="pac-input" name="address" class="form-control" type="text" placeholder="@lang('home.address')" value="{{ $upskill->address }}">
                                <div class="pac-card" id="pac-card">
                                  <div>
                                    <div id="type-selector" class="pac-controls">
                                      <input type="radio"  id="changetype-all" checked="checked">
                                      <label for="changetype-all">All</label>

                                      <input type="radio"  id="changetype-establishment">
                                      <label for="changetype-establishment">Establishments</label>

                                      <input type="radio"  id="changetype-address">
                                      <label for="changetype-address">Addresses</label>

                                      <input type="radio"  id="changetype-geocode">
                                      <label for="changetype-geocode">Geocodes</label>
                                    </div>
                                    <div id="strict-bounds-selector" class="pac-controls">
                                      <input type="checkbox" id="use-strict-bounds" value="">
                                      <label for="use-strict-bounds">Strict Bounds</label>
                                    </div>
                                  </div>
                                 
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="address2" id="Address2" placeholder="@lang('home.address2')" value="{{ $upskill->address2 }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.country')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ $gCountry == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.state')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" data-state="{{ $gState }}" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" data-city="{{ $gCity }}" required>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.contactinformation')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.contactperson')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="contact" class="form-control" placeholder="@lang('home.contactperson')" value="{{ $upskill->contact }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.email')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="email" name="email" class="form-control" placeholder="@lang('home.email')" value="{{ $gEmail }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.phone')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="phone" class="form-control" placeholder="@lang('home.phone')" value="{{ $gPhone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.mobile')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="mobile" class="form-control" placeholder="@lang('home.mobile')" value="{{ $upskill->mobile }}">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.fax')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="fax" class="form-control" placeholder="@lang('home.fax')" value="{{ $upskill->mobile }}">
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.onlinepresenc')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.website')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="website" id="website" placeholder="https://www.example.com" value="{{ $upskill->website }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Facebook</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="{{ $upskill->facebook }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Linkedin</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin" value="{{ $upskill->linkedin }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Twitter</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter" value="{{ $upskill->twitter }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Google Plus</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="google" id="google" placeholder="Google+" value="{{ $upskill->google }}">
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.durationschedule')</h3>
                    <div class="pnj-form-section us-duration">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.sdate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="firstDate" name="startDate" onkeypress="return false;" value="@if($upskill->startDate == '0000-00-00') @else {{ $upskill->startDate }} @endif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.edate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="second" name="endDate" onkeypress="return false;" value="@if($upskill->endDate == '0000-00-00') @else {{ $upskill->endDate }} @endif">
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.adsdate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="adfirstDate" name="adstartDate" onkeypress="return false;" value="@if($upskill->adstartDate == '0000-00-00') @else {{ $upskill->adstartDate }} @endif">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.adedate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="adsecond" name="adendDate" onkeypress="return false;" value="@if($upskill->adendDate == '0000-00-00') @else {{ $upskill->adendDate }} @endif">
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.adduration')</label>
                            <div class="col-sm-9 pnj-form-field">
                              <input type="text" class="form-control" id="adduration" name="duration" value="{{ $upskill->duration }}" >
								
                            </div>
                        </div>
                        <hr>
                        <!--Monday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.monday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[mon][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['mon']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[mon][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['mon']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Tuesday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.tuesday')</label>
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
                        <hr>

                        <!--Wednesday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.wednesday')</label>
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
                        <hr>

                        <!--Thursday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.thursday')</label>
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
                        <hr>

                        <!--Friday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.friday')</label>
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
                        <hr>

                        <!--Saturday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.saturday')</label>
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
                        <hr>

                        <!--Sunday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.sunday')</label>
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
                    </div>
					  <!-- map area -->
                     <!-- google map code html -->
                    <div id="map"></div>
                    <div id="infowindow-content">
                      <img src="" width="16" height="16" id="place-icon">
                      <span id="place-name"  class="title"></span><br>
                      <span id="place-address"></span>
                    </div>

                    <!-- <div style="width: 100%; height: 500px;">
	                        {!! Mapper::render() !!}
	                    </div> -->
                    <!-- map end -->

                    <!-- map end -->

                    <h3>@lang('home.upskillimage')</h3>
                    <div class="png-form-section us-duration">
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="file" name="upskillImage" class="form-control">
                            </div>
                        </div>
                        @if($upskill->upskillImage != '')
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                    <img src="{{ url('upskill-images/'.$upskill->upskillImage) }}" alt="" style="max-width: 200px;">
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
					
					<div class="col-md-offset-2 col-md-3  pnj-btns">
                        <span style="font-size:17px;padding-right:50px;" id="totalam"></span>						
                    </div>

                    <div class="col-md-6  pnj-btns">
                        <button type="submit" class="btn btn-primary">@lang('home.save')</button>
                        <button class="btn btn-default"><a href="{{ url('account/upskill') }}">@lang('home.cancel')</a></button>
                    </div>
                </form>
            </div>
        <!-- </div> -->
    </div>

<style type="text/css">
     #map {
        height: 500px;
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


</section>

@endsection
@section('page-footer')
<style type="text/css">
input[type="file"] {
    padding: 0;
}
.text-danger{color: #ff0000 !important;}
</style>
<script type="text/javascript">
var alt="";
$(document).ready(function(){
	$('body').on('click','.pay_skill',function(e){
		console.log($(e.target).val());
	 alt=$(e.target).siblings('input').val();
	 console.log(alrt);
		
	})
    getStates($('.job-country option:selected:selected').val());
    orgFun("{{ $upskill->organiser != '' ? 'other' : 'user'}}");
})
 ////// FOR Simle/////////

 function number_format(data) 
{
    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
    var data = String(data);
    len = data.length;
 
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++) 
    {
        number = number + data.charAt(i);
        
        if (i < data.length - 1) 
        {
            k++;
            if ((k % cutlen) == 0) 
            {
                number = number + comma;
                k = 0;
            }
        }
    }
 
    return number;
}



     var simplearray = <?php echo json_encode($uppayment); ?>;

     for(var i=0;i<simplearray.length;i++){
     $('#up_text'+i).html('￦ '+number_format(simplearray[i].price*1100)+'')
        //alert(jArray[i].amount);
       }
     
    $('#up_us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){
			if(i == 0 || i == 2){
				$('#up_text'+i).html('US$ '+simplearray[i].price+'.00')
				//alert(jArray[i].amount);
				$('.upskill-form input[name="paycurrency"]').val('USD');
			}else{
				$('#up_text'+i).html('US$ '+simplearray[i].price+'0')
				//alert(jArray[i].amount);
				$('.upskill-form input[name="paycurrency"]').val('USD');
			}

         }
        }
    }) ;

    $('#up_kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){
     $('#up_text'+i).html('￦ '+number_format(simplearray[i].price*1100) +'')
       // alert(jArray[i].amount*1100);
	 $('.upskill-form input[name="paycurrency"]').val('KRW');
      }
    }
}) ;
    
    ////// FOR PLAN//////////
  $('#adsecond').on('change', function() {
				  myfun()
			  });
      var total ="";
       function myfun(){
       var start =$("#adfirstDate").datetimepicker("getDate");
      // var start= $("#firstDate").datepicker("getDate");
    	var end= $("#adsecond").datetimepicker("getDate");
   		days = (end- start) / (1000 * 60 * 60 * 24);
      var to= Math.round(days);
      total= to * alt;
      $('#adduration').val(to);
            
    if ($('#up_kr').is(':checked')) {
	  $('#totalam').html("@lang('home.Total Amount') : "+total*1100+" ₩" );
     // alert('kr');
    }

     if ($('#up_us').is(':checked')) {
	  $('#totalam').html("@lang('home.Total Amount') : "+total+" $" );
      //alert('us');
    }
	
      
      // alert(total);
       
       }

$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            var obj = $.parseJSON(response);
            $(".job-state").html('');
            var newOption = new Option('Select State', '', true, false);
            $(".job-state").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-state").append(newOption);
            })
            $(".job-state").trigger('change');
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId)
})
function getCities(stateId){
    if(stateId == '0' || stateId == ''){
        $(".job-city").html('').trigger('change');
        var newOption = new Option('Select City', '', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '', true, false);
            $(".job-city").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })
        }
    })
}
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
function orgFun(opValue){
    if(opValue == 'other'){
        $('.upskill-form .col-organiser').show();
    }else{
        $('.upskill-form .col-organiser').hide();
        $('.upskill-form input[name="organiser"]').val('');
    }
}
$('form.upskill-form').submit(function(e){
    var formData = new FormData($(this)[0]);
    $('.upskill-form .text-danger').remove();
    $('.upskill-form button[type="submit"]').prop('disabled',true);
    $.ajax({
        url: window.location.href,
        type: 'POST',
        data: formData,
        async: false,
        success: function(response) {
            if($.trim(response) != '1'){
               toastr.success('@lang("home.Upskill successfully update")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
               window.location.href = "{{ url('account/upskill') }}";
                $('.upskill-form button[type="submit"]').prop('disabled',false);
            }else{
				window.location.href = "{{ url('skillpayment') }}";
                toastr.success('@lang("home.Upskill successfully saved")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
                //window.location.href = "{{ url('account/upskill') }}";
                $('.upskill-form button[type="submit"]').prop('disabled',false);
            }
        },
        error: function(data){
            isARunning = false;
            var errors = data.responseJSON;
            var j = 1;
            var vError = '';
            $.each(errors, function(i,k){
                var vParent = $('.upskill-form input[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');

                var vParent = $('.upskill-form select[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                
                var vParent = $('.upskill-form textarea[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                if(j == 1){
                    vError = k;
                }
                j++;
            });
            toastr.error(vError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            $('.upskill-form button[type="submit"]').prop('disabled',false);
        },
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
})


$('#cost_method1').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
       // $('#addlable').show();
        $('#cost_method_pay').hide();
    }
    else{
      //  $('#addlable').hide();
        $('#cost_method_pay').hide();
    }
})
$('#cost_method2').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
       // $('#addlable').show();
        $('#cost_method_pay').hide();
    }
    else{
      //  $('#addlable').hide();
        $('#cost_method_pay').hide();
    }
})
 $('#cost_method3').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
       // $('#addlable').show();
        $('#cost_method_pay').show();
    }
    else{
      //  $('#addlable').hide();
        $('#cost_method_pay').hide();
    }
})


</script>



<!-- google map code start from there  -->
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 37.489386, lng: 127.053988},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initMap" async defer></script>

@endsection