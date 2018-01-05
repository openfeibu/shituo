<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
include $this->admin_tpl('header_new', 'admin');
?>

    <div class="main">
        <div class="logInfo">
            <div class="logInfo_title">
                更新物流信息-中文
            </div>
            <div class="logInfo_list">
                <div class="logInfo_list_title">
                    <span>入仓代码：<?php echo $waybill_data['username']?></span>      <span>订单编号号：<?php echo $waybill_data['number']?></span>
                </div>
                <div class="logInfo_list_add">
                    <form action="">
                        <input type="hidden" name="type" value="content"/>
                        <input type="text" placeholder="请填写最新物流信息" name="logInfo_txt"/>
                        <input type="submit" value="添加最新信息">
                    </form>
                </div>
                 <div class="line_search_text">
                    <div class="line_search_text_resule fb-position-relative">
                        <?php
                        $i = 0;
                        foreach($logistics_data as $key => $val)
                        {
                            if($val['content']){
                        ?>

                            <div class="line_search_text_resule_item line_search_text_resule_item_1 fb-position-relative <?php if($i ==0){echo "first"; }?> ">
                                <p><label><b><?php echo $val['content']?></b></label><span><?php echo date("Y-m-d H:i:s",$val['addtime'])?></span><a data-id="<?php echo $val['logistics_id'];?>" data-type="content">修改信息</a></p>
                            </div>

                        <?php
                            $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
             <div class="logInfo_title">
                更新物流信息-英文
            </div>
            <div class="logInfo_list">
                <div class="logInfo_list_title">
                    <span>入仓代码：<?php echo $waybill_data['username']?></span>      <span>订单编号号：<?php echo $waybill_data['number']?></span>
                </div>
                <div class="logInfo_list_add">
                    <form action="">
                        <input type="hidden" name="type" value="en_content"/>
                        <input type="text" placeholder="请填写最新物流信息" name="logInfo_txt"/>
                        <input type="submit" value="添加最新信息">
                    </form>
                </div>
                 <div class="line_search_text">
                    <div class="line_search_text_resule fb-position-relative">
                        <?php
                        $i = 0;
                        foreach($logistics_data as $key => $val)
                        {
                            if($val['en_content']){
                        ?>
                            <div class="line_search_text_resule_item line_search_text_resule_item_1 fb-position-relative <?php if($i ==0){echo "first"; }?> ">
                                <p><label><b><?php echo $val['en_content']?></b></label><span><?php echo date("Y-m-d H:i:s",$val['addtime'])?></span><a data-id="<?php echo $val['logistics_id'];?>" data-type="en_content">修改信息</a></p>
                            </div>
                        <?php
                            $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
             <div class="logInfo_title">
                更新物流信息-阿拉伯语
            </div>
            <div class="logInfo_list">
                <div class="logInfo_list_title">
                    <span>入仓代码：<?php echo $waybill_data['username']?></span>      <span>订单编号号：<?php echo $waybill_data['number']?></span>
                </div>
                <div class="logInfo_list_add">
                    <form action="">
                        <input type="hidden" name="type" value="arab_content"/>
                        <input type="text" placeholder="请填写最新物流信息" name="logInfo_txt" style="direction: rtl !important;"/>
                        <input type="submit" value="添加最新信息">
                    </form>
                </div>
                 <div class="line_search_text">
                    <div class="line_search_text_resule fb-position-relative line_search_text_resule_alb">
                        <?php
                        $i = 0;
                        foreach($logistics_data as $key => $val)
                        {
                            if($val['arab_content']){
                        ?>
                            <div class="line_search_text_resule_item line_search_text_resule_item_2 fb-position-relative <?php if($i ==0){echo "first"; }?> ">
                                <p><label><b><?php echo $val['arab_content']?></b></label><span><?php echo date("Y-m-d H:i:s",$val['addtime'])?></span><a data-id="<?php echo $val['logistics_id'];?>" data-type="arab_content">修改信息</a></p>
                            </div>
                        <?php
                            $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
$(function(){
    $fb(".logInfo_list_add form").formValidator([
            {
                name:'logInfo_txt',
                rules:'required',
                display:'物流信息不可为空'
            }
        ],function($el){
            console.log($el)
            $fb.loading({
                content:"正在上传..."
            })
            var url = "?m=waybill&c=waybill&a=add_express&waybill_id=<?php echo $waybill_id;?>&osubmit=1&pc_hash="+pc_hash;
            var val = $el.find("[name='logInfo_txt']").val();
            var type = $el.find("[name='type']").val();
            $.post(url, {'type':type,'content':val}, function(data){
                $fb.closeLoading();
                $fb.fbNews({"type":"success","content":'上传成功'});
                if(data.code == 1){
                    $el.parents(".logInfo_list").find(".line_search_text_resule .first").removeClass("first")
                    $el.parents(".logInfo_list").find(".line_search_text_resule").prepend('<div class="line_search_text_resule_item fb-position-relative first"><p><label><b>'+data.content+'</b></label><span>'+data.date+'</span></p></div>')
                }else{
                    $fb.fbNews({"type":"warning","content":data.message});
                }
            }, "json");
            return false;
        })
    $(".line_search_text_resule_item_1 a").on("click",function(){
            var that = $(this);
            $fb.showModal({
                title : '修改物流信息',//提示的标题
                textBox:'textarea', //input：为input；textarea：为textarea
                value:that.parents(".line_search_text_resule_item").find('b').text(),//文本框提示
            },function(val){
                var url = "?m=waybill&c=waybill&a=edit_express&dosubmit=1waybill_id=<?php echo $waybill_id;?>&osubmit=1&pc_hash="+pc_hash;
                var logistics_id = that.attr("data-id");
                var type = that.attr("data-type");
                console.log(that.attr("data-id"));
                $fb.loading();
                $.post(url, {'logistics_id':logistics_id,'type':type,'content':val}, function(data){
                    $fb.closeLoading();
                    if(data.code == 1){
                        that.parents(".line_search_text_resule_item").find('b').text(val)
                    }else{
                        $fb.fbNews({"type":"warning","content":data.message});
                    }
                }, "json");
            })
        })
    $(".line_search_text_resule_item_2 a").on("click",function(){
            var that = $(this);
            $fb.showModal({
                title : '修改物流信息',//提示的标题
                textBox:'textarea', //input：为input；textarea：为textarea
                value:that.parents(".line_search_text_resule_item").find('b').text(),//文本框提示
                class:'ltr'
            },function(val){
                $fb.loading({time:1000});
                that.parents(".line_search_text_resule_item").find('b').text(val)
            })
        })
})
</script>
</html>
