		@extends('frontend.layouts.app')

		@section('title', 'Career Tab')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
			 <div class="col-md-2">
			 </div>
				<div class="col-md-8 company-box-left">
				<h4>@lang('home.Set Job Filters')</h4>
				 <form role="form" action="{{ url('jobs') }}" method="get">
						 
							<div class="modal-body">
							<div class="row">
								<div class="col-md-12 pnj-form-field">
								   <div class="form-group">
                                    <select class="form-control" name="degree">
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
								 <div class="col-md-6 pnj-form-field">
								 <select class="form-control" name="experience">
                            <option value="">@lang('home.s_experience')</option>
                            @foreach(JobCallMe::getExperienceLevel() as $experience)
                                <option value="{!! $experience !!}" {{ $experience == Request::input('experience') ? 'selected="selected"' : '' }}>@lang('home.'.$experience)</option>
                            @endforeach
                        </select>
					   </div>
					   	 <div class="col-md-6 pnj-form-field">
								 <select class="form-control" name="career">
                            <option value="">@lang('home.s_career')</option>
                            @foreach(JobCallMe::getCareerLevel() as $career)
                                <option value="{!! $career !!}" {{ $career == Request::input('career') ? 'selected="selected"' : '' }}>@lang('home.'.$career)</option>
                            @endforeach
                        </select>
					   </div>
			       <div class="col-md-12 pnj-form-field">
                          <div class="form-group">
                                <select class="form-control select2 job-country" name="countrys">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}">@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
						<div class="col-md-12 pnj-form-field">
                              <div class="form-group">
                                <select class="form-control select2 job-state" name="states">
                                <option value="">@lang('home.state')</option>
                                </select>
                                 </div>
                              </div>
						 
                            <div class="col-md-12 pnj-form-field">
                             <div class="form-group">
                                <select class="form-control select2 job-city" name="cityss">
                                <option value="">@lang('home.city')</option>

                                </select>
                            </div>
                        </div>
                        <div id="advance" style="display:none">
                         <div class="col-md-12 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="text" class="form-control" name="keywords" placeholder="@lang('home.degress')">
                              </div>
                           </div>
					   </div>
                        <div class="col-md-12 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="text" class="form-control" name="mm" placeholder="@lang('home.workedas')">
                              </div>
                           </div>
					   </div>
                        <div class="col-md-12 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="text" class="form-control" name="exmaz" placeholder="@lang('home.skills')">
                              </div>
                           </div>
					   </div>
                                <div class="col-md-12 pnj-form-field">
                                <div class="form-group">
                                   <div class=" pnj-form-field">
                                    <select class="form-control input-sm select2" name="language">
                                         <option value="">@lang('home.Languages')</option>
                                          <option value="Afrikanns">@lang('home.Afrikanns')</option>
										  <option value="Albanian">@lang('home.Albanian')</option>
										  <option value="Arabic">@lang('home.Arabic')</option>
										  <option value="Armenian">@lang('home.Armenian')</option>
										  <option value="Basque">@lang('home.Basque')</option>
										  <option value="Bengali">@lang('home.Bengali')</option>
										  <option value="Bulgarian">@lang('home.Bulgarian')</option>
										  <option value="Catalan">@lang('home.Catalan')</option>
										  <option value="Cambodian">@lang('home.Cambodian')</option>
										  <option value="Chinese (Mandarin)">@lang('home.Chinese (Mandarin)')</option>
										  <option value="Croation">@lang('home.Croation')</option>
										  <option value="Czech">@lang('home.Czech')</option>
										  <option value="Danish">@lang('home.Danish')</option>
										  <option value="Dutch">@lang('home.Dutch')</option>
										  <option value="English">@lang('home.English')</option>
										  <option value="Estonian">@lang('home.Estonian')</option>
										  <option value="Fiji">@lang('home.Fiji')</option>
										  <option value="Finnish">@lang('home.Finnish')</option>
										  <option value="French">@lang('home.French')</option>
										  <option value="Georgian">@lang('home.Georgian')</option>
										  <option value="German">@lang('home.German')</option>
										  <option value="Greek">@lang('home.Greek')</option>
										  <option value="Gujarati">@lang('home.Gujarati')</option>
										  <option value="Hebrew">@lang('home.Hebrew')</option>
										  <option value="Hindi">@lang('home.Hindi')</option>
										  <option value="Hungarian">@lang('home.Hungarian')</option>
										  <option value="Icelandic">@lang('home.Icelandic')</option>
										  <option value="Indonesian">@lang('home.Indonesian')</option>
										  <option value="Irish">@lang('home.Irish')</option>
										  <option value="Italian">@lang('home.Italian')</option>
										  <option value="Japanese">@lang('home.Japanese')</option>
										  <option value="Javanese">@lang('home.Javanese')</option>
										  <option value="Korean">@lang('home.Korean')</option>
										  <option value="Latin">@lang('home.Latin')</option>
										  <option value="Latvian">@lang('home.Latvian')</option>
										  <option value="Lithuanian">@lang('home.Lithuanian')</option>
										  <option value="Macedonian">@lang('home.Macedonian')</option>
										  <option value="Malay">@lang('home.Malay')</option>
										  <option value="Malayalam">@lang('home.Malayalam')</option>
										  <option value="Maltese">@lang('home.Maltese')</option>
										  <option value="Maori">@lang('home.Maori')</option>
										  <option value="Marathi">@lang('home.Marathi')</option>
										  <option value="Mongolian">@lang('home.Mongolian')</option>
										  <option value="Nepali">@lang('home.Nepali')</option>
										  <option value="Norwegian">@lang('home.Norwegian')</option>
										  <option value="Persian">@lang('home.Persian')</option>
										  <option value="Polish">@lang('home.Polish')</option>
										  <option value="Portuguese">@lang('home.Portuguese')</option>
										  <option value="Punjabi">@lang('home.Punjabi')</option>
										  <option value="Quechua">@lang('home.Quechua')</option>
										  <option value="Romanian">@lang('home.Romanian')</option>
										  <option value="Russian">@lang('home.Russian')</option>
										  <option value="Samoan">@lang('home.Samoan')</option>
										  <option value="Serbian">@lang('home.Serbian')</option>
										  <option value="Slovak">@lang('home.Slovak')</option>
										  <option value="Slovenian">@lang('home.Slovenian')</option>
										  <option value="Spanish">@lang('home.Spanish')</option>
										  <option value="Swahili">@lang('home.Swahili')</option>
										  <option value="Swedish">@lang('home.Swedish')</option>
										  <option value="Tamil">@lang('home.Tamil')</option>
										  <option value="Tatar">@lang('home.Tatar')</option>
										  <option value="Telugu">@lang('home.Telugu')</option>
										  <option value="Thai">@lang('home.Thai')</option>
										  <option value="Tibetan">@lang('home.Tibetan')</option>
										  <option value="Tonga">@lang('home.Tonga')</option>
										  <option value="Turkish">@lang('home.Turkish')</option>
										  <option value="Ukranian">@lang('home.Ukranian')</option>
										  <option value="Urdu">@lang('home.Urdu')</option>
										  <option value="Uzbek">@lang('home.Uzbek')</option>
										  <option value="Vietnamese">@lang('home.Vietnamese')</option>
										  <option value="Welsh">@lang('home.Welsh')</option>
										  <option value="Xhosa">@lang('home.Xhosa')</option>
										
                                    </select>
                                </div>
                                </div>
                                </div>
                                  </div>
                                  <div class="col-md-12 pnj-form-field">
                                <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <label class="switch" id="filter">
                                    <input type="checkbox" checked >
                                    <span class="slider round"></span>
                                   </label>
                                    <span style="color: #CCC;">@lang('home.Filter existing application')</span> 
                                    </div>
                                </div>
                                  </div>         
		              	</div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit"  style="float:left" class="btn btn-success" >@lang('home.save')</button>   <button type="button" style="float:left" class="btn btn-default" id="advance_click">@lang('home.Advancefilters')</button>   <button type="button" style="float:left" class="btn btn-default"><a href="{{url('account/employer')}}">@lang('home.filterskip')</a></button>
                    </div>
                </form>	
				</div>
			   <div class="col-md-2">
	         </div>
				 
			</div>
		</section>
        <style>
.switch {
  position: relative;
  display: inline-block;
  width: 65px;
  height: 24px;
}

.switch input {}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 9px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
        $('#advance_click').click(function(){
           // alert("hell0");
            $('#advance').toggle();;

        });
		</script>
		@endsection