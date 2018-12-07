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
                                        <th>Organiser</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>End Date</th>
                                        <th>Created On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>

                                        @foreach($upskills as $skill)
                                            <tr>
                                                <td>
                                                    {{$skill->skillId}}
                                                    <input type="hidden" name="id" id="wid" value="{{$skill->skillId}}">
                                                </td>
                                                <td>{{$skill->title}}</td>
                                                <td>{{$skill->organiser}}</td>
                                                 <td>{{$skill->email}}</td>
                                                  <td>{{$skill->mobile}}</td>
                                                   
                                                <td>
                                                    <?php 
                                                    $string = strip_tags($skill->description);
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
                                                <td>{{$skill->type}}</td>
                                                <td>{{$skill->endDate}}</td>
                                                <td>{{$skill->createdTime}}</td>
                                                <td>
                                                    <input type="checkbox" class="status" @if($skill->status == 'Active') Checked @endif>
                                                </td>
                                                <td>
                                                    <a href="#" data-toggle="tooltip" onclick="viewwriting({{$skill->skillId}})" data-original-title="View Writing"><i class="icon icon-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                   
                                                    <a href="#" onclick="deletewriting({{$skill->skillId}})" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 {!! $upskills->render() !!}
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
                    <label for="type">Type</label>
                    <p id="type"></p>
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
            url:"{{url('admin/cms/viewskill')}}",
            dataType:'json',
            data:{id:id,_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                console.log(res);
                $('#writingModal').modal('show');
                $('#title').text(res.title);
                $('#type').text(res.type);
                $('#description').text(res.description);
            }
        });
    }
function deletewriting(id){
    $.ajax({
        url:"{{url('admin/cms/deleteskill')}}",
        dataType:'json',
        data:{id:id,_token:"{{csrf_token()}}"},
        type:"post",
        success:function(res){
            if(res == 1){
                toastr.success('Upskill deleted');
                window.location.href = 'aproveskills';
            }else{
                alert('error controller admin/cms/deleteupskill line 503');
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
        var status = '';
        var upstatus = '';
        if($(e.target).parent().hasClass('off')){
            status = 'Inactive';
            upstatus = 'Pending';
            poststatus = 'Pending';
        }else{
            status = 'Active';
            poststatus = 'Active';
            upstatus = 'Approved';
        };
        $.ajax({
            url:'{{url("admin/cms/upskillstatupdate")}}',
            data:{id:id,status:status,upstatus:upstatus,poststatus:poststatus,_token:token },
            type:'POST',
            success:function(res){
               if(res == 1){
                toastr.success('status Updated');
               }else{
                alert('error in controller admin/Cms/writestatupdate line no 516');
               }
            }
        });
    })
  })

</script>
@endsection