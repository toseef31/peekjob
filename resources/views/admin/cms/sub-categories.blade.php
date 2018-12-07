@extends('admin.layouts.app')

@section('title', 'Sub Categories')

@section('content')
<?php
$s_app = Session()->get('subcategorySearch');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Sub Categories ({{ $cat->name }})</span>
                    <button class="btn btn-primary pull-right" onclick="addSubCategory()">Add Sub Category</button>
                    <a class="btn btn-default pull-right" href="{{ url('admin/cms/category') }}" style="margin-right: 10px;">Back</a>
                </h1>
            </div>
            <div class="row">
                <form method="post" action="{{ url('admin/cms/category/'.$cat->categoryId) }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="{{ $s_app['search'] }}">
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        @if(count($s_app) > 0)
                            <a class="btn btn-default" href="{{ url('admin/cms/category/'.$cat->categoryId.'?reset=true') }}">Reset</a>
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
                                        @foreach($subCategories as $i => $subCat)
                                            <tr>
                                                <td>{{ ++$startI }}</td>
                                                <td>{{ $subCat->subName }}</td>
                                                <td>{{ JobCallMe::reportTime($subCat->createdTime) }}</td>
                                                <td>
                                                    <a href="javascript:;" onclick="editSubCategory('{{ $subCat->subCategoryId }}')" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="deleteSubCategory('{{ $subCat->subCategoryId }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $subCategories->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="category-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Category</h4>
                </div>
                <form onsubmit="return false" class="category-form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="categoryId" value="{{ $cat->categoryId }}">
                        <input type="hidden" class="subCategoryId" name="subCategoryId" value="0">
                        <div class="form-group">
                            <label>Sub Category Name</label>
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
                            <form method="post" action="{{ url('admin/cms/sub-category/delete') }}">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="subCategoryId" class="actionId">
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
function deleteSubCategory(subCategoryId){
    $('.actionId').val(subCategoryId);
    $('#modal-warning').modal();
}
function addSubCategory(){
    $('.category-form .subCategoryId').val('0');
    $('.category-form input[name="name"]').val('');
    $('#category-modal').modal();
}
$('form.category-form').submit(function(e){
    $('.category-form .do-save').prop('disabled',true);
    $('.category-form .do-save').addClass('spinner spinner-default');
    $('.category-form .alert-danger').hide();
    $.ajax({
        type: 'post',
        data: $('.category-form').serialize(),
        url: "{{ url('admin/cms/sub-category/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.category-form .alert-danger').show();
                $('.category-form .alert-danger').html(response);
                $('.category-form .do-save').prop('disabled',false);
                $('.category-form .do-save').removeClass('spinner spinner-default');
            }else{
                window.location.href = "{{ url('admin/cms/category/'.$cat->categoryId) }}";
            }
        }
    })
    e.preventDefault();
})
function editSubCategory(subCategoryId){
    $.ajax({
        url: "{{ url('admin/cms/sub-category/get') }}/"+subCategoryId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.category-form .subCategoryId').val(subCategoryId);
            $('.category-form input[name="name"]').val(obj.subName);
            $('#category-modal').modal();
        }
    })
}
</script>
@endsection