<?php 

include_once('include/head.php');

$ms  = $c->home_timeline(); // 获取当前登录用户及其所关注用户的最新微博

$fs = $c->followers_active();
$gg = $c->public_timeline();

//$me = $c->verify_credentials();
$uid_get = $c->get_uid();

$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

?>
<div class="container">

	您好<?=$user_message['screen_name']?>
    <?php
        echo $fs['screen_name'];
        echo $gg['count'];
        //echo $fs['friendships'];
    ?>

</div>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../api/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

$('.mainNav').find('li').eq(2).addClass('active');

</script>