@extends('frontend.layouts.app')

@section('title',"Welcome $user_name")

@section('content')
<?php
$delivered = 'ja-tab-active';
if(Request::input('show') != ''){
    $showTab = Request::input('show');
    $$showTab = 'ja-tab-active';
    $delivered = '';
}
?>
<section id="jobsApplications">
    <div class="container">

        <div class="follow-companies6" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
            <h3 style="margin-left: 15px">@lang('home.APPLICATION_title')</h3>
        </div>
        <!-- Mobile View Only -->
        <div class="col-md-2 jobApp-tabs hidden-sm hidden-md hidden-lg">
            <ul class="nav nav-tabs">
                <li>
                    <a id="delivered" class="mblTabBtn {{ $delivered }}" data-toggle="tab" href="#delivered" role="tab" aria-controls="delivered">@lang('home.delivered')</a>
                </li>
                <li>
                    <a id="shortlist" class=" mblTabBtn {{ $shortlist }}" data-toggle="tab" href="#shortlist" role="tab" aria-controls="shortlist">@lang('home.shortlisted')</a>
                </li>
                <li>
                    <a id="interview" class="mblTabBtn {{ $interview }}" data-toggle="tab" href="#interview" role="tab" aria-controls="interview">@lang('home.interviews')</a>
                </li>
                <li>
                    <a id="offer" class="mblTabBtn {{ $offer }}" data-toggle="tab" href="#offer" role="tab" aria-controls="offer">@lang('home.offered')</a>
                </li>
                <li>
                    <a id="reject" class="mblTabBtn {{ $reject }}" data-toggle="tab" href="#reject" role="tab" aria-controls="reject">@lang('home.unsuccessful')</a>
                </li>
            </ul>
            <!-- <a id="delivered" class="btn btn-block jaTabBtn {{ $delivered }}">@lang('home.delivered')</a>
            <a id="shortlist" class="btn btn-block jaTabBtn {{ $shortlist }}">@lang('home.shortlisted')</a>
            <a id="interview" class="btn btn-block jaTabBtn {{ $interview }}">@lang('home.interviews')</a>
            <a id="offer" class="btn btn-block jaTabBtn {{ $offer }}">@lang('home.offered')</a>
            <a id="reject" class="btn btn-block jaTabBtn {{ $reject }}">@lang('home.unsuccessful')</a> -->
         </div>
        <!-- End Mobile View -->
        <div class="col-md-2 jobApp-tabs hidden-xs">
            <a id="delivered" class="btn btn-block jaTabBtn {{ $delivered }}">@lang('home.delivered')</a>
            <a id="shortlist" class="btn btn-block jaTabBtn {{ $shortlist }}">@lang('home.shortlisted')</a>
            <a id="interview" class="btn btn-block jaTabBtn {{ $interview }}">@lang('home.interviews')</a>
            <a id="offer" class="btn btn-block jaTabBtn {{ $offer }}">@lang('home.offered')</a>
            <a id="reject" class="btn btn-block jaTabBtn {{ $reject }}">@lang('home.unsuccessful')</a>
            <a id="offer" href="{{url('jobseeker/status/offer/all')}}" class="btn btn-block {{ $offer }}"> Offer Interview</a>
        </div>
        <div class="col-md-10">
            <div class="tab-content">
                <div class="ja-content">
                    <!--Application-->
                    <div id="application-show" class="ja-content-item"></div>
                    <!--Application End-->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.input-error{color: red;}
</style>
<script type="text/javascript">
var token = "{{ csrf_token() }}";
$(document).ready(function(){
    $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
    var firstSelect = $('.jaTabBtn.ja-tab-active');
    $(firstSelect).removeClass('ja-tab-active');
    $(firstSelect).click();
})
    $('.jaTabBtn').click(function () {
        if($(this).hasClass('nav-tab-active')){
            return false;
        }
        $(this).addClass('ja-tab-active').siblings().removeClass('ja-tab-active');
        var type = $(this).attr('id');
        $.ajax({
            url: "{{ url('account/jobseeker/application') }}/"+type,
            success: function(response){
                console.log(response);
                $('#application-show').html(response);
            }
        })
    });
    // Mobile  Tab 
    // End 
    $('.jaTabBtn').click(function () {
        if($(this).hasClass('ja-tab-active')){
            return false;
        }
        $(this).addClass('ja-tab-active').siblings().removeClass('ja-tab-active');
        var type = $(this).attr('id');
        $.ajax({
            url: "{{ url('account/jobseeker/application') }}/"+type,
            success: function(response){
                $('#application-show').html(response);
            }
        })
    });
    function removeApplication(applyId){
        if(confirm('Are you sure?')){
            $.ajax({
                url: "{{ url('account/jobseeker/application/remove') }}/"+applyId,
                success: function(response){
                    $('#apply-'+applyId).remove();
                }
            })
        }
    }
</script>
@endsection