<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php Content::outputCommentJS($this, $this->security); ?>
</div><!-- /content -->
  <footer id="footer" class="app-footer" role="footer">
    <div class="wrapper b-t bg-light">
      <span class="pull-right hidden-xs">
      <?php $this->options->BottomInfo(); ?>
      Powered by <a id="ushio-homepage" href="https://ushio.xyz">Ushio</a>&nbsp;|&nbsp;Theme by <a target="blank" href="https://www.ihewro.com">handsome</a>&nbsp;|&nbsp;Developed by <a id="ushio-me" href="https://iotcat.me">IoTcat</a>
      </span>
		&copy;&nbsp;2018-<?php echo date("Y");?>&nbsp;Copyright&nbsp;<a id="ushio-me" href="https://iotcat.me">IoTcat</a>&nbsp;|&nbsp;<a href="http://beian.miit.gov.cn/" target="_blank">鲁ICP备18022823号-1</a></a><?php $this->options->BottomleftInfo(); ?>
    </div>

      <?php if (@in_array('showSettingsButton',$this->options->featuresetup)): ?>
      <script type="text/template" id="tmpl-customizer">
          <div class="settings panel panel-default setting_body_panel" aria-hidden="true">
              <button class="btn btn-default no-shadow pos-abt" data-toggle="tooltip" data-placement="left" data-original-title="<?php _me("设置") ?>" data-toggle-class=".settings=active, .settings-icon=animate-spin">
                  <i class="fontello fontello-gear settings-icon"></i>
              </button>
              <div class="panel-heading">
                  <button class="pull-right btn btn-xs btn-rounded btn-danger" name="reset" data-toggle="tooltip" data-placement="top" data-original-title="<?php _me("恢复默认值") ?>" ><?php _me("重置") ?></button>
                  <?php _me("设置") ?>		</div>
              <div class="setting_body">
              <div class="panel-body">
                  <# for ( var keys = _.keys( data.sections.settings ), i = 0, name; keys.length > i; ++i ) { #>
                      <div<# if ( i !== ( keys.length - 1 ) ) print( ' class="m-b-sm"' ); #>>
                          <label class="i-switch bg-info pull-right">
                              <input type="checkbox" name="{{ keys[i] }}" value="1"<# if ( data.defaults[keys[i]] ) print( ' checked="checked"' ); #> />
                                  <i></i>
                          </label>
                          {{ data.sections.settings[keys[i]] }}
              </div>
              <# } #>
          </div>
          <div class="wrapper b-t b-light bg-light lter r-b">
              <div class="row row-sm">
                  <div class="col-xs-6">
                      <#
                              _.each( data.sections.colors, function( color, i ) {
                              var newColumnBefore = ( i % 7 ) === 6;
                              #>
                          <label class="i-checks block<# if ( !newColumnBefore ) print( ' m-b-sm' ); #>">
                              <input type="radio" name="color" value="{{ i }}"<# if ( data.defaults['color'] === i ) print( ' checked="checked"' ); #> />
                                  <span class="block bg-light clearfix pos-rlt">
								<span class="active pos-abt w-full h-full bg-black-opacity text-center">
									<i class="fontello fontello-check text-md text-white m-t-xs"></i>
								</span>
								<b class="{{ color.navbarHeader }} header"></b>
								<b class="{{ color.navbarCollapse }} header"></b>
								<b class="{{ color.aside.replace( ' b-r', '' ) }}"></b>
							</span>
                          </label>
                          <#
                                  if ( newColumnBefore && ( i + 1 ) < data.sections.colors.length )
                          print( '</div><div class="col-xs-6">' );
                              } );
                              #>
                          </div>
                  </div>
              </div>
          </div>
          </div>
      </script>
      <?php endif; ?>

      <div class="topButton panel panel-default">
          <button id="goToTop" class="btn btn-default no-shadow pos-abt hide">
              <i class="fontello fontello-chevron-circle-up" aria-hidden="true"></i>
          </button>
      </div>
  </footer>
  </div><!--end of .app app-header-fixed-->

