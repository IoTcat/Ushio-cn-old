<?php

$o = array("code"=>"0000");

$o["url"] = "";


$file = $_FILES['files'];

//print_r ($file);


foreach($file['name'] as $key=>$val){
    if($file['error'][$key]){
        $o['code'] = "500";
	break;
    }
    $imginfo = getimagesize($file["tmp_name"][$key]); 
    $typeArr = explode("/", $imginfo["mime"]);
    if($typeArr[0]== "image"){
        $imgType = array("png","jpg","jpeg","gif","svg");
        if(in_array($typeArr[1], $imgType)){
           $imgpath = "/home/ushio/www/imgbed/upload/imgbed/";
           $imgname = "img_".substr(md5(time().rand()),0,8)."_".$imginfo[0]."x".$imginfo[1]."_".$imginfo['bits']."_null_normal.".$typeArr[1];
          if(!move_uploaded_file($file["tmp_name"][$key], $imgpath.$imgname)){
		$o["code"] = "550";
                break;
	  }
           
	  $o["url"].="https://api.yimian.xyz/img/?path=imgbed/".$imgname."\n\n";
        }

   }else{
       $o["code"] = "560";
       break;
   }
}


echo json_encode($o);

exec('obs cp /home/ushio/www/imgbed/upload/imgbed/ obs://yimian-image/ -r -f');
exec('rm -rf /home/ushio/www/imgbed/upload/imgbed/*');
