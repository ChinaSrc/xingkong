/*打印投注选项*/

function show_renxuan(num){


	var renxuan="<tr><td clospan='2'><div style='width:100%;display:block;height:40px;clear:both;'>"+
	"<span onclick='check_weis(0,"+num+");'  style='padding-left:8px;padding-right:8px;'><input type='checkbox' name='wei' value='1'  onclick='check_weis(0,"+num+");' >万位</span>" +
	"<span onclick='check_weis(1,"+num+");'  style='padding-left:8px;padding-right:8px;'><input type='checkbox' name='wei' value='1'  onclick='check_weis(1,"+num+");'  >千位</span>" +
	"<span onclick='check_weis(2,"+num+");' style='padding-left:8px;padding-right:8px;'><input type='checkbox' name='wei' value='1'  onclick='check_weis(2,"+num+");'  >百位</span>" +
	"<span onclick='check_weis(3,"+num+");'  style='padding-left:8px;padding-right:8px;'><input type='checkbox' name='wei' value='1'   onclick='check_weis(3,"+num+");'   >十位</span>" +
	"<span onclick='check_weis(4,"+num+");'  style='padding-left:8px;padding-right:8px;'><input type='checkbox' name='wei' value='1'  onclick='check_weis(4,"+num+");'  >个位</span>" +
	"<span style='padding-left:30px'>温馨提示：你选择了<div id='wei_num' style='color:#ff0000;display:inline;'>0</div>个位置，系统自动根据位置组合成 <div id='fangan_num' style='color:#ff0000;display:inline;'>0</div>个方案</span></div></td></tr>";

	return renxuan;

}


function check_weis(num,sum){
//	alert(num);
var 	wei=document.getElementsByName('wei');;


		if(wei[num].checked==true)
			wei[num].checked=false;
			else wei[num].checked=true;

	check_renxuan(sum);
}



//单式
function add_input_ds(plays,rebates){
	var playid=plays.playid;
	if(playid=='RXDS_5z2' || playid=='RXDS_zx5z2' || playid=='2R_2xzxfs' || playid.indexOf("2R") >-1){

		var renxuan=show_renxuan(2);

	}
	else  	if(playid=='RXDS_5z3' || playid=='RXDS_zx5z3' || playid.indexOf("3R") >= 0 ){

		var renxuan=show_renxuan(3);

	}
	else  	if(playid=='RXDS_5z4' || playid=='RXDS_zx5z4' || playid.indexOf("4R") >= 0 ){

		var renxuan=show_renxuan(4);

	}

	else  var renxuan='';
	var show_dialog="注意：每注号码间用一个 逗号[,] 或者 分号[;]  隔开 单式投注请用快捷键:CTRL+C复制,CTRL+V粘贴进行投注。</font>";
	if(gamekey.indexOf('11-5')>1 || gamekey.indexOf('PK10')>1){show_dialog+="<br>示例： 三码 01 02 03;02 03 04 任选 01 02 03 04 05";}
	var btns="<div class='input_ds_div' onclick='countinput()'>计算注数</div>";
	btns+="<div class='input_ds_div_del' onclick=\"Clear_Write()\">清空输入</div>";
	var dsHTML="<table width='100%' border='0' cellspacing='1' cellpadding='4' >"+renxuan+"<tr height=100>";
	if(mobile==1){


			dsHTML+="<td width=100%><input type='hidden' id='write_type' value=''/><textarea id='lt_write_box' name='lt_write_box' style='height:150px;width:98%;margin:0 auto;' onblur='countinput();' >";
	dsHTML+="</textarea><textarea id='lt_write_box_ok' name='lt_write_box_ok' style='display:none'></textarea>";
	dsHTML+="<input id='autocou' name='autocou' style='display:none' value='no'></td>";

	}
	else{
	dsHTML+="<td width=80%><input type='hidden' id='write_type' value=''/><textarea id='lt_write_box' name='lt_write_box' style='height:92px;width:98%;' onblur='countinput();' >";
	dsHTML+="</textarea><textarea id='lt_write_box_ok' name='lt_write_box_ok' style='display:none'></textarea>";1
	dsHTML+="<input id='autocou' name='autocou' style='display:none' value='no'></td>";
	dsHTML+="<td width=20%>"+btns+"</td>";
	}

	dsHTML+="</tr><tr valign=middle><td colspan=2 height=20 valign=top><div class='dialog_ds_div'>"+show_dialog+"</div></td></tr>";
	dsHTML+="</table>";
	G('lt_selector').innerHTML=dsHTML;
}



//推荐组合
function add_input_tjzh(plays,rebates){
	var playid=plays.playid;
	if(playid=='RXDS_5z2' || playid=='RXDS_zx5z2'  || playid.indexOf("2R") >= 0 ){

		var renxuan=show_renxuan(2);

	}
	else  	if(playid=='RXDS_5z3' || playid=='RXDS_zx5z3' || playid.indexOf("3R") >= 0 ){

		var renxuan=show_renxuan(3);;

	}
	else  	if(playid=='RXDS_5z4' || playid=='RXDS_zx5z4' || playid.indexOf("4R") >= 0 ){

		var renxuan=show_renxuan(4);;

	}

	else  var renxuan='';

	var url1=$("#do_url").val()+'?flag=yes&games='+gamekey+'&playid='+playid;
	url1+='&mod=jie_kou';
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content='&playid='+playid;

	ajaxobj.url=url1;
	ajaxobj.callback=function(xmlobj){
var response = xmlobj.responseText;
document.getElementById('xuan_values').innerHTML=response;

	}
	ajaxobj.send();


	var show_dialog="注意：每注号码间用一个 逗号[,] 或者 分号[;] 或者 空格[ ] 隔开 单式投注请用快捷键:CTRL+C复制,CTRL+V粘贴进行投注。</font>";
	if(gamekey.indexOf('11-5')>1){show_dialog+="<br>示例： 三码 01 02 03;02 03 04 任选 01 02 03 04 05";}
	var btns="<div class='input_ds_div' onclick='countinput()'>计算注数</div>";
	btns+="<div class='input_ds_div_del' onclick=\"Clear_Write()\">清空输入</div>";
	var dsHTML="";
	dsHTML+="<table width='100%' border='0' cellspacing='1' cellpadding='4' bgcolor='#333333'   style='display:none;'>"+renxuan+"<tr height=100>";
	dsHTML+="<td width=80%><input type='hidden' id='write_type' value='tjzh'/><textarea id='lt_write_box' name='lt_write_box' style='height:92px;width:98%;'   >";
	dsHTML+="</textarea><textarea id='lt_write_box_ok' name='lt_write_box_ok' style='display:none'></textarea>";
	dsHTML+="<input id='autocou' name='autocou' style='display:none' value='no'></td>";
	dsHTML+="<td width=20%>"+btns+"</td>";
	dsHTML+="</tr><tr valign=middle><td colspan=2 height=20 valign=top><div class='dialog_ds_div'>"+show_dialog+"</div></td></tr>";
	dsHTML+="</table><div id='xuan_values'><div>";
	G('lt_selector').innerHTML=dsHTML;
}


function click_values(div){
	if(div.checked){
	if(	document.getElementById('lt_write_box').innerHTML =='')
		document.getElementById('lt_write_box').innerHTML+=div.value;
	else
		document.getElementById('lt_write_box').innerHTML+=','+div.value;
	}

	else {

	document.getElementById('lt_write_box').innerHTML=document.getElementById('lt_write_box').innerHTML.replace(div.value,"");

	}
}


function get_wei_num(){
	var num=0;
	var wei=	document.getElementsByName('wei');
	for(var i=0;i<wei.length;i++)
	if(wei[i].checked)num++;
	return num;
}

function get_wei_value(){
	var value;

	var wei=	document.getElementsByName('wei');
	for(var i=0;i<wei.length;i++){
		if(wei[i].checked) var temp="1";
		else var temp='0';
		if(value) value+=','+temp;
		else value=temp;


	}

	return value;
}

function check_renxuan(type){

	var num=get_wei_num();
	if(type==2){

	document.getElementById('fangan_num').innerHTML=r2_num(num);
	}
	if(type==3){

		document.getElementById('fangan_num').innerHTML=r3_num(num);
		}
	if(type==4){

		document.getElementById('fangan_num').innerHTML=r4_num(num);
		}
	document.getElementById('wei_num').innerHTML=num;

	var check_num=0;

	var wei=document.getElementsByName('wei');

	for(var i=0;i<wei.length;i++){

		if(wei[i].checked==true) check_num++;

	}


	if(check_num>=type){

		for(var i=0;i<wei.length;i++){

		//	if(!wei[i].checked) wei[i].disabled=true;

		}


	}
	else{
	for(var i=0;i<wei.length;i++){

			// wei[i].disabled=false;

		}


	}





	Count_Money();
}
function uploadfile(){
	//var do_url=$("#do_url").val();
	winPop({title:'导入数据',width:'460',height:'140',drag:'true',url:$("#do_url").val()+'?mod=upload&flag=yes&games='+gamekey+'&playid='+playlist.playid+''});
}

function  get_lou(gamekey,playid,thistitles){

	var lou_id='lou_'+thistitles;
	//alert(document.getElementById('lou_1').innerHTML);

	//G(lou_id).innerHTML='11';

}




//趣味玩法

