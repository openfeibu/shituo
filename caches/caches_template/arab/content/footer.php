<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!--登录框-->
<div class="main-panel fb-z1000">
    <form action="">
        <ul class="main-list">
            <div class="panel-logo"><img src="<?php echo CSS_PATH;?>shituo/images/logo1.png" alt=""></div>
            <div>
                <li>
                    <div class="text-title hidden-xs"><?php echo SL('stock_code');?></div>
                    <input type="text" name="username" id="username" placeholder="<?php echo SL('enter_stock_code');?>"></li>
                <li>
                    <div class="text-title hidden-xs"><?php echo SL('password');?></div>
                    <input type="password" name="password" id="password" placeholder="<?php echo SL('enter_password');?>"></li>
                    <input type="hidden" name="cookietime" id="cookietime" value="2592000"/>
            </div>
        </ul>
        <div class="main-function ">
            <div >
                <button class="fb-buttonFill opa_active"><?php echo Sl('login2');?></button>
                <span><?php echo SL('no_stock_code');?></span>
            </div>
        </div>
    </form>
</div>
<div class="footer">
    <div class="w1200 fb-clearfix">
        <div class="footer_info fb-float-left ">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=4127bbdfe6fbeb8debafb1dca5a32284&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D37\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=37 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
            <?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
            <div class="footer_info_title"><?php echo $val[$GLOBALS['prefix']."title"];?></div>
            <?php echo $val[$GLOBALS['prefix']."content"];?>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
        <div class="mess_zone fb-float-right">
            <form action="<?php echo APP_PATH;?>index.php?m=guestbook&c=index&a=register&siteid=<?php echo $siteid;?>" >
                <div class="mess_title">
                    <div class="mess_name fb-float-left">
                        <input type="text" name="name" id="name" placeholder="<?php echo SL('leave_name');?>" onkeyup="value="/oblog/value.replace(/[^\u4E00-\u9FA5]/g,'')>
                    </div>
                    <div class="mess_phone fb-float-right">
                        <input type="text" name="phone" id="phone" placeholder="<?php echo SL('leave_phone');?>">
                    </div>
                </div>
                <div class="mess_con">
                    <textarea rows="6" name="content" id="content" placeholder="<?php echo SL('leave_content');?>"></textarea>
                </div>
                <div class="mess_button">
                    <input type="submit" value="<?php echo SL('leave_word');?>" class="opa_active">
                </div>
            </form>
        </div>

    </div>
    <div class="support fb-clearfix"><span>CopyRight ©广州世拓货运代理有限公司</span>   <span>粤ICP备17162719号</span>  <span>技术支持：<a href="http://www.feibu.info" style="">广州飞步信息科技有限公司</a ></span></div>
    <div class="fb-extra-power fb-transition">
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4e97a6b74a6464cf3adb9763418d58eb&action=category&catid=47&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'47','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        <div class="fb-extra-power-item ">
            <a target="_blank" href="<?php echo $r['url'];?>" class="fb-float-right">
                <?php echo  $r[$GLOBALS['prefix']."catname"] ?>
                <div class="fb-extra-power-item-qq fb-float-right"></div>
            </a>
        </div>
        <?php $n++;}unset($n); ?>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        <div class="fb-extra-power-item ">
            <a class="fb-float-right">
                <?php echo $CATEGORYS[50]['description'];?>
                <div class="fb-extra-power-item-phone fb-float-right"></div>
            </a>
        </div>
        <div class="fb-extra-power-item fb-goTop" onclick="$('body,html').animate({scrollTop:0})">
            <a class="fb-float-right">
                TOP
                <div class="fb-extra-power-item-top fb-float-right"></div>
            </a>
        </div>
    </div>

</div>
<script>
$fb(".mess_zone form").formValidator([
        {
            name:'name',
            rules:'required',
            display:'姓名不可为空'
        },
        {
            name:'phone',
            rules:'required',
            display:'联系方式不可为空'
        },
        {
            name:'content',
            rules:'required',
            minLength:15,
            mindisplay:'留言不可小于15个字符',
            display:'留言不可为空'
        },
    ],function(){
        $fb.loading({
            content:"正在留言..."
        })
        var name = $("#name").val();
		var content  = $("#content").val();
		var phone = $("#phone").val();
        var url = $(".mess_zone form").attr('action');
		$.post(url, 'name='+name+'&phone='+phone+'&content='+content+'&dosubmit=1', function(data){
            $fb.closeLoading();
            if(data.code == 1){
                $fb.fbNews({"type":"success","content":data.message});
            }else{
                $fb.fbNews({"type":"warning","content":data.message});
            }
        }, "json");
        return false;
    })
</script>
</body>
</html>
