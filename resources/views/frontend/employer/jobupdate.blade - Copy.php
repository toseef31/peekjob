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
                
                Job Posting that Deliver Results
            </h3>
            <p class="text-sm">Better job exposure! View, Save and Export all received resumes.</p>
              
				  <div class="col-md-4">
                        <div class="pricing-block mat-elevation-z6">
                            <h5 class="title">Jobs Gallery</h5>
                            <div class="desc">
                                <!----><ul class="list-unstyled">
                                    <li>Exposure: Basic</li>
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
                                    <span class="text-md b">$20.30</span>
                                </span>
                            </div>

                          <form class="ng-untouched ng-pristine ng-valid" action="{{ action('frontend\Employer@update') }}" method="post">
                                <input  type="hidden" name="amount" value="20.30" class="ng-untouched ng-pristine ng-valid">
								<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								<input name="p_Category" type="hidden" value="1"/>
								<input name="jType" type="hidden" value="Paid"/>
                                <div>
                                    <button class="btn btn-primary" color="primary"  type="submit"><span class="mat-button-wrapper">Buy Now</span><div class="mat-button-ripple mat-ripple" md-ripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>
                        </div>
                    </div>
                  <div class="col-md-4">
                        <div class="pricing-block mat-elevation-z6">
                            <!---->

                            <h5 class="title">Hot Jobs</h5>
                            <div class="desc">
                                <!----><ul class="list-unstyled">
                                    

                                    <li>Exposure: Moderate</li>
                                    <li>On Homepage: 10 days</li>
                                    <li>Job Mail 3 times</li>
                                    <li>Notifications: Multiple</li>
                                    <li>Priority over Gallery</li>
                                    <li>Listing Priority: 10 days</li>
                                    <li>Extended Information</li>
                                    <li>Save and Export</li>

                                </ul>
                            </div>
                            <div class="price">
                                <span class="text-success">
                                    <!---->
                                    <span class="text-md b">$52.20</span>
                                </span>
                            </div>

                           <form class="ng-untouched ng-pristine ng-valid" action="{{ action('frontend\Employer@update') }}" method="post">
                                <input  type="hidden" name="amount" value="52.20" class="ng-untouched ng-pristine ng-valid">
								<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								<input name="p_Category" type="hidden" value="2"/>
								<input name="jType" type="hidden" value="Paid"/>
                                <div>
                                    <button class="btn btn-primary" color="primary" type="submit"><span class="mat-button-wrapper">Buy Now</span><div class="mat-button-ripple mat-ripple" ></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="pricing-block mat-elevation-z6">
                            <!----><div class="ribbon red" style="right:13px"><span>Best Value</span></div>

                            <h5 class="title">Premium Jobs</h5>
                            <div class="desc">
                                <!---->
                                <!----><ul class="list-unstyled">
                                    
                                    <li>Exposure: Highest</li>
                                    <li>On Homepage: 30 days</li>
                                    <li>Job Mail 5 times</li>
                                    <li>Notifications: Multiple</li>
                                    <li>Priority over Hot jobs</li>
                                    <li>Listing Priority: 30 days</li>
                                    <li>Extended Information</li>
                                    <li>Save and Export</li>
                                </ul>
                            </div>
                            <div class="price">
                                <span class="text-success">
                                    <!---->
                                    <span class="text-md b">$75.40</span>
                                </span>
                            </div>

                            <form class="ng-untouched ng-pristine ng-valid" action="{{ action('frontend\Employer@update') }}" method="post">
                                <input  type="hidden" name="amount" value="75.40" class="ng-untouched ng-pristine ng-valid">
								<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								<input name="p_Category" type="hidden" value="3"/>
								<input name="jType" type="hidden" value="Paid"/>
								
                                <div>
                                    <button class="btn btn-primary" color="primary" type="submit"><span class="mat-button-wrapper">Buy Now</span><div class="mat-button-ripple mat-ripple" ></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>
                        </div>
                    </div>
                
           
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
		</script>
		@endsection