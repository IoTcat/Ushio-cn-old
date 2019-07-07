<?php
include 'functions.php';

header("Access-Control-Allow-Origin: *");

$conn = db__connect("log");

$img = db__rowNum($conn, "log_api", "api", "img");
$msc = db__rowNum($conn, "log_api", "api", "msc");
$words = db__rowNum($conn, "log_api", "api", "words");
$mail = db__rowNum($conn, "log_api", "api", "mail");
$gugu = db__rowNum($conn, "log_api", "api", "gugu");;

echo json_encode(array("img"=>$img, "msc"=>$msc, "words"=>$words, "mail"=>$mail, "gugu"=>$gugu));

