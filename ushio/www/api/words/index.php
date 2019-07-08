<?php

include '../functions.php';

/* anti ddos */
/*if(!isset($_COOKIE['_token__']) || $_COOKIE['_token__'] != md5(date('Y-m-d-H'))) {
    setcookie("_token__",md5(date('Y-m-d-H')),time()+1*3600);
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
}*/


header('Access-Control-Allow-Origin:*');

$conn = db__connect("yulu");

$rand = rand(1, db__rowNum($conn, "yulu"));

$words = db__getData($conn, "yulu", "wid", $rand);

echo $words[0]['words'];

yimian__log("log_api", array("api" => "words", "timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(getIp()), "_from" => get_from(), "content" => $words[0]['words']));
