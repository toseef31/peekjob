<?php
require_once dirname(__FILE__).'/WebParamGather.php';

/**
 * 
 * @author kblee
 *
 */
class BankWebParamGather implements WebParamGather{
	
	public function BankWebParamGather(){
		
	}
	
	/**
	 * 
	 * @param $request
	 */
	public function gather($request){
		$webParam = new WebMessageDTO();
		
		
		$receitType = $request["CashReceiptType"];
		$hd_pi = $request["hd_pi"];
		$bankCode = $request["BankCode"];
		$receitTypeNo = $request["ReceiptTypeNo"];
		
		$webParam->setParameter(RECEIPT_TYPE,$receitType);
		$webParam->setParameter(RECEIPT_TYPE_NO,$receitTypeNo);
		$webParam->setParameter(BANK_ENC_DATA, $hd_pi);
		$webParam->setParameter(BANK_CODE, $bankCode);
		
		$transType = $request["TransType"] == null ? "0" : $request["TransType"];
		$webParam->setParameter(TRANS_TYPE,$transType);
		
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
		
		
		$ReceiptAmt = $request["Amt"] == null ? "0" : $request["Amt"];
		$webParam->setParameter("ReceiptAmt",$ReceiptAmt);
		
		$ReceiptSupplyAmt = $request["SupplyAmt"] == null ? "0" : $request["SupplyAmt"];
		$webParam->setParameter("ReceiptSupplyAmt",$ReceiptSupplyAmt);
		
		$ReceiptVAT = $request["GoodsVat"] == null ? "0" : $request["GoodsVat"];
		$webParam->setParameter("ReceiptVAT",$ReceiptVAT);
		
		$ReceiptServiceAmt = $request["ServiceAmt"] == null ? "0" : $request["ServiceAmt"];
		$webParam->setParameter("ReceiptServiceAmt",$ReceiptServiceAmt);
		
		$ReceiptTaxFreeAmt = $request["TaxFreeAmt"] == null ? "0" : $request["TaxFreeAmt"];
		$webParam->setParameter("ReceiptTaxFreeAmt",$ReceiptTaxFreeAmt);
		
		return $webParam;
	}
}
?>
