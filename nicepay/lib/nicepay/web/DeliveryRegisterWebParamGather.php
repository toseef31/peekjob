<?php
require_once dirname(__FILE__).'/WebParamGather.php';

class DeliveryRegisterWebParamGather implements WebParamGather{
	
	public function DeliveryRegisterWebParamGather(){
		
	}
	
	public function gather($request){
		$webParam = new WebMessageDTO();
		return $webParam;
	}
}
?>