
<?php include_once('include/head.php') ?>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<?php 
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
?>

<div class="container">

	<p>新浪微博PHP By HighSea </p>
	<p>像登陆新浪微博，查看首页一样的功能</p>
	<p>鼠标移动至 改用户名称时 展示该用户的详细信息</p>
	<p>不断完善中……</p>
	<h1>关注作者：<wb:follow-button uid="3216856147" type="red_4" width="100%" height="64" ></wb:follow-button> </h1>
	<!-- 授权按钮 -->
    <p><a href="<?=$code_url?>"><img src="images/weibo_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a></p>

</div>

<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

    $('.mainNav').find('li').eq(0).addClass('active');
</script>
<?php include_once('include/foot.php') ?>
