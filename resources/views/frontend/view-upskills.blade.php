@extends('frontend.layouts.app')

@section('title', 'Upskills')

@section('content')

<section id="read-section">
    <div class="container">
     @if ($message = Session::get('successs'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('successs');?>
                @endif
        <div class="col-md-12 learn-search-box" style="padding-top:90px">

            
			<h2 class="text-center">
						@if(app()->getLocale() == "kr")
						    @lang('home.upskillheaderHeading')<!-- <div id="hp_text5"></div> --><!-- @lang('home.headerHeading') -->
						@else
						    @lang('home.upskillheaderHeading')<!-- <div id="hp_text6"></div> --><!-- @lang('home.headerHeading') -->
						@endif
			</h2>
            
            
        </div>
    </div>
</section>

<section id="postNewJob" style="margin-bottom:50px">
    <div class="container">
        @if(count($upskills) > 0)
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3>
                        @lang('home.promoteofferings')
                        <a class="btn btn-primary pull-right" href="{{ url('account/upskill/add') }}" style="border-radius: 50%;margin-top: -5px;">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <div class="col-md-12" style="margin-top:30px;margin-bottom:30px">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.title')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.category')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.address')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.createdon')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.action')</th>
                                </thead>
                                <tbody>
                                    @foreach($upskills as $skill)
                                        <tr id="upskill-{{ $skill->skillId }}">
                                            <td><a href="{{ url('learn/'.strtolower($skill->type).'/'.$skill->skillId ) }}">{!! $skill->title !!}</a></td>
                                            <td>@lang('home.'.$skill->type)</td>
                                            <td>{!! $skill->address !!}</td>
                                            <td>@if(app()->getLocale() == "kr")
						    {!! date('Y-m-d',strtotime($skill->createdTime)) !!}
						@else
						    {!! date('M d, Y',strtotime($skill->createdTime)) !!}
						@endif</td>
                                            <td>
                                                <a href="{{ url('account/upskill/edit/'.$skill->skillId) }}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                <a href="javascript:;" onclick="deleteUpskill('{{ $skill->skillId }}')"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3><span style="padding-left:15px;color:#fff;">@lang('home.promoteofferings')</span></h3>
                    <div class="upskill-box" style="padding-bottom:70px">
<style>
.job-schedule-box2{    
    text-align: center;
	border-radius: 5px;

}

.job-schedule-box2  a{
    display: inline-block;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding: 5px 10px;
    color: #ffffff;
    font-size: 12px;
    background-color: #333333;
    margin-right: 2px;
    margin-bottom: 10px;
	border-radius: 5px;
	
}
</style>
                        <p class="job-schedule-box2">
						
							<?php 
                        $cArr = array('#0e8bcc','#94a5a5','#8d846e','#4e6c7c','#919090','#b0a48a','#8d7e8d','#a69b82','#6b91a7','#9b9b36');
                        $i = 0;
                        foreach(JobCallMe::getUpkillsType() as $skill){ ?>
                            <a href="{{ url('learn/search?type='.strtolower($skill->name)) }}" style="background-color: {{ $cArr[$i] }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                /* width: 9.5%; */
                                padding: 5px 5px;
                                color: #ffffff;
                                font-size: 15px;
                                margin-bottom: 10px;
                                /* display: block; */
                                position: relative;
                                /* float: left; */
                                margin-right: 0.5%;
                                overflow: hidden;
                                text-decoration: none;">@lang('home.'.$skill->name)</a>
                        <?php $i++; } ?>

						</p>
                        <a href="{{ url('account/upskill/add') }}" class="btn btn-primary">@lang('home.advertisenow')</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
function deleteUpskill(skillId){
    if(confirm('@lang("home.Are you sure?")')){
        $.ajax({
            url: "{{ url('account/upskill/delete') }}/"+skillId,
            success: function(response){
                if($.trim(response) != '1'){
                    toastr.error(response, '', {timeOut: 5000, positionClass: "toast-top-center"});
                }else{
                    $('#upskill-'+skillId).remove();
                    toastr.success('@lang("home.Upskill Deleted")', '', {timeOut: 5000, positionClass: "toast-top-center"});
                }
            }
        })
    }
}
</script>
@endsection