<style>


#down-panel{
  border-width: 1px;
  border-color: rgb(32, 56, 84);
  border-style: solid;
  border-radius: 8px;
  background-color: rgb(235, 235, 235);
  width: 750px;
  height: 439px;
  position:fixed;
  z-index:99999;
  top:200px;
}
#down-panel .title{
    font-family: "Microsoft YaHei";
    color:#00c87c;
    font-weight: bold;
    margin-top: 30px;
    text-align: center;
    font-size: 30px;
}
#down-panel table{
	margin:55px auto 0 auto;
	width:640px;
	font-size:14px
}
#down-panel .close{
float:right;margin-right:10px;margin-top:5px;
	width:40px;
	cursor: pointer;
	height:40px;
	background:url(static/images/down-close.png) no-repeat;    filter: alpha(opacity=100);
    opacity:1;
}
#down-panel td{
   width:160px;
   text-align: center;
}
#down-panel .title td{
	color:#00c87c;
}
#down-panel .title img{
	height:150px;
}


#down-panel .pc{
	color:#008dff !important;
}
.erwei td{
	padding:25px;
}
.pc-down-btn{
	font-size: 14px;
	 border-radius: 5px;
	 background-color: rgb(0, 141, 255);
	 width: 126px;
	 color:white;
	 margin-top:20px;
	 text-align: center;
	 line-height:36px;
	 height: 36px;
}
.pc-down-btn:hover{
	 background-color: #219cff;
	 cursor: pointer;
}
.layui-layer{
	background:transparent !important;
}


</style>
<script>
function downapp(){

 var left=document.documentElement.clientWidth-750;

 left=left/2;


document.getElementById('down-panel').style.left=left+'px';

if(document.getElementById('down-panel').style.display=='none'){

document.getElementById('down-panel').style.display='block'
}
else{

document.getElementById('down-panel').style.display='none';
}

}


</script>



<div class="layui-layer-content"><div id="down-panel" style="display:none;" class="layui-layer-wrap">
	<div class="close" onclick='downapp();'></div>
	<div class="title">客户端下载</div>
	<table  >
		<tbody style='!important;'><tr class="title">
			<td style="font-size:30px;  background-color:#ebebeb; ">iPhone版</td>
			<td style="font-size:30px;background-color:#ebebeb;">Android版</td>
			<td style="font-size:30px;background-color:#ebebeb;">Wap版</td>
			<td class="pc" style="font-size:30px;background-color:#ebebeb;">PC客户端</td>
		</tr>
		<tr>
			<td style="font-size:14px; color:#282b2d  !important;background-color:#ebebeb;">扫描二维码下载</td>
			<td style="font-size:14px; color:#282b2d !important;background-color:#ebebeb;">扫描二维码下载</td>
			<td style="font-size:14px; color:#282b2d !important;background-color:#ebebeb;">扫描二维码访问</td>
			<td style="font-size:14px; color:#282b2d !important;background-color:#ebebeb;">点击开始下载</td>
		</tr>
		<tr class="erwei" >
			<td style='background-color:#ebebeb;'><img src="<!--{$con_system['qrcode1']|getFileUri}-->" style="width: 140px;"></td>
			<td style='background-color:#ebebeb;'><img src="<!--{$con_system['qrcode2']|getFileUri}-->" style="width: 140px;"></td>
			<td style='background-color:#ebebeb;'><img src="<!--{$con_system['qrcode3']|getFileUri}-->" style="width: 140px;"></td>
			<td style="vertical-align: top;background-color:#ebebeb;"><img src="static/images/pc-down.png" style="width: 100px;">
				<div class="pc-down-btn" onclick="location.href='<!--{$con_system['downpc']getFileUri}-->';">PC客户端</div></td>
		</tr>
	</tbody></table>
</div></div>