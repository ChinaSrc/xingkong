

<!--{include file="<!--{$tplpath}-->head.tpl"}-->


<link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/index.css" />
<style>
    #banner {position:relative; z-index:0;width:100%;height:300px;background: #fff;}
    #banner .banner-btn-bj{width:100%;height: 24px; position: absolute; bottom: 0; z-index:999; }
    #bannerBtn{float: right;}
    #bannerBtn li{float: left; display: inline;  width: 20px; height: 20px;line-height: 20px;text-align: center; margin-right:5px; background: #ccc; cursor: pointer; border: 1px solid #dcdcdc;}
    #bannerBtn li.cc{background:#c80000; border: 1px solid #be0000; color: #fff;}
    #bannerMain{width: 100%;height:300px;overflow: hidden;}

</style>







<div  class="hc-con-inner"  style="width:1180px;margin:0 auto;display: block;">



    <div style="clear: both">
        <div class="index_left">

           <ul class="leftNav">
               
           
            <!--{foreach from=$game_index key=key1 item=item1}-->
               <!--{if $key1<10}-->

            <li>
                <a href="game_<!--{$item1['id']}-->.html" class="MustLogin">  <img  src="<!--{$item1['ico']|getFileUri}-->" />
                    <span class="lotteryName"><!--{$item1['fullname']}--></span><span class="intro"><!--{$item1['content']}--></span>
                </a>
            </li>
<!--{/if}-->
            <!--{/foreach}-->

           </ul>
        </div>


        <div class="index_center">

            <div id="banner" style="clear: both">
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

            </script>


            <div class="openTab">
                <div class="slideTxtBox">
                    <div class="hd" >
                        <ul id="gamebar" >
                            <!--{foreach from=$game_index1 key=key item=item}-->
                            <li <!--{if $key==0}-->class='cur'<!--{/if}--> onclick="getindexlot('<!--{$item['ckey']}-->',<!--{$key}-->);"><!--{$item['fullname']}--></li>
                            <!--{/foreach}-->

                        </ul>
                    </div>
                    <div class="bd" id="gameindex">
                        <ul>


                                                  </ul>
                        <ul style="display: none;">
                            <!---->
                        </ul>
                        <ul style="display: none;">
                            <!---->
                        </ul>
                    </div>
                </div>
            </div>

            <script>

                 function getindexlot(gamekey,num) {
                     var showindx=document.getElementById('gameindex').querySelectorAll('ul');
                     var gamebar=document.getElementById('gamebar').querySelectorAll('li');
                     ajaxobj=new AJAXRequest;
                     ajaxobj.method="POST";
                     ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&action=lottery_list&flag=yes&play="+gamekey;
                     ajaxobj.callback=function(xmlobj){
                         var response = xmlobj.responseText;
                         response=response.split('^');

                         var number=response[2].split(',');
                         var sum=parseInt(number[0])+parseInt(number[1])+parseInt(number[2]);

                         if(sum>10) var dx='大';else var dx='小';
                         if(sum%2==1) var ds='单';else var ds='双';
                         showindx[num].innerHTML='  <li class="jsk3">\n' +
                             '                                <div align="center" class="dice">\n' +
                             '                                   <img src="<!--{"static/images/ico/num-'+number[0]+'.png"|getFileUri}-->" >\n' +
                             '                                    <i>+</i>\n' +
                             '                                    <img src="<!--{"static/images/ico/num-'+number[1]+'.png"|getFileUri}-->" >\n' +
                             '                                    <i>+</i>\n' +
                             '                                   <img src="<!--{"static/images/ico/num-'+parseInt(number[2])+'.png"|getFileUri}-->" >\n' +
                             '                                    <i>=</i>\n' +
                             '                                    <em>'+sum+'</em>\n' +
                             '                                </div></li>\n' +
                             '                            <li class="text"><p><span>当前期：第 <i>'+response[1]+'</i> 期</span> <span>开奖号码：<i>'+response[2]+'</i></span>' +
                             ' <span>和值：<i>'+sum+'</i></span> <span>形态：<a>'+dx+'</a><a>'+ds+'</a></span></p></li>\n';

                     };ajaxobj.send();

                     for(var i=0;i<gamebar.length;i++){

                         if(i==num) {
                             gamebar[i].className='cur';
                             showindx[i].style.display='block';
                         }
                         else {
                             gamebar[i].className='';
                         showindx[i].style.display='none';}
                     }
                 }



                 getindexlot('<!--{$game_index1[0]['ckey']}-->',0);

            </script>

        </div>


        <div class="index_right" >
            <div id="sidebar" style="clear: both;">

                <!--{if $smarty.session.userid}-->
                <div style="clear: both;margin-bottom: 10px;height:45px; line-height: 45px;padding: 0 10px; text-align: center; border: 1px solid #d2d1d1;
    border-top: 3px solid #f44;">
                    <i class="icon-user" style="color: #f44;font-size: 18px;"></i>
                    <a href="home_safe_info.html" style="color: #3388ff"><!--{$cur_username}--> </a>
                    <a class="member-center" href="home.html">帐户中心</a>

                </div>
                <!--{else}-->
                <div class="account" style="clear: both;margin-bottom: 10px;height:50px;">
                    <a class="account-1" href="login.html" style="color: #fff;"><i class="icon-user"></i>登录</a>
                    <a class="account-2" href="<!--{$con_system['regUrl']}-->" style="color: #fff;"><i class="icon-edit"></i>注册</a>
                </div>

                <!--{/if}-->
                <!-- account -->
                <div class="news" >

                    <div class="news-title">
                        <span class="title">平台公告</span>
                        <a  href="home_user_note.html"target="_blank" class="more">更多&gt;&gt;</a>
                    </div>
                    <ul style="height:200px;">

                        <!--{foreach from=$note key=key item=item}-->


                        <li >
                            <a  href="home_user_note.html?itemid=<!--{$item['id']}-->"target="_blank"><!--{$item['title']}--></a>

                            <span class="time"><!--{date('m-d',$item['time'])}--></span>
                        </li>



                        <!--{/foreach}-->

                    </ul>
                </div><!-- news -->
