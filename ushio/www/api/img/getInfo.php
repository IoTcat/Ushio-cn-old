<?php

include '../functions.php';

$arr_os = array();
$arr = array();

exec('obs ls obs://yimian-image/blog', $arr_os);

$str = implode ($arr_os);

preg_match_all('/w*.jpg/', $str, $arr);

print_r($arr);
