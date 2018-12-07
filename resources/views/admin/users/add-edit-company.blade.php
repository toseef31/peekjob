@extends('admin.layouts.app')

@if($rPath == 'edit')
    @section('title', 'Update Company')
@else
    @section('title', 'Add Company')
@endif
@section('content')
<?php 
$companyLogo = '';
if($company['companyLogo'] != ''){
    $companyLogo = url('/compnay-logo/'.$company['companyLogo']);
}
$companyCover = '';
if($company['companyCover'] != ''){
    $companyCover = url('/compnay-logo/'.$company['companyCover']);
}
 ?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">{{ $rPath == 'edit' ? 'Update Company' : 'Add Company' }}</span>
                    <a class="btn btn-default pull-right" href="{{ url('admin/users/company') }}">Back</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal company-form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="companyId" value="{{ $companyId }}">
                                <input type="hidden" name="prevLogo" value="{{ $company['companyLogo'] }}">
                                <input type="hidden" name="prevCover" value="{{ $company['companyCover'] }}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        Required fields are marked *
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Name : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyName" required="" value="{{ $company['companyName'] != '' ? $company['companyName'] : old('companyName') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Email : *</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="companyEmail" required="" value="{{ $company['companyEmail'] != '' ? $company['companyEmail'] : old('companyEmail') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Phone Number : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyPhoneNumber" required="" value="{{ $company['companyPhoneNumber'] != '' ? $company['companyPhoneNumber'] : old('companyPhoneNumber') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Website : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyWebsite" required="" value="{{ $company['companyWebsite'] != '' ? $company['companyWebsite'] : old('companyWebsite') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Address : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyAddress" required="" value="{{ $company['companyAddress'] != '' ? $company['companyAddress'] : old('companyAddress') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Country : *</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2 job-country" name="companyCountry" required="">
                                            @foreach(JobCallMe::getJobCountries() as $cntry)
                                                <option value="{{ $cntry->id }}" {{ $company['companyCountry'] == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">State : *</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2 job-state" name="companyState" required="" data-state="{{ $company['companyState'] }}">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">City : *</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2 job-city" name="companyCity" required="" data-city="{{ $company['companyCity'] }}">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">No Of Employees : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyNoOfUsers" required="" value="{{ $company['companyNoOfUsers'] != '' ? $company['companyNoOfUsers'] : old('companyNoOfUsers') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Established Date : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control date-picker" name="companyEstablishDate" required="" value="{{ $company['companyEstablishDate'] != '' ? $company['companyEstablishDate'] : old('companyEstablishDate') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Company Logo : *</label>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-file">
                                            <input class="form-control p-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="companyLogo" class="file-upload-input" type="file" onchange="getFileName(this,'p-image')">
                                                    <span class="icon icon-image icon-lg"></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                            <img src="{{ $companyLogo }}" alt="{{ $company['companyName'] }}" style="max-width: 200px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Cover Photo : *</label>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-file">
                                            <input class="form-control t-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="companyCover" class="file-upload-input" type="file" onchange="getFileName(this,'t-image')">
                                                    <span class="icon icon-image icon-lg"></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                            <img src="{{ $companyCover }}" alt="{{ $company['companyName'] }}" style="max-width: 200px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">About Company : *</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="companyAbout" style="resize: vertical;" required="">{{ $company['companyAbout'] != '' ? $company['companyAbout'] : old('companyAbout') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Facebook :</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyFb" value="{{ $company['companyFb'] != '' ? $company['companyFb'] : old('companyFb') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Twitter :</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyTwitter" value="{{ $company['companyTwitter'] != '' ? $company['companyTwitter'] : old('companyTwitter') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Linkedin :</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyLinkedin" value="{{ $company['companyLinkedin'] != '' ? $company['companyLinkedin'] : old('companyLinkedin') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">Status :</label>
                                    <div class="col-md-6">
                                        <label class="custom-control custom-control-primary custom-radio">
                                            <input name="companyStatus" class="custom-control-input" type="radio" value="Active" {{ $company['companyStatus'] != 'Inactive' ? 'checked=""' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-label">Active</span>
                                        </label>
                                        <label class="custom-control custom-control-primary custom-radio">
                                            <input name="companyStatus" class="custom-control-input" type="radio" value="Inactive" {{ $company['companyStatus'] == 'Inactive' ? 'checked=""' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-label">Inactive</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-primary do-save" type="submit" name="save">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();
    $('.date-picker').datepicker({format:'yyyy-mm-dd'});
    getStates($('.job-country option:selected:selected').val());
})
function getFileName(obj,aClass){
    var vValue = $(obj).val();
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.'+aClass).val(vValue);
}
$('form.company-form').submit(function(e){
    $('.company-form .do-save').prop('disabled',true);
    $('.company-form .do-save').addClass('spinner spinner-default');
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
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
</script>
@endsection