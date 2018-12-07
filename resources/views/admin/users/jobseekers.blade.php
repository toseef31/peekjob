@extends('admin.layouts.app')

@section('title', 'Job Seekers')

@section('content')
<?php 
$searchBy = array('firstName' => 'First Name', 'lastName' => 'Last Name', 'email' => 'Email', 'phoneNumber' => 'phoneNumber');
$s_app = Session()->get('jobseekersSearch');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Job Seekers</span>
                    <a class="btn btn-primary pull-right" href="{{ url('admin/users/jobseekers/add') }}">Add Job Seeker</a>
                </h1>
            </div>
            <div class="row">
                <form method="post" action="{{ url('admin/users/jobseekers') }}">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <label>Search By</label>
                        <select class="form-control select2" name="searchBy">
                            @foreach($searchBy as $x => $y)
                                <option value="{{ $x }}" {{ $x == $s_app['searchBy'] ? 'selected="selected"' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="{{ $s_app['search'] }}">
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select class="form-control select2" name="status">
                            <option value="All" {{ $s_app['status'] == 'All' ? 'selected="selected"' : '' }}>All</option>
                            <option value="Active" {{ $s_app['status'] == 'Active' ? 'selected="selected"' : '' }}>Active</option>
                            <option value="Inactive" {{ $s_app['status'] == 'Inactive' ? 'selected="selected"' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        @if(count($s_app) > 0)
                            <a class="btn btn-default" href="{{ url('admin/users/jobseekers?reset=true') }}">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $i => $user)
                                            <tr>
                                                <td>{{ $user->userId }}</td>
                                                <td><a href="{{ url('admin/users/jobseekers/'.$user->userId) }}">{{ $user->firstName.' '.$user->lastName }}</a></td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->phoneNumber }}</td>
                                                <td>
                                                    @if($user->status == 'Active')
                                                        <label class="label label-success">{{ $user->status }}</label>
                                                    @else
                                                        <label class="label label-danger">{{ $user->status }}</label>
                                                    @endif
                                                </td>
                                                <td>{{ JobCallMe::reportDate($user->createdTime) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/users/jobseekers/'.$user->userId) }}" data-toggle="tooltip" data-original-title="View"><i class="icon icon-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="{{ url('admin/users/jobseekers/edit/'.$user->userId) }}" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $users->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();
})
</script>
@endsection