<?php 

include_once('include/head.php');


//$fs = $c->followers_active();
//$gg = $c->public_timeline();

$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

//用户ID
$screen_name = $user_message['screen_name'];
$fansAll = $c->followers_ids_by_name($screen_name, 0, 50);
?>
<div class="container">

    您好<?=$user_message['screen_name']?>

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
    echo "<pre>";
    var_dump($fansAll);
    echo "</pre>";
    echo "粉丝数：".$fansAll['total_number']."人<br>";
    echo "下页".$fansAll['next_cursor']."人";
    echo "上页".$fansAll['previous_cursor']."人";


?>

    <?php foreach( $fansAll['ids'] as $item ): ?>
        <?=$item?>
    <?php endforeach; ?>
<?php endif; ?>






</div>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../api/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

$('.mainNav').find('li').eq(2).addClass('active');

</script>