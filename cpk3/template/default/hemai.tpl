
<!--{include file="<!--{$tplpath}-->head.tpl"}-->
       <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=1234" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/ZeroClipboard.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->




<div  id='bd' style="background-color: #fff;border-radius: 8px;">


<script language="javascript">
function show_menu(id){
//alert(id);
var div='sub_menu_'+id;
var pmenu='parent_menu_'+id;
if( document.getElementById(div).style.display=='none'){

	document.getElementById(div).style.display='block';
	document.getElementById(pmenu).className='parentMemberMenu tp-ui-menu-sub tp-ui-menu-sub-group tp-ui-active';
	}

else{

	document.getElementById(div).style.display='none';
	document.getElementById(pmenu).className='parentMemberMenu tp-ui-menu-sub tp-ui-menu-sub-group';
	}

	          }

</script>





 <div class="cont">
 <div class="cont-head">
        <div class="title"> <em class="tp-ui-icon tp-ui-icon-before icon-cont"><i>&nbsp;</i></em>

     <span> <a href="index.html" title="">网站首页</a> &gt;<a href="hemai.html" title="">合买大厅</a><!--{if $game_name}-->&gt; <!--{$game_name}--> <!--{/if}--></span>
        </div>
    </div>

 </div>


 <div  style='line-height:50px;padding-left:20px;'>
<form action="hemai.html" method="get">
    彩种：
    <select name="id">
        <option value="">-所有彩种-</option>

        <!--{foreach from=$arr_game_code key=key item=item}-->

        <!--{if count($game_nav[$key])>0}-->

        <optgroup label="<!--{$item}-->"><!--{$item}--></optgroup>

        <!--{foreach from=$game_nav[$key] key=key1 item=item1}-->

        <option value='<!--{$item1['id']}-->' <!--{if $smarty.get.id eq $item1['id']}-->selected<!--{/if}--> ><!--{$item1['fullname']}--></option>

        <!--{/foreach}-->







        <!--{/if}-->


        <!--{/foreach}-->
    </select>

    &nbsp; 状态：<select name="status">
        <option value="-2">不限</option>
        <!--{foreach from=$arr_hemai_status key=key1 item=item1}-->

        <option value='<!--{$key1}-->' <!--{if $status eq $key1}-->selected<!--{/if}--> ><!--{$item1}--></option>

        <!--{/foreach}-->

    </select>
    &nbsp;
    <input type="submit" class="button" value=" 搜索 ">


</form>

 </div>

 <div id="allnav" style="padding:0 10px;border-top:1px #ccc solid">
<!--{if count($hm_list)>0}-->
  <table width="100%" cellspacing="0" cellpadding="0" border="0" class="my_tbl my_tbltdm list_tbl">

   <tbody>
    <tr class="">

     <th >发起人</th>
     <th >彩种</th>
        <th   >期号</th>
     <th>方案进度</th>
     <th >方案金额</th>
     <th>状态</th>
     <th >每份金额</th>

     <th >剩余份数</th>
     <th>认购份数</th>
     <th>操作</th>
    </tr>
     <!--{section name=p loop=$hm_list}-->
    <tr class="" onmouseover="Yobj.addClass(this, 'th_on')" onmouseout="Yobj.removeClass(this, 'th_on')">



     <td > <!--{$hm_list[p]['user_name']}--></td>
     <td >   <!--{$hm_list[p]['game_name']}--></td>
          <td>   第<!--{$hm_list[p]['period']}-->期</td>
     <td >

       <!--{$hm_list[p]['mebuy']}-->%<!--{if $hm_list[p]['baodi'] gt 0}-->+<!--{$hm_list[p]['baodi']}-->%<span class="red">(保)</span><!--{/if}-->
   </td>
     <td ><!--{$hm_list[p]['money']}--><span class="gray">元</span></td>
     <td  <!--{if $hm_list[p]['status'] eq '0'}-->style='color:#ff0000;'<!--{/if}-->><!--{$hm_list[p]['status_name']}--></td>
          <td ><!--{$hm_list[p]['premoney']}--><span class="gray">元</span></td>
     <td ><span id='num1_<!--{$hm_list[p]['id']}-->'><!--{$hm_list[p]['sum1']}--></span><span class="gray">份</span></td>
     <td>
          <!--{if $hm_list[p]['status'] eq '0'}-->
          <input type="text" value="<!--{$hm_list[p]['sum1']}-->" class="rec_text" maxlength="6"  id='num_<!--{$hm_list[p]['id']}-->' />
     <input type="button" value="参与" class="btn_Dora_s" onclick="do_statistics('<!--{$hm_list[p]['id']}-->',<!--{$hm_list[p]['sum1']}-->);" />
<!--{else}-->
--
     <!--{/if}-->
     </td>
     <td>
     &nbsp;
     <a onclick="javascript:DialogResetWindow('<!--{$hm_list[p]['game_name']}-->第<!--{$hm_list[p]['period']}-->期合买详情','index_hemai_detail.html?id=<!--{$hm_list[p].id}-->','800','500')">详情</a>
     &nbsp;

     </td>
    </tr>

    <!--{/section}-->


   </tbody>
  </table>




		    <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->

<!--{else}-->

     <div class="drawing-table">
         <div class="complete">
             <div class="complete-sub image"> <span><img src="<!--{$file_uri}-->/static/images/empty.png" alt=""></span> </div>
             <div class="complete-sub title">
                 <h2>呃...没有找到对应查询条件的合买记录!</h2>
             </div>
         </div>
     </div>


     <!--{/if}-->


</div>

            </div>








</div>

<script type="text/javascript">
function isPositiveNum(s){//是否为正整数
    var re = /^[0-9]*[1-9][0-9]*$/ ;
    return re.test(s)
}
function do_statistics(id,max){

	var div='num_'+id;
var num=	document.getElementById(div).value;
if(isPositiveNum(num)){
	if(parseInt(num)>parseInt(max)){
		document.getElementById(div).value=max;


window.wxc.xcConfirm('最多认购'+max+'注',window.wxc.xcConfirm.typeEnum.warning);
return false;
}


	   var xmlHttp;

	   	if(window.ActiveXObject){
	   		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	   	}
	   	else if(window.XMLHttpRequest){
	   		xmlHttp = new XMLHttpRequest();
	   	}

		xmlHttp.open('GET',"do.aspx?mod=ajax&code=game&list=hmbuy&hm_id="+id+"&num="+num,true);
		xmlHttp.onreadystatechange=function(){

			if(xmlHttp.readyState==4){
			var response=xmlHttp.responseText;
			 var str=response.split("|");

			if(str[0]=='ok'){

				window.wxc.xcConfirm("认购成功",window.wxc.xcConfirm.typeEnum.success);

				var div1='num1_'+id;
				document.getElementById(div).value=str[1];
				document.getElementById(div1).innerHTML=str[1];
				if(str[1]<1) location.reload();

			}
			else {

				window.wxc.xcConfirm(str[1],window.wxc.xcConfirm.typeEnum.warning);
			}
			}


		};
		xmlHttp.send(null);




	}
else{
window.wxc.xcConfirm('请输入正整数',window.wxc.xcConfirm.typeEnum.warning);
document.getElementById(div).value=max;
return false;
	}



}


</script>





    <div class="clear"></div>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->