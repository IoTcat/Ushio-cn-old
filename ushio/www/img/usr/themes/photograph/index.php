<?php
/**
 * 香菇编写的 Typecho 摄影/相册主题
 * 
 * @package Photograph Theme for Typecho
 * @author siitake
 * @version 20190122(疯狂测试版)
 * @link http://photo.siitake.cn/docs
 */

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
