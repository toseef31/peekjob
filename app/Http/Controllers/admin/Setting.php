<?php

namespace App\Http\Controllers\admin;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;

class Setting extends Controller{
    public function __construct(){
    }
    public function profile(Request $request){
    	//echo public_path();exit;
    	$app = session()->get('jcmAdmin');
    	if($request->isMethod('post')){
    		$this->validate($request, [
    			'firstName' => 'required|max:100',
    			'lastName' => 'required|max:100',
    			'email' => 'required|email|max:255',
    			'phoneNumber' => 'required|digits_between:10,12',
    			'profileImage' => 'image|mimes:jpeg,png,jpg|max:2048',
    			'password' => 'sometimes|nullable|min:6|max:12',
    		]);
    		$input = array();
    		if($request->hasFile('profileImage')){
    			$image = $request->file('profileImage');

			    $input['profilePhoto'] = 'profile-photo-'.$app->userId.'.'.$image->getClientOriginalExtension();
			    $destinationPath = public_path('/profile-photos');
			    $image->move($destinationPath, $input['profilePhoto']);
    		}
    		$input['firstName'] = $request->input('firstName');
    		$input['lastName'] = $request->input('lastName');
    		$input['email'] = $request->input('email');
    		$input['phoneNumber'] = $request->input('phoneNumber');
    		if($request->input('password') != ''){
    			$input['password'] = md5($request->input('password'));
    		}
    		DB::table('jcm_users')->where('userId', $app->userId)->update($input);
    		$request->session()->flash('alert',['message' => 'Profile Updated', 'type' => 'success']);
    		return redirect('admin/settings/profile');
    	}else{
	    	$user = JobCallMe::getUser($app->userId);
	    	return view('admin.setting.profile',compact('user'));
	    }
    }

    public function website(Request $request){
    	@mkdir(public_path('website'),0700);
    	$app = session()->get('jcmAdmin');
    	$web = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
    	if($request->isMethod('post')){
    		$this->validate($request, [
    			'webTitle' => 'required|max:255',
                'phoneNumber' => 'required|numeric',
                'email' => 'required|max:255|email',
                'address' => 'required|max:255',
    			'webLogo' => 'image|mimes:jpeg,png,jpg|max:2048'
    		]);
    		$web['webTitle'] = $request->input('webTitle');
            $web['phoneNumber'] = $request->input('phoneNumber');
            $web['email'] = $request->input('email');
            $web['address'] = $request->input('address');
    		if($request->hasFile('webLogo')){
    			$image = $request->file('webLogo');

			    $web['webLogo'] = 'web-logo.'.$image->getClientOriginalExtension();
			    $destinationPath = public_path('/website');
			    $image->move($destinationPath, $web['webLogo']);
    		}
    		if($request->hasFile('webFavicon')){
    			$image = $request->file('webFavicon');
    			if($image->getClientOriginalExtension() != 'ico'){
    				$request->session()->flash('alert',['message' => 'Favicon image must be ico type', 'type' => 'danger']);
    				return redirect('admin/settings/website');
    			}

			    $web['webFavicon'] = 'web-favicon.'.$image->getClientOriginalExtension();
			    $destinationPath = public_path('/website');
			    $image->move($destinationPath, $web['webFavicon']);
    		}
    		if(!file_exists(public_path('website/web-setting.info'))){
	    		$handle = @fopen(public_path('website/web-setting.info'), 'w');
	    		@fclose($handle);
	    	}
	    	@file_put_contents(public_path('website/web-setting.info'), @json_encode($web));
    		$request->session()->flash('alert',['message' => 'Website Setting Saved', 'type' => 'success']);
    		return redirect('admin/settings/website');
    	}else{
    		return view('admin.setting.website',compact('web'));
	    }
    }

    public function accounts(){
        $mailgun = DB::table('jcm_accounts')->where('type','Mailgun')->first();
        $paypal = DB::table('jcm_accounts')->where('type','Paypal')->first();
    	return view('admin.setting.accounts',compact('mailgun','paypal'));
    }

    public function saveMailgun(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }

        $accountId = trim($request->input('accountId'));
        $secretKey = trim($request->input('secretKey'));
        $domain = trim($request->input('domain'));
        $fromEmail = trim($request->input('fromEmail'));
        $fromName = trim($request->input('fromName'));

        $fromEmail = strtolower(str_replace(array(' ',',','(',')','"',"'",':','~','`','&','%','*','^','#'), '', $fromEmail));

        $errors = '';
        if($secretKey == ''){
            $errors .= '<li>Please enter mailgun secret key.</li>';
        }
        if($domain == ''){
            $errors .= '<li>Please enter mailgun registered domain.</li>';
        }
        if($fromEmail == ''){
            $errors .= '<li>Please enter from email address.</li>';
        }else if(!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)){
            $errors .= '<li>Please enter valid email address.</li>';
        }
        if($fromName == ''){
            $errors .= '<li>Please enter from name.</li>';
        }

        $accountArr = array('secretKey' => $secretKey, 'domain' => $domain, 'fromEmail' => $fromEmail, 'fromName' => $fromName);

        $input = array('type' => 'Mailgun', 'modifiedTime' => date('Y-m-d H:i:s'), 'accountData' => @json_encode($accountArr));

        if($accountId != '0' && $accountId != ''){
            DB::table('jcm_accounts')->where('accountId','=',$accountId)->update($input);
            $sMsg = 'Mailgun Account Updated';
        }else{
            $input['createdTime'] = date('Y-m-d H:i:s');
            DB::table('jcm_accounts')->insert($input);
            $sMsg = 'New Mailgun Account Added';
        }

        $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
        exit('1');
    }

    public function savePaypal(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        //print_r($request->all());exit;

        $accountId = trim($request->input('accountId'));
        $mode = trim($request->input('mode'));
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
        $signature = trim($request->input('signature'));

        $errors = '';
        if($username == ''){
            $errors .= '<li>Please enter username.</li>';
        }
        if($password == ''){
            $errors .= '<li>Please enter password.</li>';
        }
        if($signature == ''){
            $errors .= '<li>Please enter signature.</li>';
        }

        $accountArr = array('mode' => $mode, 'username' => $username, 'password' => $password, 'signature' => $signature);

        $input = array('type' => 'Paypal', 'modifiedTime' => date('Y-m-d H:i:s'), 'accountData' => @json_encode($accountArr));

        if($accountId != '0' && $accountId != ''){
            DB::table('jcm_accounts')->where('accountId','=',$accountId)->update($input);
            $sMsg = 'Paypal Account Updated';
        }else{
            $input['createdTime'] = date('Y-m-d H:i:s');
            DB::table('jcm_accounts')->insert($input);
            $sMsg = 'New Paypal Account Added';
        }

        $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
        exit('1');
    }
}
