<?php
require_once dirname(__FILE__).'/SecureValueSetter.php';
/**
 * 
 * @author kblee
 *
 */
class SecureMessageProcessor{
	
	/**
	 * 
	 */
	public function SecureMessageProcessor(){
		
	}
	
	/**
	 * 
	 * @param  $messageDTO
	 */
	public function doProcess($messageDTO){
		$secureValueSetter = new SecureValueSetter();
		$secureValueSetter->fillValue($messageDTO);
	}
	
}

?>
