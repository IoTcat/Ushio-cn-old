<?php

function anti_ddos(){
    
    if(!isset($_COOKIE['_token__']) || $_COOKIE['_token__'] != md5(date('Y-m-d-H').$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'])) {
        setcookie("_token__",md5(date('Y-m-d-H').$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']),time()+1*3600);
        
        echo '<!doctype html><html><script>window.location.reload();</script></html>';
        

        //header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    }
}
