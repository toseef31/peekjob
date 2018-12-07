<?php
abstract class KeyUtils {

	
	private function KeyUtils(){
		
	}
	
	public static function genTID($mid,$svcCd,$svcPrdtCd){
		$buffer = array();
		
		$nanotime = microtime(true);
		
		// str_replace 사용 가이드(매뉴얼)에 따라 4번째 변수를 따로 선언하여 전달함 (2017.04.04)
		$nanotimeLen = strlen($nanotime);
		$nanoString = str_replace(".","",$nanotime, $nanotimeLen);
		
		$nanoStrLength = strlen($nanoString);
		
		$yyyyMMddHHmmss = date("YmdHis");
		
		
		$appendNanoStr = substr($nanoString,$nanoStrLength-2,2).mt_rand(10,99);
		
		$buffer = array_merge($buffer,str_split($mid));
		$buffer = array_merge($buffer,str_split($svcCd));
		$buffer = array_merge($buffer,str_split($svcPrdtCd));
		$buffer = array_merge($buffer,str_split(substr($yyyyMMddHHmmss,2,strlen($yyyyMMddHHmmss))));
		$buffer = array_merge($buffer,str_split($appendNanoStr));
		
		return implode($buffer);
	}
}
?>
