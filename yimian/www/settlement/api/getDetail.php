<?php
header("Access-Control-Allow-Origin: *");

include '/home/yimian/www/settlement/func/functions.php';

$conn = db__connect();
$total_arr = Array();


$sql = "select * from detail order by id DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    array_push($total_arr, $row);
}

echo json_encode(array(
    "code" => 200,
    "data" => $total_arr
));



