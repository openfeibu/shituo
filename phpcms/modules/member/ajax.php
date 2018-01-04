<?php
/**
* ajax
*/

defined('IN_PHPCMS') or exit('No permission resources.');
//pc_base::load_app_class('foreground_new');
pc_base::load_sys_class('format', '', 0);
pc_base::load_sys_class('form', '', 0);

class ajax
{
    private $times_db;

    public function __construct()
    {

        $this->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->db = pc_base::load_model('member_model');
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

    public function login() {

        $this->_session_start();
        //获取用户siteid
        $siteid = isset($_REQUEST['siteid']) && trim($_REQUEST['siteid']) ? intval($_REQUEST['siteid']) : 1;
        //定义站点id常量
        if (!defined('SITEID')) {
            define('SITEID', $siteid);
        }
        if (isset($_POST['dosubmit'])) {
            $username = isset($_POST['username']) && trim(iconv("UTF-8", "gb2312", $_POST['username'])) ? trim(iconv("UTF-8", "gb2312", $_POST['username'])) : exit('0');
            $password = isset($_POST['password']) && trim($_POST['password']) ? trim($_POST['password']) : exit('0');
            $cookietime = intval($_POST['cookietime']);
            $synloginstr = ''; //同步登陆js代码

            if (pc_base::load_config('system', 'phpsso')) {
                $this->_init_phpsso();
                $status = $this->client->ps_member_login($username, $password);
                $memberinfo = unserialize($status);

                if (isset($memberinfo['uid'])) {
                    //查询帐号
                    $r = $this->db->get_one(array('phpssouid'=>$memberinfo['uid']));
                    if (!$r) {
                        //插入会员详细信息，会员不存在 插入会员
                        $info = array(
                            'phpssouid'=>$memberinfo['uid'],
                            'username'=>$memberinfo['username'],
                            'password'=>$memberinfo['password'],
                            'encrypt'=>$memberinfo['random'],
                            'email'=>$memberinfo['email'],
                            'regip'=>$memberinfo['regip'],
                            'regdate'=>$memberinfo['regdate'],
                            'lastip'=>$memberinfo['lastip'],
                            'lastdate'=>$memberinfo['lastdate'],
                            'groupid'=>$this->_get_usergroup_bypoint(),        //会员默认组
                            'modelid'=>10,        //普通会员
                        );

                        //如果是connect用户
                        if (!empty($_SESSION['connectid'])) {
                            $userinfo['connectid'] = $_SESSION['connectid'];
                        }
                        if (!empty($_SESSION['from'])) {
                            $userinfo['from'] = $_SESSION['from'];
                        }
                        unset($_SESSION['connectid'], $_SESSION['from']);

                        $this->db->insert($info);
                        unset($info);
                        $r = $this->db->get_one(array('phpssouid'=>$memberinfo['uid']));
                    }
                    $password = $r['password'];
                    $synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
                } else {
                    if ($status == -1) {
                        echo json_encode(-1);
                        exit;
                    } elseif ($status == -2) {
                        echo json_encode(-2);
                        exit;
                    } else {
                        echo json_encode(-3);
                        exit;
                    }
                }
            } else {
                //密码错误剩余重试次数
                $this->times_db = pc_base::load_model('times_model');
                $rtime = $this->times_db->get_one(array('username'=>$username));
                if ($rtime['times'] > 4) {
                    $minute = 60 - floor((SYS_TIME - $rtime['logintime']) / 60);
                    echo json_encode(-4);
                    exit;
                }

                //查询帐号
                $r = $this->db->get_one(array('username'=>$username));

                if (!$r) {
                    echo json_encode(-1);
                    exit;
                }

                //验证用户密码
                $password = md5(md5(trim($password)).$r['encrypt']);
                if ($r['password'] != $password) {
                    $ip = ip();
                    if ($rtime && $rtime['times'] < 5) {
                        $times = 5 - intval($rtime['times']);
                        $this->times_db->update(array('ip'=>$ip, 'times'=>'+=1'), array('username'=>$username));
                    } else {
                        $this->times_db->insert(array('username'=>$username, 'ip'=>$ip, 'logintime'=>SYS_TIME, 'times'=>1));
                        $times = 5;
                    }
                    echo json_encode(-2);
                    exit;
                }
                $this->times_db->delete(array('username'=>$username));
            }

            //如果用户被锁定
            if ($r['islock']) {
                echo json_encode(2);
                exit;
            }

            $userid = $r['userid'];
            $groupid = $r['groupid'];
            $username = $r['username'];
            $nickname = empty($r['nickname']) ? $username : $r['nickname'];

            $updatearr = array('lastip'=>ip(), 'lastdate'=>SYS_TIME);
            //vip过期，更新vip和会员组
            if ($r['overduedate'] < SYS_TIME) {
                $updatearr['vip'] = 0;
            }

            //检查用户积分，更新新用户组，除去邮箱认证、禁止访问、游客组用户、vip用户，如果该用户组不允许自助升级则不进行该操作
            if ($r['point'] >= 0 && !in_array($r['groupid'], array('1', '7', '8')) && empty($r[vip])) {
                $grouplist = getcache('grouplist');
                if (!empty($grouplist[$r['groupid']]['allowupgrade'])) {
                    $check_groupid = $this->_get_usergroup_bypoint($r['point']);

                    if ($check_groupid != $r['groupid']) {
                        $updatearr['groupid'] = $groupid = $check_groupid;
                    }
                }
            }

            //如果是connect用户
            if (!empty($_SESSION['connectid'])) {
                $updatearr['connectid'] = $_SESSION['connectid'];
            }
            if (!empty($_SESSION['from'])) {
                $updatearr['from'] = $_SESSION['from'];
            }
            unset($_SESSION['connectid'], $_SESSION['from']);

            $this->db->update($updatearr, array('userid'=>$userid));

            if (!isset($cookietime)) {
                $get_cookietime = param::get_cookie('cookietime');
            }
            $_cookietime = $cookietime ? intval($cookietime) : ($get_cookietime ? $get_cookietime : 0);
            $cookietime = $_cookietime ? SYS_TIME + $_cookietime : 0;

            $phpcms_auth = sys_auth($userid."\t".$password, 'ENCODE', get_auth_key('login'));

            param::set_cookie('auth', $phpcms_auth, $cookietime);
            param::set_cookie('_userid', $userid, $cookietime);
            param::set_cookie('_username', $username, $cookietime);
            param::set_cookie('_groupid', $groupid, $cookietime);
            param::set_cookie('_nickname', $nickname, $cookietime);
            param::set_cookie('_area', $member_modelinfo_arr['area'], $cookietime);
            param::set_cookie('_chexi', $member_modelinfo_arr['chexi'], $cookietime);
            //param::set_cookie('cookietime', $cookietime, $cookietime);
            $arr['success'] = 1;
            $arr['userid'] = $userid;
            $arr['username'] = iconv("gb2312", "UTF-8", $username);
            $arr['area'] = $member_modelinfo_arr['area'];
            $arr['chexi'] = $member_modelinfo_arr['chexi'];
            $arr['nickname'] =iconv("gb2312", "UTF-8", $nickname);
            $arr['msg'] = iconv("gb2312", "UTF-8", $restr);//urlencode($synloginstr);
            $arr['html'] = '<div class="accout_img opa_active" style="display:block;"><a href= "'.APP_PATH.'index.php?m=content&c=index&a=member_center&siteid='.$siteid.'"><img src="'.CSS_PATH.'shituo/images/person.png" alt=""/></a></div>';
            echo json_encode($arr);
        } else {
            if (param::get_cookie('_userid')) {
                $arr['success'] = 1;
                $arr['userid'] = param::get_cookie('_userid');
                $arr['username'] = iconv("gb2312", "UTF-8", param::get_cookie('_username'));
                $arr['area'] = param::get_cookie('_area');
                $arr['chexi'] = param::get_cookie('_chexi');
                $arr['nickname'] =iconv("gb2312", "UTF-8", param::get_cookie('_nickname'));
            } else {
                $arr['success'] = 0;
            }
            echo json_encode($arr);
        }
    }

    public function logout()
    {
        $setting = pc_base::load_config('system');
        //snda退出
        if ($setting['snda_enable'] && param::get_cookie('_from')=='snda') {
            param::set_cookie('_from', '');
            $forward = isset($_GET['forward']) && trim($_GET['forward']) ? urlencode($_GET['forward']) : '';
            $logouturl = 'https://cas.sdo.com/cas/logout?url='.urlencode(APP_PATH.'index.php?m=member&c=index&a=logout&forward='.$forward);
            header('Location: '.$logouturl);
        } else {
            $synlogoutstr = '';        //同步退出js代码
            if (pc_base::load_config('system', 'phpsso')) {
                $this->_init_phpsso();
                $synlogoutstr = $this->client->ps_member_synlogout();
            }
            param::set_cookie('auth', '');
            param::set_cookie('_userid', '');
            param::set_cookie('_username', '');
            param::set_cookie('_groupid', '');
            param::set_cookie('_nickname', '');
            param::set_cookie('cookietime', '');
            param::set_cookie('_area', '');
            param::set_cookie('_chexi', '');
            $restrstar = '<script type="text/javascript" src="';
            $restrend = '" reload="1"></script>';
            $restr = '';
            $pattern = '/src="(.*?)"/';
            preg_match_all($pattern, $synlogoutstr, $result);
            foreach ($result[1] as $r) {
                $synurl = @file_get_contents($r); //读取链接
                                if (preg_match('/src=/', $synurl)) {//检查链接是否含有连接，如果有 打开
                                                $synurl = str_replace('&quot;', '"', $synurl);
                                    $synurl = str_replace('\\', '', $synurl);
                                    preg_match_all($pattern, $synurl, $result2);
                                    foreach ($result2[1] as $v) {
                                        $restr .= $restrstar.$v.$restrend;
                                    }
                                } else {
                                    $restr .= $restrstar.$r.$restrend;//没有的话 使用当前连接
                                }
            }
            $arr['success'] = 1;
            $arr['msg'] = iconv("gb2312", "UTF-8", $restr);
            echo json_encode($arr);
        }
    }



    /**
     * 初始化phpsso
     * about phpsso, include client and client configure
     * @return string phpsso_api_url phpsso地址
     */
    private function _init_phpsso()
    {
        pc_base::load_app_class('client', '', 0);
        define('APPID', pc_base::load_config('system', 'phpsso_appid'));
        $phpsso_api_url = pc_base::load_config('system', 'phpsso_api_url');
        $phpsso_auth_key = pc_base::load_config('system', 'phpsso_auth_key');
        $this->client = new client($phpsso_api_url, $phpsso_auth_key);
        return $phpsso_api_url;
    }



    private function _session_start()
    {
        $session_storage = 'session_'.pc_base::load_config('system', 'session_storage');
        pc_base::load_sys_class($session_storage);
    }


    /**
     *根据积分算出用户组
     * @param $point int 积分数
     */
    protected function _get_usergroup_bypoint($point=0)
    {
        $groupid = 2;
        if (empty($point)) {
            $member_setting = getcache('member_setting');
            $point = $member_setting['defualtpoint'] ? $member_setting['defualtpoint'] : 0;
        }
        $grouplist = getcache('grouplist');

        foreach ($grouplist as $k=>$v) {
            $grouppointlist[$k] = $v['point'];
        }
        arsort($grouppointlist);

        //如果超出用户组积分设置则为积分最高的用户组
        if ($point > max($grouppointlist)) {
            $groupid = key($grouppointlist);
        } else {
            foreach ($grouppointlist as $k=>$v) {
                if ($point >= $v) {
                    $groupid = $tmp_k;
                    break;
                }
                $tmp_k = $k;
            }
        }
        return $groupid;
    }
    public function checklogin()
    {
        $callback = $_GET['jsoncallback'];//这东西是为了解决跨域问题的
        $_groupid = param::get_cookie('_groupid');
        $_groupid = intval($_groupid);
        if (!$_groupid) {
            echo $callback.'(0)';
        } else {
            echo $callback.'(1)';
        }
    }
    public function account_manage_password() {
		$updateinfo = array();
		if(!is_password($_POST['newpassword']) || is_badword($_POST['newpassword'])) {
			$data = array(
                'code' => 2,
                'message' => L('password_format_incorrect')
            );
            echo json_encode($data);exit;
		}
		$newpassword = password($_POST['newpassword'], $this->memberinfo['encrypt']);
		$updateinfo['password'] = $newpassword;

		$this->db->update($updateinfo, array('userid'=>$this->memberinfo['userid']));
		if(pc_base::load_config('system', 'phpsso')) {
			//初始化phpsso
			$this->_init_phpsso();
			$res = $this->client->ps_member_edit('', $email, $_POST['info']['password'], $_POST['info']['newpassword'], $this->memberinfo['phpssouid'], $this->memberinfo['encrypt']);
			$message_error = array('-1'=>L('user_not_exist'), '-2'=>L('old_password_incorrect'), '-3'=>L('email_already_exist'), '-4'=>L('email_error'), '-5'=>L('param_error'));
			if ($res < 0)
            {
                $data = array(
                    'code' => 2,
                    'message' => $message_error[$res]
                );
                echo json_encode($data);exit;
            }
		}

        $data = array(
            'code' => 1,
            'message' => L('operation_success')
        );
        echo json_encode($data);exit;
	}
    public function account_manage_info() {
		//更新用户昵称
        pc_base::load_app_class('foreground','member');
        $foreground = new foreground();
		$this->memberinfo = $foreground->memberinfo;
		$nickname = isset($_POST['nickname']) && is_username(trim($_POST['nickname'])) ? trim($_POST['nickname']) : '';
        if(!$nickname)
        {
            if(!is_password($_POST['newpassword']) || is_badword($_POST['newpassword'])) {
    			$data = array(
                    'code' => 2,
                    'message' => '昵称必填'
                );
                echo json_encode($data);exit;
    		}
        }
		$nickname = safe_replace($nickname);
		if($nickname) {
			$this->db->update(array('nickname'=>$nickname), array('userid'=>$this->memberinfo['userid']));
			if(!isset($cookietime)) {
				$get_cookietime = param::get_cookie('cookietime');
			}
			$_cookietime = $cookietime ? intval($cookietime) : ($get_cookietime ? $get_cookietime : 0);
			$cookietime = $_cookietime ? TIME + $_cookietime : 0;
			param::set_cookie('_nickname', $nickname, $cookietime);
		}
		require_once CACHE_MODEL_PATH.'member_input.class.php';
		require_once CACHE_MODEL_PATH.'member_update.class.php';
		$member_input = new member_input($this->memberinfo['modelid']);
		$modelinfo = $member_input->get($_POST['info']);

		$this->db->set_model($this->memberinfo['modelid']);
		$membermodelinfo = $this->db->get_one(array('userid'=>$this->memberinfo['userid']));
		if(!empty($membermodelinfo)) {
			$this->db->update($modelinfo, array('userid'=>$this->memberinfo['userid']));
		} else {
			$modelinfo['userid'] = $this->memberinfo['userid'];
			$this->db->insert($modelinfo);
		}

        $data = array(
            'code' => 1,
            'message' => L('operation_success')
        );
        echo json_encode($data);exit;

	}
}
