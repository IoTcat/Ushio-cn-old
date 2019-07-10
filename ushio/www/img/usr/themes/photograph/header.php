<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="renderer" content="webkit">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="icon" href="<?php if($this->options->favicon != ''): echo $this->options->favicon; else: $this->options->themeUrl('favicon.png'); endif; ?>">
	<link rel="apple-touch-icon" href="<?php if($this->options->favicon != ''): echo $this->options->favicon; else: $this->options->themeUrl('favicon.png'); endif; ?>">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- 使用url函数转换相关路径 -->
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('bootstrap3/css/bootstrap.min.css'); ?>" />
	<?php if($this->options->lightBoxCho == 'lg'): ?>
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('lightgallery/css/lightgallery.min.css'); ?>" />
	<?php elseif($this->options->lightBoxCho == 'fb3'): ?>
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('fancybox3/jquery.fancybox.min.css'); ?>" />
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('style.css?'.date('YmdHi')); ?>" />
	<?php if($this->options->coverStyle == 'social'): ?>
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('style.social.css?'.date('YmdHi')); ?>" />
	<?php endif; ?>
	<?php $this->need('header.style.php'); ?>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php
    	if($this->is("post") && $this->fields->description) {
    		$this->header('description='.strip_tags($this->fields->description));
    	} else {
    		$this->header();
    	}
    ?>
<link rel="stylesheet" type="text/css" href="https://cdn.yimian.xyz/shaky/shaky.css">
<script src="https://cdn.yimian.xyz/ushio-js/ushio-head.min.js"></script>

</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<?php if ($this->options->notice && $this->options->noticeStyle == 'top'): ?>
<div class="notice-top"><b>网站公告：</b><?php $this->options->notice() ?></div>
<?php endif; ?>
<?php if($this->options->navStyle == 'ins'): ?>
<header class="header">
	<?php if($this->is('post')): ?>
	<a class="header-post-back" href="javascript:history.go(-1);"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
	<?php endif; ?>
	<h1 class="header-title anti-select"><a href="<?php $this->options->siteUrl(); ?>"><?php echo $this->options->logo ? ('<img class="header-logo" src="'.$this->options->logo.'">') : $this->options->title; ?></a></h1>
