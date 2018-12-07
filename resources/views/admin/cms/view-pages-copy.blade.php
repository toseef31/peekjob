@extends('admin.layouts.app')

@section('title', 'CMS Pages')

@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">CMS Pages</span>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('admin/cms/pages/save') }}" method="post" class="form-horizontal page-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">Select Page</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2 cmsPage" name="cmsPage" onchange="changePage()">
                                            <option value="term-condition">Terms & Conditions</option>
                                            <option value="privacy-policy">Privacy Policy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-right">Page HTML</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="pageData" id="page_editor"></textarea>
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
    $('.select2').select2();
    $('.date-picker').datepicker({format:'yyyy-mm-dd'});
    CKEDITOR.replace('page_editor',{height: '600px'});
    changePage();
})
function changePage(){
    var currentPage = $('.cmsPage').val();
    pageHtml(currentPage);
}
function pageHtml(page){
    $.ajax({
        type: 'get',
        data: {cmsPage:page},
        url: "{{ url('admin/cms/pages/get') }}",
        success: function(response){
            CKEDITOR.instances['page_editor'].setData(response);
        }
    })
}
$('form.page-form').submit(function(e){
    $('.page-form .do-save').prop('disabled',true);
    $('.page-form .do-save').addClass('spinner spinner-inverse');
})
</script>
@endsection