function add_input_qw(plays,rebates){
	var playid=plays.playid;var thisids="";
    play_id=playid;

	var show_keys=plays.show_key;
    var keylist;var keystr="";var htmlstr="";var n_css;var keytitle;var sele_list= new Array;
	var keys=show_keys.split("~");
	//console.log(plays);

	var bodyHTML="";var keylengs=0;var keycss="select_list_no";
	var titles=plays.title.split("|");
	var prize=plays.prize.split("|");
	var max_select=plays.max_select.split("|");
	if(window.ActiveXObject){
		var xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest){
		var  xmlHttp = new XMLHttpRequest();
	}
	if(titles.length>1) var buy=plays.title;
	else  var buy=show_keys;
	var  url="do.aspx?mod=ajax&code=get&list=data&action=lou&flag=yes&gamekey="+gamekey+"&playid="+playid+"&value="+encodeURI(buy);
	var loading="<div style='width:100%;text-align:center;'></div>";

	G('lt_selector').innerHTML=loading;
	//xmlHttp.open('GET',url,true);
	//xmlHttp.onreadystatechange=function(){



//		if(xmlHttp.readyState==1){
//			G('lt_selector').innerHTML=loading;
//		}
//		if(xmlHttp.readyState==4){
//		var response=xmlHttp.responseText;
//
				//var lou=response.split("|");
				for (i=0;i<keys.length;i++){
					if(titles[i]){select_title_css="select_title_span";}else{select_title_css="select_title_css";}
					bodyHTML+="<div id='xcaiconter' class='xcaiconter xcaiconter3'>";
					keylist=keys[i].split("|");
			        keylengs=keylist.length;

					for (j=0;j<keylengs;j++){
						thisids=keylist[j];
						thistitles=titles[j];

						if(titles.length>1)
							var str1='<span class="kkls"><b >'+thistitles+'</b><label class="hui">('+thisids+')</label></span><input type="hidden" name="title_name" value="'+thistitles+'"/>';
						else
							var str1='<span class="kkls"><b >'+thisids+'</b></span><input type="hidden" name="title_name" value="'+thisids+'"/>';
						if(prize.length>1)  var pri=prize[j];
						else var pri=plays.prize;

						if(max_select.length>1)  var max=max_select[j];
						else var max=plays.max_select;
						if(max>0) var max_html='<label class="hui"  style="display:none;" >限'+max+'</label>';
						else var max_html='';
			            var lou_id='lou_'+j;
			            if(gametype=='k3') var pri_str=pri;else var pri_str=pri/2;
			            pri_str=parseFloat(pri_str).toFixed(3).replace(/[.]?0+$/g,"");
						bodyHTML+='<div class="kk "  id="kk_'+j+'"  onclick="CheckTxt22(\''+playid+'\',\''+j+'\');" >'
						+'<span id="max_select_'+j+'" style="display:none;">'+max+'</span>'
						+'<p class="kk1">'+str1
						+'<input  style="display:none;" id="'+playid+'-'+j+'" name="TouZhuMoneys" type="text" value="" onkeyup="CheckTxt11(this,\''+j+'\');CheckTxt(this);" onblur="CheckTxt11(this,\''+j+'\');CheckTxt(this);" >'
						+'<input name="etNums" type="hidden" value=""> <input  style="display:none;" name="prize_qw11" type="text" value="'+pri+'"></p>'
						+'<p class="kka"><span >赔率<span name="prize_qw">'+pri_str+'</span></span>'+max_html+'</p>';
						//bodyHTML+='<p><span class="hui">漏<span id="'+lou_id+'">'+lou[j]+'</span></span></p>';
						bodyHTML+='</div>';

					}
					bodyHTML+="</div>";
				}

				G('lt_selector').innerHTML=bodyHTML;

		//}


	//};
	//xmlHttp.send(null);





}



function countinput(p_lines){



	//var do_url=$("#do_url").val();
	var p_lines = $('#lt_write_box').val();

	var url1=$("#do_url").val()+'?flag=yes&games='+gamekey+'&playid='+playlist.playid;
	if(playlist.playid=='RXDS_5z2' || playlist.playid=='RXDS_zx5z2'){
			var wei_value=get_wei_value();
	var wei_num=get_wei_num();
	var bei_num=r2_num(get_wei_num());
	url1+='&wei_value='+wei_value+'&wei_num='+wei_num+'&bei_num='+bei_num;
		}
			if(playlist.playid=='RXDS_5z3' || playlist.playid=='RXDS_zx5z3'){
			var wei_value=get_wei_value();
	var wei_num=get_wei_num();
	var bei_num=r3_num(get_wei_num());
	url1+='&wei_value='+wei_value+'&wei_num='+wei_num+'&bei_num='+bei_num;
		}
			if(playlist.playid=='RXDS_5z4' || playlist.playid=='RXDS_zx5z4'){
			  wei_value=get_wei_value();
	var wei_num=get_wei_num();
	var bei_num=r4_num(get_wei_num());
	url1+='&wei_value='+wei_value+'&wei_num='+wei_num+'&bei_num='+bei_num;
		}

		if(p_lines.length>0){

			if(playlist.playid.indexOf('5X')>-1 || playlist.playid.indexOf('4X')>-1 || playlist.playid=='RXDS_5z4'){
				 p_lines = p_lines.replace(/ /g, ',');
				 p_lines = p_lines.replace(/;/g, ',');
				 p_lines = p_lines.replace(/；/g, ',');
				 p_lines = p_lines.replace(/，/g, ',');
				 p_lines = p_lines.replace(/\r\n/g, ',');

				 var lines=5;

				var content=p_lines.split(",");

				var sum=0; var str='';var error='';
				for(var i=0;i<content.length;i++){
					if(playlist.playid.indexOf('5X')>-1)
				var preg=/^\d{5}$/;

					else var preg=/^\d{4}$/;
				  if(preg.test(content[i])){
				      if(str=='')str=content[i];
				      else str+=','+content[i];

					  sum++;
				    }

				  else {
					  if(error=='')error=content[i];
				      else error+=','+content[i];


				  }




				}
				 if(playlist.playid=='RXDS_5z4') {
					// sum=sum*bei_num;
					// alert(wei_num);
					 }


				document.getElementById("base_num").value=sum;
				document.getElementById('lt_sel_nums').innerHTML=sum;

				box_old=document.getElementById('lt_write_box').value=str;
				document.getElementById('lt_write_box_ok').value=str;
				document.getElementById('lt_sel_counts').click();
				Count_Money();

				if(error!='') alert("计算完毕!去除重复，共计"+num+"注");


			}

			else{
				url1+='&mod=countinput_p';
				ajaxobj=new AJAXRequest;
				ajaxobj.method="POST";
				ajaxobj.content='&contents='+p_lines;

				ajaxobj.url=url1;
				ajaxobj.callback=function(xmlobj){
			var response = xmlobj.responseText;


			var s=response.split("|");
			document.getElementById("base_num").value=s[1];
			document.getElementById('lt_sel_nums').innerHTML=s[1];

			box_old=document.getElementById('lt_write_box').value=s[2];
			document.getElementById('lt_write_box_ok').value=s[2];
			document.getElementById('lt_sel_counts').click();
			Count_Money();
			if(s[3]>0)
		     alert(s[0]);
				//setTimeout("show_bg('none','')",1000) ;
				}
				ajaxobj.send();


			}

		}
		else{

			Count_Money();
			url1+='&mod=countinput&contents='+p_lines;
	       //	winPop({title:'计算注数',width:'400',height:'150',drag:'true',url:url1});


		}


//winPop({title:'计算注数',width:'400',height:'120',drag:'true',sContent:response});

	//winPop({title:'计算注数',width:'400',height:'120',drag:'true',url:url1});
}
function add_input_key(plays,rebates){


	var playid=plays.playid;var thisids="";
	var show_keys=plays.show_key;
if(playid=='RXHZ_5z2' || playid=='RXHZ_zx5z2' || playid=='2R_2xzxfs' || playid.indexOf("2R") >-1 ){

		var renxuan=show_renxuan(2);

	}
	else
		if(playid=='RXHZ_5z3' || playid=='RXHZ_zx5z3' || playid.indexOf("3R") >= 0 ){

			var renxuan=show_renxuan(3);;

		}
		else 	if(playid=='RXHZ_5z4' || playid=='RXHZ_zx5z4' || playid.indexOf("4R") >= 0 ){

			var renxuan=show_renxuan(4);;

		}
	else  var renxuan='';
    var keylist;var keystr="";var htmlstr="";var n_css;var keytitle;var sele_list= new Array;
	var keys=show_keys.split("~");
	var bodyHTML="";var keylengs=0;var keycss="select_list_no";
	var titles=plays.title.split("|");
	var bodyHTML="<div id='div_other_0' class='select_div_line'>"+renxuan+"</div>";
	for (i=0;i<keys.length;i++){
		if(titles[i]){select_title_css="select_title_span";}else{select_title_css="select_title_css";}
		if(gamekey=='3D' || gamekey=='PL3'){
			if(titles[i]=='万位') titles[i]='百位';
			if(titles[i]=='千位') titles[i]='十位';
			if(titles[i]=='百位' && i==2) titles[i]='个位';
		}
		if(mobile==1 && titles[i]=='号码'){

			var display="style='display:none'";
		}else{

			var display='';
		}

		bodyHTML+="<div id='div_key_"+i+"' class='select_div_line'><span id='title_"+i+"' class='"+select_title_css+"' "+display+">"+titles[i]+"</span>";
		keylist=keys[i].split("|");
        keylengs=keylist.length;
		if(keylengs-4>=0){keycss="select_list_5_no";}
		if(keylengs-3==0){keycss="select_list_5_no";}
		if(keylengs-2==0){keycss="select_list_5_no";}
		for (j=0;j<keylengs;j++){
			if((playid=="QWX2_sxp") || (playid=="QWX2_jep")){thisids=""+keylist[j].substr(0,1);}else{thisids=keylist[j];}
			bodyHTML+="<span id='select_"+i+"_"+j+"' class='"+keycss+"' onclick=\"SelectNum('"+i+"','"+j+"')\">"+thisids+"</span>";
		}
        if(mobile==1)
            bodyHTML+="<div class='hr'></div>"
		bodyHTML+="</div>";
	}

	G('lt_selector').innerHTML=bodyHTML;
	return i;
}
function add_input_other(plays,rebates){

	var playid=plays.playid;
	var keys=plays.show_other.split("|");
	if(playid=='RXHZ_5z2' || playid=='RXHZ_zx5z2' || playid=='2R_2xzxfs'  ||  playid.indexOf("2R") >-1 ){

		var renxuan=show_renxuan(2);

	}
	else
		if(playid=='RXHZ_5z3' || playid=='RXHZ_zx5z3' || playid.indexOf("3R") >= 0 ){

			var renxuan=show_renxuan(3);;

		}
		else 	if(playid=='RXHZ_5z4' || playid=='RXHZ_zx5z4' || playid.indexOf("4R") >= 0 ){

			var renxuan=show_renxuan(4);;

		}
	else  var renxuan='';
	if(plays.title){var select_title_css="select_title_span";}else{var select_title_css="select_title_css";}
	var bodyHTML="<div id='div_other_0' class='select_div_line'>"+renxuan+"<span id='title_0' class='"+select_title_css+"'>"+plays.title+"</span>";
	var mins=parseInt(keys[0]);var maxs=parseInt(keys[keys.length-1]);

	for (i=mins;i<=maxs;i++){

		if(i-14==0){bodyHTML+="</div><div class='select_div_line'><span id='title_0' class='select_title_css'>&nbsp;</span>";}
		bodyHTML+="<span id='select_0_"+i+"' class='select_list_no' onclick=\"SelectNum('0','"+i+"')\">"+i+"</span>";
	}
	bodyHTML+="</div>";
	G('lt_selector').innerHTML=bodyHTML;
}

