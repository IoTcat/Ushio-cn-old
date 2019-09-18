<?php
header("Access-Control-Allow-Origin: *");

include '/home/yimian/www/settlement/func/functions.php';

$conn = db__connect();
$fin = Array();

for($ii = 0; $ii < 10; $ii ++){

$sql = "select * from account where datetime>='".date('Y-m-d',strtotime('-'.($ii+1).' day'))." 00:00:00' and datetime<'".date('Y-m-d', strtotime("-$ii day"))." 00:00:00'";
$result = $conn->query($sql);
    
$i=0;
while($row = $result->fetch_assoc()) {
      $fin[$ii][$i++]=$row;
}

}

echo json_encode(array(
    "code" => 200,
    "data" => $fin
));

