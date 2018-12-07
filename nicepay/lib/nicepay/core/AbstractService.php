<?php
/**
 * Abstract Service Class
 * @id : $Id: AbstractService.php 5531 2010-04-05 07:49:11Z crimson $
 * @version : $Revision: 5531 $
 * @author : $Author: crimson $
 *
 */
abstract class AbstractService{
	 
	/**
	 * Execute Service
	 * @param ParameterSet $webMessageDTO
	 */
	public function service($webMessageDTO){
		// 요청 메시지 생성하기
		$requestBytes = $this->createMessage($webMessageDTO);
		
		if(LogMode::isAppLogable()){
			$logJournal = NicePayLogJournal::getInstance();
			$logJournal->writeAppLog("송신 ".strlen($requestBytes)." Bytes");
		}
		
		// 요청 메시지 보내기
		$responseBytes = $this->send($requestBytes);
		
		if(LogMode::isAppLogable()){
			$logJournal = NicePayLogJournal::getInstance();
			$logJournal->writeAppLog("수신 ".strlen($responseBytes)." Bytes");
		}
		
		// 수신 후 메시지 파싱하기
		$responseDTO = $this->parseMessage($responseBytes);
		
		if(LogMode::isAppLogable()){
			$logJournal = NicePayLogJournal::getInstance();
			$logJournal->writeAppLog("결과 -> [".$responseDTO->getParameter("ResultCode")."][".trim($responseDTO->getParameter("ResultMsg"))."]");
		}
		
		return $responseDTO;
		
	}
	
	/**
	 * Create a ByteMessage
	 * @param ParameterSet $webMessageDTO
	 */
	public abstract function createMessage($webMessageDTO);
	
	/**
	 * Send to m&Bank Interface System
	 * @param ParameterSet $webMessageDTO
	 */
	public abstract function send($webMessageDTO);
	
	/**
	 * Receive Bytes Message from m&Bank Interface System. 
	 * Parsing a ByteMessage, Transform Bytes to ParameterSet 
	 * @param ParameterSet $responseBytes
	 */
	public abstract function parseMessage($responseBytes);
	
}
?>
