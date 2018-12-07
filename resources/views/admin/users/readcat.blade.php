@extends('admin.layouts.app')

@section('title', 'Job Category')

@section('content')

    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Job Category</span>
                    <button class="btn btn-primary pull-right" onclick="addCategory()">Add Category</button>
                </h1>
            </div>
            <div class="row">
                <form method="post" action="">
                   
                    <div class="col-md-6">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="">
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        
                    </div>
                </form>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    
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
                                        @foreach($data as $cat)
                                       <tr>
                                           <td>{{$cat->id}}</td>
                                           <td>{{$cat->name}}</td>
                                           <td>{{$cat->date}}</td>
                                           <td>
                                               <a href="#" id="updateread" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                               <a href="javascript:;" onclick="deleteread({{$cat->id}})" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
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
<div id="readCat" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Read Category</h4>
      </div>
      <div class="modal-body">
        <form >
          <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="name" name="name" class="form-control" id="name">
            <input type="hidden" name="id" class="form-control" id="name">
          </div>
          <button type="button" id="readsub" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection
@section('page-footer')
<script type="text/javascript">
function addCategory(){
 $('#readCat').modal('show');
}
$('body #updateread').on('click',function(){
    var id = $(this).closest('tr').find('td').eq(0).text();
    var name = $(this).closest('tr').find('td').eq(1).text();
    $('#readCat').modal('show');
    $('#readCat form input[name="name"]').val(name);
    $('#readCat form input[name="id"]').val(id);
});
function deleteread(id){
 $.ajax({
     url:'deletereadCat',
     data:{id:id,_token:'{{ csrf_token()}}'},
     type:"post",
     success:function(res){
         if(res = 1){
             toastr.success('Read Category Delete Successfully');
             window.location.href ="{{ url('readCat') }}";
         }
     }
    });
}
$('#readsub').on('click',function(){
    var id = $('#readCat form input[name="id"]').val();
    var catname = $('#readCat form input[name="name"]').val();
    if(id == ''){
         $.ajax({
             url:'addreadCat',
             data:{name:catname,_token:'{{ csrf_token()}}'},
             type:"post",
             success:function(res){
                 if(res = 1){
                     toastr.success('Read Category add Successfully');
                     window.location.href ="{{ url('readCat') }}";
                 }
             }
         });
    }else{
        $.ajax({
             url:'addreadCat',
             data:{id:id,name:catname,_token:'{{ csrf_token()}}'},
             type:"post",
             success:function(res){
                 if(res = 1){
                     toastr.success('Read Category Update Successfully');
                     window.location.href ="{{ url('readCat') }}";
                 }
             }
         });
    }
});
</script>
@endsection