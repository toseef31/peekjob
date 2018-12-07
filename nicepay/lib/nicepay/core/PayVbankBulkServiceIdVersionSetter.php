<?php
/**
 * 
 * @author kblee
 *
 */
class PayVbankBulkServiceIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "FVB01");
	}
	
}
?>