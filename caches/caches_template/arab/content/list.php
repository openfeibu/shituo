<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
    <div class="main pdt">
        <div class="page_banner fb-position-relative" >
            <img class="fb-position-absolute" src="<?php echo $CATEGORYS['13']['image'];?>" alt="">
        </div>
        <div class="main_content" id="main_content">
            <div class="news_con fb-clearfix">
                <div class="news_tab w1200" id="news_tab">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=395869ab857a54988ecc3f2a22505ac5&action=category&catid=%24parentid&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$parentid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="news_tab_item fb-inlineBlock <?php if($catid == $r['catid']) { ?>active<?php } ?>" id="news_tab_item"><a href="<?php echo $r['url'];?>#main_content"><?php echo  $r[$GLOBALS['prefix']."catname"] ?></a></div>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
                <div class="news_list_img w1200 fb-clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a3dfaf5082093b931b0499a1bcebac55&action=position&posid=10&catid=%24catid&order=id+DESC&num=6&return=pdata\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$pdata = $content_tag->position(array('posid'=>'10','catid'=>$catid,'order'=>'id DESC','limit'=>'6',));}?>
					<?php $i = 0?>
					<?php $n=1; if(is_array($pdata)) foreach($pdata AS $n => $p) { ?>
					<?php $i++?>
						<?php $id = $p[id];$cid = $p[catid];?>
						<?php $where = "id=$id"?>
					    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8d57b9afe0e6109ad04abf5e0cef7948&action=lists&catid=%24cid&where=%24where&moreinfo=1&num=1&return=cdata\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$cdata = $content_tag->lists(array('catid'=>$cid,'where'=>$where,'moreinfo'=>'1','limit'=>'1',));}?>
					    <!--使用where属性指定id，使用moreinfo属性指定获取副表信息-->
					    <?php $n=1;if(is_array($cdata)) foreach($cdata AS $c) { ?>
	                    <div class="news_list_img_item <?php if($i == 1) { ?>active<?php } ?> fb-transition">
	                        <a href="<?php echo $c['url'];?>">
	                            <div class="img"><img src="<?php echo $c['thumb'];?>" alt=""></div>
	                            <div class="text ">
	                                <div class="title_n"><?php echo $c[$GLOBALS['prefix']."title"];?></div>
	                                <div class="title_desc">
                                        <?php echo str_cut(strip_tags($c[$GLOBALS['prefix']."content"]),300,"...");?>
                                    </div>
	                                <div class="date"><?php echo date('Y-m-d',$c[inputtime]);?></div>
	                            </div>
	                        </a>
	                    </div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
				<div class="contain_ajaxhomelist" >
                	<?php include template("content","list_ajax"); ?>
				</div>
            </div>
        </div>
    </div>
    <?php include template("content","footer"); ?>
</body>
</html>
