<?php 
$headerLogo = url('/profile-photos/profile-logo.jpg');
if(file_exists('profile-photos/'.Session()->get('jcmAdmin')->profilePhoto)){
    $headerLogo = url('/profile-photos/'.Session()->get('jcmAdmin')->profilePhoto);
}
$headerWeb = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$headerWebLogo = url('/website/logo.png');
if(file_exists('/website/'.$headerWeb['webLogo'])){
    $headerWebLogo = url('/website/'.$headerWeb['webLogo']);
}
?>
<div class="layout-header">
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="{{ url('admin/dashboard') }}">
            <img class="navbar-brand-logo" src="{{ $headerWebLogo }}" alt="{{ $headerWeb['webTitle'] }}">
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
            <span class="bar-line bar-line-1 out"></span>
            <span class="bar-line bar-line-2 out"></span>
            <span class="bar-line bar-line-3 out"></span>
            </span>
            <span class="bars bars-x">
            <span class="bar-line bar-line-4"></span>
            <span class="bar-line bar-line-5"></span>
            </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical">
            <img class="ellipsis-object" width="32" height="32" src="{{ $headerLogo }}" alt="">
            </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button" style="display: none;">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
                </span>
                </button>
                <ul class="nav navbar-nav navbar-right">
                    <li class="visible-xs-block">
                        <h4 class="navbar-text text-center">Hi, {{ session()->get('jcmAdmin')->firstName.' '.session()->get('jcmAdmin')->lastName }}</h4>
                    </li>
                    <li class="dropdown hidden-xs">
                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                        <img class="rounded" width="36" height="36" src="{{ $headerLogo }}" alt=""> {{ session()->get('jcmAdmin')->firstName.' '.session()->get('jcmAdmin')->lastName }}
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ url('admin/settings/profile') }}">Profile</a></li>
                            <li><a href="{{ url('admin/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                    <li class="visible-xs-block">
                        <a href="{{ url('admin/settings/profile') }}">
                            <span class="icon icon-user icon-lg icon-fw"></span>
                            Profile
                        </a>
                    </li>
                    <li class="visible-xs-block">
                        <a href="{{ url('admin/logout') }}">
                            <span class="icon icon-power-off icon-lg icon-fw"></span>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>