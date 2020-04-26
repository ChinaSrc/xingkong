
<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->style/hall.css">
<style>
    #banner {
        position:relative;width:920px;height:300px;background: #fff;
    display:inline-block;}
    #banner .banner-btn-bj{width:100%;height: 24px; position: absolute; bottom: 0; z-index:1; }
    #bannerBtn{float: right;}
    #bannerBtn li{float: left; display: inline;  width: 20px; height: 20px;line-height: 20px;text-align: center; margin-right:5px; background: #ccc; cursor: pointer; border: 1px solid #dcdcdc;}
    #bannerBtn li.cc{background:#c80000; border: 1px solid #be0000; color: #fff;}
    #bannerMain{width: 100%;height:300px;overflow: hidden;}

</style>



<div class="box-kuai3">
<div style="clear: both">
    <div id="banner" >
        <div class="banner-btn-bj">
            <ul id="bannerBtn"></ul>
        </div>
        <div id="bannerMain<!--{if count($banner)==1}-->1<!--{/if}-->">
            <!--{foreach from=$banner key=key item=item}-->
            <a href="<!--{$item['url']}-->">
                <img src="<!--{$item['img']|getFileUri}-->" style="width:100%; height:300px;"  />
            </a>
            <!--{/foreach}-->


        </div>
        <a class="arrow-left" href="javascript:showAuto1()"></a>
        <a class="arrow-right" href="javascript:showAuto()"></a>
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

        </script>
    </div>
<div style="display: inline-block;float: right;width: 250px;border:1px #ddd solid">
<div>
    <img src="<!--{$file_uri}-->/static/images/fyb-logo.jpg" width="100%">
</div>
    <script>

        var gamekey='';
    </script>
    <style>
        .winningList{
            height:200px;
            border-width:0px !important;margin-top: 0px !important;
        }
.listtitle{
            display: none !important;
        }
    </style>
    <!--{include file="<!--{$tplpath}-->lottery_list.tpl"}-->
</div>
</div>




    <!--{if $con_system['hall_height']>0}-->
    <div style="clear: both;width: 100%;height:<!--{$con_system['hall_height']}-->px">

        <!--{$con_system['hall_content']}-->

    </div>

    <!--{/if}-->







<div  class="lotteryContent slideTabBox">
    <ul  class="lotteryNav hd fix normalBg">

        <li onclick="set_tabs('index');" class="hoverBg" id="nav_index"><a>热门</a><i ></i></li>
        <li onclick="set_tabs('all');" class="on focusBg" id="nav_all">

            <a >全部<i ></i></a>
        </li>
        <!--{foreach from=$arr_game_code key=key item=item}-->
        <!--{if count($game_nav1[$key])>0}-->
        <li onclick="set_tabs('<!--{$key}-->');" id="nav_<!--{$key}-->"> <a><!--{$item}--></a> <i ></i></li>
        <!--{/if}-->
        <!--{/foreach}-->

    </ul>
    <div  class="bd">

        <div id="ssc_list">





            <ul style="clear: both;display: none" id="list_index" class="lotteryList">


                <!--{foreach from=$game_index key=key1 item=item1}-->
                <li  class="ClickShade">

                    <img src="<!--{$item1['ico']|getFileUri}-->" height="62" width="62">
                    <div  class="lotteryDetail">
                        <h4 ><!--{$item1['fullname']}--></h4>
                        <em ><!--{$item1['content']}--></em>
                    </div>
                    <div  class="lotteryNow">
                        <a  href="game_<!--{$item1['id']}-->.html" class="mainColorBtn now MustLogin">立即投注</a>
                        <a  title="玩法说明" class="helpbtn" onclick="open_url('index_wanfa.html?type=<!--{$item1['skey']}-->&from=parent');"><i >?</i></a>
                    </div>
                    <img  src="<!--{$file_uri}-->/static/images/shadow.png"  class="bottom_line"/ >
                </li>



                <!--{/foreach}-->
            </ul>
            <ul style="clear: both;"  id="list_all" class="lotteryList">

                <!--{foreach from=$game_all key=key1 item=item1}-->
                <li  class="ClickShade">

                    <img src="<!--{$item1['ico']|getFileUri}-->" height="62" width="62">
                    <div  class="lotteryDetail">
                        <h4 ><!--{$item1['fullname']}--></h4>
                        <em ><!--{$item1['content']}--></em>
                    </div>
                    <div  class="lotteryNow">
                        <a  href="game_<!--{$item1['id']}-->.html" class="mainColorBtn now MustLogin">立即投注</a>
                        <a  title="玩法说明" class="helpbtn" onclick="open_url('index_wanfa.html?type=<!--{$item1['skey']}-->&from=parent');"><i >?</i></a>
                    </div>
                    <img  src="<!--{$file_uri}-->/static/images/shadow.png"  class="bottom_line"/ >
                </li>

                <!--{/foreach}-->


            </ul>

            <!--{foreach from=$arr_game_code key=key item=item}-->
            <!--{if count($game_nav1[$key])>0}-->
            <ul style="clear: both;display: none" id="list_<!--{$key}-->" class="lotteryList">


                <!--{foreach from=$game_nav1[$key] key=key1 item=item1}-->
                <li  class="ClickShade">

                    <img src="<!--{$item1['ico']|getFileUri}-->" height="62" width="62">
                    <div  class="lotteryDetail">
                        <h4 ><!--{$item1['fullname']}--></h4>
                        <em ><!--{$item1['content']}--></em>
                    </div>
                    <div  class="lotteryNow">
                        <a  href="game_<!--{$item1['id']}-->.html" class="mainColorBtn now MustLogin">立即投注</a>
                        <a  title="玩法说明" class="helpbtn" onclick="open_url('index_wanfa.html?type=<!--{$item1['skey']}-->&from=parent');"><i >?</i></a>
                    </div>
                    <img  src="<!--{$file_uri}-->/static/images/shadow.png"  class="bottom_line"/ >
                </li>
                <!--{/foreach}-->
            </ul>

            <!--{/if}-->
            <!--{/foreach}-->
        </div>


        </ul>
    </div>
</div>






















</div>

<script>
    function set_tabs(value) {

        var nav=document.querySelector('.lotteryNav').querySelectorAll('li');
        for(var i=0;i<nav.length;i++){

            nav[i].className='hoverBg';

        }
        document.getElementById('nav_'+value).className='on focusBg';
        var list=document.querySelector('#ssc_list').querySelectorAll('ul');
        for(var i=0;i<list.length;i++){

            list[i].style.display='none';

        }
        document.getElementById('list_'+value).style.display='block';
    }


</script>



<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   



</body>
</html>

