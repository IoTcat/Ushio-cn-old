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
<?php
foreach($res as $i){
    echo '<a href="https://acg.watch/player/?url='.$i['url'].'" >'.$i['name'].'</a><br/>';
}

?>
<script src="https://cdn.yimian.xyz/ushio-js/ushio-footer.min.js"></script>
</body>
</html>
