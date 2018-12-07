@extends('admin.layouts.app')

@section('title', 'Accounts')

@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Accounts</span>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#mailgun" data-toggle="tab">Mailgun</a>
                                </li>
                                <li>
                                    <a href="#paypal" data-toggle="tab">Paypal</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="mailgun">
                                    <form class="form-horizontal mailgun-form" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="accountId" value="{{ $mailgun->accountId != '' ? $mailgun->accountId : '0' }}">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Secret Key</label>
                                                <input type="text" class="form-control" name="secretKey" value="{{ @json_decode($mailgun->accountData)->secretKey }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Domain</label>
                                                <input type="text" class="form-control" name="domain" value="{{ @json_decode($mailgun->accountData)->domain }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>From Email</label>
                                                <input type="text" class="form-control" name="fromEmail" value="{{ @json_decode($mailgun->accountData)->fromEmail }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>From Name</label>
                                                <input type="text" class="form-control" name="fromName" value="{{ @json_decode($mailgun->accountData)->fromName }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label style="display: block;">&nbsp;</label>
                                                <button class="btn btn-block btn-primary do-save" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="paypal">
                                   <form class="form-horizontal paypal-form" method="post">
                                       {{ csrf_field() }}
                                        <input type="hidden" name="accountId" value="{{ $paypal->accountId != '' ? $paypal->accountId : '0' }}">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label style="display: block;">Mode</label>
                                                <label class="custom-control custom-control-primary custom-radio">
                                                    <input name="mode" class="custom-control-input" type="radio" value="live" {{ @json_decode($paypal->accountData)->mode == 'live' ? 'checked=""' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-label">Live</span>
                                                </label>
                                                <label class="custom-control custom-control-primary custom-radio">
                                                    <input name="mode" class="custom-control-input" type="radio" value="sandbox" {{ @json_decode($paypal->accountData)->mode != 'live' ? 'checked=""' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-label">Sandbox</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="{{ @json_decode($paypal->accountData)->username }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Password</label>
                                                <input type="text" class="form-control" name="password" value="{{ @json_decode($paypal->accountData)->password }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Signature</label>
                                                <input type="text" class="form-control" name="signature" value="{{ @json_decode($paypal->accountData)->signature }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label style="display: block;">&nbsp;</label>
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
                        <h3>Error</h3>
                        <p><ul class="show-error"></ul></p>
                        <div class="m-t-lg">
                                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
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
$('form.mailgun-form').submit(function(e){
    $('.mailgun-form .do-save').prop('disabled',true);
    $('.mailgun-form .do-save').addClass('spinner spinner-inverse');
    $.ajax({
        type: 'post',
        data: $('.mailgun-form').serialize(),
        url: "{{ url('admin/settings/mailgun/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.show-error').html(response);
                $('#modal-warning').modal();

                $('.mailgun-form .do-save').prop('disabled',false);
                $('.mailgun-form .do-save').removeClass('spinner spinner-inverse');
            }else{
                window.location.href = "{{ url('admin/settings/accounts') }}";
            }
        }
    })
    e.preventDefault();
})
$('form.paypal-form').submit(function(e){
    $('.paypal-form .do-save').prop('disabled',true);
    $('.paypal-form .do-save').addClass('spinner spinner-inverse');
    $.ajax({
        type: 'post',
        data: $('.paypal-form').serialize(),
        url: "{{ url('admin/settings/paypal/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.show-error').html(response);
                $('#modal-warning').modal();

                $('.paypal-form .do-save').prop('disabled',false);
                $('.paypal-form .do-save').removeClass('spinner spinner-inverse');
            }else{
                window.location.href = "{{ url('admin/settings/accounts') }}";
            }
        }
    })
    e.preventDefault();
})
</script>
@endsection