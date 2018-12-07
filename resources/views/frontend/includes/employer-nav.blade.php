<section id="jobseeker-box">
    <div class="container">
        <h2>@lang('home.welcome') {{ Session::get('jcmUser')->firstName.' '.Session::get('jcmUser')->lastName }} @lang('home.welcomeend')</h2>
        <div class="col-md-12 user-dashboard-panel">
            <ul class="udp-items">
                <li>
                    <a href="{{ url('account/employer/job/new') }}">
                        <img src="../frontend-assets/images/employer_icon2.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.postjob')</div>
                    </a>
                </li>

                <li>
                    <a href="{{ url('account/employer/application') }}">
                        <img src="../frontend-assets/images/employer_icon3.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.empAPPLICATION')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('account/employer/application?show=interview') }}" id="jaTab-3">
                        <img src="../frontend-assets/images/employer_icon4.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.INTERVIEW')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('account/employer/questionnaires') }}" id="jaTab-3">
                        <img src="../frontend-assets/images/test.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.TEST')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('messages') }}">
                        <img src="../frontend-assets/images/employer_icon5.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.MESSAGE')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('account/people') }}">
                        <img src="../frontend-assets/images/employer_icon6.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.Find Peoples')</div>
                     </a>
                </li>
                <li>
                    <a href="{{ url('learn') }}">
                        <img src="../frontend-assets/images/employer_icon7.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.LEARN')</div>
                    </a>
                </li>
				 <li>
                    <a href="{{ url('account/employer/download') }}">
                        <img src="../frontend-assets/images/employer_icon8.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.DOWNLOAD')</div>
                    </a>
                </li>
				 <li>
                    <a href="{{ url('career-tab') }}">
                        <img src="../frontend-assets/images/employer_icon9.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.CAREER TAB')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('read') }}">
                        <img src="../frontend-assets/images/employer_icon10.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.READ')</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('account/manage?noti')}}">
                        <img src="../frontend-assets/images/employer_icon11.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.NOTIFICATION')</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>