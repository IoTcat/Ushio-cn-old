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
           $imgpath = "/home/yimian/www/settlement/imgbed/upload/invoice/";
           $imgname = "img_".substr(md5(time().rand()),0,8)."_".$imginfo[0]."x".$imginfo[1]."_".$imginfo['bits']."_null_normal.".$typeArr[1];
          if(!move_uploaded_file($file["tmp_name"][$key], $imgpath.$imgname)){
		$o["code"] = "550";
                break;
	  }
           
	  $o["url"].="https://settlement.yimian.xyz/imgbed/upload/invoice/".$imgname."\n\n";
        }

   }else{
       $o["code"] = "560";
       break;
   }
}


echo json_encode($o);

//exec('obs cp /home/yimian/www/settlement/imgbed/upload/invoice/ obs://yimian-image/ -r -f');
//exec('rm -rf /home/yimian/www/settlement/imgbed/upload/invoice/*');
