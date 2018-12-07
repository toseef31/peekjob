<?php

require_once dirname(__FILE__).'/WebParamGather.php';

class PayCommonWebParamGather implements WebParamGather{
	
	public function PayCommonWebParamGather(){
		
	}
	

	public $charset;

	/**
	 * 
	 * @param $request
	 */
	public function gather($request){
		$webParam = new WebMessageDTO();
		
		
		
		$webParam->setParameter(TID,$request["TID"]);
		$webParam->setParameter(GOODS_CNT,$request["GoodsCnt"]);
		
		if($this->charset=="UTF8"){
			$webParam->setParameter(BUYER_NAME,iconv("UTF-8", "EUC-KR",$request["BuyerName"]));
			$webParam->setParameter(GOODS_NAME,iconv("UTF-8", "EUC-KR",$request["GoodsName"]));
			$webParam->setParameter(BUYER_ADDRESS,iconv("UTF-8", "EUC-KR",$request["BuyerAddr"]));
		}else{
			$webParam->setParameter(BUYER_ADDRESS,$request["BuyerAddr"]);
			$webParam->setParameter(GOODS_NAME,$request["GoodsName"]);
			$webParam->setParameter(BUYER_NAME,$request["BuyerName"]);
		}
		
		$webParam->setParameter(GOODS_AMT,$request["Amt"]);
		$webParam->setParameter(MOID,$request["Moid"]);
		//$webParam->setParameter(CURRENCY,$request["Currency"]);
		$webParam->setParameter(MID,$request["MID"]);
		//$webParam->setParameter(MERCHANT_KEY,$request["EncodeKey"]);

		
		$webParam->setParameter(MALL_IP,isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '');
		$webParam->setParameter(USER_IP,$request["UserIP"]);
		$webParam->setParameter(MALL_RESERVED,isset($request["MallReserved"]) ? $request["MallReserved"] : "");
		$webParam->setParameter(RETRY_URL,isset($request["RetryURL"]) ? $request["RetryURL"] : "");
		$webParam->setParameter(MALL_USER_ID,$request["MallUserID"]);
		
		$webParam->setParameter(BUYER_AUTH_NO,isset($request["BuyerAuthNum"]) ? $request["BuyerAuthNum"] : "");
		$webParam->setParameter(BUYER_TEL,$request["BuyerTel"]);
		$webParam->setParameter(BUYER_EMAIL,$request["BuyerEmail"]);
		$webParam->setParameter(PARENT_EMAIL,isset($request["ParentEmail"]) ? $request["ParentEmail"] : "");
		$webParam->setParameter(BUYER_POST_NO,isset($request["BuyerPostNo"]) ? $request["BuyerPostNo"] : "");
		$webParam->setParameter(SUB_ID,$request["SUB_ID"]);
		
		// 파라미터로 승인 IP, 포트 직접 지정 추가
		$webParam->setParameter(REQUEST_PG_IP,isset($request["requestPgIp"]) ? $request["requestPgIp"] : "");
		$webParam->setParameter(REQUEST_PG_PORT,isset($request["requestPgPort"]) ? $request["requestPgPort"] : NICEPAY_ADAPTOR_LISTEN_PORT);
		$webParam->setParameter("testFlag",isset($request["testFlag"]) ? $request["testFlag"] : "");
		
		return $webParam;
	}
}
?>