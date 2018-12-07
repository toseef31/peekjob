<section id="jobseeker-box">
    <div class="container">
        <h2>@lang('home.welcome') {{ Session::get('jcmUser')->firstName.' '.Session::get('jcmUser')->lastName }} @lang('home.welcomeend')</h2>
        <div class="col-md-12 user-dashboard-panel">
            <ul class="udp-itemss">
                <li>
                    <a href="{{ url('account/jobseeker/resume') }}">
                        <img src="../frontend-assets/images/jobseek_icon2.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.RESUME')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('jobs') }}">
                        <img src="../frontend-assets/images/jobseek_icon3.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.JOBS')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('account/jobseeker/application') }}">
                        <img src="../frontend-assets/images/jobseek_icon4.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.APPLICATION_title')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('account/jobseeker/application?show=interview') }}">
                        <img src="../frontend-assets/images/jobseek_icon5.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.INTERVIEW')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('messages') }}">
                        <img src="../frontend-assets/images/jobseek_icon6.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.MESSAGE')</div>
                    </a>
                </li>
                <li>
                     <a href="{{ url('learn') }}">
                        <img src="../frontend-assets/images/jobseek_icon7.png" style="padding-top:0px">
                        <div class="udp-type">@lang('home.LEARN')</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('read') }}">
                        <img src="../frontend-assets/images/jobseek_icon8.png" style="padding-top:0px">
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