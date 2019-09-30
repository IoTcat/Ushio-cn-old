<?php

include '/home/yimian/www/shorturl/functions.php';


Header("HTTP/1.1 301 Moved Permanently"); 


if(!isset($_REQUEST['s'])) {
    Header("Location: https://www.eee.dog/");
    die();
}

$keyword = $_REQUEST['keyword'];
