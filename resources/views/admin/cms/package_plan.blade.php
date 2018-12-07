@extends('admin.layouts.app')

@section('title', 'Package Plan')

@section('content')
<?php 
$s_app = Session()->get('jobtypeSearch');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Job Types</span>
                    <button class="btn btn-primary pull-right" onclick="addType()">Add Package Plan</button>
                </h1>
            </div>
            <div class="row">
                <form method="post" action="{{ url('admin/cms/plan') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="{{ $s_app['search'] }}">
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        @if(count($s_app) > 0)
                            <a class="btn btn-default" href="{{ url('admin/cms/plan?reset=true') }}">Reset</a>
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
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Ad Duration</th>
                                       
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($plan as $i => $jtype)
                                            <tr>
                                                <td>{{ ++$startI }}</td>
                                                <td>{{ $jtype->type }}</td>
                                                <td>${{ $jtype->amount }}</td>
                                                @if($jtype->type == 'Resume Download')
                                                <td>{{ $jtype->quantity }} resumes</td>
                                                <td>{{ $jtype->duration }} </td>
                                                @else
                                                <td>{{ $jtype->quantity }} jobs</td>
                                                <td>{{ $jtype->duration }} days</td>
                                                @endif
                                               
                                                <td>{{ JobCallMe::reportTime($jtype->created_at) }}</td>
                                                <td>
                                                    <a href="javascript:;" onclick="editType('{{ $jtype->pckg_id }}')" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="deleteType('{{ $jtype->pckg_id }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $plan->render() !!}
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
                    <h4 class="modal-title">Add Package Plan</h4>
                </div>
                <form onsubmit="return false" class="jobtype-form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" class="pckg_id" name="pckg_id" value="0">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="type" id="type_select">
                                <option value="Premium|7">Premium</option>
                                <option value="Top|6">Top</option>
                                <option value="Hot|5">Hot</option>
                                <option value="Special|3">Special</option>
                                <option value="Latest|4">Latest</option>
                                <option value="Golden|2">Goldan</option>
                                 <option value="Resume Download">Resume Download</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                        <div class="form-group" id="this_hide">
                            <label>Duration</label>
                            <input type="number" id="this_disabled" class="form-control" name="duration" required>
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
                            <form method="post" action="{{ url('admin/cms/plan/delete') }}">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="pckg_id" class="actionId">
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

  $("#type_select").change(function(){
    var ye=$('#type_select').val();
    //alert(ye);
    if(ye == "Resume Download"){
        $('#this_disabled').prop('disabled', true);
        $('#this_hide').hide();
       // alert("ohhh noo");
        }
        else{
        $('#this_disabled').prop('disabled', false);
        $('#this_hide').show();
        }
    });

function deleteType(pckg_id){
    $('.actionId').val(pckg_id);
    $('#modal-warning').modal();
}
function addType(){
    $('.jobtype-form .pckg_id').val('0');
    $('.jobtype-form input[name="type"]').val('');
    $('#jobtype-modal').modal();
}
$('form.jobtype-form').submit(function(e){
    $('.jobtype-form .do-save').prop('disabled',true);
    $('.jobtype-form .do-save').addClass('spinner spinner-default');
    $('.jobtype-form .alert-danger').hide();
    $.ajax({
        type: 'post',
        data: $('.jobtype-form').serialize(),
        url: "{{ url('admin/cms/plan/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.jobtype-form .alert-danger').show();
                $('.jobtype-form .alert-danger').html(response);
                $('.jobtype-form .do-save').prop('disabled',false);
                $('.jobtype-form .do-save').removeClass('spinner spinner-default');
            }else{
                window.location.href = "{{ url('admin/cms/plan') }}";
            }
        }
    })
    e.preventDefault();
})
function editType(pckg_id){
    $.ajax({
        url: "{{ url('admin/cms/plan/get') }}/"+pckg_id,
        success: function(response){
            var obj = $.parseJSON(response);
            console.log(obj);
            $('.jobtype-form .pckg_id').val(pckg_id);
            $('.jobtype-form input[name="type"]').val(obj.type);
            $('.jobtype-form input[name="amount"]').val(obj.amount);
            $('.jobtype-form input[name="quantity"]').val(obj.quantity);
            $('.jobtype-form input[name="duration"]').val(obj.duration);
            
            $('#jobtype-modal').modal();
        }
    })
}
</script>
@endsection