@extends('frontend.layouts.app')

@section('title', 'People')

@section('content')
<section id="learn-section">
  <div class="container">
    <div class="col-md-12 learn-search-box">
      <h2 class="text-center"><!-- @lang('home.searchpeople') --> <!--  {{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }} --></h2>
      <div class="row">
        <div class="col-md-offset-2 col-md-8" style="padding-top:20px">
          <div class="ls-box hidden-xs">
            <form role="form" action="{{ url('account/people') }}" method="post">
              {{ csrf_field() }}
              <div class="input-fields">
                <div class="search-field-box search-item">
                  <input type="search" placeholder="@lang('home.lookingpeople')" name="keyword">
                </div>
                <div class="search-field-box search-item" id="p_city">
                  <input type="search" placeholder="@lang('home.Cities')" name="city">
                  <button type="submit" class="search-btn" style="width:10% !important">
                    <i class="fa fa-search"></i>
                  </button>
                  <button  type="button" data-toggle="modal" data-target="#myModal" class="hidden-sm hidden-md hidden-lg" style="margin-left: 9px;width: 4%;height: 33px;background: transparent; border: 2px solid white;">
                    <span class="caret" style="color:white"></span></button>
                  </div>

                  <button  type="button" data-toggle="modal" data-target="#myModal" class="hidden-xs" style="margin-left: 9px;width: 4%;height: 33px;background: transparent; border: 2px solid #cecdcd;">
                    <span class="caret" style="color:white"></span></button>
                  </div>
                </form>
              </div>

			  <div class="ls-box hidden-sm hidden-md hidden-lg">
            <form role="form" action="{{ url('account/people') }}" method="post">
              {{ csrf_field() }}
              <div class="input-fields">
                <div class="search-field-box search-item">
                  <input type="search" placeholder="@lang('home.lookingpeople')" name="keyword">
                </div>
                <div class="search-field-box search-item" id="mod_city">
                  <input type="search" placeholder="@lang('home.Cities')" name="city" style="margin-bottom: 12px;">
				
                  <button type="submit" class="search-btn" style="width:50% !important">
                    <i class="fa fa-search"></i>
                  </button>
                  <button  type="button" data-toggle="modal" data-target="#myModal" class="hidden-sm hidden-md hidden-lg" style="margin-left: 9px;width: 45%;height: 33px;background: transparent; border: 2px solid white;"><span style="color:#fff">@lang('home.learn-search-text')</span>
                    <span class="caret" style="color:white"></span></button>
                 </div> 

                  
                  </div>
                </form>
              </div>


            </div>
          </div>

          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center">

                    @if(app()->getLocale() == "kr")
                    {{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }} @lang('home.Find Peoples')
                    @else
                    Search People in {{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }}
                    @endif
                  </h4>

                </div>
                <form role="form" action="{{ url('account/peoples') }}" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="modal-body">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="text" class="form-control" name="keyword" placeholder="@lang('home.key')">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="text" class="form-control" name="city" placeholder="@lang('home.Cities')">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="text" class="form-control" name="name" placeholder="@lang('home.name')">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">

                          <select class="form-control job-category" name="category" onchange="getSubCategories(this.value)">
                            <option value="">@lang('home.s_category')</option>
                            @foreach(JobCallMe::getCategories() as $cat)
                            <option value="{!! $cat->categoryId !!}">@lang('home.'.$cat->name)</option>
                            @endforeach
                          </select>

                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <select class="form-control job-sub-category" name="subCategory" onchange="getSubCategories2(this.value)">
                            <option value="">@lang('home.Subcategory')</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <select class="form-control job-sub-category2" name="subCategory2">
                              <option value="">@lang('home.Subcategory2')</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <select class="form-control" name="degreeLevel">
                            <option value="">@lang('home.degreeLevel-text')</option>
                                        <option value="highschool" {{ $meta->education == 'highschool' ? 'selected="selected"' : '' }}>@lang('home.highschool')</option>
                                        <option value="college" {{ $meta->education == 'college' ? 'selected="selected"' : '' }}>@lang('home.college')</option>
                                        <option value="university" {{ $meta->education == 'university' ? 'selected="selected"' : '' }}>@lang('home.university')</option>
                                        <option value="graduateschool" {{ $meta->education == 'graduateschool' ? 'selected="selected"' : '' }}>@lang('home.graduateschool')</option>
                                        <option value="Doctorate(phd)" {{ $meta->education == 'Doctorate(phd)' ? 'selected="selected"' : '' }}>@lang('home.Doctorate(phd)')</option>
										<option value="Vocational" {{ $meta->education == 'Vocational' ? 'selected="selected"' : '' }}>@lang('home.Vocational')</option>
										<option value="Associate Degree" {{ $meta->education == 'Associate Degree' ? 'selected="selected"' : '' }}>@lang('home.Associate Degree')</option>
										<option value="Certification" {{ $meta->education == 'Certification' ? 'selected="selected"' : '' }}>@lang('home.Certification')</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="text" class="form-control" name="degree" placeholder="@lang('home.degree')" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="number" class="form-control" name="minsalary" placeholder="@lang('home.minsalary')">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="number" class="form-control" name="maxsalary" placeholder="@lang('home.Maxsalary')">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="number" class="form-control" name="minexperience" placeholder="@lang('home.Minimum Experience')">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="number" class="form-control" name="maxexperience" placeholder="@lang('home.Maximum Experience')">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="number" class="form-control" name="minage" placeholder="@lang('home.Minimum Age')">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class=" pnj-form-field">
                            <input type="number" class="form-control" name="maxage" placeholder="@lang('home.Maximum Age')">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <select class="form-control" name="gender">
                            <option value="">@lang('home.selectgender')</option>
                            <option value="Male" >@lang('home.male')</option>
                            <option value="Female">@lang('home.female')</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <select class="form-control" name="maritalStatus">
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
                        </div>
                      </div>




                      <div class="col-md-6">
                        <div class="form-group">
                          <select class="form-control select2 job-country" name="country">
                            @foreach(JobCallMe::getJobCountries() as $cntry)
                            <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 pnj-form-field">
                        <div class="form-group">
                          <select class="form-control select2 job-state" name="state">
                          </select>


                             
                              </div>
						        </div>

								  <div class="col-md-6 pnj-form-field">
									<div class="form-group">
									  <select class="form-control select2 job-city" name="citys">
									  </select>
									</div>
								  </div>

								  <div class="col-md-6">
									<div class="form-group">
									  <div class=" pnj-form-field">
										<input type="text" class="form-control" name="skill" placeholder="@lang('home.skill')">
									  </div>
									</div>
								  </div>


								</div>
							  </div>
							  <div class="modal-footer">
								<button type="submit" style="float:left" class="btn btn-success" >@lang('home.search')</button>   <button type="button" style="float:left" class="btn btn-default" data-dismiss="modal">@lang('home.close')</button>
							  </div>
							</form>	
						  </div>
						</div>
					  </div>

          <div class="row">
            <div class="col-md-12">
			  <div class="col-smd-8 col-sm-offset-1">	
              <?php $colorArr = array('#57768a','#96aaa8','#a09d8e','#605e63','#9e947b','#8a9fa0','#695244','#5b5c5e','#7b767d','#a0b1b9','#6d846f','#a8b3b9','#9e947b','#5b5c5e','#7b767d','#a0b1b9','#6d846f'); $i=0; ?>
              <!-- <div class="job-locations-box"> -->
			  <div class="job-schedule-box">
                @foreach(JobCallMe::getCategories() as $cat)
