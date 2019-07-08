<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="content">
	<div class="archive-title">
		<h3 class="archive-title"><?php $this->archiveTitle(array(
			'category'  =>  _t('分类 %s 下的文章'),
			'search'    =>  _t('包含关键字 %s 的文章'),
			'tag'       =>  _t('标签 %s 下的文章'),
			'author'    =>  _t('%s 发布的文章')
		), '', ''); ?></h3>
	</div>
	<?php if ($this->have()): ?>
	<div id="masonry" class="archive row">
		<?php $this->need('index.list.php'); ?>
	</div>
	<?php $this->pageNav('&laquo;', '&raquo;'); ?>
	<?php else: ?>
		<div class="archive-msg">
			<img class="nocontent" src="<?php $this->options->themeUrl('src/nocontent.svg'); ?>">
		</div>
	<?php endif; ?>
</div>
<!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