<?php $this->footer(); ?>

    <!--定义全局变量-->
    <script type="text/javascript">
        window['LocalConst'] = {
            COMMENT_NAME_INFO: '<?php _me("必须填写昵称或姓名")?>',
            COMMENT_EMAIL_INFO: '<?php _me("必须填写电子邮箱地址") ?>',
            COMMENT_EMAIL_LEGAL_INFO: '<?php _me("邮箱地址不合法") ?>',
            COMMENT_CONTENT_INFO: '<?php _me("必须填写评论内容") ?>',
            COMMENT_SUBMIT_ERROR: '<?php _me("提交失败，请重试！") ?>',
            COMMENT_CONTENT_LEGAL_INFO: '<?php _me("提交失败,您的输入内容不符合规则！") ?>',

            LOGIN_USERNAME_INFO: '<?php _me("必须填写用户名") ?>',
            LOGIN_PASSWORD_INFO: '<?php _me("请填写密码") ?>',
            LOGIN_SUBMIT_ERROR: '<?php _me("登录失败，请重新登录") ?>',
            LOGIN_SUBMIT_INFO: '<?php _me("用户名或者密码错误，请重试") ?>',
            LOGIN_SUBMIT_SUCCESS: '<?php _me("登录成功") ?>',
            CLICK_TO_REFRESH: '<?php _me("点击以刷新页面") ?>',
            LOGOUT_SUCCESS_REFRESH: '<?php _me("退出成功，正在刷新当前页面") ?>',

            LOGOUT_ERROR: '<?php _me("退出失败，请重试") ?>',
            LOGOUT_SUCCESS: '<?php _me("退出成功") ?>',

            SUBMIT_PASSWORD_INFO: '<?php _me("密码错误，请重试") ?>',
            COMMENT_TITLE: '<?php _me("评论通知") ?>',
            LOGIN_TITLE: '<?php _me("登录通知") ?>',
            ChANGYAN_APP_KEY: '<?php $this->options->ChangyanAppKey() ?>',
            CHANGYAN_CONF: '<?php $this->options->ChangyanConf() ?>',

            COMMENT_SYSTEM: '<?php echo COMMENT_SYSTEM; ?>',
            COMMENT_SYSTEM_ROOT: '<?php echo Handsome_Config::COMMENT_SYSTEM_ROOT; ?>',
            COMMENT_SYSTEM_CHANGYAN: '<?php echo Handsome_Config::COMMENT_SYSTEM_CHANGYAN; ?>',
            COMMENT_SYSTEM_OTHERS: '<?php echo Handsome_Config::COMMENT_SYSTEM_OTHERS; ?>',
            EMOJI: '<?php _me('表情') ?>',
            IS_PJAX: '<?php echo PJAX_ENABLED ?>',
            IS_PAJX_COMMENT: '<?php echo PJAX_COMMENT_ENABLED; ?>',
            BASE_SCRIPT_URL: '<?php echo THEME_URL; ?>',
            BLOG_URL: '<?php echo BLOG_URL; ?>',
            THEME_COLOR: '<?php $this->options->themetype(); ?>',
            THEME_HEADER_FIX: '<?php echo in_array('header-fix', $this->options->indexsetup) ? true : false; ?>',
            THEME_ASIDE_FIX: '<?php echo in_array('aside-fix', $this->options->indexsetup) ? true : false; ?>',
            THEME_ASIDE_FOLDED: '<?php echo in_array('aside-folded', $this->options->indexsetup) ? true : false; ?>',
            THEME_ASIDE_DOCK: '<?php echo in_array('aside-dock', $this->options->indexsetup) ? true : false; ?>',
            THEME_CONTAINER_BOX: '<?php echo in_array('container-box', $this->options->indexsetup) ? true : false; ?>',
            THEME_HIGHLIGHT_CODE: '<?php echo in_array('hightlightcode', $this->options->featuresetup); ?>',
            THEME_TOC: '<?php echo IS_TOC; ?>',
            TOC_TITLE: '<?php _me('文章目录'); ?>',
            HEADER_FIX: '<?php _me("固定头部") ?>',
            ASIDE_FIX: '<?php _me("固定导航") ?>',
            ASIDE_FOLDED: '<?php _me("折叠导航") ?>',
            ASIDE_DOCK: '<?php _me("置顶导航") ?>',
            CONTAINER_BOX: '<?php _me("盒子模型") ?>',
            OFF_SCROLL_HEIGHT: '<?php echo (!in_array('header-fix', $this->options->indexsetup)) ? 0 : (in_array('aside-dock', $this->options->indexsetup) ? 115 : 50) ; ?>',
            COMMENT_REJECT_PLACEHOLDER: '<?php _me('居然什么也不说，哼'); ?>',
            COMMENT_PLACEHOLDER: '<?php _me('说点什么吧……') ?>',
            SHOW_SETTING_BUTTON: '<?php echo in_array('showSettingsButton', $this->options->featuresetup) ? true :
                false; ?>',
            THEME_VERSION: '<?php echo Handsome::$version . Handsome::$versionTag ?>',

            OPERATION_NOTICE: '<?php _me("操作通知") ?>',
            SCREENSHOT_BEGIN: '<?php _me("正在生成当前页面截图……") ?>',
            SCREENSHOT_NOTICE: '<?php _me("点击顶部下载按钮保存当前卡片") ?>',
            SCREENSHORT_ERROR: '<?php _me("由于图片跨域原因导致截图失败") ?>',
            SCREENSHORT_SUCCESS: '<?php _me("截图成功") ?>',
            MUSIC_NOTICE: '<?php _me("播放通知") ?>',
            MUSIC_FAILE: '<?php _me("当前音乐地址无效，自动为您播放下一首") ?>',
            MUSIC_FAILE_END: '<?php _me("当前音乐地址无效") ?>',
            MUSIC_LIST_SUCCESS: '<?php _me("歌单歌曲加载成功") ?>',
            CDN_NAME: '<?php if($this->options->cdn_add == "")echo ""; else echo trim(explode("|",
            $this->options->cdn_add)
            [1]); ?>'
        };

    </script>


