<?php 
header("Content-Type:text/html; charset=utf-8;"); 
/*
*******************************************************
* <결제요청 파라미터>
* 결제시 Form 에 보내는 결제요청 파라미터입니다.
* 샘플페이지에서는 기본(필수) 파라미터만 예시되어 있으며, 
* 추가 가능한 옵션 파라미터는 연동메뉴얼을 참고하세요.
*******************************************************
*/
$goods = $_POST['goodscount'];
$name = $_POST['goodsName'];
$p = $_POST['price'];
$bname = $_POST['buyerName'];
$btel = $_POST['tel'];
$email = $_POST['Email'];



// Sandbox 
// $merchantKey      = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==";   // 상점키
// $merchantID       = "nicepay00m";                           // 상점아이디

// Real
/*$merchantKey= "TMMkIBlPq1SeFjgHSYeUyt8Uw5EmsD9cB4s0Y51ij1yCnwNU+T0BdACyhvXJnyYd0ILO/3vOUGNfHsdsyiHoqQ==";
$merchantID = "slink6412m";*/
$merchantKey= "1XERnJL9H3pG1ON1BuMY1nifyQdjAqus6LXedY15t8r8ggVfHtgoc81eipnBsdS1/Jqv48E/1zF6o1fm8n6WPA==";
$merchantID = "slink5709m";

$goodsCnt         = $goods ;                                    // 결제상품개수
$goodsName        = $name;                           // 결제상품명
$price            = $p;                                 // 결제상품금액	
$buyerName        = $bname;                               // 구매자명
$buyerTel         = $btel;                          // 구매자연락처
$buyerEmail       = $email;                      // 구매자메일주소
$moid             = date("ymdHis").rand(100,999);  
/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
*******************************************************
*/ 
$ediDate = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$merchantID.$price.$merchantKey, true));

/*
******************************************************* 
* <서버 IP값>
*******************************************************
*/
$ip = $_SERVER['REMOTE_ADDR'];    
?>
<!DOCTYPE html>
<html>
<head>
<title>아웃소싱 오케이 결제</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi" />
<link rel="stylesheet" type="text/css" href="./css/import.css"/>
<script src="https://web.nicepay.co.kr/flex/js/nicepay_tr_utf.js" type="text/javascript"></script>
<script type="text/javascript">
//결제창 최초 요청시 실행됩니다.
function nicepayStart(){
    document.getElementById("vExp").value = getTomorrow();
    goPay(document.payForm);
}

//결제 최종 요청시 실행됩니다. <<'nicepaySubmit()' 이름 수정 불가능>>
function nicepaySubmit(){
    document.payForm.submit();
}

//결제창 종료 함수 <<'nicepayClose()' 이름 수정 불가능>>
function nicepayClose(){
    alert("결제가 취소 되었습니다");
}

//가상계좌입금만료일 설정 (today +1)
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
<form name="payForm" method="post" action="payResult_utf.php">
    <div class="payfin_area">
      <div class="top">(주)잡콜미 [아웃소싱 오케이 결제]</div>
      <div class="conwrap">
        <div class="con">
          <div class="tabletypea">
            <table>
              <colgroup><col width="30%" /><col width="*" /></colgroup>
              <tr>
                <th><span>결제 수단</span></th>
                <td>
				  <label> 신용카드 </label>
                  <input type="hidden" name="PayMethod" value="CARD" >
				  <!-- 
                  <select name="PayMethod">
                    <option value="CARD">신용카드</option>
                    <option value="BANK">계좌이체</option>
                    <option value="CELLPHONE">휴대폰결제</option>
                    <option value="VBANK">가상계좌</option>
                  </select>
				  -->
                </td>
              </tr>            
              <tr>
                <th><span>결제 상품명</span></th>
                <td>
                  <label> <?php echo $goodsName; ?> </label>
                  <input type="hidden" name="GoodsName" value="<?=$goodsName?>" >
                </td>
              </tr>			  
              <!-- 
              <tr>
                <th><span>결제 상품개수</span></th>
                <td>
                  <label> <?php echo $goodsCnt; ?> </label>
                  <input type="hidden" name="GoodsCnt" value="<?=$goodsCnt?>" >
                </td>
              </tr>
			  -->	
			  <input type="hidden" name="GoodsCnt" value="<?=$goodsCnt?>" >
              <tr>
                <th><span>결제 상품금액</span></th>
                <td>
                  <label> <?php echo $price; ?> </label>
                  <input type="hidden" name="Amt" value="<?=$price?>" >
                </td>
              </tr>	  
              <tr>
                <th><span>사용자 아이디</span></th>
                <td>
                  <label> <?php echo $buyerName; ?> </label>
                  <input type="hidden" name="BuyerName" value="<?=$buyerName?>" >
                </td>
              </tr>	  
              <tr>
                <th><span>사용자 연락처</span></th>
                <td>
                  <label> <?php echo $buyerTel; ?> </label>
                  <input type="hidden" name="BuyerTel" value="<?=$buyerTel?>" >
                </td>
              </tr>    
              <tr>
                <th><span>서비스 주문번호</span></th>
                <td>
                  <label> <?php echo $moid; ?> </label>
                  <input type="hidden" name="Moid" value="<?=$moid?>" >
                </td>
              </tr>
			  <!-- 
              <tr>
                <th><span>상점 아이디</span></th>
                <td>
                  <label> <?php echo $merchantID; ?> </label>
                  <input type="hidden" name="MID" value="<?=$merchantID?>" >
                </td>
              </tr>              
               -->
			  <input type="hidden" name="MID" value="<?=$merchantID?>" >
              <!-- IP -->
              <input type="hidden" name="UserIP" value="<?=$ip?>"/>                         <!-- 회원사고객IP -->
              
              <!-- 옵션 -->
              <input type="hidden" name="VbankExpDate" id="vExp"/>                          <!-- 가상계좌입금만료일 -->
              <input type="hidden" name="BuyerEmail" value="<?=$buyerEmail?>"/>             <!-- 구매자 이메일 -->				  
              <input type="hidden" name="TransType" value="0"/>                             <!-- 일반(0)/에스크로(1) --> 
              <input type="hidden" name="GoodsCl" value="1"/>                               <!-- 상품구분(실물(1),컨텐츠(0)) -->               
              
              <!-- 변경 불가능 -->
              <input type="hidden" name="EncodeParameters" value=""/>                       <!-- 암호화대상항목 -->
              <input type="hidden" name="EdiDate" value="<?=$ediDate?>"/>                   <!-- 전문 생성일시 -->
              <input type="hidden" name="EncryptData" value="<?=$hashString?>"/>            <!-- 해쉬값	-->
              <input type="hidden" name="TrKey" value=""/>                                  <!-- 필드만 필요 -->
            </table>
          </div>
        </div>
        <div class="btngroup">
          <a href="#" class="btn_blue" onClick="nicepayStart();">결 제</a>
        </div>
      </div>
    </div>
</form>
</body>
</html>