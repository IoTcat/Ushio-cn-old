<?php
/**
 * Created by PhpStorm.
  * User: XuHong
   * Date: 2018/12/20
    * Time: 16:00
     */

     require_once('OAuth2/Autoloader.php');
     global $server;

     //根据您的数据库配置而定
     $dsn = 'mysql:dbname=oauth;host=192.168.0.90';
     $username = "oauth";
     $password = "d78df%enWq@d6sa2";

\OAuth2\Autoloader::register();
//oauth操作数据库开始
$storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new \OAuth2\Server($storage);

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));

\OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
// var_dump($storage);

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new \OAuth2\Server($storage);

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));

$request = \OAuth2\Request::createFromGlobals();
$response = new \OAuth2\Response();

// 校验请求是否 oauth2.0 请求以及是否 clientId 是否已经注册在数据库
if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
        die;
        }
        // display an authorization form
        if (empty($_POST)) {
            exit('
                   <form method="post">
                           <label>是否授权给 '.$_GET['client_id'].'?</label><br />
                                   <input type="submit" name="authorized" value="yes">
                                           <input type="submit" name="authorized" value="no">
                                                   </form>  
                                                       <a href="/login.php?logout=1">退出登录</a>');
                                                       } else {
                                                           echo 'fail ';
                                                           }

                                                           // print the authorization code if the user has authorized your client
                                                           $is_authorized = ($_POST['authorized'] === 'yes');
                                                           $server->handleAuthorizeRequest($request, $response, $is_authorized, 2018);
                                                           $response->send();
                                                           if ($is_authorized) {
                                                               // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
                                                                   $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=') + 5, 40);
                                                                       exit("SUCCESS! Authorization Code: $code");
                                                                       }

