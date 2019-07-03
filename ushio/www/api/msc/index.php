<?php

require 'vendor/autoload.php';
include '../functions.php';

use Metowolf\Meting;

$api = new Meting('netease');

$type = $_REQUEST['type'];
$id = $_REQUEST['id'];
$random = $_REQUEST['random'];
$limit = $_REQUEST['limit'];




// Use custom cookie (option)
// $api->cookie('paste your cookie');

// Get data
$data = $api->format(false)->search('双笙', [
    'page' => 1,
    'limit' => 5
]);

echo $data[0];


// Parse link
//$data = $api->format(true)->url(35847388);

//echo $data;
