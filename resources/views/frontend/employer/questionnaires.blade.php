		@extends('frontend.layouts.app')

		@section('title', 'Evaluation Forms')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
				 <section class="resume-box" id="academic">
                        <a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-plus"></i> </a>
                        <h4> @lang('home.Test/Questionnaires')</h4>
                        <?php //print_r($resume); ?>
                        <table class="table questionr-table">
                            <thead>
                                <tr>
                                    <th>@lang('home.Questionnaire')</th>
                                    <th>@lang('home.QueType')</th>
                                    <th>@lang('home.Submitted in')</th>
                                    <th>@lang('home.Late Submission')</th>
                                    <th>@lang('home.Shuffle')</th>
                                    <th>@lang('home.Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($questionaires as $question)
                                <tr id="{{$question->ques_id}}">
                                    <td>{{ $question->title }}</td>
                                    <td>@lang('home.'.$question->type)</td>
                                    <td>{{ $question->submission_date }}</td>
                                    <td>@lang('home.Que'.$question->accept_late_submission)</td>
                                    <td>@lang('home.Que'.$question->shuffle_questions)</td>
                                    <td><a href="{{ url('account/employer/questionnaires/edit/'.$question->ques_id) }}" style="color:#000"><i class="fa fa-edit"></i></a> <span><i class="fa fa-remove pointer" onclick="delquestionair({{$question->ques_id}})"></i></span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                    </section>
                    <section class="resume-box" id="academic-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.AddQuestionnaire')</c></h4>
                        <form method="post" action="{{ url('account/employer/questionnaires/new') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="form-group">
                            <label for="title">@lang('home.QueTitle'):</label>
                            <input type="text" name="title" class="form-control" id="title">
                          </div>
                          <div class="form-group">
                            <label for="type">@lang('home.QueType'):</label>
                            <select class="form-control" id="type" name="type">
                                <option>@lang('home.Que Select type')</option>
                                <option>@lang('home.Test')</option>
                                <option>@lang('home.Questionnaires')</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="days">@lang('home.Submission Days'):</label>
                            <input type="number" name="submission_date" class="form-control" id="days">
                          </div>
                          <div class="checkbox">
                            <label><input name="late_submission" value="Yes" type="checkbox"> @lang('home.Accept Late Submission')</label>
                          </div>
                          <div class="checkbox">
                            <label><input name="shuffle_question" value="Yes" type="checkbox"> @lang('home.Shuffle Questions')</label>
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

				</div>
		
		
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
function addAcademic(){
   /* $('.form-academic input').val('');*/
    $('#academic h4 c').text('@lang("home.AddQuestionnaire")');
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
function delquestionair(id){
    if(confirm("@lang('home.Are you sure want to delete!')")){
        $.ajax({
            url:"{{url('account/employer/questionnaires/delete')}}",
            type:"post",
            data:{id:id,_token:"{{ csrf_token()}}"},
            success:function(res){
              if(res == 2){
                alert("frontend/employer line no 1749 error");
              }
            }
        });
        $('#'+id).remove();
    }
    
}
		</script>
		@endsection