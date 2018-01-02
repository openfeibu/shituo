<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="default"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
    <meta name="keywords" content="<?php echo $SEO['keyword'];?>">
    <meta name="description" content="<?php echo $SEO['description'];?>"></title>
    <link rel="shortcut icon" href="homeIcon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>shituo/css/fbUi.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>shituo/css/main.css">
    <script src='<?php echo CSS_PATH;?>shituo/js/jquery-1.7.2.min.js'></script>
    <script src='<?php echo CSS_PATH;?>shituo/js/fbUi.js'></script>
    <script src='<?php echo CSS_PATH;?>shituo/js/common.js'></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>
<body class="bgf">
<div class="header fb-z999">
    <div class="w1200">
        <?php include template("content","header_nav"); ?>
    </div>

</div>
