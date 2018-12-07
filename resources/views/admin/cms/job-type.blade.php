@extends('admin.layouts.app')

@section('title', 'Job Types')

@section('content')
<?php 
$s_app = Session()->get('jobtypeSearch');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Job Types</span>
                    <button class="btn btn-primary pull-right" onclick="addType()">Add Job Type</button>
                </h1>
            </div>
            <div class="row">
                <form method="post" action="{{ url('admin/cms/jobtype') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="{{ $s_app['search'] }}">
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        @if(count($s_app) > 0)
                            <a class="btn btn-default" href="{{ url('admin/cms/jobtype?reset=true') }}">Reset</a>
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
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($jobType as $i => $jtype)
                                            <tr>
                                                <td>{{ ++$startI }}</td>
                                                <td>{{ $jtype->name }}</td>
                                                <td>{{ JobCallMe::reportTime($jtype->createdTime) }}</td>
                                                <td>
                                                    <a href="javascript:;" onclick="editType('{{ $jtype->typeId }}')" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="deleteType('{{ $jtype->typeId }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $jobType->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="jobtype-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Job Type</h4>
                </div>
                <form onsubmit="return false" class="jobtype-form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" class="typeId" name="typeId" value="0">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="alert alert-danger" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary do-save">Save</button>
                    </div>
                </form>
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
                        <p>You will not be able to undo this action.</p>
                        <div class="m-t-lg">
                            <form method="post" action="{{ url('admin/cms/jobtype/delete') }}">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="typeId" class="actionId">
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
function deleteType(typeId){
    $('.actionId').val(typeId);
    $('#modal-warning').modal();
}
function addType(){
    $('.jobtype-form .typeId').val('0');
    $('.jobtype-form input[name="name"]').val('');
    $('#jobtype-modal').modal();
}
$('form.jobtype-form').submit(function(e){
    $('.jobtype-form .do-save').prop('disabled',true);
    $('.jobtype-form .do-save').addClass('spinner spinner-default');
    $('.jobtype-form .alert-danger').hide();
    $.ajax({
        type: 'post',
        data: $('.jobtype-form').serialize(),
        url: "{{ url('admin/cms/jobtype/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.jobtype-form .alert-danger').show();
                $('.jobtype-form .alert-danger').html(response);
                $('.jobtype-form .do-save').prop('disabled',false);
                $('.jobtype-form .do-save').removeClass('spinner spinner-default');
            }else{
                window.location.href = "{{ url('admin/cms/jobtype') }}";
            }
        }
    })
    e.preventDefault();
})
function editType(typeId){
    $.ajax({
        url: "{{ url('admin/cms/jobtype/get') }}/"+typeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.jobtype-form .typeId').val(typeId);
            $('.jobtype-form input[name="name"]').val(obj.name);
            $('#jobtype-modal').modal();
        }
    })
}
</script>
@endsection