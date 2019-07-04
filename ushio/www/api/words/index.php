<?php

include '../functions.php';

header('Access-Control-Allow-Origin:*');

$conn = db__connect("yulu");

$rand = rand(1, db__rowNum($conn, "yulu"));

$words = db__getData($conn, "yulu", "wid", $rand);

echo $words[0]['words'];

yimian__log("log_api", array("api" => "words", "timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(getIp()), "_from" => get_from(), "content" => $words[0]['words']));
