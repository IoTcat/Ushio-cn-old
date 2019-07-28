<?php


//资源控制器的建立和测试
require_once('OAuth2/Autoloader.php');

global $server;

$dsn = 'mysql:dbname=oauth;host=192.168.0.90';
$username = "oauth";
$password = "d78df%enWq@d6sa2";



\OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));


// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new \OAuth2\Server($storage);

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));

if (!$server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
    $server->getResponse()->send();
        die;
        }

        $token = $server->getAccessTokenData(\OAuth2\Request::createFromGlobals());

        //如果通过校对，则打印该 token对应的用户
        echo json_encode(array('success' => true, 'message' => 'the token is right and your user_id is ' . $token['user_id']));

        //do your things
