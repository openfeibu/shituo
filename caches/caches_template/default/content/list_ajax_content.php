<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d074da5e50371feece335e94632756b0&action=lists&catid=%24catid&order=id+DESC&page=%24page&moreinfo=1&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 6;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
<?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
<div class="news_list_text_item fb-float-left">
    <div class="news_list_text_item_box fb-transition">
        <a href="<?php echo $r['url'];?>">
            <div class="date"><?php echo date('Y-m-d',$r[inputtime]);?></div>
            <div class="content"><?php echo $r[$GLOBALS['prefix']."title"];?></div>
        </a>
    </div>
</div>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
