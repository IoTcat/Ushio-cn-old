<?php

include '../functions.php';

header('content-type: image/png');

$path = $_REQUEST['path'];
$type = $_REQUEST['type'];
$id = $_REQUEST['id'];
$size = $_REQUEST['size'];
$display = $_REQUEST['display'];

if(!isset($type) || !($type == "moe" || $type == "koino" || $type == "head" || $type == "wallpaper")) $type = "moe";
if(!isset($id)) $id = null;
if(!isset($size)) $size = null;
if(!isset($path)) $path = null;
if($display != "true") $display = false; else $display = true;

if($path){

    returnImg($path);
}elseif($type){

    $arr = getImgsInfo($type);

    if($id){
        $pos = array_search($id, $arr[1]);
        if($pos) $path = $type. '/' .$arr[0][$pos];
    }

    if(!$size && !$path){
        $path = $type. '/' .$arr[0][array_rand($arr[0])];
    }elseif(strpos($size, '-') && !$path){
        $arr_size = explode('x',$size);
        if(strpos($arr_size[0], '-')) $arr_size_length = explode('-',$arr_size[0]);
        else $arr_size_length = $arr_size[0];
        if(strpos($arr_size[1], '-')) $arr_size_high = explode('-',$arr_size[1]);
        else $arr_size_high = $arr_size[1];
        $arr_length = getMatchedKeys($arr_size_length, $arr[2]);
        $arr_high = getMatchedKeys($arr_size_high, $arr[3]);
        if($arr_size[0] == '*') $arr_keys = $arr_high;
        elseif($arr_size[1] == '*') $arr_keys = $arr_length;
        else $arr_keys = array_intersect($arr_length, $arr_high);
        if(!count($arr_keys)){
            header('content-type: application/json');
            echo json_encode(array("err"=>"Can not find any images matching Size $size in Type $type!!"));
            die();
        }
        $path = $type. '/' .$arr[0][$arr_keys[array_rand($arr_keys)]];
        
    }elseif(!$path){
        $arr_size = explode('x',$size);
        $arr_length = getMatchedKeys($arr_size[0], $arr[2]);
        $arr_high = getMatchedKeys($arr_size[1], $arr[3]);
        if($arr_size[0] == '*' && $arr_size[1] == '*') $arr_keys = getMatchedKeys(array(0=>0,1=>9999), $arr[2]);
        elseif($arr_size[0] == '*') $arr_keys = $arr_high;
        elseif($arr_size[1] == '*') $arr_keys = $arr_length;
        else $arr_keys = array_intersect($arr_length, $arr_high);
        if(!count($arr_keys)){
            header('content-type: application/json');
            echo json_encode(array("err"=>"Can not find any images matching Size $size in Type $type!!"));
            die();
        }
        $path = $type. '/' .$arr[0][$arr_keys[array_rand($arr_keys)]];

    }

    returnImg($path);
 
}else{

    die();
}


yimian__log("log_api", array("api" => "img", "timestamp" => date('Y-m-d H:i:s', time()), "ip" => ip2long(getIp()), "_from" => get_from(), "content" => $path)); 




function returnImg($path){
    $url = getImg($path);
    if($GLOBALS['display']) echo file_get_contents($url); else header("Location: $url");
}

function getMatchedKeys($str, $arr){
    if(!is_array($str)){
        $o = array();
        foreach($arr as $key=>$val){
            if($val == $str) array_push($o, $key);
        }
        return $o;
    }else{
        $o = array();
        foreach($arr as $key=>$val){
            if($val >= $str[0] && $val <= $str [1]) array_push($o, $key);
        }
        return $o;
    }   
}
