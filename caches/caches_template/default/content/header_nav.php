<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="logo fb-float-left">
    <a href="<?php echo siteurl($siteid);?>"><img src="<?php echo CSS_PATH;?>shituo/images/logo.png" alt=""></a>
</div>
<div class="setLau fb-float-left  fb-position-relative">
        <div class="lauBox_item <?php if($GLOBALS['lang'] == 'zh-cn') { ?>active<?php } ?>"><a href="<?php echo siteurl($siteid);?>/index.php?lang=zh-cn"><?php echo SL('Chinese');?></a></div>
        <div class="lauBox_item <?php if($GLOBALS['lang'] == 'en') { ?>active<?php } ?>" ><a href="<?php echo siteurl($siteid);?>/index.php?lang=en"><?php echo SL('English');?></a></div>
        <div class="lauBox_item <?php if($GLOBALS['lang'] == 'arab') { ?>active<?php } ?>"><a href="<?php echo siteurl($siteid);?>/index.php?lang=arab"><?php echo SL('Arab');?></a></div>
</div>
<div class="header_login fb-float-right">
    <?php if($_userid) { ?>
    <!-- 已登录 -->
    <div class="accout_img opa_active" style="display:block;"><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=member_center&siteid=<?php echo $siteid;?>"><img src="<?php echo CSS_PATH;?>shituo/images/person.png" alt=""/></a></div>
    <!-- 已登录 -->
    <?php } else { ?>
    <!-- 未登录 -->
    <div class="header_login_button opa_active"><?php echo SL('login');?></div>
    <!-- 未登录 -->
    <?php } ?>

</div>
<div class="nav fb-float-right">
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b43f1459ac702900c8d44c91a5e796dd&action=category&catid=0&num=25&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
        <ul>
            <li  <?php if(!$catid ) { ?> class="active" <?php } ?>><a href="<?php echo siteurl(1);?>/index.php"><?php echo SL('index');?></a></li>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <li <?php if($r[catid]==$CATEGORYS[$CAT[parentid]][catid] || $r[catid]==$catid  || $r[catid]==$CATEGORYS[$CAT[parentid]][parentid]) { ?>class="active"<?php } ?>><a href="<?php echo $r['url'];?>"><?php echo  $r[$GLOBALS['prefix']."catname"] ?></a></li>
            <?php $n++;}unset($n); ?>
        </ul>
    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>
