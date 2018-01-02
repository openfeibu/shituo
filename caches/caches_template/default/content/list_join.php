<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="main pdt">
    <div class="page_banner fb-position-relative">
        <img class="fb-position-absolute" src="<?php echo $CATEGORYS['28']['image'];?>" alt="">
    </div>
    <div class="main_content">
        <div class="jion_con w1200 fb-clearfix">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6d6aaa6f8e9950d4dcc1f9c327b90abf&action=lists&catid=%24catid&order=id+ASC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id ASC','moreinfo'=>'1','limit'=>'20',));}?>
            <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
            <div class="jion_con_item fb-float-left fb-transition">
                <div class="jion_con_item_zone">
                    <div class="jion_item_title"><?php echo  $r[$GLOBALS['prefix']."title"] ?></div>
                    <div class="jion_item_email"><?php echo SL('email');?>：<?php echo $r['email'];?></div>
                    <div class="jion_item_name"><?php echo  $r[$GLOBALS['prefix']."name"] ?></div>
                    <div class="jion_item_address"><?php echo SL('address');?>：<?php echo  $r[$GLOBALS['prefix']."address"] ?></div>
                    <div class="jion_item_work">
                        <p class="jion_item_work_title"><?php echo SL('responsibility');?></p>
                        <div class="jion_item_work_con">
                            <?php echo  $r[$GLOBALS['prefix']."content"] ?>
                        </div>
                    </div>
                    <div class="jion_item_require">
                        <p class="jion_item_require_title"><?php echo SL('job_requirements');?></p>
                        <div class="jion_item_require_con">
                            <?php echo  $r[$GLOBALS['prefix']."require_con"] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>
</div>
<?php include template("content","footer"); ?>
</body>
</html>
