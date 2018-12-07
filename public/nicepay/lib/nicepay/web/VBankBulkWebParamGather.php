<?php
require_once dirname(__FILE__).'/WebParamGather.php';

/**
 * 
 * @author kblee
 *
 */
class VBankBulkWebParamGather implements WebParamGather{
	
	/**
	 * Default Constructor
	 */
	public function VBankBulkWebParamGather(){
		
	}
	
	/**
	 * 
	 * @param $request
	 */
	public function gather($request) {
		$webParam = new WebMessageDTO();
		
		
		$webParam->setParameter(VBANK_CODE,$request["VbankBankCode"]);


		$webParam->setParameter("VbankNum",$request["VbankNum"]);

		$webParam->setParameter("VbankNum",$request["VbankNum"]);

		$webParam->setParameter(ACCT_NAME,$request["VBankAccountName"]);

		$webParam->setParameter(EXP_DATE,$request["VbankExpDate"]);

		
		$webParam->setParameter("VbankExpTime",$request["VbankExpTime"]);
		
		$transType = $request["TransType"] == null ? "0" : $request["TransType"];
		$webParam->setParameter(TRANS_TYPE,$transType);
		
		$trKey = $request["TrKey"] == null ? "0" : $request["TrKey"];
		$webParam->setParameter(TR_KEY,$trKey);
		
		$CartCnt = $request["CartCnt"] == null ? "0" : $request["CartCnt"];
		$webParam->setParameter("CartCnt",$CartCnt);

		$CartData = $request["CartData"] == null ? "" : $request["CartData"];
		$webParam->setParameter("CartData",$CartData);
		
		return $webParam;
	}
	
}
?>
