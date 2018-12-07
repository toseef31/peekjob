<?php

/**
 * 
 * @author kblee
 *
 */
class CancelWebParamGather implements WebParamGather {
	
	/**
	 * 
	 */
	public function CancelWebParamGather(){
		
	}
	
	
	/**
	 * 
	 * @param $request
	 */
	public function gather($request){
		
		$webParam = new WebMessageDTO();
		
		$tid = $request["TID"];
		
		$svcCd = "";
		
		if(strlen($tid)>=30){
			$svcCd = substr($tid,10, 2);
		}
		$payMethod = "";
		if(SVC_CD_CARD == $svcCd){
			$payMethod = CARD_PAY_METHOD;
		}else if(SVC_CD_BANK == $svcCd){
			$payMethod = BANK_PAY_METHOD;
		}else if(SVC_CD_CELLPHONE == $svcCd){
			$payMethod = CELLPHONE_PAY_METHOD;
		}else if(SVC_CD_RECEIPT == $svcCd){
			$payMethod = CASHRCPT_PAY_METHOD;
		}else if(SVC_CD_VBANK == $svcCd){
			$payMethod = VBANK_PAY_METHOD;
		}else if(SVC_CD_TENPAY == $svcCd){
			// 텐페이-위챗페이
			$payMethod = TENPAY_PAY_METHOD;
		}else if(SVC_CD_GIFT_SSG == $svcCd){
			// SSG머니
			$payMethod = GIFT_SSG_PAY_METHOD;
		}else if(SVC_CD_QQPAY == $svcCd){
			// 텐페이-QQ페이
			$payMethod = QQPAY_PAY_METHOD;
		}else if(SVC_CD_ALIPAY == $svcCd){
			// 알리페이
			$payMethod = ALIPAY_PAY_METHOD;
		}else if(SVC_CD_BANK_SSG == $svcCd){
			// SSG은행직불
			$payMethod = BANK_SSG_PAY_METHOD;
		}

		$webParam->setParameter(PAY_METHOD, $payMethod);
		
		$cancelAmt = $request["CancelAmt"];
		$webParam->setParameter(CANCEL_AMT, $cancelAmt);
		
		$cancelPwd = $request["CancelPwd"];
		$webParam->setParameter(CANCEL_PWD, $cancelPwd);
		
		$cancelMsg = $request["CancelMsg"];
		$webParam->setParameter(CANCEL_MSG, $cancelMsg);
		
		$cancelIP = $request["CancelIP"];
		$webParam->setParameter(CANCEL_IP, $cancelIP);
		
		$partialCancelCode = $request["PartialCancelCode"];
		$webParam->setParameter(PARTIAL_CANCEL_CODE,$partialCancelCode);

		$ServiceAmt = $request["ServiceAmt"] == null ? "0" : $request["ServiceAmt"];
		$webParam->setParameter("ServiceAmt",$ServiceAmt);
		
		$GoodsVat = $request["GoodsVat"] == null ? "0" : $request["GoodsVat"];
		$webParam->setParameter("GoodsVat",$GoodsVat);
		
		$SupplyAmt = $request["SupplyAmt"] == null ? "0" : $request["SupplyAmt"];
		$webParam->setParameter("SupplyAmt",$SupplyAmt);
		
		$TaxFreeAmt = $request["TaxFreeAmt"] == null ? "0" : $request["TaxFreeAmt"];
		$webParam->setParameter("TaxFreeAmt",$TaxFreeAmt);
		
		$CcPartRemainAmt = $request["CcPartRemainAmt"] == null ? "" : $request["CcPartRemainAmt"];
		$webParam->setParameter("CcPartRemainAmt",$CcPartRemainAmt);

		$TransCl = $request["TransCl"] == null ? "" : $request["TransCl"];
		$webParam->setParameter("TransCl",$TransCl);

		$TrKey = $request["TrKey"] == null ? "" : $request["TrKey"];
		$webParam->setParameter("TrKey",$TrKey);

		return $webParam;
	}
	
}
?>
