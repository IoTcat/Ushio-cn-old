<?php while($this->next()): ?>
<?php if($this->options->hiddenProtect && $this->hidden && !$this->user->hasLogin()){continue;} ?>
<?php if($this->options->coverStyle == 'simple'): ?>
<div class="item col-xs-<?php echo $this->options->colXs ? $this->options->colXs : 6 ?> col-sm-<?php echo $this->options->colSm ? $this->options->colSm : 4 ?> col-md-<?php echo $this->options->colMd ? $this->options->colMd : 3 ?> col-lg-<?php echo $this->options->colLg ? $this->options->colLg : 2 ?>">
	<img class="item-img lazy" src="<?php getLazyImg($this->options); ?>" data-original="<?php if($this->hidden && !$this->options->showProtect): if($this->options->protectedImg): echo $this->options->protectedImg; else: $this->options->themeUrl('src/protected.jpg'); endif; else: echo $this->fields->thumb != "" ? $this->fields->thumb.($this->options->thumbImgParm ? $this->options->thumbImgParm : '') : getPostImg($this, $this->options->wholeSrc)[0]['url'].($this->options->thumbImgParm ? $this->options->thumbImgParm : ''); endif; ?>" alt="<?php $this->title() ?>" />
	<div class="item-title">
		<a class="item-link" href="<?php $this->permalink() ?>">
			<div class="item-link-text">
				<?php $this->title() ?>
			</div>
		</a>
		<?php if(!$this->hidden): ?>
			<span class="item-num">
				[<?php echo count(getPostImg($this, $this->options->wholeSrc)); ?>P]
				<?php if($this->fields->postType == 1): ?>
					<span class="glyphicon glyphicon-font" aria-hidden="true"></span>
				<?php else: ?>
					<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<?php endif; ?>
			</span>
		<?php endif; ?>
	</div>
</div>
<?php elseif($this->options->coverStyle == 'social'): ?>
<div class="item-sc col-xs-<?php echo $this->options->colXs ? $this->options->colXs : 6 ?> col-sm-<?php echo $this->options->colSm ? $this->options->colSm : 4 ?> col-md-<?php echo $this->options->colMd ? $this->options->colMd : 3 ?> col-lg-<?php echo $this->options->colLg ? $this->options->colLg : 2 ?>">
	<a href="<?php $this->permalink() ?>"><img class="item-sc-img lazy" src="<?php getLazyImg($this->options); ?>" data-original="<?php if($this->hidden && !$this->options->showProtect): if($this->options->protectedImg): echo $this->options->protectedImg; else: $this->options->themeUrl('src/protected.jpg'); endif; else: echo $this->fields->thumb != "" ? $this->fields->thumb.($this->options->thumbImgParm ? $this->options->thumbImgParm : '') : getPostImg($this, $this->options->wholeSrc)[0]['url'].($this->options->thumbImgParm ? $this->options->thumbImgParm : ''); endif; ?>" alt="<?php $this->title() ?>" /></a>
	<div class="item-sc-meta">
		<a class="item-sc-link" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
		<div class="item-sc-mates">
			<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span class="item-sc-mates-text"><?php $this->date('m.d'); ?></span>
			<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span class="item-sc-mates-text"><?php echo $this->fields->readTimes ? $this->fields->readTimes : '?'; ?></span>
			<?php if(!$this->hidden): ?>
				<?php if($this->fields->postType == 1): ?>
					<span class="glyphicon glyphicon-font" aria-hidden="true"></span>
				<?php else: ?>
					<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<?php endif; ?>
				<?php echo count(getPostImg($this, $this->options->wholeSrc)); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endwhile; ?>