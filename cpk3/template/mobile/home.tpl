

<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<link href='<!--{$file_uri}-->/<!--{$skinpath}-->style/index.css' rel="stylesheet" type="text/css" />
                	   <link rel="stylesheet" href="static/dist/css/swiper.min.css">
<style>
    .swiper-container {
        width: 100%;
        height: 100%;
        margin-left: auto;
        margin-right: auto;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    </style>
     <div class="swiper-container" style="overflow:hidden;" onload="this.width=document.body.clientWidth;">
        <div class="swiper-wrapper"  onload="this.width=document.body.clientWidth;">

             <!--{foreach from=$banner key=key item=item}-->

                 <div class="swiper-slide"><img src="<!--{$item['img']|getFileUri}-->" onclick="location.href='<!--{$item['url']}-->';"width="100%"
             onload="this.height= document.body.clientWidth*10/22;"></div>

                             <!--{/foreach}-->


        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next" id='banner_next'  style='display:none;'></div>
        <div class="swiper-button-prev"  style='display:none;'></div>



     </div>

    <!-- Swiper JS -->
    <script src="<!--{$file_uri}-->/static/dist/js/swiper.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 1,
        loop:true,
        paginationClickable: true,
        spaceBetween:0,
        keyboardControl: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    });

    setInterval(function(){document.getElementById('banner_next').click();},5000);
    </script>
<style type="text/css">
.ttp a{border-radius:3px; width:85%; min-width:60px;}
.ttp li{width:25%;}

.img11{ -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    -o-filter: grayscale(100%);

    filter: grayscale(100%);

    filter: gray;}
  #topnote{
      height: 30px;padding-left: 10px;
    overflow: hidden;
    width: calc(100% - 50px);
    position: relative;
    display: inline-block;}
</style>

<div style='width:100%; height:30px;line-height:30px;background-color: #fff;margin-bottom:2px;vertical-align:middle;padding:5px 0px;'>
<span  style='padding-left:10px;;float: left;'>
    <img src='<!--{$file_uri}-->/<!--{$skinpath}-->images/icon_notice.png'  style='height:18px;vertical-align:middle;'>
</span>
    <ul  id="topnote">
        <!--{foreach from=$note key=key item=item}-->

        <li style="position: absolute; top: <!--{if $key==0}-->0<!--{else}-->48<!--{/if}-->px;">
            <a href="home_user_note.html?itemid=<!--{$item['id']}-->" style="color: #444;"><!--{$item['title']}--></a>
        </li>
        <!--{/foreach}-->

    </ul>

</div>

<script>

    var toplist= document.getElementById('topnote').querySelectorAll('li');
    var list_num=0;
    setInterval(function () {
        for (var i=0;i<toplist.length;i++){

            if(  toplist[i].style.top=='0px'){
                var top=0;
                var temp= toplist[i];

                var tt11=setInterval(function () {
                    top--;
                    if(top>-48){
                        temp.style.top=top+'px';

                    }
                    else{

                        clearInterval(tt11) ;
                        temp.style.top='48px';
                        if(list_num<toplist.length-1) list_num++;
                        else list_num=0;
                        var temp1=toplist[list_num];
                        var top1=48;
                        var tt22=setInterval(function () {
                            top1--;
                            if(top1>=0){
                                temp1.style.top=top1+'px';

                            }
                            else{

                                clearInterval(tt22) ;
                            }
                        },10);
                        
                    }
                },10)

            }
            
        }


    },4000);


</script>


<div style='clear:both;width:100%;display:block;height:3px;'></div>



<!--{foreach from=$arr_game_code key=key item=item}-->

<!--{if count($game_nav[$key])>0}-->
<div style="height: 30px;line-height: 30px;color:#e53333;padding:2px 8px;">

    <i class="icon-plus-circle"></i><!--{$item}-->专区
</div>

<ul  class="index-lots">

        <!--{foreach from=$game_nav[$key] key=key1 item=item1}-->


    <li onclick="location.href='<!--{$root_url}-->game_<!--{$item1['id']}-->.html'" >

        <img  src="<!--{$item1['ico']|getFileUri}-->" />
        <p>
            <span class="title"><!--{$item1['fullname']}--></span>
            <span class="desc"><!--{$item1['content']}--></span>
        </p>

    </li>

        <!--{/foreach}-->

</ul>
</div>




<!--{/if}-->


<!--{/foreach}-->



















                    </div>



<!--{if $note_show==1 && count($note1)>0}-->

<style>

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
    .note_content .content{
        width: 100%;
    }

</style>

<div class="xcConfirm" id="msg_show" style="">
    <div class="xc_layer"></div>
    <div class="popBox" style="height:350px;top:100px;left:5%;width: 90%">
        <div class="ttBox" style="overflow: hidden"><a class="clsBtn" onclick="document.getElementById('msg_show').style.display='none';"></a><span class="tt">通知公告</span>
        </div>
        <div style="height:240px;padding:10px;overflow-y: scroll;overflow-x: hidden;font-size:16px;font-weight: normal;">
            <!--{foreach from=$note1 key=key item=item}-->

            <div class="note_content">


                <div class="title"><!--{$item['title']}--></div>

                <div class="content"><!--{$item['content']}--></div>

            </div>


            <!--{/foreach}-->

        </div>
        <div class="btnArea">
            <div class="btnGroup" style="padding-top: 10px;" >
                <!--{if count($note1)==1}-->

                <a class="sgBtn ok" onclick="document.getElementById('msg_show').style.display='none';">知道了</a>
            <!--{else}-->
                <a class="button" id='note_close' onclick="document.getElementById('msg_show').style.display='none';">关闭</a>
                <a class="button" id="note_pre" onclick="show_note(-1);" style="display: none">上一条</a>
&nbsp;
                <a class="button" id="note_next" onclick="show_note(1);" style="background-color: #e53333">下一条</a>

                <!--{/if}-->
            </div>
        </div>
    </div>
</div>
<script>
    var note_num=0;
    var note_sum=<!--{count($note1)}-->
    function show_note(num) {
       if(note_num<note_sum-1 && num==1) note_num=note_num+num;
        if(note_num>0 && num<0 ) note_num=note_num+num;
        var content=   document.querySelectorAll('.note_content');

        for(var i=0;i<content.length;i++){

            if(i==note_num){
                content[i].style.display='block';
            }
            else{
                content[i].style.display='none';
            }
        }
        if(note_num==0){
       document.getElementById('note_pre').style.display='none';
            document.getElementById('note_close').style.display='inline-block';
        }
        else{
            document.getElementById('note_pre').style.display='inline-block';
            document.getElementById('note_close').style.display='none';
        }
        if(note_num==note_sum-1){
            document.getElementById('note_next').style.display='none';
            document.getElementById('note_close').style.display='inline-block';
        }
        else{
            document.getElementById('note_next').style.display='inline-block';
            document.getElementById('note_close').style.display='none';
        }
    }


</script>
<!--{/if}-->














<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




</body>
</html>

