@extends('admin.layouts.app')

@section('title', 'Companies')

@section('content')

    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $feedback)
                                            <tr>
                                               <td>{{$feedback->id}}</td>
                                               <td>{{$feedback->email}}</td>
                                               <td>{{$feedback->type}}</td>
                                               <td>
                                                <?php 
                                                $string = strip_tags($feedback->message);
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
                                               <td>
                                                   <a href="#" onclick="viewfeedback({{$feedback->id}})" data-toggle="tooltip" data-original-title="View"><i class="icon icon-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                   <a href="javascript:;" onclick="deletefeedback({{$feedback->id}})" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                               </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
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
                            <form method="post" action="">
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Feedback</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form >
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <p id="email"></p>
                  </div>
                  <div class="form-group">
                    <label for="type">Type:</label>
                    <p id="type"></p>
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                    <p id="message"></p>
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
    function viewfeedback(id){
        $.ajax({
            url:"{{url('editfeedback')}}",
            dataType:'json',
            data:{id:id,_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                $('#myModal').modal('show');
                $('#email').text(res.email);
                $('#type').text(res.type);
                $('#message').text(res.message);
            }
        });
    }

    function deletefeedback(id){
        $.ajax({
            url:"{{url('deletefeedback')}}",
            dataType:'json',
            data:{id:id,_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                if(res == 1){
                    toastr.success('Feedback Deleted');
                    window.location.href = '{{url("getfeedback")}}';
                }else{
                    alert('data not deleted');
                }
            }
        });
    }

</script>
@endsection