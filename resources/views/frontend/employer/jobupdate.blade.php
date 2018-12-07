		@extends('frontend.layouts.app')

		@section('title', 'Download')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
			<div class="pricing blue" fxflex="calc(50% -15px)" fxflex.xs="100%" style="flex: 1 1 calc(50% - 15px); box-sizing: border-box; margin-right: 15px; min-width: calc(50% - 15px);">
        <div class="no-bg mat-card">
		  @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif
                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
            <h3 class="text-center text-lg mb20">
                
                @lang('home.Job Posting that Deliver Results')
            </h3>
            <p class="text-sm">@lang('home.Better job exposure! View, Save and Export all received resumes.')</p>
			<p class="col-md-12">
                    <span>@lang('home.selectcurrency'): &nbsp;</span>
                      <input type="radio" name="gender" id="wr_kr" value="kr" checked="checked"> @lang('home.paykorean')
                      &nbsp;&nbsp;<input type="radio" name="gender" id="wr_us" value="us"> @lang('home.US$')
                      </p>
              @foreach($recs as $key => $payment)
			  @if($key > 0)
				  <div class="col-md-4">
                        <div class="pricing-block mat-elevation-z6">
                            <h5 class="title">
							@if(app()->getLocale() == "kr")
						        @lang('home.'.$payment->title) @lang('home.payJobs')
							@else
								@lang('home.payJobs') @lang('home.'.$payment->title)
							@endif </h5>
                            <div class="desc">
                                <!----><ul class="list-unstyled">                                    
                                    <li>On Homepage: 3 days</li>
                                    <li>Job Mail 2 times</li>
                                    <li>Notifications: Multiple</li>
                                    <li>Priority over Basic jobs</li>
                                    <li>Listing Priority: 3 days</li>
                                    <li>Extended Information</li>
                                    <li>Save Resumes</li>

                                </ul>
                                
                            </div>
                            <div class="price">
                                <span class="text-success">
                                    <!---->
                                    <span class="text-md b" id="wr_text{{$key}}"></span>
                                </span>
                            </div>

                          <form class="ng-untouched ng-pristine ng-valid" action="{{ url('account/completePayment') }}" method="post">
                                <input  type="hidden" name="p_Category" value="{!! $payment->id!!}" class="ng-untouched ng-pristine ng-valid">
								<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								
								<input name="jType" type="hidden" value="Paid"/>
                                <div>
                                    <button class="btn btn-primary" color="primary"  type="submit"><span class="mat-button-wrapper">@lang('home.Buy Now')</span><div class="mat-button-ripple mat-ripple" md-ripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>
                        </div>
                    </div>
					@endif
					@endforeach
                 
           
            <div class="text-sm mt25">
                <span class="text-success b" style="text-decoration:underline;"></span>.
               
            </div>

        </div>
    </div>
			   
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">


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


			 var simplearray = <?php echo json_encode($recs); ?>;

				 for(var i=0;i<simplearray.length;i++){
				 $('#wr_text'+i).html('￦'+number_format(simplearray[i].price*1000)+'')
					//alert(jArray[i].amount);
				   }
				 
				$('#wr_us').click(function(){
				if ($(this).is(':checked')) {
				for(var i=0;i<simplearray.length;i++){

				 $('#wr_text'+i).html('US$ '+simplearray[i].price+'.00')
					//alert(jArray[i].amount);
					 }
					}
				}) ;

				$('#wr_kr').click(function(){
				if ($(this).is(':checked')) {
				for(var i=0;i<simplearray.length;i++){
				 $('#wr_text'+i).html('￦ '+number_format(simplearray[i].price*1000) +'')
				   // alert(jArray[i].amount*1100);
				  }
				}
			}) ;

		</script>
		@endsection