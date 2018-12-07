<?php
/**
 * 
 * @id : $Id: CellPhoneRegItemIdVersionSetter.php 5544 2010-04-05 08:30:37Z crimson $
 * @version : $Revision: 5544 $
 * @author : $Author: crimson $
 *
 */
class CellPhoneRegItemIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function CellPhoneRegItemIdVersionSetter(){
		
	}
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "CPR01");
	}
}