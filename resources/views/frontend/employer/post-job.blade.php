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
                            <label class="control-label col-sm-3">@lang('home.title') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_department') *</label>
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
                            <label class="control-label col-sm-3">@lang('home.s_category') *</label>
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
                            <label class="control-label col-sm-3">@lang('home.experiencelevel') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="experience" required>
                                    @foreach(JobCallMe::getExperienceLevel() as $experience)
                                        <option value="{!! $experience !!}">@lang('home.'.$experience)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.vacancy') *</label>
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
                            <label class="control-label col-sm-3">@lang('home.requireskills') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="skills" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.qualification') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="qualification" placeholder="@lang('home.qualification')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expiryhiringdate') *</label>
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
                           <label class="control-label col-sm-3">@lang('home.shift')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="shift">
                                    @foreach(JobCallMe::getJobShifts() as $jshift)
                                        <option value="{!! $jshift->name !!}">@lang('home.'.$jshift->name)</option>
                                    @endforeach
                               </select>
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
										<option value="Any" {{ $meta->gender == 'Nosex' ? 'selected="selected"' : '' }}>@lang('home.Nosex')</option>
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
                                        <input id="min_job" type="text" class="form-control" name="jobage1" placeholder="@lang('home.age-min-text')">
                                    </div>
                                    <div class="col-md-3 pnj-salary">
                                        <input id="max_job" type="text" class="form-control" name="jobage2" placeholder="@lang('home.age-max-text')">
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

                    <h3>@lang('home.compensationbenefits')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.salary') *</label>
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
                            <label class="control-label col-sm-3">@lang('home.state') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" required>
                                </select>
                            </div>
                        </div>
                        	<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address2') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="Address2" id="Address2" placeholder="@lang('home.address2')" value="{{$company[0]->companyAddress}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.map_location') *</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input id="pac-input" name="Address" class="form-control" type="text" placeholder="@lang('home.Enter a location')" requried value="{{$company[0]->companyMap}}">
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
   
});

$('#jobnoage').on('change',function(){
    if($(this).is(':checked') == false){
        $('#min_job, #max_job').removeAttr('disabled');
    }else{
        $('#min_job, #max_job').attr('disabled','disabled');
        $('#min_job, #max_job').val('');
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
          center: {lat: 33.601921, lng: 73.038078},
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