<!--CDN加载-->
<?php $PUBLIC_CDN_ARRAY = unserialize(PUBLIC_CDN); ?>
<script src="<?php echo $PUBLIC_CDN_ARRAY['js']['bootstrap'] ?>"></script>


<?php if (PJAX_ENABLED): ?>
    <script src="<?php echo STATIC_PATH;?>js/features/jquery.pjax.min.js" type="text/javascript"></script>
    <script>
        $(document).pjax('a[href^="<?php echo $this->options->rootUrl.'/'; ?>"]:not(a[target="_blank"], a[no-pjax])', {
            container: '#content',
            fragment: '#content',
            timeout: 8000
        }).on('pjax:send',function () {
            <?php if($this->options->pjaxAnimate == "default" || $this->options->pjaxAnimate == "" || $this->options->pjaxAnimate == "whiteRound" || $this->options->pjaxAnimate == "customise"): ?>
            $('#loading').removeClass('hide');
            <?php endif; ?>
        }).on('pjax:click', function() {

            window['Page'].doPJAXClickAction();
            <?php if($this->options->pjaxAnimate != "default" && $this->options->pjaxAnimate != ""): ?>
            Pace.restart();
            <?php endif;?>

            <?php if ($this->options->isPjaxToTop == '0'): ?>
            $('body,html').animate({scrollTop:0},<?php $this->options->toTopSpeed(); ?>);
            <?php endif; ?>


        }).on('pjax:complete', function() {
            window['Page'].doPJAXCompleteAction();


            <?php if (@in_array('lazyload',$this->options->featuresetup)): ?>
                <?php if (in_array('isPageAnimate',$this->options->featuresetup)): ?>
                $('.app-content-body').animateCss('fadeInUpBig', function() {
                    $("img").lazyload({
                        effect: "fadeIn",
                        threshold: "200"
                    });

                    $(".lazy").lazyload({
                        effect: "fadeIn",
                        threshold: "200"
                    });
                });
                <?php else: ?>
                $("img").lazyload({
                    effect: "fadeIn",
                    threshold: "200"
                });
                $(".lazy").lazyload({
                    effect: "fadeIn",
                    threshold: "200"
                });
                <?php endif; ?>
            <?php endif; ?>
            <?php if($this->options->pjaxAnimate == "default" || $this->options->pjaxAnimate == "" || $this->options->pjaxAnimate == "whiteRound" || $this->options->pjaxAnimate == "customise"): ?>
            $('#loading').addClass('hide');
            <?php else: ?>
            //Pace.stop();
            <?php endif;?>

            <?php $this->options->ChangeAction(); ?>
            <?php if (@in_array('mathJax',$this->options->featuresetup)): ?>
            MathJax.Hub.Queue(["Typeset",MathJax.Hub,"body"]);
            <?php endif; ?>


        })
    </script>
<?php endif; ?>


<!--主题组件js加载-->

