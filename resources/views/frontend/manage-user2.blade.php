@extends('frontend.layouts.app')

@section('title', 'Manage')

@section('content')
<?php
$userImage = url('profile-photos/profile-logo.jpg');
if($user->profilePhoto != ''){
    $userImage = url('profile-photos/'.$user->profilePhoto);
}
?>
<section id="jobs">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 jobApp-tabs">
                        <a id="password" class="btn btn-block jaTabBtn ja-tab-active"> Change Password</a>
                        <a id="profile" class="btn btn-block jaTabBtn"> Edit Profile</a>
                        <a class="btn btn-block" href="{{ url('account/employer/interview-venues/') }}">Interview Venues</a>
                        <a class="btn btn-block" href="{{ url('account/employer/organization') }}">Edit Organization</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="jobs-suggestions password">
                    <form class="form-horizontal password-form" method="post" action="">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Old Password</label>
                            <div class="col-md-6">
                                <input type="password" name="oldPassword" class="form-control input-sm" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">New Password</label>
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control input-sm" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" name="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">&nbsp;</label>
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-block" type="submit" name="save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="jobs-suggestions profile" style="display: none;">
                    <form class="form-horizontal profile-form" method="post" action="">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                             <label class="control-label col-md-3 text-right">Profile Photo</label>
                            <div class="col-md-6">
                                <div class="re-img-box">
                                    <img src="{{ $userImage }}" class="img-circle">
                                    <div class="re-img-toolkit">
                                        <div class="mc-file-btn">
                                             <i class="fa fa-camera"></i> Change
                                            <input class="upload profile-pic" name="image" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Name</label>
                            <div class="col-md-6">
                                <div class="col-md-6 f-name" style="margin-bottom: 5px;padding-left: 0px;">
                                    <input type="text" class="form-control input-sm" name="firstName" value="{{ $user->firstName }}">
                                </div>
                                <div class="col-md-6 l-name" style="margin-bottom: 5px;padding-right: 0px;">
                                    <input type="text" class="form-control input-sm" name="lastName" value="{{ $user->lastName }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Email</label>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control input-sm" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Phone Number</label>
                            <div class="col-md-6">
                                <input type="text" name="phoneNumber" class="form-control input-sm" value="{{ $user->phoneNumber }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Address</label>
                            <div class="col-md-6">
                                <textarea name="address" class="form-control input-sm">{{ $meta->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">Country</label>
                            <div class="col-md-6">
                                <select class="form-control input-sm select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->name }}" country-id="{{ $cntry->countryId }}" {{ $user->country == $cntry->name ? 'selected="selected"' : ''}}>{{ ucfirst($cntry->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">City</label>
                            <div class="col-md-6">
                                <select class="form-control input-sm select2 job-city" name="city" data-city="{{ $user->city }}"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">&nbsp;</label>
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-block" type="submit" name="save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.jobApp-tabs a{width: 100%;}
.ja-tab-active{background: none;}
.text-danger{color: #ff0000 !important;}
</style>
<script type="text/javascript">
var pageToken = '{{ csrf_token() }}';
$(document).ready(function(){
    getCities($('.job-country option:selected:selected').attr('country-id'));
})
$('.job-country').on('change',function(){
    var countryId = $('.job-country option[value="'+$(this).val()+'"]').attr('country-id');
    getCities(countryId)
})
function getCities(countryId){
    $.ajax({
        url: "{{ url('account/get-city') }}/"+countryId,
        success: function(response){
            var objk = $.parseJSON(response);
            var currentCity = $('.job-city').attr('data-city');
            $(".job-city").html('').trigger('change');
            $.each(objk,function(i,k){
                var vOption = k.subName == currentCity ? true : false;
                var newOption = new Option(firstCapital(k.subName), k.subName, true, vOption);
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
$('.profile-pic').on('change',function(){
    var formData = new FormData();
    formData.append('profilePicture', $(this)[0].files[0]);
    formData.append('_token', pageToken);

    $.ajax({
        url : "{{ url('account/jobseeker/profile/picture') }}",
        type : 'POST',
        data : formData,
        processData: false,
        contentType: false,
        timeout: 30000000,
        success : function(response) {
            if($.trim(response) != '1'){
                $('img.img-circle').attr('src',response);
            }else{
                toastr.error('Following format allowed (PNG/JPG/JPEG)', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    });
});
$('.jobApp-tabs a.jaTabBtn').click(function(){
    $('.btn.btn-block.jaTabBtn').removeClass('ja-tab-active');
    $(this).addClass('ja-tab-active');
    $('.jobs-suggestions').hide();
    $('.'+$(this).attr('id')).fadeIn();
    if($(this).attr('id') == 'password'){
        $('.password-form').find('.text-danger').remove();
        $('.password-form input').val('');
    }
})
$('form.password-form').submit(function(e){
    $('.password-form input[name="_token"]').val(pageToken);
    $('.password-form button[name="save"]').prop('disabled',true);
    $('.password-form').find('.text-danger').remove();
    $.ajax({
        type: 'post',
        data: $('.password-form').serialize(),
        url: "{{ url('account/password/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                var vParent = $('.password-form input[name="oldPassword"]').parent();
                vParent.append('<p class="text-danger">'+response+'</p>');
            }else{
                toastr.success('Password Updated', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
            $('.password-form button[name="save"]').prop('disabled',false);
        },
        error: function(data){
            var errors = data.responseJSON;
            $.each(errors, function(i,k){
                var vParent = $('.password-form input[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
            })
            $('.password-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
$('form.profile-form').submit(function(e){
    $('.profile-form button[name="save"]').prop('disabled',true);
    $('.profile-form input[name="_token"]').val(pageToken);
    $('.profile-form').find('.text-danger').remove();
    $.ajax({
        type: 'post',
        data: $('.profile-form').serialize(),
        url: "{{ url('account/profile/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                var vParent = $('.profile-form input[name="email"]').parent();
                vParent.append('<p class="text-danger">'+response+'</p>');
            }else{
                toastr.success('Profile Updated', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
            $('.profile-form button[name="save"]').prop('disabled',false);
        },
        error: function(data){
            var errors = data.responseJSON;
            $.each(errors, function(i,k){
                if(i == 'city'){
                    var vParent = $('.profile-form select[name="'+i+'"]').parent();
                }else{
                    var vParent = $('.profile-form input[name="'+i+'"]').parent();
                }
                vParent.append('<p class="text-danger">'+k+'</p>');
            })
            $('.profile-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
</script>
@endsection