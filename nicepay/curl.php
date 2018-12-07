<?php

$url = "https://outsourcingok.com/api/users/nicepay";
// $data = http_build_query(array('paymentMethod' => 'NICEPAY', 'goodsName' => 'PROJECT FEE'));

$data = http_build_query(array('resultCode' => $resultCode, 
                'authDate' => 'Nov 28', 
                'buyerName' => 'toseef3', 
                'amt' => 5 ));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTREDIR, 3);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
var_dump($server_output);
curl_close ($ch);


// $data = array('paymentMethod' => 'NICEPAY', 'goodsName' => 'PROJECT FEE');

//  $string = http_build_query($data);

//  // $ch = curl_init("203.99.61.173/demos/nicepay/data.php");
//  $ch = curl_init("https://outsourcingok.com/api/users/nicepay");
//  curl_setopt($ch, CURLOPT_POST, true);
//  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//  $response = curl_exec($ch);

//  var_dump($response);

//  curl_close($ch);

?>
