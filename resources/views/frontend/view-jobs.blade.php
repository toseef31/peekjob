@extends('frontend.layouts.app')

@section('title', 'Find Job')

@section('content')
<section id="jobs" class="job-search-section" style="margin-bottom:50px">
    <div class="container">


        <div class="col-md-12">
            <div class="col-md-12 job-search-box">
                <form action="" method="post" class="search-job" style="padding-top:13px">
                	<input type="hidden" name="_token" class="token">
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="keyword" value="{{ Request::input('keyword') }}" placeholder="Search a Job">
                    </div>
                    <!-- <div class="form-group hidden-xs">
                       <select class="form-control job-category" name="categoryId" onchange="getSubCategories(this.value)">
                       		<option value="">@lang('home.s_category')</option>
                       		@foreach(JobCallMe::getCategories() as $cat)
                                <option value="{!! $cat->categoryId !!}" {{ $cat->categoryId == Request::input('category') ? 'selected="selected"' : '' }}>@lang('home.'.$cat->name)</option>
                            @endforeach
                       </select>
                    </div>
					<div class="form-group hidden-xs">
                       <select class="form-control job-sub-category" name="subCategory" onchange="getSubCategories2(this.value)">
									<option value="">@lang('home.Subcategory')</option>
									</select>
                    </div>
					<div class="form-group hidden-xs">
                       <select class="form-control job-sub-category2" name="subCategory2">
								<option value="">@lang('home.Subcategory2')</option>
									</select>
                    </div>
                    <div class="form-group hidden-xs">
                        <select class="form-control" name="jobType">
                            <option value="">@lang('home.jobinformationtype')</option>
                            @foreach(JobCallMe::getJobType() as $jtype)
                                <option value="{!! $jtype->name !!}" {{ $jtype->name == Request::input('type') ? 'selected="selected"' : '' }}>@lang('home.'.$jtype->name)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group hidden-xs">
                        <select class="form-control" name="jobShift">
                            <option value="">@lang('home.s_shift')</option>
                            @foreach(JobCallMe::getJobShifts() as $jshift)
                                <option value="{!! $jshift->name !!}" {{ $jshift->name == Request::input('shift') ? 'selected="selected"' : '' }}>@lang('home.'.$jshift->name)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group hidden-xs">
                        <select class="form-control" name="careerLevel">
                            <option value="">@lang('home.s_career')</option>
                            @foreach(JobCallMe::getCareerLevel() as $career)
                                <option value="{!! $career !!}" {{ $career == Request::input('career') ? 'selected="selected"' : '' }}>@lang('home.'.$career)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group hidden-xs">
                        <select class="form-control" name="experience">
                            <option value="">@lang('home.s_experience')</option>
                            @foreach(JobCallMe::getExperienceLevel() as $experience)
                                <option value="{!! $experience !!}" {{ $experience == Request::input('experience') ? 'selected="selected"' : '' }}>@lang('home.'.$experience)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group hidden-xs">
                    <input type="hidden" class="form-control" name="dispatch" value="{{ Request::input('dispatch') }}">
                            <input type="hidden" class="form-control" name="head" value="{{ Request::input('head') }}">
                            <input type="hidden" class="form-control" name="degree" value="{{ Request::input('degree') }}">
                            <input type="hidden" class="form-control" name="countrys" value="{{ Request::input('countrys') }}">
                             <input type="hidden" class="form-control" name="cityss" value="{{ Request::input('cityss') }}">
                              <input type="hidden" class="form-control" name="states" value="{{ Request::input('states') }}">
                        <input type="text" class="form-control" name="minSalary" value="" placeholder="@lang('home.minsalary') ">
                    </div>
                    <div class="form-group hidden-xs">
                        <input type="text" class="form-control" name="maxSalary" value="" placeholder="@lang('home.Maxsalary')">
                    </div>
                    <div class="form-group hidden-xs">
                        <select class="form-control" name="currency">
                            <option value="">@lang('home.s_currency')</option>
                            @foreach(JobCallMe::siteCurrency() as $currency)
                                <option value="{{ $currency }}">{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="form-group col-md-5">
                        <select class="form-control job-country" name="country">
                            <option value="0">Country</option>
                            @foreach(JobCallMe::getJobCountries() as $country)
                                <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <select class="form-control job-state" name="state" data-state="{{ Request::input('state') }}">
                            <option value="0">@lang('home.state')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control job-city" name="city" data-city="{{ Request::input('city') }}">
                            <option value="0">@lang('home.city')</option>
                        </select>
                    </div> -->
                    <div class="form-group col-md-2">
                        <button class="btn btn-primary btn-block" type="submit" name="save">@lang('home.search')</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <!-- Post Job -->
                <div class="col-md-12 post-job">
                    <div class="post-jobs-bar">
                        <div class="col-md-2 col-xs-4">
                            <?php $totalSaved = count($savedJobs);?>
                            <span><a href="{{url('account/jobseeker?saveJob')}}"><b>{{ $totalSaved }}</b> Saved Jobs</a></span>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <?php $applied = count($appl);?>
                            <span><a href="{{url('account/jobseeker?savedJobs')}}"><b>{{ $applied }}</b> Applied Jobs</a></span>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <span><a href="{{ url('account/jobseeker/resume') }}"><i class="fa fa-pencil"></i>Career interests</a></span>
                        </div>
                        <div class="col-md-offset-4 col-md-2 text-right">
                            <button class="btn btn-primary btn-block"><a href="{{ url('account/employer/job/new') }}"><i class="fa fa-edit"></i>Post a Job</a></button>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="col-md-12 show-jobs">
                    
                    <p style="text-align:center;">Loading ....</p>
    				
                </div>
            </div>    
        </div>
     </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.jobs-suggestions:hover {background-color: #f9f9f9;}
.jobs-suggestions img {
    position: absolute;
    right: 24px;
    top: 64%;
    vertical-align: top;
	width:11%;
        height: 57px;

}
</style>
<script type="text/javascript">
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

        var page = $(this).attr('href').split('page=')[1];  
       //alert(page);
       getArticles(page)
    });
     function getArticles(page) {
         location.hash=page;
        $.ajax({
            url : '/ajex/products?page='+page 
        }).done(function (data) {
            $('.show-jobs').html(data); 
            
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
var isFirst = 0;
var token = "{{ csrf_token() }}";
$(document).ready(function(){
    var getcountry = "<?php echo $_GET['country'];?>";
    var getsate = "<?php echo $_GET['state'];?>";
    var getkeyword = "<?php echo $_GET['keyword'];?>";
    var getcity = "<?php echo $_GET['city'];?>";
    console.log(getkeyword);
    console.log(getcity);
    if(getcountry != '' || getsate != ''){
        $.ajax({
               type: 'post',
               data: {country:getcountry,state:getsate,_token:"{{ csrf_token() }}"},
               url: "{{ url('jobs/search') }}?_find="+isFirst,
               success: function(response){
                   console.log(response);
                   $('.show-jobs').html(response);
                   $('.search-job button[name="save"]').prop('disabled',false);

                   $('.jobs-suggestions').hover(function () {
                       $(this).children(".js-action").fadeIn('slow');

                   });
                   $('.jobs-suggestions').mouseleave(function () {
                       $(this).children(".js-action").fadeOut('fast');
                   });

                   $('.search-job select option[value=""]').prop('selected',true);
                   $('.search-job input').val('');
                   $('.search-job .job-city').html('<option value="">@lang("home.s_city")</option>');
               }
           })
    }else if(getkeyword != '' || getcity != ''){
       $.ajax({
        type: 'post',
        data: {keyword:getkeyword,city:getcity,_token:"{{ csrf_token() }}"},
        url: "{{ url('jobs/search') }}?_find="+isFirst,
        success: function(response){
            $('.show-jobs').html(response);
            $('.search-job button[name="save"]').prop('disabled',false);

            $('.jobs-suggestions').hover(function () {
                $(this).children(".js-action").fadeIn('slow');

            });
            $('.jobs-suggestions').mouseleave(function () {
                $(this).children(".js-action").fadeOut('fast');
            });

            $('.search-job select option[value=""]').prop('selected',true);
            $('.search-job input').val('');
            $('.search-job .job-city').html('<option value="">@lang("home.s_city")</option>');
        }
    })
    }else if(getkeyword == '' && getcity == '' || getcountry == '' && getsate == ''){
        $('.search-job').submit();
    }
	
    getStates($('.job-country option:selected:selected').val());
})
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            var obj = $.parseJSON(response);
            $(".job-state").html('');
            var newOption = new Option('Select State', '0', true, false);
            $(".job-state").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(firstCapital(k.name), k.id, true, vOption);
                $(".job-state").append(newOption);
            })
            $(".job-state").trigger('change');
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId)
})
function getCities(stateId){
    if(stateId == '0'){
        $(".job-city").html('').trigger('change');
        var newOption = new Option('Select City', '0', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '0', true, false);
            $(".job-city").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })
        }
    })
}
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
$('form.search-job').submit(function(e){
	//$('.search-job button[name="save"]').prop('disabled',true);
    $('.search-job .token').val(token);
	$.ajax({
		type: 'post',
		data: $('.search-job').serialize(),
		url: "{{ url('jobs/search') }}?_find="+isFirst,
		success: function(response){
			$('.show-jobs').html(response);
			$('.search-job button[name="save"]').prop('disabled',false);

			$('.jobs-suggestions').hover(function () {
		        $(this).children(".js-action").fadeIn('slow');

		    });
		    $('.jobs-suggestions').mouseleave(function () {
		        $(this).children(".js-action").fadeOut('fast');
		    });

            $('.search-job select option[value=""]').prop('selected',true);
            $('.search-job input').val('');
            $('.search-job .job-city').html('<option value="">@lang("home.s_city")</option>');
		}
	})
	isFirst = 1;
	e.preventDefault();
})
function saveJob(jobId,obj){
    if($(obj).hasClass('btn-default')){
        var type = 'save';
    }else{
        var type = 'remove';
    }
    $.ajax({
        url: "{{ url('account/jobseeker/job/action') }}?jobId="+jobId+"&type="+type,
        success: function(response){
            if($.trim(response) == 'redirect'){
                window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
                if($(obj).hasClass('btn-default')){
                    $(obj).removeClass('btn-default');
                    $(obj).addClass('btn-success');
                    $(obj).text('Saved');
                }else{
                    $(obj).removeClass('btn-success');
                    $(obj).addClass('btn-default');
                    $(obj).text('Save');
                }
            }
        }
    })
}



 getSubCategories($('.job-category option:selected:selected').val());

 getSubCategories2($('.job-category option:selected:selected').val());


function getSubCategories(categoryId){
    $.ajax({
        url: "{{ url('account/get-subCategory') }}/"+categoryId,
        success: function(response){
            console.log(response);
            /*var obj = $.parseJSON(response);*/
            $(".job-sub-category").html('').trigger('change');
            $(".job-sub-category").append(response).trigger('change');
            /*$.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId, true, vOption);
                $(".job-sub-category").append(newOption).trigger('change');
            })*/
        }
    })
}

function getSubCategories2(categoryId2){

    $.ajax({
        url: "{{ url('account/get-subCategory2') }}/"+categoryId2,
        success: function(response){

            /*var obj = $.parseJSON(response);*/
            $(".job-sub-category2").html('').trigger('change');
            $(".job-sub-category2").html(response).trigger('change');
            /*$.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId2, true, vOption);
                $(".job-sub-category2").append(newOption).trigger('change');
            })*/
        }
    })
}



</script>
@endsection