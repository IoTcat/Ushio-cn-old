<?php
include '../functions.php';

$type = $_REQUEST['type'];

$arr = getImgsInfo($type);

echo json_encode($arr);
