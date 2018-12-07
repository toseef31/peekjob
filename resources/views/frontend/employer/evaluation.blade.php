		@extends('frontend.layouts.app')

		@section('title', 'Evaluation')

		@section('content')

		<section id="company-box">
			<div class="container">
				<div class="row" style="background-color: white;">

					<div class="follow-companies6" style="background:#57768a;color:#fff;;margin-bottom:20px;">
		                    <h3 style="margin-left: 15px">@lang('home.Job Evaluation Matrix')</h3>
					</div>
		            <div class="col-md-12" style="padding-bottom: 36px;">
		            	@if(sizeof($all_eva_cand) == 0)
		            	<h3>@lang('home.No evaluation for this job')</h3>
		            	@endif
						<table class="table">
							@foreach($all_eva_cand as $cand)
							<tr>
								<th>Candidate</th>
								<td>{{ $cand->firstName." ".$cand->lastName }}</td>
								<!-- geeting ans of candidates -->
								<?php $eva_ans = DB::table('jcm_evaluation_answer')->where('candidate_id',$cand->candidate_id)->where('job_id',$cand->job_id)->get();?>
								<th>Evaluation</th>
								<td>{{ $cand->evaluation_title }}</td>
								<th>Meet Qualification</th>
								<td>{{ $cand->qualification }}</td>
								@foreach($eva_ans as $ans)
								<th>{{ $ans->evaluation_factor }}</th>
								<td>{{ $ans->point }}</td>
								@endforeach
								<th>Total</th>
								<td>{{$cand->total}}</td>
							</tr>
							@endforeach
						</table>
						
					</div>
				   
				</div>
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
		</script>
		@endsection