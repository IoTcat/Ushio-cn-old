<?php

include '/home/yimian/www/shorturl/functions.php';


Header("HTTP/1.1 301 Moved Permanently"); 
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

if(!isset($_REQUEST['s'])) {
    Header("Location: https://www.eee.dog/");
    die();
}

$keyword = substr($_REQUEST['s'], 1);

$conn = db__connect();

$res = db__getData($conn, "reflect", "keyword", $keyword);


if($res === 404){
    Header("Location: https://www.eee.dog/");
    die();
}

$cmd = "Location: ".$res[0]['url'];
Header($cmd);
die();