@if($cat->name != "New and Career Recruitment")
                @if($cat->name == "outsourcingok")
                <a  href="https://www.outsourcingok.com" target="_blank" style="background-color: {{ $colorArr[$i++] }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                width: auto; 
                padding: 5px 5px;
                color: #ffffff;
                font-size: 12px;
                margin-bottom: 10px;
                /* display: block; */ 
                position: relative;
                /* float: left; */
                margin-right: 0.5%;
                overflow: hidden;
                text-decoration: none;">
                @else
                <a  href="{{ url('account/people?industry='.$cat->categoryId) }}" style="background-color: {{ $colorArr[$i++] }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                width: auto; 
                padding: 5px 5px;
                color: #ffffff;
                font-size: 12px;
                margin-bottom: 10px;
                /* display: block; */
                position: relative;
                /* float: left; */
                margin-right: 0.5%;
                overflow: hidden;
                text-decoration: none;">
                @endif


                <span class="text">@lang('home.'.$cat->name)</span></a>
@endif
                @endforeach
				</div>
              </div>
              <div class="clearfix"></div>
              <div class="job-schedule-box">
                <a href="{{ url('account/people?city='.$loca->id) }}">@lang('home.All')<!-- {{ $loca->name }} --></a>
                @foreach(JobCallMe::getHomeCities() as $loca)
                <a href="{{ url('account/people?city='.$loca->id) }}">@lang('home.'.$loca->name)<!-- {{ $loca->name }} --></a>
                @endforeach
				<a href="{{ url('account/people?city=000') }}">@lang('home.globalOverseas')<!-- {{ $loca->name }} --></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="fp-box">
          <div class="col-md-12">
            <!--FP item Row-->
            <div class="row">
              @foreach($peoples as $people)
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

              <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="fp-item" style="height: 256px;">
                  <a href="{{ url('account/employer/application/applicant/'.$people->userId) }}">
                    <div class="fp-img">
                   <img src="@if(Session::get('jcmUser')->userId == $people->emp_id) {{ $pImage }} @else @if($people->genderpeople == 'Male' or $people->genderpeople == 'Man') {{ url('profile-photos/profile-logo.jpg ')}} @else {{ url('profile-photos/profile-logo2.jpg ')}} @endif @endif">

                    </div>
                    <div class="fp-item-details" style="height: 95px;">
                    
                   
                      @if(Session::get('jcmUser')->userId == $people->emp_id)<p>{!! $people->firstName.' '.$people->lastName !!}</p>@else <p>{!! $people->firstName !!} <i class="fa fa-circle-o" aria-hidden="true"></i> <i class="fa fa-circle-o" aria-hidden="true"></i> @endif
                     
                      <p>@lang('home.'.JobCallMe::categoryTitle($people->industry))</p>
                      <p>@lang('home.'.JobCallMe::cityName($people->city)), @lang('home.'.JobCallMe::countryName($people->country))</p>
                    </div>
                  </a>
                </div>
              </div>
              @endforeach

            </div>
            <div style="text-align:center"><?php	echo $peoples->render(); ?></div>
            <!--FP item Row End-->
          </div>
        </div>
      </div>
    </section>
    @endsection
    @section('page-footer')
    <script type="text/javascript">

      $(document).ready(function(){
        getStates($('.job-country option:selected:selected').val());
        getSubCategories($('.job-category option:selected:selected').val());
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