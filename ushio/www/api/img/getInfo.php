<?php

include '../functions.php';

$arr_os = array();
$arr = array();

exec('obs ls obs://yimian-image/koino', $arr_os);

$str = implode ($arr_os);

preg_match_all('/img_(\S*?)_(\d{2,4})x(\d{2,4})_(\S*?).(jpe?g|png|gif|svg)\b/', $str, $arr);

//print_r($arr);
var_dump($arr);
