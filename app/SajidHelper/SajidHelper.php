<?php
namespace App\SajidHelper;
use DB;
use Session;

Class SajidHelper {
	private $client_id;
	private $client_secret;
	private $redirect_url;

	public function __construct($Facebook){
		$this->client_id = $Facebook['client_id'];
		$this->client_secret = $Facebook['client_secret'];
		$this->redirect_url = $Facebook['redirect'];
	}

	public function getClientId(){
		return $this->client_id;
	}
	public function getprofilepic(){
		if(Session::get('jcmUser')->chatImage){
		return Session::get('jcmUser')->chatImage;
		}else{
			return 'profile-logo.jpg';
		}
	}
	public function getClientSecret(){
		return $this->client_secret;
	}
	public function redirect(){
		return $this->redirect_url;
	}
	public function IpBaseLang(){
		if(!\Session::has('loadOne')){
			$ip = \Request::ip();
			$position = \Location::get($ip);
			if($position->countryCode != 'KR'){
				\App::setLocale('en');
				\Session::put('locale', 'en');
				\Session::put('loadOne', 'yes');
			}
		}	
	}
	public function getReviewCompany($employeer_id){
		$table = DB::table('jcm_users');
		$table->join('jcm_companies','jcm_companies.companyId','=','jcm_users.companyId');
		$table->where('jcm_users.userId','=',$employeer_id);
	$data = $table->first();
	return $data;
	}
	
}