</header>
<?php elseif($this->options->navStyle == 'boot'): ?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			</button>
			<a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>"><?php echo $this->options->logo ? ('<img class="nav-logo" src="'.$this->options->logo.'">') : $this->options->title; ?></a>
		</div>
    	<!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
			<!-- pageNav -->
			<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
			<?php while($pages->next()): ?>
				<li<?php if($this->is('page', $pages->slug)): ?> class="active"<?php endif; ?>><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
			<?php endwhile; ?>
			<!-- randomLink -->
			<?php if($this->options->randomPostPt == 1): ?>
				<li><a href="javascript:;" onclick="location.href='<?php randomPost(); ?>';" title="随机文章">随机</a></li>
			<?php endif; ?>
			<!-- cateNav -->
			<?php $this->widget('Widget_Metas_Category_List')->to($cates); ?>
			<?php if($this->options->isFoldCate == 'y'): ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php _e('分类'); ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php while($cates->next()): ?>
							<li<?php if($this->options->isFoldCate != 'y' && $this->is('category', $cates->slug)): ?> class="active"<?php endif; ?>><a href="<?php $cates->permalink(); ?>" title="<?php $cates->description(); ?>"><?php $cates->name(); ?></a></li>
						<?php endwhile; ?>
					</ul>
				</li>
			<?php else: ?>
				<?php while ($cates->next()): ?>
					<?php if ($cates->levels === 0): ?>
						<?php $children = $cates->getAllChildren($cates->mid); ?>
						<?php if (empty($children)): ?>
							<li<?php if($this->options->isFoldCate != 'y' && $this->is('category', $cates->slug)): ?> class="active"<?php endif; ?>><a href="<?php $cates->permalink(); ?>" title="<?php $cates->description(); ?>"><?php $cates->name(); ?></a></li>
						<?php else: ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php $cates->name(); ?><span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach ($children as $mid) { ?>
									<?php $child = $cates->getCategory($mid); ?>
										<li><a href="<?php echo $child['permalink']; ?>" title="<?php echo $child['description']; ?>"><?php echo $child['name']; ?></a></li>
								<?php } ?>
								</ul>
							</li>
						<?php endif; ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<!-- diyNav -->
			<?php if(trim($this->options->diyNav) != ''): ?>
			<?php $diyNav = getDiyNav($this->options->diyNav); ?>
			<?php foreach ($diyNav as $_diyNav): ?>
				<li><a href="<?php echo $_diyNav[1]; ?>" title="<?php echo $_diyNav[0]; ?>"<?php if($_diyNav[2] == 'true'): ?> target="_blank"<?php endif; ?>><?php echo $_diyNav[0]; ?></a></li>
			<?php endforeach; ?>
			<?php endif; ?>
			</ul>
			<!-- search & setting -->
			<!-- float search -->
			<?php if($this->options->isHideSet == 'n'): ?>
			<form class="navbar-form navbar-left" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
				<div class="form-group">
					<label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
					<input type="text" id="s" name="s" class="form-control input-search" placeholder="<?php _e('输入关键字搜索'); ?>">
					<button type="submit" class="btn btn-default button-search">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</button>
				</div>
			</form>
			<?php endif; ?>
			<!-- right search & setting -->
			<ul class="nav navbar-nav navbar-right">
				<?php if($this->user->hasLogin()): if($this->is('post')): ?>
					<li><a href="<?php $this->options->adminUrl('write-post.php?cid='.$this->cid); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="space-5"></span><?php _e('编辑'); ?></a></li>
				<?php elseif($this->is('page')): ?>
					<li><a href="<?php $this->options->adminUrl('write-page.php?cid='.$this->cid); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="space-5"></span><?php _e('编辑'); ?></a></li>
				<?php endif; endif; ?>
				<?php if($this->options->isHideSet == 'y'): ?>
				<form class="navbar-form navbar-left" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
					<div class="form-group">
						<label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
						<input type="text" id="s" name="s" class="form-control input-search" placeholder="<?php _e('输入关键字搜索'); ?>">
						<button type="submit" class="btn btn-default button-search">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>
					</div>
				</form>
				<?php endif; ?>
				<?php if($this->options->isHideSet == 'n'): ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span><span class="space-5"></span><?php _e('管理'); ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
					<?php if($this->user->hasLogin()): ?>
						<li class="last"><a href="<?php $this->options->adminUrl(); ?>"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span class="space-5"></span><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
						<li class="last"><a href="<?php $this->options->adminUrl('options-theme.php'); ?>"><span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span><span class="space-5"></span><?php _e('设置外观'); ?></a></li>
						<li class="last"><a href="<?php $this->options->adminUrl('manage-posts.php'); ?>"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span><span class="space-5"></span><?php _e('管理文章'); ?></a></li>
						<li class="last"><a href="<?php $this->options->adminUrl('manage-pages.php'); ?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="space-5"></span><?php _e('管理页面'); ?></a></li>
						<li><a href="<?php $this->options->logoutUrl(); ?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span><span class="space-5"></span><?php _e('退出登陆'); ?></a></li>
					<?php else: ?>
						<li class="last"><a href="<?php $this->options->adminUrl('login.php?referer='.urlencode(thisPageUrl())); ?>"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span><span class="space-5"></span><?php _e('登录'); ?></a></li>
						<?php if($this->options->allowRegister): ?><li class="last"><a href="<?php $this->options->adminUrl('register.php'); ?>"><span class="glyphicon glyphicon-check" aria-hidden="true"></span><span class="space-5"></span><?php _e('注册'); ?></a></li><?php endif; ?>
					<?php endif; ?>
						<?php if($this->options->isHideRss == 'n'): ?>
						<li role="separator" class="divider"></li>
						<li><a href="<?php $this->options->feedUrl(); ?>"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span><span class="space-5"></span><?php _e('文章 RSS'); ?></a></li>
						<li><a href="<?php $this->options->commentsFeedUrl(); ?>"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span><span class="space-5"></span><?php _e('评论 RSS'); ?></a></li>
						<?php endif; ?>
					</ul>
				</li>
				<?php endif; ?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<?php endif; ?>
<!-- firstVisiting -->
<?php if($this->options->firstVisiting == 1 && !isset($_COOKIE["firstVisiting"])): ?>
<script type="text/javascript">
</script>
<div id="firstVisitingPage">
<?php $this->options->firstVisitingHtml(); ?>
</div>
<?php else: ?>
<?php endif; ?>
<!-- mobileCateTags -->
<?php if($this->options->mobileCate == 1 && ($this->is('index') || $this->is('category'))): ?>
<?php if($this->options->navStyle == 'ins'): ?>
	<?php $this->widget('Widget_Metas_Category_List')->to($cates); ?>
<?php endif; ?>
<ul class="mobile-cate">
	<?php while($cates->next()): ?>
		<li id="<?php echo 'cate_'.$cates->slug; ?>"<?php if($this->is('category', $cates->slug)): ?> class="active"<?php endif; ?>><a href="<?php echo $cates->permalink.'#cate_'.$cates->slug; ?>" title="<?php $cates->description(); ?>"><?php $cates->name(); ?></a></li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>