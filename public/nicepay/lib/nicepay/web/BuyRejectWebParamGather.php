<?php

require_once dirname(__FILE__).'/WebParamGather.php';

class BuyRejectWebParamGather implements WebParamGather{
	
	public function BuyRejectWebParamGather(){
		
	}
	
	public function gather($request){
		$webParam = new WebMessageDTO();
		return $webParam;
	}
	
}
?>