<?php
/**
 * 
 * @author kblee
 *
 */
class CellPhoneSmsDlverIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function CellPhoneSmsDlverIdVersionSetter(){
		
	}
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "CPE01");
	}
}
?>