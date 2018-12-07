		@extends('frontend.layouts.app')

		@section('title', 'Download')

		@section('content')
		<section id="company-box">
			<div class="container">

			


			<div class="row">

			<div class="follow-companies5" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px">@lang('home.DOWNLOAD')</h3>
				</div>
			
			<div class="col-md-3 ">
			<div style="background-color: white;padding: 6px;" >
			 <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.key')">
				 </div>
				  </div> 
		<div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.lname')">
				 </div>
				  </div>   
				  <div class=" pnj-form-field">
					<select class="form-control job-category" name="categoryId" onchange="getSubCategories(this.value)">
                       		<option value="">@lang('home.s_category')</option>
                       		@foreach(JobCallMe::getCategories() as $cat)
                                <option value="{!! $cat->categoryId !!}" {{ $cat->categoryId == Request::input('category') ? 'selected="selected"' : '' }}>@lang('home.'.$cat->name)</option>
                            @endforeach
                       </select>
					 </div>  
					 <div class=" pnj-form-field">
					 <select class="form-control job-sub-category" name="subCategory" onchange="getSubCategories2(this.value)">
							<option value="">@lang('home.Subcategory')</option>
									</select>
					 </div>  
					 <div class=" pnj-form-field">
					<select class="form-control job-sub-category2" name="subCategory2">
							<option value="">@lang('home.Subcategory2')</option>
									</select>
					 </div>  

					 <div class=" pnj-form-field">
			  <select class="form-control input-sm" name="degreelevel">
										<option value="">@lang('home.Degreelevel')</option>
                                        <option value="highschool">@lang('home.highschool')</option>
                                        <option value="college">@lang('home.college')</option>
                                        <option value="university">@lang('home.university')</option>
                                        <option value="graduateschool">@lang('home.graduateschool')</option>
                                        <option value="phd">@lang('home.Doctorate(phd)')</option>
										<option value="phd">@lang('home.Vocational')</option>
										<option value="phd">@lang('home.Associate Degree')</option>
										<option value="phd">@lang('home.Certification')</option>
                                    </select>
					 </div>  
		<div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.Degree')">
				 </div>
				  </div>   
		<div class="form-group">
			   <div class="pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.Institute')">
				 </div>
				  </div>   
		<div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.jobtitle')">
				 </div>
				  </div>   
		<div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.departments')">
				 </div>
				  </div> 
			  <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.minsalary')">
				 </div>
				  </div> 
			   <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.Maxsalary')">
				 </div>
				  </div> 
				<div class=" pnj-form-field">
				<select class="form-control select2" name="shift">
		   
				  <option value="Industry ">@lang('home.currency') </option>
				  @foreach(JobCallMe::siteCurrency() as $currency)
                                                <option value="{!! $currency !!}">{!! $currency !!}</option>
                                            @endforeach
					
					 </select>
					 </div>  		  
				 <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="number" class="form-control" name="vacancy" placeholder="@lang('home.Minimum Experience')">
				 </div>
				  </div> 
		<div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="number" class="form-control" name="vacancy" placeholder="@lang('home.Maximum Experience')">
				 </div>
				  </div> 
		  <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.skill')">
				 </div>
				  </div> 	
		  <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="number" class="form-control" name="vacancy" placeholder="@lang('home.Minimum Age')">
				 </div>
				  </div> 	
		  <div class="form-group">
			   <div class=" pnj-form-field">
				 <input type="number" class="form-control" name="vacancy" placeholder="@lang('home.Maximum Age')">
				 </div>
				  </div>
			 
			<div class=" pnj-form-field">
			  <select class="form-control input-sm select2" name="gender">
										<option value="">@lang('home.selectgender') </option>
                                        <option value="Male" {{ $meta->gender == 'Male' ? 'selected="selected"' : '' }}>@lang('home.male')</option>
                                        <option value="Female" {{ $meta->gender == 'Female' ? 'selected="selected"' : '' }}>@lang('home.female')</option>
                                    </select>

			 
					 </div>  
			 <div class=" pnj-form-field">
			 <select class="form-control input-sm select2" name="maritalStatus">
										<option value="">@lang('home.selectmarital')</option>
                                        @if(app()->getLocale() == "kr")
						    <option value="Single" {{ $meta->maritalStatus == 'Single' ? 'selected="selected"' : '' }}>@lang('home.single')</option>
                                        
                                        <option value="Married" {{ $meta->maritalStatus == 'Married' ? 'selected="selected"' : '' }}>@lang('home.married')</option>
                                        
						@else
						    <option value="Single" {{ $meta->maritalStatus == 'Single' ? 'selected="selected"' : '' }}>@lang('home.single')</option>
                                        <option value="Engaged" {{ $meta->maritalStatus == 'Engaged' ? 'selected="selected"' : '' }}>@lang('home.engaged')</option>
                                        <option value="Married" {{ $meta->maritalStatus == 'Married' ? 'selected="selected"' : '' }}>@lang('home.married')</option>
                                        <option value="Widowed" {{ $meta->maritalStatus == 'Widowed' ? 'selected="selected"' : '' }}>@lang('home.widowed')</option>
                                        <option value="Divorced" {{ $meta->maritalStatus == 'Divorced' ? 'selected="selected"' : '' }}>@lang('home.divorced')</option>
						@endif

										
                                    </select>
			  
					 </div>   <div class=" pnj-form-field">
			   <select class="form-control select2 job-country" name="country">
		   
				  <option value="Industry ">@lang('home.country') </option>
				  @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                    @endforeach
					
					 </select>
					 </div>  
			 <div class=" pnj-form-field">
			  <select class="form-control select2 job-state" name="state">
                                </select>
					 </div>  
			  <div class=" pnj-form-field">
			  <select class="form-control select2 job-city" name="city">
                                </select>
					 </div>  	
			 <center><button type="submit" class="btn btn-primary" style="width:70%;margin-bottom:30px;">@lang("home.search")</button></center>			 
										  
			</div>
		  </div>
				<div class="col-md-9">
				
				  
              @foreach($download as $people)
			  <div class="row  company-box-left" style="height: 130px;margin-bottom: 12px;">
              <?php
              $pImage = url('profile-photos/profile-logo.jpg');
              if($people->profilePhoto != '' && $people->profilePhoto != NULL){
                $pos = strpos($people->profilePhoto,"ttp");
                if($pos == 1)
                {
                  $pImage = url($people->profilePhoto);
                } 
                else{
                  $pImage = url('profile-photos/'.$people->profilePhoto);
                }

              }
              ?>
            <a href="{{ url('account/employer/application/applicant/'.$people->userId) }}">
              <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="fp-img" style="height:96px;width: 85%;">
                      <img src="@if($people->pImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg ')}} @endif" style="width: 100%;">

                    </div>
					</div>
					<div class="col-md-10 col-sm-4 col-xs-6">
                    <div class="fp-item-details" style="padding:19px;background-color: #5c554b;">
                      <p>{!! $people->firstName.' '.$people->lastName !!}</p>
                      <p>@lang('home.'.JobCallMe::categoryTitle($people->industry))</p>
                      <p>@lang('home.'.JobCallMe::cityName($people->city)), @lang('home.'.JobCallMe::countryName($people->country))</p>
                    </div>
                 
                </div>
              
			   </a>
			   </div>
              @endforeach

            
            <div style="text-align:center"><?php	echo $download->render(); ?></div>
				   
				</div>
			   
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">


		 getSubCategories($('.job-category option:selected:selected').val());

 getSubCategories2($('.job-category option:selected:selected').val());


function getSubCategories(categoryId){
    $.ajax({
        url: "{{ url('account/get-subCategory') }}/"+categoryId,
        success: function(response){
            var obj = $.parseJSON(response);
            $(".job-sub-category").html('').trigger('change');
            $.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId, true, vOption);
                $(".job-sub-category").append(newOption).trigger('change');
            })
        }
    })
}

function getSubCategories2(categoryId2){
    $.ajax({
        url: "{{ url('account/get-subCategory2') }}/"+categoryId2,
        success: function(response){
            var obj = $.parseJSON(response);
            $(".job-sub-category2").html('').trigger('change');
            $.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId, true, vOption);
                $(".job-sub-category2").append(newOption).trigger('change');
            })
        }
    })
}


getStates($('.job-country option:selected:selected').val());

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
            var newOption = new Option('@lang("home.s_state")', '0', true, false);
            $(".job-state").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
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

		</script>
		@endsection