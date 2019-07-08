<?php
include 'functions.php';

/* anti ddos */
/*if(!isset($_COOKIE['_token__']) || $_COOKIE['_token__'] != md5(date('Y-m-d-H'))) {
    setcookie("_token__",md5(date('Y-m-d-H')),time()+1*3600);
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
}*/


header("Access-Control-Allow-Origin: *");

$conn = db__connect("log");

$img = db__rowNum($conn, "log_api", "api", "img");
$msc = db__rowNum($conn, "log_api", "api", "msc");
$words = db__rowNum($conn, "log_api", "api", "words");
$mail = db__rowNum($conn, "log_api", "api", "mail");
$gugu = db__rowNum($conn, "log_api", "api", "gugu");;

echo json_encode(array("img"=>$img, "msc"=>$msc, "words"=>$words, "mail"=>$mail, "gugu"=>$gugu));

