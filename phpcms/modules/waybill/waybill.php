<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
class waybill extends admin {
	function __construct() {
		parent::__construct();
        $this->db = pc_base::load_model("waybill_model");
        $this->logistics_db = pc_base::load_model("logistics_model");
	}
    public function init() {
        $infos = $this->db->listinfo('',$order = 'waybill_id DESC',$page, $pages = '20');
        $pages = $this->db->pages;
		include $this->admin_tpl('index');
	}
    public function add()
    {
        if(isset($_REQUEST['dosubmit'])) {
            define('INDEX_HTML',true);
            $_POST['info']['sendtime'] = strtotime($_POST['info']['sendtime']);
            $this->db->insert($_POST['info']);
            $data = array(
                'code' => 1,
                'message' => '添加成功',
            );
            echo json_encode($data);exit;
        }
        include $this->admin_tpl('add');
    }
    public function edit()
    {
        if(isset($_REQUEST['dosubmit'])) {
            define('INDEX_HTML',true);
            $this->db->update($_POST['info'],array('waybill_id' => intval($_POST['waybill_id'])));
            $data = array(
                'code' => 1,
                'message' => '编辑成功',
            );
            echo json_encode($data);exit;
        }
        $waybill_id = intval($_GET['waybill_id']);
        $waybill_data = $this->db->get_one("waybill_id = '".$waybill_id."'");
        include $this->admin_tpl('edit');
    }
	public function delete()
	{
		if((!isset($_GET['waybill_id']) || empty($_GET['waybill_id'])) && (!isset($_POST['waybill_id']) || empty($_POST['waybill_id']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {

			if(is_array($_POST['waybill_id'])){
				foreach($_POST['waybill_id'] as $waybill_id_arr) {
					$this->db->delete(array('waybill_id'=>$waybill_id_arr));
					$this->logistics_db->delete(array('waybill_id'=>$waybill_id_arr));
				}
				showmessage(L('operation_success'),HTTP_REFERER);
			}else{
				$waybill_id = intval($_GET['waybill_id']);
				if($waybill_id < 1) return false;
				$result = $this->db->delete(array('waybill_id'=>$waybill_id));
				$this->logistics_db->delete(array('waybill_id'=>$waybill_id));
				if($result)
				{
					showmessage(L('operation_success'),HTTP_REFERER);
				}else {
					showmessage(L("operation_failure"),HTTP_REFERER);
				}
			}

			showmessage(L('operation_success'), HTTP_REFERER);
		}
	}
    public function add_express()
    {
        define('INDEX_HTML',true);
        $waybill_id = intval($_REQUEST['waybill_id']);
        $waybill_data = $this->db->get_one("waybill_id = '".$waybill_id."'");
        if(!$waybill_data)
        {
            $data = array(
                'code' => 2,
                'message' => '运单不存在',
            );
        }else{
            $info[$_POST['type']] = $_POST['content'];
            $info['waybill_id'] =  $waybill_data['waybill_id'];
            $info['addtime'] = time();
            $insert_id = $this->logistics_db->insert($info);
            $data = array(
                'code' => 1,
                'content' => $_POST['content'],
                'date' => date("Y-m-d H:i:s"),
            );
        }
        echo json_encode($data);
    }
    public function edit_express()
    {
		if($_REQUEST['dosubmit'])
		{
			define('INDEX_HTML',true);
			$info[$_POST['type']] = $_POST['content'];
			$result = $this->logistics_db->update($info,array('logistics_id' => intval($_POST['logistics_id'])));
			if($result)
			{
				$data = array(
					'code' => 1,
					'message' => '操作成功',
				);
			}else{
				$data = array(
					'code' => 2,
					'message' => '操作失败',
				);
			}
			echo json_encode($data);exit;
		}else{
	        $waybill_id = intval($_GET['waybill_id']);
	        $waybill_data = $this->db->get_one("waybill_id = '".$waybill_id."'");
	        $logistics_data = $this->logistics_db->select("waybill_id = '".$waybill_data['waybill_id']."'",'*','','logistics_id DESC');
	        include $this->admin_tpl('edit_express');
		}

    }
    public function import()
    {
        $file_path=$_FILES['file_stu']['tmp_name'];
        require PC_PATH.'libs/classes/PHPExcel.php';
        require PC_PATH.'libs/classes/PHPExcel/IOFactory.php';
        require PC_PATH.'libs/classes/PHPExcel/Reader/Excel2007.php';
        require PC_PATH.'libs/classes/PHPExcel/Reader/Excel5.php';

        move_uploaded_file($file_path, './tmp.xls');
        $data=format_excel2array('./tmp.xls');

        foreach ($data as $key => $value) {
            $info = array();
            if($key !=1)
            {
                $info['username'] = $value['A'];
                $info['number'] = $value['B'];
                $info['logistics_mode'] = $value['C'] == "空运" ? "air_transportation" : "sea_transportation";
                $info['sendtime'] = strtotime($value['D']);
                $info['sender'] = $value['E'];
                $info['sender_mobile'] = $value['F'];
                $info['sender_address'] = $value['G'];
                $info['sender_info'] = $value['H'];
                $info['addressee'] = $value['I'];
                $info['addressee_mobile'] = $value['J'];
                $info['addressee_address'] = $value['K'];
                $info['goods_freight'] = $value['L'];
                $info['goods_type'] = $value['M'];
                $info['goods_name'] = $value['N'];
                $info['goods_number'] = $value['O'];
                $info['goods_price'] = $value['P'];
                $info['goods_insured'] = $value['Q'];
                $info['goods_weight'] = $value['R'];
                $info['goods_volume'] = $value['S'];
            }
            $this->db->insert($info);
        }
        showmessage(L('operation_success'),HTTP_REFERER);
    }
    public function export()
    {
        require PC_PATH.'libs/classes/PHPExcel.php';
        require PC_PATH.'libs/classes/PHPExcel/Writer/Excel5.php';
        require PC_PATH.'libs/classes/PHPExcel/Writer/Excel2007.php';
        require PC_PATH.'libs/classes/PHPExcel/IOFactory.php';

        $result=$this->db->select('','*');
        //var_dump($result);die;
        //创建一个excel对象
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("ctos")
                ->setLastModifiedBy("ctos")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");

        //set width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
/*
        //设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //set font size bold
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //设置水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //
        $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
*/
        // set table header content
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '入仓代码')
                ->setCellValue('B1', '运单单号')
                ->setCellValue('C1', '物流方式')
                ->setCellValue('D1', '寄件日期')
                ->setCellValue('E1', '寄件人')
                ->setCellValue('F1', '联系号码')
                ->setCellValue('G1', '寄件地址')
                ->setCellValue('H1', '备注信息')
                ->setCellValue('I1', '收件人')
                ->setCellValue('J1', '联系号码')
                ->setCellValue('K1', '收件地址')
                ->setCellValue('L1', '运    费')
                ->setCellValue('M1', '物品类别')
                ->setCellValue('N1', '物品名称')
                ->setCellValue('O1', '物品件数')
                ->setCellValue('P1', '物品价值')
                ->setCellValue('Q1', '保  价  费')
                ->setCellValue('R1', '物品重量')
                ->setCellValue('S1', '体积重量');

        // Miscellaneous glyphs, UTF-8

        for ($i =0; $i < count($result); $i++) {
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 2), $result[$i]['username']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 2), $result[$i]['number']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 2), L($result[$i]['logistics_mode']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 2), date("Y-m-d",$result[$i]['sendtime']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 2), $result[$i]['sender']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 2), $result[$i]['sender_mobile']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 2), $result[$i]['sender_address']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 2), $result[$i]['sender_info']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 2), $result[$i]['addressee']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 2), $result[$i]['addressee_mobile']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('K' . ($i + 2), $result[$i]['addressee_address']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('L' . ($i + 2), $result[$i]['goods_freight']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('M' . ($i + 2), $result[$i]['goods_type']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('N' . ($i + 2), $result[$i]['goods_name']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('O' . ($i + 2), $result[$i]['goods_number']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('P' . ($i + 2), $result[$i]['goods_price']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('Q' . ($i + 2), $result[$i]['goods_insured']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('R' . ($i + 2), $result[$i]['goods_weight']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('S' . ($i + 2), $result[$i]['goods_volume']);
        }


        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('运单数据');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel5)
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="运单数据(' . date('Ymd-His') . ').xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}
