<?php
$client = new Yar_Client("http://192.168.137.121:82/zhi/yar/s.php");
/* the following setopt is optinal */
//Set timeout to 1s
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);

//Set packager to JSON
$client->SetOpt(YAR_OPT_PACKAGER, "json");

/* call remote service */
// $result = $client->some_method("parameter", "hahhahhaha");
$result = $client->some_method("parameter", "parame");
echo "<br>";
var_dump($result);
?>