function add_input_shownum(plays,rebates,nums){


	var playid=plays.playid;
	var shownum=parseInt(plays.shownum,10);
	var minnum=parseInt(plays.minnum,10);
	var maxnum=parseInt(plays.maxnum,10);
	var max_select=plays.max_select;
	var min_select=plays.min_select;
    var thisids="";var bodyHTML="";var select_title_css="";
	var titles=plays.title.split("|");

	if(gamekey.indexOf('KL8')>1){
		var len=playid.substr(playid.length-1,1);
		if(len=='0') len=10;
		    var i=0
			bodyHTML+="<span id='title_"+i+"' class='select_title_kl8'>"+titles[0]+"</span><div id='div_show_"+i+"' class='select_div_line'>";
			for (j=minnum;j<=40;j++){
				thisids=j;
				if(maxnum-10>0){if(j-10<0){thisids="0"+j;}}
				bodyHTML+="<span id='select_"+i+"_"+j+"' class='select_list_no' onclick=\"SelectNum('"+i+"','"+j+"')\">"+thisids+"</span>";

				if(j%20==0) bodyHTML+='<br>';
			}
			bodyHTML+="</div>";
			var i=0
			bodyHTML+="<span id='title_"+i+"' class='select_title_kl8'>"+titles[1]+"</span><div id='div_show_"+i+"' class='select_div_line'>";
			for (j=41;j<=maxnum;j++){
				thisids=j;
				if(maxnum-10>0){if(j-10<0){thisids="0"+j;}}
				bodyHTML+="<span id='select_"+i+"_"+j+"' class='select_list_no'  onclick=\"SelectNum('"+i+"','"+j+"')\">"+thisids+"</span>";
				if(j%20==0) bodyHTML+='<br>';
			}
			bodyHTML+="</div>";

		bodyHTML+="<div id='div_"+i+"' >";
		bodyHTML+="<span class='select_title_kl8' id='rands' onclick=\"Select_QwAuto('all','all',"+len+")\">机选一注</span>";
		//bodyHTML+="<span class='select_title_kl8' id='Intes' onclick=\"Show_QwAuto(this)\">趣味机选</span>";
		bodyHTML+="<span class='select_title_kl8' id='clears' onclick=\"selectMore('0','dell','1','1','80')\">清</span><span>&nbsp;</span>";
		bodyHTML+="</div>";

		var innerHTML="<div>";

		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('up','all',8)\">上</span>";
		innerHTML+="<span class='select_title_kl8' onclick=\"Select_QwAuto('all','sin',8)\">单</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('up','sin',8)\">上.单</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('up','dou',8)\">上.双</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('all','all',8)\">混合</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('down','all',8)\">下</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('all','dou',8)\">双</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('down','sin',8)\">下.单</span>";
		innerHTML+="<span class='select_title_kl8'  onclick=\"Select_QwAuto('down','dou',8)\">下.双</span>";
		innerHTML+="</div>";
		bodyHTML+=innerHTML;

	}else{


		var listnum=parseInt(nums,10);var semorenum=0;
		var beginnum=0;var endnum=shownum;
		if(listnum-1>=0){beginnum=listnum;endnum=shownum+listnum;}else{beginnum=0;endnum=shownum;}
		for (i=beginnum;i<endnum;i++ )
		{
			if(titles[i]){select_title_css="select_title_span";}else{select_title_css="select_title_css";}
			if(gamekey=='3D' || gamekey=='PL3' || gamekey=='LF3d'){
				if(titles[i]=='万位') titles[i]='百位';
				if(titles[i]=='千位') titles[i]='十位';
				if(titles[i]=='百位' && i==2) titles[i]='个位';
			}


			bodyHTML+="<div id='div_show_"+i+"' class='select_div_line'>";
     if(mobile=='1'){
     select_title_css="select_title_span1";
			if(titles[i]) bodyHTML+="<span id='title_"+i+"' class='"+select_title_css+" '>"+titles[i]+"</span>";

			else  bodyHTML+="<span id='title_"+i+"' class='"+select_title_css+"'>选号</span>";
             bodyHTML+="<hr>";

            }

            else{
            bodyHTML+="<span id='title_"+i+"' class='"+select_title_css+"'>"+titles[i]+"</span>";
            }
			for (j=minnum;j<=maxnum;j++){
				thisids=j;
				if(maxnum-10>=0){if(j-10<0){thisids="0"+j;}}
				bodyHTML+="<span id='select_"+i+"_"+j+"' class='select_list_no' onclick=\"SelectNum('"+i+"','"+j+"')\">"+thisids+"</span>";
			}
			if(playid=="RXDT_8z5"){semore="no";semorenum=beginnum+1;}
			if(playid=="RXDT_7z5"){semore="no";semorenum=beginnum+1;}
			if(playid=="RXDT_6z5"){semore="no";semorenum=beginnum+1;}
			if(playid=="RXDT_5z5"){semore="no";semorenum=beginnum+1;}
			if(playid=="RXDT_4z4"){semore="no";semorenum=beginnum+1;}
			if(playid=="3M_zxdt" || playid=="3M2_zxdt" || playid=="3M_zhxdt" || playid=="3M2_zhxdt" || playid=="RXDT_3z3"){semore="no";semorenum=beginnum+1;}
			if(playid=="2M_zxdt" || playid=="2M2_zxdt" || playid=="2M_zhxdt" || playid=="2M2_zhxdt" || playid=="RXDT_2z2"){semore="no";semorenum=beginnum+1;}

			if(i-semorenum>=0){
				bodyHTML+="<div class='play_tools'>";
				bodyHTML+="<span class='input_select_more' id='do_"+i+"' onclick=\"selectMore('"+i+"','0')\">全</span>";
				bodyHTML+="<span class='input_select_more' id='do_"+i+"' onclick=\"selectMore('"+i+"','1')\">大</span>";
				bodyHTML+="<span class='input_select_more' id='do_"+i+"' onclick=\"selectMore('"+i+"','2')\">小</span>";
				bodyHTML+="<span class='input_select_more' id='do_"+i+"' onclick=\"selectMore('"+i+"','3')\">奇</span>";
				bodyHTML+="<span class='input_select_more' id='do_"+i+"' onclick=\"selectMore('"+i+"','4')\">偶</span>";
				bodyHTML+="<span class='input_select_more' id='do_"+i+"' onclick=\"selectMore('"+i+"','del')\">清</span>";
				bodyHTML+="</div>";
							}
							else{
                if(mobile==1)
                bodyHTML+="<div class='hr'></div>"

			}


			bodyHTML+="</div>";
		}//alert(bodyHTML);return false;
	}
	G('lt_selector').innerHTML+=bodyHTML;
}



//二同号单选

function  add_input_2th_dx(plays,rebates){

	var playid=plays.playid;
	var keys=plays.show_other.split("|");
	if(playid=='RXHZ_5z2' || playid=='RXHZ_zx5z2' || playid=='2R_2xzxfs' || playid.indexOf("2R") >-1 ){

		var renxuan=show_renxuan(2);;

	}
	else
		if(playid=='RXHZ_5z3' || playid=='RXHZ_zx5z3' || playid.indexOf("3R") >= 0 ){

			var renxuan=show_renxuan(3);;

		}
		else 	if(playid=='RXHZ_5z4' || playid=='RXHZ_zx5z4' || playid.indexOf("4R") >= 0 ){

			var renxuan=show_renxuan(4);;

		}
	else  var renxuan='';
	if(plays.title){var select_title_css="select_title_span";}else{var select_title_css="select_title_css";}
	var bodyHTML="<div id='div_other_0' class='select_div_line'>"+renxuan+"<span id='title_0' class='"+select_title_css+"'>"+plays.title+"</span>";
	var mins=keys[0];var maxs=keys[keys.length-1];
	for (i=mins;i<=maxs;i++){
		if(i-15==0){bodyHTML+="</div><div class='select_div_line'><span id='title_0' class='select_title_css'>&nbsp;</span>";}
		bodyHTML+="<span id='select_0_"+i+"' class='select_list_no' onclick=\"SelectNum('0','"+i+"')\">"+i+"</span>";
	}
	bodyHTML+="</div>";
	G('lt_selector').innerHTML=bodyHTML;




}
















