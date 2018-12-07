@extends('frontend.layouts.app')

@section('title','Orders history')

@section('content')
<section id="orders">
    <div class="container">
        <div class="col-md-12" style="margin-top: 53px">
        	<div class="row">
        		<div class="col-md-2">
        			<div style="background: #fff; margin:20px 0px 20px 0px; padding: 20px 10px 20px 10px">
        				<form method="POST" action="{{ url('account/employer/orders') }}">
        				    <div class="form-group">
        				    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        				    	<input type="text" name="order_id" class="form-control" placeholder="@lang('home.ID')">
        				    </div>
        				    <div class="form-group">
        				     
        				      <select name="status" class="form-control" id="exampleFormControlSelect1">
        				        <option value="">@lang('home.Select Status')</option>
        				        <option value="Failed">@lang('home.Failed')</option>
        				        <option value="Approved">@lang('home.Approved')</option>
        				        <option value="Pending">@lang('home.Pending')</option>
        				        <option value="Amount Refunded">@lang('home.Amount Refunded')</option>
        				      </select>
        				    </div>
        				  	<div class="form-group">
        				  	    <select class="form-control" name="payment_mode" id="exampleFormControlSelect1">
        				  	      <option value="">@lang('home.Select Pay Mode') </option>
        				  	      <option value="Nice Pay">@lang('home.Nice Pay')</option>
        				  	      <option value="PayPal">@lang('home.PayPal')</option>
        				  	      <option value="Cash Payment">@lang('home.Cash Payment')</option>        	
        				  	    </select>
        				  	  </div>
        				  	  <div class="form-group">
        				    	<input type="text" name="from" class="form-control date-picker" placeholder="@lang('home.Form')">
        				    </div>
        				    <div class="form-group">
        				    	<input type="text" name="to" class="form-control date-picker"  placeholder="@lang('home.To')">
        				    </div>
        				  <button type="submit" class="btn btn-primary">@lang('home.Submit')</button>
        				</form>
        			</div>
        		</div>
        		<div class="col-md-10" >
        			<div style="background: #fff; margin:20px 0px 20px 0px; padding: 10px 10px 10px 10px">
        				<!-- <h5>No data found</h5> -->
        				<table class="table">
        					<thead>
        						<tr>
        							<th>@lang('home.ID')</th>
									<th>@lang('home.Category By')</th>
        							<th>@lang('home.Ordered By')</th>
        							<th>@lang('home.Payment Mode')</th>
        							<th>@lang('home.Amount')</th>
        							<th>@lang('home.Status')</th>
        							<th>@lang('home.Date')</th>
        						</tr>
        					</thead>
        					<tbody>
        						@foreach($data as $order)
        						<tr>
        							<td>{{$order->order_id}}</td>
									<td>@lang('home.'.$order->category)</td>
									@if($order->category == "Package Plan")
        							<td>@lang('home.'.$order->orderBy)</td>
									@else
									<td>{{$order->orderBy}}</td>
									@endif
        							<td>@lang('home.'.$order->payment_mode)</td>
        							<td>{{$order->amount}} {{$order->currency}}</td>
        							<td>@lang('home.'.$order->status)</td>
        							<td>{{$order->order_date}}</td>
											@if($order->status == 'Pending' && $order->payment_mode == 'Cash Payment'  )<td>	<div class="col-xs-2 col-md-2"><div class="dropdown">
									  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									  <div class="dropdown-content">
										<a href="{{url('afterpayment/'.$order->order_id)}}"><span style="font-size: 12px;"> @lang('home.MakePayment')</span></a>
										
									  </div>
									</div></div></td>
									@else
									<td></td>
									@endif
        						</tr>
        						@endforeach
        					</tbody>
        				</table>
        			</div>
        			
        		</div>
        	</div>
		</div>
	</div>
</section>
@endsection
@section('page-footer')


@endsection