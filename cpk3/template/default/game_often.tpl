
<div  class="oftenon" style="left: -150px;">
    <div  class="title">常玩彩种
        <span onclick="DialogResetWindow('常玩彩种设置（最多设置6种彩票）','index_often_set.html?from=parent','750','400')" style="float: right;padding-right: 10px;font-size:14px;color:#777;">设置</span>
    </div>
    <ul id="often_html">
        <!--{foreach from=$often_list key=key item=item}-->
        <li  <!--{if $smarty.get.id==$item['id']}-->class="gameactive"<!--{/if}-->   id='often_li_<!--{$item['key']}-->'>
        <a  href="game_<!--{$item['id']}-->.html" ><h2 ><!--{$item['title']}--></h2>
            <h4 id="often_timer_<!--{$item['key']}-->">00:00:00</h4>
        </a>

        <input type="hidden" name="often_list" value="<!--{$item['key']}-->">
        </li>
        <!--{/foreach}-->



    </ul>

<div class="x_lottery">

    <div  class="tit">
        <ul >



            <!--{foreach from=$arr_game_code key=key item=item}-->

            <!--{if count($game_nav[$key])>0}-->

            <li >
                <div  class="pl">
                    <!--{$item}-->
                 <img src="<!--{$file_uri}-->/static/images/ico/icon-next.png">
                </div>
                <div  class="xq">

                    <!--{foreach from=$game_nav[$key] key=key1 item=item1}-->

                    <a href="<!--{$root_url}-->game_<!--{$item1['id']}-->.html"  <!--{if $smarty.get.id==$item1['id']}-->class="active" <!--{/if}-->>
                        <!--{$item1['fullname']}-->
                    <!--{if $item1['icon1']==1}--><em class="hot">H</em><!--{/if}-->
                    </a>

                    <!--{/foreach}-->

                </div></li>


            <!--{/if}-->


            <!--{/foreach}-->


        </ul>
    </div>
</div>



</div>


<script>
    var often='<!--{$userinfo['often']}-->';
    function show_often(num) {

        if(num==1){
            document.querySelector('.oftenoff').style.display='none';
            document.querySelector('.oftenon').style.display='block';

            if(often==0) start_often();
        }
        else{
            document.querySelector('.oftenon').style.display='none';
            document.querySelector('.oftenoff').style.display='block';

        }

        ajaxobj=new AJAXRequest;
        ajaxobj.method="POST";
        ajaxobj.content="action=set_often&often="+num;
        ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&flag=yes";
        ajaxobj.callback=function(xmlobj){
            var response = xmlobj.responseText;
///alert(response);
        };ajaxobj.send();
    }



    function get_often_timer(gamekey){

        ajaxobj=new AJAXRequest;
        ajaxobj.method="POST";
        ajaxobj.content="";
        ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&action=lot&flag=yes&play="+gamekey;//alert(ajaxobj.url)
        ajaxobj.callback=function(xmlobj){
            var response = Trim(xmlobj.responseText);
            if(response.length-10>0){
                var periods=response.split("|");
                // document.querySelector("#often_timer_"+gamekey).innerHTML=periods[5];



                set_often_time(periods[5],gamekey);



            }
        }
        ajaxobj.send();

    }

    function set_often_time(ser_lot_time,gamekey) {
        if(ser_lot_time<=0){

            get_often_timer(gamekey);
            return false;
        }
        var  lost_s=parseInt(ser_lot_time);

//console.log(lost_s);
        var l_s=Math.floor(lost_s%60);
        var next_s=Math.floor(lost_s/60);
        var l_m=Math.floor(next_s%60);
        var next_m=Math.floor(next_s/60);
        var l_h=Math.floor(next_m%60);

        var str='';

        if(l_h-10<0){n_h="0"+(l_h);}else{n_h=(l_h);}
        if(l_m-10<0){n_m="0"+(l_m);}else{n_m=(l_m);}
        if(l_s-10<0){n_s="0"+(l_s);}else{n_s=(l_s);}

        if(n_h!='00') var hh = n_h+":";
        else hh='';



        document.querySelector("#often_timer_"+gamekey).innerHTML=n_h+':'+n_m+':'+n_s;
        setTimeout(function(){lost_s--;set_often_time(lost_s,gamekey);},1000) ;
    }

    function start_often(){


        ajaxobj=new AJAXRequest;
        ajaxobj.method="POST";
        ajaxobj.content="";
        ajaxobj.url="index_often_set.html?action=getlist&id=<!--{$smarty.get.id}-->";//alert(ajaxobj.url)
        ajaxobj.callback=function(xmlobj){
            var response = Trim(xmlobj.responseText);
            if(response.length-10>0){
                document.querySelector('#often_html').innerHTML=response;

                var list=  document.getElementsByName('often_list');

                for (var i=0;i<list.length;i++){
                    get_often_timer(list[i].value);

                }


            }
        }
        ajaxobj.send();




    }

    function show_history(num) {

        if(num==1){
            document.querySelector('#historyoff').style.display='none';
            document.querySelector('#historyon').style.display='block';

        }
        else{
            document.querySelector('#historyon').style.display='none';
            document.querySelector('#historyoff').style.display='block';

        }

        ajaxobj=new AJAXRequest;
        ajaxobj.method="POST";
        ajaxobj.content="action=set_history&history="+num;
        ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&flag=yes";
        ajaxobj.callback=function(xmlobj){
            var response = xmlobj.responseText;

        };ajaxobj.send();
    }
  //  if(often==1)
        start_often();


</script>