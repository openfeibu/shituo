<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-lr-10">
    <div class="content-menu ib-a blue line-x">
        <a class="add fb" href="?m=waybill&c=waybill&a=add"><em>添加运单</em></a>
        <span>|</span>
        <a class="add fb" href="?m=waybill&c=waybill&a=export"><em>导出所有运单</em></a>

    </div>
    <form method="post" action="?m=waybill&c=waybill&a=import" enctype="multipart/form-data">
       导入excel表：<input type="file" name="file_stu"/>
       <input type="submit" value="导入"/>
    </form>
    <form name="myform" id="myform" action="?m=guestbook&c=guestbook&a=check_register" method="post" onsubmit="checkuid();return false;">
        <div class="table-list">
         <table width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('guestid[]');"></th>
                    <th align="center">运单单号</th>
                    <th align="center">入仓代码</th>
                    <th align="center">寄件日期</th>
                    <th align="center">物流方式</th>
                    <th width="12%" align="center"><?php echo L('operations_manage')?></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    if(is_array($infos)){
                    	foreach($infos as $info){
                    		?>
                        <tr>
                                <td align="center" width="35"><input type="checkbox" name="waybill_id[]" value="<?php echo $info['waybill_id']?>"></td>
                                <td align="center"><?php echo $info['number']?></td>
                                <td align="center"><?php echo $info['username'];?></td>
                                <td align="center"><?php echo date('Y-m-d H:i:s',$info['sendtime']);?></td>
                                <td align="center"><?php echo L($info['logistics_mode']);?></td>
                                <td align="center" width="12%"><a href="?m=waybill&c=waybill&a=edit_express&waybill_id=<?php echo $info['waybill_id'];?>" title="<?php echo L('edit')?>">编辑物流</a> | <a href="?m=waybill&c=waybill&a=edit&waybill_id=<?php echo $info['waybill_id'];?>" title="<?php echo L('edit')?>"><?php echo L('edit')?></a> | <a
                    			href='?m=waybill&c=waybill&a=delete&waybill_id=<?php echo $info['waybill_id']?>'
                    			onClick="return confirm('<?php echo L('confirm', array('message' => new_addslashes($info['number'])))?>')"><?php echo L('delete')?></a></td>
                              </tr>
                    	<?php
                    	}
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="btn"><a href="#"
        	onClick="javascript:$('input[type=checkbox]').attr('checked', true)"><?php echo L('selected_all')?></a>/<a
        	href="#"
        	onClick="javascript:$('input[type=checkbox]').attr('checked', false)"><?php echo L('cancel')?></a>
            <input name="submit" type="submit" class="button"
            	value="删除选中"
            	onClick="return confirm('<?php echo L('confirm', array('message' => L('selected')))?>')">&nbsp;&nbsp;</div>
            <div id="pages"><?php echo $pages?></div>
        </div>
    </form>
</div>
</body>
</html>
