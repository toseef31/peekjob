<?php
/**
 * 
 * @author kblee
 *
 */
class DynamicColumn extends Column{
	/**
	 * 
	 * @var $column
	 */
	private $column;
	
	/**
	 * 
	 * @param  $column
	 */
	public function DynamicColumn($column){
		$this->column = $column;
	}
	
	/**
	 * 
	 */
	public function getColumn(){
		return $this->column;
	}
}

?>
