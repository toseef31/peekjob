@extends('frontend.layouts.app')

@section('title', 'Writing')
<?php
$gCountry = Session()->get('jcmUser')->country;
?>
@section('content')
<section id="postNewJob">
    <div class="container">

            <div class="pnj-box row">

                <form id="pnj-form" action="" method="post" class="writing-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="prevIcon" value="{{ $article->wIcon }}">
                    <input type="hidden" name="writingId" value="{{ $article->writingId }}">
                    <h3>@lang('home.warticle')</h3>
                    @if($article->writingId)

                    @else
                     <div>
                    <span style="padding-left:50px">@lang('home.selectcurrency'): &nbsp;</span>
                      <input type="radio" name="gender" id="wr_kr" value="kr" checked="checked"> @lang('home.paykorean')
                      &nbsp;&nbsp;<input type="radio" name="gender" id="wr_us" value="us"> @lang('home.US$')
                      </div>
                    <div class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;margin-left:20px;">
                     <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid">
                        <ul id="post-job-ad-types-read" class="please">


							<li style="position:relative;background-image:url('/frontend-assets/images/read-1.png');" class="text-center">
								<!-- <spans style="color:#fff;padding-left:10px;padding-top:7px;">&nbsp;<input class="mat-radio-input cdk-visually-hidden" type="radio" id="basicplan" name="cat_id" value="0" >@lang('home.FreetillEndofOctober')</span>
                               <div class="mat-radio-label-content" style="padding-top:5px;"><span style="display:none;">&nbsp;</span>
                               <span class="b" style="color:#fff;font-size: 17px;">@lang('home.Basic')</span></div>

							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span></div> -->

							   
						

							   <span class="pay_skill text-left">
							   <div style="padding-left:10px;padding-top:0px;">
                               <input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="cat_id" value="{!! $payment->cat_id!!}" style="padding-top:15px;">
							   <input class="mat-radio-input cdk-visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
							   </div></span>
							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span></div>
                                <div>
                                    <!----><label for="{!! $payment->id!!}">
                                        <!-- <ul class="list-unstyled desc" >
                                            <li>@lang('home.Featuredonhomepage') --><!-- {!! $payment->tag1!!} --><!-- </li>
                                            <li>@lang('home.adcost') --><!-- {!! $payment->tag2!!} --><!-- </li>
                                        </ul> -->
										<div class="text-left" style="font-size: 13px;color:#000;padding-left:7px;margin-top:0px;"><strike><span style="color:#000;font-size:17px;margin-top:20px;" id="wr_text{{number_format($key)}}"></span></strike>&nbsp;<span style="color:#000;font-size: 11px;">/1 @lang('home.days')</span></div>

										<div style="font-size: 13px;color:#fff;padding-left:90px;margin-top:-20px;"><span style="color:#fff;padding-left:28px;">@lang('home.Free')</span></div>

									<div class="col-md-12">
										<div style="font-size: 11px;padding-top:15px;margin-right:-9px;color:#000;float:right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('home.FreetillEndofOctober')</div>
									</div>
                                        <div style="color:#000;font-size: 11px;padding-top:5px;padding-left:110px;">
										@lang('home.read-pay-text')</div>									
									
									
                                    </label>
                                    
                                </div>

                            </li>

                            
							
							



