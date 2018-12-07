<?php
$web = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$companyLogo = url('/website/logo.png');
if(file_exists('/website/'.$web['webLogo'])){
    $companyLogo = url('/website/'.$web['webLogo']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{!! $subject !!}</title>
</head>
<body style="margin: 0;">
    <div style="width: 100%; background: #e5e5e5;padding: 15px 0;">
        <table style="width: 600px; margin: 0 auto; background-color: #ffffff">
            <thead>
                <tr style="width:100%">
                    <td style="background-color:#000000;text-align: center;padding-top: 12px;padding-bottom: 6px; ">
                        <img src="{{ $companyLogo }}">
                    </td>
                </tr>
            </thead>
            <tbody style="padding-left: 20px">
                <tr>
                    <td><h2 style="font-family: Calibri; margin-left: 20px">Hi {{ $name }}</h2></td>
                </tr>
                <tr>
                    <td>
                        <p style="font-family: Calibri;margin-left: 20px; ">{!! $msgBody !!}</p>
                    </td>
                </tr>
                <tr style="background-color: #000000;">
                    <td>
                        <div style="text-align: center; padding-left: 20px; padding-right: 20px; font-family: Calibri; color: #fff;font-size: 12px">
                            <p>{{ $web['webTitle'] }} {{ $web['address'] }}.<br></p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>