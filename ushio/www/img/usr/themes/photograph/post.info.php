<div class="post-info">
	<div class="post-info-box"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span><span class="post-info-title anti-select">标题：</span><span class="post-info-text"><?php echo $this->title ?></span></div>
	<div class="post-info-box"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span class="post-info-title anti-select">日期：</span><span class="post-info-text"><?php $this->date('Y/m/d') ?></span></div>
	<?php if($this->fields->photog): ?>
	<div class="post-info-box"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span><span class="post-info-title anti-select">拍摄/来源：</span><span class="post-info-text"><?php echo $this->fields->srcurl != "" ? '<a href="'.$this->fields->srcurl.'" target="_blank">'.$this->fields->photog.'</a>' : $this->fields->photog; ?></span></div>
	<?php endif; ?>
	<?php if($this->fields->appear): ?>
	<div class="post-info-box"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="post-info-title anti-select">出镜：</span><span class="post-info-text"><?php echo $this->fields->appear; ?></span></div>
	<?php endif; ?>
	<?php if($this->fields->software): ?>
	<div class="post-info-box"><span class="glyphicon glyphicon-adjust" aria-hidden="true"></span><span class="post-info-title anti-select">处理软件：</span><span class="post-info-text"><?php echo afterSoftware()[$this->fields->software] ?></span></div>
	<?php endif; ?>
	<?php if($this->fields->packageUrl): ?>
	<div class="post-info-box"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span><span class="post-info-title anti-select">下载：</span><span class="post-info-text"><a href="<?php echo $this->fields->packageUrl ?>" target="_blank"><?php echo $this->fields->packageName ? $this->fields->packageName : '打包下载'; ?></a></span></div>
	<?php endif; ?>
	<div class="post-info-box"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span class="post-info-title anti-select">浏览：</span><span class="post-info-text"><?php updateReadTimes($this->cid); echo $this->fields->readTimes ? $this->fields->readTimes : '1'; ?>次</span></div>
	<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><span class="post-info-title anti-select">描述：</span><span class="post-info-text"><?php echo $this->fields->description != "" ? $this->fields->description : ($this->options->picdesc ? $this->options->picdesc : '未填写') ?></span>
</div>
<?php if($this->options->postTags): ?>
<div class="post-tags<?php if($this->options->colorTags == 1): echo ' color-tags'; endif; ?>">
	<?php $this->tags('', true, '（暂无标签）'); ?>
</div>
<?php endif; ?>