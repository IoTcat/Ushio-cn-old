<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
	$logo = new Typecho_Widget_Helper_Form_Element_Text('logo', NULL, NULL, _t('网站 LOGO'), _t('网站 logo 图片地址，留空则显示标题。'));
	$form->addInput($logo);

	$icp = new Typecho_Widget_Helper_Form_Element_Text('icp', NULL, NULL, _t('大天朝身份认证'), _t('填写 ICP 备案号，留空则不显示。'));
	$form->addInput($icp);

	$navStyle = new Typecho_Widget_Helper_Form_Element_Radio('navStyle', array('ins' => _t('Ins居中风格(无菜单)'), 'boot' => _t('BootStrap顶部固定导航栏')), 'boot', _t('网站「导航栏」风格设置'), _t('选择站点导航的显示风格。'));
	$form->addInput($navStyle);

	$isFoldCate = new Typecho_Widget_Helper_Form_Element_Radio('isFoldCate', array('y' => _t('折叠'), 'n' => _t('展开')), 'n', _t('是否折叠「分类」菜单'), _t('选择是否折叠显示导航栏上的分类列表菜单。'));
	$form->addInput($isFoldCate);

	$isHideSet = new Typecho_Widget_Helper_Form_Element_Radio('isHideSet', array('y' => _t('隐藏'), 'n' => _t('显示')), 'n', _t('导航栏「设置」入口'), _t('选择是否隐藏前台导航栏「设置」入口（大屏模式下如果隐藏则搜索栏右对齐）。'));
	$form->addInput($isHideSet);

	$isHideRss = new Typecho_Widget_Helper_Form_Element_Radio('isHideRss', array('y' => _t('隐藏'), 'n' => _t('显示')), 'n', _t('设置「RSS」入口'), _t('选择是否隐藏设置菜单中「RSS」入口。'));
	$form->addInput($isHideRss);

	$colXs = new Typecho_Widget_Helper_Form_Element_Radio('colXs', array('12' => _t('1列'), '6' => _t('2列')), '6', _t('超小屏幕显示列数 手机 (<768px)'), _t('调整相册封面显示列数。'));
	$form->addInput($colXs);

	$colSm = new Typecho_Widget_Helper_Form_Element_Radio('colSm', array('6' => _t('2列'), '4' => _t('3列')), '4', _t('小屏幕显示列数 平板 (≥768px)'), _t('调整相册封面显示列数。'));
	$form->addInput($colSm);

	$colMd = new Typecho_Widget_Helper_Form_Element_Radio('colMd', array('4' => _t('3列'), '3' => _t('4列')), '3', _t('中等屏幕显示列数 桌面显示器 (≥992px)'), _t('调整相册封面显示列数。'));
	$form->addInput($colMd);

	$colLg = new Typecho_Widget_Helper_Form_Element_Radio('colLg', array('3' => _t('4列'), '2' => _t('6列')), '2', _t('大屏幕显示列数 大桌面显示器 (≥1200px)'), _t('调整相册封面显示列数。'));
	$form->addInput($colLg);

	$coverHeightTimes = new Typecho_Widget_Helper_Form_Element_Text('coverHeightTimes', NULL, '1.0', _t('封面高度设置'), _t('基于默认「正方形」状态下的高度倍数设置，默认1倍高度。'));
	$form->addInput($coverHeightTimes);

	$coverTitle = new Typecho_Widget_Helper_Form_Element_Radio('coverTitle', array('1' => _t('显示'), '0.5' => _t('显示(50%透明)'), '0' => _t('隐藏')), 1, _t('封面标题默认状态'), _t('选择是否默认显示封面标题、内容图片数量等信息。'));
	$form->addInput($coverTitle);

	$coverTitleBorder = new Typecho_Widget_Helper_Form_Element_Checkbox('coverTitleBorder', array('ctb_t' => _t('border-top'), 'ctb_r' => _t('border-right'), 'ctb_b' => _t('border-bottom'), 'ctb_l' => _t('border-left'),), array('ctb_t', 'ctb_r', 'ctb_b', 'ctb_l'), _t('封面标题边框设置'), _t('分别设置封面标题框四个方向是否显示。'));
	$form->addInput($coverTitleBorder->multiMode());

	$coverTitleRadius = new Typecho_Widget_Helper_Form_Element_Checkbox('coverTitleRadius', array('ctr_tl' => _t('border-top-left-radius'), 'ctr_tr' => _t('border-top-right-radius'), 'ctr_br' => _t('border-bottom-right-radius'), 'ctr_bl' => _t('border-bottom-left-radius'),), array('ctr_tl', 'ctr_tr', 'ctr_br', 'ctr_bl'), _t('封面标题圆角设置'), _t('分别设置封面标题框四个角是否显示为圆角。'));
	$form->addInput($coverTitleRadius->multiMode());

	$coverOrn = new Typecho_Widget_Helper_Form_Element_Radio('coverOrn', array('co_none' => _t('无装饰'), 'co_cat' => _t('小猫')), 'co_none', _t('封面标题装饰'), _t('选择封面标题框上的装饰挂件，如果标题边框 border-top 设为不显示则该项配置无效。'));
	$form->addInput($coverOrn);

	$hiddenProtect = new Typecho_Widget_Helper_Form_Element_Radio('hiddenProtect', array('0' => _t('否'), '1' => _t('是')), '0', _t('是否登录后可见密码保护的相册'), _t('设置登陆后才显示加密的相册（这种隐藏方式有缺陷，会导致列表页加密相册直接隐藏，且没有替补相册）。'));
	$form->addInput($hiddenProtect);

	$showProtect = new Typecho_Widget_Helper_Form_Element_Radio('showProtect', array(false => _t('否'), true => _t('是')), false, _t('是否显示密码保护相册的原始封面'), _t('设置是否显示密码保护相册的原始封面（标题文字及内容仍需密码验证）。'));
	$form->addInput($showProtect);

	$protectedImg = new Typecho_Widget_Helper_Form_Element_Text('protectedImg', NULL, NULL, _t('密码保护的相册封面'), _t('填写密码保护的相册的自定义封面图地址，留空则显示默认图片。'));
	$form->addInput($protectedImg);

	$lazyImg = new Typecho_Widget_Helper_Form_Element_Text('lazyImg', NULL, NULL, _t('懒加载图片设置'), _t('填写懒加载 loading 图片地址，留空则显示默认图片。'));
	$form->addInput($lazyImg);

	$thumbImgParm = new Typecho_Widget_Helper_Form_Element_Text('thumbImgParm', NULL, NULL, _t('相册封面图片参数设置'), _t('填写相册封面图的预处理参数，适用于各种云存储、对象存储等，如无此需求请留空。'));
	$form->addInput($thumbImgParm);

	$detailImgParm = new Typecho_Widget_Helper_Form_Element_Text('detailImgParm', NULL, NULL, _t('相册详情图片参数设置'), _t('填写相册详情图的预处理参数，适用于各种云存储、对象存储等，如无此需求请留空。'));
	$form->addInput($detailImgParm);

	$lightBoxCho = new Typecho_Widget_Helper_Form_Element_Radio('lightBoxCho', array('fb3' => _t('fancybox3'), 'lg' => _t('lightGallery')), 'fb3', _t('图片「灯箱」选择'), _t('选择用于展示图片详情的插件。'));
	$form->addInput($lightBoxCho);

	$fancyBox3Opt = new Typecho_Widget_Helper_Form_Element_Checkbox('fancyBox3Opt',  array('fb3_zoom' => _t('缩放功能'), 'fb3_share' => _t('分享功能（外媒）'), 'fb3_slideShow' => _t('自动播放'), 'fb3_fullScreen' => _t('全屏功能'), 'fb3_download' => _t('下载按钮'), 'fb3_thumbs' => _t('缩略图列表'), 'fb3_close' => _t('关闭按钮')), array('fb3_download', 'fb3_thumbs', 'fb3_close'), _t('fancybox3 功能开关'), _t('注意：若「灯箱」选择了「lightGallery」则该组选项不生效。'));
	$form->addInput($fancyBox3Opt->multiMode());

	$lightGalleryOpt = new Typecho_Widget_Helper_Form_Element_Checkbox('lightGalleryOpt', array('lg_pager' => _t('页码指示器'), 'lg_autoplay' => _t('自动播放功能'), 'lg_fullscreen' => _t('全屏功能'), 'lg_zoom' => _t('缩放功能'), 'lg_download' => _t('下载按钮'), 'lg_thumbnail' => _t('缩略图列表（建议与页码指示器互斥使用）')), array('lg_autoplay', 'lg_fullscreen', 'lg_zoom', 'lg_thumbnail'), _t('lightGallery 功能开关'), _t('注意：若「灯箱」选择了「fancybox3」则该组选项不生效。'));
	$form->addInput($lightGalleryOpt->multiMode());

	$noticeStyle = new Typecho_Widget_Helper_Form_Element_Radio('noticeStyle', array('top' => _t('顶部(带边框可配置颜色)'), 'bottom' => _t('底部(无特殊样式)')), 'bottom', _t('网站公告风格设置'), _t('选择站点公告显示的位置和样式。'));
	$form->addInput($noticeStyle);

	$noticeColor = new Typecho_Widget_Helper_Form_Element_Radio('noticeColor', array(0 => _t('默认'), 'PaleVioletRed' => '<span style="color: PaleVioletRed">#DB7093</span>', 'orange' => '<span style="color: orange">#FFA500</span>', 'DarkSeaGreen' => '<span style="color: DarkSeaGreen">#8FBC8F</span>', 'SkyBlue' => '<span style="color: SkyBlue">#87CEEB</span>', 'MediumTurquoise' => '<span style="color: MediumTurquoise">#48D1CC</span>', 'MediumOrchid' => '<span style="color: MediumOrchid">#BA55D3</span>', ), 0, _t('网站公告颜色设置'), _t('选择站点公告的显示颜色。'));
	$form->addInput($noticeColor);

	$notice = new Typecho_Widget_Helper_Form_Element_Textarea('notice', NULL, NULL, _t('网站公告'), _t('填写网站公告，留空则不显示。'));
	$form->addInput($notice);

	$poweredby = new Typecho_Widget_Helper_Form_Element_Radio('poweredby', array('y' => _t('显示'), 'n' => _t('隐藏')), 'y', _t('Footer Powered …'), _t('是否显示页脚「<a href="http://typecho.org/" target="_blank">POWERED BY TYPECHO</a> / <a href="https://photo.siitake.cn/photograph.html" target="_blank">THEME BY SIITAKE</a>」信息。'));
	$form->addInput($poweredby);

	$statCount = new Typecho_Widget_Helper_Form_Element_Radio('statCount', array('n' => _t('停用'), 'y' => _t('启用')), 'n', _t('全站信息统计'), _t('是否启用全站信息统计（将统计全站分类、文章、页面、评论以及附件和文章内容中的图片数量，可能会增加主机负担）。'));
	$form->addInput($statCount);

	$statistics = new Typecho_Widget_Helper_Form_Element_Textarea('statistics', NULL, NULL, _t('统计代码'), _t('填写统计平台生成的统计代码，该内容在页面隐藏生效，留空则不生效。'));
	$form->addInput($statistics);

	$postTags = new Typecho_Widget_Helper_Form_Element_Radio('postTags', array('0' => _t('隐藏'), '1' => _t('显示')), '1', _t('相册标签'), _t('选择是否显示相册（底部）标签。'));
	$form->addInput($postTags);

	$sideButton = new Typecho_Widget_Helper_Form_Element_Radio('sideButton', array('1' => _t('圆角矩形'), '2' => _t('圆角矩形(70%不透明)'), '3' => _t('圆形'), '4' => _t('圆形(70%不透明)')), '3', _t('右下侧功能按钮样式'), _t('设置页面右下侧功能按钮的默认形状和不透明度。'));
	$form->addInput($sideButton);

	$picdesc = new Typecho_Widget_Helper_Form_Element_Textarea('picdesc', NULL, NULL, _t('组图默认描述'), _t('填写组图的默认描述，优先级低于「自定义字段」的值，留空则显示「未填写」。'));
	$form->addInput($picdesc);

	$diyCss = new Typecho_Widget_Helper_Form_Element_Textarea('diyCss', NULL, NULL, _t('自定义样式表(CSS)'), _t('如果您需要自定义或覆盖某些样式，请填在此处。'));
	$form->addInput($diyCss);

	$wholeSrc = new Typecho_Widget_Helper_Form_Element_Radio('wholeSrc', array(0 => _t('附件(默认不生效)'), 1 => _t('内容'), 2 => _t('附件+内容')), 0, _t('全局图片源选项（慎用）'), _t('全局设置相册详情图的来源，选择后两项则「自定义字段」处的「图片源」选项不生效。<span style="color:red;">如无特殊需求请保持此选项为默认值</span>。'));
	$form->addInput($wholeSrc);

	$coverStyle = new Typecho_Widget_Helper_Form_Element_Radio('coverStyle', array('simple' => _t('简单封面（默认）'), 'social' => _t('社交风格')), 'simple', _t('相册封面风格（测试）'), _t('测试功能。'));
	$form->addInput($coverStyle);

	$diyNav = new Typecho_Widget_Helper_Form_Element_Textarea('diyNav', NULL, NULL, _t('自定导航栏菜单'), _t('如果您需要自定义添加导航栏菜单，请按照「名称|地址|是否新窗口打开(true/false)」的格式，一行一个填在此处，<a href="javascript:;" onclick="diyNavDemo(this.parentNode.parentNode.children[1])">点我填入演示菜单</a>。'));
	$form->addInput($diyNav);

	$mobileCate = new Typecho_Widget_Helper_Form_Element_Radio('mobileCate', array(0 => _t('不显示'), 1 => _t('显示')), 0, _t('移动（小屏）页面是否显示顶部分类导航'), _t('无描述，懒得描述。'));
	$form->addInput($mobileCate);

	$randomPostPt = new Typecho_Widget_Helper_Form_Element_Radio('randomPostPt', array(0 => _t('不显示'), 1 => _t('导航栏'), 2 => _t('右下角')), 0, _t('设置「随机文章/相册」入口位置'), _t('无描述，懒得描述。'));
	$form->addInput($randomPostPt);

	$favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点「图标」设置'), _t('填写站点favicon的路径，用来自定义站点图标。'));
	$form->addInput($favicon);

	$colorTags = new Typecho_Widget_Helper_Form_Element_Radio('colorTags', array(0 => _t('不彩色'), 1 => _t('不灰色')), 0, _t('设置「标签」样式'), _t('无描述，懒得描述。'));
	$form->addInput($colorTags);

	$firstVisiting = new Typecho_Widget_Helper_Form_Element_Radio('firstVisiting', array(0 => _t('停用'), 1 => _t('启用')), 0, _t('设置「首次访问」提示页'), _t('无描述，懒得描述。'));
	$form->addInput($firstVisiting);

	$firstVisitingHtml = new Typecho_Widget_Helper_Form_Element_Textarea('firstVisitingHtml', NULL, NULL, _t('填写「首次访问」提示页自定义代码'), _t('支持标准 HTML(5) 格式。<a href="javascript:;" onclick="firstVisitingHtmlDemo(this.parentNode.parentNode.children[1])">点我填入演示代码</a>'));
	$form->addInput($firstVisitingHtml);

	$firstVisitingCss = new Typecho_Widget_Helper_Form_Element_Textarea('firstVisitingCss', NULL, NULL, _t('填写「首次访问」提示页自定义样式'), _t('支持标准 CSS 格式。<a href="javascript:;" onclick="firstVisitingCssDemo(this.parentNode.parentNode.children[1])">点我填入演示样式</a>'));
	$form->addInput($firstVisitingCss);

	$hotKeys = new Typecho_Widget_Helper_Form_Element_Textarea('hotKeys', NULL, NULL, _t('快捷键设置'), _t('设置网站键盘快捷键功能，请按照「按键|功能描述|执行代码」的格式，一行一个填在此处，<a href="javascript:;" onclick="hotKeysDemo(this.parentNode.parentNode.children[1])">点我填入演示快捷键</a>'));
	$form->addInput($hotKeys);

	?>
	<script type="text/javascript">
		window.onload = function(){
			var submitBtn = document.getElementsByClassName("btn primary")[0];
			submitBtn.style.position = "fixed";
			submitBtn.style.left = "50px";
			submitBtn.style.bottom = "50px";
			submitBtn.style.backgroundColor = "#66CCFF";
		};
		var firstVisitingHtmlDemo = function(obj) {
			var val = '<h1 class="fv-title">FBI WARNING</h1>\n'
					+ '<p class="fv-content">FBI Warning Federal law provides severe civil and criminal penalties for the unauthorized reproduction,distribution,or exhibition of copyrighted motion prictures(Title 17, United States Code, Sections 501 and 508). The federal bureau of Investigation investigate allegations of criminal copyright infringement.<br>\n'
					+ '(Title 17, United States Code, Section 506)</p>\n'
					+ '<p class="fv-content"><button class="fv-ok" onclick="cookieSet(\'firstVisiting\', 156518603, 1);location.reload();">OK</button><button class="fv-no" onclick="cookieDelete(\'firstVisiting\');location.href=\'https://siitake.cn/\';">EXIT</button></p>';
			obj.value = val;
		}
		var firstVisitingCssDemo = function(obj) {
			var val = '#firstVisitingPage { background-color: black; color: white; }\n'
					+ '.fv-title { display: block; width: 270px; margin: 120px auto 40px auto; text-align: center; background-color: red; padding: 5px; }\n'
					+ '.fv-content { display: block; width: 70vw; margin: 10px auto; font-size: 32px; text-align: center; }\n'
					+ '.fv-ok { margin: 5px; background-color: green; width: 90px; }\n'
					+ '.fv-no { margin: 5px; background-color: red; width: 90px; }\n'
					+ '@media screen and (max-width: 767px) { .fv-content { font-size: 18px; } }\n'
					+ '@media screen and (max-width: 320px) { .fv-title { width: 220px; margin: 60px auto 15px auto; font-size: 26px; } }';
			obj.value = val;
		}
		var diyNavDemo = function(obj) {
			var val = '文档|https://photo.siitake.cn/docs|true\n'
					+ '香菇|https://siitake.cn/|false';
			obj.value = val;
		}
		var hotKeysDemo = function(obj) {
			var val = 'H|返回首页|location.href = "/";\n'
					+ 'T|跳到顶端|$("html ,body").animate({scrollTop: 0}, 300);\n'
					+ 'B|跳到底部|$("html ,body").animate({scrollTop: document.body.scrollHeight}, 300);\n'
					+ 'Ctrl+R|随机文章|location.href = randomPost;';
			obj.value = val;
		}
	</script>
	<ul class="typecho-option" id="typecho-option-item-icp-1">
		<li>
			<label class="typecho-label" for="icp-0-2">设置备份/还原</label>
			<form action="<?php Helper::options()->adminUrl('options-theme.php'); ?>" method="post"><input type="submit" name="type" class="btn btn-xs" value="备份模板数据" /><span style="display:inline-block;width:5px;"></span><input type="submit" name="type" class="btn btn-xs" value="还原模板数据" /><span style="display:inline-block;width:5px;"></span><input type="submit" name="type" class="btn btn-xs" value="删除备份数据" /></form>
	<?php
	$db = Typecho_Db::get();
	$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:photograph'));
	$ysj = $sjdq['value'];
	if(isset($_POST['type'])) { 
		if($_POST["type"]=="备份模板数据") {
			if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:photographbf'))) {
				$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:photographbf');
				$updateRows= $db->query($update);
	?>    
				<p class="description" style="color:green;">备份已更新，请等待自动刷新！如果等不到请点击<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
				<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
	<?php
			} else {
				if($ysj) {
	     			$insert = $db->insert('table.options')->rows(array('name' => 'theme:photographbf','user' => '0','value' => $ysj));
					$insertId = $db->query($insert);
	?>    
					<p class="description" style="color:green;">备份完成，请等待自动刷新！如果等不到请点击<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
					<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
	<?php
				}
			}
		}
		if($_POST["type"]=="还原模板数据") {
			if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:photographbf'))) {
				$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:photographbf'));
				$bsj = $sjdub['value'];
				$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:photograph');
				$updateRows= $db->query($update);
	?>    
				<p class="description" style="color:blue;">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
				<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
	<?php
			} else {
				echo '<p class="description" style="color:red;">没有模板备份数据，恢复不了哦！</p>';
			}
		}
		if($_POST["type"]=="删除备份数据") {
			if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:photographbf'))){
				$delete = $db->delete('table.options')->where ('name = ?', 'theme:photographbf');
				$deletedRows = $db->query($delete);
	?>
				<p class="description" style="color:orange;">删除成功，请等待自动刷新，如果等不到请点击<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
				<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
	<?php
			} else {
				echo '<p class="description" style="color:red;">不用删了！备份不存在！！！</p>';
			}
		}
	}
	?>
			<p class="description">注：主题设置备份还原功能代码修改自：<a href="https://qqdie.com/archives/typecho-templates-backup-and-restore.html" target="_blank">《typecho模板设置数据备份与恢复》</a>@泽泽。</p>
		</li>
	</ul>
	<?php
}

