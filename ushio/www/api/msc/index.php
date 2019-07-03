<?php

require 'vendor/autoload.php';
include '../functions.php';

header("Content-Type: application/json;charset=utf-8");

use Metowolf\Meting;

$API = new Meting('netease');

$type = $_REQUEST['type'];
$id = $_REQUEST['id'];
$random = $_REQUEST['random'];
$limit = $_REQUEST['limit'];

$id = 36308263;

if($type == "url"){
	if(!isset($id)){
		echo json_encode(array("code"=>500, "err"=>"You need to provide an id!!"));
		die();
	}
	$res = get_object_vars(json_decode($API->format(true)->url($id, 320)));
	if(in_array("url", $res)){
		echo json_encode(array("code"=>404, "err"=>"No Found!!"));
		die();
	}
	log_api();
	header("Location: ".$res['url']);
	die();
}


if($type == "cover"){
	if(!isset($id)){
		echo json_encode(array("code"=>500, "err"=>"You need to provide an id!!"));
		die();
	}
	$res = get_object_vars(json_decode($API->format(true)->pic($id)));
	if(in_array("url", $res)){
		echo json_encode(array("code"=>404, "err"=>"No Found!!"));
		die();
	}
	log_api();
	echo json_encode(array("cover"=>$res["url"]));
	die();
}



if($type == "lrc"){
	if(!isset($id)){
		echo json_encode(array("code"=>500, "err"=>"You need to provide an id!!"));
		die();
	}
	$res = get_object_vars(json_decode($API->format(true)->lyric($id)));
	if(in_array("lyric", $res)){
		echo json_encode(array("code"=>404, "err"=>"No Found!!"));
		die();
	}
	log_api();
	header("Content-Type: text/plain;charset=utf-8");
	echo $res["lyric"];
	die();
}



/*

if($type == "single"){
	if(!isset($id)){
		echo json_encode(array("code"=>500, "err"=>"You need to provide an id!!"));
		die();
	}
	$url = get_object_vars(json_decode($API->format(true)->url($id, 320)));

}

*/


/*

function getDetail($id){

	$url = get_object_vars(json_decode($API->format(true)->url($id, 320)));
	$pic = get_object_vars(json_decode($API->format(true)->pic($id)));
}
*/

	//echo $API->format(true)->song($id);
	//echo $API->format(true)->pic($id);


// Use custom cookie (option)
// $api->cookie('paste your cookie');

// Get data
//$data = $api->format(true)->search('双笙');

//var_dump($data);

//$data = json_decode($data);

//echo json_encode($data[0]);


// Parse link
//$data = $api->format(true)->url(35847388);

//echo $data;






function log_api(){
	return;
}