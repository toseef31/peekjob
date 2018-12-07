@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Orders</span>
                </h1>
            </div>
			<div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>#</th>
										<th>Payer Id</th>
                                        <th>Company Name</th>
										<th>Job Tittle</th>
										<th>Email</th>
										<th>Amount</th>
										<th>Ad Duration Days</th>
										<th>Job Category</th>
										<th>Payment Status</th>
										<th>Payment Type</th>
                                        <th>Payment Date</th>
                                    </thead>
                                     <tbody>
                                        @foreach($jobs as $i => $job)
										<?php 
										$sum=$job->amount*$job->duration;
										?>
                                            <tr>
                                                <td>{{ ++$startI }}</td>
												<td>{!! $job->pay_id!!}</td>
                                                <td>{!! $job->companyName !!}</td>
                                                <td>{!! $job->title !!}</td>
												<td>{!! $job->email!!}</td>
                                                <td>${!! $job->amount!!}</td>
												<td>{!! $job->duration!!}</td>
												<td>{!! $job->p_title!!}</td>
                                                @if($job->status==1)
												<td style="text-align: center;"><label class="label label-success">Paid</label></td>
                                                @else
                                                <td style="text-align: center;"><label class="label label-danger">Unpaid</label></td>
                                                @endif
												@if($job->paymentType==1)
												<td style="text-align: center;"><label class="label label-success">Paypal</label></td>
									            @elseif($job->paymentType==2)
												<td style="text-align: center;"><label class="label label-success">Nicepay</label></td>
                                                @elseif($job->paymentType==4)
												<td style="text-align: center;"><label class="label label-success">Package Plan</label></td>
                                                @else
                                                <td style="text-align: center;"><label class="label label-success">Cash Payment</label></td>
											@endif
												<td>{!! $job->createdTime!!}</td>
                                                   
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <?php echo $jobs->render(); ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection