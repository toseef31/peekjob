<?php
/**
 * 
 * @id : $Id: CancelServiceIdVersionSetter.php 5538 2010-04-05 08:24:34Z crimson $
 * @version : $Revision: 5538 $
 * @author : $Author: crimson $
 *
 */
class CancelServiceIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function CancelServiceIdVersionSetter(){
		
	}
	
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "IPGC1");
	}
}
?>