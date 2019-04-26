<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use App\Http\Requests;
use App\review;
use DB;
use PDF;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Mapper;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Jobs;

class Employer extends Controller{
	/*paypal*/
	 private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */

	 
	 
    public function payWithPaypal()
    {
        return view('frontend.employer.share-job');
		//return view('frontend.employer.payment');
    }
	
	  public function payWithPaypals()
    {
      
		return view('frontend.employer.payment');
    }
	
	  public function updatepayWithPaypals()
    {
      
		return view('frontend.employer.update-payment');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	   public function post(Request $request)
    {
		// $count=$request->goodscount;
		// $gname=$request->goodsName;
		// $price=$request->price;
		// $bname=$request->buyerName;
		// $tel=$request->tel;
		// $email=$request->Email;
		$price=Session::get('amount');
		$mul=$price*1100;
		$goodsname = Session::get('p_Category');
		$app = $request->session()->get('jcmUser');
		
		$data = http_build_query(array('goodscount' => '1',
		'goodsName' => $goodsname,
		'price' => $mul,
		'buyerName' => $app->firstName,
		'tel' => $app->phoneNumber,
		'Email' => $app->email));
		//dd($data);
		
		$url = "http://peekinternational.com/demos/nicepay/payRequest_utf.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTREDIR, 3);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
var_dump($server_output);
curl_close ($ch);
	}
	 
	 
    public function postPaymentWithpaypals(Request $request)
    {
	//dd($request->draft);
	$this->validate($request,[
				'title' => 'required|max:255',
				'department' => 'required',
				'category' => 'required',
				//'careerLevel' => 'required',
				'experience' => 'required',
				'vacancy' => 'required|numeric',
				'description' => 'required',
				'skills' => 'required|max:1024',
				'qualification' => 'required',
				'expiryDate' => 'required|date',
				//'minSalary' => 'numeric',
				//'maxSalary' => 'numeric',
				'state' => 'required',
				'city' => 'required',
				'Address' => 'required',
			],[
				
				'description.required' => trans('home.description is requried'),
				'skills.max:1024' => 'Skills Limit Across',
				'skills.required' => trans('home.Skills is requried'),
				'title.required' => 'Title is requried',
				'department.required' => 'department is requried',
				'category.required' => 'category is requried',
				'qualification.required' => 'qualification is requried',
				'state.required' => 'state is requried',
				'Address.required' => trans('home.Address is required'),
				
			]);
	
   
		extract($request->all());

	   $rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	   $amount=$rec[0]->price;
	   //dd();
	   $durations= $amount*$request->duration;

        $mul=$durations;
        $am=$mul*1100;
      //  dd($am);
	    $request->session()->put('p_Category', $request->p_Category);
        $goodsname = Session::get('p_Category');
        $app = $request->session()->get('jcmUser');
		//dd($request->department);
		$request->session()->put('amount', $durations);
		$request->session()->put('title', $request->title);
		$request->session()->put('jobaddr', $request->jobaddr);
		$request->session()->put('head', $request->head);
		$request->session()->put('dispatch', $request->dispatch);
		$request->session()->put('jType', 'Paid');
		$request->session()->put('department', $request->department);
		$request->session()->put('category', $request->category);
	
		$request->session()->put('careerLevel', $request->careerLevel);
		$request->session()->put('experience', $request->experience);
		$request->session()->put('vacancy', $request->vacancy);
		$request->session()->put('description', $request->description);
		$request->session()->put('skills', $request->skills);
		$request->session()->put('qualification', $request->qualification);
		$request->session()->put('expiryDate', $request->expiryDate);
		$request->session()->put('minSalary', $request->minSalary);
		$request->session()->put('maxSalary', $request->maxSalary);
		$request->session()->put('description', $request->description);
		$request->session()->put('type', $request->type);
		$request->session()->put('currency', $request->currency);
		$request->session()->put('benefits', $request->benefits);
		$request->session()->put('process', $request->process);
		$request->session()->put('state', $request->state);
		$request->session()->put('city', $request->city);
		$request->session()->put('country', $request->country);
		$request->session()->put('Address', $request->Address);
		$request->session()->put('Address2', $request->Address2);
		$request->session()->put('shift', $request->shift);
		$request->session()->put('duration', $request->duration);
		$request->session()->put('expiryDate', $request->expiryDate);
		$request->session()->put('expiryAd', $request->expiryAd);
		$request->session()->put('responsibilities', $request->responsibilities);   //밑에까지 전부
	
		$request->session()->put('jobacademic', $request->jobacademic);
		$request->session()->put('jobacademic_not', $request->jobacademic_not);
		$request->session()->put('jobgraduate', $request->jobgraduate);
		$request->session()->put('gender', $request->gender);
		$request->session()->put('jobage1', $request->jobage1);
		$request->session()->put('jobage2', $request->jobage2);
		$request->session()->put('jobnoage', $request->jobnoage);

		$request->session()->put('afterinterview', $request->afterinterview);

		if($questionaire_id){
		//	$input['questionaire_id'] = $questionaire_id;
			$request->session()->put('questionaire_id', $questionaire_id);
		}
		
		
		 $goodsname = Session::get('p_Category');
		 $plan=$request->plan;
	//dd($request);
if($request->draft){
	if($plan != null && $plan != '')
		{       
			$name =$request->allarray;
			    $result_explode = explode('|', $name);
				
				$p_category = $result_explode[0];
				$pckg_id = $result_explode[1];
				$price= $result_explode[2];
				$dur= $result_explode[3];
				$quantity= $result_explode[4];
				//dd($duration);

				$date = strtotime('+'.$dur.' day');
                $expiry= date('Y-m-d', $date);
			
				$request->merge(['jType'=>'Paid']);
				$app = $request->session()->get('jcmUser');

		$input = array(
			'userId' => $app->userId,
			'companyId' => $app->companyId,
			'status' => '1',
			'pckg_id' => $pckg_id,
			'jobStatus' => 'Draft',
			'paymentType' => '4',
			'amount' => $price,
			'p_Category' => $p_category,
			'title' => $title,
			'jType' => 'Paid',
			'dispatch' => $dispatch,
			'head' => $head,
			'department' => $department,
			'duration' => $dur,
			'category' => $category,
			'subCategory' => $subCategory,
			'careerLevel' => $careerLevel,
			'experience' => $experience,
			'vacancies' => $vacancy,
			'description' => $description,
			'skills' => $skills,
			'qualification' => $qualification,
			'jobType' => $type,
			'responsibilities' => $responsibilities,
			'jobShift' => $shift,
			'jobaddr' => $jobaddr,
			'minSalary' => $minSalary,
			'maxSalary' => $maxSalary,
			'afterinterview' => $afterinterview,
			'currency' => $currency,
			'benefits' => rtrim(@implode(',', $request->input('benefits')),','),
			'process' => rtrim(@implode(',', $request->input('process')),','),
			'jobacademic' => $jobacademic,
			'jobacademic_not' => $jobacademic_not,
			'jobgraduate' => $jobgraduate,
			'gender' => $gender,
			'jobage1' => $jobage1,
			'jobage2' => $jobage2,
			'jobnoage' => $jobnoage,			
			'country' => $country,
			'state' => $state,
			'city' => $city,
			'Address' => $Address,
			'Address2' => $Address2,
			'expiryDate' => $expiryDate,
			'expiryAd' => $expiry,
			'createdTime' => date('Y-m-d H:i:s'));



		//dd($input);
		if($questionaire_id){
			$input['questionaire_id'] = $questionaire_id;
		}
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		 
		 $remain =$quantity-1;
		 $inputs['quantity']=$remain;

		DB::table('jcm_save_packeges')->where('user_id','=',$app->userId)->where('id','=',$pckg_id)->update($inputs);
        
	//	DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_category,'companyModifiedTime'=>date('Y-m-d H:i:s')]);   

		//dd($jobId);
		\Session::put('success',trans('home.Add Job Successfully To Draft'));
		return Redirect::route('addmoney.account/employer/job/share');	
		}
		
		elseif($amount!='0')
		{
			$request->merge(['jType'=>'Paid']);
		}
		if($amount=='0')
		{
			$request->merge(['jType'=>'Free']);
				$app = $request->session()->get('jcmUser');

	
   
		extract($request->all());
		//dd($request->all());

			


		$input = array(
			'userId' => $app->userId,
			 'companyId' => $app->companyId,
			 'status' => '1',
			 'jobStatus' => 'Draft',
			 'paymentType' => '0',
			 'amount' => $amount,
			 'p_Category' => $p_Category,
			 'title' => $title,
			 'jType' => $jType,
			 'dispatch' => $dispatch,
			'head' => $head,
			'department' => $department,
			'duration' => $duration,
			 'category' => $category,
			 'subCategory' => $subCategory,
			 'careerLevel' => $careerLevel,
			 'experience' => $experience,
			 'vacancies' => $vacancy,
			 'description' => $description,
			 'skills' => $skills,
			 'qualification' => $qualification,
			 'jobType' => $type,
			 'responsibilities' => $responsibilities,		
			 'jobShift' => $shift,
			 'jobaddr' => $jobaddr,
			 'minSalary' => $minSalary,
			 'maxSalary' => $maxSalary,
			 'afterinterview' => $afterinterview,
			 'currency' => $currency,
			 'benefits' => rtrim(@implode(',', $request->input('benefits')),','),
			  'process' => rtrim(@implode(',', $request->input('process')),','),
			   'jobacademic' => $jobacademic,
			    'jobacademic_not' => $jobacademic_not,
			    'jobgraduate' => $jobgraduate,
			    'gender' => $gender,
			    'jobage1' => $jobage1,
			    'jobage2' => $jobage2,
			    'jobnoage' => $jobnoage,			 
			    'country' => $country,
			    'state' => $state,
			    'city' => $city,
			    'Address' => $Address,
			   'Address2' => $Address2,
			    'expiryDate' => $expiryDate,
			    'expiryAd' => $expiryAd,
			    'createdTime' => date('Y-m-d H:i:s'));

		if($questionaire_id){
			$input['questionaire_id'] = $questionaire_id;
		}


		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		//DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_Category,'companyModifiedTime'=>date('Y-m-d H:i:s')]); 
		//dd($jobId);
		\Session::put('success',trans('home.Add Job Successfully To Draft'));
		return Redirect::route('addmoney.account/employer/job/share');	
		}	
		else{




		$input = array(
			'userId' => $app->userId,
			 'companyId' => $app->companyId,
			 'status' => '1',
			 'jobStatus' => 'Draft',
			 'paymentType' => '0',
			 'amount' => $amount,
			 'p_Category' => $p_Category,
			 'title' => $title,
			 'jType' => $jType,
			 'dispatch' => $dispatch,
			'head' => $head,
			'department' => $department,
			'duration' => $duration,
			 'category' => $category,
			 'subCategory' => $subCategory,
			 'careerLevel' => $careerLevel,
			 'experience' => $experience,
			 'vacancies' => $vacancy,
			 'description' => $description,
			 'skills' => $skills,
			 'qualification' => $qualification,
			 'jobType' => $type,
			 'responsibilities' => $responsibilities,
			 'jobShift' => $shift,
			 'jobaddr' => $jobaddr,
			 'minSalary' => $minSalary,
			 'maxSalary' => $maxSalary,
			 'afterinterview' => $afterinterview,
			 'currency' => $currency,
			 'benefits' => rtrim(@implode(',', $request->input('benefits')),','),
			  'process' => rtrim(@implode(',', $request->input('process')),','),
			   'jobacademic' => $jobacademic,
			    'jobacademic_not' => $jobacademic_not,
			    'jobgraduate' => $jobgraduate,
			    'gender' => $gender,
			    'jobage1' => $jobage1,
			    'jobage2' => $jobage2,
			    'jobnoage' => $jobnoage,
			    'country' => $country,
			    'state' => $state,
			    'city' => $city,
			    'Address' => $Address,
			   'Address2' => $Address2,
			    'expiryDate' => $expiryDate,
			    'expiryAd' => $expiryAd,
			    'createdTime' => date('Y-m-d H:i:s'));

		if($questionaire_id){
			$input['questionaire_id'] = $questionaire_id;
		}


		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		//DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_Category,'companyModifiedTime'=>date('Y-m-d H:i:s')]); 
		//dd($jobId);
		\Session::put('success',trans('home.Add Job Successfully To Draft'));
		return Redirect::route('addmoney.account/employer/job/share');	
	//	return Redirect::route('addmoney.account/employer/payment',compact('am','app','goodsname'));
		}
}

else{

		if($plan != null && $plan != '')
		{       
			$name =$request->allarray;
			    $result_explode = explode('|', $name);
				
				$p_category = $result_explode[0];
				$pckg_id = $result_explode[1];
				$price= $result_explode[2];
				$dur= $result_explode[3];
				$quantity= $result_explode[4];
				//dd($duration);

				$date = strtotime('+'.$dur.' day');
                $expiry= date('Y-m-d', $date);
			
				$request->merge(['jType'=>'Paid']);
				$app = $request->session()->get('jcmUser');

				


		$input = array('userId' => $app->userId,
		 'companyId' => $app->companyId,
		 'status' => '1',
		 'pckg_id' => $pckg_id,
		 'jobStatus' => 'Publish',
		 'paymentType' => '4',
		 'amount' => $price,
		 'p_Category' => $p_category,
		 'title' => $title,
		 'jType' => 'Paid',
		 'dispatch' => $dispatch,
		'head' => $head,
		'department' => $department,
		'duration' => $dur,
		 'category' => $category,
		 'subCategory' => $subCategory,
		 'careerLevel' => $careerLevel,
		 'experience' => $experience,
		 'vacancies' => $vacancy,
		 'description' => $description,
		 'skills' => $skills,
		 'qualification' => $qualification,
		 'jobType' => $type,
		 'responsibilities' => $responsibilities,
		 'jobShift' => $shift,
		 'jobaddr' => $jobaddr,
		 'minSalary' => $minSalary,
		 'maxSalary' => $maxSalary,
		 'afterinterview' => $afterinterview,
		 'currency' => $currency,
		 'benefits' => rtrim(@implode(',', $request->input('benefits')),','),
		 'process' => rtrim(@implode(',', $request->input('process')),','), 
		 'jobacademic' => $jobacademic,
		  'jobacademic_not' => $jobacademic_not,
		  'jobgraduate' => $jobgraduate,
		  'gender' => $gender,
		  'jobage1' => $jobage1,
		  'jobage2' => $jobage2,
		  'jobnoage' => $jobnoage,
		  'country' => $country,
		  'state' => $state,
		  'city' => $city,
		  'Address' => $Address,
		 'Address2' => $Address2,
		  'expiryDate' => $expiryDate,
		  'expiryAd' => $expiry,
		  'createdTime' => date('Y-m-d H:i:s'));



		//dd($input);
		if($questionaire_id){
			$input['questionaire_id'] = $questionaire_id;
		}
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		 
		 $remain =$quantity-1;
		 $inputs['quantity']=$remain;

		DB::table('jcm_save_packeges')->where('user_id','=',$app->userId)->where('id','=',$pckg_id)->update($inputs);
        
		DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_category,'companyModifiedTime'=>date('Y-m-d H:i:s')]);   

		//dd($jobId);
		\Session::put('success',trans('home.Add Job Successfully'));
		return Redirect::route('addmoney.account/employer/job/share');	
		}
		
		elseif($amount!='0')
		{
			$request->merge(['jType'=>'Paid']);
		}
		if($amount=='0')
		{
			$request->merge(['jType'=>'Free']);
				$app = $request->session()->get('jcmUser');

	
   
		extract($request->all());
		//dd($request->all());

//'subCategory2' => $subCategory2,
			//'expptitle' => $expptitle,
			//'expposition' => $expposition,
			//'jobdayval' => $jobdayval,
			//'jobdayval_text' => $jobdayval_text,
			//'jobhoursval' => $jobhoursval,
			//'jobhoursval_text' => $jobhoursval_text,
			//'jobreceipt01' => $jobreceipt01,
			// 'jobreceipt02' => $jobreceipt02,
			// 'jobreceipt03' => $jobreceipt03,
			// 'jobreceipt04' => $jobreceipt04,
			// 'jobreceipt05' => $jobreceipt05,
			// 'jobreceipt06' => $jobreceipt06,
			// 'jobreceipt07' => $jobreceipt07,
			//'jobhomgpage' => $jobhomgpage,




		$input = array('userId' => $app->userId,
		 'companyId' => $app->companyId,
		 'status' => '1',
		 'jobStatus' => 'Publish',
		 'paymentType' => '0',
		 'amount' => $amount,
		 'p_Category' => $p_Category,
		 'title' => $title,
		 'jType' => $jType,
		 'dispatch' => $dispatch,
		'head' => $head,
		'department' => $department,
		'duration' => $duration,
		 'category' => $category,
		 'subCategory' => $subCategory,
		// 'subCategory2' => $subCategory2,
		 'careerLevel' => $careerLevel,
		 'experience' => $experience,
		 'vacancies' => $vacancy,
		 'description' => $description,
		 'skills' => $skills,
		 'qualification' => $qualification,
		 'jobType' => $type,
		 'responsibilities' => $responsibilities,
		 'jobShift' => $shift,
		 'jobaddr' => $jobaddr,
		 'minSalary' => $minSalary,
		 'maxSalary' => $maxSalary,
		 'afterinterview' => $afterinterview,
		 'currency' => $currency,
		 'benefits' => rtrim(@implode(',', $request->input('benefits')),','),
		  'process' => rtrim(@implode(',', $request->input('process')),','),
		   'jobacademic' => $jobacademic,
		    'jobacademic_not' => $jobacademic_not,
		    'jobgraduate' => $jobgraduate,
		    'gender' => $gender,
		    'jobage1' => $jobage1,
		    'jobage2' => $jobage2,
		    'jobnoage' => $jobnoage,
		    'country' => $country,
		    'state' => $state,
		    'city' => $city,
		    'Address' => $Address,
		   'Address2' => $Address2,
		    'expiryDate' => $expiryDate,
		    'expiryAd' => $expiryAd,
		    'createdTime' => date('Y-m-d H:i:s'));

		if($questionaire_id){
			$input['questionaire_id'] = $questionaire_id;
		}


		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_Category,'companyModifiedTime'=>date('Y-m-d H:i:s')]); 
		//dd($jobId);
		\Session::put('success',trans('home.Add Job Successfully'));
		return Redirect::route('addmoney.account/employer/job/share');	
		}	
		else{
		$request->session()->forget('postedJobId');  /*For nice pay*/
		 return view('frontend.employer.payment',compact('am','app','goodsname'));
	//	return Redirect::route('addmoney.account/employer/payment',compact('am','app','goodsname'));
		}
}
	}
	
	
		public function postPaymentWithpaypal(Request $request)
    {
		
		//dd(Session::get('amount'));
		//exit();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(Session::get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(Session::get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return 'Connection timeout';
               return redirect('account/employer');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return 'Some error occur, sorry for inconvenient';
                return redirect('account/employer');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
		 $pay_id=$payment->getId();
         Session::put('paypal_payment_id', $payment->getId());
        /** add payment ID to session **/
		// $pay_id=$payment->getId();
     
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
       return 'Unknown error occurred';
        return redirect('account/employer');
    
	}
    public function getPaymentStatus(Request $request)
    {
		$payment_id = Session::get('paypal_payment_id');
		
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return redirect('account/employer');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 

        $payment_id = Session::get('paypal_payment_id');
		$app = $request->session()->get('jcmUser');
		$amount = Session::get('amount');
		$jType = Session::get('jType');
		$p_Category = Session::get('p_Category');
		$title = Session::get('title');
		$department =Session::get('department');
		$category = Session::get('category');
		$subCategory = Session::get('subCategory');
		$subCategory2 = Session::get('subCategory2');
		$careerLevel =Session::get('careerLevel');
		$experience =Session::get('experience');
		$vacancy = Session::get('vacancy');
		$skills =Session::get('skills');
		$jobaddr =Session::get('jobaddr');
		$qualification = Session::get('qualification');
		$expiryDate = Session::get('expiryDate');
		$minSalary = Session::get('minSalary');
		$maxSalary = Session::get('maxSalary');
		$description = Session::get('description');
	    $type = Session::get('type');
		$currency = Session::get('currency');
		$benefits = Session::get('benefits');
		$process = Session::get('process');
		//$jobaddr = Session::get('jobaddr');
		$country = Session::get('country');
		$shift = Session::get('shift');
		$city = Session::get('city');
		$Address = Session::get('Address');
		$head = Session::get('head');
		$dispatch = Session::get('dispatch');
		$duration = Session::get('duration');
		$expiryDate = Session::get('expiryDate');
		$expiryAd = Session::get('expiryAd');
		$state = Session::get('state');
		$questionaire_id = Session::get('questionaire_id');
		$Address2 = Session::get('Address2');
		$responsibilities = Session::get('responsibilities');
		$expptitle = Session::get('expptitle');
		$expposition = Session::get('expposition');
		$jobdayval = Session::get('jobdayval');
		$jobdayval_text = Session::get('jobdayval_text');
		$jobhoursval = Session::get('jobhoursval');
		$jobhoursval_text = Session::get('jobhoursval_text');
		$jobacademic = Session::get('jobacademic');
		$jobacademic_not = Session::get('jobacademic_not');
		$jobgraduate = Session::get('jobgraduate');
		$gender = Session::get('gender');
		$jobage1 = Session::get('jobage1');
		$jobage2 = Session::get('jobage2');
		$jobnoage = Session::get('jobnoage');
		$jobreceipt01 = Session::get('jobreceipt01');
		$jobreceipt02 = Session::get('jobreceipt02');
		$jobreceipt03 = Session::get('jobreceipt03');
		$jobreceipt04 = Session::get('jobreceipt04');
		$jobreceipt05 = Session::get('jobreceipt05');
		$jobreceipt06 = Session::get('jobreceipt06');
		$jobreceipt07 = Session::get('jobreceipt07');
		$jobhomgpage = Session::get('jobhomgpage');
		$afterinterview = Session::get('afterinterview');
		
		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'status' =>'1', 'jobStatus' => 'Publish', 'pay_id' => $payment_id, 'amount' => $amount, 'p_Category' => $p_Category, 'title' => $title, 'jType' => $jType, 'dispatch' => $dispatch, 'head' => $head, 'department' => $department,'duration' => $duration, 'category' => $category, 'subCategory' => $subCategory,'subCategory2' => $subCategory2, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'responsibilities' => $responsibilities, 'expptitle' => $expptitle, 'expposition' => $expposition, 'jobShift' => $shift,'jobaddr' => $jobaddr, 'jobdayval' => $jobdayval,'jobdayval_text' => $jobdayval_text,'jobhoursval' => $jobhoursval,'jobhoursval_text' => $jobhoursval_text, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'afterinterview' => $afterinterview, 'currency' => $currency, 'benefits' => @implode(',', $benefits),'process' => @implode(',', $process), 'jobacademic' => $jobacademic, 'jobacademic_not' => $jobacademic_not, 'jobgraduate' => $jobgraduate, 'gender' => $gender, 'jobage1' => $jobage1, 'jobage2' => $jobage2, 'jobnoage' => $jobnoage, 'jobreceipt01' => $jobreceipt01, 'jobreceipt02' => $jobreceipt02, 'jobreceipt03' => $jobreceipt03, 'jobreceipt04' => $jobreceipt04, 'jobreceipt05' => $jobreceipt05, 'jobreceipt06' => $jobreceipt06, 'jobreceipt07' => $jobreceipt07, 'jobhomgpage' => $jobhomgpage, 'country' => $country, 'state' => $state, 'city' => $city,'Address' => $Address,'Address2' => $Address2, 'expiryDate' => $expiryDate,'expiryAd' => $expiryAd, 'createdTime' => date('Y-m-d H:i:s'));
		$input['questionaire_id'] = $questionaire_id;
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_Category,'companyModifiedTime'=>date('Y-m-d H:i:s')]);  
		echo $jobId;
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Payment success');
            return Redirect::route('addmoney.account/employer/job/share');
        }
        \Session::put('error','Payment failed');
       return redirect('account/employer');
    }
	
	
	public function completePayment(Request $request){
		/*Sessions for nicepay*/
		Session::put('p_Category',$request->p_Category); 
		Session::put('postedJobId',Session::get('id')); 
		/***/
		$rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	   $amount=$rec[0]->price;
		$am=$amount;
		$p_Category=$request->p_Category;
		$jType=$request->jType;
		$app = $request->session()->get('jcmUser');
		//Session::get('postedJobId')	
		return view('frontend.employer.payment',compact('am','app','p_Category','jType'));
	}		
	
	public function getresponse(Request $request){
		if(!Session::get('postedJobId')): 
			$apps = $request->session()->get('jcmUser'); 
			$payment = "123";
			
			$amounts = Session::get('amount');
			$jTypes = Session::get('jType');
			$p_Categorys = Session::get('p_Category');
			$titles = Session::get('title');
			$departments =Session::get('department');
			$categorys = Session::get('category');
			$subCategorys = Session::get('subCategory');
			$subCategorys2 = Session::get('subCategory2');
			$careerLevels =Session::get('careerLevel');
			$experiences =Session::get('experience');
			$vacancys = Session::get('vacancy');
			$skillss =Session::get('skills');
			$jobaddrs =Session::get('jobaddr');
			$qualifications = Session::get('qualification');
			$durations = Session::get('duration');
			$minSalarys = Session::get('minSalary');
			$maxSalarys = Session::get('maxSalary');
			$descriptions = Session::get('description');
			$types = Session::get('type');
			$currencys = Session::get('currency');
			$benefitss = Session::get('benefits');
			$process = Session::get('process');
			$countrys = Session::get('country');
			$shifts = Session::get('shift');
			$citys = Session::get('city');
			$Addresss = Session::get('Address');
			$expiryDates = Session::get('expiryDate');
			$expiryAds = Session::get('expiryAd');
			$states = Session::get('state');
			$questionaire_id = Session::get('questionaire_id');
			$Address2 = Session::get('Address2');
			$responsibilities = Session::get('responsibilities');
			$expptitle = Session::get('expptitle');
			$expposition = Session::get('expposition');
			$jobdayval = Session::get('jobdayval');
			$jobdayval_text = Session::get('jobdayval_text');
			$jobhoursval = Session::get('jobhoursval');
			$jobhoursval_text = Session::get('jobhoursval_text');
			$jobacademic = Session::get('jobacademic');
			$jobacademic_not = Session::get('jobacademic_not');
			$jobgraduate = Session::get('jobgraduate');
			$gender = Session::get('gender');
			$jobage1 = Session::get('jobage1');
			$jobage2 = Session::get('jobage2');
			$jobnoage = Session::get('jobnoage');
			$jobreceipt01 = Session::get('jobreceipt01');
			$jobreceipt02 = Session::get('jobreceipt02');
			$jobreceipt03 = Session::get('jobreceipt03');
			$jobreceipt04 = Session::get('jobreceipt04');
			$jobreceipt05 = Session::get('jobreceipt05');
			$jobreceipt06 = Session::get('jobreceipt06');
			$jobreceipt07 = Session::get('jobreceipt07');
			$jobhomgpage = Session::get('jobhomgpage');
			$afterinterview = Session::get('afterinterview');

			extract($request->all());

			$inputs = array('userId' => $apps->userId, 'companyId' => $apps->companyId, 'jobStatus' => 'Publish', 'pay_id' => $payment, 'amount' => $amounts, 'p_Category' => $p_Categorys, 'title' => $titles, 'jType' => $jTypes, 'department' => $departments, 'category' => $categorys, 'subCategory' => $subCategorys, 'subCategory2' => $subCategorys2, 'careerLevel' => $careerLevels, 'experience' => $experiences, 'vacancies' => $vacancys,'duration' => $durations, 'description' => $descriptions, 'skills' => $skillss, 'qualification' => $qualifications, 'jobType' => $types, 'responsibilities' => $responsibilities, 'expptitle' => $expptitle, 'expposition' => $expposition, 'jobShift' => $shifts,'jobaddr' => $jobaddrs, 'jobdayval' => $jobdayval,'jobdayval_text' => $jobdayval_text,'jobhoursval' => $jobhoursval,'jobhoursval_text' => $jobhoursval_text, 'minSalary' => $minSalarys, 'maxSalary' => $maxSalarys, 'afterinterview' => $afterinterview, 'currency' => $currencys, 'benefits' => @implode(',', $benefitss), 'process' => @implode(',', $process), 'jobacademic' => $jobacademic, 'jobacademic_not' => $jobacademic_not, 'jobgraduate' => $jobgraduate, 'gender' => $gender, 'jobage1' => $jobage1, 'jobage2' => $jobage2, 'jobnoage' => $jobnoage, 'jobreceipt01' => $jobreceipt01, 'jobreceipt02' => $jobreceipt02, 'jobreceipt03' => $jobreceipt03, 'jobreceipt04' => $jobreceipt04, 'jobreceipt05' => $jobreceipt05, 'jobreceipt06' => $jobreceipt06, 'jobreceipt07' => $jobreceipt07, 'jobhomgpage' => $jobhomgpage,'country' => $countrys, 'state' => $states, 'city' => $citys,'Address' => $Addresss,'Address2' => $Address2, 'expiryDate' => $expiryDates, 'expiryAd' => $expiryAds,'paymentType'=>2, 'createdTime' => date('Y-m-d H:i:s'));
			$inputs['questionaire_id'] = $questionaire_id;

			if($subCategorys == ''){
				$inputs['subCategory'] = '';
			}
			
			$jobId= DB::table('jcm_jobs')->insertGetId($inputs);
			DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_Category,'companyModifiedTime'=>date('Y-m-d H:i:s')]); 
			Session::put('postedJobId',$jobId);
		else: 
			if(Session::get('p_Category')):
				$p_Categorys = Session::get('p_Category');
			else:
				$jobData=Jobs::where('jobId',$p_Categorys)->first();
				$p_Categorys = $jobData->p_Category;
			endif;
			
			$jobId=Session::get('postedJobId');
		endif;

		echo $jobId.'-'.$p_Categorys;
	    die();   
	 }
	
	
    public function home(Request $request){
    	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	
    	$app = $request->session()->get('jcmUser');
    	$user=DB::table('jcm_users')->where('userId','=',$app->userId)->first();
    	//$user = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);

    	/* posted jobs*/
    	//$postedJobs = DB::table('jcm_jobs')->leftJoin('jcm_job_applied','jcm_jobs.jobId','=','jcm_job_applied.jobId')->select(DB::raw('count(jcm_job_applied.userId) as count,jcm_jobs.*'))->where('jcm_jobs.userId','=',$app->userId)->GroupBy('jcm_job_applied.jobId')->orderBy('jcm_jobs.jobId','desc')->get();
		//$postedJobs = DB::table('jcm_jobs')->where('userId','=',$app->userId)->orderBy('jobId','desc')->get();
		$postedJobs = DB::table('jcm_jobs')->leftJoin('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id')->leftJoin('jcm_job_applied','jcm_jobs.jobId','=','jcm_job_applied.jobId')->select(DB::raw('count(jcm_job_applied.userId) as count,jcm_jobs.*,jcm_payments.title as p_title'))->where('jcm_jobs.status','=','1')->where('jcm_jobs.userId','=',$app->userId)->GroupBy('jcm_jobs.jobId')->orderBy('jcm_jobs.jobId','desc')->paginate(8);

		$totalPosted = count($postedJobs);
    	/* end */
//dd($postedJobs);
    	/* recent application */
    	$applicant = DB::table('jcm_job_applied')
    					->select('jcm_job_applied.applyTime','jcm_jobs.jobId','jcm_users.city','jcm_users.country','jcm_jobs.title','jcm_users.userId','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')
    					->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
    					->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
    					->orderBy('jcm_job_applied.applyId','desc')
    					->where('jcm_jobs.userId','=',$app->userId)
    					->paginate(8);
						
						
		$applicants = DB::table('jcm_companies')
    					->select('jcm_users.city','privacy.profileImage as privacyImage','jcm_users.country','jcm_companies.companyName','jcm_companies.companyId','jcm_users.userId','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')
    					
						->join('jcm_users','jcm_users.companyId','=','jcm_companies.companyId')
						->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId')
						->join('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId')
						->where('jcm_users_meta.userId','!=','')
						->where('privacy.profile','=','Yes')
						->limit(6)
    					->get();				
    	/* end */

    	/* job response */
    	$response = $this->getJobResponse($app);

    	/* experience level */
    	$experience = $this->getJobExperienceLevel($app);

    	/* recruitement activiety */
    	$recruit = $this->getRecruitmentActivity($app);
		
		/* Related read */
		$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
    	
    	$readQry->orderBy('jcm_writings.writingId','desc')->groupBy('jcm_writings.title')->limit(6);
    	$read_record = $readQry->get();
		//dd($postedJobs);
		
		$lear_record = DB::table('jcm_upskills')->orderBy('skillId','desc')->limit(8)->get();
		/* ucomming interview data*/
		$upcommingInterviews = DB::table('jcm_job_interviews')
				->select('jcm_job_interviews.*','jcm_users.firstName','jcm_users.profilePhoto','jcm_users.lastName','jcm_jobs.title','con.name as country','stat.name as state','cit.name as city')
				->leftJoin('jcm_users','jcm_users.userId','=','jcm_job_interviews.jobseekerId')
				->leftJoin('jcm_jobs','jcm_jobs.jobId','=','jcm_job_interviews.jobId')
				->leftJoin('jcm_countries as con','con.id','=','jcm_users.country')
				->leftJoin('jcm_states as stat','stat.id','=','jcm_users.state')
				->leftJoin('jcm_cities as cit','cit.id','=','jcm_users.city')
				->where('jcm_job_interviews.userId',$app->userId)->orderBy('interviewId','desc')
				->limit(8)->get();

		return view('frontend.employer.dashboard',compact('user','upcommingInterviews','postedJobs','applicant','applicants','response','experience','recruit','read_record','lear_record', 'totalPosted'));
	}

	public function getJobResponse($app){
		$startFrom = trim(date('m'),'0');

		$dataArr = array();
		$monthArr = array();
		for($i = 1; $i <= $startFrom; $i++){
			$k = $i < 10 ? '0'.$i : $i;
			$dDate = date('Y').'-'.$k;
			$monthArr[] = '"'.trans('home.'.date('F',strtotime($dDate))).'"';
			$rec = DB::table('jcm_job_applied')->select(DB::raw('count(jcm_job_applied.applyId) as totalApplied'))->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')->where('jcm_jobs.userId','=',$app->userId)->where('jcm_job_applied.applyTime','like','%'.$dDate.'%')->first();
			$dataArr[] = $rec->totalApplied;
		}
		//print_r($dataArr);exit;
		return array($monthArr, $dataArr);
	}

	public function getJobExperienceLevel($app){
		$dataArr = array();
		$exprArr = array();
		$i=1;
		foreach(JobCallMe::getExperienceLevel() as $exp){
			$exprArr[] = '"'.trans('home.'.$exp).'"';
			$rec = DB::table('jcm_jobs')->select(DB::raw('count(jobId) as totalApplied'))->where('userId','=',$app->userId)->where('experience','like','%'.$exp.'%')->first();
			$dataArr[] = $rec->totalApplied;
			if(++$i == 10){break;}
		}
		return array($exprArr, $dataArr);
	}

	public function getRecruitmentActivity($app){
		$startFrom = trim(date('m'),'0');

		$dataArr = array();
		$monthArr = array();
		for($i = 1; $i <= $startFrom; $i++){
			$k = $i < 10 ? '0'.$i : $i;
			$dDate = date('Y').'-'.$k;
			$monthArr[] = '"'.trans('home.'.date('F',strtotime($dDate))).'"';
			$rec = DB::table('jcm_jobs')->select(DB::raw('count(jobId) as totalApplied'))->where('userId','=',$app->userId)->where('createdTime','like','%'.$dDate.'%')->first();
			$dataArr[] = $rec->totalApplied;
		}
		//print_r($dataArr);exit;
		return array($monthArr, $dataArr);
	}

	public function jobPost(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
		
		$company = DB::table('jcm_companies')->select('*')->where('companyId','=',$request->session()->get('jcmUser')->companyId)->get();
		//dd($company[0]->category);
		if($company[0]->category== "0")
		{
			$request->session()->flash('companyAlert', trans('home.companyAlert'));
			return redirect('account/employer/organization');
		}

	//$departs = DB::table('jcm_departments')->select('departmentId','name')->where('userId','=',$request->session()->get('jcmUser')->userId)->get();
	//	if(sizeof($departs)== "")
	//	{
	//		$request->session()->flash('depAlert', 'Please first add your company department then post your job');
	//		return redirect('account/employer/departments');
	//	}
	$userid = $request->session()->get('jcmUser')->userId;
		
    	$rec = DB::table('jcm_payments')->get();


		$plan = DB::table('jcm_save_packeges')->where('user_id',$userid)->where('quantity','>','0')->where('duration','>','0')->where('status','=','1')->get();


		
		$userId = $request->session()->get('jcmUser')->userId;
		$questionaires = DB::table('jcm_questionnaire')->where('user_id','=',$userId)->get();
		$evaluation = DB::table('jcm_evaluation')->where('user_id','=',$userId)->get();
		//dd($questionaires);


		$single= $plan[0]->quantity;
		//dd($single);
		return view('frontend.employer.post-job',compact('rec','plan','single','questionaires','evaluation','company'));

	}

	public function saveJob(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request,[
				'title' => 'required|max:255',
				'department' => 'required',
				'category' => 'required',
				//'careerLevel' => 'required',
				'experience' => 'required',
				'vacancy' => 'required|numeric',
				'description' => 'required|max:1024',
				'skills' => 'required|max:1024',
				'qualification' => 'required',
				'expiryDate' => 'required|date',
				'minSalary' => 'required|numeric',
				'maxSalary' => 'required|numeric',
				'state' => 'required',
			]);

		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'title' => $title, 'department' => $department, 'category' => $category, 'subCategory' => $subCategory, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => @implode(',', $request->input('benefits')), 'country' => $country, 'state' => $state, 'city' => $city, 'expiryDate' => $expiryDate, 'createdTime' => date('Y-m-d H:i:s'));
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		echo $jobId;
	}

	public function shareJob(Request $request,$jobId){
		//echo $jobId;
		return view('frontend.employer.share-job',compact('jobId'));
	}

	public function application(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	
    	$userId = $request->session()->get('jcmUser')->userId;

    	/* get jobs */
    	$getJobs = DB::table('jcm_jobs')->select('jobId','title')->where('userId','=',$userId)->orderBy('jobId','desc');
    	$jobs = $getJobs->get();
    	/* end */

		return view('frontend.employer.application',compact('jobs'));
	}

	public function getApplication(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$type = $request->segment(4);
		
		$jobId = $request->input('jobId');
		//'Delivered','Junk','Shortlist','Screened','Interview','Offer','Hire','Reject'

		$vhtml = '';
		switch ($type) {
			case 'inbox':
				$record = DB::table('jcm_job_applied')
							->select('jcm_jobs.title','jcm_job_applied.applyTime','jcm_job_applied.jobId','jcm_users.*','jcm_users_meta.*')
							->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
							->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_job_applied.userId')
							->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
							->where('jcm_jobs.userId','=',$app->userId)
							->where('jcm_job_applied.applicationStatus','=','Delivered')
							->where(function ($query) use ($jobId) {
		                        if($jobId != '0'){
		                            $query->where('jcm_job_applied.jobId', '=', $jobId);
		                        }
		                    })
							->orderBy('jcm_job_applied.applyId','desc')
							->get();
			break;
			
			default:
				$record = DB::table('jcm_job_applied')
							->select('jcm_jobs.title','jcm_job_applied.applyTime','jcm_job_applied.jobId','jcm_users.*','jcm_users_meta.*')
							->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
							->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_job_applied.userId')
							->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
							->where('jcm_jobs.userId','=',$app->userId)
							->where('jcm_job_applied.applicationStatus','=',ucfirst($type))
							->where(function ($query) use ($jobId) {
		                        if($jobId != '0'){
		                            $query->where('jcm_job_applied.jobId', '=', $jobId);
		                        }
		                    })
							->orderBy('jcm_job_applied.applyId','desc')
							->get();
			break;
		}

		$userArr = array();
		if(count($record) > 0){
			$vhtml  = '<table class="table ea-applicant-tbl" >';
				$vhtml .= '<thead>';
					$vhtml .= '<tr>';
						$vhtml .= '<th><input id="select-all"  type="checkbox" class="cbx-field"><label class="cbx" for="select-all"></label></th>';
						$vhtml .= '<th>';
							$vhtml .= '<div class="col-md-4 hidden-xs hidden-sm">'.trans('home.candidate').'</div>';
							$vhtml .= '<div class="col-md-3 hidden-xs hidden-sm">'.trans('home.education').'</div>';
							$vhtml .= '<div class="col-md-3 hidden-xs hidden-sm">'.trans('home.experience').'</div>';
							$vhtml .= '<div class="col-md-2 hidden-xs hidden-sm">'.trans('home.location').'</div>';
							$vhtml .= '<div class="col-md-12 hidden-md hidden-lg">'.trans('home.selectall').'</div>';
						$vhtml .= '</th>';
					$vhtml .= '</tr>';
				$vhtml .= '</thead>';
				$vhtml .= '<tbody>';
				foreach($record as $rec){
					$userImage = url('profile-photos/profile-logo.jpg');
					if($rec->profilePhoto != ''){
						$userImage = url('profile-photos/'.$rec->profilePhoto);
					}
					$userArr[$rec->userId.'_'.$rec->jobId] = $rec->firstName.' '.$rec->lastName;
					$randId = time().rand(000000,999999);
					$vhtml .= '<tr class="ea-single-record">';
						$vhtml .= '<td scope="row" style="vertical-align: middle">';
							$vhtml .= '<input id="inbox-'.$randId.'"  type="checkbox" class="cbx-field" name="applicant[]" value="'.$rec->userId.'_'.$rec->jobId.'"><label class="cbx" for="inbox-'.$randId.'"></label>';
						$vhtml .= '<input type="hidden" id="user_id" value="'.$rec->userId.'"></td>';
						$vhtml .= '<td>';
							$vhtml .= '<div class="row hidden-sm hidden-xs">';
								$vhtml .= '<div class="col-md-4">';
									$vhtml .= '<img src="'.$userImage.'" class="ea-image">';
									$vhtml .= '<div class="rtj-details">';
										$vhtml .= '<p><strong><a href="'.url('account/employer/application/candidate/'.$rec->userId."?jobId=".$rec->jobId).'">'.$rec->firstName.' '.$rec->lastName.'</a></strong> - <span class="ea-sm-date">'.$apply_date.'</span></p>';
										$vhtml .= '<p>'.substr($rec->title,0,28).'</p>';
										$expectedSalary = $rec->expectedSalary != '' ? $rec->expectedSalary : '0';
										$vhtml .= '<p><strong>'.trans('home.expected').':</strong> '.number_format($expectedSalary).' '.$rec->currency.'</p>';
									$vhtml .= '</div>';
								$vhtml .= '</div>';
								$vhtml .= '<div class="col-md-3 ea-details">'.trans('home.'.$rec->education).'</div>';
								$vhtml .= '<div class="col-md-3 ea-details"><span style="color: #999">'.trans('home.'.$rec->experiance).' </span></div>';
								$vhtml .= '<div class="col-md-2 ea-details">'.trans('home.'.JobCallMe::cityName($rec->city)).'</div>';
							$vhtml .= '</div>';
						

						$vhtml .= '<div class="row hidden-md hidden-lg">';
							$vhtml .= '<img src="'.$userImage.'" class="img-circle ea-image">';
							$vhtml .= '<div class="ea-details-sm">';
								$vhtml .= '<p><strong><a href="'.url('account/employer/application/applicant/'.$rec->userId).'">'.$rec->firstName.' '.$rec->lastName.'</a></strong> - <span class="ea-sm-date">'.$apply_date.'</span></p>';
                                $vhtml .= '<p class="ea-sm-experience">'.$rec->expertise.'</p>';
                                $expectedSalary = $rec->expectedSalary != '' ? $rec->expectedSalary : '0';
                                $vhtml .= '<p><strong>'.trans('home.expected').':</strong> '.number_format($expectedSalary).' '.$rec->currency.'</p>';
                                $vhtml .= '<p><strong>'.trans('home.education').':</strong> '.trans('home.'.$rec->education).'</p>';
                                $vhtml .= '<p><strong>'.trans('home.experience').':</strong> '.trans('home.'.$rec->experiance).'</p>';
                                $vhtml .= '<p><strong>'.trans('home.location').':</strong> '.trans('home.'.JobCallMe::cityName($rec->city)).'</p>';
							$vhtml .= '</div>';
						$vhtml .= '</div>';
						$vhtml .= '</td>';
					$vhtml .= '</tr>';
				}
				$vhtml .= '</tbody>';
			$vhtml .= '</table>';
		}else{
			$vhtml = '<div class="col-md-12 ea-no-record">'.trans('home.noapplicantshow').'</div>';
		}
		echo @json_encode(array('vhtml' => $vhtml, 'userArr' => $userArr));
		//echo $vhtml;
	}

	public function updateApplication(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$type = trim($request->input('type'));
		$ids = trim($request->input('ids'),',');
		foreach(@explode(',', $ids) as $uIds){
			$userId = @reset(@explode('_', $uIds));
			$jobId = @end(@explode('_', $uIds));
			$input = array('applicationStatus' => ucfirst($type));
			DB::table('jcm_job_applied')->where('userId','=',$userId)->where('jobId','=',$jobId)->update($input);
		}
		exit('1');
	}

	public function interviewVenues(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	

		$app = $request->session()->get('jcmUser');
		$uCountry = $app->country;

		/* get interview venues */
		$venues = DB::table("jcm_interview_venues")->where('userId','=',$app->userId)->orderBy('venueId','desc')->get();
		/* end */
		return view('frontend.employer.interview-venues',compact('venues','uCountry'));
	}

	public function saveInterviewVeneu(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		extract($request->all());
		$this->validate($request,[
				'title' => 'required',
				'address' => 'required',
				'state' => 'required',
				'city' => 'required',
				'contact_person' => 'required',
				'email' => 'sometimes|nullable|email|max:225',
				'mobile' => 'sometimes|nullable|digits_between:10,16',
				'phone' => 'sometimes|nullable|digits_between:10,16',
				'fax' => 'sometimes|nullable|digits_between:10,16',
			]);

		$input = array('title' => $title, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'contact' => $contact_person, 'email' => $email, 'mobile' => $mobile, 'phone' => $phone, 'fax' => $fax, 'instruction' => $instruction);
		if($venueId != '0' && $venueId != ''){
			DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->update($input);
		}else{
			$input['userId'] = $request->session()->get('jcmUser')->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_interview_venues')->insert($input);
		}
		exit('1');
	}

	public function getInterviewVenue(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$venueId = $request->segment(5);

		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->first();
		echo @json_encode($venue);
	}

	public function deleteInterviewVenue(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$venueId = $request->segment(5);

		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->delete();
	}

	public function viewApplicant(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$userId = $request->segment(5);
		$privacy = DB::table('jcm_privacy_setting')->where('userId',$userId)->first();
		$applicant = DB::table('jcm_users')
						->select('jcm_users.*','jcm_users_meta.*')
						->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId')
						->where('jcm_users.userId','=',$userId)
						->first();

		if(count($applicant) == 0){
			return redirect('account/employer/application');
		}
		$app = $request->session()->get('jcmUser');
		$resume = $this->userResume($userId);
		//print_r($resume);exit;
		$people = DB::table('jcm_users');
    	$people->select('jcm_users.*','privacy.profileImage as privacyImage');
    	$people->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
    	$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');
    	$people->where('privacy.profile','=','Yes');
		$people->limit(4);
		$people->inRandomOrder();
		$Query=$people->get();
		$plan = DB::table('jcm_save_packeges')->where('user_id',$app->userId)->where('quantity','>','0')->where('duration','=','0')->where('status','=','1')->where('type','=','Resume Download')->get();
		$pckg=count($plan);
		//dd($applicant);
		return view('frontend.employer.view-applicant',compact('pckg','applicant','resume','Query','privacy'));
		//return view('frontend.employer.view-applicant',compact('applicant','resume'));
	}
		public function viewApplicants(Request $request){

		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	

		$userId = $request->segment(5);

		$applicant = DB::table('jcm_users')
						->select('jcm_users.*','jcm_users_meta.*')
						->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId')
						->where('jcm_users.userId','=',$userId)
						->first();

		if(count($applicant) == 0){
			return redirect('account/employer/application');
		}
		$app = $request->session()->get('jcmUser');
		$resume = $this->userResume($userId);
		//print_r($resume);exit;
		//dd($applicant);
		$people = DB::table('jcm_users');
    	$people->select('jcm_users.*','privacy.profileImage as privacyImage');
    	$people->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
		$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');
    	$people->where('privacy.profile','=','Yes');
		$people->limit(4);
		$people->inRandomOrder();
		$Query=$people->get();
		$jobId = $_GET['jobId'];

		/* questionaire tab data *muhammad sajid* */

		$questionData = DB::table('jcm_ques_answer')->select('*')->leftJoin('jcm_questions','jcm_ques_answer.question_id','=','jcm_questions.q_id')->where('jobId',$jobId)->where('jobseeker_id',$userId)->get();

		/* evaluation tab data *muhammad sajid 20/4/2018* */

		$evaluationData = DB::table('jcm_evaluation as eva')->select('eva.*','eva_que.evaluation_factor','eva_que.weight')->leftJoin('jcm_evaluation_question as eva_que','eva.evaluation_id','=','eva_que.evaluation_id')->where('eva.job_id',$jobId)->where('eva.user_id',$app->userId)->get();

		$eva_ans = DB::table('jcm_evaluation_answer as eva_ans')->where('job_id',$jobId)->where('candidate_id',$userId)->get();

		/* interview  tab data *muhammad sajid 7/5/2018* */
		$interviewData = DB::table('jcm_job_interviews')->where('jobseekerId',$userId)->where('jobId',$jobId)->first();

		return view('frontend.employer.appcandidate',compact('evaluationData','applicant','resume','Query','userId','jobId','questionData','eva_ans','interviewData'));
	}
