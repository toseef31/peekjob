@extends('admin.layouts.app')

@section('title', 'Package')

@section('content')
<?php 
$s_app = Session()->get('shiftSearch');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">All Jobs Packages</span>
                </h1>
            </div>
           <!-- <div class="row">
                <form method="post" action="{{ url('admin/cms/alljobs') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="{{ $s_app['search'] }}">
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        @if(count($s_app) > 0)
                            <a class="btn btn-default" href="{{ url('admin/cms/alljobs?reset=true') }}">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
            <hr>-->
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Email</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>payment Type</th>
                                        <th>Status</th>
                                         <th>Created On</th>
                                        
                                    </thead>
                                    <tbody>
                                    
                                        @foreach($jobs as $i => $job)
                                            <tr>
                                                <td>
                                                    {{ ++$i }}
                                                    <input type="hidden" value="{{ $job->id }}" id="pckg_id">
                                                </td>
                                                <td>{{ $job->type}}</td>
                                                <td>{{$job->email}}</td>
                                                <td>{{ $job->amount }} {{ $job->currency }}</td>
                                               
                                                <td>{{ $job->quantity }}</td>
                                                <td>{{ $job->paymentMode }}</td>
                                                <td>
                                                    <input type="checkbox" class="jobstatus" @if($job->status == '1') Checked @endif>
                                                </td>
                                                <td>{{ $job->created_at }}</td>
                                                <td>
                                                   <!--  <a href="{{ url('admin/cms/jobs/update/'.$job->pckg_id) }}" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp; -->
                                                 <!--    <a href="javascript:;" onclick="deleteShift('{{ $job->pckg_id }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               {!! $jobs->render() !!}
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="shift-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Job Shift</h4>
                </div>
                <form onsubmit="return false" class="shift-form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" class="shiftId" name="shiftId" value="0">
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
                            <form method="post" action="{{ url('admin/cms/jobs/delete') }}">
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
     $('.jobstatus').bootstrapToggle({
      on: 'Publish',
      off: 'Draft',
      offstyle:'info',
      onstyle:'success'
    });
    var token = "{{ csrf_token() }}";
    $('.jobstatus').on('change',function(e){
       
         var id = $(this).closest('tr').find('#pckg_id').val();
        //var userId = $(this).closest('tr').find('#userId').val();
       
         var jobstatus = '';
        var status = '';
        var orderstatus = '';
        if($(e.target).parent().hasClass('off')){
            jobstatus = 'Draft';
             status = '2';
             orderstatus='Pending';
        }else{
            jobstatus = 'Publish';
             status = '1';
             orderstatus='Approved';
        };
        $.ajax({
            url:'{{url("admin/cms/pckgstatupdate")}}',
             data:{id:id,jobstatus:jobstatus,status:status,orderstatus:orderstatus,_token:token },
            type:'POST',
            success:function(res){
               if(res == 1){
                toastr.success('status Updated');
               }else{
                alert('error in controller admin/Cms/jobstatupdate line no 469');
               }
            }
        });
    })
    $('.select2').select2();
    $('.date-picker').datepicker({format:'yyyy-mm-dd'})
  })

    

function deleteShift(pckg_id){
    $('.actionId').val(pckg_id);
    $('#modal-warning').modal();
}
function addShift(){
    $('.shift-form .shiftId').val('0');
    $('.shift-form input[name="name"]').val('');
    $('#shift-modal').modal();
}
$('form.shift-form').submit(function(e){
    $('.shift-form .do-save').prop('disabled',true);
    $('.shift-form .do-save').addClass('spinner spinner-default');
    $('.shift-form .alert-danger').hide();
    $.ajax({
        type: 'post',
        data: $('.shift-form').serialize(),
        url: "{{ url('admin/cms/shift/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.shift-form .alert-danger').show();
                $('.shift-form .alert-danger').html(response);
                $('.shift-form .do-save').prop('disabled',false);
                $('.shift-form .do-save').removeClass('spinner spinner-default');
            }else{
                window.location.href = "{{ url('admin/cms/shift') }}";
            }
        }
    })
    e.preventDefault();
})

</script>
@endsection