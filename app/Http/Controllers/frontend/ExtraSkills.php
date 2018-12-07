<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Mapper;
use PDF;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
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
use Redis;

class ExtraSkills extends Controller{
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
    
    public function writings(Request $request){

    	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	$app = $request->session()->get('jcmUser');

    	/* writing query */
    	$writings = DB::table('jcm_writings')->where('userId','=',$app->userId);
    	$writings->orderBy('writingId','desc')->groupBy('title');
    	$writing = $writings->get();

    	return view('frontend.view-writings',compact('writing'));
    }

    public function addEditArticle(Request $request){
      //  dd($request->all());
       $rec = DB::table('jcm_writingpayment')->where('id','=',$request->cat_id)->get();
	   $amount=$rec[0]->price;
	  // dd($amount);
	   $durations=  $request->input('duration');
       

    	$app = $request->session()->get('jcmUser');
    	if($request->ajax()){
    		$this->validate($request,[
    				'title' => 'required',
    				'category' => 'required',
    				'description' => 'required',
    				'citation' => 'required'
    			],[				
				'description.required' => trans('home.Enter description'),				
			]);

    		if($request->input('prevIcon') == '' || $request->hasFile('articleImage')){
    			$this->validate($request, [
                    'articleImage' => 'required|image|mimes:jpeg,png,jpg|max:4048',
                ],[				
				'articleImage.required' => trans('home.Enter Image'),				
				]);
    		}
    		if($request->hasFile('articleImage')){
                $image = $request->file('articleImage');

                $name = 'article-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/article-images');
                $image->move($destinationPath, $name);

                if($request->input('prevIcon') != ''){
                    @unlink(public_path('/article-images/'.$request->input('prevIcon')));
                }
            }else{
                $input['wIcon'] = $request->input('prevIcon');
            }
            
            $input['wIcon']=$name;


            $durations= $amount * $request->input('duration');
            $nicepayamount=$durations*1100;
            $request->session()->put('wr_amount', $nicepayamount);
            $input['amount'] = $durations;
            $input['title'] = $request->input('title');
            $input['category'] = $request->input('category');
            $input['description'] = $request->input('description');
            $input['citation'] = $request->input('citation');
            $input['status'] = 'Publish';
            $input['userId'] = $app->userId;
            $input['createdTime'] = date('Y-m-d H:i:s');
           // $input['cat_names'] = $catnames; 
            
           
            $request->session()->put('inputs', $input);
			$alldata = Session::get('inputs');
           // dd($alldata);

           // $input['title'] = $request->input('title');
           //print_r($input['category']);die;
            if($request->input('writingId') != '' && $request->input('writingId') != '0'){
                $catnames = "";
                foreach ($input['category'] as $value) {
                    $catnames .= DB::table('jcm_read_category')->where('id',$value)->first()->name.",";
                }
                $input['cat_names'] = $catnames; 
                $input['amount'] = $request->input('amount');
            	DB::table('jcm_writings')->where('writingId','=',$request->input('writingId'))->update($input);
                return redirect('account/writings');
                exit('1');
               }else{
                if($amount == 0)
                {
                   $catnames = "";
                foreach ($input['category'] as $value) {
                  $catnames .= DB::table('jcm_read_category')->where('id',$value)->first()->name.",";
                }
                $input['userId'] = $app->userId;
                $input['createdTime'] = date('Y-m-d H:i:s');
                $input['cat_names'] = $catnames;    
               //  return $input;
            // die;
                /*foreach ($input['category'] as $key => $value) {
                    $input['userId'] = $app->userId;
                    $input['cat_names'] = $catnames;
                    $input['createdTime'] = date('Y-m-d H:i:s');
                    $input['category'] = $value;
                    
                }*/
                $post=DB::table('jcm_writings')->insertGetId($input);

                    $data['post_text']=$request->input('title');
                    $data['image']=$name;
                    $data['user_id']=$app->userId;
                    $data['post_type']='read';
                    $data['read_id']=$post;
                    $data['status']='Active';
                    DB::table('posts')->insert($data);
                    $task=DB::table('posts')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
                    $redis= Redis::connection();
                    $redis->publish('message',json_encode($task));
                 return redirect('account/writings');
                 exit('1');
                }
                else{
                   // exit();
                   return 1 ;
                }
              //  $catnames = "";
                //foreach ($input['category'] as $value) {
                //    $catnames .= DB::table('jcm_read_category')->where('id',$value)->first()->name.",";
                //}
                //$input['userId'] = $app->userId;
                //$input['createdTime'] = date('Y-m-d H:i:s');
                //$input['cat_names'] = $catnames;    
                /*foreach ($input['category'] as $key => $value) {
                    $input['userId'] = $app->userId;
                    $input['cat_names'] = $catnames;
                    $input['createdTime'] = date('Y-m-d H:i:s');
                    $input['category'] = $value;
                    
                }*/
            	//DB::table('jcm_writings')->insert($input);
               
            }
            exit('1');
    	}
    	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	$segment = $request->segment(4);
    	$article = (object) array();
    	if($segment == 'edit'){
    		$writingId = $request->segment(5);
    		$writings = DB::table('jcm_writings')->where('userId','=',$app->userId);
	    	$writings->where('writingId','=',$writingId);
	    	$article = $writings->first();
	    	if(count($article) == 0){
	    		return redirect('account/writings');
	    	}
    	}
        $wrpayment = DB::table('jcm_writingpayment')->get();
        //dd($wrpayment);
    	return view('frontend.add-edit-writing',compact('article','wrpayment'));
    }

		public function writePayment(Request $request)
    {
		$am = Session::get('inputs');
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
        $redirect_urls->setReturnUrl(URL::route('payment.writestatus')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.writestatus'));
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
	
    public function writeStatus(Request $request)
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
            $apps = $request->session()->get('jcmUser');
           // dd($apps);
            $input = Session::get('inputs');
               $catnames = "";
                foreach ($input['category'] as $value) {
                  $catnames .= DB::table('jcm_read_category')->where('id',$value)->first()->name.",";
                }
            $input['cat_names'] = $catnames;  
          //  $input['payment_id']=$payment_id;
        // $inputs = Session::get('input');
		//dd($input['paymentMode']);
        
	    DB::table('jcm_writings')->insert($input);
            $order['user_id']=$apps->userId;
            $order['payment_mode']='Paypal';
            $order['orderBy']=$input['title'];
            $order['amount']=$input['amount'];
            $order['status']='Approved';
            $order['category']='Article';
            $order['date']= date('Y-m-d');
             DB::table('jcm_orders')->insert($order);
		//echo $jobId;
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('successs','Writing add success');
            //return Redirect::route('account/upskill');
            return redirect('account/writings');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.post-job');
    }




    public function deleteArticle(Request $request){
        
    	if(!$request->ajax()){
    		exit('Directory access is forbidden');
    	}
    	$app = $request->session()->get('jcmUser');
        $writingId = $request->input('writingId');
    	DB::table('jcm_writings')->where('userId','=',$app->userId)->where('writingId','=',$writingId)->delete();
        DB::table('posts')->where('read_id',$writingId)->where('post_type','read')->delete();
        exit('1');
    }

    public function upskill(Request $request){
        if(!$request->session()->has('jcmUser')){
            return redirect('account/login?next='.$request->route()->uri);
        }
        $app = $request->session()->get('jcmUser');

        /* upskill query */
        $upskills = DB::table('jcm_upskills')->where('userId','=',$app->userId);
        $upskills->orderBy('skillId','desc');
        $upskills = $upskills->get();
        

    	return view('frontend.view-upskills',compact('upskills'));
    }

    public function addEditUpskill(Request $request){
        	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
		 $rec = DB::table('jcm_upskillpayment')->where('id','=',$request->cat_id)->get();
	   $amount=$rec[0]->price;
	   //dd();
	   $durations= $amount*$request->duration;
       $up=$durations*1000;
	   $request->session()->put('price', $up);
        $app = $request->session()->get('jcmUser');
        if($request->ajax()){
            $this->validate($request,[
                    'title' => 'required',
                    'type' => 'required',
                    'description' => 'required',                
                    'currency' => 'required',
                    'address' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'contact' => 'required',                  
                    //'phone' => 'required',
                    'mobile' => 'nullable',
                    'website' => 'nullable|url',
                    'facebook' => 'nullable|url',
                    'linkedin' => 'nullable|url',
                    'twitter' => 'nullable|url',
                    'google' => 'nullable|url',
                    //'startDate' => 'required|date',
                    //'endDate' => 'required|date',
                ],[				
					'description.required' => trans('home.Enter description'),				
				]);

            if($request->input('oType') == 'other'){
                $this->validate($request, [
                    'organiser' => 'required',
                ]);
            }

            if($request->hasFile('upskillImage')){
                $this->validate($request, [
                    'upskillImage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ],[				
				'upskillImage.required' => trans('home.Enter Image'),				
				]);
            }
            if($request->hasFile('upskillImage')){
                $image = $request->file('upskillImage');

                $input['upskillImage'] = 'upskill-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upskill-images');
                $image->move($destinationPath, $input['upskillImage']);

                if($request->input('prevIcon') != ''){
                    @unlink(public_path('/upskill-images/'.$request->input('prevIcon')));
                }
            }

            $opHours = $request->input('opHours');
            $timing = array();
            foreach($opHours as $i => $k){
                $timing[$i] = array('from' => $k[0], 'to' => $k[1]);
            }
            $input['amount'] = $durations;
			$input['cat_id'] = trim($request->input('cat_id'));
            $input['title'] = trim($request->input('title'));
            $input['type'] = trim($request->input('type'));
            $input['organiser'] = trim($request->input('organiser'));
            $input['description'] = trim($request->input('description'));
            $input['cost'] = trim($request->input('cost'));
            $input['currency'] = trim($request->input('currency'));
			$input['accommodation'] = trim($request->input('accommodation'));
			$input['costdescription'] = trim($request->input('costdescription'));
            $input['address'] = trim($request->input('address'));
			$input['address2'] = trim($request->input('address2'));
            $input['country'] = trim($request->input('country'));
            $input['state'] = trim($request->input('state'));
            $input['city'] = trim($request->input('city'));
            $input['contact'] = trim($request->input('contact'));
            $input['email'] = trim($request->input('email'));
            $input['phone'] = trim($request->input('phone'));
            $input['mobile'] = trim($request->input('mobile'));
			$input['fax'] = trim($request->input('fax'));
            $input['website'] = trim($request->input('website'));
            $input['facebook'] = trim($request->input('facebook'));
            $input['linkedin'] = trim($request->input('linkedin'));
            $input['twitter'] = trim($request->input('twitter'));
            $input['google'] = trim($request->input('google'));
            $input['startDate'] = trim($request->input('startDate'));
            $input['endDate'] = trim($request->input('endDate'));
			$input['adstartDate'] = trim($request->input('adstartDate'));
            $input['adendDate'] = trim($request->input('adendDate'));
			$input['duration'] = trim($request->input('duration'));
            $input['timing'] = @json_encode($timing);
			$input['userId'] = $app->userId;
            $input['companyId'] = $app->companyId;
            $input['paymentMode'] = 'Paypal';
            $input['createdTime'] = date('Y-m-d H:i:s');
			$request->session()->put('input', $input);
			$alldata = Session::get('input');
			//dd($alldata['amount']);

            if($request->input('accommodation') == 'on'){
                $input['cost'] = '0';
            }

            if($request->input('skillId') != '' && $request->input('skillId') != '0'){
                DB::table('jcm_upskills')->where('skillId','=',$request->input('skillId'))->update($input);
                exit(1);
            }else{
               
                //DB::table('jcm_upskills')->insert($input);
                return 1 ;
            }
          exit(1);
        }
        $segment = $request->segment(3);
        $upskill = (object) array();
        if($segment == 'edit'){
            $skillId = $request->segment(4);
            $upskills = DB::table('jcm_upskills')->where('userId','=',$app->userId);
            $upskills->where('skillId','=',$skillId);
            $upskill = $upskills->first();
            if(count($upskill) == 0){
                return redirect('account/upskill');
            }
        }
         Mapper::map(33.6844,  73.0479);

    	$uppayment = DB::table('jcm_upskillpayment')->get();
		//dd($uppayment);
    	return view('frontend.add-edit-upskill',compact('upskill','uppayment'));
    }
	
	
	
		public function postPayment(Request $request)
    {
		$am = Session::get('input');
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
        $redirect_urls->setReturnUrl(URL::route('payment.skillstatus')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.skillstatus'));
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
	
    public function getStatus(Request $request)
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
            $apps = $request->session()->get('jcmUser');
           // dd($apps);
            $input = Session::get('input');
            $input['payment_id']=$payment_id;
        // $inputs = Session::get('input');
		//dd($input['paymentMode']);
        
	   $learn=DB::table('jcm_upskills')->insertGetId($input);
    

       $order['user_id']=$apps->userId;
       $order['payment_mode']=$input['paymentMode'];
       $order['orderBy']=$input['title'];
       $order['amount']=$input['amount'];
       $order['status']='Approved';
       $order['category']='Upskill';
       $order['date']= date('Y-m-d');

       DB::table('jcm_orders')->insert($order);
       $data['post_text']=$input['title'];;
       $data['image']=$input['upskillImage'];                     
       $data['user_id']=$app->userId;
       $data['post_type']='learn';
       $data['learn_id']=$learn;

       DB::table('posts')->insert($data);  
		//echo $jobId;
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('successs','Upskill add success');
            //return Redirect::route('account/upskill');
            return redirect('account/upskill');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.post-job');
    }

     public function cashpayment(Request $request){
            $apps = $request->session()->get('jcmUser');
            $input = Session::get('input');
            $input['status']='Inactive';
            $input['paymentMode']='Cash Payment';
	       $up_id= DB::table('jcm_upskills')->insertGetId($input);

            $order['user_id']=$apps->userId;
            $order['upskill_id']=$up_id;
            $order['payment_mode']='Cash Payment';
            $order['orderBy']=$input['title'];
            $order['amount']=$input['amount'];
            $order['status']='Pending';
            
            $order['category']='Upskill';
            $order['date']= date('Y-m-d');

            DB::table('jcm_orders')->insert($order);

            $data['post_text']=$input['title'];;
            $data['image']=$input['upskillImage'];                     
            $data['user_id']=$apps->userId;
            $data['post_type']='learn';
            $data['status']='Pending';
            $data['learn_type']=$input['type'];
            $data['learn_id']=$up_id;

       DB::table('posts')->insert($data); 
            return view('frontend.upskillcashpayment_detail',compact('order'));

     }

      public function upskillnicepay(Request $request){
            $apps = $request->session()->get('jcmUser');
            $input = Session::get('input');
            $input['status']='Inactive';
            $input['paymentMode']='Nice Pay';
	        $up_id=DB::table('jcm_upskills')->insertGetId($input);

            $order['user_id']=$apps->userId;
            $order['payment_mode']='Nice Pay';
            $order['orderBy']=$input['title'];
            $order['amount']=$input['amount'];
            $order['status']='Pending';
            $order['category']='Upskill';
            $order['date']= date('Y-m-d');

            DB::table('jcm_orders')->insert($order);
            //return view('frontend.upskillcashpayment_detail',compact('order'));
            echo $up_id.'-upskill';
            die();

     }

        public function writecashpayment(Request $request){
            $apps = $request->session()->get('jcmUser');
            $input = Session::get('inputs');
               $catnames = "";
                foreach ($input['category'] as $value) {
                  $catnames .= DB::table('jcm_read_category')->where('id',$value)->first()->name.",";
                }
            $input['cat_names'] = $catnames;  
            $input['status'] = 'Draft';  
        
	        $wr_id=DB::table('jcm_writings')->insertGetId($input);


            $order['user_id']=$apps->userId;
            $order['wr_id']=$wr_id;
            $order['payment_mode']='Cash Payment';
            $order['orderBy']=$input['title'];
            $order['amount']=$input['amount'];
            $order['status']='Pending';
            $order['category']='Article';
            $order['date']= date('Y-m-d');
             DB::table('jcm_orders')->insert($order);

            return view('frontend.writecashpayment_detail',compact('input'));

     }

        public function writenicepay(Request $request){
            $apps = $request->session()->get('jcmUser');
            $input = Session::get('inputs');
               $catnames = "";
                foreach ($input['category'] as $value) {
                  $catnames .= DB::table('jcm_read_category')->where('id',$value)->first()->name.",";
                }
            $input['cat_names'] = $catnames;  
            $input['status'] = 'Draft';  
        
	        $wr_id=DB::table('jcm_writings')->insertGetId($input);


            $order['user_id']=$apps->userId;
            $order['payment_mode']='Nice Pay';
            $order['orderBy']=$input['title'];
            $order['amount']=$input['amount'];
            $order['status']='Pending';
            $order['category']='Article';
            $order['date']= date('Y-m-d');
             DB::table('jcm_orders')->insert($order);

          echo $wr_id.'-write';
          die();
     }
	

    public function deleteUpskill(Request $request,$skillId){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $app = $request->session()->get('jcmUser');

        DB::table('jcm_upskills')->where('userId','=',$app->userId)->where('skillId','=',$skillId)->delete();
        exit('1');
    }

}
