<?php
require_once dirname(__FILE__).'/BodyMessageValidator.php';
/**
 * 
 * @author kblee
 *
 */
class VBankBodyMessageValidator implements BodyMessageValidator{
	
	/**
	 * 
	 */
	public function VBankBodyMessageValidator(){
		
	}
	
	/**
	 * 
	 * @param $mdto
	 */
	public function validate($mdto){
		// 가상계좌입금만료일
		if($mdto->getParameter(VBANK_EXPIRE_DATE) == null || $mdto->getParameter(VBANK_EXPIRE_DATE) == ""){
			if(LogMode::isAppLogable()){
				$logJournal = NicePayLogJournal::getInstance();
				$logJournal->errorAppLog("가상계좌입금만료일 미설정 오류입니다.");
			}
			throw new ServiceException("V701","가상계좌입금만료일 미설정 오류입니다.");
		}
	}	
		
}

?>
