<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="main pdt">
    <div class="page_banner fb-position-relative">
        <img class="fb-position-absolute" src="<?php echo $CATEGORYS['6']['image'];?>" alt="">
    </div>
    <div class="main_content">
        <div class="service_con fb-clearfix">
            <div class="ourAdvantage w1200">
                <div class="title">
                    <p class="fb-position-relative"><?php echo $CATEGORYS[7][$GLOBALS['prefix'].'catname'];?> </p>
                    <span><?php echo $CATEGORYS[7][$GLOBALS['prefix'].'description'];?></span>
                </div>
                <div class="ourAdvantage_con fb-clearfix">
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=a08af3575df3f2685d12ec663078568c&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=7 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
            		<?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                    <?php echo $val[$GLOBALS['prefix']."content"];?>
            		<?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
            </div>
            <div class="ourProduct">
                <div class="ourProduct_ky w1200">
                    <div class="img fb-inlineBlock"><img src="<?php echo $CATEGORYS['9']['image'];?>" alt=""></div>
                    <div class="text fb-inlineBlock">
                        <div class="title_n"><?php echo $CATEGORYS['9']['catname'];?></div>
                        <div class="title_e"><?php echo $CATEGORYS['9']['en_catname'];?></div>
                        <div class="desc">
                            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=c3bd9fbf7b32adff6e8e2c898fc92231&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=9 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                    		<?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                    		<?php echo $val[$GLOBALS['prefix']."content"];?>
                    		<?php $n++;}unset($n); ?>
                    		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                </div>
                <div class="ourProduct_hy w1200">
                    <div class="text fb-inlineBlock">
                        <div class="title_n"><?php echo $CATEGORYS['10']['catname'];?></div>
                        <div class="title_e"><?php echo $CATEGORYS['10']['en_catname'];?></div>
                        <div class="desc">
                            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=5f84fc942f5ab176f32e5f406990942e&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=10 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                    		<?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                    		<?php echo $val[$GLOBALS['prefix']."content"];?>
                    		<?php $n++;}unset($n); ?>
                    		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                    <div class="img fb-inlineBlock"><img src="<?php echo $CATEGORYS['10']['image'];?>" alt=""></div>
                </div>
            </div>
            <div class="sevice_info w1200 fb-clearfix">
                <div class="sevice_info_item fb-transition">
                    <div class="sevice_info_item_box1 fb-transition">
                        <div class="title_n fb-position-relative fb-transition"><p><?php echo $CATEGORYS[11][$GLOBALS['prefix'].'catname'];?></p></div>
                        <div class="content">
                            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=68e67ec256fc035b58da5d91eb49ac8c&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D11\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=11 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                    		<?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                    		<?php echo $val[$GLOBALS['prefix']."content"];?>
                    		<?php $n++;}unset($n); ?>
                    		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                </div>
                <div class="sevice_info_item  fb-transition">
                    <div class="sevice_info_item_box1 fb-transition">
                        <div class="title_n fb-position-relative fb-transition"><p><?php echo $CATEGORYS[12][$GLOBALS['prefix'].'catname'];?></p></div>
                        <div class="content">
                            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=842e35e8426cbbce03961c29e2b730c9&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=12 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                    		<?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                    		<?php echo $val[$GLOBALS['prefix']."content"];?>
                    		<?php $n++;}unset($n); ?>
                    		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logistics_line w1200">
                <div class="title_n"><?php echo SL('line');?></div>
                <div class="title_desc"><?php echo $CATEGORYS[19][$GLOBALS['prefix'].'description'];?></div>
                <div class="logistics_line_con">
                    <ul class=" fb-clearfix">
                        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=afb9b0200d2c7392109d54262c7f0ecf&action=category&catid=19&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'19','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
                        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                        <li>
                            <a href="<?php echo $r['url'];?>">
                                <div class="img"><img src="<?php echo $r['image'];?>" alt="<?php echo $r['catname'];?>"></div>
                                <div class="text"><?php echo  $r[$GLOBALS['prefix']."catname"] ?></div>
                            </a>
                        </li>
                        <?php $n++;}unset($n); ?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include template("content","footer"); ?>
</body>
<script>

</script>
</html>
