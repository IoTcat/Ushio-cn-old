<?php 
include './functions.php';

$res = db__getData(db__connect(), 'video');

?>

<html>
<head>
<title>ACG WATCH</title>
<script src="https://cdn.yimian.xyz/ushio-js/ushio-head.min.js"></script>
</head>
<body>
<h2><script>document.write('<a href="https://acg.watch/player/?url='+cookie.get('last_watch')+'">继续播放上次位置</a>');</script></h2>
<?php
foreach($res as $i){
    echo '<a href="https://acg.watch/player/?url='.$i['url'].'" >'.$i['name'].'</a><br/>';
}

?>
<script src="https://cdn.yimian.xyz/ushio-js/ushio-footer.min.js"></script>
</body>
</html>
