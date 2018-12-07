		@extends('frontend.layouts.app')

		@section('title', 'Career Tab')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
				 <section class="resume-box" id="academic">
                        <a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-plus"></i> </a>
                        <h4> @lang('home.users')</h4>
                        <?php //print_r($resume); ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('home.Name')</th>
                                    <th>@lang('home.Email')</th>
                                    <th>@lang('home.Created Date')</th>
                                    <th>@lang('home.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $user)
                                <tr>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->createdTime}}</td>
                                    <td>
                                        <span>
                                            <a href="#" title="@lang('home.Edit')" onclick="edituser('{{$user->email}}')">
                                                <i class="fa fa-pencil"></i>
                                            </a>&nbsp;
                                            <a href="javascript:;" title="@lang('home.Delete')" onclick="deleteuser('{{$user->userId}}')">
                                                <i class="fa fa-trash"></i>
                                            </a>&nbsp;
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                       
                    </section>
                    <section class="resume-box" id="academic-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.users')</c></h4>
                        <form class="form-horizontal form-academic" method="post" action="">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                         
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.email')</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control input-sm" name="degree">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
    								<p style="font-size: 11px;color: red;display:none;" id="msg">
        								<span>@lang('home.The user you are trying to add must have a JobCallMe id. Logout and create a new id.')  </span><br>
        								<span>@lang('home.Logout and create a new id.')</span>
                                    </p>
								</div>
							</div>
								
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" id="sub" type="button" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">@lang('home.Cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Academic Section End-->

				</div>
		
		
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
<script type="text/javascript">
function edituser(email){
    
    $('#email').val(email);
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
function deleteuser(id){
   $.ajax({
        url:"{{ url('account/employer/userdel')}}",
        data:{userId:id,_token:token},
        type:"post",
        success:function(res){
            if(res == 1){
                window.location.href="{{url('account/employer/users')}}";
            }else{
                console.log(res);
            }
        }
    });
}
function addAcademic(){
    $('.form-academic input:not(input[name="_token"])').val('');
    $('#academic-edit h4 c').text('@lang("home.users")');
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
$('#sub').on('click',function(){
    var email = $('#email').val();
    var token = $("input[name='_token']").val();
    $.ajax({
        url:"{{ url('account/employer/useradd')}}",
        data:{degree:email,_token:token},
        type:"post",
        success:function(res){
            if(res == 'error'){
                $('#msg').css('display','block');
            }else{
                $('#msg').css('display','none');
                window.location.href="{{url('account/employer/users')}}";
            }
        }
    });
})
/*$('form.form-academic').submit(function(e){
    $('.form-academic input[name="_token"]').val(pageToken);
    $('.form-academic button[name="save"]').prop('disabled',true);
    $('.form-academic .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-academic').serialize(),
        url: "{{ url('account/jobseeker/resume/academic/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-academic .error-group').show();
                $('.form-academic .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
                $('.form-academic button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-academic .error-group').show();
            $('.form-academic .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-academic button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getAcademic(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-academic input[name="resumeId"]').val(resumeId);
            $('.form-academic select[name="degreeLevel"]').val(obj.degreeLevel).trigger('change');
            $('.form-academic input[name="degree"]').val(obj.degree);
            $('.form-academic input[name="completionDate"]').val(obj.completionDate);
            $('.form-academic input[name="grade"]').val(obj.grade);
            $('.form-academic input[name="institution"]').val(obj.institution);
            $('.form-academic select[name="country"]').val(obj.country).trigger('change');
			$('.form-academic select[name="state"]').val(obj.state).trigger('change');
			$('.form-academic select[name="city"]').val(obj.city).trigger('change');
            $('.form-academic textarea[name="details"]').val(obj.details);
            $('#academic-edit h4 c').text('Edit Academics');
            $('#academic').hide();
            $('#academic-edit').fadeIn();
        }
    })
}
function deleteElement(resumeId){
    if(confirm('Are you sure to delete this?')){
        $.ajax({
            url: "{{ url('account/jobseeker/resume/delete') }}/"+resumeId,
            success: function(response){
                $('#resume-'+resumeId).remove();
            }
        })
    }
}*/
		</script>
		@endsection