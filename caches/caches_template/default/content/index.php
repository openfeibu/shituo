<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","index_header"); ?>
<div class="main pdt">
    <div class="banner_box fb-position-relative">
        <div class="fb-banner-slide fb-position-relative">
            <div class="fb-banner-slide-zone fb-clearfix fb-position-relative">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=bd7bba5b7efded1f82ead3047b6e89c8&action=category&catid=51&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'51','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <div class="fb-banner-slide-item fb-float-left">
                    <div class="fb-banner-img"><a href="<?php if(!$r['url'] && $r['url']!='#') { ?><?php echo $r['url'];?><?php } else { ?>javascript:;<?php } ?>"><img src="<?php echo $r['image'];?>" alt=""></a></div>
                </div>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
            <div class="fb-banner-spot fb-position-absolute">
                <div class="fb-spot-item fb-spot-item-active fb-inlineBlock"></div>
                <div class="fb-spot-item fb-inlineBlock"></div>
                <div class="fb-spot-item fb-inlineBlock"></div>
            </div>
            <!--<div class="fb-banner-prev fb-position-absolute fb-transition"></div>-->
            <!--<div class="fb-banner-next fb-position-absolute fb-transition"></div>-->

        </div>
        <div class="w1200 fb-position-absolute cargoTracking_box">
            <div class="cargoTracking">
                <div class="cargoTracking_title"><?php echo $CATEGORYS[20][$GLOBALS['prefix']."catname"]; ?></div>
                <form action="货物跟踪.html">
                    <div class="item">
                        <label  class="fb-inlineBlock"><?php echo SL('company');?></label>
                        <div class="search_form fb-inlineBlock">广州世拓</div>
                    </div>
                    <div class="item">
                        <label class="fb-inlineBlock"><?php echo SL('number');?></label>
                        <input type="text" name="search_num" class="search_num fb-inlineBlock">
                        <input type="submit" value="<?php echo SL('query');?>" class=" fb-inlineBlock opa_active">
                    </div>
                </form>
                <div class="customer_phone"><?php echo SL('contact_us');?>：<span><?php echo $CATEGORYS[50]['description'];?></span></div>
            </div>
        </div>
    </div>
    <div class="product_zone w1200">
        <div class="product_ky fb-position-relative fb-transition">
            <div class="product_ky_img fb-position-absolute fb-transition"><img src="<?php echo $CATEGORYS['9']['image'];?>" alt=""></div>
            <div class="product_ky_text  fb-position-absolute fb-transition">
                <div class="p_title"><?php echo $CATEGORYS[9][$GLOBALS['prefix']."catname"] ?></div>
                <div class="p_content">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=c3bd9fbf7b32adff6e8e2c898fc92231&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=9 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                <?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                <?php echo str_cut(strip_tags($val[$GLOBALS['prefix']."content"]),400,"...");?>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
                <div class="p_more fb-position-absolute"><a href="<?php echo $CATEGORYS['19']['url'];?>">MORE</a></div>
            </div>
        </div>
        <div class="product_hy fb-position-relative fb-transition">
            <div class="product_hy_text  fb-position-absolute fb-transition">
                <div class="p_title"><?php echo $CATEGORYS[10][$GLOBALS['prefix']."catname"] ?></div>
                <div class="p_content">
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=5f84fc942f5ab176f32e5f406990942e&sql=SELECT+%2A+FROM+shituo_page+where+catid%3D10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM shituo_page where catid=10 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                    <?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
                    <?php echo str_cut(strip_tags($val[$GLOBALS['prefix']."content"]),400,"...");?>
                    <?php $n++;}unset($n); ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
                <div class="p_more fb-position-absolute"><a href="<?php echo $CATEGORYS['19']['url'];?>">MORE</a></div>
            </div>
            <div class="product_hy_img fb-position-absolute fb-transition"><img src="<?php echo $CATEGORYS['10']['image'];?>" alt=""></div>
        </div>
    </div>
    <div class="showDate">
        <div class="w1200">
            <div class="showDate_item showDate_item01 fb-inlineBlock fb-transition">
                <p>08</p>
                <span>快件专线</span>
            </div>
            <div class="showDate_item showDate_item02  fb-inlineBlock fb-transition">
                <p>135</p>
                <span>覆盖地区</span>
            </div>
            <div class="showDate_item showDate_item03  fb-inlineBlock fb-transition">
                <p>2000+</p>
                <span>提供服务</span>
            </div>
            <div class="showDate_item showDate_item04  fb-inlineBlock fb-transition">
                <p>99.8%</p>
                <span>客户好评</span>
            </div>
        </div>
    </div>
    <div class="homeNews fb-clearfix ">
        <div class="w1200">
            <div class="homeNews_title fb-float-left">
                <div class="homeNews_title_top">
                    <p>新闻动态</p>
                    <span>NEWS INFORMATION</span>
                </div>
                <div class="homeNews_title_bottom fb-position-relative">
                    <div class="page">
                        <span>01</span>/02
                    </div>
                    <div class="homeNews_page_prev fb-position-absolute fb-transition"></div>
                    <div class="homeNews_page_next fb-position-absolute fb-transition"></div>
                </div>
            </div>
            <div class="homeNews_list_zone fb-float-left">
                <div class="homeNews_list fb-position-relative">
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=aac9f2123a311a953154e5c02dd69f85&action=position&posid=2&order=id+DESC&num=6&return=pdata\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$pdata = $content_tag->position(array('posid'=>'2','order'=>'id DESC','limit'=>'6',));}?>
					<?php $i = 0?>
					<?php $n=1; if(is_array($pdata)) foreach($pdata AS $n => $p) { ?>
					<?php $i++?>
						<?php $id = $p[id];$cid = $p[catid];?>
						<?php $where = "id=$id"?>
					    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8d57b9afe0e6109ad04abf5e0cef7948&action=lists&catid=%24cid&where=%24where&moreinfo=1&num=1&return=cdata\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$cdata = $content_tag->lists(array('catid'=>$cid,'where'=>$where,'moreinfo'=>'1','limit'=>'1',));}?>
					    <!--使用where属性指定id，使用moreinfo属性指定获取副表信息-->
					    <?php $n=1;if(is_array($cdata)) foreach($cdata AS $c) { ?>
                        <div class="homeNews_item fb-float-left">
                            <a href="">
                                <div class="img">
                                    <img src="<?php echo $c['thumb'];?>" alt="">
                                </div>
                                <div class="text fb-transition">
                                    <div class="n_title fb-overflow-2"><?php echo $c[$GLOBALS['prefix']."title"];?></div>
                                    <div class="n_content fb-overflow-3"><?php echo str_cut(strip_tags($c[$GLOBALS['prefix']."content"]),300,"...");?>
                                    </div>
                                    <div class="n_date"><?php echo date('Y-m-d',$c[inputtime]);?></div>
                                </div>
                            </a>
                        </div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
            </div>
        </div>
    </div>
    <div class="home_ad fb-position-relative">
        <a href=""><img class="fb-position-absolute" src="<?php echo CSS_PATH;?>shituo/images/home_ad.png" alt=""></a>
    </div>
    <div class="fb-figureCarousel fb-position-relative branchOffice w1200">
        <div class="fb-figureCarousel-boxOverflow ">
            <div class="fb-figureCarousel-box fb-position-relative">
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">广州公司</div>
                        <div class="n_map">地址：广州市白云区广园中路218号</div>
                        <div class="n_phone">电话：020-36483303</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice01.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">迪拜公司</div>
                        <div class="n_map">地址：Sulatan Ahmed Lootah Building Al Ghurair Center
                            Mezzanine No2
                        </div>
                        <div class="n_phone">电话：00971-551152977 、00971-551855345</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice02.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>
                <div class="fb-figureCarousel-item fb-float-left branchOffice_item">
                    <div class="n_text">
                        <div class="n_title">沙特公司</div>
                        <div class="n_map">地址：Al Manar Riyadh Saudi Arabia</div>
                        <div class="n_phone">电话：00971-588759471</div>
                    </div>
                    <div class="n_img"><img src="<?php echo CSS_PATH;?>shituo/images/branchOffice03.png" alt=""></div>
                </div>

            </div>
        </div>
        <div class="fb-figureCarousel-spot fb-position-absolute">
            <!--<div class="fb-spot-item fb-spot-item-active fb-inlineBlock"></div>-->
            <!--<div class="fb-spot-item fb-inlineBlock"></div>-->
        </div>
        <div class="fb-figureCarousel-left fb-position-absolute"></div>
        <div class="fb-figureCarousel-right fb-position-absolute"></div>
    </div>
    <div class="logistics_line w1200">
        <div class="title_n"><?php echo SL('line');?></div>
        <div class="title_desc"><?php echo $CATEGORYS[19][$GLOBALS['prefix'].'description'];?></div>
        <div class="logistics_line_con">
            <ul class=" fb-clearfix">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=afb9b0200d2c7392109d54262c7f0ecf&action=category&catid=19&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'19','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li>
                    <a href="<?php echo $r['url'];?>">
                        <div class="img"><img src="<?php echo $r['image'];?>" alt="<?php echo $r['catname'];?>"></div>
                        <div class="text"><?php echo  $r[$GLOBALS['prefix']."catname"] ?></div>
                    </a>
                </li>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
    </div>
</div>
<?php include template("content","footer"); ?>
<script>
    //        $fb(".fb-banner-fade").banner_fade({
    //            speed : 1200,//unit: 滑动速度
    //            interval : 5000,//unit:轮播图间隔
    //            transitionalStyle:"fb-banner-img-big"
    //        });
    $fb(".fb-banner-slide").banner_slide({
        speed: 500,//unit: 滑动速度
        interval: 5000,//unit:轮播图间隔
        transitionalStyle: "fb-banner-img-big"
    });
    $(function () {
        var new_index = 0;
        var news_count = parseInt($(".homeNews_item").length / 3);

        news_count = $(".homeNews_item").length % 3 == 0 ? news_count : news_count + 1;
        $(".homeNews_page_prev").on("click", function () {
            new_index = --new_index < 0 ? news_count - 1 : new_index;
            var nowPage = new_index + 1 < 10 ? '0' + (new_index + 1) : new_index;
            $(".homeNews_title .page span").text(nowPage);
            $(".homeNews_list").stop().animate({
                left: -new_index * 900
            })
        })
        $(".homeNews_page_next").on("click", function () {
            new_index = ++new_index > news_count - 1 ? 0 : new_index;
            var nowPage = new_index + 1 < 10 ? '0' + (new_index + 1) : new_index;
            $(".homeNews_title .page span").text(nowPage);
            $(".homeNews_list").stop().animate({
                left: -new_index * 900
            })
        })
        var r = null;
        $(".homeNews_list").hover(function () {
            clearInterval(r)
        }, function () {
            runB();
        })
        function runB() {
            r = setInterval(function () {
                new_index = ++new_index > news_count - 1 ? 0 : new_index;
                var nowPage = new_index + 1 < 10 ? '0' + (new_index + 1) : new_index;
                $(".homeNews_title .page span").text(nowPage);
                $(".homeNews_list").stop().animate({
                    left: -new_index * 900
                })
            }, 5000)
        }

        runB();
    })
    $fb(".fb-figureCarousel").figureCarousel({
        speed: 500, //滑动速度
        showNum: 3, //显示次
        boxWidth: 360, //盒子宽度
        boxHeight: 550, //盒子高度
        width: 360, //图片宽度
        height: 270, //图片高度
        //暂时不支持以下参数
        autoPlay: false, //是否自动轮播
        interval: 3000, //轮播间隔
        pagination: true,//分页器
    });

    $(window).on("scroll",function(){
        var product_ky_flag = false;
        var product_hy_flag = false;
        var showDate_flag = false;
        var scrollTop = $(window).scrollTop();
        var product_ky_top = $(".product_ky ").offset().top;
        var product_hy_top = $(".product_hy ").offset().top;
        var showDate_top = $(".showDate").offset().top;
        if(scrollTop > product_ky_top-$(window).height()){
            if(!product_ky_flag){
                product_ky_flag = true;
                $(".product_ky").css("opacity",1);
                setTimeout(function(){
                    $(".product_ky .product_ky_img").css({"left":0,"opacity":1})
                    $(".product_ky .product_ky_text").css({"right":0,"opacity":1})
                },300)
//                $(".product_hy").css("opacity",1);
//                setTimeout(function(){
//                    $(".product_hy .product_hy_img").css("right",0)
//                    $(".product_hy .product_hy_text").css("left",140)
//                },500)
            }
        }
        if(scrollTop > product_hy_top-$(window).height()){
            if(!product_hy_flag){
                product_hy_flag = true;

                $(".product_hy").css("opacity",1);
                setTimeout(function(){
                    $(".product_hy .product_hy_img").css({"right":0,"opacity":1})
                    $(".product_hy .product_hy_text").css({"left":140,"opacity":1})
                },300)
            }
        }
        if(scrollTop > showDate_top-$(window).height()){
            if(!showDate_flag){
                showDate_flag = true;
                $(".showDate .showDate_item01").css({"marginTop":0,"opacity":1})
                setTimeout(function () {
                    $(".showDate .showDate_item02").css({"marginTop":0,"opacity":1})
                },500)
                setTimeout(function () {
                    $(".showDate .showDate_item03").css({"marginTop":0,"opacity":1})
                },1000)
                setTimeout(function () {
                    $(".showDate .showDate_item04").css({"marginTop":0,"opacity":1})
                },1500)


            }
        }
    })
</script>
