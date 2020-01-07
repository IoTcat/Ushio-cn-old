<?php

include '../functions.php';

header('Access-Control-Allow-Origin:*');

$to = $_REQUEST['to'];
$template = $_REQUEST['template'];
$s0 = $_REQUEST['s0'];
$s1 = $_REQUEST['s1'];
$s2 = $_REQUEST['s2'];
$t = $_REQUEST['t'];

if(!isset($to)) die('Target Tel not Specified!!');
if(!isset($t) || $t < time() - 10) die('Illegal Visit!!!');
if(!isset($template)) $template = 1;
if(!isset($s0)) $s0 = "";
if(!isset($s1)) $s1 = "";
if(!isset($s2)) $s2 = "";


yimian__sms($to, $template, $s0, $s1, $s2);
