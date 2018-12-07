<?php
$goods = $_POST['goodsName'];
echo $goods;
$good = $_POST['payMethod'];
echo $good;
?>

<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(EUC-KR)</title>
<meta charset="euc-kr">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi" />
</head>
<body>

<form action="payRequest_utf.php" method="post">
 <div id="formtext">Goods No</div>
        <input type="text" name="goodscount">
                <div id="formtext">Goods Name</div>
        <input type="text" name="goodsName">
		        <div id="formtext">Price</div>
        <input type="text" name="price">
		        <div id="formtext">Buyer Name</div>
        <input type="text" name="buyerName">
		        <div id="formtext">Buyer Tel</div>
        <input type="number" name="tel">
               <div id="formtext"><br>Buyer Email</div>
        <input type="text" name="Email"><br>
               <br><br>
        <input type="submit" name="submit" value="Submit">

</form>

</body>
</html>