<?php if (!empty($this->options->featuresetup) && in_array('smoothscroll', $this->options->featuresetup)): ?>
    <!--平滑滚动组件-->
    <script src="<?php echo STATIC_PATH ?>js/features/SmoothScroll.min.js"></script>
<?php endif; ?>

<!--pjax动画组件-->
<?php if($this->options->pjaxAnimate !== "default"): ?>
    <script>
        window.paceOptions = {
            ajax: {
                ignoreURLs: ['/.*Get.php.*/']
            },//忽视音乐加载的ajax请求
            restartOnPushState: false,
            startOnPageLoad: false,
            restartOnRequestAfter: false
        };
    </script>
    <script src="<?php echo STATIC_PATH ?>js/features/pace.min.js"></script>

<?php if(!($this->options->pjaxAnimate == "default" || $this->options->pjaxAnimate == "" || $this->options->pjaxAnimate == "whiteRound" || $this->options->pjaxAnimate == "customise")): ?>
    <link href="<?php echo STATIC_PATH ?>css/features/pjax/pace-theme-<?php $this->options->pjaxAnimate ()?>.css" rel="stylesheet">
<?php endif; ?>

    <?php if (trim($this->options->progressColor) !== ""): ?>
        <style>
            <?php if (!($this->options->pjaxAnimate == "default" || $this->options->pjaxAnimate == "" || $this->options->pjaxAnimate == "whiteRound" || $this->options->pjaxAnimate == "customise") && $this->options->isPjaxShowMatte == '0'): ?>
            .pace-running #content,.pace-running #aside{
                opacity: 0.4;
            }

            .pace-done #content,.pace-done #aside{
                opacity: 1;
            }
            <?php endif; ?>
            <?php echo Content::returnPjaxAnimateCss(); ?>
        </style>
    <?php endif; ?>
<?php endif; ?>

<?php if (@in_array('lazyload',$this->options->featuresetup)): ?>
    <script src="<?php echo STATIC_PATH ?>js/features/lazyload.min.js"></script>
    <script>
        $("img").lazyload({
            effect: "fadeIn",
            threshold: "200"
        });

        $(".lazy").lazyload({
            effect: "fadeIn",
            threshold: "200"
        });

        //后退的时候
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function () {
                /// 当点击浏览器的 后退和前进按钮 时才会被触发，
                window.history.pushState('forward', null, '');
                window.history.forward(1);//当前页 ,
                $("img").lazyload({
                    effect: "fadeIn",
                    threshold: "200"
                });

                $(".lazy").lazyload({
                    effect: "fadeIn",
                    threshold: "200"
                });
            });
        }
        //在ie中必须有这两行
        window.history.pushState('forward', null, '');
        window.history.forward(1);
    </script>
<?php endif; ?>

<?php if (@in_array('mathJax',$this->options->featuresetup)): ?>
    <!--maxJax公式组件-->
    <script src="//cdn.bootcss.com/mathjax/2.7.0/MathJax.js" type="text/javascript"></script>
    <script src="//cdn.bootcss.com/mathjax/2.7.0/config/TeX-AMS-MML_SVG.js" type="text/javascript"></script>
<?php endif; ?>


<!--lightgallery必备组件-->
<script src="<?php echo STATIC_PATH ?>js/features/jquery.fancybox.min.js?v=<?php echo Handsome::$version.Handsome::$versionTag ?>"></script>

<?php if($this->options->commentChoice =='0'): ?>
    <!--component/comments.php 页面必需js（只有选择了原生评论的时候才会加载）-->
    <script src="<?php echo STATIC_PATH ?>js/features/OwO.min.js?v=<?php echo Handsome::$version.Handsome::$versionTag
    ?>"></script>
    <!--component/comments.php 必需js结束-->
<?php endif; ?>


<?php if (@in_array("sreenshot",$this->options->featuresetup)): ?>
<!--截图插件-->
<script src="<?php echo STATIC_PATH ?>js/features/html2canvas.min.js"></script>
<?php endif; ?>
<!--主题组件js加载结束-->

<!--主题核心js-->
    <script src="<?php echo STATIC_PATH ?>js/function.min.js?v=<?php echo Handsome::$version.Handsome::$versionTag
    ?>"></script>
    <script src="<?php echo STATIC_PATH ?>js/core.min.js?v=<?php echo Handsome::$version.Handsome::$versionTag
?>"></script>