public function userResume($userId){
		$record = DB::table('jcm_resume')->where('userId','=',$userId)->orderBy('resumeId','asc')->get();
		$return = array();
		foreach($record as $rec){
			$return[$rec->type][$rec->resumeId] = @json_decode($rec->resumeData);
		}
		return $return;
	}
	public function organization(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

    	$app = $request->session()->get('jcmUser');

	    	$user=DB::table('jcm_users')->where('userId','=',$app->userId)->first();
	    	
			$postedJobs = DB::table('jcm_jobs')->leftJoin('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id')->leftJoin('jcm_job_applied','jcm_jobs.jobId','=','jcm_job_applied.jobId')->select(DB::raw('count(jcm_job_applied.userId) as count,jcm_jobs.*,jcm_payments.title as p_title'))->where('jcm_jobs.status','=','1')->where('jcm_jobs.userId','=',$app->userId)->GroupBy('jcm_jobs.jobId')->orderBy('jcm_jobs.jobId','desc')->paginate(8);

			$totalPosted = count($postedJobs);

		$app = $request->session()->get('jcmUser');

		$company = JobCallMe::getCompany($app->companyId);
		 Mapper::map(33.6844,  73.0479);
		return view('frontend.employer.view-organization',compact('company','totalPosted'));
	}

	public function saveOrgInfo(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
	$companyId = JobCallMe::getUser($app->userId)->companyId;
		extract($request->all());

		$comp_info_array = array(
			'companyName' => $request->input('companyName'),
			'category' => $request->input('industry'),
			'companyAddress' => $request->input('companyAddress'),
			'companyCountry' => $request->input('companyCountry'),
			'companyState' => $request->input('companyState'),
			'companyCity' => $request->input('companyCity'),
			'companyPhoneNumber' => $request->input('companyPhoneNumber'),
			'companyEmail' => $request->input('companyEmail'),
			'companyWebsite' => $request->input('companyWebsite'),
			'companyFb' => $request->input('companyFb'),
			'companyLinkedin' => $request->input('companyLinkedin'),
			'companyTwitter' => $request->input('companyTwitter'),
			'companyNoOfUsers' => $request->input('companyNoOfUsers')
		);

//print_r($comp_info_array); exit();

		if($companyId != '0'){
			
			DB::table('jcm_companies')->where('companyId','=',$companyId)->update($comp_info_array);
			exit(1);
		}

	}


	public function savdOrganization(Request $request){
		
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		extract($request->all());
		$opHours = $request->input('opHours');
		foreach($opHours as $i => $k){
			if($i == 'sun' || $i == 'sat'){
				if($k[0] == ''){ $k[0] = '00:00 AM';}
				if($k[1] == ''){ $k[1] = '00:00 PM';}
			}else{
				if($k[0] == ''){ $k[0] = '00:00 AM';}
				if($k[1] == ''){ $k[1] = '00:00 PM';}
			}
			$opHoursArr[$i] = array('from' => $k[0], 'to' => $k[1]);
		}
		
		$inputOr = array('category' => $industry,'companyName' => $companyName, 'companyAddress' => $companyAddress, 'companyEmail' => $companyEmail, 'companyPhoneNumber' => $companyPhoneNumber, 'companyState' => $companyState, 'companyCity' => $companyCity, 'companyCountry' => $companyCountry, 'companyWebsite' => $companyWebsite, 'companyFb' => $companyFb, 'companyLinkedin' => $companyLinkedin, 'companyTwitter' => $companyTwitter, 'companyNoOfUsers' => $companyNoOfUsers, 'companyOperationalHour' => @json_encode($opHoursArr), 'companyModifiedTime' => date('Y-m-d H:i:s'));		

		//dd($inputOr);
		
		if($companyId != '0'){
			
			DB::table('jcm_companies')->where('companyId','=',$companyId)->update($inputOr);
		}else{
			
			$inputOr['companyCreatedTime'] = date('Y-m-d H:i:s');
			
			$companyId = DB::table('jcm_companies')->insertGetId($inputOr);
		}
		exit('1');
	}

	public function aboutOrganization(Request $request){
		
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$companyAbout = trim($request->input('companyAbout'));
		if($companyAbout == ''){
			exit('Please enter some text');
		}

		$input = array('companyAbout' => $companyAbout);

		DB::table('jcm_companies')->where('companyId','=',$companyId)->update($input);
		exit('1');
	}
