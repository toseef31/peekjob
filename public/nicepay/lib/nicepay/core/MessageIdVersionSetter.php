<?php
/**
 * 
 * @author kblee
 *
 */
interface MessageIdVersionSetter{
	
	/**
	 * 
	 * @param  $webMessageDTO
	 */
	public function fillIdAndVersion($webMessageDTO);
}
?>