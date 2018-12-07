<?php 
$page = Request::segment(2);
$nav = Request::segment(3);
$$page = 'active open';
$$nav = 'active';
?>
<div class="layout-sidebar">
    <div class="layout-sidebar-backdrop"></div>
    <div class="layout-sidebar-body">
        <div class="custom-scrollbar">
            <nav id="sidenav" class="sidenav-collapse collapse">
                <ul class="sidenav">
                    <li class="sidenav-item {{ $dashboard }}">
                        <a href="{{ url ('admin/dashboard') }}">
                        <span class="sidenav-icon icon icon-home"></span>
                        <span class="sidenav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidenav-item has-subnav {{ $settings }}">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-gear"></span>
                            <span class="sidenav-label">Setting</span>
                        </a>
                        <ul class="sidenav-subnav">
                            <li class="sidenav-subheading">Settings</li>
                            <li class="{{ $profile }}">
                                <a href="{{ url('admin/settings/profile') }}">Profile</a>
                            </li>
                            <li class="{{ $website }}">
                                <a href="{{ url('admin/settings/website') }}">Website</a>
                            </li>
                            <li class="{{ $accounts }}">
                                <a href="{{ url('admin/settings/accounts') }}">Accounts</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidenav-item has-subnav {{ $users }}">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-users"></span>
                            <span class="sidenav-label">User Management</span>
                        </a>
                        <ul class="sidenav-subnav">
                            <li class="sidenav-subheading">User Management</li>
                            <li class="{{ $view }}">
                                <a href="{{ url('admin/users/view') }}">Users</a>
                            </li>
                            <li class="{{ $company }}">
                                <a href="{{ url('admin/users/company') }}">Companies</a>
                            </li>
							<li class="{{ $getfeedback }}">
                                <a href="{{ url('getfeedback') }}">Feedback</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidenav-item has-subnav {{ $cms }}">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-bolt"></span>
                            <span class="sidenav-label">CMS</span>
                        </a>
                        <ul class="sidenav-subnav">
                            <li class="sidenav-subheading">CMS</li>
                            <li class="{{ $alljobs }}">
                                <a href="{{ url('admin/cms/alljobs') }}">Jobs >></a>
                                 <ul class="sidenav-subnav">
                                 <li class="{{ $publishjobs }}">
                                <a href="{{ url('admin/cms/alljobs') }}">All Jobs</a>
                              </li>
                                 <li class="{{ $publishjobs }}">
                                <a href="{{ url('admin/cms/publishjobs') }}"> Publish Jobs</a>
                              </li>

                             <li class="{{ $draftjobs }}">
                                <a href="{{ url('admin/cms/draftjobs') }}">Draft Jobs</a>
                            </li>
                                 </ul>
                            </li>
                            <li class="{{ $category }}">
                                <a href="{{ url('admin/cms/category') }}">Job Category</a>
                            </li>
                             <li class="{{ $package_plan }}">
                                <a href="{{ url('admin/cms/plan') }}">Add Packages</a>
                            </li>
                             <li class="{{ $package }}">
                                <a href="{{ url('admin/cms/plan/get') }}">Packages Status >></a>
                                 <ul class="sidenav-subnav">
                                 <li class="{{ $package }}">
                                <a href="{{ url('admin/cms/plan/get') }}">All Packages</a>
                                </li>
                                 <li class="{{ $Packagesjobs }}">
                                <a href="{{ url('admin/cms/plan/jobpckg') }}">Jobs Packages</a>
                              </li>
                                 <li class="{{ $Resume}}">
                                <a href="{{ url('admin/cms/plan/resume') }}"> Resume Packages</a>
                              </li>
                              </ul>
                            </li>
                            <li class="{{ $shift }}">
                                <a href="{{ url('admin/cms/shift') }}">Job Shift</a>
                            </li>
							<li class="{{ $readCat }}">
                                <a href="{{ url('readCat') }}">Read Category</a>
                            </li>
                            <li class="{{ $jobtype }}">
                                <a href="{{ url('admin/cms/jobtype') }}">Job Type</a>
                            </li>
                            <li class="{{ $upskill }}">
                                <a href="{{ url('admin/cms/upskilltype') }}">Upskill Type</a>
                            </li>
							<li class="{{ $AproveWriting }}">
                                <a href="{{ url('admin/cms/aprovewriting') }}">Aprove Writing</a>
                            </li>
                            <li class="{{ $AproveWriting }}">
                                <a href="{{ url('admin/cms/aproveskills') }}">Aprove Upskills</a>
                            </li>
                            <li class="{{ $pages }}">
                                <a href="{{ url('admin/cms/pages') }}">Pages</a>
                            </li>
                        </ul>
                    </li>
					 <li class="sidenav-item">
                        <a href="{{ url ('admin/orders') }}">
                        <span class="sidenav-icon icon icon-briefcase"></span>
                        <span class="sidenav-label">Orders</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{ url ('admin/receivepayment') }}">
                        <span class="sidenav-icon icon icon-briefcase"></span>
                        <span class="sidenav-label">Receive Payment</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{ url ('admin/logout') }}">
                        <span class="sidenav-icon icon icon-sign-out"></span>
                        <span class="sidenav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>