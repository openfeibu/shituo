<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="line_tab_title"><?php echo $CATEGORYS[18][$GLOBALS['prefix']."catname"]; ?></div>
<div class="line_tab_list">
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0e788182d23f89d649f6e0de0a55e100&action=category&catid=18&siteid=%24siteid&order=listorder+ASC&return=data1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data1 = $content_tag->category(array('catid'=>'18','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
    <?php $n=1;if(is_array($data1)) foreach($data1 AS $r1) { ?>
    <div class="line_tab_item">
        <a href="<?php echo $r1['url'];?>" <?php if($catid == $r1['catid']) { ?>class="active"<?php } ?>><?php echo  $r1[$GLOBALS['prefix']."catname"] ?></a>
        <ul>
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a509fef6ccbcae917e267e183c5ffb41&action=category&catid=%24r1%5Bcatid%5D&siteid=%24siteid&order=listorder+ASC&return=data2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data2 = $content_tag->category(array('catid'=>$r1[catid],'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
        <?php $n=1;if(is_array($data2)) foreach($data2 AS $r2) { ?>
            <li><a <?php if($catid == $r2['catid']) { ?>class="active"<?php } ?> href="<?php echo $r2['url'];?>#main_content"><?php echo  $r2[$GLOBALS['prefix']."catname"] ?></a></li>
        <?php $n++;}unset($n); ?>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
    </div>
    <?php $n++;}unset($n); ?>
    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>
