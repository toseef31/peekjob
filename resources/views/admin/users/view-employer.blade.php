@extends('admin.layouts.app')

@section('title', 'User Profile')

@section('content')
<?php 
$profilePhoto = url('profile-photos/profile-logo.jpg');
if($user->profilePhoto != ''){
    $profilePhoto = url('/profile-photos/'.$user->profilePhoto);
}
$coverPhoto = url('profile-photos/profile-background.png');
?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">{{ $user->firstName.' '.$user->lastName }}</span>
                    <a class="btn btn-default pull-right" href="{{ url('admin/users/view') }}">Back</a>
                    <a class="btn btn-primary pull-right" href="{{ url('admin/users/edit/'.$user->userId) }}" style="margin-right: 10px;">Edit</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-image">
                            <a class="card-link" href="javascript:;">
                            <img style="width: 100%;height: 50px;" class="card-img-top img-responsive" src="{{ $coverPhoto }}" alt="">
                            </a>
                        </div>
                        <div class="card-avatar">
                            <a class="card-thumbnail rounded sq-100" href="javascript:;">
                            <img class="img-responsive" src="{{ $profilePhoto }}" alt="{{ $user->firstName.' '.$user->lastName }}">
                            </a>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <h5>{{ '@'.$user->username }}</h5>
                            <h3 class="card-title">{{ $user->firstName.' '.$user->lastName }}</h3>
                            <h6 class="card-subtitle">{{ $user->about }}</h6>
                            <p class="card-text">
                                <i class="icon icon-phone" data-toggle="tooltip" data-original-title="Phone Number"></i>
                                &nbsp;{{ $user->phoneNumber }}
                            </p>
                            <p class="card-text">
                                <i class="icon icon-envelope" data-toggle="tooltip" data-original-title="Email"></i>
                                &nbsp;<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </p>
                            <p class="card-text">
                                <i class="icon icon-industry" data-toggle="tooltip" data-original-title="Company"></i>
                                &nbsp;<a href="{{ url('admin/users/company/'.$user->companyId) }}">{{ JobCallMe::getCompany($user->companyId)->companyName }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .profile-cover{background-image: url('{{ $coverPhoto }}');}
    </style>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection