<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8d2022a939836b5dc1a722d8db333e0e&action=category&siteid=1&catid=%24catid&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('siteid'=>'1','catid'=>$catid,'limit'=>'1',));}?>
<?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>


<?php header('location:'.$r['url'].'');?>

<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php include template("content","header"); ?>
    <div class="main pdt">
        <div class="page_banner fb-position-relative" >
            <img class="fb-position-absolute" src="<?php echo CSS_PATH;?>shituo/images/news_banner.png" alt="">
        </div>
        <div class="main_content">
            <div class="news_con fb-clearfix">
                <div class="news_tab w1200">
                    <div class="news_tab_item fb-inlineBlock active"><a href="">最新动态</a></div>
                    <div class="news_tab_item fb-inlineBlock"><a href="">企业新闻</a></div>
                    <div class="news_tab_item fb-inlineBlock"><a href="">行业动态</a></div>
                    <div class="news_tab_item fb-inlineBlock"><a href="">通知公告</a></div>
                </div>
                <div class="news_list_img w1200 fb-clearfix">
                    <div class="news_list_img_item active fb-transition">
                        <a href="新闻详情.html">
                            <div class="img"><img src="<?php echo CSS_PATH;?>shituo/images/news_list_img01.png" alt=""></div>
                            <div class="text ">
                                <div class="title_n">传统与前沿产业共塑中巴双赢愿景</div>
                                <div class="title_desc">在“一带一路”倡议下，来自中国的企业正在迎接更广阔的与巴林共赢商机，传统产业和前沿产业均加大...</div>
                                <div class="date">2017-11-21</div>

                            </div>
                        </a>
                    </div>
                    <div class="news_list_img_item fb-transition">
                        <a href="">
                            <div class="img"><img src="<?php echo CSS_PATH;?>shituo/images/news_list_img02.png" alt=""></div>
                            <div class="text ">
                                <div class="title_n">传统与前沿产业共塑中巴双赢愿景</div>
                                <div class="title_desc">在“一带一路”倡议下，来自中国的企业正在迎接更广阔的与巴林共赢商机，传统产业和前沿产业均加大...</div>
                                <div class="date">2017-11-21</div>

                            </div>
                        </a>
                    </div>
                    <div class="news_list_img_item fb-transition">
                        <a href="">
                            <div class="img"><img src="<?php echo CSS_PATH;?>shituo/images/news_list_img03.png" alt=""></div>
                            <div class="text ">
                                <div class="title_n">传统与前沿产业共塑中巴双赢愿景</div>
                                <div class="title_desc">在“一带一路”倡议下，来自中国的企业正在迎接更广阔的与巴林共赢商机，传统产业和前沿产业均加大...</div>
                                <div class="date">2017-11-21</div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="news_list_text w1200 fb-clearfix">
                    <div class="news_list_text_item fb-float-left">
                        <div class="news_list_text_item_box fb-transition">
                            <a href="">
                                <div class="date">2017-11-21</div>
                                <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div>
                            </a>
                        </div>
                    </div>
                    <div class="news_list_text_item fb-float-left">
                        <div class="news_list_text_item_box fb-transition">
                            <a href="">
                                <div class="date">2017-11-21</div>
                                <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div>
                            </a>
                        </div>
                    </div>
                    <div class="news_list_text_item fb-float-left">
                        <div class="news_list_text_item_box fb-transition">
                            <a href="">
                                <div class="date">2017-11-21</div>
                                <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div>
                            </a>
                        </div>
                    </div>
                    <div class="news_list_text_item fb-float-left">
                        <div class="news_list_text_item_box fb-transition">
                            <a href="">
                                <div class="date">2017-11-21</div>
                                <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div>
                            </a>
                        </div>
                    </div>
                    <div class="news_list_text_item fb-float-left">
                        <div class="news_list_text_item_box fb-transition">
                            <a href="">
                                <div class="date">2017-11-21</div>
                                <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div>
                            </a>
                        </div>
                    </div>
                    <div class="news_list_text_item fb-float-left">
                        <div class="news_list_text_item_box fb-transition">
                            <a href="">
                                <div class="date">2017-11-21</div>
                                <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="loadingMore fb-transition">
                    <p>点击加载更多</p>
                </div>
            </div>
        </div>
    </div>
    <?php include template("content","footer"); ?>
</body>
    <script>
    $(function(){
        $(".news_list_img .news_list_img_item").hover(function(){
                $(this).addClass("active").siblings(".news_list_img_item").removeClass("active");
        },function(){

        })
        $(".loadingMore").on("click",function(){
            $fb.loading(
                    {
                        color:'#fff',
                        content:'正在获取中...',
                    }
            )
            setTimeout(function(){
                $fb.closeLoading();
                var html = '<div class="news_list_text_item fb-float-left"><div class="news_list_text_item_box fb-transition"> <a href=""> <div class="date">2017-11-21</div> <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div> </a> </div> </div><div class="news_list_text_item fb-float-left"><div class="news_list_text_item_box fb-transition"> <a href=""> <div class="date">2017-11-21</div> <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div> </a> </div> </div><div class="news_list_text_item fb-float-left"><div class="news_list_text_item_box fb-transition"> <a href=""> <div class="date">2017-11-21</div> <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div> </a> </div> </div><div class="news_list_text_item fb-float-left"><div class="news_list_text_item_box fb-transition"> <a href=""> <div class="date">2017-11-21</div> <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div> </a> </div> </div><div class="news_list_text_item fb-float-left"><div class="news_list_text_item_box fb-transition"> <a href=""> <div class="date">2017-11-21</div> <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div> </a> </div> </div><div class="news_list_text_item fb-float-left"><div class="news_list_text_item_box fb-transition"> <a href=""> <div class="date">2017-11-21</div> <div class="content">双十一物流本纪：九年双十一如何影响国内快递业</div> </a> </div></div>';
                ;
                $(".news_list_text").append(html)
            },1000)
        })
    })
    </script>
</html>
