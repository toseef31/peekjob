		@extends('frontend.layouts.app')

		@section('title', 'Evaluation Forms')

		@section('content')
		<section id="company-box">

			<div class="container">
                <a href="{{ url('account/employer/addevaluation')}}" class="btn btn-primary pull-right">@lang('home.goback')</a>
			<div class="row">
				<div class="col-md-12">
				<section class="resume-box" id="academic">
                        <a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-edit" style="margin-top: 6px;"></i> </a>
                        <div>
                            <h4>{{$evaluation->title}}</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="col-md-12">
                                    <strong>@lang('home.title'):</strong> {{$evaluation->title}}
                                </div>
                                <div class="col-md-12">
                                    <strong>@lang('home.Created on'):</strong> <?
					  if(app()->getLocale() == "kr"){
					  ?>
						<?= date('Y-m-d',strtotime($evaluation->created_at))?>
					  <?}else{?>
						<?= date('M d,Y',strtotime($evaluation->created_at))?>
					  <?}?>	
                                </div>
                            </div>
                        </div>
                        
                </section>
                <section class="resume-box" id="academic-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.AddQuestionnaire')</c></h4>
                        <form method="post" action="{{ url('account/employer/form/save') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="evaluation_id" value="{{ $evaluation->evaluation_id }}">
                          <div class="form-group">
                            <label for="title">@lang('home.title'):</label>
                            <input type="text" name="title" value="{{$evaluation->title}}" class="form-control" id="title">
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 text-right">&nbsp;</label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">@lang('home.save')</button>
                                <button class="btn btn-default" type="button" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">@lang('home.Cancel')</button>
                            </div>
                          </div>
                        </form>
                </section>
                    <!--Academic Section End-->
                <!-- add question area start -->
                <section class="resume-box" id="question">
                        <a class="btn btn-primary r-add-btn" onclick="addquestion()"><i class="fa fa-plus"></i> </a>
                        <h4>@lang('home.Questions')</h4>
                        
                        <div>
                            <ol type='1' style="margin-left:30px;">
                             @foreach($eval_ques as $key => $question)
                                <li style="position:relative;margin-bottom: 5px;"><strong>{{ $question->evaluation_factor }}</strong>
                                <input type="hidden" value="{{$key}}" id="index">
                                <input type="hidden" value="{{$question->eva_ques_id}}" id="eva_ques_id">
                                    <ol type="1" style="margin-left:20px;">
                                        <li>@lang('home.Weight'): {{ $question->weight }}</li>
                                        <li>@lang('home.Critical'): {{ $question->is_critical }}</li>
                                    </ol>
                                    <span style="position:absolute;top:10px;right:10px;">
                                        <i class="fa fa-edit queseditbtn pointer"></i>
                                        <i class="fa fa-remove pointer quesdelid"></i>
                                    </span>
                                    
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        
                </section>
                <!-- edit question area start -->
                <section class="resume-box" id="aquestion-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.AddQuestionnaire')</c></h4>
                        <form method="post" action="{{ url('account/employer/evaluation/question/new') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="evaluation_id" value="{{ $evaluation->evaluation_id }}">
                        <input type="hidden" name="eva_ques_id" value="">
                          <div class="form-group">
                            <label for="title">@lang('home.Evaluation factor'):</label>
                            <input type="text" name="evaluation_factor" class="form-control" id="title">
                          </div>
                          
                          <div class="form-group">
                            <label for="days">@lang('home.Weight'):</label>
                            <input type="number" name="weight" class="form-control" id="days">
                          </div>
                          
                          
                          <div class="checkbox">
                            <label><input name="is_critical" value="Yes" type="checkbox"> @lang('home.is Critical')</label>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">@lang('home.save')</button>
                                <button class="btn btn-default" type="button" onclick="$('#question').fadeIn();$('#aquestion-edit').hide();$('html, body').animate({scrollTop:$('#question').position().top}, 700);">@lang('home.Cancel')</button>
                            </div>
                          </div>
                        </form>
                </section>
				</div>
		
		
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
<script type="text/javascript">

function addAcademic(){
   /* $('.form-academic input').val('');*/
    $('#academic-edit h4 c').text('@lang('home.AddQuestionnaire')');
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
function addquestion(){
   /* $('.form-academic input').val('');*/
    $('#academic-edit h4 c').text('@lang('home.AddQuestionnaire')');
    $('#question').hide();
    $('#aquestion-edit').fadeIn();
    $('#aquestion-edit').find('input[name="question"]').val('');
    $('#aquestion-edit').find('input[name="marks"]').val('');
    $('#addoption').html('');
    $('#addoption').append('<label for="days">Option:</label><input type="text" name="options[]" class="form-control" id="days">');
}
$('#addMore').on("click",function(){
   $('#addoption').append('<div><input type="text" name="options[]" style="width:98%;display:inline" class="form-control" id="days"><span style="font-size:25px;cursor:pointer;" onclick="$(this).parent().remove()" class="remove">&times;</span></div>');
})
$('.queseditbtn').on('click',function(){
    var index = $(this).closest('li').find('#index').val();
    var arrayName = <?php echo json_encode($eval_ques); ?>;
    $('#academic-edit h4 c').text('@lang('home.AddQuestionnaire')');
    $('#question').hide();
    $('#aquestion-edit').fadeIn();
    $('input[name="evaluation_factor"]').val(arrayName[index].evaluation_factor);
    $('input[name="weight"]').val(arrayName[index].weight);
    $('input[name="eva_ques_id"]').val(arrayName[index].eva_ques_id);
    
    if(arrayName[index].is_critical == 'Yes'){
        $('input[name="is_critical"]').attr('checked','checked');
    }
    
})
$('.quesdelid').on('click',function(){
    var q_id = $(this).closest('li').find('#eva_ques_id').val();
    if(confirm("Are you sure want to delete!")){
        $.ajax({
            url:"{{url('account/employer/evaluation/delete')}}",
            type:"post",
            data:{q_id:q_id,_token:"{{ csrf_token()}}"},
            success:function(res){
              if(res == 2){
                alert("frontend/employer line no 1741 error");
              }
            }
        });
        $(this).closest('li').remove();
    }
})
</script>
		@endsection