function SelectNum(rows,lines){
	var shownum=parseInt(playlist.shownum,10);
	var minnum=parseInt(playlist.minnum,10);
	var maxnum=parseInt(playlist.maxnum,10);
	var max_select=parseInt(playlist.max_select,10);
	var min_select=parseInt(playlist.min_select,10);
	var playid=playlist.playid;

	//alert(playid);



	var Obj;var Objs;var firstint;var is_cur=0;var lastcss="";

	if(playlist.show_other.indexOf("|")>0){
		var arrs=playlist.show_other.split("|");
		minnum=arrs[0];
		maxnum=arrs[arrs.length-1];
	}
	if(playlist.show_key.indexOf("|")>0){
		var arrs=playlist.show_key.split("|");
		minnum=0;
		maxnum=arrs.length-1;
	}
	if(gamekey.indexOf('KL8')>1){
		if(playid.indexOf("XX_rx")>0 && playid!="RXX_rx1"){max_select=8;}
		if( playid=="RXX_rx1"){max_select=15;}
	}
	var is_yes=0;var dantuo_s="";var tuo_num=0;var dan_num=0;


	if(playid=="RXDT_8z5"){if(rows=="0"){max_select=7;}dantuo_s="yes";}
	if(playid=="RXDT_7z5"){if(rows=="0"){max_select=6;}dantuo_s="yes";}
	if(playid=="RXDT_6z5"){if(rows=="0"){max_select=5;}dantuo_s="yes";}
	if(playid=="RXDT_5z5"){if(rows=="0"){max_select=4;}dantuo_s="yes";}
	if(playid=="RXDT_4z4"){if(rows=="0"){max_select=3;}dantuo_s="yes";}
	if(playid=="3M_zxdt" || playid=="3M2_zxdt" || playid=="3M_zhxdt" || playid=="3M2_zhxdt" || playid=="RXDT_3z3"){if(rows=="0"){max_select=2;}dantuo_s="yes";}
	if(playid=="2M_zxdt" || playid=="2M2_zxdt" || playid=="2M_zhxdt" || playid=="2M2_zhxdt" || playid=="RXDT_2z2"){if(rows=="0"){max_select=1;}dantuo_s="yes";}

	if(playid=="RXFS_fs5z2" || playid=="RXFS_fs5z3" || playid=="RXFS_fs5z4"){if(rows=="0"){max_select=15;}dantuo_s="no";}
	if(playid=="RXHZ_5z2" || playid=="RXHZ_5z3" || playid=="RXHZ_5z4"){if(rows=="0"){max_select=15;}dantuo_s="no";}

if(playid=='2BT-dt') {if(rows=="0"){max_select=1;}dantuo_s="yes";}
if(playid=='3BT-dt' || playid.indexOf('_dt')>0 || playid.indexOf('_z6dt')>0 ) {if(rows=="0"){max_select=2;}dantuo_s="yes";}
    if(G("select_"+rows+"_"+lines)){
		Objs=G("select_"+rows+"_"+lines);
		lastcss=Objs.className;
		if(Objs.className.indexOf("cur")>0){

			Objs.className=Objs.className.substr(0,Objs.className.length-4);

		}else{
			if(max_select-1>=0){
				for (i=minnum;i<=maxnum;i++){
					Obj=G("select_"+rows+"_"+i);
					if(Obj){
						if(Obj.className.indexOf("cur")>0){
							is_cur+=1;
							if(is_cur-max_select>=0){
								Obj.className=Obj.className.substr(0,Obj.className.length-4);
							}
						}
					}
				}
			}
			Objs.className=Objs.className+"_cur";



			if(dantuo_s=="yes"){
				var others="";
				if(rows=="0"){others="1";}
				if(rows=="1"){others="0";}
				if(G("select_"+others+"_"+lines)){
					Objs=G("select_"+others+"_"+lines);
					if(Objs.className.indexOf("cur")>0){Objs.className=Objs.className.substr(0,Objs.className.length-4);}
				}
			}


			if(playid=='2TH-dx'  || playid=='2BT-dt'  || playid=='3BT-dt'){
				if(rows==1)
				var rows1=parseInt(rows)-1;
				else var rows1=parseInt(rows)+1;
				var Objs1=G("select_"+rows1+"_"+lines);
				if(Objs1.className.indexOf("cur")>0){
				Objs1.className=Objs1.className.substr(0,Objs1.className.length-4);
				}

			}
		}
	}
    count_select_arr();
/*
	if(G("select_"+rows+"_"+lines)){
		Obj=G("select_"+rows+"_"+lines);
		if(Obj.className.indexOf("cur")>0){Obj.className=Obj.className.substr(0,Obj.className.length-4);}else{Obj.className=Obj.className+"_cur";}
	}

*/
	return false;
	count_select(shownums,minnums,maxnums);
}
//G("lt_sel_insert").onclick=function(){addSelec t(uids,skeys,fullnames,codes,shownums,show_keys,show_others,max_selects,min_selects,minnums,maxnums)};


var box_old='';

function Clear_Write(){

	box_old='';
	G('lt_write_box').value="";
	sel_num=G('lt_sel_nums').innerHTML='0';
	sel_money=G('lt_sel_money').innerHTML='0';
	//Write_Num()
}


