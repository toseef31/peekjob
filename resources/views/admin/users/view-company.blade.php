@extends('admin.layouts.app')

@section('title', 'Company Profile')

@section('content')
<?php 
$companyLogo = '';
if($company->companyLogo != ''){
    $companyLogo = url('/compnay-logo/'.$company->companyLogo);
}
$companyCover = '';
if($company->companyCover != ''){
    $companyCover = url('/compnay-logo/'.$company->companyCover);
}
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">{{ $company->companyName }}</span>
                    <a class="btn btn-primary pull-right" href="{{ url('admin/users/company') }}">Back</a>
                    <a class="btn btn-default pull-right" href="{{ url('admin/users/company/edit/'.$company->companyId) }}" style="margin-right: 10px;">Edit</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-image">
                            <a class="card-link" href="javascript:;">
                            <img style="width: 100%;" class="card-img-top img-responsive" src="{{ $companyCover }}" alt="{{ $company->companyName }}">
                            </a>
                        </div>
                        <div class="card-avatar">
                            <a class="card-thumbnail rounded sq-100" href="javascript:;">
                            <img class="img-responsive" src="{{ $companyLogo }}" alt="{{ $company->companyName }}">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5>{{ '@'.$company->companyUsername }}</h5>
                            <h3 class="card-title">{{ $company->companyName }}</h3>
                            <h6 class="card-subtitle">{!! $company->companyAbout !!}</h6>
                            <p class="card-text">
                                <i class="icon icon-phone" data-toggle="tooltip" data-original-title="Phone Number"></i>
                                &nbsp;{{ $company->companyPhoneNumber }}
                            </p>
                            <p class="card-text">
                                <i class="icon icon-envelope" data-toggle="tooltip" data-original-title="Email"></i>
                                &nbsp;<a href="mailto:{{ $company->companyEmail }}">{{ $company->companyEmail }}</a>
                            </p>
                            <p class="card-text">
                                <i class="icon icon-globe" data-toggle="tooltip" data-original-title="Website"></i>
                                &nbsp;<a href="{{ $company->companyWebsite }}" target="_blank">{{ $company->companyWebsite }}</a>
                            </p>
                            <p class="card-text">
                                <i class="icon icon-user" data-toggle="tooltip" data-original-title="Total Employees"></i>
                                &nbsp;{{ $company->companyNoOfUsers }} Employees
                            </p>
                            <p class="card-text">
                                <i class="icon icon-calendar" data-toggle="tooltip" data-original-title="Establishe Date"></i>
                                &nbsp; Established On {{ $company->companyEstablishDate }}
                            </p>
                            <p class="card-text">
                                <i class="icon icon-map-marker" data-toggle="tooltip" data-original-title="Address"></i>
                                &nbsp;{{ $company->companyAddress }}
                            </p>
                            <ul class="list-inline m-a-0">
                                @if($company->companyTwitter != '')
                                    <li>
                                        <a class="link-muted" href="{{ $company->companyTwitter }}">
                                        <span class="icon icon-twitter icon-2x"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($company->companyFb != '')
                                    <li>
                                        <a class="link-muted" href="{{ $company->companyFb }}">
                                        <span class="icon icon-facebook-official icon-2x"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($company->companyLinkedin != '')
                                    <li>
                                        <a class="link-muted" href="{{ $company->companyLinkedin }}">
                                        <span class="icon icon-linkedin icon-2x"></span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .profile-cover{background-image: url('{{ $companyCover }}');}
    </style>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection