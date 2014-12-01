<?php 

include_once('include/head.php');


//$me = $c->verify_credentials();
$uid_get = $c->get_uid();

//根据uid获取用户等基本信息 array(23) var_dump($myAll_id['status']);

//根据 screen_name 获取用户基本信息 array(48) var_dump ($myAll);


/*//根据用户 screen_name 获取粉丝
$screen_name = $myAll_id['screen_name'];
$fansAll = $c->followers_ids_by_name($screen_name, 0, 50);
//根据用户 id 获取粉丝
$fans_id = $c -> followers_ids_by_id($uid, 0, 50);*/



$uid = $uid_get['uid'];
//根据用户id
$myAll_id = $c->show_user_by_id($uid);
$screen_name = $myAll_id['screen_name'];


//根据用户昵称
$myAll = $c->show_user_by_name($screen_name);
//判断提交的 搜索参数
if( isset($_REQUEST['search']) ) {

    if (is_numeric($_REQUEST['search'])) {
        $myAll = $c->show_user_by_id($_REQUEST['search']);
    }else{
        //提交的 用户查询
        $myAll = $c->show_user_by_name($_REQUEST['search']);
    }
}


//$fansAll = $c->followers_ids_by_name($screen_name); //followers_by_name
?>

<div class="container">
    <br>
    <h4>搜索用户</h4>
    <div class="row">
        <form action="" >
            <div class="col-sm-3">
                <input type="text" name="search" class="form-control" placeholder="昵称">
            </div>
            <div class="col-sm-2">
                <input type="submit" class="btn btn-primary" value=" 搜 索 ">
            </div>
        </form>
    </div>

<br>

<hr>

<?php 
if ($myAll_id['screen_name'] === false || $myAll_id['screen_name'] === null) {
    echo "错误，请刷新";
    die();
}?>


<?php if( is_array( $myAll) ): ?>
<div class="row">
    <div class="media">
      <a class="media-left" href="http://weibo.com/<?=$myAll['id']?>" title="<?=$myAll['name']?>" target="_blank">
        <img src="<?=$myAll['profile_image_url']?>" style="width: 64px; height: 64px;">
      </a>
      <div class="media-body">
        <h4 class="media-heading"><?=$myAll['name']?> <?php
        echo $myAll['verified']=='1'?' V ':'';
        if ($myAll['verified']=='1') {
            echo "（".$myAll['verified_reason']."）";
        }
        ?>，您好！</h4>
        <p>粉丝：<?=$myAll['followers_count']?>，关注：<?=$myAll['friends_count']?>，微博：<?=$myAll['statuses_count']?>，收藏：<?=$myAll['favourites_count']?>，<a href="<?=$myAll['avatar_large']?>" target="_blank">高清头像</a></p>
        <p><?=$myAll['gender']=='m'?'男':'女'?>：<?=$myAll['description']==''?'还没有写介绍':$myAll['description']?></p>
        <p><b><?=$myAll['allow_all_act_msg']==''?'允许所有人的私信':'不接受私信'?></b>，<b><?=$myAll['allow_all_comment']=='1'?' 允许评论':' 拒绝评论'?>，</b>互粉数：<?=$myAll['bi_followers_count']?></p>
        <p>个性域名：<?php echo $myAll['domain']==''?'未设置':'<a href="http://weibo.com/'.$myAll['domain'].'" target="_blank"> '.$myAll['domain'].' </a>' ?>   </p>
        <p>来自于：<?=$myAll['province']?><?=$myAll['city']?><?=$myAll['location']?>，（<?=$myAll['geo_enabled']=='1'?'允许地理标识':'不许地址标识'?>）注册时间：<?=$myAll['created_at']?>，当前<?=$myAll['online_status']=='1'?'在线':'不在线'?></p>

      </div>
    </div><!-- media end -->
</div>
<div class="row">
    <h4>近期微博：</h4>

        <p data-id="<?=$myAll['status']['id']?>"><?=$myAll['status']['text']?></p>
        <p>转发：<?=$item['reposts_count']==''?'0':$item['reposts_count']?>，评论：<?=$item['comments_count']==''?'0':$item['comments_count']?>，<?=$myAll['status']['geo']['address']==''?'未附加地理':$myAll['status']['geo']?>，<?=$myAll['status']['created_at']?>，<?=$myAll['status']['source']?>，<?=$myAll['status']['favorited']=='1'?'已收藏':'未收藏'?></p>
        <p></p>
</div>
<?php endif; ?>

<!--     <form action="" class="row">
        <div class="col-sm-3">
            <input type="text" name="avatar" class="form-control" placeholder="更新头像url">
        </div>
        <div class="col-sm-2">
            <input type="submit" class="btn btn-primary" value="更新头像 ">
        </div>
    </form> -->
</div>

<?php
echo "<pre class='none'>";
var_dump($myAll);
echo "</pre>";
?>

<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../api/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.media-heading').on('mouseenter mouseleave', function(){
        $(this).siblings('.tips').toggleClass('block');
    });
    $('.mainNav').find('li').eq(1).addClass('active');
})
</script>
</div>
<?php include_once('include/foot.php') ?>
