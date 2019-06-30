<?php

include '../functions.php';

header('content-type: image/png');

$path = $_REQUEST['path'];
$type = $_REQUEST['type'];
$random = $_REQUEST['random'];
$size = $_REQUEST['size'];
$display = $_REQUEST['display'];


if(!isset($type) || !($type == "moe" || $type == "wallpaper" || $type == "head")) $type = null;
if($random != "false") $random = true; else $random = false;
if(!isset($size) || !($size == 1080 || $size == 480 || $size == "1920x1080")) $size = null;
if(!isset($path)) $path = null;
if($display != "true") $display = false; else $display = true;


if($path){

    $url = getImg($path);
    if($display) echo file_get_contents($url); else header("Location: $url");
    die();
}