function Add_QwAuto(){
	var innerHTML;
	if(G('lt_RXX_div')){
		innerHTML="<table width=220 border='0' cellpadding='2' cellspacing='2' bgcolor='#526172' align=center>";
		innerHTML+="<tr align=right bgcolor='#546374' height=5><td colspan=5><font color='#FFFFFF'><b>趣味机选（每次选取8个号码）&nbsp;";
		innerHTML+="<span onclick=\"G('lt_RXX_div').style.display='none';G('Intes').className='select_title_span_kl8';\">&nbsp;X&nbsp;</span></b></font></td></tr>";
		innerHTML+="<tr align=center bgcolor='#FFFFFF' height=5><td onclick=\"Select_QwAuto('up','all',8)\">上</td>";
		innerHTML+="<td onclick=\"Select_QwAuto('all','sin',8)\">单</td>";
		innerHTML+="<td onclick=\"Select_QwAuto('up','sin',8)\">上.单</td>";
		innerHTML+="<td onclick=\"Select_QwAuto('up','dou',8)\">上.双</td>";
		innerHTML+="<td rowspan=2 onclick=\"Select_QwAuto('all','all',8)\">混合</td></tr>";
		innerHTML+="<tr align=center bgcolor='#FFFFFF' height=5><td onclick=\"Select_QwAuto('down','all',8)\">下</td>";
		innerHTML+="<td onclick=\"Select_QwAuto('all','dou',8)\">双</td>";
		innerHTML+="<td onclick=\"Select_QwAuto('down','sin',8)\">下.单</td>";
		innerHTML+="<td onclick=\"Select_QwAuto('down','dou',8)\">下.双</td></tr>";
		innerHTML+="</table>";
		innerHTML+="";
		G('lt_RXX_div').innerHTML=innerHTML;
	}
}
function Show_QwAuto(vthis){
	if(vthis.className=='select_title_span_kl8_cur'){
		G('lt_RXX_div').style.display='none';vthis.className='select_title_span_kl8';
	}else{
		Add_QwAuto();pop_show(event,'lt_RXX_div','','');vthis.className='select_title_span_kl8_cur';
	}
}
function Select_QwAuto(active,dansuang,len){//Select_QwAuto('up|down|all','sin|dou|all')
	selectMore('0','del');
	var begin_n=0;var end_n=0;var P_list= new Array();var T_num=0;//sele_list.push(j);
	if(active=="up"){begin_n=1;end_n=40;}
	if(active=="down"){begin_n=41;end_n=80;}
	if(active=="all"){begin_n=1;end_n=80;}
	while (P_list.length-len<0)
	{
		T_num=GetRandomNumber(end_n,begin_n);var is_yes="no";
		if(dansuang=="sin"){if(T_num%2==1){is_yes="yes";}}
		if(dansuang=="dou"){if(T_num%2==0){is_yes="yes";}}
		if(dansuang=="all"){is_yes="yes";}
		if(is_yes=="yes"){
			P_list.push(T_num);
		}
		P_list=filterArray(P_list);
	}
	for (i=0;i<P_list.length;i++)
	{
		G("select_0_"+P_list[i]).className="select_list_no_cur";
	}
	count_select_arr()
}
function selectMore(items,skey){
	var shownum=parseInt(playlist.shownum,10);
	var minnum=parseInt(playlist.minnum,10);
	var maxnum=parseInt(playlist.maxnum,10);
	var max_select=parseInt(playlist.max_select,10);
	var min_select=parseInt(playlist.min_select,10);
	var playid=playlist.playid;
	for(i=minnum;i<=maxnum;i++){G("select_"+items+"_"+i).className="select_list_no";}
	var middle=(maxnum-minnum)/2+(minnum);
	var mid_begin=(middle.toFixed(0));var mid_end=(middle.toFixed(0))-1;
	if (skey=="0"){for(i=minnum;i<=maxnum;i++){G("select_"+items+"_"+i).className="select_list_no_cur";}}
	if (skey=="1"){for(i=mid_begin;i<=maxnum;i++){G("select_"+items+"_"+i).className="select_list_no_cur";}}
	if (skey=="2"){for(i=minnum;i<=mid_end;i++){G("select_"+items+"_"+i).className="select_list_no_cur";}}
	if (skey=="3"){for(i=minnum;i<=maxnum;i++){if(i%2==1){G("select_"+items+"_"+i).className="select_list_no_cur";}}}
	if (skey=="4"){for(i=minnum;i<=maxnum;i++){if(i%2==0){G("select_"+items+"_"+i).className="select_list_no_cur";}}}
	if (skey=="5"){var nums=GetRandomNumber(maxnum,minnum); G("select_"+items+"_"+nums).className="select_list_no_cur";}
	if (skey=="6"){for(i=minnum;i<=maxnum;i++){if(i%2==0){G("select_"+items+"_"+i).className="select_list_no_cur";}}}
	if (skey=="del"){for(i=minnum;i<maxnum;i++){G("select_"+items+"_"+i).className="select_list_no";}}
    var yescss=get_css(G("select_0_"+minnum).className,'check');var nocss=get_css(G("select_0_"+minnum).className,'nocheck');
	if(playid=="3M_zxdt" || playid=="2M_zxdt" || playid=="RXDT_2z2" || playid=="RXDT_3z3" || playid=="RXDT_4z4" || playid=="RXDT_5z6" || playid=="RXDT_6z5" || playid=="RXDT_7z5" || playid=="RXDT_8z5"){
		if(items=="0"){var thisitem="1";}else{var thisitem="0";}
		for (j=minnum;j<=maxnum;j++){if(G("select_"+items+"_"+j).className==yescss){G("select_"+thisitem+"_"+j).className=nocss;}}
    }
	count_select_arr();
}
function get_css(lastcss,isyes){ //get_css(lastcss,"nocheck")
	var next_css="";var check_css="";var no_check="";
	if(lastcss.indexOf("cur")>0){
		next_css=lastcss.substr(0,lastcss.length-4);
		check_css=lastcss;
		no_check=lastcss.substr(0,lastcss.length-4);
	}else{
		next_css=lastcss+"_cur";
		check_css=lastcss+"_cur";
		no_check=lastcss;
	}
	if(isyes=="check"){return check_css;}else if(isyes=="nocheck"){return no_check;}else{return next_css;}
}
//获取随机数
function GetRandomNumber(maxnums,minnums){
	var nums=parseInt(Math.random()*(maxnums-minnums+1))+minnums;
	return nums;
}
//清除数组中某个数值 isok
function drop_array_lines(arr,num){
	var drop_arr=new Array();
	for(o=0;o<arr.length;o++){
		if(parseInt(arr[o],10)-parseInt(num,10)==0){

		}else{
			drop_arr.push(arr[o]);
		}
	}
	return drop_arr;
}
function C_list(n,m){//n个数字，每m个组成一组
	//11!/(11-4)! * 4!
	var up_count=1;var down_count_a=1;var down_count_b=1;var down_count=0;var re_num=0;
	for (i=1;i<=n;i++){up_count=up_count*i;}
	for (j=1;j<=n-m;j++){down_count_a=down_count_a*j;}
	for (a=1;a<=m;a++){down_count_b=down_count_b*a;}
	down_count=down_count_a*down_count_b
	re_num=up_count/down_count;
	return parseInt(re_num);
}
//自由移动
zzjs_net=function (btn,bar,title){
    this.btn=document.getElementById(btn);
    this.bar=document.getElementById(bar);
    //this.title=document.getElementById(title);
    this.step=this.bar.getElementsByTagName("DIV")[0];
    this.init();
};
zzjs_net.prototype={
    init:function (){
        var f=this,g=document,b=window,m=Math;
        f.btn.onmousedown=function (e){
            var x=(e||b.event).clientX;
            var l=this.offsetLeft;
            var max=f.bar.offsetWidth-this.offsetWidth;
            g.onmousemove=function (e){
                var thisX=(e||b.event).clientX;
                var to=m.min(max,m.max(-2,l+(thisX-x)));
                f.btn.style.left=to+'px';
                f.ondrag(m.round(m.max(0,to/max)*100),to);
                b.getSelection ? b.getSelection().removeAllRanges() : g.selection.empty();
           };
           g.onmouseup=new Function('this.onmousemove=null');
        };
     },
     ondrag:function (pos,x){
        this.step.style.width=Math.max(0,x)+'px';
        //G('CurMode').innerHTML=pos+'%';
		JsAutoModeValue(pos);
     }
}
function selectMode(vthis){
	if(vthis.value=="auto"){
		G('SelectAutoMode').style.display="";
		var AutoModelong=selplay.AutoModeNum;
		var AutoModeNum=AutoModelong.substr(0,4);
		selplay.CurModeType="auto";
		document.cookie="CurModeType=auto";
		document.cookie="CurMode="+AutoModeNum+"";
		//G('CurMode').innerHTML=AutoModeNum;
		//var step=G('bar').getElementsByTagName("DIV")[0];
		//step.style.width=0+'px';
		//G('btn').style.left=0+'px';
		resetAutoMode()
	}else{
		var this_modes=0;
		if(G('SelectAutoMode')){G('SelectAutoMode').style.display="none";}
		if(parseInt(vthis.value,10)-1930>=0){this_modes=vthis.value;}else{this_modes=ArrFixModes[0];}
		selplay.CurModeType="fix";
		selplay.CurMode=this_modes;
		G('CurMode').innerHTML=this_modes;
		document.cookie="CurModeType=fix";
		document.cookie="CurMode="+this_modes+"";
	}
}
//获取返点和奖金
function JsAutoModeValue(vpos){
	var ns=parseInt(vpos,10);
	var MinBonus=parseInt(selplay.MinBonus,10);
	var rebate=parseFloat(rearr[selplay.retype],10);
	var prize=parseInt(arrPlayPri[playlist.playid]['1930'],10);
	if(rebate-0.1>=0){
		var minMode=1930;
		var maxMode=minMode+rebate*20;
		$("#maxmode").html(maxMode);
		$("#minmode").html(minMode);
		var thisMode=(maxMode-minMode)*ns/100+minMode;
		var curMode=thisMode.toFixed(0);
		if(parseInt(curMode,10)%2==1){thisMode=parseInt(curMode,10)+1;}else{thisMode=parseInt(curMode,10);}
		var thisRebate=rebate-((thisMode-minMode)/20);
		var thisPrize=(prize/minMode)*thisMode;
		thisRebate=thisRebate.toFixed(1);
		thisPrize=thisPrize.toFixed(2);
		G('CurMode').innerHTML=thisMode+"/"+thisRebate;
		if(thisMode-1930>=0){
			document.cookie="CurModeType=auto";
			document.cookie="CurMode="+thisMode+"";
			document.cookie="AutoModeNum="+thisMode+"";
			selplay.CurModeType="auto";
			selplay.AutoModeNum=thisMode;

		}
	}else{
		var minMode=1930;
		var maxMode=1930;
		var thisMode=1930;
		$("#maxmode").html(maxMode);
		$("#minmode").html(minMode);

	}
	if(thisMode-1930>=0){
		document.cookie="CurModeType=auto";
		document.cookie="CurMode="+thisMode+"";
		document.cookie="AutoModeNum="+thisMode+"";
		selplay.CurModeType="auto";
		selplay.AutoModeNum=thisMode;

	}
}
function creatModeSelect(){
	jQuery("#primode").empty();
	if(isFixModes=="yes"){
		for (i=0;i<ArrFixModes.length;i++)
		{
			jQuery("#primode").append("<option value='"+ArrFixModes[i]+"'>"+ArrFixModes[i]+"</option>");
		}

	}else{
		selplay.CurModeType="auto";
	}
	if(isAutoModes=="yes" && isAutoForPlay=="yes"){
		jQuery("#primode").append("<option value='auto'>自由模式</option>");
		G('SelectAutoMode').style.display="";
	}else{
		selplay.CurModeType="fix";
		if(isAutoForPlay=="no" || isAutoModes=="no"){
		$('#CurMode').html(selplay.CurMode);

		}
	}
}
//打开初使化
function resetAutoMode(item){
	creatModeSelect();
	var minMode=1930;
	var thisMode=minMode;
	if(selplay.CurMode){thisMode=parseInt(selplay.CurMode,10);}
	var modetype=selplay.CurModeType;
	if (typeof(modetype)!="undefined" && modetype!=""){
		if(modetype=="fix"){
			selectSetItem(G('primode'),thisMode);
			try
			{
				for (i=0;i<G('primode').length;i++)
				{
					if(G('primode')[i].selected==true){G('CurMode').innerHTML=G('primode')[i].value;}
				}
			}
			catch (e)
			{

			}

			if(G('SelectAutoMode')){G('SelectAutoMode').style.display="none";}
		}
		if(modetype=="auto"){
			if(G('SelectAutoMode')){
				var MinBonus=parseFloat(selplay.MinBonus,10);
				var ones=MinBonus*20;
				var rebate=parseFloat(rearr[selplay.retype],10);
				try
				{

					var prize=parseInt(arrPlayPri[playlist.playid]['1930'],10);

				}
				catch (e)
				{

					var prize=parseInt(1930,10);
				}


				if(rebate-0.1>=0){
					var maxMode=minMode+rebate*20;
					var linelong=maxMode-minMode;
					$("#maxmode").html(maxMode);
					$("#minmode").html(minMode);
					if(item=="lost"){thisMode=thisMode-ones;}
					if(minMode-thisMode>0){thisMode=minMode;}

					if(item=="add"){thisMode=thisMode+ones;}
					if(thisMode-maxMode>0){thisMode=maxMode;}
					thisMode=thisMode.toFixed(0);
					var thisRebate=rebate-((thisMode-minMode)/20);
					var thisPrize=(prize/minMode)*thisMode;
					thisRebate=thisRebate.toFixed(1);
					thisPrize=thisPrize.toFixed(2);
					G('CurMode').innerHTML=thisMode+"/"+thisRebate;

					var ns=(thisMode-minMode)/linelong
					//ns=ns.toFixed(2);
					/*滚动条初使化*/
					var btn=document.getElementById("btn");
    				var bar=document.getElementById("bar");
					var step=bar.getElementsByTagName("DIV")[0];
					var max=bar.offsetWidth;
					var lefts=max*ns;
					btn.style.left=lefts+'px';
					step.style.width=lefts+'px';

					//if((item=="lost") || (item=="add")){
						document.cookie="CurModeType=auto";
						document.cookie="CurMode="+thisMode+"";
						document.cookie="AutoModeNum="+thisMode+"";
						selplay.CurModeType="auto";
						selplay.AutoModeNum=thisMode;
					//alert(selplay.CurMode)
					//}
				}else{
					var minMode=1930;
					var maxMode=1930;
					var thisMode=1930;
					$("#maxmode").html(maxMode);
					$("#minmode").html(minMode);


					document.cookie="CurModeType=auto";
					document.cookie="CurMode=1930";
					document.cookie="AutoModeNum=1930";
					selplay.CurModeType="auto";


				}
			}
		}
	}else{
		var Obj=G('primode');
		if(Obj.length-1>=0){
			Obj.options[0].selected=true;
			selplay.CurModeType="fix";
			selplay.CurMode=Obj.options[0].value;alert(Obj.options[0].value)
			G('CurMode').innerHTML=Obj.options[0].value;
			document.cookie="CurModeType=fix";
			document.cookie="CurMode="+Obj.options[0].value+"";
		}else{
			DialogAlert("奖金模式未设置或读取错误，请联系管理员！")
		}
	}
}
//投注转列号码
function reselline(){
	var bodys="";var l_a="";var l_b="";
	if(isArray(selists)){if(selists.length-1==0){return selists;return false;}}
	for (i=0;i<selists.length;i++)
	{
		var l_b="";
		bodys+=l_a;
		var lists=selists[i];
		if(isArray(lists)){
			for (j=0;j<lists.length;j++)
			{
				bodys+=l_b+""+lists[j];
				if (gamekey.indexOf("11-5")>0 || gamekey.indexOf("KL8")>0 || gamekey.indexOf("PK10")>0){
					l_b=" ";
				}else{
					l_b="";
				}
			}
			var l_a=",";
		}
	}
	return bodys;
}
//是否数组
function isArray(obj) {
    return Object.prototype.toString.call(obj) === '[object Array]';
}
//删除投注项
function deleteDiv(id){
	// buylist.replace(/html/i,"");

	// alert(html);
     //if(len1==buylist.length)
  //   buylist.replace(html+"#","");
    var div='';
    var buytemp=new Array();

        buytemp=buylist.split('#');

    var buy_temp='';
    var html='';
    // console.log(id);
    // console.log(buylist);
    for(var i=0;i<buytemp.length;i++){
        var buytemp1=buytemp[i].split('^');
        if(buytemp1[11]==id){
            div='div_'+buytemp1[3]+'_'+id;
             html=buytemp1;
          //  console.log(div);
        }
        else{
            if(buy_temp=='') buy_temp=buytemp[i];
            else buy_temp+='#'+buytemp[i];

        }
    }





   // console.log(buylist);

	var temp=html;

	 var nums=parseInt(temp[5],10);
	 var moneys=parseFloat(temp[6],10);

	 if(parseInt(G('lt_cf_nums').innerHTML,10)-nums>=0){var n_nums=parseInt(G('lt_cf_nums').innerHTML,10)-nums;}else{var n_nums=0;}
	 if(parseFloat(G('lt_cf_money').innerHTML)-moneys>=0){var n_moneys=parseFloat(G('lt_cf_money').innerHTML,10)-moneys;}else{var n_moneys=0;}
	 if(parseInt(G('lt_cf_count').innerHTML,10)-1>=0){var n_count=parseInt(G('lt_cf_count').innerHTML,10)-1;}else{var n_count=0;}

	 G('lt_cf_count').innerHTML=n_count;
	 G('lt_cf_nums').innerHTML=n_nums;

	 n_moneys=n_moneys.toFixed(3);
	 G('lt_cf_money').innerHTML=n_moneys;


     var my = document.getElementById(div);
     my.innerHTML=='';
     my.style.display='none';
     if (my != null)
        my.parentNode.removeChild(my);
    buylist=buy_temp;
    // $len1=buylist.length;
    set_cf_count_display();
	 if(G('lt_cf_count').innerHTML=="0"){clearTask();return false;}
 }
 //追号===================================================

