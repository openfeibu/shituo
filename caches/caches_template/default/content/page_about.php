<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="main pdt">
    <div class="page_banner fb-position-relative">
        <img class="fb-position-absolute" src="<?php echo $CATEGORYS['22']['image'];?>" alt="">
    </div>
    <div class="main_content">
      <div class="about_company w1200">
          <?php $key = $GLOBALS['prefix']."content"; echo $$key; ?>
      </div>
        <div class="sense w1200 fb-clearfix">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=9b6d7d7376f28222df33dc8e028956ee&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D45\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=45 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
            <?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
            <?php echo $val[$GLOBALS['prefix']."content"];?>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>
</div>
<?php include template("content","footer"); ?>
</body>
</html>
