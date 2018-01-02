<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
    <div class="main pdt">
        <div class="page_banner fb-position-relative" >
            <img class="fb-position-absolute" src="<?php echo $CATEGORYS['18']['image'];?>" alt="">
        </div>
        <div class="main_content">
            <div class="line_con fb-clearfix w1200">
                <div class="line_tab fb-float-left">
                    <?php include template("content","express_left"); ?>
                </div>
                <div class="line_search_content fb-float-right">
                    <div class="line_search">
                        <form action="index.php?m=content&c=index&a=cargo_tracking&catid=<?php echo $catid;?>" method="post">
                            <label for="" class="fb-inlineBlock"><?php echo SL('company');?></label>
                            <div class="search_form fb-inlineBlock">广州世拓</div>
                            <label for="" class="fb-inlineBlock"><?php echo SL('number');?></label>
                            <input type="text" name="search_num" class="search_num fb-inlineBlock">
                            <input type="submit" name="dosubmit" value="<?php echo SL('query');?>" class=" fb-inlineBlock opa_active">
                        </form>
                    </div>
                    <div class="line_search_text">
                            <?php if($waybill_data) { ?>
                            <div class="line_search_text_title"><?php echo SL('number');?>：<?php echo $waybill_data['number'];?></div>
                            <div class="line_search_text_resule fb-position-relative">
                                <?php if($logistics_data) { ?>
                                <?php $i=0;?>
                                <?php $n=1;if(is_array($logistics_data)) foreach($logistics_data AS $val) { ?>
                                <?php if($i ==0) { ?>
                                <div class="line_search_text_resule_item fb-position-relative first">
                                    <label><?php echo $val[$GLOBALS['prefix'].'content'];?></label></p>
                                    <span><?php echo date('Y-m-d H:i:s',$val[addtime]);?></span>
                                </div>
                                <?php } else { ?>
                                <div class="line_search_text_resule_item fb-position-relative">
                                    <p><?php echo $val[$GLOBALS['prefix'].'content'];?></p>
                                    <span><?php echo date('Y-m-d H:i:s',$val[addtime]);?></span>
                                </div>
                                <?php } ?>
                                <?php $i++?>
                                <?php $n++;}unset($n); ?>
                                <?php } ?>

                            </div>
                            <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include template("content","footer"); ?>
</body>
</html>
