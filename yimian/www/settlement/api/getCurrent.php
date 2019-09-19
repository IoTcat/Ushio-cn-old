<?php
header("Access-Control-Allow-Origin: *");

include '/home/yimian/www/settlement/func/functions.php';

if(!isset($_REQUEST['usr'])){
    die();
}

$usr = $_REQUEST['usr'];

$conn = db__connect();
$total_arr = db__getData($conn, 'current', "status", "0");

$fin = Array();

foreach($total_arr as $item){
    if($item['usr_to'] == $usr || $item['usr_from'] == $usr){
        array_push($fin, $item);
    }
}


echo json_encode(array(
    "code" => 200,
    "data" => $fin
));



