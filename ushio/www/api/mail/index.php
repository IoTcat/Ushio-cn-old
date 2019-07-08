<?php
include '../functions.php';

header('Access-Control-Allow-Origin:*');

if(!isset($_REQUEST['body'])) $_REQUEST['body'] = "";
if(!isset($_REQUEST['from'])) $_REQUEST['from'] = "";


echo json_encode(array("state" => yimian__mail($_REQUEST['to'], $_REQUEST['subject'], $_REQUEST['body'], $_REQUEST['from'])));

yimian__log("log_api", array("api" => "mail", "timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(get_ip()), "_from" => get_from(), "content" => $_REQUEST['to']."|".$_REQUEST['subject']."|".$_REQUEST['body']."|".$_REQUEST['from']));

die();
