<?php

include '../functions.php';

$email = $_REQUEST['email'];
$fp = $_REQUEST['fp'];

// TEST PURPOSE
$email = "i@yimian.xyz";
$fp = "12345678";

// Illegal Request
if(!isset($email) || !isset($fp)) die(json_encode(array(
    "code" => 500,
    "message" => "Illegal Request!!"
)));


// generate url
$url = "https://auth.yimian.xyz/reg/ver_email.php?email=".$email."&code=".md5($email.'|iotcat');


// email body
$body = "尊敬的用户：
<br>
<br>
你好~ 欢迎注册由<a href=\"https://iotcat.me\">iotcat</a>开发的<a href=\"https://ushio.xyz\">Ushio</a>用户系统。
<br>
<br>
请点击或用浏览器打开以下链接以完成你的注册咯：
<br>
<a href=\"$url\"><b>$url</b></a>
<br>
<br>
祝您一切好运！
<br>
<br>
Best Regards,
<br>
呓喵酱 <a href=\"https://iotcat.me\">@iotcat</a>
<br>
<br>
<br>
";

// send email
$res = yimian__mail($email, "账户注册-邮箱验证", $body, "呓喵酱");

// Email not send
if(!$res) die(json_encode(array(
    "code" => 503,
    "message" => "Email did not send!!"
)));

// success
echo json_encode(array(
    "code" => 0,
    "message" => "Email sent!"
));
