<?php
include './functions.php';

header("Access-Control-Allow-Origin: *");

$fp=$_REQUEST['fp'];
$ip=$_REQUEST['ip'];
$city=$_REQUEST['city'];
$from=$_SERVER['HTTP_REFERER'];
$domain=$_SERVER['HTTP_HOST'];

if(!isset($fp) || !isset($ip) || !isset($domain)) die();

yimian__log("log_iis",array("city"=>$city,"fp"=>$fp,"ip"=>ip2long($ip),"domain"=>get_from_domain(),"url"=>$from,"timestamp"=>date('Y-m-d H:i:s', time())));
