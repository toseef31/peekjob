@extends('frontend.layouts.app')

@section('title','Job Update')

@section('content')

<section id="postNewJob">
    <!--  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypals') !!}" > -->
    {!! Form::open(['action'=>['frontend\Employer@updatepostPaymentWithpaypals'],'method'=>'post','class'=>'form-horizontal','files'=>true,'enctype'=>'multipart/form-data']) !!}
    {{ csrf_field() }}
    <div class="container">
	
        <div class="col-md-12">
		
            <div class="pnj-box">
			  <h3>@lang('home.jobupdate')</h3>
					<div class="col-md-12">
					   <div class="form-group error-group" style="display: none;">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field"><div class="alert alert-danger"></div></div>
                        </div>
              
               
               
                 
						
                    
				<!--  	<div class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid">
                
 
                        <ul id="post-job-ad-types">
						@foreach($recs as $payment)
                            <!----<li style="position:relative">
                                <!---->
                                <!--  <input class="mat-radio-input cdk-visually-hidden" type="radio" id="md-radio-2-input" name="p_Category" 
								   value="{!! $payment->id!!}" name="md-radio-group-0" @if($result->amount == $payment->price) checked @endif><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span><span class="b">{!! $payment->title!!}</span></div></label></md-radio-button>
                                <div>
                                  <!----<label for="{!! $payment->id!!}">
                                     <!--     <ul class="list-unstyled desc" >
                                            <li>{!! $payment->tag1!!}</li>
                                            <li>{!! $payment->tag2!!}</li>
                                        </ul>
										
                                        <div class="credits b">@if($payment->price ==0)
										Free
										@else
										<span class="text-success">$ {!! $payment->price!!}</span>
									<i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i>
									@endif</div>
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                <!--  </div>
                            </li>
							@endforeach
                        </ul>
                 

                    
                </div>
            </div> -->
		</div>
               
                  
                    <div class="pnj-form-section">
                       
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" value="{!! $result->title !!}" name="title" id="title" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_department')</label>
                            <div class="col-sm-7 pnj-form-field">
                                <select class="form-control select2" name="department">
                                    
                                        <option value="Accounting" {{ $result->department == 'Accounting' ? 'selected="selected"' : '' }}>@lang('home.Accounting')</option>
                                    <option value="Administration" {{ $result->department == 'Administration' ? 'selected="selected"' : '' }}>@lang('home.Administration')</option>
                                    <option value="Customer Services" {{ $result->department == 'Customer Services' ? 'selected="selected"' : '' }}>@lang('home.Customer Services')</option>
                                    <option value="Finance" {{ $result->department == 'Finance' ? 'selected="selected"' : '' }}>@lang('home.Finance')</option>
                                    <option value="Human Resources" {{ $result->department == 'Human Resources' ? 'selected="selected"' : '' }}>@lang('home.Human Resources')</option>
                                    <option value="Information Technology" {{ $result->department == 'Information Technology' ? 'selected="selected"' : '' }}>@lang('home.Information Technology')</option>
                                    <option value="Marketing" {{ $result->department == 'Marketing' ? 'selected="selected"' : '' }}>@lang('home.Marketing')</option>
                                    <option value="Procurement" {{ $result->department == 'Procurement' ? 'selected="selected"' : '' }}>@lang('home.Procurement')</option>
                                    <option value="Production" {{ $result->department == 'Production' ? 'selected="selected"' : '' }}>@lang('home.Production')</option>
                                    <option value="Quality Control" {{ $result->department == 'Quality Control' ? 'selected="selected"' : '' }}>@lang('home.Quality Control')</option>
                                     <option value="Research & Development" {{ $result->department == 'Research & Development' ? 'selected="selected"' : '' }}>@lang('home.Research & Development')</option>
                                      <option value="Sales" {{ $result->department == 'Sales' ? 'selected="selected"' : '' }}>@lang('home.Sales')</option>

                                    @foreach(JobCallMe::getDepartments() as $depart)
                                        <option value="{!! $depart->name !!}" {{ $result->department == $depart->name ? 'selected="selected"' : '' }}>{!! $depart->name !!}</option>
                                    @endforeach

                                </select>
								<br>
								<span style="padding-top:5px">@lang('home.addDepartment-text')</span>
                            </div>
                             <div class="col-md-2 pnj-form-field" style="margin-top:5px;"> <span><a href="{{ url('account/employer/departments') }}"><span style="background:#f0ad4e;padding:5px 10px;margin-top:5px;color:#fff;">@lang('home.addDepartment') ></span></a></span></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.category')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-category" name="category" onchange="getSubCategories(this.value)">
                                    @foreach(JobCallMe::getCategories() as $cat)
                                        <option value="{!! $cat->categoryId !!}" {{ $result->category == $cat->categoryId ? 'selected="selected"' : '' }}>@lang('home.'.$cat->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category" name="subCategory" onchange="getSubCategories2(this.value)">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category2" name="subCategory2">
									
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.careerlevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="careerLevel">
										<option value=" ">@lang('home.s_career')</option>
                                    @foreach(JobCallMe::getCareerLevel() as $career)
                                        <option value="{!! $career !!}" {{ $result->careerLevel == $career ? 'selected="selected"' : '' }}>@lang('home.'.$career)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.experiencelevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="experience">
                                    @foreach(JobCallMe::getExperienceLevel() as $experience)
                                        <option value="{!! $experience !!}" {{ $result->experience == $experience ? 'selected="selected"' : '' }}>@lang('home.'.$experience)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.vacancy')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="vacancy"  value="{!! $result->vacancies !!}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor">{!! $result->description !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.requireskills')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="skills" class="form-control tex-editor">{!! $result->skills !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.qualification')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" value="{!! $result->qualification !!}" name="qualification" placeholder="Qualification" required>
                            </div>
                        </div>
                        <div class="form-group" style="display:none">
                            <label class="control-label col-sm-3">@lang('home.expirydate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" value="{!! $result->expiryDate !!}"  name="expiryDate" onkeypress="return false">
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.naturejob')</h3>
                    <div class="pnj-form-section">
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.jobinformationtype')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="type">
                                    @foreach(JobCallMe::getJobType() as $jtype)
                                        <option value="{!! $jtype->name !!}" {{ $result->jobType == $jtype->name ? 'selected="selected"' : '' }}>@lang('home.'.$jtype->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Responsibilities')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" value="{!! $result->responsibilities !!}" name="responsibilities" placeholder="@lang('home.Responsibilities')">
                            </div>
                       </div>
					   <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.expptitle')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control" name="expptitle">
										<option value=" ">@lang('home.expptitle')</option>
                                    <option value="exp Employee" {{ $result->expptitle == 'exp Employee' ? 'selected="selected"' : '' }}>@lang('home.exp Employee')</option>  
										
										<option value="exp Chief/Senior Staff" {{ $result->expptitle == 'exp Chief/Senior Staff' ? 'selected="selected"' : '' }}>@lang('home.exp Chief/Senior Staff')</option>

                                        <option value="exp Assistant Manager" {{ $result->expptitle == 'exp Assistant Manager' ? 'selected="selected"' : '' }}>@lang('home.exp Assistant Manager')</option>

                                        <option value="exp Manager" {{ $result->expptitle == 'exp Manager' ? 'selected="selected"' : '' }}>@lang('home.exp Manager')</option>

                                        <option value="exp Deputy General Manger" {{ $result->expptitle == 'exp Deputy General Manger)' ? 'selected="selected"' : '' }}>@lang('home.exp Deputy General Manger')</option>

										<option value="exp General Manger" {{ $result->expptitle == 'exp General Manger' ? 'selected="selected"' : '' }}>@lang('home.exp General Manger')</option>

										<option value="exp Board of Director" {{ $result->expptitle == 'exp Board of Director' ? 'selected="selected"' : '' }}>@lang('home.exp Board of Director')</option>

										<option value="exp Researcher" {{ $result->expptitle == 'exp Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Researcher')</option>

										<option value="exp Chief Researcher" {{ $result->expptitle == 'exp Chief Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Chief Researcher')</option>

										<option value="exp Senior Researcher" {{ $result->expptitle == 'exp Senior Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Senior Researcher')</option>

										<option value="exp Head Researcher" {{ $result->expptitle == 'exp Head Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Head Researcher')</option>

										<option value="exp Principal Researcher" {{ $result->expptitle == 'exp Principal Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Principal Researcher')</option>

										<option value="exp Director of Research" {{ $result->expptitle == 'exp Director of Research' ? 'selected="selected"' : '' }}>@lang('home.exp Director of Research')</option>
                               </select>
                           </div>
                       </div>
					   <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.expposition')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control" name="expposition">
									<option value=" ">@lang('home.expposition')</option>
                                    <option value="expp Team members" {{ $result->expposition == 'expp Team members' ? 'selected="selected"' : '' }}>@lang('home.expp Team members')</option>  
										
										<option value="expp Team Leader" {{ $result->expposition == 'expp Team Leader' ? 'selected="selected"' : '' }}>@lang('home.expp Team Leader')</option>

                                        <option value="expp Manager" {{ $result->expposition == 'expp Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Manager')</option>

                                        <option value="expp Part Manager" {{ $result->expposition == 'expp Part Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Part Manager')</option>

                                        <option value="expp General Manger" {{ $result->expposition == 'expp General Manger)' ? 'selected="selected"' : '' }}>@lang('home.expp General Manger')</option>

										<option value="expp Branch Manager" {{ $result->expposition == 'expp Branch Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Branch Manager')</option>

										<option value="expp Branch office President" {{ $result->expposition == 'expp Branch office President' ? 'selected="selected"' : '' }}>@lang('home.expp Branch office President')</option>

										<option value="expp Director" {{ $result->expposition == 'expp Director' ? 'selected="selected"' : '' }}>@lang('home.expp Director')</option>

										<option value="expp Director of a bureau" {{ $result->expposition == 'expp Director of a bureau' ? 'selected="selected"' : '' }}>@lang('home.expp Director of a bureau')</option>

										<option value="expp Head Director" {{ $result->expposition == 'expp Head Director' ? 'selected="selected"' : '' }}>@lang('home.expp Head Director')</option>

										<option value="expp Center Chief" {{ $result->expposition == 'expp Center Chief' ? 'selected="selected"' : '' }}>@lang('home.expp Center Chief')</option>

										<option value="expp Production Director" {{ $result->expposition == 'expp Production Director' ? 'selected="selected"' : '' }}>@lang('home.expp Production Director')</option>

										<option value="expp Group Head" {{ $result->expposition == 'expp Group Head' ? 'selected="selected"' : '' }}>@lang('home.expp Group Head')</option>
                               </select>
                           </div>
                       </div>

                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.shift')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="shift">
                                    @foreach(JobCallMe::getJobShifts() as $jshift)
                                        <option value="{!! $jshift->name !!}" {{ $result->jobShift == $jshift->name ? 'selected="selected"' : '' }}>@lang('home.'.$jshift->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.jobaddr')</label>
                            <div class="col-sm-9 pnj-form-field">
								<input type="text" name="jobaddr" class="form-control" id="Address" value="<?php if ( isset($result->jobaddr) && $result->jobaddr != "" ){ print $result->jobaddr;}?>"  placeholder="@lang('home.jobaddrtext')" required />

                                
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">@lang('home.Working day')</label>
                                <div class="col-md-3 pnj-form-field">
                                    <select class="form-control" name="jobdayval" required>
										<option value="jobday01" {{ $result->jobdayval == 'jobday01' ? 'selected="selected"' : '' }}>@lang('home.jobday01')</option>
										<option value="jobday02" {{ $result->jobdayval == 'jobday02' ? 'selected="selected"' : '' }}>@lang('home.jobday02')</option>
										<option value="jobday03" {{ $result->jobdayval == 'jobday03' ? 'selected="selected"' : '' }}>@lang('home.jobday03')</option>
										<option value="jobday04" {{ $result->jobdayval == 'jobday04' ? 'selected="selected"' : '' }}>@lang('home.jobday04')</option>
										<option value="jobday05" {{ $result->jobdayval == 'jobday05' ? 'selected="selected"' : '' }}>@lang('home.jobday05')</option>
										<option value="jobday06" {{ $result->jobdayval == 'jobday06' ? 'selected="selected"' : '' }}>@lang('home.jobday06')</option>
										<option value="jobday07" {{ $result->jobdayval == 'jobday07' ? 'selected="selected"' : '' }}>@lang('home.jobday07')</option>
										<option value="jobday08" {{ $result->jobdayval == 'jobday08' ? 'selected="selected"' : '' }}>@lang('home.jobday08')</option>
										<option value="jobday09" {{ $result->jobdayval == 'jobday09' ? 'selected="selected"' : '' }}>@lang('home.jobday09')</option>
										<option value="jobday10" {{ $result->jobdayval == 'jobday10' ? 'selected="selected"' : '' }}>@lang('home.jobday10')</option>
                                        
                                    </select>
                                </div>

								<div class="col-md-6 pnj-form-field">								
								
										<input type="text" class="form-control" name="jobdayval_text" value="{!! $result->jobdayval_text !!}" placeholder="@lang('home.jobdayval_text')">
									
								</div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">@lang('home.Working hours')</label>
                                <div class="col-md-3 pnj-form-field"">
                                    <select class="form-control" name="jobhoursval" required>
										<option value="jobhours01" {{ $result->jobhoursval == 'jobhours01' ? 'selected="selected"' : '' }}>@lang('home.jobhours01')</option>
										<option value="jobhours02" {{ $result->jobhoursval == 'jobhours02' ? 'selected="selected"' : '' }}>@lang('home.jobhours02')</option>
										<option value="jobhours03" {{ $result->jobhoursval == 'jobhours03' ? 'selected="selected"' : '' }}>@lang('home.jobhours03')</option>
										<option value="jobhours04" {{ $result->jobhoursval == 'jobhours04' ? 'selected="selected"' : '' }}>@lang('home.jobhours04')</option>
										<option value="jobhours05" {{ $result->jobhoursval == 'jobhours05' ? 'selected="selected"' : '' }}>@lang('home.jobhours05')</option>
										<option value="jobhours06" {{ $result->jobhoursval == 'jobhours06' ? 'selected="selected"' : '' }}>@lang('home.jobday06')</option>										
                                    </select>
                                </div>

								<div class="col-md-6 pnj-form-field">								
								
										<input type="text" class="form-control" name="jobhoursval_text" value="{!! $result->jobhoursval_text !!}" placeholder="@lang('home.jobhoursval_text')">
									
								</div>
                        </div>


					     <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate1')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                
                                        <div class="col-md-4 benefits-checks">
                                            <input id="head" type="checkbox" class="cbx-field" name="head" value="yes" {{ $result->head == 'yes' ? 'checked=""' : '' }}>								
											<label class="cbx" for="head"></label>
                                            <label class="lbl" for="head">@lang('home.abouthead')</label>
                                            
                                        </div>
                              
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                
                                        <div class="col-md-4 benefits-checks">                                        
											<input id="dispatch" type="checkbox" class="cbx-field" name="dispatch" value="yes" {{ $result->dispatch == 'yes' ? 'checked=""' : '' }}>
											<label class="cbx" for="dispatch"></label>
                                            <label class="lbl" for="dispatch">@lang('home.dispatchinformation')</label>
                                        </div>
                              
                                </div>
                            </div>
                        </div>
                   </div>


				   <h3>@lang('home.Eligibility and preferential terms')</h3>
                    <div class="pnj-form-section">
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.jobacademic')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control" name="jobacademic">  									
                                        <option value="highschool" {{ $result->jobacademic == 'highschool' ? 'selected="selected"' : '' }}>@lang('home.highschool')</option>
                                        <option value="college" {{ $result->jobacademic == 'college' ? 'selected="selected"' : '' }}>@lang('home.college')</option>
                                        <option value="university" {{ $result->jobacademic == 'university' ? 'selected="selected"' : '' }}>@lang('home.university')</option>
                                        <option value="graduateschool" {{ $result->jobacademic == 'graduateschool' ? 'selected="selected"' : '' }}>@lang('home.graduateschool')</option>
                                        <option value="Doctorate(phd)" {{ $result->jobacademic == 'Doctorate(phd)' ? 'selected="selected"' : '' }}>@lang('home.Doctorate(phd)')</option>
										<option value="Vocational" {{ $result->jobacademic == 'Vocational' ? 'selected="selected"' : '' }}>@lang('home.Vocational')</option>
										<option value="Associate Degree" {{ $result->jobacademic == 'Associate Degree' ? 'selected="selected"' : '' }}>@lang('home.Associate Degree')</option>
										<option value="Certification" {{ $result->jobacademic == 'Certification' ? 'selected="selected"' : '' }}>@lang('home.Certification')</option>
                                    
									</select>

									<div class="row" style="padding-top:20px">
                                   
                                        <div class="col-md-2 benefits-checks">
                                            <input id="jobacademic_not" type="checkbox" class="cbx-field" name="jobacademic_not" value="yes" {{ $result->jobacademic_not == 'yes' ? 'checked=""' : '' }}>								
											<label class="cbx" for="jobacademic_not"></label>
											<label class="lbl" for="jobacademic_not">@lang('home.Regardless Education')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobgraduate" type="checkbox" class="cbx-field" name="jobgraduate" value="yes" {{ $result->jobgraduate == 'yes' ? 'checked=""' : '' }}>								
											<label class="cbx" for="jobgraduate"></label>
											<label class="lbl" for="jobgraduate">@lang('home.jobgraduate')</label>
                                        </div>

										
										
                                </div>


                           </div>
                       </div>
					    
					   <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.gender')</label>
                                <div class="col-md-9 pnj-form-field">
                                    <select class="form-control" name="gender">
										<option value="Nosex" {{ $result->gender == 'Nosex' ? 'selected="selected"' : '' }}>@lang('home.Nosex')</option>
                                        <option value="Male" {{ $result->gender == 'Male' ? 'selected="selected"' : '' }}>@lang('home.male')</option>
                                        <option value="Female" {{ $result->gender == 'Female' ? 'selected="selected"' : '' }}>@lang('home.female')</option>
                                    </select>
                                </div>
                        </div>

					
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.age')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    
									<div class="col-md-3 pnj-salary">
                                        <input type="text" class="form-control" name="jobage1" value="{!! $result->jobage1 !!}" placeholder="@lang('home.age-text')">
                                    </div>
                                    <div class="col-md-3 pnj-salary">
                                        <input type="text" class="form-control" name="jobage2" value="{!! $result->jobage2 !!}" placeholder="@lang('home.age-text')">
                                    </div>  
									<div class="col-md-2">
                                        <input id="jobnoage" type="checkbox" class="cbx-field" name="jobnoage" value="yes" {{ $result->jobnoage == 'yes' ? 'checked=""' : '' }}>								
											<label class="cbx" for="jobnoage"></label>
											<label class="lbl" for="jobnoage">@lang('home.jobnoage')</label>
                                    </div>
                                </div>
								
                            </div>
                        </div>

						<!--
						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expptitle')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="expptitle">  									
                                        <option value="exp Employee" {{ $meta->expptitle == 'exp Employee' ? 'selected="selected"' : '' }}>@lang('home.exp Employee')</option>  
										
										<option value="exp Chief/Senior Staff" {{ $meta->expptitle == 'exp Chief/Senior Staff' ? 'selected="selected"' : '' }}>@lang('home.exp Chief/Senior Staff')</option>

                                        <option value="exp Assistant Manager" {{ $meta->expptitle == 'exp Assistant Manager' ? 'selected="selected"' : '' }}>@lang('home.exp Assistant Manager')</option>

                                        <option value="exp Manager" {{ $meta->expptitle == 'exp Manager' ? 'selected="selected"' : '' }}>@lang('home.exp Manager')</option>

                                        <option value="exp Deputy General Manger" {{ $meta->expptitle == 'exp Deputy General Manger)' ? 'selected="selected"' : '' }}>@lang('home.exp Deputy General Manger')</option>

										<option value="exp General Manger" {{ $meta->expptitle == 'exp General Manger' ? 'selected="selected"' : '' }}>@lang('home.exp General Manger')</option>

										<option value="exp Board of Director" {{ $meta->expptitle == 'exp Board of Director' ? 'selected="selected"' : '' }}>@lang('home.exp Board of Director')</option>

										<option value="exp Researcher" {{ $meta->expptitle == 'exp Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Researcher')</option>

										<option value="exp Chief Researcher" {{ $meta->expptitle == 'exp Chief Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Chief Researcher')</option>

										<option value="exp Senior Researcher" {{ $meta->expptitle == 'exp Senior Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Senior Researcher')</option>

										<option value="exp Head Researcher" {{ $meta->expptitle == 'exp Head Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Head Researcher')</option>

										<option value="exp Principal Researcher" {{ $meta->expptitle == 'exp Principal Researcher' ? 'selected="selected"' : '' }}>@lang('home.exp Principal Researcher')</option>

										<option value="exp Director of Research" {{ $meta->expptitle == 'exp Director of Research' ? 'selected="selected"' : '' }}>@lang('home.exp Director of Research')</option>
                                    
									</select>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expposition')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="expptitle">  									
                                        <option value="expp Team members" {{ $meta->expposition == 'expp Team members' ? 'selected="selected"' : '' }}>@lang('home.expp Team members')</option>  
										
										<option value="expp Team Leader" {{ $meta->expposition == 'expp Team Leader' ? 'selected="selected"' : '' }}>@lang('home.expp Team Leader')</option>

                                        <option value="expp Manager" {{ $meta->expposition == 'expp Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Manager')</option>

                                        <option value="expp Part Manager" {{ $meta->expposition == 'expp Part Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Part Manager')</option>

                                        <option value="expp General Manger" {{ $meta->expposition == 'expp General Manger)' ? 'selected="selected"' : '' }}>@lang('home.expp General Manger')</option>

										<option value="expp Branch Manager" {{ $meta->expposition == 'expp Branch Manager' ? 'selected="selected"' : '' }}>@lang('home.expp Branch Manager')</option>

										<option value="expp Branch office President" {{ $meta->expposition == 'expp Branch office President' ? 'selected="selected"' : '' }}>@lang('home.expp Branch office President')</option>

										<option value="expp Director" {{ $meta->expposition == 'expp Director' ? 'selected="selected"' : '' }}>@lang('home.expp Director')</option>

										<option value="expp Director of a bureau" {{ $meta->expposition == 'expp Director of a bureau' ? 'selected="selected"' : '' }}>@lang('home.expp Director of a bureau')</option>

										<option value="expp Head Director" {{ $meta->expposition == 'expp Head Director' ? 'selected="selected"' : '' }}>@lang('home.expp Head Director')</option>

										<option value="expp Center Chief" {{ $meta->expposition == 'expp Center Chief' ? 'selected="selected"' : '' }}>@lang('home.expp Center Chief')</option>

										<option value="expp Production Director" {{ $meta->expposition == 'expp Production Director' ? 'selected="selected"' : '' }}>@lang('home.expp Production Director')</option>

										<option value="expp Group Head" {{ $meta->expposition == 'expp Group Head' ? 'selected="selected"' : '' }}>@lang('home.expp Group Head')</option>
                                    
									</select>
                            </div>
                        </div>

                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.shift')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="shift">
                                    @foreach(JobCallMe::getJobShifts() as $jshift)
                                        <option value="{!! $jshift->name !!}">@lang('home.'.$jshift->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.jobaddr')</label>
                            <div class="col-sm-9 pnj-form-field">
								<input type="text" name="jobaddr" class="form-control" id="Address" value="<?php if ( isset($listing_step['jobaddr']) && $listing_step['jobaddr'] != "" ){ print $listing_step['jobaddr'];}?>"  placeholder="@lang('home.jobaddrtext')" required />

                                
                            </div>
                        </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate1')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 benefits-checks">
                                        <input id="head" type="checkbox" class="cbx-field" name="head" value="yes">								
										<label class="cbx" for="head"></label>
                                        <label class="lbl" for="head">@lang('home.abouthead')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                
                                        <div class="col-md-4 benefits-checks">                                        
											<input id="dispatch" type="checkbox" class="cbx-field" name="dispatch" value="yes">
											<label class="cbx" for="dispatch"></label>
                                            <label class="lbl" for="dispatch">@lang('home.dispatchinformation')</label>
                                        </div>
                              
                                </div>
                            </div>
                        </div>
						 -->

                   </div>

                   
                   <h3>@lang('home.admissionsprocess')</h3>
                    <div class="pnj-form-section">                        
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.admissionsprocess')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <?php $addmissionprocess = explode(',', $result->process); ?>
                                    <?php 
                                        $array = array_unique (array_merge (JobCallMe::jobProcess(),$addmissionprocess)); 
                                    ?>
                                    @foreach($array as $process)
                                        <div class="col-md-4 benefits-checks">
                                            <input id="{{ str_replace(' ','-',$process) }}"  type="checkbox" class="cbx-field" name="process[]" value="{{ $process }}" @foreach($addmissionprocess as $addmission) @if($process == $addmission) checked @endif @endforeach>
                                            <label class="cbx" for="{{ str_replace(' ','-',$process) }}"></label>
                                            <label class="lbl" for="{{ str_replace(' ','-',$process) }}">@if(Lang::has('home.'.$process, 'en') || Lang::has('home.'.$process, 'kr')) @lang('home.'.$process) @else {{ $process}} @endif<!-- {{ $process }} --></label>
                                        </div>
                                    @endforeach
                                        <div class="col-md-4 ">
                                            <input id="addprocess"  type="checkbox" class="cbx-field" value="yes">
                                            <label class="cbx" for="addprocess"></label>
                                            <label class="lbl" for="addprocess">@lang('home.add')</label>
                                        </div>
                                        <div class="optionBox" id="moreprocess" style="display:none">
                                            
                                            <div class="col-md-10 block">
                                                <button type="button" class="add btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                        
                                </div>

                                

                            </div>                          
                        </div>
                    </div>
					

					<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.How to register')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">                                    
                                        <div class="col-md-12 benefits-checks">
                                            <input id="jobreceipt01"  type="checkbox" class="cbx-field" name="jobreceipt01" value="yes" {{ $result->jobreceipt01 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt01"></label>
                                            <label class="lbl" for="jobreceipt01">@lang('home.jobreceipt01')</label>
                                        </div>
										<div class="col-md-2 benefits-checks">
                                            <input id="jobreceipt02"  type="checkbox" class="cbx-field" name="jobreceipt02"  value="yes" {{ $result->jobreceipt02 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt02"></label>
                                            <label class="lbl" for="jobreceipt02">@lang('home.jobreceipt02')</label>
                                        </div>
										<div class="col-sm-5 pnj-form-field">
											<input type="text" class="form-control" name="jobhomgpage" value="{!! $result->jobhomgpage !!}" placeholder="@lang('home.jobhomgpage')">
										</div>
								</div>
								<div class="row"> 
										<div class="col-md-3 benefits-checks">
                                            <input id="jobreceipt07"  type="checkbox" class="cbx-field" name="jobreceipt07"  value="yes" {{ $result->jobreceipt07 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt07"></label>
                                            <label class="lbl" for="jobreceipt07">@lang('home.jobreceipt07')</label>
                                        </div>
										<div class="col-md-3 benefits-checks">
                                            <input id="jobreceipt03"  type="checkbox" class="cbx-field" name="jobreceipt03"  value="yes" {{ $result->jobreceipt03 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt03"></label>
                                            <label class="lbl" for="jobreceipt03">@lang('home.jobreceipt03')</label>
                                        </div>
										<div class="col-md-3 benefits-checks">
                                            <input id="jobreceipt04"  type="checkbox" class="cbx-field" name="jobreceipt04"  value="yes" {{ $result->jobreceipt04 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt04"></label>
                                            <label class="lbl" for="jobreceipt04">@lang('home.jobreceipt04')</label>
                                        </div>
										<div class="col-md-3 benefits-checks">
                                            <input id="jobreceipt05"  type="checkbox" class="cbx-field" name="jobreceipt05"  value="yes" {{ $result->jobreceipt05 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt05"></label>
                                            <label class="lbl" for="jobreceipt05">@lang('home.jobreceipt05')</label>
                                        </div>
										<div class="col-md-3 benefits-checks">
                                            <input id="jobreceipt06"  type="checkbox" class="cbx-field" name="jobreceipt06"  value="yes" {{ $result->jobreceipt06 == 'yes' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="jobreceipt06"></label>
                                            <label class="lbl" for="jobreceipt06">@lang('home.jobreceipt06')</label>
                                        </div>
                                        				
                                </div>
                            </div>							
                        </div>


                    <h3>@lang('home.compensationbenefits')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.salary')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 pnj-salary">
                                        <input type="text" class="form-control" name="minSalary" value="{!! $result->minSalary !!}">
                                    </div>
                                    <div class="col-md-4 pnj-salary">
                                        <input type="text" class="form-control" name="maxSalary" value="{!! $result->maxSalary !!}">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control col-md-4 select2" name="currency">
                                        
                                            @foreach(JobCallMe::siteCurrency() as $currency)
                                                <option value="{!! $currency !!}" {{ $result->currency == $currency ? 'selected="selected"' : '' }}>{!! $currency !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


								<div class="row" style="padding-top:20px">


                                        <div class="col-md-4 benefits-checks">
											<input class="mat-radio-input cdk-visually-hidden" type="radio" name="afterinterview" value="expectedSalary-check" @if($result->afterinterview == "expectedSalary-check") checked @else @endif > @lang('home.expectedSalary-check')	

                                            <!-- <input id="expectedSalary" type="checkbox" class="cbx-field" name="expectedSalary" value="yes">								
											<label class="cbx" for="expectedSalary"></label>
											<label class="lbl" for="expectedSalary">@lang('home.expectedSalary-check')</label> -->
                                        </div>

										<div class="col-md-4 benefits-checks">
											<input class="mat-radio-input cdk-visually-hidden" type="radio" name="afterinterview" value="Decision after interview" @if($result->afterinterview == "Decision after interview") checked @else @endif> @lang('home.Decision after interview')&nbsp;&nbsp;&nbsp;

                                            <!-- <input id="afterinterview" type="checkbox" class="cbx-field" name="afterinterview" value="yes">								
											<label class="cbx" for="afterinterview"></label>
											<label class="lbl" for="afterinterview">@lang('home.Decision after interview')</label> -->
                                        </div>										
										
                                </div>

                            </div>
                        </div>

                            
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.benefits')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    
                                    <?php $compensationbenefit = explode(',', $result->benefits); ?>
                                    <?php 
                                        $array2 = array_unique (array_merge (JobCallMe::jobBenefits(),$compensationbenefit));
                                    ?> 
                                    @foreach($array2 as $benefit)
                                        <div class="col-md-4 benefits-checks">
                                            <input id="{{ str_replace(' ','-',$benefit) }}"  type="checkbox" class="cbx-field" name="benefits[]" value="{{ $benefit }}" @foreach($compensationbenefit as $benefitser) @if($benefit == $benefitser) checked @endif @endforeach>
                                            <label class="cbx" for="{{ str_replace(' ','-',$benefit) }}"></label>
                                            <label class="lbl" for="{{ str_replace(' ','-',$benefit) }}">@if(Lang::has('home.'.$benefit, 'en') || Lang::has('home.'.$benefit, 'kr')) @lang('home.'.$benefit) @else {{ $benefit}} @endif</label>
                                        </div>
                                    @endforeach
                                    <div class="col-md-4 ">
                                            <input id="addbenefit"  type="checkbox" class="cbx-field" value="yes">
                                            <label class="cbx" for="addbenefit"></label>
                                            <label class="lbl" for="addbenefit">@lang('home.add')</label>
                                        </div>
                                        <div class="optionBox" id="morebenefit" style="display:none">
                                            
                                            <div class="col-md-10 block2">
                                                <button type="button" class="add2 btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.location')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.country')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ $result->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.state')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" data-state="{{ $result->state }}">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" data-city="{{ $result->city }}">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input id="pac-input" name="Address" class="form-control" type="text" placeholder="Enter a location" value="{!! $result->Address !!}">
                                <div class="pac-card" id="pac-card">
                                  <div>
                                    <div id="type-selector" class="pac-controls">
                                      <input type="radio"  id="changetype-all" checked="checked">
                                      <label for="changetype-all">All</label>

                                      <input type="radio"  id="changetype-establishment">
                                      <label for="changetype-establishment">Establishments</label>

                                      <input type="radio"  id="changetype-address">
                                      <label for="changetype-address">Addresses</label>

                                      <input type="radio"  id="changetype-geocode">
                                      <label for="changetype-geocode">Geocodes</label>
                                    </div>
                                    <div id="strict-bounds-selector" class="pac-controls">
                                      <input type="checkbox" id="use-strict-bounds" value="">
                                      <label for="use-strict-bounds">Strict Bounds</label>
                                    </div>
                                  </div>
                                 
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="Address2" id="Address2" placeholder="@lang('home.address2')" value="{!! $result->Address2 !!}">
                            </div>
                        </div>

                    </div>
                    <!-- google map code html -->
                    <div id="map"></div>
                    <div id="infowindow-content">
                      <img src="" width="16" height="16" id="place-icon">
                      <span id="place-name"  class="title"></span><br>
                      <span id="place-address"></span>
                    </div>
                    <h3>@lang('home.declarationandacknowledgement')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-9 da-box">
                                <p>@lang('home.pleasereadcarefully')</p>
                                <ul>
                                    <li>@lang('home.postli1')</li>
                                    <li>@lang('home.postli2')</li>
                                    <li>@lang('home.postli3')</li>
                                    <li>@lang('home.postli4')</li>
                                </ul>
                                <p>@lang('home.postp')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-offset-4 col-md-8  pnj-btns">
                        <button type="submit" class="btn btn-primary" name="save">@lang('home.updatejob')</button>
                        <a href="{{ url('account/employer') }}" class="btn btn-default">@lang('home.CANCEL')</a>
                    </div>
                
            </div>
        </div>
    </div>
    </form>
<style type="text/css">
     #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      /*#pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        
      }*/

      #pac-input:focus {
        border-color: #4d90fe;
      }

      
</style>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
        $('#addprocess').on('change', function() {
      // process= $('#addprocess').val();
        if(this.checked)
        {
            //alert("hi nabeel");
            //$('#addlable').show();
            $('#moreprocess').show();
        }
        else{
            //$('#addlable').hide();
            $('#moreprocess').hide();
        }
    });

     $('#addbenefit').on('change', function() {
      // process= $('#addprocess').val();
        if(this.checked)
        {
            //alert("hi nabeel");
           // $('#addlable').show();
            $('#morebenefit').show();
        }
        else{
          //  $('#addlable').hide();
            $('#morebenefit').hide();
        }
    })
    $('.add').click(function() {
     $('#moreprocess').append('<div class="col-md-8 pnj-salary block" style="display: flex;margin-bottom: 9px;"><input type="text" class="form-control" name="process[]" required /><button type="button" class="remove btn btn-danger" style="padding-left: 14px;"><i class="fa fa-minus"></i></button></div>');

    });
    $('.add2').click(function() {
     $('#morebenefit').append('<div class="col-md-8 pnj-salary block" style="display: flex;margin-bottom: 9px;"><input type="text" class="form-control" name="benefits[]" required /><button type="button" class="remove btn btn-danger" style="padding-left: 14px;"><i class="fa fa-minus"></i></button></div>');

    });
    $('.optionBox').on('click','.remove',function() {
    $(this).parent().remove();
});
    getStates($('.job-country option:selected:selected').val());
    getSubCategories($('.job-category option:selected:selected').val());
});

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
tinymce.init({
    selector: '.tex-editor',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    },
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
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

function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
var formPost = 1;

</script>
<!-- google map code start from there  -->
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 37.516172, lng: 127.038786},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initMap" async defer></script>

@endsection