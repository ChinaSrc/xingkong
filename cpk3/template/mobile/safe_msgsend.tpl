<!--{include file="<!--{$tplpath}-->head.tpl"}-->
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=2123" type="text/css" rel="stylesheet">
	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/note.css?v=22123" type="text/css" rel="stylesheet" />

<style>

.wap_list td{padding-right:10px;}


.wap_list ul li{display:block;width:100%; vertical-align: middle;padding-left:15px;}
.wap_list ul li:hover{background-color:#1aa7A5;}
.select_user1{    border-radius: 10px!important;
    box-shadow: 0 3px 10px #ccc;max-height:200px;overflow-y:scroll;line-height:30px;padding:10px 0px;    border-radius: 5px;width:100%;margin-bottom:10px;}

.select_user1  .active{background-color:#337ab7;}


.select_user{width:100%;    border-radius: 5px;    position: relative;
    display:block;height:30px;line-height:30px;text-align:center;
    vertical-align: middle;background-color:#f8f3f0;    font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 12px;
    color: #515151;border:#e6e6e6 1px solid;overflow:hidden; text-overflow:ellipsis;}


.select_user:hover{background-color:#e9e9e9;border-color:#cdd6e1;}
</style>
<div class='wap_list'>
    <form name="form" action="home_safe_msgsend.html?mobile=1" method="post">
<input type="hidden" name='type' id='type' value='1'>

<table style='width:100%;line-height:50px;margin-top:10px;'>

<tr>
<td align="right" style='width:80px;' >发给谁？</td>
<td>
<input type="radio" name="user" value='1' checked="checked" style='height:15px;padding:0px;'
onclick="document.getElementById('next_user').style.display='none';document.getElementById('type').value=1;">上级  &nbsp;&nbsp;
<input type="radio" name="user" value='2' style='height:15px;padding:0px;'  onclick="document.getElementById('next_user').style.display='';document.getElementById('type').value=2;">下级会员
</td>
</tr>
<tr id='next_user'  style='display:none;'>
<td align="right" >下级会员</td>
<td>
<div class='select_user'  id='select_user'  onclick='show_users();'> --请选择会员--</div>

<div class="select_user1" id='select_user1'  style='display:none;'>
<div class="input-group">
<span class="input-group-addon"><img src='<!--{$file_uri}-->/static/images/search1.png'></span>
<input class="form-control multiselect-search" id='search' type="text" placeholder="查询"  oninput='search_user(this.value);'>
<span class="input-group-btn">
<button class="btn btn-default multiselect-clear-filter"  style='height:34px;' type="button"  onclick="close_search();"><img src='<!--{$file_uri}-->/static/images/close1.png'></button></span></div>

<ul>

<li  style='color:#000;font-weight:700;'>
<input type='checkbox' id='click_all' onclick='click_all22();'  style='height:17px;padding:0px; vertical-align: middle;'>选择所有

</li>

<!--{foreach from=$next key=key item=item}-->
<li  id='li_<!--{$item.userid}-->' >
<input name='users[]' id='user_<!--{$item.userid}-->' type='checkbox' value='<!--{$item.userid}-->' onclick="set_click22('<!--{$item.userid}-->');" style='height:17px;padding:0px; vertical-align: middle;'>
<span  id='info_<!--{$item.userid}-->'  onclick="document.getElementById('user_<!--{$item.userid}-->').click();"><!--{$item['username']}--></span>

</li>

<!--{foreachelse}-->
您还没有下级
<!--{/foreach}-->
</ul>

</div>
</td>
</tr>

<tr>
<td align="right" >消息标题</td>
<td>  <input value="" type="text" class="form-control" placeholder="请输入消息标题" id="title" name="title"></td>
</tr>




<tr>
<td align="right" >消息内容</td>
<td>    <textarea rows="9" class="form-control" placeholder="请输入消息内容..." id="content" name="content"></textarea></td>
</tr>


<tr>
<td align="right" ></td>
<td>
<input type="submit" class='button' value="确定发送"  onclick='return sendContent();' >


&nbsp;<a onclick='window.history.go(-1); '>返回</a>
</td>
</tr>





</table>




    </form>


</div>

</div>

</div>


<script type="text/javascript">

function sendContent(){

	if(document.getElementById('type').value=='2'){

var users=document.getElementsByName('users[]');
var temp=0;
for(var i=0;i<users.length;i++){

if(users[i].checked) temp++;


	}
if(temp<1){

	window.wxc.xcConfirm("请选择下级会员",window.wxc.xcConfirm.typeEnum.warning);
	return false;


	}


		}



	   if(document.getElementById('title').value=="") {
			window.wxc.xcConfirm("请输入消息标题",window.wxc.xcConfirm.typeEnum.warning);
			document.getElementById('title').focus();
			return false;
	   }

	   if(document.getElementById('title').value.length<2) {
			window.wxc.xcConfirm("消息标题不能小于2个字符",window.wxc.xcConfirm.typeEnum.warning);
			document.getElementById('title').focus();
			return false;
	   }



	   if(document.getElementById('content').value=="") {
			window.wxc.xcConfirm("请输入消息内容",window.wxc.xcConfirm.typeEnum.warning);
			document.getElementById('content').focus();
			return false;
	   }

	   if(document.getElementById('content').value.length<2) {
			window.wxc.xcConfirm("消息内容不能小于2个字符",window.wxc.xcConfirm.typeEnum.warning);
			document.getElementById('content').focus();
			return false;
	   }



                  }


function set_click22(num){

	if(document.getElementById('user_'+num).checked==true){

		document.getElementById('li_'+num).className='active';

		}
	else {
		document.getElementById('li_'+num).className='';
		}

	set_info();
}
  
function click_all22(){

	var user=document.getElementsByName('users[]');

  for(var i=0;i<user.length;i++){
      var v=user[i].value;
      if(document.getElementById('click_all').checked==true){
        user[i].checked=true;
        set_click22(v);
          }
      else {
    	  user[i].checked=false;
         set_click22(v);

          }

	  }
	
}



function set_info(){
	var user=document.getElementsByName('users[]');
var str='';var num=0;
for(var i=0;i<user.length;i++){
 if(user[i].checked==true){
	 var v=user[i].value;
   var info=document.getElementById('info_'+v).innerHTML;

   if(str=='') str=info;
   else str+=','+info;
num++;
          }
   
	  }
if(num==<!--{count($next)}-->){

	document.getElementById('select_user').innerHTML='已选择（<!--{count($next)}-->）';
}

else {
if(str=='')document.getElementById('select_user').innerHTML='--请选择会员--';
else document.getElementById('select_user').innerHTML=str;

}
}



function search_user(value){

	//document.getElementById('select_user').innerHTML=str;
	var user=document.getElementsByName('users[]');

	for(var i=0;i<user.length;i++){
		
			 var v=user[i].value;
		   var info=document.getElementById('info_'+v).innerHTML;
              if(info.indexOf(value)>-1){

            	  document.getElementById('li_'+v).style.display='block';
                  }

              else {

            	  document.getElementById('li_'+v).style.display='none';

            	  user[i].checked=false;
                           }


		   
		          }
		   
	set_info();	
	
}

function close_search(){

	document.getElementById('search').value='';
	search_user('');

	
}


function show_users(){

if(document.getElementById('select_user1').style.display=='none')

	document.getElementById('select_user1').style.display='block';
		else document.getElementById('select_user1').style.display='none';
}


</script>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
