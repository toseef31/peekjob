<?php

/**
 * 
 * @author kblee
 *
 */
class CellPhoneItemConfirmBodyValidator{
	
	/**
	 * 
	 */
	public function CellPhoneItemConfirmBodyValidator(){
		
	}
	
	/**
	 * 
	 * @param $mdto
	 */
	public function validate($mdto){

		if($mdto->getParameter(SERVER_INFO) == null || $mdto->getParameter(SERVER_INFO) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->writeAppLog("거래KEY 미설정 오류입니다.");
			}
			throw new ServiceException("VA01","거래KEY 미설정 오류입니다.");
		}
		
		if($mdto->getParameter(ENCODED_TID) == null || $mdto->getParameter(ENCODED_TID) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
                                $logJournal->writeAppLog("ENCODE 업체TID 미설정 오류입니다.");
			}
			throw new ServiceException("VA10","ENCODE 업체TID 미설정 오류입니다.");
		}


	}
}
?>