//懒加载 loading 图
function getLazyImg($options) {
	if($options->lazyImg){
		echo $options->lazyImg;
	}else{
		$options->themeUrl('src/lazy.gif');
	}
}

//统计网站数据：分类、文章、页面、评论、图片总数
function statCount() {
	$picNum = 0;
	$db = Typecho_Db::get();
	$atts = $db->fetchAll($db->select()->from ('table.contents')->where ('type = ?', 'attachment'));
	foreach ($atts as $att) {
		$attInfo = unserialize($att['text']);
		$attType = $attInfo['mime'];
		if(strpos($attType, 'image') !== false) {
			$picNum++;
		}
	}
	Typecho_Widget::widget('Widget_Contents_Post_Admin')->to($posts);
	foreach ($posts->stack as $post) {
		$content = Markdown::convert($post['text']);
		preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $content, $matches);
		$picNum += count($matches[0]);
	}
	Typecho_Widget::widget('Widget_Stat')->to($stat);
	return array('cate' => $stat->categoriesNum, 'post' => $stat->publishedPostsNum, 'page' => $stat->publishedPagesNum, 'comm' => $stat->publishedCommentsNum, 'pic' => $picNum);
}

//获取文章附件图
function getPostAttImg($obj) {
	$stack = $obj->attachments()->stack;
	$atts = array();
	for($i = 0; $i < count($stack); $i++) {
		$att = $stack[$i]['attachment'];
		if($att->isImage) {
			$atts[] = array('name' => $att->name, 'url' => $att->url);
        }
	}
	return $atts;
}

