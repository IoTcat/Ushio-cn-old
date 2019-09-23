<?php
/**
 * 香菇编写的 Typecho 摄影/相册主题
 * 
 * @package Photograph Theme for Typecho
 * @author siitake
 * @version 20190122(疯狂测试版)
 * @link http://photo.siitake.cn/docs
 */

include '/home/ushio/www/api/functions.php';


if(file_get_contents('/tmp/img_yimian_is_update') != date('Y-m-d')){

	$__db= Typecho_Db::get();

	// koino
	$__arr = getImgsInfo('koino');
	$__content="<!--markdown-->";
	foreach ($__arr[0] as $key => $value) {
        if(strpos($value,'R18') === false)
		$__content.="![".$__arr[1][$key]."](https://api.yimian.xyz/img/?path=koino/".$value.") ";
	}
	$__update = $__db->update('table.contents')->rows(array('text'=>$__content))->where('cid=?',1);
	$__db->query($__update);

	// moe
	$__arr = getImgsInfo('moe');
	$__content="<!--markdown-->";
	foreach ($__arr[0] as $key => $value) {
		$__content.="![".$__arr[1][$key]."](https://api.yimian.xyz/img/?path=moe/".$value.") ";
	}
	$__update = $__db->update('table.contents')->rows(array('text'=>$__content))->where('cid=?',2);
	$__db->query($__update);

	// wallpaper
	$__arr = getImgsInfo('wallpaper');
	$__content="<!--markdown-->";
	foreach ($__arr[0] as $key => $value) {
		$__content.="![".$__arr[1][$key]."](https://api.yimian.xyz/img/?path=wallpaper/".$value.") ";
	}
	$__update = $__db->update('table.contents')->rows(array('text'=>$__content))->where('cid=?',3);
	$__db->query($__update);

	// imgbed
	$__arr = getImgsInfo('imgbed');
	$__content="<!--markdown-->";
	foreach ($__arr[0] as $key => $value) {
		$__content.="![".$__arr[1][$key]."](https://api.yimian.xyz/img/?path=imgbed/".$value.") ";
	}
	$__update = $__db->update('table.contents')->rows(array('text'=>$__content))->where('cid=?',4);
	$__db->query($__update);


	$__myfile = fopen("/tmp/img_yimian_is_update", "w") or die("Unable to open file!");
	fwrite($__myfile, date('Y-m-d-H'));
	fclose($__myfile);

}


if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
?>
<script type="text/javascript">console.log("Photograph Theme for Typecho 1.1, By: Siitake, v20190122, build: crazytest.2019012202");</script>
<div class="content">
	<div id="masonry" class="row">
		<?php $this->need('index.list.php'); ?>
	</div>
	<?php $this->pageNav('&laquo;', '&raquo;'); ?>
</div>
<!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

