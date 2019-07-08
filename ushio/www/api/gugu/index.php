<?php
include '../functions.php';
header('Access-Control-Allow-Origin:*');

$error = "";

if(!isset($_REQUEST['ak'])) $error .= "ak, ";
if(!isset($_REQUEST['userID'])) $error .= "userID, ";
if(!isset($_REQUEST['memobirdID'])) $error .= "memobirdID, ";
if(!isset($_REQUEST['body'])) $error .= "body, ";


if($error != ""){

    $error = substr($error, 0, -2);
    $error .= "参数未填写！！";

    echo json_encode(array("showapi_res_code" => 0, "showapi_res_error" => $error));
    die();
}


$body = $_REQUEST['body'];
$ak = strtolower($_REQUEST['ak']);
$userID = $_REQUEST['userID'];
$memobirdID = strtolower($_REQUEST['memobirdID']);


$res = gugu__send($ak, $userID, $memobirdID, $body);

if(strpos($res,'showapi_res_code') === false){

    $error = "";

    if(strlen($ak) != 32 || !ctype_alnum($ak)) $error .= "ak, ";
    if(strlen($userID) != 6 || !is_numeric($userID)) $error .= "咕咕号, ";
    if(strlen($memobirdID) != 16 || !ctype_alnum($memobirdID)) $error .= "咕咕机编号, ";

    if($error != ""){

        $error = substr($error,0,-2);
        $error .= "格式错误！！";        
    }else{

        $error .= "ak, 咕咕号或咕咕机编号错误!";  
    }
    
    echo json_encode(array("showapi_res_code" => 0, "showapi_res_error" => $error));
}else{

    echo $res;
}

yimian__log("log_gugu", array("timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(get_ip()), "body" => $body, "who" => md5($userID) /* 经md5不可逆加密，仅用于区分用户 */));

yimian__log("log_api", array("api" => "gugu", "timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(get_ip()), "_from" => get_from(), "content" => md5($userID).": ".md5($body)/* 经md5加密，仅用于区分不同内容*/));


die();
