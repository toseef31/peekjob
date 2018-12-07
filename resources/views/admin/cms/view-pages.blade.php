@extends('admin.layouts.app')

@section('title', 'CMS Pages')

@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">CMS Pages</span>
                    <a href="{{ url('admin/cms/pages/new') }}" class="btn btn-primary pull-right">Add New Page</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Page</th>
                                        <th>Created Time</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($cmsPages as $cpage)
                                            <tr>
                                                <td>{{ ++$startI }}</td>
                                                <td>{{ $cpage->title }}</td>
                                                <td>{{ JobCallMe::reportTime($cpage->createdTime) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/cms/pages/edit/'.$cpage->pageId) }}" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>
                                                    @if(!in_array(strtolower($cpage->slug),array('about','privacy-policy','term-conditions')))
                                                        &nbsp;&nbsp;&nbsp;
                                                        <a href="javascript:;" onclick="deletePage('{{ $cpage->pageId }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $cmsPages->render() !!}
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
                        <p>You will not be able to undo this action.</p>
                        <div class="m-t-lg">
                            <form method="post" action="{{ url('admin/cms/pages/delete') }}">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="pageId" class="actionId">
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
function deletePage(pageId){
    $('.actionId').val(pageId);
    $('#modal-warning').modal();
}
</script>
@endsection