function set_zuitabs(num){

	for(var i=1;i<=3;i++){

		if(i==num){
			G('zui_tabs_'+i).className='active';

		}
		else{


			G('zui_tabs_'+i).className='';

		}

	}


}


var zui_num='';
var zui_not='';
var zui_begin='';
var zui_type='1';
function select_zh(itemnum){
	/*
	if(G("it_select_max")){G("it_select_max").value="";}
	if(G("input_times")){var input_times=G("input_times").value;}
	if(G("input_period")){var input_period=G("input_period").value;}
    */
//	clearTaskSel();
	seltask.nums=0;

	var innerHTMLs='';
	zui_type=itemnum;
	if(itemnum=="1"){

		clearTask();
		//alert(seltask.istask);

	}

	if(itemnum=="2"){
		get_maxnum();
        if(zui_max<5) var num=zui_max;
        else var num=5;
        document.getElementById('zui_num').value=num;
		beginTimes(num,0);
		if(mobile==1){
			G('lt_trace_labelhtml').style.display='none';


		}

	}

	if(itemnum=="3"){
		if(mobile==1){
			G('lt_trace_labelhtml').style.display='block';
			innerHTMLs+='<input type="radio" checked="checked" value="1"  style="display:none;" name="setinput" onclick="zui_fresh();">最低收益率<input id="minl"  type="text"  maxlength="4" value="50" name="minl" onblur="zui_fresh();">%';

		}
else
			innerHTMLs+='<input type="radio" checked="checked" value="1"  style="display:none;" name="setinput" onclick="zui_fresh();">最低收益率<input id="minl" style="width:40px;" type="text"  maxlength="4" value="50" name="minl" onblur="zui_fresh();">%';


	}
	if(itemnum=="13"){
if(mobile==1){
	G('lt_trace_labelhtml').style.display='block';

	innerHTMLs+='隔<input id="qi13"  type="text"  maxlength="4" value="1"  onblur="zui_fresh();">期   / 翻<input id="bei13" type="text"  maxlength="1" value="2" onblur="zui_fresh();">倍';

}


else
		innerHTMLs+='隔<input id="qi13"  type="text"  maxlength="4" value="1" style="width:40px;"   onblur="zui_fresh();">期   &nbsp; 倍*<input id="bei13" style="width:40px;" type="text"  maxlength="1" value="2" onblur="zui_fresh();">';

		}


		G('lt_trace_labelhtml').innerHTML=innerHTMLs;
		//beginTimes(5,'0');

	//$("#button"+itemnum).addClass("cur").siblings().removeClass("cur");
	//for (i=11;i<14;i++){if(i-parseInt(itemnum)==0){G("button"+itemnum).className="button"+itemnum+"1";}else{G("button"+i).className="button"+i;}}
}
function clearTaskSel(){
	seltask.istask='no';
	seltask.perstop='no';
	seltask.moneys='0';
	seltask.list='';
    var TouZhuMoneys =document.getElementsByName('TouZhuMoneys');
    for(i=0;i<TouZhuMoneys.length;i++){
        TouZhuMoneys[i].value='';
        document.getElementById('kk_'+i).className='kk';
    }


	//alert(seltask.istask);
	//buylist='';
}
var zui_max=100;

function get_maxnum(){
	var firstnum= selplay.lotpriod;

		var maxnum=parseInt(selplay.per_sum)-parseInt(selplay.per_num);

		//alert(maxnum);
	if(maxnum>30) var num1=30;
	else var num1=maxnum;
	var obj=document.getElementById('lt_trace_qissueno');
	obj.options.length=0;
	var temp11="";
	for(var i=0;i<=num1;i=i+5){

	if(i>0)
		obj.options.add(new Option(i+"期",i));


	}
	if(qinums.length<100) {

		obj.options.add(new Option("全部",qinums.length));
		zui_max=qinums.length;
	}

	else
		obj.options.add(new Option("全部",100));
	var obj=document.getElementById('lt_trace_qissueno');
	 for(var i=0;i<obj.options.length;i++){
         if(zui_num==obj.options[i].value){
        	 obj.options[i].selected = 'selected';

                  break;
           }
        }

		return maxnum;

}

function check_zuinum(){

	var num=document.getElementById('zui_num').value;
    var re = /^[0-9]+$/ ;
    if( re.test(num)){
    	if(num<1){
        	window.wxc.xcConfirm("追号期数必须大于0!",window.wxc.xcConfirm.typeEnum.warning);
        	document.getElementById('zui_num').value=1;
    		return false;


    	}
    	if(num>zui_max){
        	window.wxc.xcConfirm("最多可以追号"+zui_max+"期!",window.wxc.xcConfirm.typeEnum.warning);
        	document.getElementById('zui_num').value=zui_max;
    		return false;


    	}

    	return  true;
    }
    else {
    	window.wxc.xcConfirm("请输入正整数!",window.wxc.xcConfirm.typeEnum.warning);
    	document.getElementById('zui_num').value=1;
		return false;


    }

}


function  get_beginlot(thisvalue){

	if(thisvalue){zui_begin=thisvalue;

	//beginTimes(zui_num,0);
	}

	var firstnum=document.getElementById('current_issue').innerHTML;
	if(!zui_begin)zui_begin=firstnum;
	var maxnum=get_maxnum();
	if(maxnum<10) var num=maxnum;
	else var num=10;
	var obj=document.getElementById('beginlot');
	obj.options.length=0;
	for(var i=0;i<num;i++){
		var qi=parseInt(firstnum)+i;
		obj.options.add(new Option("第"+qi+"期",qi));

	}
	var obj=document.getElementById('beginlot');
	 for(var i=0;i<obj.options.length;i++){
        if(zui_begin==obj.options[i].value){
       	 obj.options[i].selected = 'selected';

                 break;
          }
       }



}



function zui_ok(){
	var str='';
	if(zui_type==2) str+="同倍追号";
	if(zui_type==3) str+="利润率追号";
	if(zui_type==13) str+="翻倍追号";
     str='<div style="color:#000;font-weight:800;">'+str+'</div>'
     if(zui_type==3){
    	 str+="<div style='padding-left:15px;'>最低利润率："+document.getElementById('minl').value+"%,起始倍数："+document.getElementById('bs_num').value+"倍</div>";

     }
     if(zui_type==13){
    	 str+="<div style='padding-left:15px;'>相隔"+document.getElementById('qi13').value+"期*"+document.getElementById('bei13').value+"倍</div>";

     }

     str+="<div style='padding-left:0px;'>确定要追号"+document.getElementById('zui_num').value+"期？</div>";


     document.getElementById('message_con4').innerHTML=str;
	document.getElementById('messageDiv4').style.display='block';
}



