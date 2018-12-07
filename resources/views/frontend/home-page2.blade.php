@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<?php
$lToken = csrf_token();
?>
<section class="main-slide">
    <div class="container">
        <div class="col-md-12 job-search">
            <h1>Your Future Starts Here Now</h1>
            <!-- <h3>Finding your next job or career more 1000+ availabilities</h3> -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#search_tab_1" data-toggle="tab">Jobs </a>
                                </li>
                                <li>
                                    <a href="#search_tab_2" data-toggle="tab">Companies </a>
                                </li>
                                <li>
                                    <a href="#search_tab_3" data-toggle="tab">People </a>
                                </li>
                                <li>
                                    <a href="#search_tab_4" data-toggle="tab">Read </a>
                                </li>
                                <li>
                                    <a href="#search_tab_5" data-toggle="tab">Learn </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="search_tab_1">
                                    <form role="form" action="{{ url('jobs') }}">
                                        <div class="input-fields">
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="Looking for job..." name="keyword">
                                            </div>
                                            <div class="search-field-box search-location">
                                                <select class="location" name="country">
                                                    <option value="">All Location</option>
                                                    @foreach(JobCallMe::getJobCountries() as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="search-btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="search_tab_2">
                                    <form role="form" action="{{ url('companies') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ $lToken }}">
                                        <div class="input-fields">
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="Looking for company..." name="keyword">
                                            </div>
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="City" name="city">
                                            </div>
                                            <button type="submit" class="search-btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="search_tab_3">
                                    <form role="form" action="{{ url('people') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ $lToken }}">
                                        <div class="input-fields">
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="Looking for People..." name="keyword">
                                            </div>
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="City" name="city">
                                            </div>
                                            <button type="submit" class="search-btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="search_tab_4">
                                    <form role="form" action="{{ url('read') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ $lToken }}">
                                        <div class="input-fields">
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="keyword" name="keyword">
                                            </div>
                                            <div class="search-field-box search-location">
                                                <select class="location" name="category">
                                                    <option value="">Select Category</option>
                                                    @foreach(JobCallMe::getCategories() as $cat)
                                                        <option value="{{ $cat->categoryId }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="search-btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="search_tab_5">
                                    <form role="form" action="{{ url('learn/search') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ $lToken }}">
                                        <div class="input-fields">
                                            <div class="search-field-box search-item">
                                                <input type="search" placeholder="keyword" name="keyword">
                                            </div>
                                            <div class="search-field-box search-item">
                                                <input type="city" name="city" placeholder="city">
                                            </div>
                                            <button type="submit" class="search-btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-6 login-type ">
                <a href="{{ url('account/jobseeker') }}">
                    <i class="fa fa-user"></i>
                    <p>I AM A JOBSEEKER</p>
                    <span>POST RESUME AND APPLY FOR JOB</span>
                </a>
            </div>
            <div class="col-md-6 login-type ">
                <a href="{{ url('account/employer') }}">
                    <i class="fa fa-building"></i>
                    <p>I AM AN EMPLOYEER</p>
                    <span>POST JOBS AND START HIRING</span>
                </a>
            </div>
        </div>
        <?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="job-locations-box">
                    @foreach(JobCallMe::getHomeCities() as $loca)
                        <a href="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca->state_id.'&city='.$loca->id )}}" style="background-color: {{ $colorArr[array_rand($colorArr)] }}">Jobs in {{ $loca->name }}</a>
                    @endforeach
                </div>
                <div class="job-schedule-box">
                    @foreach($jobShifts as $shift)
                        <a href="{{ url('jobs?shift='.$shift->name) }}">{{ $shift->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--Slider Section End-->
<div class="container" style="display: none;">
    <div class="ticker-container">
        <!--<div class="ticker-caption">
            <p>Breaking News</p>
        </div>-->
        <ul>
            <div><li><span>Web Developer Required &ndash; <a href="#">Latest Job</a></span></li></div>
            <div><li><span>CSR urgent required, Satellite Town  &ndash; <a href="#">Latest Job</a></span></li></div>
            <div><li><span>Experience Software Engineer Required, Islamabad  &ndash; <a href="#">Latest Job</a></span></li></div>
            <div><li><span>Office Boy Required  &ndash; <a href="#">Latest Job</a></span></li></div>
        </ul>
    </div>

</div>

<!--Top Companies Section Start-->
<section class="feature-companies">
    <div class="container">
        <h2 class="text-center">Top Companies</h2>
        <!--<p class="text-center" id="feature-companies-caption">Sigh ever way now many. Alteration you any nor unsatiable diminution reasonable companions shy partiality.</p>-->
        <div class="row">
            <!--Single Company Brand 1-->
            @foreach($companies as $comp)
                <div class="col-md-2">
                    <div class="single-brand">
                        <div class="brand-img">
                            <a href="{{ url('companies/company/'.$comp->companyId) }}">
                                <img src="{!! $comp->companyLogo != '' ? url('compnay-logo/'.$comp->companyLogo) : url('compnay-logo/default-logo.jpg') !!}" style="height: 100px;" class="img-responsive">
                            </a>
                        </div>
                        <p>{!! $comp->companyName !!}</p>
                        <a href="{{ url('companies/company/'.$comp->companyId) }}" class="brand-jobs-link">View {{ JobCallMe::countCompanyJobs($comp->companyId) }} jobs</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<hr>
<!--Top Companies Section End-->

<!--Premium Jobs Section Start-->
<section id="premium-jobs">
    <div class="container">
        <h3>Premium Jobs</h3>
        <div class="row">
            <!--PJ-Single item 1-->
            @foreach($jobs as $job)
                <div class="col-md-4">
                    <div class="pj-single">
                        <img src="{!! $job->companyLogo != '' ? url('compnay-logo/'.$job->companyLogo) : url('compnay-logo/default-logo.jpg') !!}">
                        <div class="pj-single-details">
                            <p class="pj-job-title"><a href="{{ url('jobs/'.$job->jobId) }}">{!! $job->title !!}</a> </p>
                            <div class="job-status eye-icon">
                                <i class="fa fa-eye"></i><br>
                            </div>
                            <p class="pj-job-company">{!! $job->companyName !!}</p>
                            <p class="pj-job-location">{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                        </div>
                        <div class="job-status days-left">
                            <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--Premium Jobs Section End-->

<!--Hot Jobs Section Start-->
<section id="hot-jobs">
    <div class="container">
        <h3>Hot Jobs</h3>
        <div class="row">
            <!--PJ-Single item 1-->
            @foreach($jobs as $job)
                <div class="col-md-4">
                    <div class="pj-single">
                        <img src="{!! $job->companyLogo != '' ? url('compnay-logo/'.$job->companyLogo) : url('compnay-logo/default-logo.jpg') !!}">
                        <div class="pj-single-details">
                            <p class="pj-job-title"><a href="{{ url('jobs/'.$job->jobId) }}">{!! $job->title !!}</a> </p>
                            <div class="job-status eye-icon">
                                <i class="fa fa-eye"></i><br>
                            </div>
                            <p class="pj-job-company">{!! $job->companyName !!}</p>
                            <p class="pj-job-location">{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                        </div>
                        <div class="job-status days-left">
                            <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--Hot Jobs Section End-->

<!--Latest Jobs Section Start-->
<section id="latest-jobs">
    <div class="container">
        <h3>Latest Jobs</h3>
        <div class="row">
            <!--LJ-Single item 1-->
            @foreach($jobs as $job)
                <div class="col-md-4">
                    <div class="pj-single">
                        <img src="{!! $job->companyLogo != '' ? url('compnay-logo/'.$job->companyLogo) : url('compnay-logo/default-logo.jpg') !!}">
                        <div class="pj-single-details">
                            <p class="pj-job-title"><a href="{{ url('jobs/'.$job->jobId) }}">{!! $job->title !!}</a> </p>
                            <div class="job-status eye-icon">
                                <i class="fa fa-eye"></i><br>
                            </div>
                            <p class="pj-job-company">{!! $job->companyName !!}</p>
                            <p class="pj-job-location">{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                        </div>
                        <div class="job-status days-left">
                            <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--Premium Jobs Section End-->
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection