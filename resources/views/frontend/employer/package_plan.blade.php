@extends('frontend.layouts.app')

@section('title','Share Job')

@section('content')

<section id="company-box">
			<div class="container" >
			<div class="row">
   
			<div class="pricing blue" fxflex="calc(50% -15px)" fxflex.xs="100%" style="flex: 1 1 calc(50% - 15px); box-sizing: border-box; margin-right: 15px; min-width: calc(50% - 15px);">
            <div class="col-md-12"  style=" background-color: white; box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);">
		  
            <h3 class="text-center text-lg mb20">
                
                @lang('home.Job Posting that Deliver Results')
            </h3>
			
					<div style="padding-bottom:20px">
						<span>@lang('home.selectcurrency'): &nbsp;</span>
                        <input type="radio" name="gender" id="kr" value="kr" checked="checked"> @lang('home.paykorean')
                      &nbsp;&nbsp;<input type="radio" name="gender" id="us" value="us"> US$
                    </div>

              @foreach($plan as  $key=>$payment)
			  
				  <div class="col-md-3">
                        

						<ul id="post-job-ad-types3">
								
								@if($payment->type == "Basic")
                            <!----><li style="position:relative;background:#3a79d2;">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
									?>
								@endif
								@if($payment->type == "Golden")
                            <!----><li style="position:relative;background:#b0a48a;">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
									?>
								@endif
								@if($payment->type == "Special")
                            <!----><li style="position:relative;background:#4e6c7c;">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
									?>
								@endif
								@if($payment->type == "Latest")
                            <!----><li style="position:relative;background:#94a5a5;">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
									?>
								@endif
								@if($payment->type == "Hot")
                            <!----><li style="position:relative;background:#717171;">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
									?>
								@endif
								@if($payment->type == "Top")
                            <!----><li style="position:relative;background:#a8b3b9;">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
									?>
								@endif
								@if($payment->type == "Premium")
                            <!----><li style="position:relative;background:#a09d8e;">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
									?>
								@endif

								@if($payment->type == "Resume Download")
                            <!----><li style="position:relative;background:#118c4e;">
									<?php
										$payad_text = "resumedown_text";
										$payad_text2 = "resumedown_text2";
									?>
								@endif
								
                                <!---->
								<div style="height:40px;text-align: center;padding-top:10px;">
									
									
									<span style="color:#fff;font-size: 15px;padding-left:0px;"><b>@lang('home.'.$payment->type)</b></span>
								</div>

							   <div class="" style="text-align: center;"><span style="display:none">&nbsp;</span>
                             
                                <div style="background:#fff;">
                                    <!----><label for="{!! $payment->id!!}">

										@if($payment->type == "Resume Download")
										<div style="font-size: 15px;text-align: center;padding-top:20px" >@lang('home.Resume_method')</div>	
										@endif
                                        
										@if($payment->type == "Basic")
										<div style="font-size: 17px;text-align: center;padding:20px 15px 10px 15px;" >@lang('home.'.$payad_text)</div>
										<div style="font-size: 13px;text-align: center;padding:20px 15px 25px 15px;" >@lang('home.'.$payad_text2)</div>
										@elseif($payment->type == "Resume Download")
										<div style="font-size: 17px;text-align: center;padding:20px 15px 10px 15px;" >@lang('home.'.$payad_text)</div>
										<div style="font-size: 13px;text-align: center;padding:10px 15px 10px 15px;" >+{{$payment->quantity}}@lang('home.'.$payad_text2)</div>
										@else
										<div style="font-size: 13px;text-align: center;padding:20px 20px 0 15px;" >@lang('home.'.$payad_text)</div>
										<div style="font-size: 13px;text-align: center;padding:20px 25px;" >@lang('home.'.$payad_text2)</div>
										@endif

										
										
										
										
										@if($payment->type != "Resume Download")
										<div style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600" >@lang('home.paylocation')</div>
										@else
										<div style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600" >@lang('home.resumeday1') : @lang('home.resumeday2')</div>										
										@endif
										

										
                                        <div class="credits b" style="font-size: 13px;text-align: center;" >@lang('home.pay_cost') : 
											<span class="text-success" id="class_text{{$key}}"></span> @if($payment->type != "Resume Download")@lang('home.currencyday_text'){{$payment->duration}}@lang('home.currencyday_text2') @endif
										</div>

										


										@if($payment->type == "Basic")
										<div style="text-align: center;padding-top:15px;"><span style="font-size: 15px;background:#118c4e;padding:5px 20px;color:#fff;width:100px;text-align: center;">@lang('home.Free')</span></div>
										@else
										
										<form class="ng-untouched ng-pristine ng-valid" action="{{ url('account/packageinfo') }}" method="post">
                               
								{{ csrf_field() }}
								
								<input name="pckg_id" type="hidden" value="{!!$payment->pckg_id !!}"/>
                                <input name="cat_id" type="hidden" value="{!!$payment->cat_id !!}"/>
                                <input name="type" type="hidden" value="{{ $payment->type }}"/>
                                <input name="amount" type="hidden" value="{!! $payment->amount !!}"/>
                                <input name="quantity" type="hidden" value="{!! $payment->quantity !!}"/>
                                <input name="duration" type="hidden" value="{!! $payment->duration !!}"/>
								<input name="currency" type="hidden"/>
                                
                                <div style="text-align: center;padding-top:15px;padding-bottom:15px;">
                                    <button class="btn btn-primary" color="primary"  type="submit"><span class="mat-button-wrapper" style="padding-left:10px;padding-right:10px;">@lang('home.pay_buy')</span><div class="mat-button-ripple mat-ripple" md-ripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>


										
										@endif

                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							
                        </ul>


                    </div>
					
					@endforeach
                 

                </div>
            </div>
               </div>
                </div>
                  </div>
	</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">

		   ////// FOR PLAN//////////
     var jArray = <?php echo json_encode($plan); ?>;

     for(var i=0;i<jArray.length;i++){
     $('#class_text'+i).html('￦ '+jArray[i].amount*1100+'(부가세 포함)')
        //alert(jArray[i].amount);
	 //$('.ng-untouched input[name="amount"]').val(jArray[i].amount*1000);
	 $('.ng-untouched input[name="currency"]').val('KRW');
       }
     
    $('#us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<jArray.length;i++){

     $('#class_text'+i).html('US$ '+jArray[i].amount+'.00')
        //alert(jArray[i].amount);
	 //$('.ng-untouched input[name="amount"]').val(jArray[i].amount*1000);
	 $('.ng-untouched input[name="currency"]').val('USD');
         }
        }
    }) ;

    $('#kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<jArray.length;i++){
     $('#class_text'+i).html('￦ '+jArray[i].amount*1100 +'(부가세 포함)')
       // alert(jArray[i].amount*1100);
	 //$('.ng-untouched input[name="amount"]').val(jArray[i].amount*1000);
	 $('.ng-untouched input[name="currency"]').val('KRW');
      }
    }
}) ;
    

    ////// FOR PLAN//////////

 ////// FOR Simle/////////
     var simplearray = <?php echo json_encode($rec); ?>;

     for(var i=0;i<simplearray.length;i++){
     $('#simple_text'+i).html('￦ '+simplearray[i].price*1000+'')
        //alert(jArray[i].amount);
       }
     
    $('#us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){

     $('#simple_text'+i).html('US$ '+simplearray[i].price+'.00')
        //alert(jArray[i].amount);
         }
        }
    }) ;

    $('#kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){
     $('#simple_text'+i).html('￦ '+simplearray[i].price*1000 +'')
       // alert(jArray[i].amount*1100);
      }
    }
}) ;


		</script>
		@endsection