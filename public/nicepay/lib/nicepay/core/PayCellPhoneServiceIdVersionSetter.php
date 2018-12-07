<?php

require_once dirname(__FILE__).'/MessageIdVersionSetter.php';

/**
 * 
 * @author kblee
 *
 */
class PayCellPhoneServiceIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function PayCellPhoneServiceIdVersionSetter(){
		
	}
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "FCP01");
	}
	
	
}
?>