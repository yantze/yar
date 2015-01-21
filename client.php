<?php
/*
 * 这个文档是yar学习文档，几乎所有的yar_clint都可以从client.php/conc_client.php/syn_client.php中找到对应的方法
 * author: yantze
 * ref form:https://github.com/laruence/yar
 * ref form:http://blog.weixinhost.com/wei-ming-ming/
 * 2015-01-22 2:37
 */
$arr = array(
    "i"=>123456789,
    "m"=>"some_method",
    "p"=>array("first param", " -last param- ")
);

$body = json_encode($arr);

//mean 1 Integer,1 String, 1 Interger, 1 Interger, 32 Char...
$format = "I1S1I1I1C32C32I1";

// 123456789 is transaction id
// 4 is version
// 1626136448 is magic num
// reserved
$pack = pack($format,123456789,4,1626136448,0,
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','',
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','', strlen($body)
);
$packager_pack = pack("a8", "json");
$protocol_data = $pack.$packager_pack.$body;

$url = "http://192.168.137.121:82/zhi/yar/s.php";
$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_HEADER, 0 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $protocol_data );
$return = curl_exec ( $ch );

$ret_json = strstr($return, "{\"");
$ret_obj  = json_decode($ret_json);
echo $ret_obj->o;
echo $ret_obj->r;

// echo bin2hex($pack);
// print_r($return);
// echo "\n";
// echo bin2hex($return);
?>

<?php
/* // yar Header struct
#ifdef PHP_WIN32
#pragma pack(push)
#pragma pack(1)
#endif
typedef struct _yar_header {
    unsigned int   id;            // transaction id
    unsigned short version;       // protocl version
    unsigned int   magic_num;     // default is: 0x80DFEC60
    unsigned int   reserved;
    unsigned char  provider[32];  // reqeust from who
    unsigned char  token[32];     // request token, used for authentication
    unsigned int   body_len;      // request body len
}
#ifndef PHP_WIN32
__attribute__ ((packed))
#endif
yar_header_t;
#ifdef PHP_WIN32
#pragma pack(pop)
#endif
*/

//request
//When a Client request a remote server, it will send a struct:
array(
   "i" => '', //transaction id
   "m" => '', //the method which being called
   "p" => array(), //parameters
);

//response
//When a server response a result, it will send a struct:
array(
   "i" => '',
   "s" => '', //status
   "r" => '', //return value 
   "o" => '', //output 
   "e" => '', //error or exception
)
?>

