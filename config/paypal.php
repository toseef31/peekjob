<?php 
return array(
/** set your paypal credential **/
'client_id' =>'ASZLeOvJTtNQ9O-b8Yg6UAnJsQtm1oiktel6NPW1sPCQRH8JHG8v9GIS1dbZzp5KW-D5i5V5uih8V_yv',
'secret' => 'EPfEnpWFtZ0v-LLm9FdUNnikNnqqgpkvoe48UUE_SYpjBAg5Ykmq7hvsSFRzVevyvUALKI4px1uCtR41',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'live',
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