<script>

    var gamekey='';
</script>
                <style>
                    .winningList{height:213px;}
                  .tempWrap { height: 184px;overflow: hidden; }	
                </style>
                <!--{include file="<!--{$tplpath}-->lottery_list.tpl"}-->
        </div>


    </div>
</div>







<!--{if $con_system['index_height']>0}-->
    <div style="padding-top: 10px;clear: both;width: 100%;height:<!--{$con_system['index_height']}-->px">

        <!--{$con_system['index_content']}-->

    </div>

    <!--{/if}-->









        </div>



<!--{if $note_show==1 && count($note1)>0}-->

<style>

    .note_title{
        width: 120px;
  padding: 0 10px;
font-size: 16px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        cursor: pointer;border: 0px;
    }
 .note_title.cur{

        background-color: #fff;
     color: #ff0000;
    }

    .note_content{

        display: none;
        padding: 0 10px;
        font-size: 12px;
    }
    .note_content:first-child{

        display: block;
    }
    .note_content .title{
        font-size: 16px; text-align: center;
        font-weight: 600;
    }

    .note_content .time{
        font-size: 14px; text-align: center;
float: none;
    }
    .note_content .content{
        width: 100%;
    }
    .note_info::-webkit-scrollbar{
        display: none;
    }
</style>

<div class="xcConfirm" id="msg_show" style="">
    <div class="xc_layer"></div>
    <div class="popBox" style="height:510px;top:250px;width: 600px;margin-left: -300px;border: 0px;">
        <div class="ttBox" style="overflow: hidden;    background: #ea2020;height: 50px;line-height: 50px;color: #fff;text-align: center;font-size: 18px;border-bottom: 0px;">
            <a class="clsBtn" onclick="document.getElementById('msg_show').style.display='none';" style="top:20px;"></a>
            公告

        </div>
        <div style="height:400px;padding:0px;overflow: hidden;font-size:16px;font-weight: normal;">
          <div  class='note_info' style="width: 100%;height: 400px;line-height: 30px;overflow: hidden;border: 0px;overflow-y: scroll;">

      <div style="width: 140px;background-color: #efefef;line-height: 50px;border: 0px;display: inline-block;height: 100%;" valign="top">
          <!--{foreach from=$note1 key=key item=item}-->

<div class="note_title" onclick="show_note(<!--{$key}-->);" title="<!--{$item['title']}-->"> <!--{$item['title']}--></div>


          <!--{/foreach}-->
      </div>

      <div style="display: inline-block;width: 400px;vertical-align: top;">
          <!--{foreach from=$note1 key=key item=item}-->

          <div class="note_content">


           <div class="title"><!--{$item['title']}--></div>
<div class="time">时间：<!--{date('Y-m-d H:i:s',$item['time'])}--></div>
              <div class="content"><!--{$item['content']}--></div>

          </div>


          <!--{/foreach}-->



  </div>



          </div>


        </div>
        <div class="btnArea">
            <div class="btnGroup" ><a class="sgBtn ok" onclick="document.getElementById('msg_show').style.display='none';">知道了</a></div>
        </div>
    </div>
</div>

<script>
    function show_note(num) {

     var title=   document.querySelectorAll('.note_title');
        var content=   document.querySelectorAll('.note_content');

        for(var i=0;i<title.length;i++){

            if(i==num){
                title[i].className='note_title cur';
                content[i].style.display='block';
            }
            else{
                title[i].className='note_title';
                content[i].style.display='none';

            }
        }

    }

    show_note(0);
</script>

<!--{/if}-->




    <!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




    </body>
    </html>