public function mapOrganization(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$companymap = trim($request->input('address'));
		if($companymap == ''){
			exit('Please enter some text');
		}

		$input = array('companyMap' => $companymap);

		DB::table('jcm_companies')->where('companyId','=',$companyId)->update($input);
		exit('1');
	}
	public function companyLogo(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$fName = $_FILES['cLogo']['name'];
		$ext = @end(@explode('.', $fName));
		if(!in_array(strtolower($ext), array('png','jpg','jpeg'))){
			exit('1');
		}
		$company = JobCallMe::getCompany($companyId);
		
		$pImage = '';
		if($company->companyLogo != '' && $company->companyLogo != NULL){
			$pImage = $company->companyLogo;
		}

		$image = $request->file('cLogo');
		$cLogo = time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/compnay-logo');
        $image->move($destinationPath, $cLogo);

        if($pImage != ''){
            @unlink(public_path('/compnay-logo/'.$pImage));
        }
        DB::table('jcm_companies')->where('companyId',$companyId)->update(array('companyLogo' => $cLogo));
        echo url('compnay-logo/'.$cLogo);
	}

	public function companyCover(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$fName = $_FILES['cLogo']['name'];
		$ext = @end(@explode('.', $fName));
		if(!in_array(strtolower($ext), array('png','jpg','jpeg'))){
			exit('1');
		}
		$company = JobCallMe::getCompany($companyId);
		
		$pImage = '';
		if($company->companyCover != '' && $company->companyCover != NULL){
			$pImage = $company->companyCover;
		}

		$image = $request->file('cLogo');
		$cLogo = time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/compnay-logo');
        $image->move($destinationPath, $cLogo);

        if($pImage != ''){
            @unlink(public_path('/compnay-logo/'.$pImage));
        }
        DB::table('jcm_companies')->where('companyId',$companyId)->update(array('companyCover' => $cLogo));
        echo url('compnay-logo/'.$cLogo);
	}

	public function saveJobInterview(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');

		$applicantInter = $request->input('applicantInter');
		//dd($applicantInter);
		$fromDate = trim($request->input('fromDate'));
		$interviewId = trim($request->input('interviewId'));
		$toDate = trim($request->input('toDate'));
		$time_to = trim($request->input('timeto'));
		$time_from = trim($request->input('timefrom'));
		$perInterview = trim($request->input('perInterview'));
		$venue = trim($request->input('venue'));

		if(count($applicantInter) == 0){
			exit('Please select some applicants');
		}
		if($fromDate == ''){
			exit('Please select from date');
		}
		if($toDate == ''){
			exit('Please select to date');
		}
		if($venue == ''){
			exit('Please select interview venue');
		}

		foreach($applicantInter as $appl){
			$jobseekerId = reset(@explode('_', $appl));
			$jobId = end(@explode('_', $appl));

			$input = array('userId' => $app->userId, 'jobseekerId' => $jobseekerId, 'jobId' => $jobId, 'fromDate' => $fromDate, 'toDate' => $toDate, 'perInterview' => $perInterview, 'venueId' => $venue,'time_from'=>$time_from,'time_to'=>$time_to, 'createdTime' => date('Y-m-d H:i:s'));
			$check = DB::table('jcm_job_interviews')->where('jobseekerId',$jobseekerId)->where('jobId',$jobId)->get();
			if(count($check) != 0){
				DB::table('jcm_job_interviews')->where('jobseekerId',$jobseekerId)->where('jobId',$jobId)->update($input);
			}else{
				DB::table('jcm_job_interviews')->insert($input);
			}

			

			DB::table('jcm_job_applied')->where('userId','=',$jobseekerId)->where('jobId','=',$jobId)->update(array('applicationStatus' => 'Interview'));
		}

		exit('1');
	}

	public function viewInterviewVeneu(Request $request,$venueId){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->first();

		$query = http_build_query(array('address'=>$venue->address.' '.JobCallMe::countryName($venue->country), 'sensor'=> 'false'));
		$getDecodeUrl = "https://maps.googleapis.com/maps/api/geocode/json?".$query;
		$geocode_stats = @file_get_contents($getDecodeUrl);

		$output_deals = json_decode($geocode_stats);
		$latLng = $output_deals->results[0]->geometry->location;
		$lat = $latLng->lat;
		$lng = $latLng->lng;

		return view('frontend.employer.interview-venue-detail',compact('venue','latLng'));
	}

	public function saveNotification(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');

		extract($request->all());

		if($jobAlert == 'on'){
			if($country == '' || $country == '0'){
				exit('Please select country');
			}
			if($state == '' || $state == '0'){
				exit('Please select state');
			}
			if($city == '' || $city == '0'){
				exit('Please select city');
			}
			if($category == '' || $category == '0'){
				exit('Please select category');
			}
		}

		$dataArray = array('serviceAlert' => 'No', 'closingJobs' => 'No', 'jobAlert' => 'No', 'messageAlert' => 'No', 'newApplication' => 'No', 'country' => $country, 'state' => $state, 'city' => $city, 'category' => $category);
		if($serviceAlert == 'on') $dataArray['serviceAlert'] = 'Yes';
		if($closingJobs == 'on') $dataArray['closingJobs'] = 'Yes';
		if($messageAlert == 'on') $dataArray['messageAlert'] = 'Yes';
		if($newApplication == 'on') $dataArray['newApplication'] = 'Yes';
		if($jobAlert == 'on') $dataArray['jobAlert'] = 'Yes';

		$isExist = DB::table('jcm_account_alert')->where('userId','=',$app->userId)->get();
		if(count($isExist) == 0){
			$dataArray['userId'] = $app->userId;
			DB::table('jcm_account_alert')->insert($dataArray);
		}else{
			DB::table('jcm_account_alert')->where('userId','=',$app->userId)->update($dataArray);
		}
		exit('1');
	}

	public function savePrivacy(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');

		extract($request->all());

		$dataArray = array('profile' => 'No', 'profileImage' => 'No', 'academic' => 'No', 'experience' => 'No', 'skills' => 'No', 'projectVisible' => 'No', 'publicationsVisible' => 'No','gender' => 'No','dateofbirth' =>'No');

		if($profile == 'on') $dataArray['profile'] = 'Yes';
		if($profileImage == 'on') $dataArray['profileImage'] = 'Yes';
		if($academic == 'on') $dataArray['academic'] = 'Yes';
		if($experience == 'on') $dataArray['experience'] = 'Yes';
		if($skills == 'on') $dataArray['skills'] = 'Yes';
		if($projectVisible == 'on') $dataArray['projectVisible'] = 'Yes';
		if($publicationsVisible == 'on') $dataArray['publicationsVisible'] = 'Yes';
		if($gender == 'on') $dataArray['gender'] = 'Yes';
		if($dateofbirth == 'on') $dataArray['dateofbirth'] = 'Yes';
		$isExist = DB::table('jcm_privacy_setting')->where('userId','=',$app->userId)->get();
		if(count($isExist) == 0){
			$dataArray['userId'] = $app->userId;
			DB::table('jcm_privacy_setting')->insert($dataArray);
		}else{
			DB::table('jcm_privacy_setting')->where('userId','=',$app->userId)->update($dataArray);
		}
		exit('1');
	}

	public function departments(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$app = $request->session()->get('jcmUser');
		/* departments */
		$departments = DB::table('jcm_departments')->where('userId','=',$app->userId)->orderBy('departmentId','desc')->get();

		return view('frontend.employer.view-departments',compact('departments'));
	}

	public function saveDepartment(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		extract($request->all());
		$this->validate($request,[
				'name' => 'required',
				'country' => 'required',
				'state' => 'required',
				'city' => 'required'
			]);

		$input = array('name' => $name, 'country' => $country, 'state' => $state, 'city' => $city, 'description' => $description);
		if($departmentId != '0' && $departmentId != ''){
			DB::table('jcm_departments')->where('departmentId','=',$departmentId)->update($input);
		}else{
			$input['userId'] = $request->session()->get('jcmUser')->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_departments')->insert($input);
		}
		exit('1');
	}

	public function getDepartment(Request $request,$departmentId){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$department = DB::table('jcm_departments')->where('departmentId','=',$departmentId)->first();
		echo @json_encode($department);
	}

	public function deleteDepartment(Request $request,$departmentId){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$venue = DB::table('jcm_departments')->where('departmentId','=',$departmentId)->delete();
	}
	
	public function jobupdate(Request $request ,$jobId){
		Session::put('id', $jobId);
		$recs = DB::table('jcm_payments')->get();
		return view('frontend.employer.jobupdate',compact('jobId','recs'));
	}
	public function update(Request $request){
		//return $request->all();
		$jobId=Session::get('id');
		//return $request->get('amount');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.edit')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.edit'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return redirect('account/employer');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return redirect('account/employer');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
		$rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	   $amount=$rec[0]->price;
		Session::put('payment_id', $payment->getId());
		$request->session()->put('amount', $amount);
		$request->session()->put('p_Category', $request->p_Category);
		$request->session()->put('jType', $request->jType);
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return redirect('account/employer');
    }
		
 public function updateStatus(Request $request)
    {
		$payment_id = Session::get('payment_id');
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return redirect('account/employer');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
			$payment_id = Session::get('payment_id');
		$amount = Session::get('amount');
		$jType = Session::get('jType');
		$p_Category = Session::get('p_Category');
	
      extract($request->all());
	
			$jobId=Session::get('id');

		$input = array('status' =>'1','paymentType' => '1' ,'pay_id' => $payment_id,'amount' => $amount,'p_Category' => $p_Category, 'jType' => $jType);
		//return $input;
		
		$set = DB::table('jcm_jobs')->where('jobId','=',$jobId)->update($input);
			
		echo $set;
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Upgrade Successfully');
            return Redirect::route('addmoney.account/employer/job/share');
        }
        \Session::put('error','Payment failed');
        return redirect('account/employer');
    }
	public function deletejob($id){
		
			DB::table('jcm_jobs')->where('jobId','=',$id)->delete();
			Session::flash('message', "Successfully Delete Job");
			return redirect('account/employer');
		}
		
		public function updatejob($id){
			Session::put('jobId', $id);
		
			$data = DB::table('jcm_jobs')->where('jobId','=',$id)->get();
			$result= $data[0];
			//$input = array('title' => $result->title);
			//dd($result);
			$recs = DB::table('jcm_payments')->get();
			
			return view('frontend.employer.update-job',compact('result','recs'));
			//Session::flash('message', "Successfully Delete Job");
			//return redirect(url()->previous());
		}
		
		
   public function updatepostPaymentWithpaypals(Request $request)
      {
		  //dd($request->all());
		$jobid = Session::get('jobId');
		Session::put('postedJobId',$jobid);
	 $rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	
	   $amount=$rec[0]->price;
	   
 //dd($amount);
        $mul=$amount;
        $am=$mul*1100;
      //  dd($am);
	  $request->session()->put('p_Category', $request->p_Category);
        $goodsname = Session::get('p_Category');
        $app = $request->session()->get('jcmUser');
		//dd($request->department);
		//$request->session()->put('amount', $amount);
		// $request->session()->put('title', $request->title);
		// //$request->session()->put('jType', 'Paid');
		// $request->session()->put('head', $request->head);
		// $request->session()->put('dispatch', $request->dispatch);
		// $request->session()->put('department', $request->department);
		// $request->session()->put('category', $request->category);
		// $request->session()->put('subCategory', $request->subCategory);
		// $request->session()->put('careerLevel', $request->careerLevel);
		// $request->session()->put('experience', $request->experience);
		// $request->session()->put('vacancy', $request->vacancy);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('skills', $request->skills);
		// $request->session()->put('qualification', $request->qualification);
		// //$request->session()->put('expiryDate', $request->expiryDate);
		// $request->session()->put('minSalary', $request->minSalary);
		// $request->session()->put('maxSalary', $request->maxSalary);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('type', $request->type);
		// $request->session()->put('currency', $request->currency);
		// $request->session()->put('benefits', $request->benefits);
		// $request->session()->put('state', $request->state);
		// $request->session()->put('city', $request->city);
		// $request->session()->put('country', $request->country);
		// $request->session()->put('shift', $request->shift);
		//$request->session()->put('expiryDate', $request->expiryDate);
		
	
		 $goodsname = Session::get('p_Category');
		//if($amount!='0')
		//{
		//	$request->merge(['jType'=>'Paid']);
		//}
		//if($amount=='0')
		//{
			//$request->merge(['jType'=>'Free']);
			//$app = $request->session()->get('jcmUser');

			$this->validate($request,[
				'title' => 'required|max:255',
				'department' => 'required',
				'category' => 'required',
				//'careerLevel' => 'required',
				'experience' => 'required',
				'vacancy' => 'required|numeric',
				'description' => 'required',
				'skills' => 'required|max:1024',
				'qualification' => 'required',
				'expiryDate' => 'required|date',
				//'minSalary' => 'required|numeric',
				//'maxSalary' => 'required|numeric',
				'state' => 'required',
			]);
	
   
			extract($request->all());

			$input = array('userId' => $app->userId, 'companyId' => $app->companyId,'title' => $title,'department' => $department, 'category' => $category, 'head' => $head,'dispatch' => $dispatch,'subCategory' => $subCategory,'subCategory2' => $subCategory2, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'responsibilities' => $responsibilities, 'expptitle' => $expptitle, 'expposition' => $expposition, 'jobShift' => $shift,'jobaddr' => $jobaddr, 'jobdayval' => $jobdayval,'jobdayval_text' => $jobdayval_text,'jobhoursval' => $jobhoursval,'jobhoursval_text' => $jobhoursval_text, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'afterinterview' => $afterinterview, 'currency' => $currency, 'benefits' => rtrim(@implode(',', $request->input('benefits')),','),'process' => rtrim(@implode(',', $request->input('process')),','), 'jobacademic' => $jobacademic, 'jobacademic_not' => $jobacademic_not, 'jobgraduate' => $jobgraduate, 'gender' => $gender, 'jobage1' => $jobage1, 'jobage2' => $jobage2, 'jobnoage' => $jobnoage, 'jobreceipt01' => $jobreceipt01, 'jobreceipt02' => $jobreceipt02, 'jobreceipt03' => $jobreceipt03, 'jobreceipt04' => $jobreceipt04, 'jobreceipt05' => $jobreceipt05, 'jobreceipt06' => $jobreceipt06, 'jobreceipt07' => $jobreceipt07, 'jobhomgpage' => $jobhomgpage, 'country' => $country, 'state' => $state, 'city' => $city,'Address' => $Address,'Address2' => $Address2);
			if($subCategory == ''){
				$input['subCategory'] = '';
			}
			$jobId = DB::table('jcm_jobs')->where('jobId','=',$jobid)->update($input);
			echo $jobId;
			\Session::put('success',trans('home.Job Update Successfully'));
			return Redirect::route('addmoney.account/employer/job/share');
		//}	
		//else{ 
			//$request->session()->forget('postedJobId');  /*For nice pay*/
		 //	return view('frontend.employer.update-payment',compact('am','app','goodsname'));
	//	return Redirect::route('addmoney.account/employer/payment',compact('am','app','goodsname'));
		//}
	}
	
	
		public function updatepostPaymentWithpaypal(Request $request)
    {
		
		
	
		//dd(Session::get('amount'));
		//exit();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(Session::get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(Session::get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.updatestatus')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.updatestatus'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return 'Connection timeout';
                return Redirect::route('add.frontend.employer.post-job');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return 'Some error occur, sorry for inconvenient';
                return Redirect::route('ey.frontend.employer.post-job');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
		 $pay_id=$payment->getId();
         Session::put('paypal_payment_id', $payment->getId());
        /** add payment ID to session **/
		// $pay_id=$payment->getId();
        // Session::put('paypal_payment_id', $payment->getId());
		// $request->session()->put('amount', $request->amount);
		// $request->session()->put('p_Category', $request->p_Category);
		// $request->session()->put('title', $request->title);
		// $request->session()->put('jType', 'Paid');
		// $request->session()->put('department', $request->department);
		// $request->session()->put('category', $request->category);
		// $request->session()->put('subCategory', $request->subCategory);
		// $request->session()->put('careerLevel', $request->careerLevel);
		// $request->session()->put('experience', $request->experience);
		// $request->session()->put('vacancy', $request->vacancy);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('skills', $request->skills);
		// $request->session()->put('qualification', $request->qualification);
		// $request->session()->put('expiryDate', $request->expiryDate);
		// $request->session()->put('minSalary', $request->minSalary);
		// $request->session()->put('maxSalary', $request->maxSalary);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('type', $request->type);
		// $request->session()->put('currency', $request->currency);
		// $request->session()->put('benefits', $request->benefits);
		// $request->session()->put('state', $request->state);
		// $request->session()->put('city', $request->city);
		// $request->session()->put('country', $request->country);
		// $request->session()->put('shift', $request->shift);
		// $request->session()->put('expiryDate', $request->expiryDate);
		
	
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
       return 'Unknown error occurred';
        return Redirect::route('frontend.employer.post-job');
    
	}
    public function updategetPaymentStatus(Request $request)
    {
		$jobid = Session::get('jobId');
		$payment_id = Session::get('paypal_payment_id');
		$app = $request->session()->get('jcmUser');
		$amount = Session::get('amount');
		$jType = Session::get('jType');
		$p_Category = Session::get('p_Category');
		$title = Session::get('title');
		$department =Session::get('department');
		$category = Session::get('category');
		$subCategory = Session::get('subCategory');
		$careerLevel =Session::get('careerLevel');
		$experience =Session::get('experience');
		$vacancy = Session::get('vacancy');
		$skills =Session::get('skills');
		$qualification = Session::get('qualification');
		$expiryDate = Session::get('expiryDate');
		$minSalary = Session::get('minSalary');
		$maxSalary = Session::get('maxSalary');
		$description = Session::get('description');
	    $type = Session::get('type');
		$currency = Session::get('currency');
		$benefits = Session::get('benefits');
		$country = Session::get('country');
		$shift = Session::get('shift');
		$city = Session::get('city');
		$expiryDate = Session::get('expiryDate');
		$expiryAd= Session::get('expiryAd');
		$state = Session::get('state');
		$duration = Session::get('duration');
		$questionaire_id = Session::get('questionaire_id');

		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'status' => '1', 'paymentType'=> '1', 'pay_id' => $payment_id, 'amount' => $amount, 'p_Category' => $p_Category, 'title' => $title, 'jType' => $jType, 'department' => $department, 'category' => $category,'duration' => $duration, 'subCategory' => $subCategory, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => @implode(',', $benefits), 'country' => $country, 'state' => $state, 'city' => $city, 'expiryDate' => $expiryDate,'expiryAd' => $expiryAd,  'createdTime' => date('Y-m-d H:i:s'));
		$input['questionaire_id'] = $questionaire_id;
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		//dd($input);
		$jobId = DB::table('jcm_jobs')->where('jobId','=',$jobid)->update($input);
		echo $jobId;
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.frontend.employer.post-job');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Payment success');
            return Redirect::route('addmoney.account/employer/job/share');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.post-job');
    }
    public function orders(Request $request){
    	$to = $request->input('to');
    	$from = $request->input('from');
    	$orderId = $request->input('order_id');
    	$status = $request->input('status');
    	$payment_mode = $request->input('payment_mode');
    	$id = session()->get('jcmUser')->userId;
    	$db = DB::table('jcm_orders');
    	if( $orderId != '' ) $db->where('order_id','=',$orderId);
    	if( $status != '' ) $db->where('status','=',$status);
    	if( $payment_mode != '' ) $db->where('payment_mode','LIKE','%'.$payment_mode.'%');
    	if( $from != '' && $to != '') $db->whereBetween('date', array($from, $to));
    	$db->where('user_id','=',$id);
		$db->orderBy('order_id','des');
    	$data = $db->get();
    	
    	return view('frontend.employer.orders',compact('data'));
    }
	 public function setfilter(Request $request,$id){
		 
		 return view('frontend.employer.setfilter',compact('id'));
		 
		 }

		 public function cashpayment(Request $request){
		//if(!Session::get('postedJobId')): 
			$apps = $request->session()->get('jcmUser'); 
			$payment = "123";
			
			$amountss = Session::get('amount');
			$jTypess = Session::get('jType');
			$p_Categoryss = Session::get('p_Category');
			$titless = Session::get('title');
			$departmentss =Session::get('department');
			$categoryss = Session::get('category');
			$subCategoryss = Session::get('subCategory');
			$subCategorys2s = Session::get('subCategory2');
			$careerLevelss =Session::get('careerLevel');
			$experiencess =Session::get('experience');
			$vacancyss = Session::get('vacancy');
			$skillsss =Session::get('skills');
			$jobaddrss =Session::get('jobaddr');
			$qualificationss = Session::get('qualification');
			$expiryDatess = Session::get('expiryDate');
			$minSalaryss = Session::get('minSalary');
			$maxSalaryss = Session::get('maxSalary');
			$descriptionss = Session::get('description');
			$typess = Session::get('type');
			$currencyss = Session::get('currency');
			$benefitsss = Session::get('benefits');
			$processs = Session::get('process');
			$countryss = Session::get('country');
			$shiftss = Session::get('shift');
			$cityss = Session::get('city');
			$Addressss = Session::get('Address');
			$expiryDates = Session::get('expiryDate');
			$expiryAdss= Session::get('expiryAd');
			$statess = Session::get('state');
			$durationss = Session::get('duration');
			$questionaire_id = Session::get('questionaire_id');
			$Address2 = Session::get('Address2');
			$responsibilities = Session::get('responsibilities');
			$expptitle = Session::get('expptitle');
			$expposition = Session::get('expposition');
			$jobdayval = Session::get('jobdayval');
			$jobdayval_text = Session::get('jobdayval_text');
			$jobhoursval = Session::get('jobhoursval');
			$jobhoursval_text = Session::get('jobhoursval_text');
			$jobacademic = Session::get('jobacademic');
			$jobacademic_not = Session::get('jobacademic_not');
			$jobgraduate = Session::get('jobgraduate');
			$gender = Session::get('gender');
			$jobage1 = Session::get('jobage1');
			$jobage2 = Session::get('jobage2');
			$jobnoage = Session::get('jobnoage');
			$jobreceipt01 = Session::get('jobreceipt01');
			$jobreceipt02 = Session::get('jobreceipt02');
			$jobreceipt03 = Session::get('jobreceipt03');
			$jobreceipt04 = Session::get('jobreceipt04');
			$jobreceipt05 = Session::get('jobreceipt05');
			$jobreceipt06 = Session::get('jobreceipt06');
			$jobreceipt07 = Session::get('jobreceipt07');
			$jobhomgpage = Session::get('jobhomgpage');
			$afterinterview = Session::get('afterinterview');
		
      //	dd($amounts);
			extract($request->all());

			$inputs = array('userId' => $apps->userId, 'companyId' => $apps->companyId, 'jobStatus' => 'Draft', 'pay_id' => $payment, 'paymentType'=> '3','status'=> '2', 'amount' => $amountss,'duration' => $durationss, 'p_Category' => $p_Categoryss, 'title' => $titless, 'jType' => $jTypess, 'department' => $departmentss, 'category' => $categoryss, 'subCategory' => $subCategoryss, 'subCategory2' => $subCategorys2s, 'careerLevel' => $careerLevelss, 'experience' => $experiencess, 'vacancies' => $vacancyss, 'description' => $descriptionss, 'skills' => $skillsss, 'qualification' => $qualificationss, 'jobType' => $typess, 'responsibilities' => $responsibilities, 'expptitle' => $expptitle, 'expposition' => $expposition, 'jobShift' => $shiftss,'jobaddr' => $jobaddrss, 'jobdayval' => $jobdayval,'jobdayval_text' => $jobdayval_text,'jobhoursval' => $jobhoursval,'jobhoursval_text' => $jobhoursval_text, 'minSalary' => $minSalaryss, 'maxSalary' => $maxSalaryss, 'afterinterview' => $afterinterview, 'currency' => $currencyss, 'benefits' => @implode(',', $benefitsss), 'process' => @implode(',', $processs), 'jobacademic' => $jobacademic, 'jobacademic_not' => $jobacademic_not, 'jobgraduate' => $jobgraduate, 'gender' => $gender, 'jobage1' => $jobage1, 'jobage2' => $jobage2, 'jobnoage' => $jobnoage, 'jobreceipt01' => $jobreceipt01, 'jobreceipt02' => $jobreceipt02, 'jobreceipt03' => $jobreceipt03, 'jobreceipt04' => $jobreceipt04, 'jobreceipt05' => $jobreceipt05, 'jobreceipt06' => $jobreceipt06, 'jobreceipt07' => $jobreceipt07, 'jobhomgpage' => $jobhomgpage,'country' => $countryss, 'state' => $statess, 'city' => $cityss,'Address' => $Addressss,'Address2' => $Address2,'expiryDate' => $expiryDatess,'expiryAd' => $expiryAdss, 'createdTime' => date('Y-m-d H:i:s'));
			if($subCategorys == ''){
				$inputs['subCategory'] = '';
			}
			
        $input['questionaire_id'] = $questionaire_id;
			$jobId= DB::table('jcm_jobs')->insertGetId($inputs);
			DB::table('jcm_companies')->where('companyId','=',$app->companyId)->update([ 'package'=>$p_Categoryss,'companyModifiedTime'=>date('Y-m-d H:i:s')]); 
			$order['job_id']=$jobId;
			$order['user_id']=$apps->userId;
            $order['payment_mode']='Cash Payment';
            $order['orderBy']=$inputs['title'];
			if($input['currency'] == 'KRW'){
				$order['amount']=$inputs['amount']*1100;
			}else{
				$order['amount']=$inputs['amount'];
			}
            
            $order['status']='Pending';
            $order['category']='Job';
            $order['date']= date('Y-m-d');
			$order['currency']=$inputs['paycurrency'];


            DB::table('jcm_orders')->insert($order);
			//dd($inputs);
			return view('frontend.employer.cashpayment_detail',compact('inputs'));
	
		 }
		 public function addUser(Request $request){
		 	$id = session()->get('jcmUser')->userId;
		 	$data = DB::table('jcm_users')->where('addby','=',$id)->get();
		 	return view('frontend.employer.addusers',compact('data'));
		 }
		 public function useradd(Request $request){
		 	$email = $request->input('degree');
		 	$data = DB::table('jcm_users')->where('email','=',$email)->get();
		 	if(sizeof($data) > 0){
		 		$id = session()->get('jcmUser')->userId;
		 		DB::table('jcm_users')->where('email','=',$email)->update(['addby'=>$id]);
		 	}else{
		 			echo 'error';
		 	}
		 }
		public function userdel(Request $request){
			$id = $request->input('userId');
			if(DB::table('jcm_users')->where('userId','=',$id)->update(['addby'=>'NULL'])){
				echo 1;
			}else{
				echo 2;
			}
		}
		public function questionnaires(Request $request){
			$id = $request->session()->get('jcmUser')->userId;
			$questionaires = DB::table('jcm_questionnaire')->where('user_id','=',$id)->get();
			return view('frontend.employer.questionnaires',compact('questionaires'));
		}
		public function addquestionaires(Request $request){

			$data['user_id'] = $request->session()->get('jcmUser')->userId;
			$data['title'] = $request->input('title');
			$data['type']  = $request->input('type');
			$data['submission_date']  = $request->input('submission_date');
			($request->input('late_submission') != '') ? $data['accept_late_submission']  = $request->input('late_submission') : $data['accept_late_submission'] = "No";
			($request->input('shuffle_question') != '') ? $data['shuffle_questions']  = $request->input('shuffle_question') : $data['shuffle_questions'] = "No" ;
			if($request->input('ques_id') != ''){
				$ques_id = $request->input('ques_id');
				DB::table('jcm_questionnaire')->where('ques_id',$ques_id)->update($data);
				return redirect('account/employer/questionnaires/edit/'.$ques_id);
			}else{
				if($id = DB::table('jcm_questionnaire')->insertGetId($data)){
					return redirect('account/employer/questionnaires/edit/'.$id);
				}else{
					echo "error in frontend/Employer line 1697";
				}
			}
			
		}
		public function editquestionnaires($id){
			$ques = DB::table('jcm_questionnaire')->where('ques_id',$id)->first();
			$questions = DB::table('jcm_questions')->where('ques_id',$id)->get();
			return view('frontend.employer.editquestionnaires',compact('ques','questions'));
		}
		public function editevaluation($id){
			$evaluation = DB::table('jcm_evaluation')->where('evaluation_id',$id)->first();
			$eval_ques = DB::table('jcm_evaluation_question')->where('evaluation_id',$id)->get();
			return view('frontend.employer.editevaluation',compact('eval_ques','evaluation'));
		}
		public function addquestion(Request $request){
			$data['ques_id'] = $request->input('ques_id');
			$data['question'] = $request->input('question');
			$data['marks'] = $request->input('marks');
			$data['options'] = implode(",", $request->input('options'));
			($request->input('shuffle_question') != '') ? $data['shuffle'] = $request->input('shuffle_question') :$data['shuffle'] = 'No';
			($request->input('required') != '') ? $data['required'] = $request->input('required') : $data['required'] = 'No';
			if($request->input('q_id') != ''){
				$q_id = $request->input('q_id');
				DB::table('jcm_questions')->where('q_id','=',$q_id)->update($data);
				return redirect('account/employer/questionnaires/edit/'.$data['ques_id']);
			}else{
				if(DB::table('jcm_questions')->insert($data)){
					return redirect('account/employer/questionnaires/edit/'.$data['ques_id']);
				}else{
					echo "error in frontend/Employer line 1715";
				}
			}
			
			
		}
	public function deletequestion(Request $request){
		$id = $request->input('q_id');
		if(DB::table('jcm_questions')->where('q_id','=',$id)->delete()){
			echo 1;
		}else{
			echo 2;
		}
	}
	public function deletequestionaires(Request $request){
		$id = $request->input('id');
		if(DB::table('jcm_questionnaire')->where('ques_id','=',$id)->delete()){
			echo 1;
		}else{
			echo 2;
		}
	}
	public function questionnaireAnswer(Request $request){
		
			$i =0;
			$jobseekerId = $request->session()->get('jcmUser')->userId;
			$array =[];
			$jobId = $request->input('job_id');
		foreach ($request->all() as $key => $value) {
			if($key == '_token' || $key == 'job_id'){

			}else{
				$array[$i] = array(
					'question_id' => $key,
					'answer' => $value,
					'jobseeker_id' => $jobseekerId,
					'jobId' => $jobId
					);
			}
			$i++;
		}
		foreach ($array as  $data) {
			DB::table('jcm_ques_answer')->insert($data);
		}
		return redirect('jobs');
		
	}


		//// Package Plan/////

		public function package(Request $request){
			//dd($request->all());
			$type=$request->input('type');
			$plan=DB::table('jcm_package_plan')->where('type','=',$type)->get();
			$id = session()->get('jcmUser')->userId;
			//dd($plan);
			return view('frontend.employer.package_plan',compact('plan','id'));
		}
		
		public function packageinfo(Request $request){
			$info = $request->all();
			
			$app= session()->get('jcmUser');
			$amount=$info['amount'] * 1100;

			//dd($amount);
			
			$request->session()->put('pckg_info', $info);
			$get_info = $request->session()->get('pckg_info');
			//dd($get_info['amount']);

			return view('frontend.employer.package_payment',compact('app','amount'));

			
		}

			public function packagePayment(Request $request)
    {
		$am = Session::get('pckg_info');
			//dd($am['amount']);
		
		//dd(Session::get('amount'));
		//exit();
        $payer = new Payer();
		//dd($payer);
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($am['amount']); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($am['amount']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.packagestatus')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.packagestatus'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
			//dd($this->_api_context);
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return 'Connection timeout';
                return Redirect::route('add.frontend.employer.post-job');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return 'Some error occur, sorry for inconvenient';
                return Redirect::route('ey.frontend.employer.post-job');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
		 $pay_id=$payment->getId();
         Session::put('paypal_payment_id', $payment->getId());
        /** add payment ID to session **/
		// $pay_id=$payment->getId();
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
       return 'Unknown error occurred';
        return Redirect::route('frontend.employer.post-job');
    
	}
	
    public function packageStatus(Request $request)
    {
		$payment_id = Session::get('paypal_payment_id');
        
       // $request->session()->put('input', $input);
		
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.frontend.employer.post-job');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
            $id = session()->get('jcmUser')->userId;
           // dd($apps);
            $input = Session::get('pckg_info');
            $input['user_id']=$id;
			$input['paymentMode']='Paypal';
			$input['status']=1;

	        DB::table('jcm_save_packeges')->insert($input);

			$order['user_id']=$id;
			$order['payment_mode']='Paypal';
			$order['orderBy']=$input['type'];
			$order['amount']=$input['amount'];
			$order['status']='Approved';
			$order['category']='Package Plan';
			$order['date']= date('Y-m-d');

       DB::table('jcm_orders')->insert($order);

		//echo $jobId;
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('successs','Package add success');
            //return Redirect::route('account/upskill');
            return redirect('account/employer/orders');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.post-job');
    }

	public function cashpackage(Request $request)
	{
           $id = session()->get('jcmUser')->userId;
           // dd($apps);
            $input = Session::get('pckg_info');
            $input['user_id']=$id;
			$input['paymentMode']='Cash Payment';
			$input['status']=2;

			if($input['currency'] == 'KRW'){
				$input['amount']=$input['amount']*1100;
			}else{
				$input['amount']=$input['amount'];
			}


	       $pckg_id=DB::table('jcm_save_packeges')->insertGetId($input);

			$order['user_id']=$id;
			$order['pckg_id']=$pckg_id;
			$order['payment_mode']='Cash Payment';
			$order['orderBy']=$input['type'];
			$order['amount']=$input['amount'];
			$order['status']='Pending';
			$order['category']='Package Plan';
			$order['date']= date('Y-m-d');
			$order['currency']=$input['currency'];

            DB::table('jcm_orders')->insert($order);
			 return view('frontend.employer.writecashpayment_detail',compact('input'));
	} 

	public function nicepaypckg(Request $request)
	{
           $id = session()->get('jcmUser')->userId;
           // dd($apps);
            $input = Session::get('pckg_info');
            $input['user_id']=$id;
			$input['paymentMode']='Nice Pay';
			$input['status']=2;

	        $pk_id=DB::table('jcm_save_packeges')->insertGetId($input);

			$order['user_id']=$id;
			$order['payment_mode']='Nice Pay';
			$order['orderBy']=$input['type'];
			$order['amount']=$input['amount']*1100;
			$order['status']='Pending';
			$order['category']='Package Plan';
			$order['date']= date('Y-m-d');
			$order['currency']=$input['currency'];

            DB::table('jcm_orders')->insert($order);
			echo $pk_id.'-package';
			die();
			// return view('frontend.writecashpayment_detail',compact('input'));
	} 
public function companyreview(Request $request)
{
	$userid = $request->session()->get('jcmUser')->userId;
	$companyId = $request->input('CompanyId');
	$type = $request->input('type');
	if($type == 'edit'){
		$companydata = DB::table('jcm_companyreview')->where('company_id',$companyId)->where('user_id',$userid)->first();
	}
	return view('frontend.employer.companyReview',compact('companydata','companyId','userid'));
}
public function addreview(Request $request)
{
	$userid = $request->session()->get('jcmUser')->userId;
	$data = $request->input();
	if($data['current_working'] != 'Yes'){
		$data['current_working'] = 'no';
	}else{
		$data['employer_upto'] = 'NULL';
	}

	unset($data['_token']);
	if($data['type'] == 'edit'){
		unset($data['type']);
		DB::table('jcm_companyreview')->where('company_id',$data['company_id'])->where('user_id','=',$userid)->update($data);
		
		return redirect('companies/company/'.$data['company_id']);
	}
	
	unset($data['type']);
	$checkrecord = DB::table('jcm_companyreview')->where('company_id',$data['company_id'])->where('user_id','=',$userid)->get();
	if( count($checkrecord) > 0 ){
		Session::flash('review-message', 'you already used your review'); 
		Session::flash('alert-class', 'alert-danger');
		return redirect('account/employeer/companies/company/review'); 
	}else{
		if(DB::table('jcm_companyreview')->insert($data)){
			return redirect('account/jobseeker');
		}else{
			echo "error in query controller employer line number 2072";
		}
	}

	
}
public function deletecompanyreview($reviewid){
	$companyid = $_GET['companyid'];
	DB::table('jcm_companyreview')->where('review_id',$reviewid)->delete();
	return redirect('companies/company/'.$companyid);
}

public function viewJobstatus(Request $request,$id){
		
		$jobId = $request->segment(2);

		$jobrs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_users.*','jcm_payments.title as p_title','jcm_companies.*');
		$jobrs->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId');
		$jobrs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobrs->Join('jcm_users','jcm_jobs.userId','=','jcm_users.userId');
		$jobrs->where('jcm_jobs.status','=','1');
		$jobrs->where('jcm_jobs.jobId','=',$id);
		$job = $jobrs->first();
		$benefits = @explode(',', $job->benefits);
		$process = @explode(',', $job->process);
		//dd($job);
		return view('frontend.employer.status',compact('job','benefits','process'));

}

public function saveEvaluation(Request $request){
     
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'title' => 'required',
			]);
			 $input['title']=$request->title;
			 $input['updated_at']= date('Y-m-d H:i:s');
			 $id=$request->evaluation_id;
			if($id != '' && $id != '0' && $id != NULL){
			DB::table('jcm_evaluation')->where('evaluation_id','=',$id)->update($input);
			return redirect("account/employer/evaluation/edit/".$id);
		}else{
			$input['user_id']=$app->userId;
           $input['criterion']='1';
		  $id = DB::table('jcm_evaluation')->insertGetId($input);
		  return redirect("account/employer/evaluation/edit/".$id);
		}
         
}
public function addevaluationquestion(Request $request){
	$data = $request->input();
	unset($data['_token']);
	if($data['eva_ques_id'] != ''){
		if(!$data['is_critical']){
			$data['is_critical'] = 'No';
		}
		
		DB::table('jcm_evaluation_question')->where('eva_ques_id',$data['eva_ques_id'])->update($data);
		return redirect("account/employer/evaluation/edit/".$data['evaluation_id']);
	}else{
		unset($data['eva_ques_id']);
		DB::table('jcm_evaluation_question')->insert($data);
		return redirect("account/employer/evaluation/edit/".$data['evaluation_id']);
	}
	
}
 public function deleteevaluationques(Request $request)
{
	$id = $request->q_id;
	echo DB::table('jcm_evaluation_question')->where('eva_ques_id',$id)->delete();
}

