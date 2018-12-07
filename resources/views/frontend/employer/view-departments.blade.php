@extends('frontend.layouts.app')

@section('title','Departments')

@section('content')

<section id="jobs">
    <div class="container">
     @if(Session::has('depAlert'))
                    <div class="alert alert-danger">
                        {{Session::get('depAlert')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
        <div class="col-md-12 view-department">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('home.departments')
                    <button class="btn btn-primary pull-right" style="margin-top: 10px;border-radius: 100%;" data-toggle="tooltip" data-original-title="@lang('home.addDepartment')" data-placement="bottom" onclick="addDepartment()">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>@lang('home.departments')</th>
                                <th>@lang('home.location')</th>
                                <th>@lang('home.action')</th>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr id="department-{{ $department->departmentId }}">
                                        <td>{!! $department->name !!}</td>
                                        <td>@lang('home.'.JobCallMe::cityName($department->city)), @lang('home.'.JobCallMe::stateName($department->state)), @lang('home.'.JobCallMe::countryName($department->country))</td>
                                        <td>
                                            <a href="javascript:;" onclick="editDepartment({{ $department->departmentId }})"  data-toggle="tooltip" data-original-title="@lang('home.Edit')">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="javascript:;" onclick="deleteDepartment({{ $department->departmentId }})"  data-toggle="tooltip" data-original-title="@lang('home.Delete')">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                     </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 add-edit-department" style="display: none">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">@lang('home.addDepartment')</span>
                    <button class="btn btn-warning pull-right" style="margin-top: 10px;border-radius: 100%;" data-toggle="tooltip" data-original-title="@lang('home.goback')" data-placement="bottom" onclick="goBack()">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal department-form">
                        <input type="hidden" name="_token" class="department-token">
                        <input type="hidden" name="departmentId" class="departmentId" value="0">
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.departmentname')<!-- @lang('home.name') --></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control input-sm" placeholder="@lang('home.departmentname')" name="name" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.country')</label>
                            <div class="col-md-6">
                                <select class="form-control input-sm select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}">@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.state')</label>
                            <div class="col-md-6">
                                <select class="form-control input-sm select2 job-state" name="state" data-state="" required=""></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.city')</label>
                            <div class="col-md-6">
                                <select class="form-control input-sm select2 job-city" name="city" data-city="" required=""></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">@lang('home.description')</label>
                            <div class="col-md-6">
                                <textarea class="form-control input-sm" name="description" style="resize: vertical;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 text-right">&nbsp;</label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                <button class="btn btn-default" onclick="goBack()" type="button">@lang('home.cancel')</button>
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
.input-error{color: red;}
</style>
<script type="text/javascript">
var token = "{{ csrf_token() }}";
$(document).ready(function(){
    $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
    getStates($('.job-country option:selected:selected').val());
})
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    if(countryId == 0){
        var newOption = new Option('Select State', '', true, false);
        $(".job-state").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            var obj = $.parseJSON(response);
            $(".job-state").html('');
            var newOption = new Option('Select State', '', true, false);
            $(".job-state").append(newOption);
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
    if(stateId == 0){
        var newOption = new Option('Select City', '', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '', true, false);
            $(".job-city").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })
        }
    })
}
function addDepartment(){
    $('.add-edit-department .panel-title').text('@lang("home.addDepartment")');
    $('.department-form input,.department-form textarea').val('');
    $('.view-department').hide();
    $('.add-edit-department').fadeIn();
    $('.department-form .departmentId').val('0');
}
function goBack(){
    $('.view-department').fadeIn();
    $('.add-edit-department').hide();
}

function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
$('form.department-form').submit(function(e){
    $('.department-form .department-token').val(token);
    $('.department-form button[name="save"]').prop('disabled',true);
    $('.department-form .input-error').remove();
    $.ajax({
        type: 'post',
        data: $('.department-form').serialize(),
        url: "{{ url('account/employer/department/save') }}",
        success: function(response){
            toastr.success('Action perform successfully', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            window.location.href = "{{ url('account/employer/departments') }}";
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            firstError = '';
            var z = 1;
            $.each(errors, function(i,k){
                if(z == 1){
                    firstError = k;
                }
                z++;
                $('.department-form input[name="'+i+'"]').parent().append('<p class="input-error">'+k+'</p>');
                $('.department-form textarea[name="'+i+'"]').parent().append('<p class="input-error">'+k+'</p>');
                $('.department-form select[name="'+i+'"]').parent().append('<p class="input-error">'+k+'</p>');
            })
            $('.department-form button[name="save"]').prop('disabled',false);
            Pace.stop;
            toastr.error(firstError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
        }
    })
    e.preventDefault();
})
function editDepartment(departmentId){
    $.ajax({
        url: "{{ url('account/employer/department/get') }}/"+departmentId,
        success: function(response){
            var obj = $.parseJSON(response);

            $('.add-edit-department .panel-title').text('@lang("home.Edit Department")');
            $('.department-form .departmentId').val(departmentId);
            $('.department-form input[name="name"]').val(obj.name);
            $('.department-form select[name="city"]').attr('data-city',obj.city);
            $('.department-form select[name="state"]').attr('data-state',obj.state);
            $('.department-form select[name="country"]').val(obj.country).trigger('change');
            $('.department-form textarea[name="description"]').val(obj.description);

            $('.view-department').hide();
            $('.add-edit-department').fadeIn();
        }
    })
}
function deleteDepartment(departmentId){
    if(confirm('@lang("home.Are you sure to delete this?")')){
        $.ajax({
            url: "{{ url('account/employer/department/delete') }}/"+departmentId,
            success: function(response){
                $('#department-'+departmentId).remove();
                toastr.success('@lang("home.Department Deleted")', '', {timeOut: 3000, positionClass: "toast-bottom-center"});
            }
        })
    }
}
</script>
@endsection