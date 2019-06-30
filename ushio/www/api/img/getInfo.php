<?php

include '../functions.php';

$arr = array();

$str = system('obs ls obs://yimian-image/blog');

preg_match_all('/wiot/i', $str, $arr);

print_r($arr);
