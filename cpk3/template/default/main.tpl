

<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->style/index.css">

<style>
    #banner {position:relative; z-index:0;width:100%;height:500px;background: #fff;}
    #banner .banner-btn-bj{width:100%;height: 24px; position: absolute; bottom: 0; z-index:999; }
    #bannerBtn{float: right;}
    #bannerBtn li{float: left; display: inline;  width: 20px; height: 20px;line-height: 20px;text-align: center; margin-right:5px; background: #ccc; cursor: pointer; border: 1px solid #dcdcdc;}
    #bannerBtn li.cc{background:#c80000; border: 1px solid #be0000; color: #fff;}
    #bannerMain{width: 100%;height:500px;overflow: hidden;}


</style>

<div  class="hc-con-inner"  style="width:1200px;margin:0 auto;padding-bottom:50px;">
    <div  class="index">
        <div  class="index-row">
            <div  class="index-col " style="width: 100%;">
                <div  class="hc-block index-block index-banner" style="height:500px;">

                        <div id="banner">
                            <div class="banner-btn-bj">
                                <ul id="bannerBtn"></ul>
                            </div>
                            <div id="bannerMain<!--{if count($banner)==1}-->1<!--{/if}-->">
                                <!--{foreach from=$banner key=key item=item}-->
                                <a href="<!--{$item['url']}-->">
                                    <img src="<!--{$item['img']|getFileUri}-->" style="width:100%; height:500px;"  />
                                </a>
                                <!--{/foreach}-->


                            </div>
                        </div>



                        <script type="text/javascript">
                            $(function () {
                                var t = n = count = 0;
                                $(function () {
                                    count = $("#bannerMain a").size();
                                    for (var i = 1; i < count + 1; i++) {
                                        var newsli = "<li>" + i + "</li>"
                                        $('#bannerBtn').append(newsli);
                                    };
                                    $("#bannerBtn li").eq(0).addClass('cc');
                                    $("#bannerMain a:not(:first)").hide();
                                    $("#bannerBtn li").click(function () {
                                        $(this).addClass("cc").siblings("li").removeClass("cc");
                                        var i = $(this).text() - 1;
                                        n = i;
                                        if (i >= count) return;
                                        $("#bannerMain a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
                                    });
                                    t = setInterval("showAuto()",5000);
                                    $("#banner").hover(function () { clearInterval(t) }, function () { t = setInterval("showAuto()", 5000); });
                                })
                            });
                            function showAuto() {
                                n = n >= (count - 1) ? 0 : n + 1;
                                $("#bannerBtn li").eq(n).trigger("click").addClass("cc").siblings("li").removeClass("cc");;
                            }

                            function showAuto1() {
                                n = n ==0 ? (count - 1) : n -1;
                                $("#bannerBtn li").eq(n).trigger("click").addClass("cc").siblings("li").removeClass("cc");;
                            }
                            new slider({id:'slider'})
                        </script>





                    </div>

            </div>


        </div>
        <div  class="index-row">
            <div  class="index-col col-2" style="width: 60%">
                <div  class="hc-block index-block index-games" style="height:560px;">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-game"></i>热门游戏</h2>
                    </div>
                    <div  class="block-content">
                        <ul  class="index-lots">
                                  		     <!--{foreach from=$game_index key=key1 item=item1}-->

 <li ><a  href="<!--{$root_url}-->game_<!--{$item1['id']}-->.html" class="">
 <img  src="<!--{$item1['ico']|getFileUri}-->" alt="" /><!--{$item1['fullname']}--></a></li>





	  <!--{/foreach}-->




                        </ul>
                    </div>
                </div>

            </div>
            <div  class="index-col col-2" style="width: 40%">
                <div  class="hc-block index-block index-notice">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-horn"></i>网站公告</h2>
                        <a  href="index_note.html" class="block-more">更 多</a>
                    </div>
                    <div  class="block-content">
                        <ul  class="notice-list">

                          <!--{foreach from=$note key=key item=item}-->


       <li ><a  href="index_help.html?cate=<!--{$item['cate']}-->&newsid=<!--{$item['id']}-->" class="look"><h3 ><!--{$item['title']}--></h3>
        <p  class="time1"><i  class="icon icon-time"></i><!--{date('Y-m-d H:i:s',$item['time'])}--></p>
        <span  class="dot" style="background-color: rgb(107, 142, 35);"></span>
         <i  class="icon icon-arr"></i></a>
         </li>



		      <!--{/foreach}-->

                 </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>




<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




</body>
</html>