<!-- 
                         @foreach($wrpayment as $key=>$payment)
							
								@if($payment->tag1 == "Basic")
                            <li style="position:relative;background:#3a79d2;">
								@endif
								@if($payment->tag1 == "Golden")
                            <li style="position:relative;background:#b0a48a;">
								@endif
								@if($payment->tag1 == "Special")
                            <li style="position:relative;background:#4e6c7c;">
								@endif
								@if($payment->tag1 == "Latest")
                            <li style="position:relative;background:#94a5a5;">
								@endif
								@if($payment->tag1 == "Hot")
                            <li style="position:relative;background:#717171;">
								@endif
								@if($payment->tag1 == "Top Job")
                            <li style="position:relative;background:#a8b3b9;">
								@endif
								@if($payment->tag1 == "Premium")
                            <li style="position:relative;background:#a09d8e;">
								@endif
                            
                            <span class="wr">
                               <input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="cat_id" value="{!! $payment->id!!}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('home.'.$payment->title)
                               <input class="mat-radio-input cdk-visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}"></span>
                               <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                             <span class="b" style="color:#fff;font-size: 17px;">@lang('home.'.$payment->tag1)</span></div>
                                <div>
                                    <label for="{!! $payment->id!!}">
                                        <ul class="list-unstyled desc" >
                                            <li>@lang('home.'.$payment->tag2) ( {!! $payment->days!!}  @lang('home.day') )</li>
                                            <li>@lang('home.'.$payment->tag3)</li>
                                        </ul>
                                        
                                        <div class="credits b" style="color:#fff;font-size: 15px;">
                                        <span style="color:#fff;" class="text-success" id="wr_text{{$key}}"></span>
                                    <i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i>
                                    </div>
                                    </label>
                                   
                                </div>
                            </li>
                           
                            @endforeach
 -->
                        </ul>
                 

                    
                </div>
            </div>
@endif
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title" placeholder="@lang('home.title')" required="" value="{{ $article->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.tags')</label>
                            <div class="col-sm-9 pnj-form-field">
                               <select class="form-control" id="readcat" multiple name="category[]" required="">
                                    <option value="">@lang('home.s_type')</option>
                                    @foreach(JobCallMe::getReadCategories() as $cat)
                                        <option value="{{ $cat->id }}">@lang('home.'.$cat->name)</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor">{{ $article->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.citation')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="citation" class="form-control" placeholder="@lang('home.citation')" required="" rows="6">{{ $article->citation }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="file" name="articleImage" class="form-control">
                            </div>
                        </div>
                        @if($article->wIcon != '')
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                    <img src="{{ url('article-images/'.$article->wIcon) }}" alt="" style="max-width: 200px;">
                                </span>
                            </div>
                        </div>
                        @endif
                        @if($article->writingId)
                         <div class="form-group" id="palndate">
                           
                            <div class="col-sm-9 pnj-form-field">
                                <input type="hidden" class="form-control date-picker" id="wrDate" name="endDate" onkeypress="return false;" value="{{ $article->endDate }}">
                            </div>
                        </div>
                        <div class="form-group" id="wrplan">
                           
                            <div class="col-sm-9 pnj-form-field">
                             
                               <input type="hidden" class="form-control" id="" name="amount" value="{{ $article->amount }}" >
                                
                            </div>
                        </div>

                        @else
                          <div class="form-group" id="palndate">
                            <label class="control-label col-sm-3">@lang('home.edate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="wrDate" name="endDate" onkeypress="return false;" value="{{ $article->endDate }}">
                            </div>
                        </div>
                        <div class="form-group" id="wrplan">
                            <label class="control-label col-sm-3">@lang('home.adduration')</label>
                            <div class="col-sm-9 pnj-form-field">
                               <input type="text" class="form-control" id="wrpas"  disabled value="{{ $article->amount }}">
                               <input type="hidden" class="form-control" id="wrpass" name="duration"  >
                                
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.country')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ $gCountry == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.state')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" data-state="{{ $gState }}" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" data-city="{{ $gCity }}" required>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-offset-2 col-md-3  pnj-btns">
                        <span style="font-size:17px;padding-right:50px;"  id="wrtotal"></span>                      
                    </div>

                    <div class="col-md-6  pnj-btns">
                        <button type="submit" class="btn btn-primary" name="publis" onclick="saveOption('p')">@lang('home.publish')</button>
                        <button type="submit" class="btn btn-default" name="draft" onclick="saveOption('d')">@lang('home.draft')</button>
                        <button class="btn btn-default"><a href="{{ url('account/writings') }}">@lang('home.cancel')</a></button>
                    </div>
                </form>
            </div>
        <!-- </div> -->
    </div>
</section>

@endsection
@section('page-footer')
<style type="text/css">
input[type="file"] {
    padding: 0;
}
.text-danger{color: #ff0000 !important;}
</style>
<script type="text/javascript">
 function number_format(data) 
{
    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
    var data = String(data);
    len = data.length;
 
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++) 
    {
        number = number + data.charAt(i);
        
        if (i < data.length - 1) 
        {
            k++;
            if ((k % cutlen) == 0) 
            {
                number = number + comma;
                k = 0;
            }
        }
    }
 
    return number;
}


var alrt ='';
$(document).ready(function(){
      $('.please li').first().find('.mat-radio-input').bind('click',function(e){
       $('#wrplan').hide();
        $('#palndate').hide();
        $('#wrtotal').hide();
    })

     $('.please li').first().find('.mat-radio-input').trigger('click');
 
    $('#readcat').select2();
    
    $('body').on('click','.wr',function(e){
        console.log($(e.target).val());
     alrt=$(e.target).siblings('input').val();
     console.log(alrt);
     $('#wrplan').show();
     $('#palndate').show();
     $('#wrtotal').show();
        
    })
  
});

 ////// FOR Simle/////////
     var simplearray = <?php echo json_encode($wrpayment); ?>;

     for(var i=0;i<simplearray.length;i++){
     $('#wr_text'+i).html('￦ '+number_format(simplearray[i].price*1100)+'')
        //alert(jArray[i].amount);
       }
     
    $('#wr_us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){

     $('#wr_text'+i).html('US$ '+simplearray[i].price+'.00')
        //alert(jArray[i].amount);
         }
        }
    }) ;

    $('#wr_kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){
     $('#wr_text'+i).html('￦ '+number_format(simplearray[i].price*1100) +'')
       // alert(jArray[i].amount*1100);
      }
    }
}) ;
    
    ////// FOR PLAN//////////

    $('#wrDate').on('change', function() {
          myfunc()
});
      var total="";
       function myfunc(){
       var start = new Date();
      // var start= $("#firstDate").datepicker("getDate");
        var end= $("#wrDate").datetimepicker("getDate");
        days = (end- start) / (1000 * 60 * 60 * 24);
      var to= Math.round(days);
       total= to * alrt;
      $('#wrpas').val(to);
      $('#wrpass').val(to);
      if ($('#wr_kr').is(':checked')) {
	  $('#wrtotal').html("Total Amount : "+total*1100+" ₩" );
     // alert('kr');
    }

     if ($('#wr_us').is(':checked')) {
	  $('#wrtotal').html("Total Amount : "+total+" $" );
      //alert('us');
    }
      
      
      //alert(total);
       
       }
