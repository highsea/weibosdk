<?php include_once('include/head.php') ?>

<?php

$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$ms  = $c->home_timeline(); // 获取当前登录用户及其所关注用户的最新微博
//$me = $c->verify_credentials();
$uid_get = $c->get_uid();

$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

?>
<div class="container">
    <h2 data-token="<?php echo $_SESSION['token']['access_token'];  ?>"><?=$user_message['screen_name']?>,您好！ </h2>

    
    <h2 align="left">发送新微博</h2>

    <div class="row">
        <form action="" >
            <div class="col-sm-6">
                <input type="text" name="text" class="form-control" placeholder="请输入………">
            </div>
            <div class="col-sm-2">
                <input type="submit" class="btn btn-primary" value=" 提 交 ">
            </div>

        </form>
    </div>
    
<!--  -->

<!--  -->
<?php
if( isset($_REQUEST['text']) ) {
    $ret = $c->update( $_REQUEST['text'] ); //发送微博
    if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
        echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
    } else {
        echo "<p>发送成功</p>";
    }
}
?>
<!--  -->


<?php if( is_array( $ms['statuses'] ) ): ?>
    <?php foreach( $ms['statuses'] as $item ): ?>

<div class="media">
  <a class="media-left media-middle" href="http://weibo.com/<?=$item['user']['id']?>" title="<?=$item['user']['name']?>" target="_blank">
    <img src="<?=$item['user']['profile_image_url']?>" >
  </a>
  <div class="media-body">
    <h4 class="media-heading" data-mid="<?=$item['mid']?>" ><a href="http://weibo.com/<?=$item['user']['id']?>" target="_blank" ><?=$item['user']['screen_name']?></a></h4>
    <p><?=$item['text']; ?></p>
    
    <p><?php echo "转发：".$item['reposts_count']."；评论：".$item['comments_count']."；来源：".$item['source'];?></p>
    <p>时间：<?=$item['created_at']; ?></p>
    <div class="tips none" style="background:#fff url(<?=$item['user']['avatar_large']?>) center right no-repeat">
        <ul style="padding-right:200px;margin-right:4px">
            <li><?php echo $item['user']['name'];echo $item['user']['verified']=='1'?' V ':''; ?>【<?=$item['user']['verified_reason']==''?' 未认证 ':$item['user']['verified_reason']?>】<? echo $item['user']['gender']=='m'?'：男 ':'：女 ';?><?php
                            $f_ing = $item['user']['following']; 
                            if ($f_ing=='') {
                                echo '<b>这是你自己</b>';
                            }else{
                                echo $f_ing=='1'?' <b> 已经关注 </b>':'：<b> 你没关注他 </b>';
                            }
            ?><?php echo $item['user']['follow_me']==''?'<b>，他没关注你 </b>':'<b>，他关注了你 </b>，'; ?><?=$item['user']['allow_all_act_msg']=='1'?'允许所有人给他发私信':'不接受私信'?><?=$item['user']['allow_all_comment']=='1'?' 允许评论':' 拒绝评论'?></li>
            <li><? echo $item['user']['description']==''?'听说该用户懒得写介绍':$item['user']['description']; ?></li>
            <li><? echo $item['user']['province'].$item['user']['city'].$item['user']['location']; ?></li>
            <li>博客：<? echo $item['user']['url']==''?'他居然没有博客！':$item['user']['url']; ?></li>
            <li>个性化域名：<?=$item['user']['domain']==''?'没有设置':'http://weibo.com/'.$item['user']['domain']?></li>
            <li>粉丝数：<?=$item['user']['followers_count']?>；</li>
            <li>关注数：<?=$item['user']['friends_count']?>；</li>
            <li>微博数：<?=$item['user']['statuses_count']?></li>
            <li>喜欢数：<?=$item['user']['favourites_count']?>；</li>
            <li>互粉数：<?=$item['user']['bi_followers_count']?></li>
            <li>注册时间：<?=$item['user']['created_at']?>；</li>
            <li>当前是否在线：<?=$item['user']['online_status']=='0'?'不在线':'在线'?></li>
        </ul>
    </div>
  </div>


        
</div>
    <?php endforeach; ?>
<?php endif; ?>


<br>
<br>
<br>
<br>


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
