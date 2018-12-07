<?php

/**
 * 
 * @author kblee
 *
 */
class CellPhoneRegItemBodyValidator{
	
	/**
	 * 
	 */
	public function CellPhoneRegItemBodyValidator(){
		
	}
	
	/**
	 * 
	 * @param $mdto
	 */
	public function validate($mdto){
		if($mdto->getParameter(MID) == null || $mdto->getParameter(MID) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("상점ID 미설정 오류입니다.");
			}
			throw new ServiceException("V201","상점ID 미설정 오류입니다.");
		}
		
		if($mdto->getParameter(GOODS_NAME) == null || $mdto->getParameter(GOODS_NAME) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("상품명 미설정 오류입니다.");
			}
			throw new ServiceException("V401","상품명 미설정 오류입니다.");
		}
		
		if($mdto->getParameter(GOODS_AMT) == null || $mdto->getParameter(GOODS_AMT) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("상품금액 미설정 오류입니다.");
			}
			throw new ServiceException("V402","상품금액 미설정 오류입니다.");
		}
		
	}
}

?>
