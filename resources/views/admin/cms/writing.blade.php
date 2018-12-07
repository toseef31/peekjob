@extends('admin.layouts.app')

@section('title', 'Job Category')

@section('content')
<div class="layout-content">
    <div class="layout-content-body">
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
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created Time</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>

                                        @foreach($writings as $write)
                                            <tr>
                                                <td>
                                                    {{$write->writingId}}
                                                    <input type="hidden" name="id" id="wid" value="{{$write->title}}">
                                                    <input type="hidden" name="wr_id" id="wr_id" value="{{$write->writingId}}">
                                                </td>
                                                <td>{{$write->title}}</td>
                                                <td>
                                                    <?php 
                                                    $string = strip_tags($write->description);
                                                    if (strlen($string) > 100) {

                                                        // truncate string
                                                        $stringCut = substr($string, 0, 100);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.
                                                        $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                                                        $string .= '... ReadMore';
                                                    }
                                                    echo $string;

                                                    ?>
                                                </td>
                                                <td>{{$write->cat_names}}</td>
                                                <td>
                                                    <input type="checkbox" class="status" @if($write->status == 'Publish') Checked @endif>
                                                </td>
                                                <td>{{$write->createdTime}}</td>
                                                <td>
                                                    <a href="#" data-toggle="tooltip" onclick="viewwriting({{$write->writingId}})" data-original-title="View Writing"><i class="icon icon-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                   
                                                    <a href="#" onclick="deletewriting({{$write->writingId}})" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 {!!$writings->render() !!}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="writingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Writing</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form >
                  <div class="form-group">
                    <label for="title">Title</label>
                    <p id="title"></p>
                  </div>
                  <div class="form-group">
                    <label for="category">Category</label>
                    <p id="category"></p>
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <p id="description"></p>
                  </div>
                </form>
            </div>
        </div>
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
function viewwriting(id){
        $.ajax({
            url:"{{url('admin/cms/viewwriting')}}",
            dataType:'json',
            data:{id:id,_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                console.log(res);
                $('#writingModal').modal('show');
                $('#title').text(res.title);
                $('#category').text(res.cat_names);
                $('#description').text(res.description);
            }
        });
    }
function deletewriting(id){
    $.ajax({
        url:"{{url('admin/cms/deletewriting')}}",
        dataType:'json',
        data:{id:id,_token:"{{csrf_token()}}"},
        type:"post",
        success:function(res){
            if(res == 1){
                toastr.success('Writing deleted');
                window.location.href = 'aprovewriting';
            }else{
                alert('error controller admin/cms/deletewriting line 478');
            }
            
        }
    });
}
 $(function() {
    $('.status').bootstrapToggle({
      on: 'Publish',
      off: 'Draft',
      offstyle:'info',
      onstyle:'success'
    });
    var token = "{{ csrf_token() }}";
    $('.status').on('change',function(e){
        var id = $(this).closest('tr').find('#wid').val();
        var wr_id = $('#wr_id').val();
        var status = '';
        var wrstatus = '';
        if($(e.target).parent().hasClass('off')){
            status = 'Draft';
            wrstatus = 'Pending';
        }else{
            status = 'Publish';
            wrstatus = 'Approved';
        };
        $.ajax({
            url:'{{url("admin/cms/writestatupdate")}}',
            data:{id:id,wr_id:wr_id,status:status,wrstatus:wrstatus,_token:token },
            type:'POST',
            success:function(res){
               if(res == 1){
                toastr.success('status Updated');
               }else{
                alert('error in controller admin/Cms/writestatupdate line no 457');
               }
            }
        });
    })
  })

</script>
@endsection