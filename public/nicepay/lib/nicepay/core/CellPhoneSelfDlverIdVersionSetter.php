<?php

/**
 * 
 * @author kblee
 *
 */
class CellPhoneSelfDlverIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function CellPhoneSelfDlverIdVersionSetter(){
		
	}
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "CPD01");
	}
}

?>