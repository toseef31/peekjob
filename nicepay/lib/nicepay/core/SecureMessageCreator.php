<?php
/**
 * 
 * @author kblee
 *
 */
class SecureMessageCreator {
	
	/**
	 * 
	 */
	public function SecureMessageCreator(){
		
	}
	
	/**
	 * 
	 * @param  $msg
	 */
	public function createMessage($msg){
		$hashString = md5($msg);
		return base64_encode($hashString);
	}
	
	
}
?>