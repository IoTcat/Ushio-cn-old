<?php

include '../functions.php';

header('Access-Control-Allow-Origin:*');

/* anti ddos */
/*if(!isset($_COOKIE['_token__']) || $_COOKIE['_token__'] != md5(date('Y-m-d-H'))) {
    setcookie("_token__",md5(date('Y-m-d-H')),time()+1*3600);
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
}*/


header('content-type: video/mp4');

$path = $_REQUEST['path'];


if($path){

    returnVideo($path);
}


yimian__log("log_api", array("api" => "video", "timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(getIp()), "_from" => get_from(), "content" => $path)); 




function returnVideo($path){
    $url = getVideo($path);
    header("Location: $url");
}