//获取文章内容图
function getPostHtmImg($obj) {
	preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
	$atts = array();
	if(isset($matches[1][0])) {
		for($i = 0; $i < count($matches[1]); $i++) {
			$atts[] = array('name' => $obj->title.' ['.($i + 1).']', 'url' => $matches[1][$i]);
		}
    }
	return  count($atts) ? $atts : NULL;
}

//获取文章图片 整合 getPostAttImg() 与 getPostHtmImg()
function getPostImg($obj, $opt = 0) {
	$imgs = array();
	$src = $obj->fields->src;
	if($opt != 0) {
		$src = $opt;//全局源
	}
	if($src == 0) {
		$imgs = getPostAttImg($obj);
	}elseif($src == 1) {
		$imgs = getPostHtmImg($obj);
	}elseif($src == 2) {
		$imgs = array_merge(getPostHtmImg($obj), getPostAttImg($obj));
	}
	return $imgs;
}

//解析自定义导航菜单
function getDiyNav($str) {
	$strArr = explode("\r\n", $str);
	$navs = array();
	foreach ($strArr as $navStr) {
		$navs[] = explode("|", $navStr);
	}
	return $navs;
}

//解析快捷键设置
function getHotKeys($str) {
	$strArr = explode("\r\n", $str);
	$hotKeys = array();
	foreach ($strArr as $hotKeyStr) {
		$hotkeys[] = explode("|", $hotKeyStr);
	}
	return $hotkeys;
}