function zui_fresh(){



	 beginTimes(zui_num,0);
}

function zui_fresh1(){
var select='';

	zui_num=document.getElementById('zui_num').value;
	//document.getElementById('zui_num').value=zui_num;
	var fangan_num=1;
	try
	{
		fangan_num=document.getElementById('fangan_num').innerHTML;

	}
	catch (e)
	{
		fangan_num=1;
	}

	var playid=G("playid_hidden").innerHTML;
	var pri_temp=arrPlayPri[playid].prize;
	if(pri_temp.indexOf('|')>0){
	var arr1=pri_temp.split("|");
	var TouZhuMoneys =document.getElementsByName('TouZhuMoneys');
	var num1=0;


	try
	{
		for(var i=0;i<TouZhuMoneys.length;i++){
			if(TouZhuMoneys[i].value>0){
				num1=i;
				break;
			}

		}


	}
	catch (e)
	{

	}


	var prize=arr1[num1];

	}




	var selArr=readSelToArr();var arrs=new Array();

		arrs=selArr[0];


	var num=zui_num;
	if(zui_begin) {
		if(zui_begin>document.getElementById('current_issue').innerHTML){

			var  firstnum=zui_begin;

		}


		else {
			zui_begin=document.getElementById('current_issue').innerHTML;
			var firstnum=document.getElementById('current_issue').innerHTML;
		}



	}
	else
	var firstnum=document.getElementById('current_issue').innerHTML;

	var maxnum=get_maxnum();

	var maxPn=parseInt(seltask.nums,10);

	var qi_arr=new Array();
	var html='';
	var money=0;
	var sum=0;

	var prize=0;


    for(var i=0;i<selArr.length;i++){
    	money=parseFloat(money)+parseFloat(selArr[i][6]);

    	if(selArr[i][4]=='元')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize);
    	if(selArr[i][4]=='角')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize)/10;
    	if(selArr[i][4]=='分')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize)/100;
    	if(selArr[i][4]=='厘')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize)/1000;
    	prize=parseFloat(prize)+parseFloat(pri);
    }
	prize=prize*fangan_num;


	var firstnum1= selplay.lotpriod;
	var Max_LotNum1=arrGameSet.Max_LotNum;
	var today=firstnum.substr(0,firstnum1.length-Max_LotNum1.length);
	var todaymax=today+Max_LotNum1;

	if(zui_type=='3') {var display='style="display:none;"';

	var setinput=document.getElementsByName("setinput");
	   var zuimin='';
	   for(var i=0;i<setinput.length;i++)
	   {
	     if(setinput[i].checked==true)
	    	 zuimin=setinput[i].value;
	   }
	// alert(zuimin);
	   if(zuimin=='0'){

		   var miny=document.getElementById('miny').value;
		  // alert(miny);
	   }
	   else{
		   var minl=document.getElementById('minl').value;
		 //  alert(minl);
	   }

	}else var display='';
	var bei=document.getElementById('bs_num').value;
	var min_money=money;


	if(zui_type=='13'){

		var qi13=document.getElementById('qi13').value;
		 var bei13=document.getElementById('bei13').value;
		var bei_temp=bei;
		var qi_num=1;
	}
	var sta=0;
for(var i=0;i<qinums.length;i++){

	if(qinums[i]==firstnum) var sta=i;


}

var max_num=100;
if(max_num>qinums.length) max_num=qinums.length;

	for(var i=0;i<max_num;i++){
//    if(parseInt(firstnum)+i<todaymax)
//
//	qi_arr[i]=parseInt(firstnum)+i;
//    else
//
		if(zui_not.indexOf(qi_arr[i])==-1 && i<num){
		qi_arr[i]=qinums[i+sta];


		money=parseFloat(money).toFixed(3);


		document.getElementById('amo_'+qi_arr[i]).innerHTML=parseFloat(document.getElementById('input_'+qi_arr[i]).value*min_money).toFixed(3);;
		sum+=parseFloat(document.getElementById('amo_'+qi_arr[i]).innerHTML);

		document.getElementById('sum_'+qi_arr[i]).innerHTML=sum.toFixed(3);
		//alert(sum);
		}
			}




	document.getElementById('lt_trace_hmoney11').innerHTML=sum;
	document.getElementById('lt_trace_count').innerHTML=num;



	countTask();

}




function beginTimes(vthis,select){



	get_beginlot('');
	if(select==1) zui_not='';

	zui_num=vthis;
	//document.getElementById('zui_num').value=zui_num;
	var fangan_num=1;
	try
	{
		fangan_num=document.getElementById('fangan_num').innerHTML;

	}
	catch (e)
	{
		fangan_num=1;
	}

	var playid=G("playid_hidden").innerHTML;
	var pri_temp=arrPlayPri[playid].prize;
	if(pri_temp.indexOf('|')>0){
	var arr1=pri_temp.split("|");
	var TouZhuMoneys =document.getElementsByName('TouZhuMoneys');
	var num1=0;


	try
	{
		for(var i=0;i<TouZhuMoneys.length;i++){
			if(TouZhuMoneys[i].value>0){
				num1=i;
				break;
			}

		}


	}
	catch (e)
	{

	}


	var prize=arr1[num1];

	}




	var selArr=readSelToArr();var arrs=new Array();

		arrs=selArr[0];



	var num=vthis;
	if(zui_begin) {
		if(zui_begin>document.getElementById('current_issue').innerHTML){

			var  firstnum=zui_begin;

		}


		else {
			zui_begin=document.getElementById('current_issue').innerHTML;
			var firstnum=document.getElementById('current_issue').innerHTML;
		}



	}
	else
	var firstnum=document.getElementById('current_issue').innerHTML;

	var maxnum=get_maxnum();

	var maxPn=parseInt(seltask.nums,10);

	var qi_arr=new Array();
	var html='';
	var money=0;
	var sum=0;

	var prize=0;

    for(var i=0;i<selArr.length;i++){
    	money=parseFloat(money)+parseFloat(selArr[i][6]);

    	if(selArr[i][4]=='元')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize);
    	if(selArr[i][4]=='角')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize)/10;
    	if(selArr[i][4]=='分')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize)/100;
    	if(selArr[i][4]=='厘')  var pri=parseFloat(arrPlayPri[selArr[i][3]].prize)/1000;
    	prize=parseFloat(prize)+parseFloat(pri);
    }
	prize=prize*fangan_num;


	var firstnum1=document.getElementById('current_issue').innerHTML;
	var Max_LotNum1=arrGameSet.Max_LotNum;
	var today=firstnum.substr(0,firstnum1.length-Max_LotNum1.length);
	var todaymax=today+Max_LotNum1;

	if(zui_type=='3') {var display='style="display:none;"';

	var setinput=document.getElementsByName("setinput");
	   var zuimin='';
	   for(var i=0;i<setinput.length;i++)
	   {
	     if(setinput[i].checked==true)
	    	 zuimin=setinput[i].value;
	   }
	// alert(zuimin);
	   if(zuimin=='0'){

		   var miny=document.getElementById('miny').value;
		  // alert(miny);
	   }
	   else{
		   var minl=document.getElementById('minl').value;
		 //  alert(minl);
	   }

	}else var display='';
	var bei=document.getElementById('bs_num').value;
	var min_money=money;


	if(zui_type=='13'){

		var qi13=document.getElementById('qi13').value;
		 var bei13=document.getElementById('bei13').value;
		var bei_temp=bei;
		var qi_num=1;
	}
	var sta=0;
for(var i=0;i<qinums.length;i++){

	if(qinums[i]==firstnum) var sta=i;


}



