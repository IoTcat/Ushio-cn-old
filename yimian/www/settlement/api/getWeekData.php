<?php
header("Access-Control-Allow-Origin: *");

include '/home/yimian/www/settlement/func/functions.php';

$conn = db__connect();
$total_arr = Array();


$sql = "select * from account limit 1";
$result = $conn->query($sql);
$firstItem = $result->fetch_assoc();

$firstTime = $firstItem['datetime'];
$firstDate = substr($firstTime, 0, 10);

$datetime_start = date_create($firstDate);
$datetime_end = date_create(date('Y-m-d'));
$days = date_diff($datetime_start, $datetime_end)->days;

for($ii = 0; $ii < (($days < 30) ? $days: 30); $ii ++){

$sql = "select * from account where datetime>='".date('Y-m-d',strtotime('-'.($ii+1).' day'))." 00:00:00' and datetime<'".date('Y-m-d', strtotime("-$ii day"))." 00:00:00' order by id DESC limit 1";
$result = $conn->query($sql);
    
static $tmp = 0;
while($row = $result->fetch_assoc()) {
    $tmp = $row['total'];
    }
  $total_arr[$ii]['date']=date('Y-m-d', strtotime('-'.($ii+1).'day'));
  $total_arr[$ii]['total']=$tmp;


}

for($i = 0; $i < count($total_arr); $i++){
     if($i < count($total_arr) - 1) $total_arr[$i]['val'] = $total_arr[$i]['total'] - $total_arr[$i+1]['total'];
    else $total_arr[$i]['val'] = 0;
}

for($i = 0; $i < count($total_arr); $i ++){
    if($i < count($total_arr) - 7) $total_arr[$i]['week_val'] = $total_arr[$i]['total'] - $total_arr[$i+7]['total'];
    else $total_arr[$i]['week_val'] = 0;
}

echo json_encode(array(
    "code" => 200,
    "data" => $total_arr
));



