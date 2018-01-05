<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
include $this->admin_tpl('header_new', 'admin');
?>


<div class="pad-lr-10">
    <div class="main">
        <div class="logInfo">
            <form action="?m=waybill&c=waybill&a=edit" method="post">
                <input type="hidden" name="waybill_id" value="<?php echo $waybill_id;?>"/>
                <div class="logInfo_title">
                    基本信息
                </div>
                <div class="logInfo_con">
                    <div class="logInfo_item">
                        <label for="">入仓代码<i>*</i></label>
                        <input type="text" name="info[username]" value="<?php echo $waybill_data[username] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">订单编号<i>*</i></label>
                        <input type="text" name="info[number]" value="<?php echo $waybill_data[number] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">寄件日期<i>*</i></label>
                        <input type="text" id="checkDate" name="info[sendtime]" value="<?php echo date('Y-m-d',$waybill_data[sendtime]) ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">物流方式<i>*</i></label>
                        <div class="raido_box">
                            <input type="radio" class="fb-inlineBlock" name="info[logistics_mode]" value="air_transportation" <?php if($waybill_data[logistics_mode] == 'air_transportation'){echo "checked";} ?> />
                            <span>空运</span>
                            <input type="radio" class="fb-inlineBlock" name="info[logistics_mode]" value="sea_transportation" <?php if($waybill_data[logistics_mode] == 'sea_transportation'){echo "checked";} ?>/>
                            <span>海运</span>
                        </div>
                    </div>
                </div>
                <div class="logInfo_title">
                    寄件人信息
                </div>
                <div class="logInfo_con">
                    <div class="logInfo_item">
                        <label for="">寄件人<i>*</i></label>
                        <input type="text" name="info[sender]" value="<?php echo $waybill_data[sender] ?>">
                    </div>
                    <div class="logInfo_item"><i>*</i>
                        <label for="">联系号码</label>
                        <input type="text" name="info[sender_mobile]" value="<?php echo $waybill_data[sender_mobile] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">寄件地址<i>*</i></label>
                        <textarea name="info[sender_address]" ><?php echo $waybill_data[sender_address] ?></textarea>
                    </div>
                    <div class="logInfo_item">
                        <label for="">备注信息</label>
                        <textarea name="info[sender_info]" ><?php echo $waybill_data[sender_info] ?></textarea>
                    </div>
                </div>
                <div class="logInfo_title">
                    收件人信息
                </div>
                <div class="logInfo_con">
                    <div class="logInfo_item">
                        <label for="">收件人<i>*</i></label>
                        <input type="text" name="info[addressee]" value="<?php echo $waybill_data[addressee] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">联系号码<i>*</i></label>
                        <input type="text" name="info[addressee_mobile]" value="<?php echo $waybill_data[addressee_mobile] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">收件地址<i>*</i></label>
                        <textarea name="info[addressee_address]" ><?php echo $waybill_data[addressee_address] ?></textarea>
                    </div>
                </div>
                <div class="logInfo_title">
                    物品信息
                </div>
                <div class="logInfo_con">
                    <div class="logInfo_item">
                        <label for="">运    费<i>*</i></label>
                        <input type="text" name="info[goods_freight]"  value="<?php echo $waybill_data[goods_freight] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">物品类别<i>*</i></label>
                        <input type="text" name="info[goods_type]" value="<?php echo $waybill_data[goods_type] ?>" >
                    </div>
                    <div class="logInfo_item">
                        <label for="">物品名称<i>*</i></label>
                        <input type="text" name="info[goods_name]" value="<?php echo $waybill_data[goods_name] ?>" >
                    </div>
                    <div class="logInfo_item">
                        <label for="">物品件数<i>*</i></label>
                        <input type="text" name="info[goods_number]" value="<?php echo $waybill_data[goods_number] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">物品价值</label>
                        <input type="text" name="info[goods_price]" value="<?php echo $waybill_data[goods_price] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">保  价  费</label>
                        <input type="text" name="info[goods_insured]" value="<?php echo $waybill_data[goods_insured] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">物品重量</label>
                        <input type="text" name="info[goods_weight]" value="<?php echo $waybill_data[goods_weight] ?>">
                    </div>
                    <div class="logInfo_item">
                        <label for="">体积重量</label>
                        <input type="text" name="info[goods_volume]" value="<?php echo $waybill_data[goods_volume] ?>">
                    </div>
                    <div class="logInfo_item logInfo_item_fixed fb-position-fixed" >
                        <input type="submit" name="dosubmit" value="保存">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
   $fb('#checkDate').showDate({
        dateControl:true, //年
        monthControl:true, //月
        dayControl:true,//日
        timeControl:false, //时
        minuteControl:false,//分
        secondsControl:false,//秒
   })
   $fb(".logInfo form").formValidator([
            {
                name:'info[username]',
                rules:'required',
                display:'入仓代码不可为空'
            },
            {
                name:'info[number]',
                rules:'required',
                display:'订单编号不可为空'
            },
            {
                name:'info[sendtime]',
                rules:'required',
                display:'寄件日期不可为空'
            },
            {
                name:'info[logistics_mode]',
                rules:'required',
                display:'物流方式不可为空'
            },
            {
                name:'info[sender]',
                rules:'required',
                display:'寄件人不可为空'
            },
            {
                name:'info[sender_mobile]',
                rules:'required',
                display:'寄件人联系号码不可为空'
            },
            {
                name:'info[sender_address]',
                rules:'required',
                display:'寄件人地址不可为空'
            },
            {
                name:'info[addressee]',
                rules:'required',
                display:'收件人不可为空'
            },
            {
                name:'info[addressee_mobile]',
                rules:'required',
                display:'收件人联系号码不可为空'
            },
            {
                name:'info[addressee_address]',
                rules:'required',
                display:'收件地址不可为空'
            },
            {
                name:'info[goods_freight]',
                rules:'required',
                display:'运费不可为空'
            },
            {
                name:'info[goods_type]',
                rules:'required',
                display:'物品类型不可为空'
            },
            {
                name:'info[goods_name]',
                rules:'required',
                display:'物品名称不可为空'
            },
            {
                name:'info[goods_number]',
                rules:'required',
                display:'物品件数不可为空'
            },


        ],function($el){
            $fb.loading();
            var data = $("form").serialize();
            var url = "?m=waybill&c=waybill&a=edit&dosubmit=1"+pc_hash;
            $.post(url, data, function(data){
                $fb.closeLoading();
                if(data.code == 1){
                    $fb.fbNews({"type":"success","content":data.message});
                    $(".mess_zone form")[0].reset();
                }else{
                    $fb.fbNews({"type":"warning","content":data.message});
                }
            }, "json");
            return false;
         })
</script>
</body>
</html>
