<?php
include '../functions.php';

$url = $_REQUEST['url'];

if(!isset($url)) die();

$conn = db__connect();

if(!db__rowNum($conn, "video", "url", $url)) {
    die();
}


$res = db__getData($conn, "video", "url", $url);


echo json_encode($res[0]);
