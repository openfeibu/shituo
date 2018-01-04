$(function(){


	$(".header .setLau").hover(function () {
		$(this).find(".lauBox").slideDown(200)
	},function(){
		$(this).find(".lauBox").slideUp(200)
	})
	$(".header_login_button").on("click",function(){
		$(".main-panel").fadeIn(200);
		$fb.mask({},function(){
			$fb.closeMask();
			$(".main-panel").fadeOut(200);

		})
	})
	$fb(".main-panel form").formValidator([
		{
			name:'username',
			rules:'required',
			display:'入仓代码不可为空'
		},
		{
			name:'password',
			rules:'required',
			display:'密码不可为空'
		},
	],function(){
		var username = $("#username").val();
		var password  = $("#password").val();
		var cookietime = $("#cookietime").val();
		$.post('index.php?m=member&c=ajax&a=login', 'username='+username+'&password='+password+'&cookietime='+cookietime+'&dosubmit=1', function(data){
                if(data.success == 1){
					$(".main-panel").hide();
					$(".fb-mask").hide();
					$(".header_login").html(data.html);
					$fb.fbNews({"type":"success","content":'登录成功'});
					window.location.href='/index.php?m=content&c=index&a=member_center&siteid=1';
                }
                else if(data==-1){ $fb.fbNews({"type":"warning","content":'用户不存在'});}
                else if(data==-2){ $fb.fbNews({"type":"warning","content":'密码错误'});}
                else if(data==-3){ $fb.fbNews({"type":"warning","content":'登录失败'});}
                else if(data==-4){ $fb.fbNews({"type":"warning","content":'错误次数过多，请稍后再试'});}
                else if(data==2){ $fb.fbNews({"type":"warning","content":'帐号已锁定'});}
        }, "json");
        return false;

	})
	// $.getJSON("index.php?m=member&c=ajax&a=checklogin&jsoncallback=?", function(data){
	//     if(data=='1'){
	//        	$(".header_login_button").hide();
	// 		$(".accout_img").show();
	//     }
	// });
})
