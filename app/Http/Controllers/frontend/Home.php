<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Sajid;
use Mail;
use App;
date_default_timezone_set("Asia/Seoul");
class Home extends Controller{

	public function home(){


		Sajid::IpBaseLang();		

		if(!\Session::has('loadOne')){
			$ip = \Request::ip();
			$position = \Location::get($ip);
			if($position->countryCode != 'KR'){
				\App::setLocale('en');
				\Session::put('locale', 'en');
				\Session::put('loadOne', 'yes');
			}
		}

		//print_r($position->countryCode);die;
		/* job shift query */
		$jobShifts = DB::table('jcm_job_shift')->get();

		/* companies query */
		$companies = DB::table('jcm_companies')->orderBy('companyId','desc')->limit(15)->get();

		/* jobs query */
		$premium = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','7')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		if(sizeof($premium) == 0){
		$premium = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','7')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		}
		
		/* jobs query top jobs */
		$top_jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','6')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		if(sizeof($top_jobs) == 0){
		$top_jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','6')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		}
		
		/* jobs query hot jobs */
		$hot = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','5')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		if(sizeof($hot) == 0){
		$hot = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','5')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		}
		
		$latest = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
			->where('jcm_jobs.p_Category','=','4')
			->where('jcm_jobs.status','=','1')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			->where('jcm_countries.sortname','=',$position->countryCode)
			->orderBy('jcm_jobs.jobId','desc')
			->limit(12)
			->get();
		if(sizeof($latest) == 0){
			$latest = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			->where('jcm_jobs.p_Category','=','4')
			->where('jcm_jobs.status','=','1')
			->orderBy('jcm_jobs.jobId','desc')
			->limit(12)
			->get();
		}
		$special = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
			->where('jcm_jobs.p_Category','=','3')
			->where('jcm_jobs.status','=','1')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			->where('jcm_countries.sortname','=',$position->countryCode)
			->orderBy('jcm_jobs.jobId','desc')
			->limit(12)
			->get();
		if(sizeof($special) == 0){
			$special = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->where('jcm_jobs.p_Category','=','3')
			->where('jcm_jobs.status','=','1')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			->orderBy('jcm_jobs.jobId','desc')
			->limit(12)
			->get();
		}

		$golden = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','2')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		if(sizeof($golden) == 0){
		$golden = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','2')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->orderBy('jcm_jobs.jobId','desc')
		->limit(12)->get();
		}
//return $companies;
		return view('frontend.home-page',compact('jobShifts','companies','premium','top_jobs','hot','latest','special','golden'));
	}
	public function nicepay(Request $request){
		//return $request->all();
		return "hello";
	}

	public function contactUs(Request $request){
		if($request->isMethod('post')){
			print_r($request->all());exit;
		} 
		return view('frontend.contact-us');
	}

	public function aboutUs(){
		$record = DB::table('jcm_cms_pages')->where('slug','about')->first();
		return view('frontend.about-us',compact('record'));
	}

	public function termConditions(){
		$record = DB::table('jcm_cms_pages')->where('slug','term-conditions')->first();
		return view('frontend.term-conditions',compact('record'));
	}
	
	public function advertisement(){
		$record = DB::table('jcm_cms_pages')->where('slug','companies-advertisement')->first();
		return view('frontend.companies-advertisement',compact('record'));
	}

	public function privacyPolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','privacy-policy')->first();
		return view('frontend.privacy-policy',compact('record'));
	}

	public function picturepolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','picture-policy')->first();
		return view('frontend.picture-policy',compact('record'));
	}

	public function refundpolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','refund-policy')->first();
		return view('frontend.refund-policy',compact('record'));
	}

	public function howtouse(){
		$record = DB::table('jcm_cms_pages')->where('slug','how-to-use')->first();
		return view('frontend.howtouse',compact('record'));
	}

	public function ReviewWrite(){
		$record = DB::table('jcm_cms_pages')->where('slug','review-write')->first();
		return view('frontend.review-write',compact('record'));
	}

	public function videochatpolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','video-chat-policy')->first();
		return view('frontend.video-chat-policy',compact('record'));
	}

	public function accountLogin(Request $request){
		
		if($request->session()->has('jcmUser')){
			$type = $request->session()->get('jcmUser')->type == 'Employer' ? 'employer' : 'jobseeker';
			return redirect('account/'.$type);
		}
		$next = $request->input('next');
		if($request->isMethod('post')){
			$email = $request->input('email');
			$password = $request->input('password');

			$error = '';
			if(trim($email) == ''){
				$error .= 'Email field is required';
			}
			if(trim($password) == ''){
				$error .= 'Password field is required';
			}
			if($error != ''){
				$request->session()->flash('loginAlert', $error);
				redirect('account/login');
			}

			$user = $this->doLogin($email,$password);
			if($user == 'invalid'){
				$request->session()->flash('loginAlert', trans('home.Invalid email/password'));
				if($next != ''){
					return redirect('account/login?next='.$next);
				}else{
					return redirect('account/login');
				}
			}
			else{
				if(JobCallMe::isResumeBuild($user->userId) == false){
					$fNotice = 'To apply on jobs please build your resume. <a href="'.url('account/jobseeker/resume').'">Click Here</a> To create your resume';
					$request->session()->put('fNotice',$fNotice);
				}
				$request->session()->put('jcmUser', $user);
				setcookie('cc_data', $user->userId, time() + (86400 * 30), "/");
				if($user->subscribe == 'N'){ 
					Session()->put('bell_color','#2e6da4'); 
				}else{ 
					session()->put('bell_color','#45c536'); 
				}
				if($next != ''){
					return redirect($next);
				}else{
					return redirect('account/jobseeker');
				}
			}
		}
		
		$pageType = \Request::segment('2');
		return view('frontend.login-registration',compact('pageType'));
	}

	public function doLogin($email,$password){
		/* do login */
		$user = DB::table('jcm_users')->where('email','=',$email)->where('password','=',md5($password))->where('user_status','Y')->where('type','<>','Admin')->first();
		if(count($user) == 0){
			return 'invalid';
		}else{
			return $user;
		}
		/* end */
	}

	public function accountRegister(Request $request){
		if($request->session()->has('jcmUser')){
			return redirect('account/jobseeker');
		}
		
		if($request->isMethod('post')){
			$this->validate($request,[
				'email' => 'required|email|unique:jcm_users,email',
				'password' => 'required|min:6|max:16',
				'firstName' => 'required|min:1|max:50',
				'lastName' => 'required|min:1|max:50',
				'country' => 'required',
				'state' => 'required',
				'phoneNumber' => 'required|digits_between:10,12',
			],[
				'email.unique' => trans('home.Email must be unique'),
				'email.required' => trans('home.Enter Email'),
				'firstName.required' => trans('home.Enter First Name'),
				'lastName.required' => trans('home.Enter Last Name'),
				'password.required' => trans('home.Enter password'),	
				'country.required' => trans('home.Enter Country'),
				'state.required' => trans('home.Enter State'),
				'phoneNumber.required' => trans('home.Enter Phone Number'),
				'phoneNumber.digits_between' => trans('home.Phone Number must be contain 10,12 digits'),
			]);
			$regdata['email'] = $request->input('email');
			$regdata['password'] = $request->input('password');
			$regdata['firstName'] = $request->input('firstName');
			$regdata['lastName'] = $request->input('lastName');
			$regdata['phoneNumber'] = $request->input('phoneNumber');
			session()->put('regdata',$regdata);
			$input['companyId'] = '0';
			$input['type'] = 'User';
			$input['secretId'] = JobCallMe::randomString();
			$input['firstName'] = trim($request->input('firstName'));
			$input['lastName'] = trim($request->input('lastName'));
			$input['email'] = trim($request->input('email'));
			$input['username'] = strtolower($request->input('firstName').$request->input('lastName').rand(00,99));
			$input['password'] = md5(trim($request->input('password')));
			$input['phoneNumber'] = trim($request->input('phoneNumber'));
			$input['country'] = $request->input('country');
			$input['state'] = $request->input('state');
			$input['city'] = $request->input('city');
			$input['subscribe'] = $request->input('jobalert');
			$input['profilePhoto'] = '';
			$input['about'] = '';
			$input['createdTime'] = date('Y-m-d H:i:s');
			$input['modifiedTime'] = date('Y-m-d H:i:s');
			
			$userId = DB::table('jcm_users')->insertGetId($input);
			setcookie('cc_data', $userId, time() + (86400 * 30), "/");
			extract($request->all());
			$cInput = array('companyName' => $firstName.' '.$lastName, 'companyEmail' => $email, 'companyPhoneNumber' => $phoneNumber, 'companyCountry' => $country, 'companyState' => $state, 'companyCity' => $city, 'category' => '0', 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
			$companyId = DB::table('jcm_companies')->insertGetId($cInput);

			DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId));
			/* end */
			$toemail = $input['email'];
			$secidtoview = array('id' => $input['secretId'],'Name' => $input['firstName'],'lastName' => $input['lastName']);
			Mail::send('emails.reg',$secidtoview,function($message) use ($toemail) {
				$message->to($toemail)->subject(trans('home.Account Verification'));
			});
			/*$user = $this->doLogin($request->input('email'),$request->input('password'));
			$request->session()->put('jcmUser', $user);*/
			$fNotice = trans('home.Please check your email to verify');
			
			$request->session()->put('fNotice',$fNotice);
			return redirect('account/register');
		}
		$pageType = \Request::segment('2');
		return view('frontend.login-registration',compact('pageType'));
	}

	public function logout(Request $request){
    	$request->session()->flush('jcmUser');
		$request->session()->flush('bell_color');
    	//$request->session()->destroy();
    	setcookie('cc_data', '', -time() + (86400 * 30), "/");
    	return redirect('');
    }

    public function manageUser(Request $request){
    	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	
    	$app = $request->session()->get('jcmUser');
    	$user = JobCallMe::getUser($app->userId);
    	$meta = JobCallMe::getUserMeta($app->userId);
    	$noti = JobCallMe::getAccountNotification($app->userId);
    	$privacy = JobCallMe::getPrivacySetting($app->userId);

    	return view('frontend.manage-user',compact('user','meta','noti','privacy'));
    }

    public function people(Request $request){
		$app = $request->session()->get('jcmUser');
    	$request->all();
    	/* peoples query */
    	$people = DB::table('jcm_users');
    	$people->select('*','privacy.profileImage as pImage');
    	$people->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
    	$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');
		$people->leftJoin('jcm_download','jcm_download.seeker_id','=','jcm_users.userId');
		//$people->leftJoin('jcm_resume','jcm_resume.userId','=','jcm_users.userId');

    	if($request->isMethod('post')){
    		if($request->input('keyword') != ''){
    			$people->where('jcm_users.firstName','like','%'.$request->input('keyword').'%');
    			$people->orWhere('jcm_users.lastName','like','%'.$request->input('keyword').'%');
				$people->orWhere('jcm_users.username','like','%'.$request->input('keyword').'%');
    		}
    		if($request->input('city') != ''){
    			$cityId = JobCallMe::cityId($request->input('city'));
	    		if($cityId != '0'){
		    		$people->where('jcm_users.city','=',$cityId);
		    	}
    		}
    	}else{
			if($request->input('city') != ''){
				if($request->input('city') == '000'){
	    			$people->where('jcm_users.country','!=','1');
				}else{
					$people->where('jcm_users.state','=',$request->input('city'));
				}
	    	}

	    	//if($request->input('city') != ''){
	    		//$people->where('jcm_users.city','=',$request->input('city'));
	    	//}
	    	if($request->input('industry') != ''){
	    		$people->where('jcm_users_meta.industry','=',$request->input('industry'));
	    	}
	    }

    	$people->where('privacy.profile','=','Yes');
    	//$people->limit(30);

		$people->where('jcm_users_meta.userId','!=','');
    	
    //	$people->limit(30);


    	$people->orderBy('jcm_users.userId','desc');
		$people->groupBy('jcm_users.userId');
		//$peopleget = $people->get();
    	$peoples = $people->paginate(18);
		//$userId = $peopleget->pluck('userId');
		// dd($items_name);
		
    	return view('frontend.people',compact('peoples'));
    }

 public function peoples(Request $request){
	//dd($request->all());
    	/* peoples query */
    	$people = DB::table('jcm_users');
    	$people->select('*','privacy.profileImage as pImage');
    	$people->rightJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
        $people->rightJoin('jcm_resume','jcm_resume.userId','=','jcm_users.userId');
		$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');

    	if($request->isMethod('post')){
    		if($request->input('keyword') != ''){
    			$people->where('jcm_users.firstName','like','%'.$request->input('keyword').'%');
    			$people->orWhere('jcm_users.lastName','like','%'.$request->input('keyword').'%');
    		}
    		if($request->input('city') != ''){
    			$cityId = JobCallMe::cityId($request->input('city'));
	    		if($cityId != '0'){
		    		$people->where('jcm_users.city','=',$cityId);
		    	}
    		}
			if($request->input('name') != ''){
    			$people->where('jcm_users.firstName','like','%'.$request->input('name').'%');
    			$people->orWhere('jcm_users.lastName','like','%'.$request->input('name').'%');
    		}
			if($request->input('category') != ''){
    			$people->where('jcm_users_meta.industry','=',$request->input('category'));
    		}
			if($request->input('country') != ''){
    			$people->where('jcm_users.country','=',$request->input('country'));
    		}
			if($request->input('state') != '' && $request->input('state') != '0'){
    			$people->where('jcm_users.state','=',$request->input('state'));
    		}
			if($request->input('citys') != '' && $request->input('citys') != '0'){
    			$people->where('jcm_users.city','=',$request->input('citys'));
    		}
			if($request->input('degreeLevel') != ''){
    			$people->where('jcm_resume.resumeData','like','%'.$request->input('degreeLevel').'%');
    		}
			if($request->input('degree') != ''){
    			$people->where('jcm_resume.resumeData','like','%'.$request->input('degree').'%');
    		}
                        if($request->input('minsalary') != ''){
    			$people->where('jcm_users_meta.currentSalary','=>',$request->input('minsalary'));
    		}
                        if($request->input('maxsalary') != ''){
    			$people->where('jcm_users_meta.expectedSalary','<=',$request->input('maxsalary'));
    		}
                        if($request->input('gender') != ''){
    			$people->where('jcm_users_meta.gender','=',$request->input('gender'));
    		}
                        if($request->input('maritalStatus') != ''){
    			$people->where('jcm_users_meta.maritalStatus','=',$request->input('maritalStatus'));
    		}
            
               
               
    	}else{
	    	if($request->input('city') != ''){
	    		$people->where('jcm_users.city','=',$request->input('city'));
	    	}
	    	if($request->input('industry') != ''){
	    		$people->where('jcm_users_meta.industry','=',$request->input('industry'));
	    	}
	    }
		$people->where('privacy.profile','=','Yes');
    	//$people->limit(30);

		$people->where('jcm_users_meta.userId','!=','');
    	$people->orderBy('jcm_users.userId','desc');
         $people->groupBy('jcm_users.userId');
    	$peoples = $people->paginate(18);
        // dd($peoples);

    	return view('frontend.people',compact('peoples'));
    }

    public function learn(Request $request){
		  //dd($request->all());  
    	/* read query */
    	$readQry = DB::table('jcm_upskills');
		$readQry->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_upskills.companyId');
		if($request->input('type') != ''){      
    	$readQry->where('jcm_upskills.type','=',ucfirst($request->input('type')));
    	}  
		$readQry->where('jcm_upskills.status','=','Active');
		$readQry->where('jcm_upskills.adstartDate','<=',date('Y-m-d'));
		$readQry->where('jcm_upskills.adendDate','>=',date('Y-m-d'));
		$readQry->orderBy('jcm_upskills.skillId','desc');
		$readQry->limit(12);
		$lear_record=$readQry->paginate(10);
//dd($lear_record);
    	return view('frontend.learn',compact('lear_record'));
    }

    public function read(Request $request){
    	/* read query */
    	$category = JobCallMe::getreadcat($request->input('category'));
    	$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_read_category','jcm_read_category.id','=','jcm_writings.category');
    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_read_category.name')->groupBy('jcm_writings.title');
    	if($request->input('category') != '0' && $request->input('category') != ''){
    		$readQry->where('jcm_writings.cat_names','LIKE','%'.$category.'%');
    	}
    	if($request->input('keyword') != ''){
    		$readQry->where('jcm_writings.title','LIKE','%'.$request->input('keyword').'%');
    	}
		$readQry->where('jcm_writings.status','Publish');
    	$readQry->orderBy('jcm_writings.writingId','desc');
    	$read_record = $readQry->paginate(12);
    	
    	return view('frontend.read',compact('read_record'));
    }

    public function viewArticle(Request $request,$writingId){
    	/* article query */
    	$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
    	$readQry->where('jcm_writings.writingId','=',$writingId);
    	$record = $readQry->first();

    	if(count($record) == 0){
    		return redirect('read');
    	}
        $read = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$read->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$read->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
		$read->limit(4);
		$read->inRandomOrder();
		$Qry=$read->get();
		//dd($Qry);
		/*comments on article */
		$comments = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$writingId)->where('table_name','read')->orderBy('jcm_comments.comment_id','desc')->get();
		
    	return view('frontend.view-article',compact('comments','writingId','record','Qry'));
    }

    public function viewUpskill(Request $request,$skillId){
    	$type = $request->segment(2);
    	/* upskill query */
    	$learnQry = DB::table('jcm_upskills')->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_upskills.companyId')->where('type','=',ucfirst($type));
    	$learnQry->where('skillId','=',$skillId);
    	$record = $learnQry->first();

    	if(count($record) == 0){
    		return redirect('learn');
    	}
     $Qry = DB::table('jcm_upskills')->limit(4)->inRandomOrder()->get();

     $comments = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$skillId)->where('table_name','learn')->orderBy('jcm_comments.comment_id','desc')->get();
	// dd($Qry);
    	return view('frontend.view-course',compact('comments','skillId','record','Qry'));
    }

    public function searchSkills(Request $request){  
    //dd($request->input('country'));     / search upskills /  
     
    $learnQry = DB::table('jcm_upskills'); 

    if($request->input('type') != ''){      
    	$learnQry->where('type','=',ucfirst($request->input('type')));
    	}         
    	if($request->input('keyword') != ''){      
    		$learnQry->where('title','LIKE','%'.$request->input('keyword').'%'); 
    		}  
    		if($request->input('city') != ''){      
    			$cityId = JobCallMe::cityId($request->input('city'));      
    			if($cityId != '0'){       
    				$learnQry->where('city','=',$cityId);      
    			}     
    		}  

    			if($request->input('country') != ''){             
    				$learnQry->where('country','=',$request->input('country'));               }     
    				$record = $learnQry->orderBy('skillId','desc')->paginate(30);     return view('frontend.search-learn',compact('record'));    
	}


    public function companies(Request $request){
    	/* companies query */
    	$company = DB::table('jcm_companies');
    	
    	if($request->isMethod('post')){
    		if($request->input('keyword') != ''){
    			$company->where('companyName','like','%'.$request->input('keyword').'%');
    		}
    		if($request->input('city') != ''){
    			$cityId = JobCallMe::cityId($request->input('city'));
	    		if($cityId != '0'){
		    		$company->where('companyCity','=',$cityId);
		    	}
    		}
    	}
    	if($request->input('in') != ''){
    		$company->where('category','=',$request->input('in'));
    	}
		$company->where('jcm_companies.category','!=','');
    	
    	$company->orderBy('package','desc');
    	$company->orderBy('companyModifiedTime','desc');
    	
    	$companies = $company->paginate(30);
		
    	return view('frontend.view-companies',compact('companies'));
    }

    public function viewCompany(Request $request,$companyId){
    	$company = DB::table('jcm_companies')->where('companyId','=',$companyId)->first();


    	$jobs = DB::table('jcm_jobs')->where('companyId','=',$companyId)->limit(10)->get();

    	$followArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
			$followArr = @explode(',', $meta->follow);
		}
		$companyReview = DB::table('jcm_companyreview')->leftJoin('jcm_users','jcm_users.userId','=','jcm_companyreview.user_id')->where('company_id','=',$companyId)->get();
		
    	return view('frontend.show-company',compact('company','jobs','followArr','companyReview'));
    }

    public function sendFeedback(Request $request){
    	$message = trim($request->input('message'));
    	$type = trim($request->input('type'));
    	echo @json_encode(array('status' => 'success'));
    }
	 public function sendquery(Request $request){
    	//dd($request->all());
		$input['email']=$request->email;
		$input['message']=$request->msg;
		$input['type']='Query';
		$request->session()->put('query','Thank you for contact us');
		DB::table('feedback')->insert($input);
		return back()->withInput();
    }
	/* the below code written fo subscribe functionality*/
    public function subscribe(Request $request){

    	/* check if person is login or not*/
	  if(session()->has('jcmUser')){
	  	/* get user id and on that it get user data*/
	  	$userId = \Session::get('jcmUser')->userId;
	  	$subscribe = DB::table('jcm_users')->where('userId','=',$userId)->first();
	  	/* check if user subscribe then change to unsubscribe else subscribe*/
	  	if($subscribe->subscribe == 'N'){
	  		DB::table('jcm_users')->where('userId','=',$userId)->update(array('subscribe' => 'Y'));
	  		Session()->put('bell_color','#45c536');
	  		//echo session('bell_color');die;
	  	}else{
	  		DB::table('jcm_users')->where('userId','=',$userId)->update(array('subscribe' => 'N'));
	  		session()->put('bell_color','#2e6da4');
	  		//echo session('bell_color');die;
	  	}
	  	/*here after updating the database redirect to home page*/
	  	return redirect('/');
	  }else{
	  	$request->session()->flash('subscribeAlert', trans('home.please login to subscribe'));
	  	return redirect('account/login');
	  }
}

