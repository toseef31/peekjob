<?php 
header('Access-Control-Allow-Origin: *');

$response = file_get_contents('http://localhost/nicepay/intro.php?Name="nabeel"');
echo $response


?>