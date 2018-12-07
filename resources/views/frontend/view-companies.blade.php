@extends('frontend.layouts.app')

@section('title', 'Companies')

@section('content')
<section id="companies-section">
    <div class="container">
        <div class="col-md-12 learn-search-box">
            <h2 class="text-center"><!-- @lang('home.companiesin') @lang('home.'.JobCallMe::countryName(JobCallMe::getHomeCountry())) --></h2>
            <div class="row">
                <div class="col-md-offset-2 col-md-8" style="margin-top:20px">
                    <div class="ls-box">
                        <form role="form" action="{{ url('companies') }}" method="post">
                            {{ csrf_field() }}
                            <div class="input-fields">
                                <div class="search-field-box search-item">
                                    <input type="search" placeholder="@lang('home.key')" name="keyword">
                                </div>
                                <div class="search-field-box search-item">
                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="width: 100%">
                                </div>
                                <button type="submit" class="search-btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-2">

                </div>
            </div>-->
            <div class="row text-sm  companies-list">
                <div class="col-md-12">
                    <h4 class="category-label">@lang('home.companiesindustry')</h4>
                    <div class="col-md-4">
                    <ul class="list-unstyled">
                    <?php 
                    $i = 1; 
                    foreach(JobCallMe::getCategories() as $cat){
                        //if($i == 10){
						if($i == 7){
                            $i = 1; 
                            echo '</ul></div>';
                            echo '<div class="col-md-4">';
                            echo '<ul class="list-unstyled">';
                        }
                        echo '<li class="ellipsis"><a href="'.url('companies?in='.$cat->categoryId).'" class="hvr-forward">'.trans('home.'.$cat->name).'</a></li>';
                        $i++;
                    ?>
                    <?php }?>
                    </ul>
                    </div>
                </div>
            </div>
            
        </div>
       
    </div>
     
</section>
<section>
    <div class="container">
        <div class="companies-item-box">

            <div class="row">
                @foreach($companies as $company)
                    <?php
                    //print_r($company);exit;
                    $cLogo = url('compnay-logo/default-logo.jpg');
                    if($company->companyLogo != ''){
                      $cLogo = url('compnay-logo/'.$company->companyLogo);
                    }
                    ?>
                    <div class="col-md-2 col-xs-6 hvr-bob companies-mbl-vew" style="padding-right: 0px">
                        <!-- normal -->
                        <div class="ih-item square effect8 scale_up">
                            <a href="{{ url('companies/company/'.$company->companyId) }}">
                            <div class="img"><img src="{{ $cLogo }}" alt="img" class="img-resposive"></div>
                            <div class="info">
                                <h3>{!! $company->companyName !!}</h3>
					<?
					 $string = strip_tags($company->companyAbout);
					 if (strlen($string) > 130) {

								// truncate string
									$stringCut = substr($string, 0, 130);
									 $endPoint = strrpos($stringCut, ' ');

								//if the string doesn't contain any space then it will cut without word basis.
									//$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

									$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
									$string .= '... '.trans('home.Read More').'';
									
					}
					?>

                                <p>{!! $string !!}<!-- {!! substr(strip_tags($company->companyAbout),0,100) !!} --></p>
                            </div></a>
							<div class="info companies-mbl-info">
                                <h3>{!! $company->companyName !!}</h3>                               
                            </div>

                        </div>
                        <!-- end normal -->
                    </div>
                @endforeach
            </div>
        </div>
        <div style="text-align:center"><?php	echo $companies->render(); ?></div>
    </div>
</section>
<link href="{{ asset('frontend-assets/css/ihover.css') }}" rel="stylesheet">
<style type="text/css">
.ih-item.square.effect8 .info h3 {font-size: 13px;}
</style>
@endsection
@section('page-footer')