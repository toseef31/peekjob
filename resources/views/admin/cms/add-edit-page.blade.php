@extends('admin.layouts.app')

@if($rPath == 'edit')
    @section('title', 'Update CMS Page')
@else
    @section('title', 'Add CMS Page')
@endif
@section('content')
<?php 
$featuredImage = '';
if($cpage['featuredImage'] != ''){
    $featuredImage = url('featured-photos/'.$cpage['featuredImage']);
}
$readonly = in_array(strtolower($cpage['slug']),array('about','privacy-policy','term-conditions')) ? 'readonly=""' : '';
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib"> {{ $rPath == 'edit' ? 'Update CMS Page' : 'Add CMS Page' }}</span>
                    <a href="{{ url('admin/cms/pages') }}" class="btn btn-default pull-right">Back</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" class="form-horizontal page-form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="pageId" value="{{ $pageId }}">
                                <input type="hidden" name="slug" class="slug" value="{{ $cpage['slug'] }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">Page Title</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="title" onchange="changeTxt(this.value)" value="{{ $cpage['title'] }}" {{ $readonly }}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">Page HTML</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="pageData" id="page_editor">{{ $cpage['pageData'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">Featured Image</label>
                                    <div class="col-md-8">
                                        <div class="input-group input-group-file">
                                            <input class="form-control p-image" readonly="" type="text">
                                            <span class="input-group-btn">
                                                <label class="btn btn-primary file-upload-btn">
                                                    <input name="featuredImage" class="file-upload-input" type="file" onchange="getFileName(this)">
                                                    <span class="icon icon-image icon-lg"></span>
                                                </label>
                                            </span>
                                        </div>
                                        <p class="help-block">Format supported (png,jpeg,jpg,gif)</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">&nbsp;</label>
                                    <div class="col-md-8">
                                        <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                            <img src="{{ $featuredImage }}" alt="" style="max-width: 200px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">&nbsp;</label>
                                    <div class="col-md-8">
                                        <button class="btn btn-block btn-primary do-save" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    CKEDITOR.replace('page_editor',{
        height: '400px',
        toolbar: [
            { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'links', items: [ 'Link', 'Unlink' ] },
            { name: 'insert', items: [ 'Image', 'EmbedSemantic', 'Table' ] },
        ],
    });
})
function getFileName(obj){
    var vValue = $(obj).val();
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.p-image').val(vValue);
}
function changeTxt(text){
    $('.page-form .slug').val(getSlug(text));
}
function getSlug(text){
    return text
        .toLowerCase()
        .replace(/& /g,'')
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'');
}
$('form.page-form').submit(function(e){
    $('.page-form .do-save').prop('disabled',true);
    $('.page-form .do-save').addClass('spinner spinner-inverse');
})
</script>
@endsection