<?php

include '../functions.php';

$address = $_REQUEST['address'];
$code = $_REQUEST['code'];
$fp = $_REQUEST['fp'];


// TEST PURPOSE
$address = "18118155257";
$code = "877148";
$fp = "12345378";


// exclude illegal request
if(!isset($address) || !isset($code) || !is_numeric($code) || !isset($fp)) die(json_encode(array(
    "code" => 500,
    "message" => 'Illegal Request!!'
)));

// check is exist
if(!db__rowNum(db__connect(), "vercode", "address", $address, "vercode", $code)){
    die(json_encode(array(
        "code" => 404,
        "message" => "No Such Record!!"
    )));
}

// get data
$res = db__getData(db__connect(), "vercode", "address", $address, "vercode", $code);

// expire
if(strtotime($res[count($res) - 1]['expire']) < time()){
    die(json_encode(array(
        "code" => 403,
        "message" => "Already expired!"
    )));
}

// wrong fp
if($res[count($res) - 1]['fp'] != $fp){
    die(json_encode(array(
        "code" => 401,
        "message" => "Wrong fp!!"
    )));
}


// success
echo json_encode(array(
    "code" => 0,
    "message" => "Vercode confirmed!!"
));