//更新阅读次数
function updateReadTimes($cid) {
	$db = Typecho_Db::get();
	$query = $db->select('str_value')->from('table.fields')->where('cid=?', $cid)->where('name LIKE ?', "readTimes");
	$result = $db->fetchAll($query);
	if(count($result)) {
		$str_value = $result[0]['str_value'];
		if(is_numeric($str_value)) {
			$str_value += 1;
		}else{
			$str_value = 1;
		}
		$update = $db->update('table.fields')->rows(array('str_value' => $str_value))->where('cid = ? AND name like "readTimes"', $cid);
		$updateRows = $db->query($update);
	}else{
		$insert = $db->insert('table.fields')->rows(array('cid' => $cid, 'name' => 'readTimes', 'str_value' => 1));
		$insertId = $db->query($insert);
	}
}

//随便看看
function randomPost() {
	$db = Typecho_Db::get();
	$query = $db->select()->from('table.contents')->where('type=?', 'post')->where('status=?', 'publish')->order('RAND()');
	$result = $db->fetchAll($query);
	if($result) {
		$val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($result[0]);
		$post_title = htmlspecialchars($val['title']);
		$permalink = $val['permalink'];
		echo $permalink;
	} else {
		echo "javascript:alert('暂无随机文章！');";
	}
}

