@extends('frontend.layouts.app')

@section('title','Post New Job')

@section('content')

<section id="postNewJob" style="margin-bottom:70px">
 
 <form action='{{ url("paypals") }}' method='post' class='form-horizontal' enctype='multipart/form-data'>
                        {{ csrf_field() }}

<input name="paycurrency" type="hidden">
<div class="container">

	  <div class="row">
           
           @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
								@if($error=='validation.max.string')
									<li>@lang('home.The maximum length for Description is 1024 characters.')</li>
									<li>@lang('home.validation.max.string')</li>
								@else
									<li> {{ $error}}</li>
								@endif
                            @endforeach
                        </ul>
                    </div>
                @endif
	
       
		
            <div class="pnj-box">
			  <h3>@lang('home.postnewjob')</h3>
					<div class="col-md-12">
                    <div>
                    <span>@lang('home.selectcurrency'): &nbsp;</span>
                      <input type="radio" name="gender" id="kr" value="kr" checked="checked">  @lang('home.paykorean')
                      &nbsp;&nbsp;<input type="radio" name="gender" id="us" value="us"> US$
                      </div>
					   <div class="form-group error-group" style="display: none;">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field"><div class="alert alert-danger"></div></div>
                        </div>
                        @if($single > 0)
              <div id="pckg" class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;margin-top:30px;">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;background:#efefef;" class="ng-untouched ng-pristine ng-invalid hidden-xs">
                        <ul id="post-job-ad-types" class="text-center">
                         
						 @foreach($plan as $key=>$pay)
							
								@if($pay->type == "Basic")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
										$payad_text3 = "basic_text3";
									?>
								@endif
								@if($pay->type == "Golden")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
										$payad_text3 = "golden_text3";
										$payad_text4 = "golden_text4";
										$payad_text5 = "golden_text5";
										$payad_text6 = "golden_text6";
									?>
								@endif
								@if($pay->type == "Special")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
										$payad_text3 = "special_text3";
										$payad_text4 = "special_text4";
										$payad_text5 = "special_text5";
										$payad_text6 = "special_text6";
									?>
								@endif
								@if($pay->type == "Latest")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
										$payad_text3 = "latest_text3";
										$payad_text4 = "latest_text4";
										$payad_text5 = "latest_text5";
										$payad_text6 = "latest_text6";
									?>
								@endif
								@if($pay->type == "Hot")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
										$payad_text3 = "hot_text3";
										$payad_text4 = "hot_text4";
										$payad_text5 = "hot_text5";
										$payad_text6 = "hot_text6";
									?>
								@endif
								@if($pay->type == "Top Job")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
										$payad_text3 = "top_text3";
										$payad_text4 = "top_text4";
										$payad_text5 = "top_text5";
										$payad_text6 = "top_text6";
									?>
								@endif
								@if($pay->type == "Premium")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
										$payad_text3 = "premium_text3";
										$payad_text4 = "premium_text4";
										$payad_text5 = "premium_text5";
										$payad_text6 = "premium_text6";
									?>
								@endif

                         <!----><!-- <li style="position:relative"> -->
                                <!---->
								<div class="text-left">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $pay->id!!}" name="allarray" value="{!! $pay->cat_id!!}|{!! $pay->id!!}|{!! $pay->amount!!}|{!! $pay->duration!!}|{!! $pay->quantity!!}" style="margin-top:15px;margin-left:10px;">
									<input class="mat-radio-input visually-hidden pckg_amount" id="radioval" type="hidden"  value="{!! $pay->amount!!}">
									@if($pay->type == "Basic")<span style="font-size: 12px;padding-left:5px;padding-top:-10px;">@else<span style="font-size: 12px;padding-left:5px;padding-top:-10px;">@endif<b>@if(app()->getLocale() == "kr")
			@if($pay->type == "Golden")골드 @else @lang('home.'.$pay->type) @endif
		@else
			@lang('home.'.$pay->type)
		@endif </b></span>	
                                    
                                    <input class="checkplan"  type="hidden" name="plan"  value="plan">
								</div>
							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                             
                                <div class="text-center">
                                    <!----><label for="{!! $pay->id!!}">

									@if($payment->title == "Basic")
										<div style="font-size: 11px;padding:30px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text)</div>
										<div style="font-size: 11px;padding:20px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text2)</div>
										<div style="font-size: 11px;padding:20px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text3)</div>
										@else
										<div style="font-size: 11px;padding:30px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text2)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text3)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text4)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text5)</div>
										@endif

										
										
										
										
										<!-- @if($payment->title != "Basic")
										<div style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600" >@lang('home.paylocation')</div>
										@endif -->
										

										
                                        
										<div style="font-size: 12px;text-align: center;color:#ff3b3b;padding-top:7px;" >@lang('home.'.$payad_text6)</span>
										</div>
										<div class="credits b" style="font-size: 13px;text-align: center;padding-top:29px;" >
											<span class="text-success" style="color:#fff" id="class_text{{$key}}"></span>
										</div>
									</div>

										@if($payment->title == "Basic")
										<div style="padding-top:25px;font-size: 17px;color:#000;" class="text-center">@lang('home.Free')</div>
										@else										
										<!-- <div style="text-align: center;padding-top:15px;"><span style="font-size: 15px;background:#118c4e;padding:5px 20px;color:#fff;width:100px;text-align: center;">@lang('home.pay_buy')</span></div> -->
										@endif

                                        
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>
                        <a id="nopckg" href="javascript:void(0)" style="float:right;margin-top:10px;"><span style="background:#013d80;padding:5px 10px;color:#fff;">@lang('home.Not Use Package Plan?') ></span></a>
                 

                    
                </div>
            



			<div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid hidden-sm hidden-md hidden-lg">
                        <ul id="post-job-ad-types2" class="text-center">
                         
						 @foreach($plan as $key=>$pay)
							
								@if($pay->type == "Basic")
                            <!----><li style="position:relative;background:#3a79d2;" class="text-left">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
									?>
								@endif
								@if($pay->type == "Golden")
                            <!----><li style="position:relative;background:#b0a48a;" class="text-left">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
									?>
								@endif
								@if($pay->type == "Special")
                            <!----><li style="position:relative;background:#4e6c7c;" class="text-left">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
									?>
								@endif
								@if($pay->type == "Latest")
                            <!----><li style="position:relative;background:#94a5a5;" class="text-left">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
									?>
								@endif
								@if($pay->type == "Hot")
                            <!----><li style="position:relative;background:#717171;" class="text-left">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
									?>
								@endif
								@if($pay->type == "Top Job")
                            <!----><li style="position:relative;background:#a8b3b9;" class="text-left">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
									?>
								@endif
								@if($pay->type == "Premium")
                            <!----><li style="position:relative;background:#a09d8e;" class="text-left">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
									?>
								@endif

                         <!----><!-- <li style="position:relative"> -->
                                <!---->
								<div style="height:40px">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $pay->id!!}" name="allarray" value="{!! $pay->cat_id!!}|{!! $pay->id!!}|{!! $pay->amount!!}|{!! $pay->duration!!}|{!! $pay->quantity!!}" style="margin-top:10px;margin-left:10px;">
									<input class="mat-radio-input visually-hidden pckg_amount" id="radioval" type="hidden"  value="{!! $pay->amount!!}">
									<span style="color:#fff;font-size: 15px;padding-left:10px;"><b>@lang('home.'.$pay->type)</b></span>&nbsp;<span style="color:#fff;font-size: 12px;padding-left:0px;"><b>@if($payment->title == "Basic") @lang('home.mpay_text') @else @lang('home.mpay_text2') @endif</b></span>
                                    
                                    <input class="checkplan"  type="hidden" name="plan"  value="plan">
								</div>
							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                             
                                <div style="background:#fff;height:50px;text-align: center;">
                                    <!----><label for="{!! $pay->id!!}">

									<div class="credits b" style="font-size: 13px;text-align: center;padding-top:5px;" >@lang('home.pay_cost') : <span style="color:#118c4e" class="text-success" id="mclass_text{{$key}}"></span>@lang('home.currencyday_text')<br><span style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600">@lang('home.paylocation')</span>
										
									</div>

                                        
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>
                        <a id="nopckg2" href="javascript:void(0)" style="float:right;margin-top:10px;"><span style="background:#013d80;padding:5px 10px;color:#fff;">@lang('home.Not Use Package Plan?') ></span></a>
                 

                    
                </div>
            </div>


		
          <!--  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypals') !!}" > -->
					<div id="notpckg"  class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: none; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;margin-top:30px;">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;background:#efefef;" class="ng-untouched ng-pristine ng-invalid hidden-xs">
                        <ul id="post-job-ad-types" class="text-center">
						 @foreach($rec as $k=>$payment)

								@if($payment->title == "Basic")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
										$payad_text3 = "basic_text3";
									?>
								@endif
								@if($payment->title == "Golden")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
										$payad_text3 = "golden_text3";
										$payad_text4 = "golden_text4";
										$payad_text5 = "golden_text5";
										$payad_text6 = "golden_text6";
									?>
								@endif
								@if($payment->title == "Special")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
										$payad_text3 = "special_text3";
										$payad_text4 = "special_text4";
										$payad_text5 = "special_text5";
										$payad_text6 = "special_text6";
									?>
								@endif
								@if($payment->title == "Latest")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
										$payad_text3 = "latest_text3";
										$payad_text4 = "latest_text4";
										$payad_text5 = "latest_text5";
										$payad_text6 = "latest_text6";
									?>
								@endif
								@if($payment->title == "Hot")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
										$payad_text3 = "hot_text3";
										$payad_text4 = "hot_text4";
										$payad_text5 = "hot_text5";
										$payad_text6 = "hot_text6";
									?>
								@endif
								@if($payment->title == "Top Job")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
										$payad_text3 = "top_text3";
										$payad_text4 = "top_text4";
										$payad_text5 = "top_text5";
										$payad_text6 = "top_text6";
									?>
								@endif
								@if($payment->title == "Premium")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
										$payad_text3 = "premium_text3";
										$payad_text4 = "premium_text4";
										$payad_text5 = "premium_text5";
										$payad_text6 = "premium_text6";
									?>
								@endif
								
                            <!----><!-- <li style="position:relative"> -->
                                <!---->
								<div class="text-left">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="p_Category" value="{!! $payment->id!!}" style="margin-top:15px;margin-left:10px;">
									<input class="mat-radio-input visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
									@if($payment->title == "Basic")<span style="font-size: 12px;padding-left:5px;padding-top:-10px;">@else<span style="font-size: 12px;padding-left:5px;padding-top:-10px;">@endif<b>@if(app()->getLocale() == "kr")
			@if($payment->title == "Golden")골드 @else @lang('home.'.$payment->title) @endif
		@else
			@lang('home.'.$payment->title)
		@endif</b></span>
								</div>

							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>

                             
                                <div class="text-center">
                                    <!----><label for="{!! $payment->id!!}">
                                        @if($payment->title == "Basic")
										<div style="font-size: 11px;padding:30px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text)</div>
										<div style="font-size: 11px;padding:20px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text2)</div>
										<div style="font-size: 11px;padding:20px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text3)</div>
										@else
										<div style="font-size: 11px;padding:30px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text2)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text3)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text4)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text5)</div>
										@endif

										
										
										
										
										<!-- @if($payment->title != "Basic")
										<div style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600" >@lang('home.paylocation')</div>
										@endif -->
										

										
                                         @if($payment->price ==0)
										
										@else
										
										<div style="font-size: 12px;text-align: center;color:#ff3b3b;padding-top:7px;" >@lang('home.'.$payad_text6)</span>
										</div>
										<div class="credits b" style="font-size: 13px;text-align: center;padding-top:29px;" >
											<span class="text-success" style="color:#fff" id="simple_text{{$k}}"></span>
										</div>
										@endif

										@if($payment->title == "Basic")
										<div style="padding-top:71px;font-size: 13px;color:#fff;" class="text-center">@lang('home.Free')</div>
										@else										
										<!-- <div style="text-align: center;padding-top:15px;"><span style="font-size: 15px;background:#118c4e;padding:5px 20px;color:#fff;width:100px;text-align: center;">@lang('home.pay_buy')</span></div> -->
										@endif
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>

                   <a id="nonpckg" href="javascript:void(0)" style="float:right;margin-top:12px;margin-bottom: 18px;"><span style="background:#013d80;padding:5px 10px;color:#fff;">@lang('home.Use Package Plan?') ></span></a>

                    
                </div>



				<div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid hidden-sm hidden-md hidden-lg">
                        <ul id="post-job-ad-types2" class="text-center">
						 @foreach($rec as $k=>$payment)

								@if($payment->title == "Basic")
                            <!----><li style="position:relative;background:#3a79d2;" class="text-left">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
									?>
								@endif
								@if($payment->title == "Golden")
                            <!----><li style="position:relative;background:#b0a48a;" class="text-left">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
									?>
								@endif
								@if($payment->title == "Special")
                            <!----><li style="position:relative;background:#4e6c7c;" class="text-left">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
									?>
								@endif
								@if($payment->title == "Latest")
                            <!----><li style="position:relative;background:#94a5a5;" class="text-left">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
									?>
								@endif
								@if($payment->title == "Hot")
                            <!----><li style="position:relative;background:#717171;" class="text-left">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
									?>
								@endif
								@if($payment->title == "Top Job")
                            <!----><li style="position:relative;background:#a8b3b9;" class="text-left">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
									?>
								@endif
								@if($payment->title == "Premium")
                            <!----><li style="position:relative;background:#a09d8e;" class="text-left">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
									?>
								@endif
								
                            <!----><!-- <li style="position:relative"> -->
                                <!---->
								<div style="height:40px">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="p_Category" value="{!! $payment->id!!}" style="margin-top:10px;margin-left:10px;">
									<input class="mat-radio-input visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
									<span style="color:#fff;font-size: 15px;padding-left:10px;"><b>@lang('home.'.$payment->title)</b></span>&nbsp;<span style="color:#fff;font-size: 12px;padding-left:0px;"><b>@if($payment->title == "Basic") @lang('home.mpay_text') @else @lang('home.mpay_text2') @endif</b>
								</div>

							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>

                             
                                <div style="background:#fff;height:50px">
                                    <!----><label for="{!! $payment->id!!}">
                                        <div class="credits b" style="font-size: 13px;text-align: center;padding-top:5px;" >@lang('home.pay_cost') : @if($payment->price ==0)
										<span class="free" style="color:#118c4e">@lang('home.Free_text')<br><span style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600">&nbsp;</span>
										@else
										<span class="text-success" style="color:#118c4e" id="msimple_text{{$k}}"></span>@lang('home.currencyday_text')<br><span style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600">@lang('home.paylocation')</span>
										
									@endif</div>
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>

                   <a id="nonpckg2" href="javascript:void(0)" style="float:right;margin-top:10px;"><span style="background:#013d80;padding:5px 10px;color:#fff;">@lang('home.Use Package Plan?') ></span></a>

                    
                </div>



            </div>
		</div>
               

               @else
               
                  <!--  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypals') !!}" > -->
					<div id="notpckg" class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;margin-top:30px;">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;background:#efefef;" class="ng-untouched ng-pristine ng-invalid hidden-xs">
                        <ul id="post-job-ad-types" class="text-center">
						 @foreach($rec as $keys=>$payment)
								@if($payment->title == "Basic")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
										$payad_text3 = "basic_text3";
									?>
								@endif
								@if($payment->title == "Golden")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
										$payad_text3 = "golden_text3";
										$payad_text4 = "golden_text4";
										$payad_text5 = "golden_text5";
										$payad_text6 = "golden_text6";
									?>
								@endif
								@if($payment->title == "Special")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
										$payad_text3 = "special_text3";
										$payad_text4 = "special_text4";
										$payad_text5 = "special_text5";
										$payad_text6 = "special_text6";
									?>
								@endif
								@if($payment->title == "Latest")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
										$payad_text3 = "latest_text3";
										$payad_text4 = "latest_text4";
										$payad_text5 = "latest_text5";
										$payad_text6 = "latest_text6";
									?>
								@endif
								@if($payment->title == "Hot")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
										$payad_text3 = "hot_text3";
										$payad_text4 = "hot_text4";
										$payad_text5 = "hot_text5";
										$payad_text6 = "hot_text6";
									?>
								@endif
								@if($payment->title == "Top Job")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job2.png');color:#fff;">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
										$payad_text3 = "top_text3";
										$payad_text4 = "top_text4";
										$payad_text5 = "top_text5";
										$payad_text6 = "top_text6";
									?>
								@endif
								@if($payment->title == "Premium")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/pay-job1.png');">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
										$payad_text3 = "premium_text3";
										$payad_text4 = "premium_text4";
										$payad_text5 = "premium_text5";
										$payad_text6 = "premium_text6";
									?>
								@endif
								
                                <!---->
								<div class="text-left">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="p_Category" value="{!! $payment->id!!}" style="margin-top:15px;margin-left:10px;">
									<input class="mat-radio-input visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
									@if($payment->title == "Basic")<span style="font-size: 12px;padding-left:5px;padding-top:-10px;">@else<span style="font-size: 12px;padding-left:5px;padding-top:-10px;">@endif<b>@if(app()->getLocale() == "kr")
			@if($payment->title == "Golden")골드 @else @lang('home.'.$payment->title) @endif
		@else
			@lang('home.'.$payment->title)
		@endif</b></span>
								</div>

							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>

                             
                                <div class="text-center">
                                    <!----><label for="{!! $payment->id!!}">
                                        @if($payment->title == "Basic")
										<div style="font-size: 11px;padding:30px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text)</div>
										<div style="font-size: 11px;padding:20px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text2)</div>
										<div style="font-size: 11px;padding:20px 0px 0px 5px;" class="text-left">@lang('home.'.$payad_text3)</div>
										@else
										<div style="font-size: 11px;padding:30px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text2)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text3)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text4)</div>
										<div style="font-size: 11px;padding:7px 0px 0 5px;" class="text-left">@lang('home.'.$payad_text5)</div>
										@endif

										
										
										
										
										<!-- @if($payment->title != "Basic")
										<div style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600" >@lang('home.paylocation')</div>
										@endif -->
										

										
                                        @if($payment->price ==0)
										
										@else
										
										<div style="font-size: 12px;text-align: center;color:#ff3b3b;padding-top:7px;" >@lang('home.'.$payad_text6)</span>
										</div>
										<div class="credits b" style="font-size: 13px;text-align: center;padding-top:29px;" >
											<span class="text-success" style="color:#fff" id="simple_text{{$keys}}"></span>
										</div>
										@endif

										@if($payment->title == "Basic")
										<div style="padding-top:71px;font-size: 13px;color:#fff;" class="text-center">@lang('home.Free')</div>
										
										@else										
										<!-- <div style="text-align: center;padding-top:15px;"><span style="font-size: 15px;background:#118c4e;padding:5px 20px;color:#fff;width:100px;text-align: center;">@lang('home.pay_buy')</span></div> -->
										@endif
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>
                 
                 <a id="nonpckg" href="{{ url('account/manage?plan')}}" style="float:right;margin-top:10px;"><span style="background:#013d80;padding:5px 10px;color:#fff;">@lang('home.Use Package Plan?') ></span></a>
                    
                </div>


				<div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid hidden-sm hidden-md hidden-lg">
                        <ul id="post-job-ad-types2" class="text-center">
						 @foreach($rec as $keys=>$payment)
								@if($payment->title == "Basic")
                            <!----><li style="position:relative;background:#3a79d2;" class="text-left">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
									?>
								@endif
								@if($payment->title == "Golden")
                            <!----><li style="position:relative;background:#b0a48a;" class="text-left">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
									?>
								@endif
								@if($payment->title == "Special")
                            <!----><li style="position:relative;background:#4e6c7c;" class="text-left">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
									?>
								@endif
								@if($payment->title == "Latest")
                            <!----><li style="position:relative;background:#94a5a5;" class="text-left">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
									?>
								@endif
								@if($payment->title == "Hot")
                            <!----><li style="position:relative;background:#717171;" class="text-left">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
									?>
								@endif
								@if($payment->title == "Top Job")
                            <!----><li style="position:relative;background:#a8b3b9;" class="text-left">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
									?>
								@endif
								@if($payment->title == "Premium")
                            <!----><li style="position:relative;background:#a09d8e;" class="text-left">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
									?>
								@endif
								
                                <!---->
								<div style="height:40px">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="p_Category" value="{!! $payment->id!!}" style="margin-top:10px;margin-left:10px;">
									<input class="mat-radio-input visually-hidden" id="radioval" type="hidden" value="{!! $payment->price!!}">
									<span style="color:#fff;font-size: 15px;padding-left:10px;"><b>@lang('home.'.$payment->title)</b></span>&nbsp;<span style="color:#fff;font-size: 12px;padding-left:0px;"><b>@if($payment->title == "Basic") @lang('home.mpay_text') @else @lang('home.mpay_text2') @endif</b></span>
								</div>

							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                             
                                <div style="background:#fff;height:50px;text-align: center;">
                                    <!----><label for="{!! $payment->id!!}">                                       
										

										
                                        <div class="credits b" style="font-size: 13px;text-align: center;padding-top:5px;" >@lang('home.pay_cost') : @if($payment->price ==0)
										<span class="free" style="color:#118c4e">@lang('home.Free_text')<br><span style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600">&nbsp;</span>
										@else
										<span class="text-success" style="color:#118c4e" id="msimple_text{{$keys}}"></span>@lang('home.currencyday_text')<br><span style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600">@lang('home.paylocation')</span>
										
									@endif</div>

										

                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>
                 
                 <a id="nonpckg2" href="{{ url('account/manage?plan')}}" style="float:right"><span style="background:#013d80;padding:5px 10px;color:#fff;">@lang('home.Use Package Plan?') ></span></a>
                    
                </div>



            </div>
		
               
                  @endif
                    <div class="pnj-form-section">
                       
                        

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_department')</label>
                            <div class="col-md-7 pnj-form-field">
                                <select class="form-control select2" name="department" required>
                                    <option value="">@lang('home.s_department')</option>
                                    <option value="Accounting">@lang('home.Accounting')</option>
                                    <option value="Administration">@lang('home.Administration')</option>
                                    <option value="Customer Services">@lang('home.Customer Services')</option>
                                    <option value="Finance">@lang('home.Finance')</option>
                                    <option value="Human Resources">@lang('home.Human Resources')</option>
                                    <option value="Information Technology">@lang('home.Information Technology')</option>
                                    <option value="Marketing">@lang('home.Marketing')</option>
                                    <option value="Procurement">@lang('home.Procurement')</option>
                                    <option value="Production">@lang('home.Production')</option>
                                    <option value="Quality Control">@lang('home.Quality Control')</option>
                                   <option value="Research & Development">@lang('home.Research & Development')</option>
                                    <option value="Sales">@lang('home.Sales')</option>
                                    

                                    @foreach(JobCallMe::getDepartments() as $depart)
                                        <option value="{!! $depart->name !!}">{!! $depart->name !!}</option>
                                    @endforeach
                                </select>
							    <br>
								<span style="padding-top:5px;font-size:12px;color:#3a79d2;">※@lang('home.addDepartment-text')</span>
                            </div>
                           <div class="col-md-2 pnj-form-field" style="margin-top:5px;"> <a href="{{ url('account/employer/departments') }}"><span style="background:#f0ad4e;padding:5px 10px;margin-top:5px;color:#fff;">@lang('home.addDepartment') ></span></a></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_category')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-category" name="category" onchange="getSubCategories(this.value)" required>
										<option value="">@lang('home.s_category')</option>
									@foreach(JobCallMe::getCategories() as $cat)
                                        <option value="{!! $cat->categoryId !!}">@lang('home.'.$cat->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category" name="subCategory" onchange="getSubCategories2(this.value)" required>
									<option value="">@lang('home.Subcategory')</option>
								</select>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category2" name="subCategory2" required>
									<option value="">@lang('home.Subcategory2')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.careerlevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="careerLevel">
                                    <option value=" ">@lang('home.s_career')</option>
									@foreach(JobCallMe::getCareerLevel() as $career)
                                        <option value="{!! $career !!}">@lang('home.'.$career)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.experiencelevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="experience" required>
                                    @foreach(JobCallMe::getExperienceLevel() as $experience)
                                        <option value="{!! $experience !!}">@lang('home.'.$experience)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.vacancy')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="number" class="form-control" name="vacancy" placeholder="@lang('home.numbervacancy')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor" maxlength="1024"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.requireskills')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="skills" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.qualification')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="qualification" placeholder="@lang('home.qualification')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expiryhiringdate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker"  name="expiryDate" onkeypress="return false" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Associate Test/Questionnaire')</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="Questionnaire" type="checkbox" class="cbx-field" name="Questionnaire" value="yes">                             
                                        <label class="cbx" for="Questionnaire"></label>
                                        <label class="lbl" for="Questionnaire">@lang('home.Associate Test/Questionnaire')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-12">
                                       <select class="form-control" name="questionaire_id" id="ques_sel" disabled="disabled">
                                           <option value=""> @lang('home.select questionaires')</option>
                                           @foreach($questionaires as $question)
                                           <option value="{{ $question->ques_id}}">{{$question->title}}</option>

                                           @endforeach
                                       </select>                             
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                           <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Associate Evaluation Form')</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="evform" type="checkbox" class="cbx-field" name="evform" value="yes">                             
                                        <label class="cbx" for="evform"></label>
                                        <label class="lbl" for="evform">@lang('home.Associate Evaluation Form')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-12">
                                       <select class="form-control" name="evaluation_form" id="ev_form" disabled="disabled">
                                           <option value=""> @lang('home.select evaluation')</option>
                                           @foreach($evaluation as $form)
                                           <option value="{{ $form->id}}">{{$form->title}}</option>

                                           @endforeach
                                       </select>                             
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="expirediv">
                            <label class="control-label col-sm-3">@lang('home.expirydate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="secondDate" name="expiryAd" onkeypress="return false">
                            </div>
                        </div>
						<div class="form-group" id="durationdiv">
                            <label class="control-label col-sm-3">@lang('home.adduration')</label>
                            <div class="col-sm-9 pnj-form-field">
                           <input type="text" class="form-control" id="pas" name="duration" >
								
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.naturejob')</h3>
                    <div class="pnj-form-section">
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.jobinformationtype')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="type" >
                                    @foreach(JobCallMe::getJobType() as $jtype)
                                        <option value="{!! $jtype->name !!}">@lang('home.'.$jtype->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Responsibilities')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <!-- <input type="text" class="form-control" name="responsibilities" placeholder="@lang('home.Responsibilities')" required> -->
								<textarea name="responsibilities" class="form-control" placeholder="@lang('home.Responsibilities')"></textarea>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expptitle')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="expptitle">  
										<option value=" ">@lang('home.expptitle')</option>
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

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expposition')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="expposition">  	
										<option value=" ">@lang('home.s_career')</option>
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
                           <label class="control-label col-sm-3">@lang('home.shift')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="shift">
                                    @foreach(JobCallMe::getJobShifts() as $jshift)
                                        <option value="{!! $jshift->name !!}">@lang('home.'.$jshift->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.jobaddr')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="jobaddr" id="jobaddr" placeholder="@lang('home.jobaddrtext')"  required>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">@lang('home.Working day')</label>
                                <div class="col-md-3 pnj-form-field">
                                    <select class="form-control" name="jobdayval" required>
										<option value="jobday01" {{ $meta->jobdayval == 'jobday01' ? 'selected="selected"' : '' }}>@lang('home.jobday01')</option>
										<option value="jobday02" {{ $meta->jobdayval == 'jobday02' ? 'selected="selected"' : '' }}>@lang('home.jobday02')</option>
										<option value="jobday03" {{ $meta->jobdayval == 'jobday03' ? 'selected="selected"' : '' }}>@lang('home.jobday03')</option>
										<option value="jobday04" {{ $meta->jobdayval == 'jobday04' ? 'selected="selected"' : '' }}>@lang('home.jobday04')</option>
										<option value="jobday05" {{ $meta->jobdayval == 'jobday05' ? 'selected="selected"' : '' }}>@lang('home.jobday05')</option>
										<option value="jobday06" {{ $meta->jobdayval == 'jobday06' ? 'selected="selected"' : '' }}>@lang('home.jobday06')</option>
										<option value="jobday07" {{ $meta->jobdayval == 'jobday07' ? 'selected="selected"' : '' }}>@lang('home.jobday07')</option>
										<option value="jobday08" {{ $meta->jobdayval == 'jobday08' ? 'selected="selected"' : '' }}>@lang('home.jobday08')</option>
										<option value="jobday09" {{ $meta->jobdayval == 'jobday09' ? 'selected="selected"' : '' }}>@lang('home.jobday09')</option>
										<option value="jobday10" {{ $meta->jobdayval == 'jobday10' ? 'selected="selected"' : '' }}>@lang('home.jobday10')</option>
                                        
                                    </select>
                                </div>

								<div class="col-md-6 pnj-form-field">								
								
										<input type="text" class="form-control" name="jobdayval_text" placeholder="@lang('home.jobdayval_text')">
									
								</div>
                        </div>

						 <div class="form-group">
                            <label class="control-label col-md-3">@lang('home.Working hours')</label>
                                <div class="col-md-3 pnj-form-field">
                                    <select class="form-control" name="jobhoursval" required>
										<option value="jobhours01" {{ $meta->jobhoursval == 'jobhours01' ? 'selected="selected"' : '' }}>@lang('home.jobhours01')</option>
										<option value="jobhours02" {{ $meta->jobhoursval == 'jobhours02' ? 'selected="selected"' : '' }}>@lang('home.jobhours02')</option>
										<option value="jobhours03" {{ $meta->jobhoursval == 'jobhours03' ? 'selected="selected"' : '' }}>@lang('home.jobhours03')</option>
										<option value="jobhours04" {{ $meta->jobhoursval == 'jobhours04' ? 'selected="selected"' : '' }}>@lang('home.jobhours04')</option>
										<option value="jobhours05" {{ $meta->jobhoursval == 'jobhours05' ? 'selected="selected"' : '' }}>@lang('home.jobhours05')</option>
																			
                                    </select>
                                </div>

								<div class="col-md-6 pnj-form-field">								
								
										<input type="text" class="form-control" name="jobhoursval_text" placeholder="@lang('home.jobhoursval_text')">
									
								</div>
                        </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate1')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 benefits-checks">
                                        <input id="head" type="checkbox" class="cbx-field" name="head" value="yes">								
										<label class="cbx" for="head"></label>
                                        <label class="lbl" for="head">@lang('home.abouthead')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                
                                        <div class="col-md-4 benefits-checks">                                        
											<input id="dispatch" type="checkbox" class="cbx-field" name="dispatch" value="yes">
											<label class="cbx" for="dispatch"></label>
                                            <label class="lbl" for="dispatch">@lang('home.dispatchinformation')</label>
                                        </div>
                              
                                </div>
                            </div>
                        </div>

                   </div>


				   <h3>@lang('home.Eligibility and preferential terms')</h3>
                    <div class="pnj-form-section">
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.jobacademic')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control" name="jobacademic">  									
                                        <option value="highschool" {{ $meta->jobacademic == 'highschool' ? 'selected="selected"' : '' }}>@lang('home.highschool')</option>
                                        <option value="college" {{ $meta->jobacademic == 'college' ? 'selected="selected"' : '' }}>@lang('home.college')</option>
                                        <option value="university" {{ $meta->jobacademic == 'university' ? 'selected="selected"' : '' }}>@lang('home.university')</option>
                                        <option value="graduateschool" {{ $meta->jobacademic == 'graduateschool' ? 'selected="selected"' : '' }}>@lang('home.graduateschool')</option>
                                        <option value="Doctorate(phd)" {{ $meta->jobacademic == 'Doctorate(phd)' ? 'selected="selected"' : '' }}>@lang('home.Doctorate(phd)')</option>
										<option value="Vocational" {{ $meta->jobacademic == 'Vocational' ? 'selected="selected"' : '' }}>@lang('home.Vocational')</option>
										<option value="Associate Degree" {{ $meta->jobacademic == 'Associate Degree' ? 'selected="selected"' : '' }}>@lang('home.Associate Degree')</option>
										<option value="Certification" {{ $meta->jobacademic == 'Certification' ? 'selected="selected"' : '' }}>@lang('home.Certification')</option>
                                    
									</select>

									<div class="row" style="padding-top:20px">
                                   
                                        <div class="col-md-2 benefits-checks">
                                            <input id="jobacademic_not" type="checkbox" class="cbx-field" name="jobacademic_not" value="yes">								
											<label class="cbx" for="jobacademic_not"></label>
											<label class="lbl" for="jobacademic_not">@lang('home.Regardless Education')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobgraduate" type="checkbox" class="cbx-field" name="jobgraduate" value="yes">								
											<label class="cbx" for="jobgraduate"></label>
											<label class="lbl" for="jobgraduate">@lang('home.jobgraduate')</label>
                                        </div>

										
										
                                </div>


                           </div>
                       </div>
					    
					   <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.gender')</label>
                                <div class="col-md-9 pnj-form-field">
                                    <select class="form-control" name="gender">
										<option value="Nosex" {{ $meta->gender == 'Nosex' ? 'selected="selected"' : '' }}>@lang('home.Nosex')</option>
                                        <option value="Man" {{ $meta->gender == 'Man' ? 'selected="selected"' : '' }}>@lang('home.Man')</option>
                                        <option value="Female" {{ $meta->gender == 'Female' ? 'selected="selected"' : '' }}>@lang('home.female')</option>
                                    </select>
                                </div>
                        </div>

					
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.age')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    
									<div class="col-md-3 pnj-salary">
                                        <input type="text" class="form-control" name="jobage1" placeholder="@lang('home.age-text')">
                                    </div>
                                    <div class="col-md-3 pnj-salary">
                                        <input type="text" class="form-control" name="jobage2" placeholder="@lang('home.age-text')">
                                    </div>  
									<div class="col-md-2">
                                        <input id="jobnoage" type="checkbox" class="cbx-field" name="jobnoage" value="yes">								
											<label class="cbx" for="jobnoage"></label>
											<label class="lbl" for="jobnoage">@lang('home.jobnoage')</label>
                                    </div>
                                </div>
								
                            </div>
                        </div>
					</div>


				   <h3>@lang('home.admissionsprocess')</h3>
                    <div class="pnj-form-section">                        
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.admissionsprocess')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    @foreach(JobCallMe::jobProcess() as $process)
                                        <div class="col-md-4 benefits-checks col-xs-6">
                                            <input id="{{ str_replace(' ','-',$process) }}"  type="checkbox" class="cbx-field" name="process[]" value="{{ $process }}">
                                            <label class="cbx" for="{{ str_replace(' ','-',$process) }}"></label>
                                            <label class="lbl" for="{{ str_replace(' ','-',$process) }}">@lang('home.'.$process)<!-- {{ $process }} --></label>
                                        </div>
                                    @endforeach
                                        <div class="col-md-4 ">
                                            <input id="addprocess"  type="checkbox" class="cbx-field" value="yes">
                                            <label class="cbx" for="addprocess"></label>
                                            <label class="lbl" for="addprocess">@lang('home.add')</label>
                                        </div>
                                        <div class="optionBox" id="moreprocess" style="display:none">
                                            
                                            <div class="col-md-10 block">
                                                <button type="button" class="add btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
						
                                </div>

								

                            </div>							
                        </div>


						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.How to register')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">                                    
                                        <div class="col-md-12 benefits-checks">
                                            <input id="jobreceipt01"  type="checkbox" class="cbx-field" name="jobreceipt01" value="yes">
                                            <label class="cbx" for="jobreceipt01"></label>
                                            <label class="lbl" for="jobreceipt01">@lang('home.jobreceipt01')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt02"  type="checkbox" class="cbx-field" name="jobreceipt02"  value="yes">
                                            <label class="cbx" for="jobreceipt02"></label>
                                            <label class="lbl" for="jobreceipt02">@lang('home.jobreceipt02')</label>
                                        </div>
										<div class="col-sm-5 pnj-form-field">
											<input type="text" class="form-control" name="jobhomgpage" placeholder="@lang('home.jobhomgpage')">
										</div>
								</div>
								<div class="row"> 
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt07"  type="checkbox" class="cbx-field" name="jobreceipt07"  value="yes">
                                            <label class="cbx" for="jobreceipt07"></label>
                                            <label class="lbl" for="jobreceipt07">@lang('home.jobreceipt07')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt03"  type="checkbox" class="cbx-field" name="jobreceipt03"  value="yes">
                                            <label class="cbx" for="jobreceipt03"></label>
                                            <label class="lbl" for="jobreceipt03">@lang('home.jobreceipt03')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt04"  type="checkbox" class="cbx-field" name="jobreceipt04"  value="yes">
                                            <label class="cbx" for="jobreceipt04"></label>
                                            <label class="lbl" for="jobreceipt04">@lang('home.jobreceipt04')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt05"  type="checkbox" class="cbx-field" name="jobreceipt05"  value="yes">
                                            <label class="cbx" for="jobreceipt05"></label>
                                            <label class="lbl" for="jobreceipt05">@lang('home.jobreceipt05')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt06"  type="checkbox" class="cbx-field" name="jobreceipt06"  value="yes">
                                            <label class="cbx" for="jobreceipt06"></label>
                                            <label class="lbl" for="jobreceipt06">@lang('home.jobreceipt06')</label>
                                        </div>
                                        				
                                </div>
                            </div>							
                        </div>


                    </div>	



                    <h3>@lang('home.compensationbenefits')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.salary')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 pnj-salary">
                                        <input type="number" class="form-control" name="minSalary" placeholder="@lang('home.minsalary') 20,000,000">
                                    </div>
                                    <div class="col-md-4 pnj-salary">
                                        <input type="number" class="form-control" name="maxSalary" placeholder="@lang('home.Maxsalary') 25,000,000">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control col-md-4 select2" name="currency" required>
                                            @foreach(JobCallMe::siteCurrency() as $currency)
                                                <option value="{!! $currency !!}">{!! $currency !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

								<div class="row" style="padding-top:20px">


                                        <div class="col-md-4 benefits-checks">
											<input class="mat-radio-input cdk-visually-hidden" type="radio" name="afterinterview" value="expectedSalary-check" @if($meta->afterinterview == "expectedSalary-check") checked @else @endif > @lang('home.expectedSalary-check')	

                                            <!-- <input id="expectedSalary" type="checkbox" class="cbx-field" name="expectedSalary" value="yes">								
											<label class="cbx" for="expectedSalary"></label>
											<label class="lbl" for="expectedSalary">@lang('home.expectedSalary-check')</label> -->
                                        </div>

										<div class="col-md-4 benefits-checks">
											<input class="mat-radio-input cdk-visually-hidden" type="radio" name="afterinterview" value="Decision after interview" @if($meta->afterinterview == "Decision after interview") checked @else @endif> @lang('home.Decision after interview')&nbsp;&nbsp;&nbsp;

                                            <!-- <input id="afterinterview" type="checkbox" class="cbx-field" name="afterinterview" value="yes">								
											<label class="cbx" for="afterinterview"></label>
											<label class="lbl" for="afterinterview">@lang('home.Decision after interview')</label> -->
                                        </div>										
										
                                </div>

                            </div>
                        </div>

                            
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.benefits')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    @foreach(JobCallMe::jobBenefits() as $benefit)
                                        <div class="col-md-4 benefits-checks col-xs-6">
                                            <input id="{{ str_replace(' ','-',$benefit) }}"  type="checkbox" class="cbx-field" name="benefits[]" value="{{ $benefit }}">
                                            <label class="cbx" for="{{ str_replace(' ','-',$benefit) }}"></label>
                                            <label class="lbl" for="{{ str_replace(' ','-',$benefit) }}">@lang('home.'.$benefit)</label>
                                        </div>
                                    @endforeach
                                        <div class="col-md-4 col-xs-6">
                                            <input id="addbenefit"  type="checkbox" class="cbx-field" value="yes">
                                            <label class="cbx" for="addbenefit"></label>
                                            <label class="lbl" for="addbenefit">@lang('home.add')</label>
                                        </div>
                                        <div class="optionBox" id="morebenefit" style="display:none">
                                            
                                            <div class="col-md-10 block">
                                                <button type="button" class="add2 btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.location')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.country')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.state')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" required>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input id="pac-input" name="Address" class="form-control" type="text" placeholder="@lang('home.Enter a location')" requried>
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
                                <input type="text" class="form-control" name="Address2" id="Address2" placeholder="@lang('home.address2')"  required>
                            </div>
                        </div>

                    </div>
                    <!-- google map code html -->
                    <div id="map"></div>
                    <div id="infowindow-content">
                      <img src="" width="16" height="16" id="place-icon">
                      <span id="place-name"  class="title"></span><br>
                      <span id="place-address"></span>
                    </div>
                    <h3>@lang('home.declarationandacknowledgement')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-9 da-box">
                                <p>@lang('home.pleasereadcarefully')</p>
                                <ul>
                                    <li>@lang('home.postli1')</li>
                                    <li>@lang('home.postli2')</li>
                                    <li>@lang('home.postli3')</li>
                                    <li>@lang('home.postli4')</li>
                                </ul>
                                <p>@lang('home.postp')</p>
                            </div>
                        </div>
                    </div>
					<div class="col-md-offset-3 col-md-3  pnj-btns">
                        <span style="font-size:17px;padding-right:50px;" id="total">@lang('home.Total Amount') : US$</span>						
                    </div>
                    <div class="col-md-6  pnj-btns">                        
						<button type="submit" class="btn btn-primary" name="save">@lang('home.postjob')</button>
                        <button type="submit" class="btn btn-default" name="draft" value="draft">@lang('home.draft')</button>
                        <button class="btn btn-default"><a href="{{ url('account/employer') }}">@lang('home.CANCEL')</a></button>
                    </div>
                
            </div>
      
  
	</div>
</form>

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
<script type="text/javascript">
var process = "";
var alrt="";
$('#Questionnaire').on('change',function(){
    if($(this).is(':checked') == false){
        $('#ques_sel').attr('disabled','disabled');
    }else{
        $('#ques_sel').removeAttr('disabled');
    }
   
})
$('#evform').on('change',function(){
    if($(this).is(':checked') == false){
        $('#ev_form').attr('disabled','disabled');
    }else{
        $('#ev_form').removeAttr('disabled');
    }
   
})
$(document).ready(function(){

   ////// FOR PLAN//////////
     var jArray = <?php echo json_encode($plan); ?>;

     for(var i=0;i<jArray.length;i++){
     $('#class_text'+i).html('￦ '+jArray[i].amount*1000+'')
	 $('#mclass_text'+i).html('￦ '+jArray[i].amount*1000+'')
        //alert(jArray[i].amount);
       }
     
    $('#us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<jArray.length;i++){

     $('#class_text'+i).html('US$ '+jArray[i].amount+'.00')
	 $('#mclass_text'+i).html('US$ '+jArray[i].amount+'.00')
        //alert(jArray[i].amount);
         }
        }
    }) ;

    $('#kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<jArray.length;i++){
     $('#class_text'+i).html('￦ '+jArray[i].amount*1000 +'')
	 $('#mclass_text'+i).html('￦ '+jArray[i].amount*1000+'')
       // alert(jArray[i].amount*1100);
      }
    }
}) ;
    

    ////// FOR PLAN//////////

 ////// FOR Simle/////////
     var simplearray = <?php echo json_encode($rec); ?>;

     for(var i=0;i<simplearray.length;i++){
     $('#simple_text'+i).html('￦ '+simplearray[i].price*1100+'')
	 $('#msimple_text'+i).html('￦ '+simplearray[i].price*1100+'')
        //alert(jArray[i].amount);
	 $('.form-horizontal input[name="paycurrency"]').val('KRW');
       }
     
    $('#us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){

     $('#simple_text'+i).html('US$ '+simplearray[i].price+'.00')
	 $('#msimple_text'+i).html('US$ '+simplearray[i].price+'.00')
        //alert(jArray[i].amount);
	 $('.form-horizontal input[name="paycurrency"]').val('USD');
         }
        }
    }) ;

    $('#kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){
     $('#simple_text'+i).html('￦ '+simplearray[i].price*1100 +'')
	 $('#msimple_text'+i).html('￦ '+simplearray[i].price*1100+'')
       // alert(jArray[i].amount*1100);
	 $('.form-horizontal input[name="paycurrency"]').val('KRW');
      }
    }
}) ;
    
    ////// FOR PLAN//////////
    


   //console.log(l);
    $('#post-job-ad-types li').first().find('span .mat-radio-input').bind('click',function(e){
        $('#durationdiv').hide();
        $('#total').hide();
        $('#expirediv').hide();
    })
    
    $('#post-job-ad-types li').first().find('span .mat-radio-input').trigger('click');
	
    $('body').on('click','.mat-radio-input',function(e){
		console.log($(e.target).val());
	 alrt=$(e.target).siblings('input').val();
     var plans=$('.checkplan').val();
    // alert(plans);
	 console.log(alrt);
     if(alrt==0 || plans=='plan')
     {
         $('#durationdiv').hide();
         $('#total').hide();
         $('#expirediv').hide();
         
        // alert("nabeel");
     }
     else{
          $('#durationdiv').show();
         $('#total').show();
          $('#expirediv').show();
        
     }
		
	})
    $('#addprocess').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
        //$('#addlable').show();
        $('#moreprocess').show();
    }
    else{
        //$('#addlable').hide();
        $('#moreprocess').hide();
    }
});

 $('#addbenefit').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
       // $('#addlable').show();
        $('#morebenefit').show();
    }
    else{
      //  $('#addlable').hide();
        $('#morebenefit').hide();
    }
})
 
  

    getStates($('.job-country option:selected:selected').val());
    getSubCategories($('.job-category option:selected:selected').val());

	getSubCategories2($('.job-category option:selected:selected').val());
});

