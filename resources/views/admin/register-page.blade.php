<?php 
$headerWeb = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$headerFavicon = url('/website/favicon.ico');
if(file_exists('/website/'.$headerWeb['webFavicon'])){
    $headerFavicon = url('/website/'.$headerWeb['webFavicon']);
}
$headerWebLogo = url('/website/logo.png');
if(file_exists('/website/'.$headerWeb['webLogo'])){
    $headerWebLogo = url('/website/'.$headerWeb['webLogo']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register &middot; {{ $headerWeb['webTitle'] }}</title>
        <link rel="shortcut icon" href="{{ $headerFavicon }}">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/vendor.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/elephant.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/login-2.min.css') }}">
    </head>
    <body>
    <div class="login">
        <div class="login-body">
            <a class="login-brand" href="{{ url('admin/login') }}">
                <img class="img-responsive" src="{{ $headerWebLogo }}" alt="{{ $headerWeb['webTitle'] }}">
            </a>
            <div class="login-form">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form data-toggle="validator" class="login-form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input class="form-control" name="firstName" autocomplete="off" data-msg-required="Please enter your first name." required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input class="form-control" name="lastName" autocomplete="off" data-msg-required="Please enter your last name." required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input class="form-control" name="phoneNumber" autocomplete="off" data-msg-required="Please enter your phone number." required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" autocomplete="off" data-msg-required="Please enter your email." required>
                    </div>
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input class="form-control" autocomplete="off" disabled="" value="admin">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                    </div>
                    <button class="btn btn-primary btn-block btn-log-in" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin-assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/elephant.min.js') }}"></script>
    <script>
    </script>
</body>
</html>