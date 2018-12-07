<?php

require_once dirname(__FILE__).'/WebParamsCrypto.php';

class NicePayHttpServletRequestWrapper{
	
	private $httpRequest;
	
	const PRIVATE_ENC_KEY_NAME = 'EncodeKey';
	
	const PRIVATE_ENC_TARGET_NAME = 'EncodeParameters';
	
	public function NicePayHttpServletRequestWrapper($httpRequest){
		$this->httpRequest = $httpRequest;
		$this->initailizeHttpRequestParams();
	}
	
	private function initailizeHttpRequestParams(){
		$httpParamMap = array();
		$decryptTargetNames = $this->httpRequest[NicePayHttpServletRequestWrapper::PRIVATE_ENC_TARGET_NAME];
		
		
		$decryptKeySet = array();
		if(isset($decryptTargetNames) && $decryptTargetNames!==""){
			$decryptFormNames = explode(",",$decryptTargetNames);
			foreach($decryptFormNames as $key=>$value){
				$decryptKeySet[$key] = $value;
			}
		}
		
		foreach($this->httpRequest as $key=>$value){
			// 암호화된 것이므로 복호화 해야 된당께.
			if(isset($decryptKeySet) && $this->isTargetDecrypt($key,$decryptKeySet)){
				$privateKey = $this->httpRequest[NicePayHttpServletRequestWrapper::PRIVATE_ENC_KEY_NAME];
				$webParamCrypto = new WebParamsCrypto($privateKey);
				$this->httpRequest[$key] = $webParamCrypto->decrypt($value);
			}
			
		}
		
		
	}
	
	public function getHttpRequestMap(){
		return $this->httpRequest;
	}
	
	private function isTargetDecrypt($formName, $decryptKeySet){
		$isEncrypt = false;
		foreach($decryptKeySet as $key=>$value){
			if($formName == $value){
				$isEncrypt = true;
				break;
			}
		}
		return $isEncrypt;
	}
	
	
}

?>
