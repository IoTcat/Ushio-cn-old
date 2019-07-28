<?php


     require_once('OAuth2/Autoloader.php');
     global $server;



$dsn = 'mysql:dbname=oauth;host=192.168.0.90';
$username = "oauth";
$password = "d78df%enWq@d6sa2";

\OAuth2\Autoloader::register();
$storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

$server = new \OAuth2\Server($storage, array(
    'refresh_token_lifetime' => 2419200,
        'access_lifetime' => 3600,// 3600 / 60 / 60 = 1 小时有效时间的 accesstoken
        ));

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
        $server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
