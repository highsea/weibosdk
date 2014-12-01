<?php 

include_once('include/head.php');


//$fs = $c->followers_active();
//$gg = $c->public_timeline();

$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
//根据ID获取用户等基本信息- 昵称
$user_message = $c->show_user_by_id( $uid);

//根据用户 screen_name 获取粉丝
$screen_name = $user_message['screen_name'];
$fansAll = $c->followers_ids_by_name($screen_name, 0, 50);

//根据用户 id 获取粉丝  5288314462 3045351622 3045351622
//$fans_id = $c -> followers_ids_by_id($uid, 1, 50);

?>
<div class="container">

<h4 data-id="<?=$uid?>">您好<?=$user_message['screen_name']?></h4>
    



<?php



if ($fansAll === false || $fansAll === null){
    echo "出错，请刷新";
    return false;
}
//调试
/*if (isset($fansAll['error_code']) && isset($fansAll['error'])){
    echo "<pre>";
    var_dump($fansAll);
    echo "</pre>";
    echo ('错误代码: '.$fansAll['error_code'].';  错误内容: '.$fansAll['error'] );
    return false;
}*/
?>

<?php if( is_array( $fansAll ) ): ?>
<?php 

    echo "粉丝数：".$fansAll['total_number']."人，下页".$fansAll['next_cursor']."人，上页".$fansAll['previous_cursor']."人<br><br>";

?>

    <?php foreach( $fansAll['ids'] as $item ): ?>
        <p><a href="homelist.php?search=<?=$item?>" target="_blank"><?=$item?></a></p>
    <?php endforeach; ?>
<?php endif; ?>

<?php
    echo "<br><br>新浪的通知：“为进一步保护用户数据，即日起微博开放平台将对用户关系读取类接口进行升级，各接口最多返回指定用户关注数/粉丝数</b> 30% </b>的数据。本次调整涉及所有获取粉丝或粉丝id、关注列表或关注id列表接口。” -- via 新浪微博开放平台问答系统";
    echo "<pre class='none'>";
    var_dump($fansAll);
    echo "</pre>";
?>






</div>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../api/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

$('.mainNav').find('li').eq(2).addClass('active');

</script>