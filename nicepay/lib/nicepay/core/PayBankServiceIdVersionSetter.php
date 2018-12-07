<?php
/**
 * 
 * @author kblee
 *
 */
class PayBankServiceIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function PayBankServiceIdVersionSetter(){
		
	}
	
	/**
	 * 
	 * @param unknown_type $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "FBK01");
	}
	
}
?>