<?php if(@in_array('musicplayer',$this->options->featuresetup)): ?>
    <!--全局播放器组件-->
    <script src="<?php echo STATIC_PATH ?>js/music.min.js?v=<?php echo Handsome::$version.Handsome::$versionTag
    ?>"></script>
    <script>
        <?php

        $musicObject = new stdClass();

        if (RESOLVE_MUSIC_WAY == 0){
            $value = PLAYER_MUSIC_URL;
            //解析URL地址
            $array = Utils::parseMusicUrl($value);
            $musicObject->type = 'cloud';
            $musicObject->source = $array['id'];
            $musicObject->media = $array['media'];

        }elseif (RESOLVE_MUSIC_WAY == 1){
            //解析自定义音频地址
            $musicObject->type = 'file';
            $source = array();
            $source = '['.$this->options->customMusicContent.']';
            $source = json_decode($source);
            $musicObject->source = $source;
        }

        $autoPlay = false;
        if($this->options->playerSetting != "" && in_array('autoPlay',$this->options->playerSetting)){
            $autoPlay = true;
        }


        $musicSetting = (object)array(
            'autoplay' => $autoPlay,
            'listshow' => false,
            'mode' => 'listloop',
            'music' => $musicObject
        );

        ?>
        var player = new skPlayer(<?php echo json_encode($musicSetting); ?>);
    </script>
<?php endif; ?>

<?php if (in_array('showSettingsButton', $this->options->featuresetup)): ?>
    <script src="<?php echo STATIC_PATH ?>js/features/setting.min.js?v=<?php echo Handsome::$version
        .Handsome::$versionTag
    ?>"></script>
<?php endif; ?>

    <script type="text/javascript">
        <?php $this->options->customJs() ?>
    </script>

<?php $this->options->bottomHtml(); ?>


<script type="text/javascript"> 
/* 鼠标特效 */
var a_idx = 0; 
jQuery(document).ready(function($) { 
    $("body").click(function(e) { 
        var a = new Array("富强", "民主", "文明", "和谐", "自由", "平等", "公正" ,"法治", "爱国", "敬业", "诚信", "友善"); 
        var $i = $("<span/>").text(a[a_idx]); 
        a_idx = (a_idx + 1) % a.length; 
        var x = e.pageX, 
        y = e.pageY; 
        $i.css({ 
            "z-index": 999999999999999999999999999999999999999999999999999999999999999999999, 
            "top": y - 20, 
            "left": x, 
            "position": "absolute", 
            "font-weight": "bold", 
            "color": '#'+('00000'+ (Math.random()*0x1000000<<0).toString(16)).substr(-6)//"#ff6651" 
        }); 
        $("body").append($i); 
        $i.animate({ 
            "top": y - 180, 
            "opacity": 0 
        }, 
        1500, 
        function() { 
            $i.remove(); 
        }); 
    }); 
}); 

//博客动态运行时长
function secondToDate(second) {
if (!second) {
return 0;
}

var time = new Array(0, 0, 0, 0, 0);
/*
if (second >= 365 * 24 * 3600) {
            time[0] = parseInt(second / (365 * 24 * 3600));
                        second %= 365 * 24 * 3600;
                                }*/
if (second >= 24 * 3600) {
            time[1] = parseInt(second / (24 * 3600));
                        second %= 24 * 3600;
                                }
if (second >= 3600) {
            time[2] = parseInt(second / 3600);
                        second %= 3600;
                                }
        if (second >= 60) {
                    time[3] = parseInt(second / 60);
                                second %= 60;
                                        }
        if (second > 0) {
                    time[4] = second;
                            }
                                    return time;
     }

function setTime() {
var create_time = Math.round(new Date(Date.UTC(2019, 2, 19, 8, 31, 34)).getTime() / 1000);
var timestamp = Math.round((new Date().getTime() + 8 * 60 * 60 * 1000) / 1000);
      currentTime = secondToDate((timestamp - create_time));
      currentTimeHtml = /*currentTime[0] + '年' +*/ currentTime[1] + '天'
      + currentTime[2] + '时' + currentTime[3] + '分' + currentTime[4]
      + '秒';
document.getElementById("lasting_time").innerHTML = currentTimeHtml;
 }
setInterval(setTime, 1000);
</script>
<!-- 评论框特性 -->
<script type="text/javascript" src="https://cdn.yimian.xyz/commentTyping/commentTyping.min.js"></script>

</body>
</html><!--html end-->
