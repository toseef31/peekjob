<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Home extends Controller{
	public function __construct(){
		if(session()->has('jcmAdmin')){
			return redirect('admin/dashboard');
		}
	}

    public function login(Request $request){
    	if(session()->has('jcmAdmin')){
			return redirect('admin/dashboard');
		}

    	if($request->isMethod('post')){
    		$username = $request->input('username');
    		$password = $request->input('password');

    		/* login query */
            $user = DB::table('jcm_users')
    					->where('type','=','Admin')
    					->where('status','=','Active')
    					->where('password','=',md5($password))
    					->where(function ($query) use ($username) {
    						$query->where('username', '=', $username)
    						->orWhere('email', '=', $username);
    					})->first();

            /* query end */

    		if(count($user) == 0){
    			$request->session()->flash('loginError', 'username / password invalid');
    			return redirect('admin/login');
    		}else{
    			$request->session()->put('jcmAdmin', $user);
    			return redirect('admin/dashboard');
    		}
    	}
        /* is admin */
        $admin = DB::table('jcm_users')->where('type','=','Admin')->get();
        if(count($admin) == 0){
            return redirect('admin/register');
        }else{
            return view('admin.login-page');
        }
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                    'firstName' => 'required',
                    'lastName' => 'required',
                    'email' => 'required|email',
                    'phoneNumber' => 'required|numeric|min:10',
                    'password' => 'required|min:6',
                ]);

            extract($request->all());
            $input = array('firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phoneNumber' => $phoneNumber, 'username' => 'admin', 'type' => 'Admin', 'password' => md5($password), 'createdTime' => date('Y-m-d H:i:s'), 'modifiedTime' => date('Y-m-d H:i:s'));

            DB::table('jcm_users')->insert($input);
            return redirect('admin/login');
        }
        $admin = DB::table('jcm_users')->where('type','=','Admin')->get();
        if(count($admin) > 0){
            return redirect('admin/login');
        }else{
           return view('admin.register-page');
        }
    }

    public function forgetPassword(){
    	return view('admin.login-page');
    }

    public function logout(Request $request){
    	$request->session()->flush();
    	//$request->session()->destroy();
    	return redirect('admin/login');
    }
	
	
}
