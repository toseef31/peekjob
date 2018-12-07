@extends('frontend.layouts.app')
<section id="jobs">
    <div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="job-search-box">
                <h3 style="text-align:center">Advance Search</h3>
                <form action="" method="post" class="search-job" style="padding-top:13px">
                    <input type="hidden" name="_token" class="token">
                    <div class="form-group">
                        <input type="text" class="form-control" name="keyword" value="{{ Request::input('keyword') }}" placeholder="Keyword">
                    </div>
                    <div class="form-group">
                       <select class="form-control" name="categoryId">
                            <option value="">Select Category</option>
                            @foreach(JobCallMe::getCategories() as $cat)
                                <option value="{!! $cat->categoryId !!}" {{ $cat->categoryId == Request::input('category') ? 'selected="selected"' : '' }}>{!! $cat->name !!}</option>
                            @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="jobType">
                            <option value="">Select Type</option>
                            @foreach(JobCallMe::getJobType() as $jtype)
                                <option value="{!! $jtype->name !!}" {{ $jtype->name == Request::input('type') ? 'selected="selected"' : '' }}>{!! $jtype->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="jobShift">
                            <option value="">Select Shift</option>
                            @foreach(JobCallMe::getJobShifts() as $jshift)
                                <option value="{!! $jshift->name !!}" {{ $jshift->name == Request::input('shift') ? 'selected="selected"' : '' }}>{!! $jshift->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="careerLevel">
                            <option value="">Select Career level</option>
                            @foreach(JobCallMe::getCareerLevel() as $career)
                                <option value="{!! $career !!}" {{ $career == Request::input('career') ? 'selected="selected"' : '' }}>{!! $career !!}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control" name="experience">
                            <option value="">Select Experience</option>
                            @foreach(JobCallMe::getExperienceLevel() as $experience)
                                <option value="{!! $experience !!}" {{ $experience == Request::input('experience') ? 'selected="selected"' : '' }}>{!! $experience !!}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <div class="form-group">
                        <input type="text" class="form-control" name="minSalary" value="" placeholder="Minimum Salary ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="maxSalary" value="" placeholder="Maximum Salary">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="currency">
                            <option value="">Select Currency</option>
                            @foreach(JobCallMe::siteCurrency() as $currency)
                                <option value="{{ $currency }}">{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control job-country" name="country">
                            <option value="0">Select Country</option>
                            @foreach(JobCallMe::getJobCountries() as $country)
                                <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control job-state" name="state" data-state="{{ Request::input('state') }}">
                            <option value="0">Select City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control job-city" name="city" data-city="{{ Request::input('city') }}">
                            <option value="0">Select City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="save">SEARCH</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9 show-jobs">
            <?php echo preg_replace("/<!--.*?-->/", "", $vhtml);?>
			<?php echo $result->render(); ?>
        </div>
     </div>
     </div>
</section>

<style type="text/css">
.jobs-suggestions:hover {background-color: #f9f9f9;}
.jobs-suggestions img {
    position: absolute;
    right: 24px;
    top: 60%;
    vertical-align: top;
    width:11%;
	height:57px;
   
}
</style>
<script type="text/javascript">

</script>