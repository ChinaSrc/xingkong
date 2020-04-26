
<!--{include file="<!--{$tplpath}-->head.tpl"}-->
       <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/ZeroClipboard.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->




<div  id='bd'>
<div id="main" class="clearfix">
                <div class="my_left">



<style type="text/css">
.menu_w ul li a:hover{color:#FFFFFF;background:#006699;}
</style>

<div class="my_l_m" style="padding-top:5px;">
    <div class="hl_menu">




    <div id="user-menu">
                <div class="tp-ui-item tp-ui-menu">


                <ul>


                     <!--{foreach from=$arr_game_code key=key item=item}-->

	          <!--{if count($game_nav[$key])>0}-->



                    <li id="parent_menu_safe" class="parentMemberMenu tp-ui-menu-sub tp-ui-menu-sub-group tp-ui-active">


                    <div class="tp-ui-sub tp-ui-menu-base tp-ui-menu-head tp-ui-menu-base-arrow" onclick="show_menu('<!--{$key}-->');"><a href="javascript:void(0);"><!--{$item}--></a>
                    <div class="tp-ui-sub tp-ui-handle-button tp-ui-menu-arrow"><button type="button"><em>&nbsp;</em></button></div>
                    </div>
                    <div id="sub_menu_<!--{$key}-->" class="tp-ui-sub tp-ui-menu-submenu" style="display: block;">
                   	            <ul class="clg-subs-mono">
		     <!--{foreach from=$game_nav[$key] key=key1 item=item1}-->

		                <li class="tp-ui-menu-sub tp-ui-active    ">
		            <div class="tp-ui-sub tp-ui-menu-base"><a href="hemai_<!--{$item1['id']}-->.html" title="<!--{$item1['fullname']}-->"><!--{$item1['fullname']}--></a></div></li>

	  <!--{/foreach}-->




                        </ul></div>

                        </li>




	         <!--{/if}-->


		      <!--{/foreach}-->










                    </ul></div>
                </div>







    </div>
</div>
<script language="javascript">
function show_menu(id){
//window.wxc.xcConfirm(id);
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


                </div>
                <div class="my_right">





 <div class="cont">
 <div class="cont-head">
        <div class="title"> <em class="tp-ui-icon tp-ui-icon-before icon-cont"><i>&nbsp;</i></em>

     <span> <a href="index.html" title="">网站首页</a> &gt;<a href="hemai.html" title="">合买大厅</a><!--{if $game_name}-->&gt; <!--{$game_name}--> <!--{/if}--></span>
        </div>
    </div>

 </div>

 <div class="fx_info" id="allnav">

   <div class="faWrap">


  <table width="100%" cellspacing="0" cellpadding="0" border="0" class="rec_table">

   <tbody>
    <tr class="">

     <th class="th_name">发起人</th>
     <th class="text_l">彩种</th>
        <th class="text_l">期号</th>
     <th>方案进度</th>
     <th class="fa_money">方案金额</th>
     <th class="mf_money">每份金额</th>
     <th class="mf_money">剩余份数</th>
     <th>认购份数</th>
     <th>操作</th>
    </tr>
     <!--{section name=p loop=$hm_list}-->
    <tr class="" onmouseover="Yobj.addClass(this, 'th_on')" onmouseout="Yobj.removeClass(this, 'th_on')">



     <td class="th_name"> <!--{$hm_list[p]['user_name']}--></td>
     <td class="eng text_l new_record">   <!--{$hm_list[p]['game_name']}--></td>
          <td class="eng text_l new_record">   第<!--{$hm_list[p]['period']}-->期</td>
     <td class="eng">

       <!--{$hm_list[p]['mebuy']}-->%<!--{if $hm_list[p]['baodi'] gt 0}-->+<!--{$hm_list[p]['baodi']}-->%<span class="red">(保)</span><!--{/if}-->
   </td>
     <td class="eng fa_money"><!--{$hm_list[p]['money']}--><span class="gray">元</span></td>
     <td class="eng mf_money"><!--{$hm_list[p]['premoney']}--><span class="gray">元</span></td>
     <td class="eng mf_money"><span id='num1_<!--{$hm_list[p]['id']}-->'><!--{$hm_list[p]['sum1']}--></span><span class="gray">份</span></td>
     <td><input type="text" value="<!--{$hm_list[p]['sum1']}-->" class="rec_text" maxlength="6"  id='num_<!--{$hm_list[p]['id']}-->' /></td>
     <td><input type="button" value="参与" class="btn_Dora_s" onclick="do_statistics('<!--{$hm_list[p]['id']}-->',<!--{$hm_list[p]['sum1']}-->);" />
     <a onclick="javascript:DialogResetWindow('<!--{$hm_list[p]['game_name']}-->第<!--{$hm_list[p]['period']}-->期合买详情','index_hemai_detail.html?id=<!--{$hm_list[p].id}-->','800','500')">详情</a></td>
    </tr>

    <!--{/section}-->


   </tbody>
  </table>


		    <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->

	</div>


</div>







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
			}
			else {

				window.wxc.xcConfirm(str[1],window.wxc.xcConfirm.typeEnum.warning);
			}
			}


		};
		xmlHttp.send(null);




	}
else{
window.wxc.xcConfirm('请输入正整数'),window.wxc.xcConfirm.typeEnum.warning;
document.getElementById(div).value=max;
return false;
	}



}


</script>





    <div class="clear"></div>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->