public function allform(Request $request){
		
		$app = $request->session()->get('jcmUser');
		$record = DB::table('jcm_evaluation')->where('user_id','=',$app->userId)->get();
		return view('frontend.employer.addevaluation',compact('record'));
	}

	public function getform(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$Id = $request->segment(5);
		$record = DB::table('jcm_evaluation')->where('evaluation_id','=',$Id)->first();
		echo @json_encode($record);
	}

	public function deleteform(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$evaluation_id = $request->segment(5);
		DB::table('jcm_evaluation')->where('evaluation_id','=',$evaluation_id)->delete();
	}



	  public function jobstatsupdate(Request $request){
        $id = $request->input('id');
		
        $jobstatus = $request->input('jobstatus');
      //echo $id;
	//	echo $jobstatus;
		$input['jobStatus']=$jobstatus;
        $check = DB::table('jcm_jobs')->where('jobId',$id)->update($input);
    

        if($check){
            echo 1;
        }else{
            echo 2;
        }
    }
   public function candidateEvaluation(Request $request){
   		$evaluation_factors = $request->input('evaluation_factor');
   		$points = $request->input('point');
   		$candidate_id = $request->input('candidate_id');
   		$job_id = $request->input('job_id');
   		$evaluation_title = $request->input('evaluation_title');
   		$total = $request->input('total');
   		$qualification = $request->input('qualification');
   		$eva_ans_id = $request->input('eva_ans_id');
   		$html = "";
   		foreach ($evaluation_factors as $key => $value) {
   			$data['evaluation_factor'] = $value;
   			$data['point'] = $points[$key];
   			$data['candidate_id'] = $candidate_id;
   			$data['job_id'] = $job_id;
   			$data['evaluation_title'] = $evaluation_title;
   			$data['total'] = $total;
   			$data['qualification'] = $qualification;
   			if($eva_ans_id[$key] != ''){
   				DB::table('jcm_evaluation_answer')->where('candidate_id',$data['candidate_id'])->where('job_id',$data['job_id'])->where('eva_ans_id',$eva_ans_id[$key])->update($data);
   			}else{
   				$id = DB::table('jcm_evaluation_answer')->insertGetId($data);
   				$html .= "<input type='hidden' name='eva_ans_id[]' value='".$id."'>";
   			}
   		}
   		if($eva_ans_id[0] == ''){
   			echo $html;
   		}else{
   			echo 1;
   		}
   		
   }
   public function viewCandidateEvaluation($jobId){

   		$all_eva_cand = DB::table('jcm_evaluation_answer as ans')->select('*')->leftJoin('jcm_users as u','u.userId','=','ans.candidate_id')->where('ans.job_id',$jobId)->groupBy('candidate_id')->get();
   		return view('frontend.employer.evaluation',compact('all_eva_cand'));
   }

   public function downloadusers(Request $request){

	   $app = $request->session()->get('jcmUser');
	   $download = DB::table('jcm_download')
	   ->select('jcm_download.*','jcm_users.*','jcm_users_meta.*','privacy.profileImage as pImage')
	   ->join('jcm_users','jcm_users.userId','=','jcm_download.seeker_id')
	    ->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_download.seeker_id')
    	->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_download.seeker_id')
	   ->where('jcm_download.emp_id','=',$app->userId)->groupBy('jcm_download.seeker_id')->paginate(10);
   //dd($download);
	 return view('frontend.employer.download',compact('download'));

   }
   public function comment(Request $request){
   		$data = $request->input();
   		unset($data['_token']);
   		$data['table_name'] ="resume";
   		if(DB::table('comments')->insert($data)){
   			echo 1;
   		}else{
   			echo 2;
   		}
   }
   public function deleteResumeReview(Request $request){
   		$commentId = $request->input('commentId');
   		DB::table('comments')->where('comment_id',$commentId)->delete();
   }

     public function offerinterview(Request $request){
	
   		$data = $request->input();
   		unset($data['_token']);
   		$data['table_name'] ="offer";
		   $userid = $request->session()->get('jcmUser')->userId;
		   $plan = DB::table('jcm_save_packeges')->where('user_id',$userid)->where('quantity','>','0')->where('duration','=','0')->where('status','=','1')->where('type','=','Resume Download')->get();
		//dd($plan);
			$pckg_id= $plan[0]->id;
			$pckgs_id= $plan[0]->pckg_id;
			$quantity= $plan[0]->quantity;
			$remain = $quantity - 1;
			$inputs['quantity']=$remain;
			$input['emp_id']=$userid;
			$input['pckg_id']=$pckgs_id;
			$input['seeker_id']=$data['jobseeker_id'];
			if(count($plan) == 0)
			{
				echo 2;
			}
				else{
					 DB::table('jcm_download')->insert($input);
                    DB::table('jcm_save_packeges')->where('user_id','=',$userid)->where('id','=',$pckg_id)->update($inputs);
					if(DB::table('jcm_offer_interview')->insert($data)){
						echo 1;
					}else{
						echo 2;
					}
				}
   }
   public function deleteoffer(Request $request){
   		$offerId = $request->input('offerId');
   		DB::table('jcm_offer_interview')->where('offer_id',$offerId)->delete();
   }

}