//当前页
function thisPageUrl() {
	return (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

//后期软件
function afterSoftware() {
	return array(
		_t('未知'), _t('Photoshop'), _t('Google Picasa'), _t('Snapseed'), _t('泼辣修图'), _t('美图秀秀'), _t('Camera 360'), _t('天天P图'), _t('黄油相机'), _t('Enlight'), _t('Facetune'), _t('Prisma'), _t('PicsArt'), _t('Pixlr'), _t('VSCO'), _t('Instagram'),
    );
}

//自定义字段
if(strpos($_SERVER['SCRIPT_NAME'], "write-post.php")):
function themeFields($layout) {
	$postType = new Typecho_Widget_Helper_Form_Element_Radio('postType', array(0 => _t('相册（默认）'), 1 => _t('图文（与单页排版一致）')), 0, _t('「相册/图文」模式选择'), _t('选择前台文章详情的显示方式'));
	$layout->addItem($postType);

	$title = new Typecho_Widget_Helper_Form_Element_Select('title', array(_t('文章标题序列'), _t('图片文件名或描述')), NULL, _t('图片[title]'), _t('选择前台图片标签的 title 属性值（图片源为内容的 [title] 默认为文章标题序列）'));
	$layout->addItem($title);

	$src = new Typecho_Widget_Helper_Form_Element_Select('src', array(0 => _t('附件'), 1 => _t('内容'), 2 => _t('附件+内容')), 0, _t('图片源'), _t('选择前台展示的图片源（若选择[附件+内容]则内容图片在前）'));
	$layout->addItem($src);

	$photog = new Typecho_Widget_Helper_Form_Element_Text('photog', NULL, NULL, _t('作者/来源'), _t('在这里填写拍摄照片者的姓名'));
	$layout->addItem($photog);

	$srcurl = new Typecho_Widget_Helper_Form_Element_Text('srcurl', NULL, NULL, _t('来源地址'), _t('在这里填写图片出处的网络地址（留空则不链接地址）'));
	$layout->addItem($srcurl);

	$appear = new Typecho_Widget_Helper_Form_Element_Text('appear', NULL, NULL, _t('出镜人物'), _t('在这里填写照片出镜者的姓名'));
	$layout->addItem($appear);

	$software = new Typecho_Widget_Helper_Form_Element_Select('software', afterSoftware(), NULL, _t('处理软件'), _t('在这里选择照片后期处理软件'));
	$layout->addItem($software);

	$packageUrl = new Typecho_Widget_Helper_Form_Element_Text('packageUrl', NULL, NULL, _t('打包下载'), _t('在这里填写图片打包下载地址（留空则不显示）'));
	$layout->addItem($packageUrl);

	$packageName = new Typecho_Widget_Helper_Form_Element_Text('packageName', NULL, NULL, _t('打包下载链接名'), _t('在这里填写图片打包下载链接名（留空则显示「打包下载」）'));
	$layout->addItem($packageName);

	$description = new Typecho_Widget_Helper_Form_Element_Textarea('description', NULL, NULL, _t('图集描述'), _t('在这里填写照片描述等其他文本信息'));
	$layout->addItem($description);

	$thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('封面图片'), _t('在这里填写封面图片的地址（留空将自动获取第一个附件图片）'));
	$layout->addItem($thumb);

	$hiddenMorePic = new Typecho_Widget_Helper_Form_Element_Select('hiddenMorePic', array(0 => _t('否'), 1 => _t('是')), 0, _t('是否隐藏部分图片'), _t('相册详情隐藏部分图片并登陆后可见'));
	$layout->addItem($hiddenMorePic);

	$hiddenMorePics = new Typecho_Widget_Helper_Form_Element_Text('hiddenMorePics', NULL, NULL, _t('隐藏图片位置'), _t('填写整数，从此位置的图片开始隐藏。'));
	$layout->addItem($hiddenMorePics);

	$differentCol = new Typecho_Widget_Helper_Form_Element_Text('differentCol', NULL, NULL, _t('设置「不一样の列」'), _t('页面共12列，设置第N张图片超小屏、小屏、中屏、大屏所占列数，示例：<span style="color:red;">2:12,8,6,6</span>。'));
	$layout->addItem($differentCol);

	$readTimes = new Typecho_Widget_Helper_Form_Element_Text('readTimes', NULL, NULL, _t('阅读次数'), _t('记录相册被点击的次数，可手动设置起始阅读量，后续点击会在此基础上自增。'));
	$layout->addItem($readTimes);
}
endif;

function image_class_replace($content){
    $content = preg_replace('#<img(.*?) src="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#', '<span data-fancybox="gallery" class="post-item" data-src="$2$3"><img$1 src="$2$3"$5 data-original="$2$3"></span>', $content);
    return $content;
}

//以下函数未启用
function themeInit($archive){
	//$_GET['HOST_DATA_URL'] = 'https://siitake.cn/tools/photograph/auth.php?host='.$_SERVER['HTTP_HOST'];
	//$_GET['HOST_DATA'] = file_get_contents($_GET['HOST_DATA_URL']);
	if ($archive->is('single')){
		$archive->content = image_class_replace($archive->content);
	}
}

