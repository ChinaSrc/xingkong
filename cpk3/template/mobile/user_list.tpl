

<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<style>
    .search {
        height: 2.4em;
        background: #fff;
        padding: .45em 0 .45em 1.2em;
        position: relative
    }

    .search:before {
        content: "\E90B";
        font-family: defFont;
        position: absolute;
        left: .3em;
        top: .9em;
        font-size: .9em;
        color: #666
    }

    .search input {
        width: 80%;
        text-align: left;
        margin: .3em 0 .3em .5em;
        height: 1.6em;
        font-size: .7em;
        color: #666;
        display: block;
        float: left;
        border: none;
        -webkit-appearance: none;
        padding: 0
    }

    .search input:focus {
        outline: none
    }

    .search span {
        display: inline-block;
        color: blue;
        height: 1.5em;
        width: 14.5%;
        color: #3178ff;
        text-align: center;
        font-size: .7em;
        margin-left: .5em;
        margin-top: .43em
    }

    .ag-top {
        background: #fff;
        margin-top:10px;
        height:50px;
    }

    .ag-top .name-num {
        height:32px;
        font-size:14px;
        padding-top:9px;
        border-bottom: 1px solid #eaeaea;
        color: #333;
    }

    .ag-top .name-num .lt {
        float: left;
        margin-left: 1em;
        padding-left: .6em;
        border-left: .4em solid #e23539
    }

    .ag-top .name-num .rt {
        float: right;
        margin-right: .6em;
        margin-top: -.3em
    }

    .ag-top .name-num .rt span {
        display: inline-block;
        color: #777;
        border: 1px solid #eee
    }

    .ag-top .name-num .rt .sp1 {
        border-right: none;
        padding: .3em .2em;
        border-radius: .3em .1em .1em .3em
    }

    .ag-top .name-num .rt .sp2 {
        padding: .3em .5em;
        border-radius: .1em .3em .3em .1em
    }

    .ag-top .name-num .rt span.on {
        border-color: #e9676a;
        border-right: 1px solid #e9676a
    }

    .member {
        margin-bottom: .03em;
        background: #fdfafa;
        border-bottom: 1px solid #eee;
        box-shadow: 0 2px 6px #f5f5f5;
        position: relative;
        font-size: 14px;
        padding: .4em 0 .38em 3.2em
    }

    .member span {
        color: #777;
        font-size: .9em
    }

    .member i {
        color: #e75659;
        position: absolute;
        left: 1.2em;
        top: 1.2em;
        transition: .2s
    }

    .member em {
        position: absolute;
        right: 2.5em;
        top: 1.15em;
        font-size: .9em;
        color: #777
    }

    .member.on i {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg)
    }

    .detail {
        padding: 0 .6em .5em
    }

    .detail .info-border {
        box-shadow: 0 0 6px #dfdfdf;
        background: #fff
    }

    .detail .info {
        position: relative;
        margin: 0 10px;
        padding: 12px 10px;
        border-bottom: 1px solid #eee;
        font-size: 14px;;

    }
    .detail .info i{color:#f44;margin-right:5px;}
    .detail .info .s2 {
        float: right;
        color: #777
    }
    .detail .info:last-child{text-align:center;}

    .detail .info .btn {
        border: 1px solid #eaeaea;
        padding: 5px 18px;
        margin-right: 10px;
        border-radius:3px;

    }

    .detail .log:before,.detail .money:before,.detail .reb:before,.detail .reg:before,.detail .tp:before {
        font-family: defFont;
        position: absolute;
        font-size: 1.4em;
        left: .1em;
        top: .6em;
        color: #fa9787
    }

    .rebate-detail {
        z-index: 15;
        position: fixed;
        left: 0;
        right: 0;
        top:50px;
        bottom: 0;
        color: #fff;
        text-align: center;
        font-size: 16px;
    }

    .rebate-detail i {
        font-size: 28px;
        display: block;
        height:40px;
    }

    .rebate-detail .title {
        text-align: center;
        font-size: 20px;
        margin-top: 20px;
    }

    .rebate-detail .detail11 {
        border-top: 2px solid #e23539;
        margin: 15px;
    }

    .rebate-detail .detail11 span {
        width: 5em;
        margin: 1.2em 1.1em 0 .5em;
        border-radius: .2em;
        display: inline-block
    }
    .detail11 {
      background-color: #fff;
      padding: 10px;
     }
  
       table
        {
          border-collapse: collapse;
          border: none;
          width: 100%;
          font-size: 13px;
          background-color: #fff;
          color: #000;
        }
        td
        {
          border: solid #ccc 1px;
          padding: 6px;
          text-align: left;
        }
      	td span { color: #666; margin: 0 !important; width: auto !important;}
        table input {
          height: 30px;
          line-height: 30px;
          padding: 0px 10px;
          font-family: "Tahoma", "宋体";
          font-size: 14px;
          border-radius: 4px;
          border: 1px solid #ccc;
        }


</style>


<div class="main" s="[object Object]">

        <form action="" method="get" name="frm_search" id="frm_search" style="padding-top: 10px;">

            <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
            <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
            <input type="hidden" name='st' value="1">

            账号：

            <input style="width: 150px" placeholder="请输入下级账号"  class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
            &nbsp;&nbsp;<input type="submit" class="button" value="搜索" />


        </form>

    <div class="ag-top">
        <div class="name-num">
            <div class="lt">
                我的下级
            </div>
            <div class="rt">
                <span onclick="location.href='home_user_list.html?st=2&username=<!--{$smarty.get.username}-->&page=<!--{$smarty.get.page}-->&order=userid desc';" class="sp1 <!--{if $order=='userid desc'}-->on<!--{/if}-->">注册时间<i class="icon-down"></i></span>
                <span onclick="location.href='home_user_list.html?st=2&username=<!--{$smarty.get.username}-->&page=<!--{$smarty.get.page}-->&order=groupid desc';"  class="sp2 <!--{if $order=='groupid desc'}-->on<!--{/if}-->">等级<i class="icon-down"></i></span>
            </div>
        </div>
    </div>
    <div >

           <!--{if count($user_list)>0}-->


        <!--{foreach from=$user_list key=key  item=item}-->


        <div >
            <div class="member"  onclick="show_detail('<!--{$key}-->');;" >
                <i class="icon-down-open-big"></i>
                <p >             <!--{$item.username}--></p>
                <span ><!--{$item.group_title}--></span>
                <em >下级人数：      <!--{$item.next_num}-->人</em>
            </div>
            <div class="detail" style="display: none;">
                <div class="info-border">

                    <div class="info money">
                        <i class="icon-database"></i><span >当前余额：</span>
                        <span class="s2"> <!--{$item['amount'].total_amount}-->元</span>
                    </div>
                    <div class="info reg">
                        <i class="icon-clock"></i> <span >注册时间：</span>
                        <span class="s2">
                <!--{if $item.registertime}--><!--{$item.registertime}--><!--{else}-->-<!--{/if}--></span>
                    </div>
                    <div class="info log">
                        <i class="icon-logout"></i>  <span >最后登录：</span>
                        <span class="s2">    <!--{if $item.lastlogintime}--><!--{$item.lastlogintime}--><!--{else}-->-<!--{/if}--></span>
                    </div>
                    <div class="info tp">
                    <i class="icon-slot"></i>    <span >玩家类型：</span>
                        <span class="s2">   <!--{$item.pre}-->级<!--{show_user_type($item)}--></span>
                    </div>
                    <div class="info">
                        <span class="btn" onclick="document.getElementById('rebate_<!--{$userid}-->').style.display='block';">查看返点</span>
                        <span class="btn" onclick="location.href='home_user_list.html?st=2&username=<!--{$item.username}-->';">查看下级</span>
                    </div>


                </div>
            </div>

            <div   id="rebate_<!--{$userid}-->" style="display: none">
                <div  class="blackBg"></div>
                <div  class="rebate-detail"><h3  class="title"><em >返点详情</em></h3>
                    <ul  class="detail11" style="display: block">
                        <!--{foreach from=$arr_game_code key=key1 item=item1}-->
                      <table>
                        <tr>
                          <td width="80">返点比例</td>
                          <td>
                            <!--{$item1}-->：
                            <input value="<!--{$item['rebates'][$key1]}-->" readonly style="width: 50px;" />
                            <span>(范围 <!--{$item['minrebate']}--> - <!--{$item['maxrebate']}-->)</span></td>
                        </tr>
<!--
                        <tr>
                          <td>上级代理</td>
                          <td>
                            <input value="<!--{$item['higherUser']}-->" readonly style="width: 70px;" />
                            <span>(推荐关系: <!--{$item['gx']}-->)</span>
                          </td>
                        </tr>
-->
                      </table>
                        <!--{/foreach}-->
              </ul>
                    <i class="icon-cancel-circled"  onclick="document.getElementById('rebate_<!--{$userid}-->').style.display='none';"></i>
                </div>
            </div>

        </div>






        <!--{/foreach}-->



    </div>


    <div class="page">
        <!--{$page}-->

    </div>
<!--{else}-->

    <div class="page">
     没有找到相关数据
    </div>

    <!--{/if}-->
    <!---->
</div>




<script>

    function show_detail(num) {

        var member=document.querySelectorAll('.member');
        var detail=document.querySelectorAll('.detail');
        for(var i=0;i<member.length;i++){
            if(i==num){
        if(detail[i].style.display=='none'){
            detail[i].style.display='block';
            member[i].querySelector('i').className='icon-right-open-big';
        }
        else{
            detail[i].style.display='none';
            member[i].querySelector('i').className='icon-down-open-big';

        }

            }
            else{
                detail[i].style.display='none';
                member[i].querySelector('i').className='icon-down-open-big';

            }

        }


    }

</script>








        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->