$('.add').click(function() {
    $('#moreprocess').append('<div class="col-md-8 pnj-salary block" style="display: flex;margin-bottom: 9px;"><input type="text" class="form-control" name="process[]" required/><button type="button" class="remove btn btn-danger" style="padding-left: 14px;"><i class="fa fa-minus"></i></button></div>');

});
$('.add2').click(function() {
    $('#morebenefit').append('<div class="col-md-8 pnj-salary block" style="display: flex;margin-bottom: 9px;"><input type="text" class="form-control" name="benefits[]" required/><button type="button" class="remove btn btn-danger" style="padding-left: 14px;"><i class="fa fa-minus"></i></button></div>');

});
$('#nopckg').click(function() {
    $('.checkplan').val('');
    $('#pckg').hide();
    $('#notpckg').show();
     $('#durationdiv').show();
         $('#total').show();
          $('#expirediv').show();
});
$('#nopckg2').click(function() {
    $('.checkplan').val('');
    $('#pckg').hide();
    $('#notpckg').show();
     $('#durationdiv').show();
         $('#total').show();
          $('#expirediv').show();
});
$('#nonpckg').click(function() {
    $('.checkplan').val('plan');
    $('#pckg').show();
    $('#notpckg').hide();
     $('#durationdiv').hide();
         $('#total').hide();
         $('#expirediv').hide();
});
$('#nonpckg2').click(function() {
    $('.checkplan').val('plan');
    $('#pckg').show();
    $('#notpckg').hide();
     $('#durationdiv').hide();
         $('#total').hide();
         $('#expirediv').hide();
});

$('.optionBox').on('click','.remove',function() {
 	$(this).parent().remove();
});
$('#secondDate').on('change', function() {
		  myfunc()
});
      var total='';
       function myfunc(){
       var start = new Date();
      // var start= $("#firstDate").datepicker("getDate");
    	var end= $("#secondDate").datetimepicker("getDate");
   		days = (end- start) / (1000 * 60 * 60 * 24);
      var to= Math.round(days);
       total= to * alrt;
      $('#pas').val(to);
      
    if ($('#kr').is(':checked')) {
	  $('#total').html("@lang('home.Total Amount') : ₩ "+total*1100 );
     // alert('kr');
    }

     if ($('#us').is(':checked')) {
	  $('#total').html("@lang('home.Total Amount') : $ "+total );
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
            var newOption = new Option('Select State', '0', true, false);
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
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '0', true, false);
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

function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
var formPost = 1;
</script>
<!-- google map code start from there  -->
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 37.532600, lng: 127.024612},
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