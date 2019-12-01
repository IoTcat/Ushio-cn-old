<?php

$_expireTime = 5 * 60;

include '../functions.php';

$tel = $_REQUEST['tel'];
$fp = $_REQUEST['fp'];


// TEST PURPOSE
$tel = "18118155257";
$fp = "12345678";


// exclude illegal request
if(!isset($tel) || !isset($fp)) die(json_encode(array(
    "code" => 500,
    "message" => 'Illegal Request!!'
)));

// get vercode
$vercode = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);

// insert record to db
db__pushData(db__connect(), "vercode", array(
    "uid" => 1,
    "vercode" => $vercode,
    "expire" => date('Y-m-d H:i:s',time() + $_expireTime),
    "method" => "sms",
    "address" => $tel,
    "fp" => $fp
));

// sms
yimian__sms($tel, 3, "", "验证码", $vercode);


// success
echo json_encode(array(
    "code" => 0,
    "message" => "SMS sent successfully!!"
));
