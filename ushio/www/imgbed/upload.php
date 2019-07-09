<?php

$o = array("code"=>"0000");

$o["url"] = "https://eeeeeee";


$file = $_FILES['files'];

//print_r ($file);


foreach($file['name'] as $key=>$val){
    if($file['error'][$key]){
        $o['code'] = "500";
	break;
    }
    $typeArr = explode("/", $file["type"][$key]);
    if($typeArr[0]== "image"){
        $imgType = array("png","jpg","jpeg","gif","svg");
        if(in_array($typeArr[1], $imgType)){
            chmod($file["tmp_name"][$key],0755);
            $imgname = "/tmp/img_".substr(time(),0,8)."_ooxoo_95_null_normal.".$typeArr[1];
$imgname="/tmp/kk.png";
            echo move_uploaded_file($file["tmp_name"][$key], $imgname)){
	//	$o["code"] = "550";
	    
        }

   }
}


exec('obs cp /tmp/imgbed/ obs://yimian-image/ -r -f');
echo json_encode($o);
