@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Receive Cash Payments</span>
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
										<th>Order Id</th>
                                        <th>Ordered By</th>
										<th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Order Tittle</th>
                                        <th>Product Category</th>
										<th>Amount</th>
										<th>Bank Name</th>
										<th>Branch</th>
                                        <th>Status</th>
                                        <th>Payment Date</th>
                                    </thead>
                                     <tbody>
                                        @foreach($orders as $i => $job)
									
                                            <tr>
                                                <td>{{ ++$startI }}</td>
												<td>{!! $job->order_id!!}</td>
                                                <td>{!! $job->name !!}</td>
												<td>{!! $job->email!!}</td>
                                                <td>{!! $job->phonenum !!}</td>
                                                <td>{!! $job->order_title!!}</td>
                                                <td>{!! $job->category!!}</td>
                                                <td>{!! $job->amount!!} {{ $job->currency }}</td>
												<td>{!! $job->bank_name!!}</td>
                                                <td>{!! $job->branch!!}</td>
                                                 <td>{!! $job->status!!}</td>
                                              
												<td>{!! $job->created_at!!}</td>
                                                   
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <?php echo $orders->render(); ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection