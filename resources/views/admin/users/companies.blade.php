@extends('admin.layouts.app')

@section('title', 'Companies')

@section('content')
<?php 
$searchBy = array('companyName' => 'Name', 'companyEmail' => 'Email', 'companyPhoneNumber' => 'phoneNumber');
$s_app = Session()->get('companySearch');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Companies</span>
                    <a class="btn btn-primary pull-right" href="{{ url('admin/users/company/add') }}">Add Company</a>
                </h1>
            </div>
            <div class="row">
                <form method="post" action="{{ url('admin/users/company') }}">
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
                            <a class="btn btn-default" href="{{ url('admin/users/company?reset=true') }}">Reset</a>
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
                                        @foreach($companies as $i => $company)
                                            <tr>
                                                <td>{{ $company->companyId }}</td>
                                                <td><a href="{{ url('admin/users/company/'.$company->companyId)}}">{{ $company->companyName }}</a></td>
                                                <td>{{ $company->companyEmail }}</td>
                                                <td>{{ $company->companyUsername }}</td>
                                                <td>{{ $company->companyPhoneNumber }}</td>
                                                <td>
                                                    @if($company->companyStatus == 'Active')
                                                        <label class="label label-success">{{ $company->companyStatus }}</label>
                                                    @else
                                                        <label class="label label-danger">{{ $company->companyStatus }}</label>
                                                    @endif
                                                </td>
                                                <td>{{ JobCallMe::reportDate($company->companyCreatedTime) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/users/company/'.$company->companyId)}}" data-toggle="tooltip" data-original-title="View"><i class="icon icon-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="{{ url('admin/users/company/edit/'.$company->companyId)}}" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="deleteCompany('{{ $company->companyId }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $companies->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-warning" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content bg-warning animated bounceIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <span class="icon icon-exclamation-triangle icon-5x"></span>
                        <h3>Are you sure?</h3>
                        <p>You will not be able to undo this action</p>
                        <div class="m-t-lg">
                            <form method="post" action="{{ url('admin/company/delete') }}">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="companyId" class="actionId">
                                <button class="btn btn-danger" type="submit">Continue</button>
                                <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();
    $('.date-picker').datepicker({format:'yyyy-mm-dd'})
})
function getFileName(obj){
    var vValue = $(obj).val();
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.p-image').val(vValue);
}
function deleteCompany(companyId){
    $('.actionId').val(companyId);
    $('#modal-warning').modal();
}
</script>
@endsection