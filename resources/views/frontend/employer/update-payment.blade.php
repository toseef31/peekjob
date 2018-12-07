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
                <div class="col-md-6" style="text-align:end">
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{{ action('frontend\Employer@updatepostPaymentWithpaypal') }}" >
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-lg" name="save">@lang('home.PayPal')</button> 
                    </form>
                </div>
                <div class="col-md-6">
            
                    <form action="{{url('nicepay/payRequest_utf.php')}}" method="post" id='nicePayForms'> 
                        <input type="hidden" value="{!! $am!!}" name="price" >
                        <input type="hidden" value="1" name="goodscount" >
                        <input type="hidden" value="jobcallme" name="goodsName" >
                        <input type="hidden" value="{!! $app->email!!}" name="Email" >
                        <input type="hidden" value="{!! $app->phoneNumber!!}" name="tel" >
                        <input type="hidden" value="0" name="buyerName" id='buyerName' >
                        <a href='javascript:void(0)'  class="btn btn-primary btn-lg nicePays">@lang('home.NicePay')</a>
                    </form>
                
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

$(document).on('click','.nicePays',function(){
    $(this).attr('disabled',true); 
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: "<?=url('account/nicepay')?>",
        success: function(result){  
            $("#buyerName").val(result);
            $("#nicePayForms").submit();
        }
    });
});

</script>
@endsection