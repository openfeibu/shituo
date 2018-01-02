<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="main pdt">
    <div class="page_banner fb-position-relative" >
        <img class="fb-position-absolute" src="<?php echo CSS_PATH;?>shituo/images/person_banner.png" alt="">
    </div>
    <div class="main_content">
        <div class="person_con ">
            <div class="person_head">
                <div class="img"><img src="<?php echo CSS_PATH;?>shituo/images/person.png" alt=""></div>
                <div class="name"><?php echo $memberinfo['nickname'];?></div>
            </div>
            <div class="person_info">
                <div class="person_info_title">账号信息</div>
                <div class="person_info_item fb-clearfix">
                    <label>账号</label>
                    <span><?php echo $_username;?></span>
                </div>
                <div class="person_info_item fb-clearfix">
                    <label>昵称</label>
                    <span><?php echo $memberinfo['nickname'];?></span>
                    <div class="update update_name">修改</div>

                </div>
                <div class="person_info_item fb-clearfix">
                    <label>密码</label>
                    <span>建议您经常修改密码，以保证帐号更加安全。</span>
                    <div class="update update_pass">修改</div>
                </div>
            </div>
            <div class="myDelivery">
                <div class="myDelivery_title">我的快件</div>
                <div class="myDelivery_con fb-clearfix">
                    <?php if($waybill_data) { ?>
                    <?php $n=1;if(is_array($waybill_data)) foreach($waybill_data AS $val) { ?>
                    <div class="myDelivery_item fb-float-left fb-transition">
                        <a href="">
                            <div class="n_title">运单号：<?php echo $val['number'];?></div>
                            <div class="n_con fb-overflow-2">最新：<?php echo $val['logistics_data'][$GLOBALS['prefix'].'content'];?></div>
                            <div class="n_date"><?php echo date('Y-m-d H:i:s',$val['logistics_data'][addtime]);?></div>
                        </a>
                    </div>
                    <?php $n++;}unset($n); ?>
                    <?php } else { ?>
                    <div class="nomyDelivery_item">您还没有快件记录</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include template("content","footer"); ?>
<script>
    $(function(){

        $(".update_name").on("click",function(){
            var that = $(this);
            $fb.showModal({
                title : '修改昵称',//提示的标题
                textBox:'input', //input：为input；textarea：为textarea
                placeholder:that.prev("span").text()//文本框提示
            },function(val){
                $fb.loading();
                var nickname  = val;
        		$.post('index.php?m=member&c=ajax&a=account_manage_info', 'nickname='+nickname, function(data){
                    $fb.closeLoading();
                    if(data.code == 1){
                        that.prev("span").text(val)
    					$fb.fbNews({"type":"success","content":data.message});
                    }
                    else{
                        $fb.fbNews({"type":"warning","content":data.message});
                    }
                }, "json");
                return false;
            })
        })
        $(".update_pass").on("click",function(){
            var that = $(this);
            $fb.showModal({
                name :'newpassword',
                title : '修改密码',//提示的标题
                textBox:'input', //input：为input；textarea：为textarea
                placeholder:'********'//文本框提示
            },function(val){
                $fb.loading();
                var newpassword  = val;
        		$.post('index.php?m=member&c=ajax&a=account_manage_password', 'newpassword='+newpassword, function(data){
                    $fb.closeLoading();
                    if(data.code == 1){
    					$fb.fbNews({"type":"success","content":data.message});
                    }
                    else{
                        $fb.fbNews({"type":"warning","content":data.message});
                    }

                }, "json");
                return false;
            })
        })
    })
</script>
</body>
</html>
