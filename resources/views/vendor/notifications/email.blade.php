
<?php
$headerWeb = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$headerWebLogo = url('website/logo.png');
if(file_exists('../website/'.$headerWeb['webLogo'])){
    $headerWebLogo = url('../website/'.$headerWeb['webLogo']);
}
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Verification</title>
</head>
<body>

<table class="m_1888394735623576276wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#f5f8fa;margin:0;padding:0;width:100%"><tbody><tr>
<td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                <table class="m_1888394735623576276content" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0;padding:0;width:100%">
<tbody><tr>
<td class="m_1888394735623576276header" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:25px 0;text-align:center;">
        <a href="https://jobcallme.com/" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#bbbfc3;font-size:19px;font-weight:bold;text-decoration:none" target="_blank">
           <img src="https://www.jobcallme.com/website/logo.png" class="logo-img">
        </a>
    </td>
</tr>
<tr>
<td class="m_1888394735623576276body" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:0;width:100%">
 <table class="m_1888394735623576276inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
<tbody><tr>
<td class="m_1888394735623576276content-cell" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
     <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">@lang('home.Hello!')</h1>
<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">@lang('home.You are receiving this email because we received a password reset request for your account.')</p>
<table class="m_1888394735623576276action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%"><tbody><tr>
<td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box"><tbody><tr>
<td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
   <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box"><tbody><tr>
<td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
 @component('mail::button', ['url' => $actionUrl, 'color' => $color])
@lang("home.".$actionText)
@endcomponent
        </td>
             </tr>
                 </tbody>
                   </table>               
     </td>
      </tr>
      </tbody>
      </table>
</td>
  </tr>
  </tbody>
  </table>
<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">@lang('home.If you did not request a password reset, no further action is required.')</p>
<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">@lang('home.Regards'),<br>@lang('home.JobCallMe')</p>
<table class="m_1598845040421941858subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-top:1px solid #edeff2;margin-top:25px;padding-top:25px"><tbody><tr>
<td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;line-height:1.5em;margin-top:0;text-align:left;font-size:12px">
@isset($actionText)
@component('mail::subcopy')
@if(app()->getLocale() == "kr")
@lang("home.".$actionText) @lang("home.If you’re having trouble clicking the")  @lang("home.button, copy and paste the URL below into your web browser")
@else
@lang("home.If you’re having trouble clicking the") @lang("home.".$actionText) @lang("home.button, copy and paste the URL below into your web browser")
@endif
: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset</p>
        </td>
    </tr>
    </tbody>
    </table>
</td>
 </tr>
</tbody>
</table>
</td>
 </tr>
<tr>
<td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
 <table class="m_1888394735623576276footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:570px"><tbody><tr>
<td class="m_1888394735623576276content-cell" align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">© 2018 JobCallMe. All rights reserved.</p>
       </td>
            </tr>
            </tbody>
            </table>
</td>
</tr>
</tbody></table>
</td>
        </tr></tbody></table>
</body>
</html>
