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

$id = 2003373695;
$type = "playlist";

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
	header("Location: ".$res["url"]);
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





if($type == "single"){
	if(!isset($id)){
		echo json_encode(array("code"=>500, "err"=>"You need to provide an id!!"));
		die();
	}
	$content = get_object_vars(getSongInfo($id, $API)[0]);
	//var_dump($content);
	$o = array("name"=>$content["name"], "artist"=>$content["artist"][0], "album"=>$content["album"], "url"=>"https://api.yimian.xyz/msc/?type=url&id=".$content["url_id"], "cover"=>"https://api.yimian.xyz/msc/?type=cover&id=".$content["pic_id"], "lrc"=>"https://api.yimian.xyz/msc/?type=lrc&id=".$content["lyric_id"]);
	echo json_encode($o);


}


if($type == "playlist"){
	if(!isset($id)){
		echo json_encode(array("code"=>500, "err"=>"You need to provide an id!!"));
		die();
	}
	$content = array();
	$o = array();

	foreach (getPlaylistInfo($id, $API) as $key => $value) {
		$content = get_object_vars($value);
		array_push($o, array("name"=>$content["name"], "artist"=>$content["artist"][0], "album"=>$content["album"], "url"=>"https://api.yimian.xyz/msc/?type=url&id=".$content["url_id"], "cover"=>"https://api.yimian.xyz/msc/?type=cover&id=".$content["pic_id"], "lrc"=>"https://api.yimian.xyz/msc/?type=lrc&id=".$content["lyric_id"]));
	}
	
	if($random) shuffle($o);
	echo json_encode($o);


}




function getSongInfo($id, $API){
	return json_decode($API->format(true)->song($id));
}

function getPlaylistInfo($id, $API){
	return json_decode($API->format(true)->playlist($id));
}



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