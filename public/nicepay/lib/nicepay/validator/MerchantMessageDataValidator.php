<?php

/**
 * 
 * @author kblee
 *
 */
class MerchantMessageDataValidator{
	
	/**
	 * 
	 */
	public function MerchantMessageDataValidator(){
		
	}
	
	/**
	 * 
	 * @param $mdto
	 */
	public function validate($mdto){
		// MID
		if($mdto->getParameter(MID) == null || $mdto->getParameter(MID) == ""){
			if(LogMode::isAppLogable()) {
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("MID 미설정 오류입니다.");
			}
			throw new ServiceException("V201","상점ID 미설정 오류입니다.");
		}
		
		// LicenseKey 
		if($mdto->getParameter(MERCHANT_KEY) == null || $mdto->getParameter(MERCHANT_KEY) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("LicenseKey 미설정 오류입니다.");
			}
			throw new ServiceException("V202","LicenseKey 미설정 오류입니다.");
		}
		
		// MallIP
		/*
		if($mdto->getParameter(MALL_IP) == null || $mdto->getParameter(MALL_IP) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("MallIP 미설정 오류입니다.");
			}
			throw new ServiceException("V205","MallIP 미설정 오류입니다.");
		}
		*/
		
	}
}
?>
