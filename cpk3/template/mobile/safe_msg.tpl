

<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>


<div class="top">
    <div class="back" onclick="window.history.go(-1);" >
        <i  class=" icon-left-open-big"></i>

    </div>
    <ul>
        <li class="on"  ><a href="home_safe_msg.html">站内信</a></li>
        <li class=""  >
            <a href="home_user_note.html">网站公告</a>
        </li>
    </ul>



</div>


        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
        <!--{if $con_system.IsSendMsg=='no'}-->
    <script>winPop({title:'温馨提示',type:'2',width:'400',iclose:'true',drag:'true',height:'90',url:'<div style="padding:20px;color:#ffffff;">该功能已关闭！</div>',next:3,goTo:'<!--{$root_url}-->'});</script>
<!--{/if}-->


  <form method="POST" action="<!--{$this_url}-->&active=js" name="form1" id="form1"  style='line-height:40px;padding-left:10px;padding-top:5px;'>
  <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
  <tr height=25 align="left">
     <td align="left" style='padding-left:5px;'>
	<input type="text" name="begindate" id="begindate" value="<!--{$begindate}-->" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
至
	 <input type="text" name="enddate" id="enddate" value="<!--{$enddate}-->" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd  HH:mm:ss',alwaysUseStartDate:false})" >&nbsp;
<br>


    <input type="submit" value="搜 索" class="button">

    	 &nbsp;&nbsp;
     <input type="button" value="发送消息" class="button" onclick="location.href='home_safe_msgsend.html';">


                        </form>

 <!--{if count($list)>0}-->
                                 <!--{foreach from=$list key=key item=item}-->


                <div class="wap_list" style='line-height:30px;'>
     <div class='item'  style='width:100%;padding-left:2%;padding-right:2%;margin-left:-2%;text-align:center;border-bottom:1px  solid #d5d5d5;'>
                           <a  href='home_safe_msginfo.html?id=<!--{$item.id}-->' style="color: #666;"><!--{$item['title']}--></a>(<!--{$item.read}-->)

</div>

<div>

 发送人： <!--{$item.fromname}-->

<span style='float:right;'> 接收人：<!--{$item.toname}--></span>
</div>

<div style='color:#d5d5d5;'>
<!--{$item.creatdate}-->

<span style='float:right;'>

                           <a href='home_safe_msginfo.html?id=<!--{$item.id}-->' class='info_btn'  >阅读</a>
                                 <a href="home_safe_msg.html?type=del&id=<!--{$item['id']}-->" class='info_btn' >删除</a>
</span>
</div></div>

                             		       <!--{/foreach}-->
                           <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->

                            <!--{else}-->


                <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="<!--{$file_uri}-->static/images/empty.png" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div>



                            <!--{/if}-->


                        </table>


                        </div>
                    </div>
                    <!--详细内容iframe-end-->

                </div>
            </div>
        </div>




      <script type="text/javascript">

function del_msg(id){

	location.href='home_safe_msg.html?type=del&id='+id;

}



</script>














        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->






