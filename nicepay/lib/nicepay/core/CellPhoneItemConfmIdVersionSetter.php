<?php
/**
 * 
 * @id : $Id: CellPhoneItemConfmIdVersionSetter.php 5542 2010-04-05 08:29:12Z crimson $
 * @version : $Revision: 5542 $
 * @author : $Author: crimson $
 * 
 */
class CellPhoneItemConfmIdVersionSetter implements MessageIdVersionSetter{
	
	/**
	 * 
	 */
	public function CellPhoneItemConfmIdVersionSetter(){
		
	}
	
	
	public function fillIdAndVersion($webMessageDTO) {
		$webMessageDTO->setParameter(VERSION, "NPG01");
		$webMessageDTO->setParameter(ID, "CPF01");
		
	}
	
}

?>