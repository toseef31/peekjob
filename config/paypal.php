<?php 
return array(
/** set your paypal credential **/
'client_id' =>'AXwd2xMBXrZtcWDi-0WI32Bgx3fFAerurkCP7ngnNNS6lqrRYxJcd8ZxtliJVwA_bwtvtD_sd29bGdBR',
'secret' => 'EHQ2rxVOAYFiCZ3ggio3naKCIJFZQ2yRyhg9c2jPmaiOfSY_fcvJAl3lm7BxNi5LCj8YMvMgfE5O2-Xv',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);