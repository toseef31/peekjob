<?php

/**
 * 
 * @author kblee
 *
 */
class PayReceiptServiceIdVersionSetter implements MessageIdVersionSetter{
	

	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "FCH01");
	}
	
}
?>