public function getjobnotifications(Request $request){
	if(!session()->has('jcmUser')){
		return redirect('account/login');
	}

	$userid = session()->get('jcmUser')->userId;
	$getCat = DB::table('jcm_users_meta')->where('userId',$userid)->first()->industry;
	$jobs = DB::table('jcm_jobs')->where('category',$getCat)->get();
	$jobstoview = array('jobs' => $jobs);
	$currentDate = \Carbon\Carbon::now();
	print_r($currentDate->toDateTimeString());die;
	Mail::send('emails.jobs',$jobstoview,function($message){
		$message->to(session()->get('jcmUser')->email)->subject('Latest jobs');
	});
}
public function feedback(Request $request){
		$data['email'] = $request->input('email');
		$data['type'] = $request->input('type');
		$data['message'] = $request->input('message');
		DB::table('feedback')->insert($data);
}
public function getfeedback(Request $request){
		$data = DB::table('feedback')->get();
		return view('admin.users.feedback',compact('data'));
}
public function editfeedback(Request $request){
	$id = $request->input('id');
	$data = DB::table('feedback')->where('id',$id)->first();
	echo json_encode($data);
}

public function deletefeedback(Request $request){
	$id = $request->input('id');
	if(DB::table('feedback')->where('id',$id)->delete()){
		echo 1;
	}else{
		echo 2;
	}

}
public function readCat(){
		$data = DB::table('jcm_read_category')->get();
       return view('admin.users.readcat',compact('data'));
}
public function addreadCat(Request $request){
	if(!$request->input('id')){
		$name = $request->input('name');
		$data = array('name' => $name);
		if(DB::table('jcm_read_category')->insert($data)){
			echo 1;
		}else{
			echo 2;
		}
	}else{
		$id = $request->input('id');
		$name = $request->input('name');
		$data = array('name' => $name);
		if(DB::table('jcm_read_category')->where('id',$id)->update($data)){
			echo 1;
		}else{
			echo 2;
		}
	}
}
public function deletereadCat(Request $request){
	$id = $request->input('id');
	if(DB::table('jcm_read_category')->where('id',$id)->delete()){
		echo 1;
	}else{
		echo 2;
	}
}
public function verifyUser(Request $request){
	$secretId = trim($request->segment(2));
	$data = DB::table('jcm_users')->where('secretId',$secretId)->first();
	if($data > 0){
		
		DB::table('jcm_users')->where('secretId',$secretId)->update(['user_status' => 'Y']);
		$request->session()->flash('emailAlert', trans('home.Your account is Verified Please Login'));
		return redirect('account/login');
	}else{
		echo "There is a issue in your secret code kindly contact with administration thanks";
	}
}
public function changepropic(Request $request){
	$userid = $request->input('userId');
	$imagelink = $request->input('imagelink');
	$oldImageName = pathinfo($imagelink);
	$image = $_FILES['profileImage'];
	$tmp = $image['tmp_name'];
	$newfile = $oldImageName['basename'];
	unlink('profile-photos/'.$newfile);
	move_uploaded_file($tmp, 'profile-photos/'.$newfile);
	/*DB::table('jcm_users')->where('userId',$userid)->update(['profileImage' => $profileImage,'profilePhoto'=>'']);*/

}
public function changecompanypropic(Request $request){
	$userid = $request->input('userId');
	$imagelink = $request->input('imagelink');
	$oldImageName = pathinfo($imagelink);
	$image = $_FILES['profileImage'];
	$tmp = $image['tmp_name'];
	$newfile = $oldImageName['basename'];
	unlink('compnay-logo/'.$newfile);
	move_uploaded_file($tmp,'compnay-logo/'.$newfile);
	/*DB::table('jcm_users')->where('userId',$userid)->update(['profileImage' => $profileImage,'profilePhoto'=>'']);*/

}
public function removeCompanyProPic(Request $request){
	 $comId = session()->get('jcmUser')->companyId;
	 
	if( DB::table('jcm_companies')->where('companyId',$comId)->update(['companyLogo'=>''])){
		echo 1;
	}else{
		echo 2;
	}
}
public function deactiveUser(Request $request){
	$id = $request->input('id');
	if(DB::table('jcm_users')->where('userId','=',$id)->update(['user_status'=>'N'])){
		$data = DB::table('jcm_users')->where('userId','=',$id)->first();
		DB::table('jcm_companies')->where('companyId','=',$data->companyId)->update(['companyStatus'=>'Inactive']);

		$request->session()->flush('jcmUser');
		$request->session()->flash('loginAlert', trans('home.Your Account is Deactivated for activation contact Administration thanks'));
		   echo 1;
	}else{
		echo 'error in home controller line number 598';
	}
}
public function regvalpass(Request $request){
	echo JobCallMe::registrationPassValidation($request->input('password'));
}
public function savecompic(Request $request){
	$data = $request->input('comppics');
	$comId = session()->get('jcmUser')->companyId;
	if( DB::table('jcm_companies')->where('companyId',$comId)->update(['companypics'=> $data])){
		echo 1;
	}else{
		echo 2;
	}
}
  public function after_payment(Request $request, $id){
    	$userinfo = session()->get('jcmUser');
    	//$request->session()->destroy();
		$makeorder= DB::table('jcm_orders')->where('status','=','pending')->where('payment_mode','=','Cash Payment')->where('order_id','=',$id)->get();
		$order=$makeorder[0];
		//dd($order);
    	return view('frontend.after_payment',compact('userinfo','order'));
    }
	  public function make_payment(Request $request){
		  $input=$request->all();
		  $userinfo = session()->get('jcmUser');
		  $name=$userinfo->firstName.' '.$userinfo->lastName;
		  $email=$userinfo->email;
		  $phone=$userinfo->phoneNumber;
		  $input['user_id']=$userinfo->userId;
		  $input['name']=$name;
		  $input['email']=$email;
		  $input['phonenum']=$phone;
		  $data=DB::table('jcm_make_payment')->insert($input);

		  return view('frontend.Completed');

    	
    }
    public function likes(Request $request,$type){
    	$data = $request->input();
    	unset($data['_token']);
    	if($type == "like"){
    		DB::table('jcm_likes')->insert($data);
    	}else{
    		DB::table('jcm_likes')->where('parent_table',$data['parent_table'])->where('post_id',$data['post_id'])->where('user_id',$data['user_id'])->delete();
    	}
    }

}
?>