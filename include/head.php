<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
//$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );

if (!isset($_SESSION['token']['access_token'])) {
    header("Location: http://play.highsea90.com/weibosdk/login.php");
    exit;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>新浪微博-Powered by HighSea</title>
<link rel="stylesheet" href="../api/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../api/bootstrap/css/bootstrap-theme.min.css">
<!--  -->
<link rel="stylesheet" type="text/css" href="cssjs/style.css">


</head>

<body>
<div class="container mainNav" >
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation"><a href="index.php">首页</a></li>
        <li role="presentation"><a href="homelist.php">我的主页</a></li>
        <li role="presentation"><a href="fans.php">粉丝页</a></li>
        <li role="presentation"><a href="weibolist.php">微博列表</a></li>
    </ul>
</div>
