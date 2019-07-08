<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php if($this->hidden): ?>
<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
    <h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
    <div class="post-content password" itemprop="articleBody">
        <?php $this->text(); ?>
    </div>
</article>
<?php else: ?>

<?php if($this->fields->postType == 1): ?>
<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
	<h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
	<div class="post-content" itemprop="articleBody" id="masonry">
		<?php $this->content(); ?>
	</div>
	<?php $this->need('post.info.php'); ?>
</article>
<?php $this->need('comments.php'); ?>
<?php else: ?>

<div class="content">
	<div id="masonry" class="post row">
<?php
	$imgs = getPostImg($this, $this->options->wholeSrc);
	$differentCol = $this->fields->differentCol;
	$differentPic = array();
	if($differentCol != '') {
		$differentColArr = explode(":", $differentCol);
		$differentColNumArr = explode(",", $differentColArr[1]);
		$differentPic = array($differentColArr[0], $differentColNumArr[0], $differentColNumArr[1], $differentColNumArr[2], $differentColNumArr[3]);
	}
	$titleflag = 1;
	foreach($imgs as $img) {
		$_colXs = 6; $_colSm = 4; $_colMd = 3; $_colLg = 2;
		if(count($differentPic) && $titleflag == $differentPic[0]):
			$_colXs = $differentPic[1];
			$_colSm = $differentPic[2];
			$_colMd = $differentPic[3];
			$_colLg = $differentPic[4];
		else:
			$_colXs = $this->options->colXs ? $this->options->colXs : $_colXs;
			$_colSm = $this->options->colSm ? $this->options->colSm : $_colSm;
			$_colMd = $this->options->colMd ? $this->options->colMd : $_colMd;
			$_colLg = $this->options->colLg ? $this->options->colLg : $_colLg;
		endif;
		if($this->fields->hiddenMorePic == 1 && $this->fields->hiddenMorePics == $titleflag && !$this->user->hasLogin()):
?>
			<div class="post-item col-xs-<?php echo $_colXs ?> col-sm-<?php echo $_colSm ?> col-md-<?php echo $_colMd ?> col-lg-<?php echo $_colLg ?>"><a class="hidden-more" href="<?php $this->options->adminUrl('login.php?referer='.urlencode($this->permalink)); ?>">登陆后显示更多</a></div>
<?php
			break;
		endif;
?>
		<div data-fancybox="gallery" class="post-item col-xs-<?php echo $_colXs ?> col-sm-<?php echo $_colSm ?> col-md-<?php echo $_colMd ?> col-lg-<?php echo $_colLg ?>" data-src="<?php echo $img['url'].($this->options->detailImgParm ? $this->options->detailImgParm : ''); ?>">
			<img class="post-item-img lazy" src="<?php getLazyImg($this->options); ?>" data-original="<?php echo $img['url'].($this->options->detailImgParm ? $this->options->detailImgParm : ''); ?>" alt="<?php echo $this->fields->title == 1 ? $img['name'] : ($this->title.' ['.$titleflag.']'); ?>" title="<?php echo $this->fields->title == 1 ? $img['name'] : ($this->title.' ['.$titleflag++.']'); ?>">
		</div>
<?php } ?>
	</div>
	<?php $this->need('post.info.php'); ?>
</div>

<div id="post-comments">
	<?php $this->need('comments.php'); ?>
</div>

<?php endif; //显示模式判定 ?>

<?php endif; //隐藏文章判定 ?>

<!--a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a-->

<!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
