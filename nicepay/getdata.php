<?php 
 header('Access-Control-Allow-Origin: *');
                                                                   
$url = 'http://203.99.61.173/demos/nicepay/data.php';

$data = array('payMethod' => 'nabeel', 'goodsName' => 'value');
$options = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
var_dump($result);
?>