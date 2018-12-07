<?php
/**
 * 
 * @author kblee
 *
 */
class PayBankSSGServiceIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function PayBankSSGServiceIdVersionSetter(){
		
	}
	
	/**
	 * 
	 * @param unknown_type $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "FSB01");
	}
	
}
?>