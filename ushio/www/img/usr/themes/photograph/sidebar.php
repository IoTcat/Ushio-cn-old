<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div id="side-button">
	<ul>
		<li id="go-top"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></li>
		<li id="go-bottom"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></li>
		<li id="show-qrcode" onclick="showQrcode()"><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span></li>
		<?php if($this->is("post") && $this->fields->postType != 1): ?><li id="ex-comment"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></li><?php endif; ?>
		<?php if($this->options->randomPostPt == 2): ?><li id="randomPost" onclick="location.href='<?php randomPost(); ?>';"><span class="glyphicon glyphicon-random" aria-hidden="true"></span></li><?php endif; ?>
	</ul>
</div>

<!-- end #sidebar -->