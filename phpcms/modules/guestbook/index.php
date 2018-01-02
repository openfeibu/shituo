<?php
defined('IN_PHPCMS') or exit('No permission resources.');
class index {
	function __construct() {
		pc_base::load_app_func('global');
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
  		define("SITEID",$siteid);
		if(isset($_GET['lang']) && in_array($_GET['lang'],array('zh-cn','en','arab')))
		{
			$GLOBALS['lang'] = $_GET['lang'];
		}else{
			$GLOBALS['lang'] = param::get_cookie("lang");
			if(!$GLOBALS['lang'])
			{
				$GLOBALS['lang'] = 'zh-cn';
			}
		}
		$GLOBALS['prefix'] = $GLOBALS['lang'] == 'zh-cn' ?  '' : $GLOBALS['lang'] . '_';
		param::set_cookie("lang",$GLOBALS['lang'],0);
		$lang = $GLOBALS['lang'];
	}

	public function init() {
		$siteid = SITEID;
 		$setting = getcache('guestbook', 'commons');
		$SEO = seo(SITEID, '', L('guestbook'), '', '');
		include template('guestbook', 'index');
	}

	 /**
	 *	留言板列表页
	 */
	public function list_type() {
		$siteid = SITEID;
  		$type_id = trim(urldecode($_GET['type_id']));
		$type_id = intval($type_id);
  		if($type_id==""){
 			$type_id ='0';
 		}
   		$setting = getcache('guestbook', 'commons');
		$SEO = seo(SITEID, '', L('guestbook'), '', '');
  		include template('guestbook', 'list_type');
	}

	 /**
	 *	留言板留言
	 */
	public function register() {
 		$siteid = SITEID;
 		if(isset($_POST['dosubmit'])){

 			if($_POST['name']==""){
 				$data = array(
					'code' => 2,
					'message' => SL('name_not_empty')
				);
 			}
			if($_POST['phone']==""){
				$data = array(
					'code' => 2,
					'message' => SL('phone_not_empty')
				);
 			}
 			$guestbook_db = pc_base::load_model(guestbook_model);

			 /*添加用户数据*/
 			$sql = array('siteid'=>$siteid,'typeid'=>$_POST['typeid'],'name'=>$_POST['name'],'sex'=>$_POST['sex'],'lxqq'=>$_POST['lxqq'],'email'=>$_POST['email'],'phone'=>$_POST['phone'],'content'=>$_POST['content'],'addtime'=>time());

 			$guestbook_db->insert($sql);

			$data = array (
				'code' => 1,
				'message' => SL('success')
			);
 			echo json_encode($data);exit;
 		}else {
  			$setting = getcache('guestbook', 'commons');
 			if($setting[$siteid]['is_post']=='0'){
 				showmessage(L('suspend_application'), HTTP_REFERER);
 			}
 			$this->type = pc_base::load_model('type_model');
 			$types = $this->type->get_types($siteid);//获取站点下所有留言板分类
 			pc_base::load_sys_class('form', '', 0);
 			$setting = getcache('guestbook', 'commons');
 			$SEO = seo(SITEID, '', L('application_guestbook'), '', '');
   			include template('guestbook', 'register');
 		}
	}

}
?>
