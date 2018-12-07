@extends('frontend.layouts.app')

@section('title', 'Offer Interview')

@section('content')
<section id="company-box">
	<div class="container">
		<div class="row">
		<div class="col-md-12">
			<div class="header">
				Offers Interviews
			</div>
			<div class="body">
				<table class="table">
					<thead>
						<tr>
							<th>Employer</th>
							<th>Offer Message</th>
							<th>Offer Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $offer)
						<?php $companyDetail = Sajid::getReviewCompany($offer->emp_id);?>
						<tr>
							<td><span class="heading"><a target="_blank" href="{{url('companies/company/'.$companyDetail->companyId)}}">{{ $companyDetail->companyName }}</a></td>
							<!--<td>{{ substr($offer->comment,0,100) }}</td>-->
							<!--<td>{{ date('d M Y h:i',strtotime($offer->comment_date)) }}</td>-->
							<td>{{ $offer->offer_msg }}</td>
							<td>{{ date('d M Y h:i',strtotime($offer->created_at)) }}</td>
							<td><i class="fa fa-edit pointer" onclick="editoffer(this,{{$offer->offer_id}},'{{ $offer->offer_msg}}')"></i> <i class="fa fa-remove pointer" onclick="deloffer(this,{{$offer->offer_id}})"></i></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>		
		</div>
	</div>
</section>
<div id="offerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit offer</h4>
      </div>
      <div class="modal-body">
      	<form id="offerform">
      		<input type="hidden" name="id" id="offer_id">
      		<textarea name="offer" id="offer" rows="5" class="form-control"></textarea><br>
        	<button class="btn btn-primary" type="button" id="update-btn">Update</button>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection
@section('page-footer')
<script type="text/javascript">
function deloffer(current,id){
	 if (confirm("Are you sure?")) {
        // your deletion code
    
	$.ajax({
		url:jsUrl()+"/delete/record",
		type:"post",
		data:{table:"jcm_offer_interview",field:"offer_id",id:id,_token:"{{csrf_token()}}"},
		success:function(res){
			if(res == 1){
				$(current).closest('tr').remove();
			}else{
				alert("error");
			}
		}
	});
	}
    return false;
}
function editoffer(current,id,comment){
	$('#offer').val($.trim(comment));
	$('#offer_id').val($.trim(id));
	$('#offerModal').modal('show');
}
$('#update-btn').click(function(){
	var id = $('#offer_id').val();
	var offer = $('#offer').val();
	$.ajax({
		url:jsUrl()+"/update/record",
		type:"post",
		data:{table:'jcm_offer_interview',field:'offer_id',id:id,data:{offer_msg:offer},_token:"{{csrf_token()}}"},
		success:function(res){
			if(res == 1){
				location.reload(true);
			}else{
				alert('error');
			}
		}
	})
})
</script>
@endsection