tinymce.init({
    selector: '.tex-editor',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    },
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
var isARunning = false;
var svOption = 'Publish';
function saveOption(op){
    if(op == 'd'){
        svOption = 'Draft';
    }else{
        svOption = 'Publish';
    }
}
$('form.writing-form').submit(function(e){
    if(isARunning == true){
        return false;
    }
    isARunning = true;
    var formData = new FormData($(this)[0]);
    $('.writing-form .text-danger').remove();
    $('.writing-form button[type="submit"]').prop('disabled',true);
    $.ajax({
        url: window.location.href+'?option='+svOption,
        type: 'POST',
        data: formData,
        async: false,
        success: function(response) {
            console.log(response);
            isARunning = false;
           if($.trim(response) != '1'){
              toastr.success('Article successfully saved', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
              window.location.href = "{{ url('account/writings') }}";
           // window.location.href = "{{ url('writingpayment') }}";
            $('.writing-form button[type="submit"]').prop('disabled',false);
           }
           else{
          toastr.success('Article successfully saved', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
           // window.location.href = "{{ url('account/writings') }}";
            window.location.href = "{{ url('writingpayment') }}";
            $('.writing-form button[type="submit"]').prop('disabled',false);
           }
           
        },
        error: function(data){
            isARunning = false;
            var errors = data.responseJSON;
            var j = 1;
            var vError = '';
            $.each(errors, function(i,k){
                var vParent = $('.writing-form input[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');

                var vParent = $('.writing-form select[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                
                var vParent = $('.writing-form textarea[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                if(j == 1){
                    vError = k;
                }
                j++;
            });
            toastr.error(vError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            $('.writing-form button[type="submit"]').prop('disabled',false);
        },
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
})
</script>
@endsection