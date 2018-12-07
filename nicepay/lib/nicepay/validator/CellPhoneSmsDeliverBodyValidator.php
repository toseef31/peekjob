<?php

/**
 * 
 * @author kblee
 *
 */
class CellPhoneSmsDeliverBodyValidator{
	
	/**
	 * 
	 */
	public function CellPhoneSmsDeliverBodyValidator(){
		
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
		
		if($mdto->getParameter(SMS_OTP) == null || $mdto->getParameter(SMS_OTP) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->writeAppLog("SMS승인번호 미설정 오류입니다.");
			}
			throw new ServiceException("VA03","SMS승인번호 미설정 오류입니다.");
		}
	}
	
	
}
?>
