<?php
require_once dirname(__FILE__).'/WebParamGather.php';

/**
 * 
 * @author kblee
 *
 */
class CellPhoneWebParamGather implements WebParamGather{
	
	/**
	 * 
	 */
	public function CellPhoneWebParamGather(){
		
	}
	
	/**
	 * 
	 * @param  $request
	 */
	public function gather($request){
		$webParam = new WebMessageDTO();
		
		$serverInfo = $request["ServerInfo"];
		$webParam->setParameter(SERVER_INFO,$serverInfo);
		
		$carrier = $request["Carrier"];
		$webParam->setParameter(CARRIER,$carrier);
		
		
		$smsOTP = $request["OTP"];
		$webParam->setParameter(SMS_OTP,$smsOTP);
		
		$cpTID = $request["CPID"];
		$webParam->setParameter(CP_TID,$cpTID);
		
		$dstAddr = $request["DstAddr"];
		$webParam->setParameter(DST_ADDR,$dstAddr);
		
		$encodeTID = $request["EncodeTID"];
		$webParam->setParameter(ENCODED_TID,$encodeTID);
		
		
		$iden = $request["Iden"];
		$webParam->setParameter(IDEN,$iden);
		
		$recKey = $request["RecKey"];
		$webParam->setParameter(REC_KEY,$recKey);
		
		$phoneID = $request["PhoneID"];
		$webParam->setParameter(PHONE_ID,$phoneID);
		
		$fnCd = $request["FnCd"];
		$webParam->setParameter(FN_CD,$fnCd);
		
		$goodsCl = $request["GoodsCl"];
		$webParam->setParameter(GOODS_CL,$goodsCl);

		$trKey = $request["TrKey"] == null ? "0" : $request["TrKey"];
		$webParam->setParameter(TR_KEY,$trKey);
		
		$ServiceAmt = $request["ServiceAmt"] == null ? "0" : $request["ServiceAmt"];
		$webParam->setParameter("ServiceAmt",$ServiceAmt);
		

		$GoodsVat = $request["GoodsVat"] == null ? "0" : $request["GoodsVat"];
		$webParam->setParameter("GoodsVat",$GoodsVat);
		

		$SupplyAmt = $request["SupplyAmt"] == null ? "0" : $request["SupplyAmt"];
		$webParam->setParameter("SupplyAmt",$SupplyAmt);
		

		$TaxFreeAmt = $request["TaxFreeAmt"] == null ? "0" : $request["TaxFreeAmt"];
		$webParam->setParameter("TaxFreeAmt",$TaxFreeAmt);
		
		return $webParam;
	}
	
}
?>
