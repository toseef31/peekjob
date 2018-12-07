<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;

class Users extends Controller{
    public function viewUsers(Request $request){
    	$app = session()->get('jcmAdmin');
    	if($request->isMethod('post')){
    		$request->session()->put('employersSearch',$request->all());
    	}

    	if($request->input('reset') && $request->input('reset') == 'true'){
    		$request->session()->forget('employersSearch');
    		return redirect('admin/users/view');
    	}

    	/* employers query*/
        $s_app = $request->session()->get('employersSearch');
    	$users = DB::table('jcm_users')->where('type','=','User')
                    ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where($s_app['searchBy'], 'like', '%'.$s_app['search'].'%');
                            }
                            if($s_app['status'] != '' && $s_app['status'] != 'All'){
                                $query->where('status', '=', $s_app['status']);
                            }
                        }
                    })->orderBy('userId','desc')->paginate(30);
    	//echo '<pre>'; print_r($users);exit;
    	/* end */
    	return view('admin.users.employers',compact('users'));
    }

    public function addEditUser(Request $request){
        $userId = 0;
        $rPath = $request->segment(3);
        $companies = JobCallMe::getUserCompanies();
        if($request->isMethod('post')){
            $userId = $request->input('userId',0);
            $this->validate($request, [
                'firstName' => 'required|max:100',
                'lastName' => 'required|max:100',
                'email' => 'required|email|max:255',
                'phoneNumber' => 'required|digits_between:10,12',
                'username' => 'required|max:50',
                'password' => 'sometimes|nullable|min:6|max:16',
                'about' => 'required|max:800',
            ],
            [
                'about.required' => 'about field is required',
                'about.max'      => 'About Employer must be less then 800 characters',
                'firstName.max'  => 'First name just be less then 100 characters',
                'phoneNumber.digits_between'  => 'Phone Number must be 10 to 12 digits',
                'password.min'  => 'minimum password contain 6 char',
                'password.max'  => 'maximum password contain 16 char',
            ]
            );
            if($userId == '0'){
                $this->validate($request, [
                    'password' => 'required|min:6|max:16',
                    'email' => 'required|email|max:255|unique:jcm_users',
                    'username' => 'required|max:50|unique:jcm_users',
                    'profilePhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
            }else{
                $isUsernameExist = JobCallMe::isUsernameExist($request->input('username'),$userId);
                if($isUsernameExist){
                    $request->session()->flash('alert',['message' => 'The username has already been taken.', 'type' => 'danger']);
                    return redirect(url()->previous());
                }

                $isEmailExist = JobCallMe::isEmailExist($request->input('email'),$userId);
                if($isEmailExist){
                    $request->session()->flash('alert',['message' => 'The email has already been taken.', 'type' => 'danger']);
                    return redirect(url()->previous());
                }
            }
            $input = array();
            if($request->hasFile('profilePhoto')){
                $image = $request->file('profilePhoto');

                $input['profilePhoto'] = 'profile-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/profile-photos');
                $image->move($destinationPath, $input['profilePhoto']);

                if($request->input('prevLogo') != ''){
                    @unlink(public_path('/profile-photos/'.$request->input('prevLogo')));
                }
            }else{
                $input['profilePhoto'] = $request->input('prevLogo');
            }

            $input['companyId'] = $request->input('companyId');
            $input['firstName'] = $request->input('firstName');
            $input['lastName'] = $request->input('lastName');
            $input['phoneNumber'] = $request->input('phoneNumber');
            $input['email'] = $request->input('email');
            $input['username'] = $request->input('username');
            if($request->input('password') != '' && $request->input('password') != NULL){
                $input['password'] = md5($request->input('password'));
            }
            $input['user_status'] = $request->input('status');
            $input['about'] = $request->input('about');
            $input['type'] = 'User';
            $input['modifiedTime'] = date('Y-m-d H:i:s');
            if($userId == '0'){
                $input['secretId'] = JobCallMe::randomString();
                $input['createdTime'] = date('Y-m-d H:i:s');

                $userId = DB::table('jcm_users')->insertGetId($input);
                $sMsg = 'New Employer Added';
            }else{
                DB::table('jcm_users')->where('userId', $userId)->update($input);
                $sMsg = 'Employer Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('admin/users/view/'.$userId);
        }else{
            $user = array();
            $userId = '0';
            if($rPath == 'edit'){
                $userId = $request->segment(4);
                $user = JobCallMe::getUser($userId);
                if(count($user) == 0){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('admin/users/view');
                }
                $user = (array) $user;
            }
            return view('admin.users.add-edit-employer',compact('companies','user','rPath','userId'));
        }
    }

    public function viewSingleUser(Request $request){
        $userId = trim($request->segment(4));
        $user = JobCallMe::getUser($userId);
        if(count($user) == 0){
            $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
            return redirect('admin/users/view');
        }
        return view('admin.users.view-employer',compact('user'));
    }

    public function deleteUser(Request $request){
    	if($request->isMethod('delete')){
    		$userId = trim($request->input('userId'));
            
            $user = JobCallMe::getUser($userId);
            @unlink(public_path('/profile-photos/'.$user->profilePhoto));

    		DB::table('jcm_users')->where('userId',$userId)->delete();
    		$request->session()->flash('alert',['message' => $user->type.' Deleted','type' => 'success']);
    	}
    	return redirect(url()->previous());
    }

    public function companies(Request $request){
        if($request->isMethod('post')){
            $request->session()->put('companySearch',$request->all());
        }

        if($request->input('reset') && $request->input('reset') == 'true'){
            $request->session()->forget('companySearch');
            return redirect('admin/users/company');
        }

        /* job seekers query*/
        $s_app = $request->session()->get('companySearch');
        $companies = DB::table('jcm_companies')
                        ->where(function ($query) use ($s_app) {
                            if(count($s_app) > 0){
                                if($s_app['search'] != ''){
                                    $query->where($s_app['searchBy'], 'like', '%'.$s_app['search'].'%');
                                }
                                if($s_app['status'] != '' && $s_app['status'] != 'All'){
                                    $query->where('companyStatus', '=', $s_app['status']);
                                }
                            }
                        })->orderBy('companyId','desc')->paginate(30);
        //echo '<pre>'; print_r($users);exit;
        /* end */

        return view('admin.users.companies',compact('companies'));
    }

    public function addEditCompany(Request $request){
        $app = session()->get('jcmAdmin');
        $rPath = $request->segment(4);
        if($request->isMethod('post')){
            $companyId = $request->input('companyId',0);
            $this->validate($request, [
                'companyName' => 'required|max:100',
                'companyEmail' => 'required|email|max:255',
                'companyPhoneNumber' => 'required|digits_between:10,12',
                'companyWebsite' => 'required|url|max:255',
                'companyLogo' => 'image|mimes:jpeg,png,jpg|max:2048',
                'companyCover' => 'image|mimes:jpeg,png,jpg|max:2048',
                'companyAddress' => 'required|max:100',
                'companyCountry' => 'required',
                'companyCity' => 'required',
                'companyNoOfUsers' => 'digits_between:0,5000',
                'companyEstablishDate' => 'required|date_format:Y-m-d',
                'companyAbout' => 'required|max:800',
                'companyFb' => 'sometimes|nullable|url|max:255',
                'companyTwitter' => 'sometimes|nullable|url|max:255',
                'companyLinkedin' => 'sometimes|nullable|url|max:255',
            ]);
            $input = array();
            if($request->hasFile('companyLogo')){
                $image = $request->file('companyLogo');

                $input['companyLogo'] = time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/compnay-logo');
                $image->move($destinationPath, $input['companyLogo']);

                if($request->input('prevLogo') != ''){
                    @unlink(public_path('/compnay-logo/'.$request->input('prevLogo')));
                }
            }else{
                $input['companyLogo'] = $request->input('prevLogo');
            }
            if($request->hasFile('companyCover')){
                $image = $request->file('companyCover');

                $input['companyCover'] = time().'-'.rand(0000000,9999999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/compnay-logo');
                $image->move($destinationPath, $input['companyCover']);

                if($request->input('prevCover') != ''){
                    @unlink(public_path('/compnay-logo/'.$request->input('prevCover')));
                }
            }else{
                $input['companyCover'] = $request->input('prevCover');
            }

            $input['companyName'] = $request->input('companyName');
            $input['companyEmail'] = $request->input('companyEmail');
            $input['companyPhoneNumber'] = $request->input('companyPhoneNumber');
            $input['companyAddress'] = $request->input('companyAddress');
            $input['companyCountry'] = $request->input('companyCountry');
            $input['companyCity'] = $request->input('companyCity');
            $input['companyNoOfUsers'] = $request->input('companyNoOfUsers');
            $input['companyEstablishDate'] = $request->input('companyEstablishDate');
            $input['companyAbout'] = $request->input('companyAbout');
            $input['companyStatus'] = $request->input('companyStatus');
            $input['companyWebsite'] = $request->input('companyWebsite');
            if($request->input('companyFb') == NULL){
                $input['companyFb'] = '';
            }else{
                $input['companyFb'] = $request->input('companyFb');
            }
            if($request->input('companyTwitter') == NULL){
                $input['companyTwitter'] = '';
            }else{
                $input['companyTwitter'] = $request->input('companyTwitter');
            }
            if($request->input('companyLinkedin') == NULL){
                $input['companyLinkedin'] = '';
            }else{
                $input['companyLinkedin'] = $request->input('companyLinkedin');
            }
            $input['companyModifiedTime'] = date('Y-m-d H:i:s');
            $username = strtolower(str_replace(array(' ',')','(','-','_',',','"','`','!','|','@','#','&','%','^'),'',$request->input('companyName')));
             $input['companyUsername'] = $username;
            if($companyId == '0'){
                $input['companyCreatedTime'] = date('Y-m-d H:i:s');

                $companyId = DB::table('jcm_companies')->insertGetId($input);
                $sMsg = 'New Company Added';
            }else{
                DB::table('jcm_companies')->where('companyId', $companyId)->update($input);
                $sMsg = 'Company Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('admin/users/company/'.$companyId);
        }else{
            $company = array();
            $companyId = '0';
            if($rPath == 'edit'){
                $companyId = $request->segment(5);
                $company = JobCallMe::getCompany($companyId);
                if(count($company) == 0){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('admin/users/company');
                }
                $company = (array) $company;
            }
            return view('admin.users.add-edit-company',compact('company','rPath','companyId'));
        }
    }

    public function viewCompany(Request $request){
        $companyId = trim($request->segment(4));
        $company = JobCallMe::getCompany($companyId);
        if(count($company) == 0){
            $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
            return redirect('admin/users/company');
        }
        return view('admin.users.view-company',compact('company'));
    }

    public function deleteCompany(Request $request){
        if($request->isMethod('delete')){
            $companyId = trim($request->input('companyId'));
            $company = JobCallMe::getCompany($companyId);

            @unlink(public_path('/compnay-logo/'.$company->companyLogo));
            @unlink(public_path('/compnay-logo/'.$company->companyCover));
            
            DB::table('jcm_companies')->where('companyId',$companyId)->delete();
            $request->session()->flash('alert',['message' => 'Company Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }
   
}
