<?php
function callback($retval, $callinfo) {
    var_dump($retval);
}

function error_callback($type, $error, $callinfo) {
    // error_log(json_encode($error));
    print_r(json_encode($error));
}

$api_url = "http://127.0.0.1:82/zhi/yar/s.php";
Yar_Concurrent_Client::call($api_url , "some_method", array("parameters"), "callback");
Yar_Concurrent_Client::call($api_url, "some_method", array("parameters"));   // if the callback is not specificed,
// callback in loop will be used
Yar_Concurrent_Client::call($api_url, "some_method", array("parameters"), "callback", "error_callback", array(YAR_OPT_PACKAGER => "json"));
//this server accept json packager
Yar_Concurrent_Client::call($api_url, "some_method", array("parameters"), "callback", "error_callback", array(YAR_OPT_TIMEOUT=>1));
//custom timeout

Yar_Concurrent_Client::loop("callback", "error_callback"); //send the requests,
//the error_callback is optional
?>
