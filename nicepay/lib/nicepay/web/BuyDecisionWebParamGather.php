<?php
require_once dirname(__FILE__).'/WebParamGather.php';

class BuyDecisionWebParamGather implements WebParamGather  {
	
	public function BuyDecisionWebParamGather(){
		
	}
	
	public function gather($request){
		$webParam = new WebMessageDTO();
		return $webParam;
	}
}
?>