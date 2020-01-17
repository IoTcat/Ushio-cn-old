<?php 
include './functions.php';

$res = db__getData(db__connect(), 'video');

function getKeys($arr, $word, $index = "", $indexVal = ""){
	$arr_word = [];
	foreach($arr as $i){
		if(($index == "" || $i[$index] == $indexVal) && !in_array($i[$word], $arr_word)){
			array_push($arr_word, $i[$word]);
		}
	}
	return $arr_word;
};

$classes = getKeys($res, "class");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ACG WATCH</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/awsm.css@3.0.4/dist/awsm_theme_pearl-lusta.min.css">
	<script type="text/javascript">block_aplayer = true;</script>
	<script src="https://cdn.yimian.xyz/ushio-js/ushio-head.min.js"></script>
</head>
<body>
	<header>
		<h1>ACG.WATCH</h1>
		<p>Watch ACG video <abbr title="At ACG.WATCH">ONLINE</abbr></p>
		<nav>
			<ul>
				<li><a href="./" aria-hidden="false">Homepage</a></li>
				<li><a href="./">Playlist</a></li>
				<li><a href="https://iotcat.me/">About Me</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<article>
			<section>
				<aside>
					<p>
						<strong>S.F.</strong>
						<script>document.write('<a href="https://acg.watch/player/?url='+cookie.get('last_watch')+'">Continue Your Last Watch</a>');</script>
					</p>
				</aside>
			</section>
<?php

	foreach($classes as $class){
		echo "
			<section>
				<h2>".$class."</h2>";				
		foreach(getKeys($res, "series", "class", $class) as $i){
			echo "
				<details>
					<summary>".$i."</summary>
					<ul>";
			foreach($res as $ii){
				if($ii["series"] == $i){
					echo "
						<li><a href=\"./player/?url=".$ii["url"]."\">".$ii["name"]."</a></li>";
				}
			}
			echo "
					</ul>
				</details>";
		}
		echo "
		    </section>";
	}
?>
		</article>
	</main>
    <footer>
    	<p style="text-align: center;"> Powered By Ushio | Made with love by <a href="https://iotcat.me">iotcat</a> </p>
    	<br>
    </footer>
	<script src="https://cdn.yimian.xyz/ushio-js/ushio-footer.min.js"></script>
</body>
</html>
