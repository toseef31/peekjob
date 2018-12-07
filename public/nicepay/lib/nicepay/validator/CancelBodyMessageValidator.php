<?php
/**
 * 
 * @author kblee
 *
 */
class CancelBodyMessageValidator{
	
	/**
	 * 
	 */
	public function CancelBodyMessageValidator(){
		
	}
	
	/**
	 * 
	 * @param $mdto
	 */
	public function validate($mdto) {
		// 취소금액
		if($mdto->getParameter(CANCEL_AMT) == null || $mdto->getParameter(CANCEL_AMT) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("취소금액 미설정 오류입니다.");
			}
			
			throw new ServiceException("V801","취소금액 미설정 오류입니다.");
		}
		
		// 취소사유
		if($mdto->getParameter(CANCEL_MSG) == null || $mdto->getParameter(CANCEL_MSG) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("취소사유 미설정 오류입니다.");
			}
			throw new ServiceException("V802","취소사유 미설정 오류입니다.");
		}
		
		// 상점ID
		if($mdto->getParameter(MID) == null || $mdto->getParameter(MID) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("상점ID 미설정 오류입니다.");
			}
			throw new ServiceException("V201","상점ID 미설정 오류입니다.");
		}
		

		if($mdto->getParameter(PAY_METHOD) == null || $mdto->getParameter(PAY_METHOD) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("지불수단이 설정되지 않았습니다. 취소 서비스일 경우 BANK, CARD, CELLPHONE 이 중 하나를 설정해야 합니다.");
			}
			throw new ServiceException("V103","지불수단을 설정하지 않았습니다.");
		}
	}
	
}
?>
