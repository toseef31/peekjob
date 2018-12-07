<!--Footer-->
<footer id="footer">
    <div class="container hidden-xs">
        <div class="col-md-2">
            <!-- <h5><span class="footer-title-box" style="background-color: #9b9b36">@lang('home.catocc')</span></h5> -->
            <h5>&nbsp;</h5>
            <div style="width:100%;overflow: visible;background:#605e63;margin-bottom: 30px;">
                <select class="form-control select3" name="career" onchange="location.href=this.value" style="width:200px;overflow: visible;">
                    <option value="">@lang('home.catocc')</option>
                    @foreach(JobCallMe::getCategories() as $fCat)
                      <option value="{{ url('jobs?category='.$fCat->categoryId) }}">@lang('home.'.ucfirst($fCat->name))<!-- {!! $cat->name !!} --></option>
                    @endforeach
                </select>
            </div>

                <h5>
                    <div style="width:100%;overflow: visible;background:#94a5a5;">
                        <select class="form-control select3" name="htype" onchange="location.href=this.value" style="width:200px;overflow: visible;">
                            <option value="">@lang('home.abouthead')</option>
                            @foreach(JobCallMe::getCategories() as $fCat)

                            <option value="{{ url('jobs?category='.$fCat->categoryId.'&head=yes') }}">@lang('home.'.ucfirst($fCat->name))<!-- {!! $cat->name !!} --></option>


                            @endforeach
                        </select>
                    </div>
                </h5>

                
            </div>
        <div id="feed-header" class="none">@lang('home.feedback_header')</div>
        <div id="feedback-main" class="none">@lang('home.feedback')</div>
        <div id="feedback-email" class="none">@lang('home.enteremail')</div>
        <div id="feedback-message" class="none">@lang('home.details')</div>
        <div id="feedback-submit" class="none">@lang('home.submit')</div>
        <div id="feedback-drop" class="none">
            <option>@lang('home.selecttype')</option>
            <option>@lang('home.bug')</option>
            <option>@lang('home.feature')</option>
            <option>@lang('home.feedback')</option>
            <option>@lang('home.testimonial')</option>
            
        </div>

        <div class="col-md-2">
            <!-- <h5><span class="footer-title-box" style="background-color: #8d7d8d">@lang('home.hourwork')</span></h5> -->
            <h5>&nbsp;</h5>
            <div style="width:100%;overflow: visible;background:#96aaa8;margin-bottom: 30px;">
                <select class="form-control select3" name="career" onchange="location.href=this.value" style="width:200px;overflow: auto;">
                    <option value="">@lang('home.hourwork')</option>
                    @foreach(JobCallMe::getJobShifts() as $fShift)
                    <option value="{{ url('jobs?shift='.$fShift->name) }}">@lang('home.'.ucfirst($fShift->name))<!-- {!! $cat->name !!} --></option>
                    @endforeach
                </select>
            </div>
     
                <h5>
                    <div style="width:100%;overflow: visible;background:#4e6c7c;">
                        <select class="form-control select3" name="dtype" onchange="location.href=this.value" style="width:200px;overflow: visible;">
                            <option value="">@lang('home.dispatchinformation')</option>
                            @foreach(JobCallMe::getCategories() as $fCat)

                            <option value="{{ url('jobs?category='.$fCat->categoryId.'&dispatch=yes') }}">@lang('home.'.ucfirst($fCat->name))<!-- {!! $cat->name !!} --></option>

                            @endforeach
                        </select>
                    </div>
                </h5>  

        </div>

        <div class="col-md-2">
            <!-- <h5><span class="footer-title-box" style="background-color: #94a5a5">@lang('home.jobcareer')</span></h5> -->
            <h5>&nbsp;</h5>
            <div style="width:100%;overflow: visible;background:#94a5a5;margin-bottom: 30px;">
                <select class="form-control select3" name="career" onchange="location.href=this.value" style="width:200px;overflow: auto;">
                    <option value="">@lang('home.jobcareer')</option>
                    @foreach(JobCallMe::getExperienceLevel() as $career)
                    <option value="{{ url('jobs?career='.$career) }}">@lang('home.'.$career)<!-- {!! $cat->name !!} --></option>
                    @endforeach
                </select>
            </div>

               <h5>
               <div style="width:100%;overflow: visible;background:#695f47;border: 1px solid white; padding: 9px;">
            <a style="color:white" href="{{ url('account/employer/job/new') }}">@lang('home.postjobnew')</a>
            </div>
           </h5>

        </div>

        <div class="col-md-2">
            <!-- <h5><span class="footer-title-box" style="background-color: #4e6c7c">@lang('home.jobinformationtype')</span></h5> -->
            <h5>&nbsp;</h5>
            <div style="width:100%;overflow: visible;background:#4e6c7c;margin-bottom: 30px;">
                <select class="form-control select3" name="career" onchange="location.href=this.value" style="width:200px;overflow: auto;">
                    <option value="">@lang('home.jobinformationtype')</option>
                    @foreach(JobCallMe::getJobType() as $fType)
                    <option value="{{ url('jobs?type='.$fType->name) }}">@lang('home.'.ucfirst($fType->name))<!-- {!! $cat->name !!} --></option>
                    @endforeach
                </select>
            </div>

                <h5>
               <div style="width:100%;overflow: visible;background:#5a6d5b;border: 1px solid white; padding: 9px;">
                 <a style="color:white" href="{{ url('companies') }}">&nbsp;@lang('home.Companiesad')&nbsp;&nbsp;</a>
               </div>
           </h5>

        </div>

        <div class="col-md-2">
            <!-- <h5><span class="footer-title-box" style="background-color: #b0a48a">@lang('home.jobin') {{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }}</span></h5> -->
            <h5>&nbsp;</h5>
            <div style="width:100%;overflow: visible;background:#b0a48a;margin-bottom: 30px;">
                <select class="form-control select3" name="career" onchange="location.href=this.value" style="width:200px;overflow: auto;">
                    <option value="">@lang('home.jobin'){{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }}</option>
                    @foreach(JobCallMe::getJobStates(JobCallMe::getHomeCountry()) as $loca2)
                    <option value="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca2->id )}}">@lang('home.'.$loca2->name)<!--  @lang('home.jobsin') --></option>
                    @endforeach
                    <option value="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca2->id )}}">@lang('home.globalOverseas')<!--  @lang('home.jobsin') --></option>
                </select>
            </div>

            <h5>
               <div style="width:100%;overflow: visible;background:#f0ad4e;border: 1px solid white; padding: 9px;">
            <a style="color:white" target="_blank" href="https://www.outsourcingok.com/">www.outsourcingok.com</a>
                </div>
           </h5>
            
        </div>

        <div class="col-md-2" style="padding-top: 32px;">

            <!-- <h5><span class="footer-title-box" style="background-color: #717171">@lang('home.aboutus')</span></h5> -->
            <h5>&nbsp;</h5>
            <div style="width:100%;overflow: visible;background:#717171;">
                <select class="form-control select3" name="career" onchange="location.href=this.value" style="width:200px;overflow: auto;">

                    <option value="">@lang('home.aboutus')</option>
                    <option value="{{ url('about') }}">@lang('home.about')</option>
                    <option value="{{ url('contact') }}">@lang('home.contact')</option>
                    <option value="{{ url('privacy-policy') }}">@lang('home.Privacy Policy')</option>
                    <option value="{{ url('terms-conditions') }}">@lang('home.Terms & Conditions')</option>
					<option value="{{ url('picture-policy') }}">@lang('home.picture policy')</option>
					<option value="{{ url('review-write') }}">@lang('home.review write')</option>
					<option value="{{ url('video-chat-policy') }}">@lang('home.Video & Chat Policy')</option>
					<!-- <option value="{{ url('refund-policy') }}">@lang('home.Refund Policy')</option> -->
                    <option value="{{ url('account/register') }}">@lang('home.Login')</option>
                    <option value="{{ url('account/register') }}">@lang('home.Signup')</option>
                    <option value="{{ url('account/employer/job/new') }}">@lang('home.newpostedjobs')</option>


                </select>
            </div>
            <ul class="social-links" style="padding-top:15px">
                <li><a href="https://facebook.com"><i class="fa fa-facebook-square"></i> </a> </li>
                <li><a href="https://twitter.com"><i class="fa fa-twitter-square"></i> </a> </li>
                <li><a href="https://linkedin.com"><i class="fa fa-linkedin-square"></i> </a> </li>
            </ul>

        </div>
    
    </div>
    <div class="foot-links-hr hidden-xs"></div>
    <!-- <section class="main-slide-foot"> -->
    <div class="foot-links hidden-xs">             
        <ul>
            <li>@lang('home.CustomerService')</li>
            <li>@lang('home.companyaddr')</li>
            <li>@lang('home.ceo')</li> 
            <li>Copyrihgt &copy; 2017 Jobcallme Co.,Ltd.(RN 201-86-41011)</li>                
        </ul>				
    </div>

	<div class="foot-links-m hidden-sm hidden-md hidden-lg">             
        <ul>
            <li><a id="footinfobutton" onclick="myfootinfo()" style="color:#fff;font-size:15px;"> @lang('home.jcm-foot1')</a><a id="footinfobutton2" style="color:#fff;font-size:11px;"> @lang('home.jcm-foot1-1')</a></li>			       
        </ul>				
    </div>
	
