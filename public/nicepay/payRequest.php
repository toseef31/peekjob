<?php 
header("Content-Type:text/html; charset=euc-kr;"); 
/*
*******************************************************
* <������û �Ķ����>
* ������ Form �� ������ ������û �Ķ�����Դϴ�.
* ���������������� �⺻(�ʼ�) �Ķ���͸� ���õǾ� ������, 
* �߰� ������ �ɼ� �Ķ���ʹ� �����޴����� �����ϼ���.
*******************************************************
*/
$merchantKey      = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==";   // ����Ű
$merchantID       = "nicepay00m";                           // �������̵�
$goodsCnt         = "1";                                    // ������ǰ����
$goodsName        = "���̽�����";                           // ������ǰ��
$price            = "1004";                                 // ������ǰ�ݾ�	
$buyerName        = "���̽�";                               // �����ڸ�
$buyerTel         = "01000000000";                          // �����ڿ���ó
$buyerEmail       = "happy@day.co.kr";                      // �����ڸ����ּ�
$moid             = "mnoid1234567890";                      // ��ǰ�ֹ���ȣ

/*
*******************************************************
* <�ؽ���ȣȭ> (�������� ������)
* SHA-256 �ؽ���ȣȭ�� �ŷ� �������� �������� ����Դϴ�. 
*******************************************************
*/ 
$ediDate = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$merchantID.$price.$merchantKey, true));

/*
******************************************************* 
* <���� IP��>
*******************************************************
*/
$ip = $_SERVER['REMOTE_ADDR'];    
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(EUC-KR)</title>
<meta charset="euc-kr">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi" />
<link rel="stylesheet" type="text/css" href="./css/import.css"/>
<script src="https://web.nicepay.co.kr/flex/js/nicepay_tr_utf.js" type="text/javascript"></script>
<script type="text/javascript">
//����â ���� ��û�� ����˴ϴ�.
function nicepayStart(){
    document.getElementById("vExp").value = getTomorrow();
    goPay(document.payForm);
}

//���� ���� ��û�� ����˴ϴ�. <<'nicepaySubmit()' �̸� ���� �Ұ���>>
function nicepaySubmit(){
    document.payForm.submit();
}

//����â ���� �Լ� <<'nicepayClose()' �̸� ���� �Ұ���>>
function nicepayClose(){
    alert("������ ��� �Ǿ����ϴ�");
}

//��������Աݸ����� ���� (today +1)
function getTomorrow(){
    var today = new Date();
    var yyyy = today.getFullYear().toString();
    var mm = (today.getMonth()+1).toString();
    var dd = (today.getDate()+1).toString();
    if(mm.length < 2){mm = '0' + mm;}
    if(dd.length < 2){dd = '0' + dd;}
    return (yyyy + mm + dd);
}
</script>
</head>
<body>
<form name="payForm" method="post" action="payResult.php">
    <div class="payfin_area">
      <div class="top">NICEPAY PAY REQUEST(EUC-KR)</div>
      <div class="conwrap">
        <div class="con">
          <div class="tabletypea">
            <table>
              <colgroup><col width="30%" /><col width="*" /></colgroup>
              <tr>
                <th><span>���� ����</span></th>
                <td>
                  <select name="PayMethod">
                    <option value="CARD">�ſ�ī��</option>
                    <option value="BANK">������ü</option>
                    <option value="CELLPHONE">�޴�������</option>
                    <option value="VBANK">�������</option>
                  </select>
                </td>
              </tr>         
              <tr>
                <th><span>���� ��ǰ�ݾ�</span></th>
                <td><?=$price?></td>
              </tr>   
              <!--<tr>
                <th><span>���� ��ǰ��</span></th>
                <td></td>
              </tr>			  -->
              <input type="hidden" name="GoodsName" value="<?=$goodsName?>">
              <!--<tr>
                <th><span>���� ��ǰ����</span></th>
                <td></td>
              </tr>	-->
              <input type="hidden" name="GoodsCnt" value="<?=$goodsCnt?>">  
              <!--<tr>
                <th><span>���� ��ǰ�ݾ�</span></th>
                <td></td>
              </tr>	  -->
              <input type="hidden" name="Amt" value="<?=$price?>">
              <!--<tr>
                <th><span>�����ڸ�</span></th>
                <td></td>
              </tr>	 -->
              <input type="hidden" name="BuyerName" value="<?=$buyerName?>"> 
              <tr>
                <th><span>������ ����ó</span></th>
                <td><input type="text" name="BuyerTel" value="<?=$buyerTel?>"></td>
              </tr>    
              <!--<tr>
                <th><span>��ǰ �ֹ���ȣ</span></th>
                <td></td>
              </tr>-->
              <input type="hidden" name="Moid" value="<?=$moid?>">
              <!--<tr>
                <th><span>���� ���̵�</span></th>
                <td></td>
              </tr>         -->
              <input type="hidden" name="MID" value="<?=$merchantID?>">     
                          
              <!-- IP -->
              <input type="hidden" name="UserIP" value="<?=$ip?>"/>                         <!-- ȸ�����IP -->
              
              <!-- �ɼ� -->
              <input type="hidden" name="VbankExpDate" id="vExp"/>                          <!-- ��������Աݸ����� -->
              <input type="hidden" name="BuyerEmail" value="<?=$buyerEmail?>"/>             <!-- ������ �̸��� -->				  
              <input type="hidden" name="TransType" value="0"/>                             <!-- �Ϲ�(0)/����ũ��(1) --> 
              <input type="hidden" name="GoodsCl" value="1"/>                               <!-- ��ǰ����(�ǹ�(1),������(0)) -->              
              
              <!-- ���� �Ұ��� -->
              <input type="hidden" name="EncodeParameters" value=""/>                       <!-- ��ȣȭ����׸� -->
              <input type="hidden" name="EdiDate" value="<?=$ediDate?>"/>                   <!-- ���� �����Ͻ� -->
              <input type="hidden" name="EncryptData" value="<?=$hashString?>"/>            <!-- �ؽ���	-->
              <input type="hidden" name="TrKey" value=""/>                                  <!-- �ʵ常 �ʿ� -->
            </table>
          </div>
        </div>
        <div class="btngroup">
          <a href="#" class="btn_blue" onClick="nicepayStart();">�� û</a>
        </div>
      </div>
    </div>
</form>
</body>
</html>