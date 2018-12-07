@extends('frontend.layouts.app')

@section('title','Payment Method')

@section('content')

<section style="margin-bottom: 123px;padding-top: 180px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align:center">@lang('home.selectpaymentmethod')</h3>
                <br>
                <br>
                <div class="col-md-4">
                </div>
                <div class="col-md-6" style="display:-webkit-box">
                <div style="padding-left: 22px;padding-right: 13px;">
                 
                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.packagepaypal') !!}" >
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-lg" name="save">@lang('home.PayPal')</button> 
                            </form>
                   
                </div>
                  <div class="" style="padding-left: 22px;padding-right: 13px;" >
                   
                        <form class="form-horizontal" method="POST" id="" role="form" action="{{ action('frontend\Employer@cashpackage') }}" >
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-warning btn-lg" name="save">@lang('home.Cash Payment')</button> 
                        </form>
                   
                </div>
                <div class="" style="padding-left: 22px;padding-right: 13px;">
            
                    <form action="{{url('nicepay/payRequest_utf.php')}}" method="post" id='nicepckg'> 
                        <input type="hidden" value="{!! $amount !!}" name="price" >
                        <input type="hidden" value="1" name="goodscount" >
                        <input type="hidden" value="jobcallme" name="goodsName" >
                        <input type="hidden" value="{!! $app->email !!}" name="Email" >
                        <input type="hidden" value="{!! $app->phoneNumber!!}" name="tel" >
                        <input type="hidden" value="0" name="buyerName" id='buyer' >
                     
                        <a href='javascript:void(0)'  class="btn btn-info btn-lg nicePay">@lang('home.NicePay')</a>
                    </form>
                </div>
                </div>
            </div>
        </div>
	</div>
</section>
<style type="text/css">
.jd-share-btn a > i {
    border-radius: 50%;
    color: #ffffff;
    font-size: 30px;
    height: 50px;
    margin-right: 2px;
    padding-top: 10px;
    text-align: center;
    width: 50px;
}
</style>
@endsection
@section('page-footer')
<script type="text/javascript">

$(document).on('click','.nicePay',function(){
    $(this).attr('disabled',true); 
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: "<?=url('account/pckgnicepay')?>",
        data:{'type':1}, /*make a job post*/
        success: function(result){  
            $("#buyer").val(result);
            $("#nicepckg").submit();
        }
    });
});

$(document).ready(function(){
    getCities($('.job-country option:selected:selected').val());
    getSubCategories($('.job-category option:selected:selected').val());
})
tinymce.init({
    selector: '.tex-editor',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
function getCities(country){
    var countryId = $('.job-country option[value="'+country+'"]').attr('country-id');
    $.ajax({
        url: "{{ url('account/get-city') }}/"+countryId,
        success: function(response){
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            $.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(firstCapital(k.subName), k.subName, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })
        }
    })
}
function getSubCategories(categoryId){
    $.ajax({
        url: "{{ url('account/get-subCategory') }}/"+categoryId,
        success: function(response){
            var obj = $.parseJSON(response);
            $(".job-sub-category").html('').trigger('change');
            $.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId, true, vOption);
                $(".job-sub-category").append(newOption).trigger('change');
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
var formPost = 1;
$('form.job-form').submit(function(e){
    if(formPost == 1){
        formPost++;
        $('.job-form').serialize();
        //$('.job-form button[name="save"]').submit();
        return false;
    }
    $('.job-form button[name="save"]').attr('disabled',true);
    $('.job-form .error-group').hide();
    formPost = 1;
    $.ajax({
        type: 'post',
        data: $('.job-form').serialize(),
        url: "{{ url('account/employer/job/save') }}",
        success: function(response){
            toastr.success('Job Successfully Posted', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            window.location.href = "{{ url('account/employer/job/share') }}/"+response;
            $('.job-form button[name="save"]').prop('disabled',false);
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<p>'+k+'</p>';
            })
            $('.job-form .error-group').show();
            $('.job-form .error-group .col-sm-9 .alert-danger').html(vErrors);
            $('.job-form button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('.job-form').position().top}, 1000);
        }
    })
    e.preventDefault();
})
</script>
@endsection