<div id="footinfodiv" style="display:none">
	<div class="foot-links-m hidden-sm hidden-md hidden-lg">             
        <ul>
            <li>@lang('home.CustomerService1')</li>
			<li>@lang('home.CustomerService2')</li>
            <!-- <li>@lang('home.companyaddr1')</li>
			<li>@lang('home.companyaddr2')</li> -->
            <li>@lang('home.ceo1')</li> 
			<li>@lang('home.ceo2')</li>
            <li>Copyrihgt &copy; 2017 Jobcallme Co.,Ltd.(RN 201-86-41011)</li>                
        </ul>				
    </div>
</div>
    <!-- @if(Session::has('jcmUser'))
    <script type="text/javascript" charset="utf-8" src="{{asset('cometchat/js.php')}}"></script>
    <link type="text/css" rel="stylesheet" media="all" href="{{asset('cometchat/css.php')}}" /> 
    @endif -->
</footer>

<style type="text/css">
.select3-container--default .select3-selection--single{
    border: 1px solid #ccc !important;
    background: transparent !important;
    border-radius:0 !important;
    height: 33px !important;
    /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
}
.select3-container--default .select3-selection--single .select3-selection__rendered{
    color: #fff !important;
}
.select3-container--default .select3-selection--single .select3-selection__arrow b {
  border-color: #fff transparent transparent transparent;
  border-style: solid;
  border-width: 5px 4px 0 4px;
  height: 0;
  left: 50%;
  margin-left: -4px;
  margin-top: -2px;
  position: absolute;
  top: 50%;
  width: 0; }
</style>
<script type="text/javascript">
   function jsUrl(){
    return "{{ url('') }}";
}
function jsCsrfToken(){
    return "{{ csrf_token() }}";
}

setTimeout(function(){ 
    var header = $('#feed-header').html();
    var feedback = $('#feedback-main').html();
    var email = $('#feedback-email').html();
    var drop = $('#feedback-drop').html();
    var message = $('#feedback-message').html();
    var submit = $('#feedback-submit').html();
    $('#fpi_header_message').html(header); 
    $('#fpi_title h2').html(feedback); 
    $('input[type="email"]').attr('placeholder',email); 
    $('#feedback-Form select[name="type"]').html(drop); 
    $('#feedback-Form textarea[name="message"]').html(message); 
    $('#fpi_submit_submit button[type="submit"]').html(submit); 
}, 3000);      






</script>