//console.log(qinums);
var max_num=100;
if(max_num>qinums.length) max_num=qinums.length;

    if(zui_type=='3'){

    	if(parseFloat(prize)<=parseFloat(min_money)){
            DialogAlert('本金大于奖金，无意义');


            return true;
		}


	}

   //console.log(qinums);
	for(var i=0;i<max_num;i++){
//    if(parseInt(firstnum)+i<todaymax)
//
//	qi_arr[i]=parseInt(firstnum)+i;
//    else
//

		qi_arr[i]=qinums[i+sta];


		var checked="checked";
		var tt=i+1;
		if(qi_arr[i]==firstnum1) var addhtm='(当期)';

		else var addhtm='';

		if(zui_not.indexOf(qi_arr[i])==-1 && i<num){


		if(zui_type=='3'){
       if(parseFloat(prize)>=parseFloat(sum)){}


			for(var jj=bei;jj<=200000;jj++){
				var money1=min_money*jj;

				var sum1=parseFloat(parseFloat(sum)+parseFloat(money1));//投入
				var yl1=(prize*jj-parseFloat(sum1)).toFixed(3);//盈利

				if(zuimin=='0'){
	if(parseFloat(yl1)>=parseFloat(miny)){

						bei1=jj;

						break;

					}

				}
				else{


					var pre1=100*parseFloat(yl1)/parseFloat(sum1);
					if(parseFloat(pre1)>=parseFloat(minl)){
						bei1=jj;

						break;

					}
				}

			}

			if(jj>=100000){

                DialogAlert("利润率追号最多只能达到10万倍,您设置的追号条件，追号倍数将达到"+jj+"倍，请重新设置");


				break;
				//return false;
			}
			var bei2=bei1;
	var 	money2=bei2*min_money;
	money=money2;
			sum=parseFloat(sum)+parseFloat(money2);
			sum=sum.toFixed(3);
			var yl=(prize*bei2-sum).toFixed(3);
			var pre=(100*parseFloat(yl)/parseFloat(sum)).toFixed(3);
		}
		else if(zui_type=='13'){

			 if(qi_num<qi13 && i>0){


				 qi_num++;

			 }
			 else{

				 qi_num=1;
				if(i>0)
				 bei_temp=bei_temp*bei13;

			 }

			 var bei2=bei_temp;

				money=min_money*bei2;
				sum=parseFloat(sum)+parseFloat(money);
				sum=sum.toFixed(3);

				var yl=(prize*bei-sum).toFixed(3);

				var pre=(100*parseFloat(yl)/parseFloat(sum)).toFixed(3);

		}

		else{
			var bei2=bei;

			money=min_money*bei2;
			sum=parseFloat(sum)+parseFloat(money);
			sum=sum.toFixed(3);

			var yl=(prize*bei-sum).toFixed(3);

			var pre=(100*parseFloat(yl)/parseFloat(sum)).toFixed(3);
		}

		var tt=i+1;



            var this_period=qi_arr[i];
//console.log(this_period);
		money=parseFloat(money).toFixed(3);
		//alert(sum);
		if(mobile==1)

			var 	html1='<div class="cur"><div style="width:60px;float:left;text-align:center;padding-top:15px;"><input  id="sel_rows" name="sel_rows[]" onclick="checkboxTime(this);zui_fresh1();"  name="period" type="checkbox" value="'+qi_arr[i]+'" class="chzhin" '+checked+' ></div>'
				+'<div style="float:left;"><span id="qih_'+qi_arr[i]+'">'+qi_arr[i]+'</span>'
				+'<input   name="zhcurrbs" type="text" class="zhipt" value="'+bei2+'" id="input_'+qi_arr[i]+'"   onkeyup="is_number(this);zui_fresh1();countTask()" onafterpaste="is_number(this)" style="width:50px;">倍<br>'
				+'当期投入<span id="amo_'+qi_arr[i]+'"  >'+money+'</span>元&nbsp;'
				+'累计投入<span id="sum_'+qi_arr[i]+'" class="zpcen">'+sum+'</span>元<span style="display:none;" id="qitime_'+qi_arr[i]+'">'+qitime[qi_arr[i]]+'</span></div></div>';


		else
            var 	html1='<tr><td width="139"><input  id="sel_rows" name="sel_rows[]" onclick="checkboxTime(this);zui_fresh1();"  name="period" type="checkbox" value="'+qi_arr[i]+'" class="chzhin" '+checked+'>&nbsp;<span id="qih_'+qi_arr[i]+'">'+this_period+'</span>'+addhtm+'</td>'
		+'<td><input   name="zhcurrbs" type="text" class="zhipt" value="'+bei2+'" id="input_'+qi_arr[i]+'"   onkeyup="is_number(this);zui_fresh1();countTask()" onafterpaste="is_number(this)" style="width:50px;">倍</td>'
		+'<td  class="zpcen" id="amo_'+qi_arr[i]+'"  >'+money+'</td>'
		+'<td  class="zpcen" id="sum_'+qi_arr[i]+'">'+sum+'</td><td  class="zpcen"  id="qitime_'+qi_arr[i]+'">'+qitime[qi_arr[i]]+'</td></tr>';
		var lt_trace_hmoney=sum;
		}
		else {var checked="";
		if(mobile==1){


            var 	html1='<div class="cur11" ><div style="width:60px;float:left;text-align:center;padding-top:15px;"><input  id="sel_rows" name="sel_rows[]" onclick="checkboxTime(this)"  name="period" type="checkbox" value="'+qi_arr[i]+'" class="chzhin" '+checked+' ></div>'
			+'<div style="float:left;"><span id="qih_'+qi_arr[i]+'">'+qi_arr[i]+'</span>'
			+'<input   name="zhcurrbs" type="text" class="zhipt" value="'+bei2+'" id="input_'+qi_arr[i]+'"   onkeyup="is_number(this);countTask()" onafterpaste="is_number(this)" style="width:50px;">倍<br>'
			+'当期投入<span id="amo_'+qi_arr[i]+'"  >0</span>元&nbsp;'
			+'累计投入<span  class="zpcen">0</span>元<span style="display:none;" id="qitime_'+qi_arr[i]+'">'+qitime[qi_arr[i]]+'</span></div></div>';

		}


		else

            var 	html1='<tr><td width="139"><input  id="sel_rows" name="sel_rows[]" onclick="checkboxTime(this)"  name="period" type="checkbox" value="'+qi_arr[i]+'" class="chzhin" '+checked+' '+display+'>&nbsp;<span id="qih_'+qi_arr[i]+'">'+qi_arr[i]+addhtm+'</span></td>'
		+'<td ><input name="zhcurrbs" type="text" class="zhipt" value="" id="input_'+qi_arr[i]+'"   onkeyup="is_number(this);countTask()" onafterpaste="is_number(this)" style="width:50px;">倍</td>'
		+'<td class="zpcen" id="amo_'+qi_arr[i]+'"  >--</td>'
		+'<td class="zpcen">--</td><td  class="zpcen" id="qitime_'+qi_arr[i]+'">'+qitime[qi_arr[i]]+'</td></tr>';
		}
//console.log(html1);

    html=html+html1;





	}

	if(mobile==1){

		html="<div class='zui_list11'>"+html+"</div>";

	}


	else{

		var htt='<tr >  <td  style="width:150px;" >期号</td> <td >倍数</td> <td  >当期投入</td><td >累计投入</td> <td   >预计开奖时间</td></tr>';
		html="<table width='100%' border='0' cellspacing='1' cellpadding='4' style='line-height:35px;' >"+htt+html+"</table>";
	}

	document.getElementById('task_html').innerHTML=html;

	document.getElementById('lt_trace_hmoney11').innerHTML=lt_trace_hmoney;
	document.getElementById('lt_trace_count').innerHTML=num;



	countTask();
}
function checkboxTime(vthis){
	if(vthis.checked==true){
		zui_not=zui_not.replace(','+vthis.value, '');
		G("input_"+vthis.value).removeAttribute('disabled');
		if(G('input_'+vthis.value).value==""){G('input_'+vthis.value).value="1";}
	}else{

		zui_not+=','+vthis.value;
		G('input_'+vthis.value).value="";
		G('amo_'+vthis.value).value="0.00";
		G("input_"+vthis.value).setAttribute('disabled',true);
	}
	zui_fresh();
	countTask();
}
function countTask(){



	//G("lt_trace_hmoney").innerHTML = "";
	var maxtimes=GetMaxTimes();
	//alert('+++++');
	var selArr=readSelToArr();var arrs=new Array();
	var onemoney=0;var money=0;var times=0;var inmoney=0;var allmoney=0;var n=0;
	var tasklists="";var taskperiods="";var lines="";
	var qitime='';
	for (i=0;i<selArr.length;i++)
	{
		arrs=selArr[i];

		money=parseFloat(arrs[6],10)/times;
		onemoney+=money;
		money=money.toFixed(3);
	}

	var sel_rows=document.getElementsByName("sel_rows[]");
	for (i=0;i<sel_rows.length;i++ )
	{
		if(sel_rows[i].checked == true){
			if(G('input_'+sel_rows[i].value).value==""){G('input_'+sel_rows[i].value).value="1";}


			times=G("input_"+sel_rows[i].value).value;
			inmoney=G("amo_"+sel_rows[i].value).innerHTML;
			qitime=G("qitime_"+sel_rows[i].value).innerHTML;
			taskperiods=$("#qih_"+sel_rows[i].value).html();
			allmoney=parseFloat(allmoney)+parseFloat(inmoney);

			tasklists+=lines+taskperiods+"^"+times+"^"+inmoney+'^'+qitime;
			lines="#";
			n+=1;
		}
	}

	if(G('lt_trace_stop').checked==true){
		var trace_stop="1";
	}else{
		var trace_stop="0";
	}

	if(allmoney-0.01>0){
		allmoney=allmoney.toFixed(3);
		$("#lt_trace_hmoney").html(allmoney);
        if(trace_stop==0)
		seltask={istask:'yes',perstop:trace_stop,nums:n,moneys:allmoney,list:tasklists};

	}else{
		G('show_status').innerHTML="";
		//G('lt_trace_hmoney').innerHTML="0.00";
	}
}
function IsTaskStop(vthis){
	if(vthis.checked==true){seltask.perstop="1";}else{seltask.perstop="0";}
}
//投注内容吧
function readSelToArr(){
	var divid="";var dividlen=0;var spanid="";var sphtml="";var splist=new Array();var arrs=new Array();
	var strs=buylist.split("#");
    var cur=G("current_issue").innerHTML;

////
	for(var i=0;i<strs.length;i++){
////
		sphtml=strs[i]; ;
        arrs=sphtml.split("^");

        if(arrs[10]!=cur){

            arrs[10]=cur;
		}

	splist[i]=arrs;

	}
//


	return splist;
}
function Re_Buy_Info(item){
	if(item.indexOf('yes')>=0){return "投注成功";}
	if(item.indexOf('no')>=0){return "投注失败";}

}
function Re_Back_Info(item){
	var re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'投注信息有误，请刷新后重试！'};
	if(item=="1"){re_info={colors:'#246732',bgcolors:'#CAF5D3',infos:'投注成功，祝君中奖！'};}
	if(item=="2"){re_info={colors:'#246732',bgcolors:'#CAF5D3',infos:'您的余额不足，可能部分注单未成功！'};}
	if(item=="3"){re_info={colors:'#246732',bgcolors:'#CAF5D3',infos:'倍数超限额，被调整为最大可投注倍数！'};}
	if(item=="4"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'投注失败！'};}
	if(item=="5"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'已临近截止时间，请购买下一期！'};}
	if(item=="6"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'已过销售时间！'};}
	if(item=="7"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'登陆超时，请退出重新登陆！'};}
	if(item=="8"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'投注金额空，请刷新后重试！'};}
	if(item=="9"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'投注内容空，请刷新后重试！'};}
	if(item=="10"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'余额不足！'};}
	if(item=="11"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'投注信息有误，请刷新后重试！'};}
    if(item=="12"){re_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:'已经封单，请购买下一期！'};}
	return re_info;
}