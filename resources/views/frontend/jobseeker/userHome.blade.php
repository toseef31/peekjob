@extends('frontend.layouts.app')

@section('title','Job Seeker')

@section('inner-header')
<!-- @include('frontend.includes.jobseeker-nav') -->
@endsection

@section('content')
<?php
$app = Session::get('jcmUser');
$userImage = url('profile-photos/profile-logo.jpg');
if($user->profilePhoto != ''){

    $pos = strpos($user->profilePhoto,"ttp");
    if($pos == 1)
    {
        $userImage = url($user->profilePhoto);
    } 
    else{
        $userImage = url('profile-photos/'.$user->profilePhoto);
        }
    }
    
?>

<div id="app">
<router-view :showdata="{{$app->userId}}" :userimg="'{{$userImage}}'"  :showimg="'{{$app->profilePhoto}}'" :userinfo="'{{$user->firstName}}'"></router-view>
    
   
    </div>
    @endsection
    @section('page-footer')
<script type="text/javascript">
  $(document).ready(function(){

    var url = window.location.href;
    // alert(url);
    var id = url.substring(url.lastIndexOf('?') + 1);
    //alert(id);
    if(id=='saveJob'){
        $('#rtj_tab_saved').addClass( "li.active" );
        $('#rtj_tab_suggested').removeClass( "li.active" );
        // $('#notification-show').show();
        // $('#password-show').hide();
    }
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
            $(obj).html('<i class="fa fa-heart"></i>');
          }else{
            $(obj).removeClass('btn-success');
            $(obj).addClass('btn-default');
            $(obj).html('<i class="fa fa-heart"></i>');
          }
        }
      }
    })
  }
  function appendtoken(){
    $('#fpi_content form input[type="hidden"]').remove();
    $('#fpi_content form').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
  };
  function removeJob(jobId){
    var type = 'remove';
    $('#saved-'+jobId).remove();
    $.ajax({ url: "{{ url('account/jobseeker/job/action') }}?jobId="+jobId+"&type="+type });
  }
  function followCompany(companyId,obj){
    if($(obj).hasClass('btn-primary')){
      var type = 'follow';
    }else{
      var type = 'remove';
    }
    if($(obj).hasClass('btn-primary')){
      $(obj).removeClass('btn-primary');
      $(obj).addClass('btn-success');
      $(obj).text('Following');
    }else{
      $(obj).removeClass('btn-success');
      $(obj).addClass('btn-primary');
      $(obj).text('Follow');
    }
    $.ajax({
      url: "{{ url('account/jobseeker/company/action') }}?companyId="+companyId+"&type="+type,
      success: function(response){
        if($.trim(response) == 'redirect'){
          window.location.href = "{{ url('account/login?next=companies/company/'.Request()->segment(3)) }}";
        }else if($.trim(response) == 'done'){
        }
      }
    })
  }
</script>
@endsection