@extends('frontend.layouts.app')

@section('title','Payment Method')

@section('content')

<section style="margin-bottom: 123px;padding-top: 180px;">
    <div class="container">
        <div class="row">
        <div class="col-md-3">
        </div>
            <div class="col-md-6">
                <div class="modal-content" style="border: 2px solid #c8a616;">
                    <div class="modal-header" style="background-color: #c8a616;border-bottom: 1px solid #c8a616;color: white;">
                   
                    <h4 class="modal-title">@lang('home.cashpayment')</h4>
                    </div>
                    <div class="modal-body">
                       <div class="pnj-form-section">
                       <form action="{{ action('frontend\Home@make_payment') }}" method="post">
                       {{ csrf_field() }}
                       <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.orderid')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control"placeholder="@lang('home.title')" value="{{ $order->order_id}}" disabled>
                                <input type="hidden" class="form-control" name="order_id" placeholder="@lang('home.title')" value="{{ $order->order_id}}" >
                             <input type="hidden" class="form-control" name="job_id" placeholder="@lang('home.title')" value="{{ $order->job_id}}" >
                             <input type="hidden" class="form-control" name="upskill_id" placeholder="@lang('home.title')" value="{{ $order->upskill_id}}" >
                              <input type="hidden" class="form-control" name="wr_id" placeholder="@lang('home.title')" value="{{ $order->wr_id}}" >
                                <input type="hidden" class="form-control" name="pckg_id" placeholder="@lang('home.title')" value="{{ $order->pckg_id}}" >
                              <input type="hidden" class="form-control" name="status" placeholder="@lang('home.title')" value="{{ $order->status}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.orderby')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="name" placeholder="@lang('home.title')" value="{{ $userinfo->firstName }}  {{ $userinfo->lastName }}" disabled>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.email')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="email" placeholder="@lang('home.title')" value="{{ $userinfo->email }}" disabled>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.cnic')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="" placeholder="@lang('home.title')" value="{{ $userinfo->phoneNumber }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.ordertitle')</label>
                           <div class="col-sm-9 pnj-form-field">
                            <input type="hidden" class="form-control"  name="order_title" placeholder="@lang('home.eamount')" value="{!! $order->orderBy !!}" >
                                <input type="text" class="form-control"  placeholder="@lang('home.eamount')" value="{!! $order->orderBy !!}" disabled>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.category')</label>
                           <div class="col-sm-9 pnj-form-field">
                            <input type="hidden" class="form-control"  name="category" placeholder="@lang('home.eamount')" value="{!! $order->category !!}" >
                                <input type="text" class="form-control"  placeholder="@lang('home.eamount')" value="{!! $order->category !!}" disabled>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.amount')</label>
                            <div class="col-sm-9 pnj-form-field">
                             <input type="text" class="form-control" placeholder="@lang('home.eamount')" value="{!! $order->amount !!} $" disabled>
                                <input type="hidden" class="form-control" name="amount"   placeholder="@lang('home.eamount')" value="{!! $order->amount !!}" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.bankname')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="bank_name" placeholder="@lang('home.ebankname')">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.branch')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="branch" placeholder="@lang('home.ebranch')">
                            </div>
                        </div>
                        <div class="col-sm-9 pnj-form-field">
                        <button class="btn btn-success" type="submit">@lang('home.Place Order')</button>
                        </div>
                        </div>
                         </form>
                        </div>
                  
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
        url: "<?=url('account/nicepay')?>",
        data:{'type':1}, /*make a job post*/
        success: function(result){  
            $("#buyerName").val(result);
            $("#nicePayForm").submit();
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