function refunc(funs,perid,response){
	switch(funs){ 
		case "user_list_level":
			re_user_list_level(perid,response);			 
			break;
		default: 
			break;
	}
}
function tips_pop(show,content,title){
	  var MsgPop=document.getElementById("winpop1");//获取窗口这个对象,即ID为winpop的对象
	  if(title)
		  document.getElementById('win_pop_title').innerHTML=title;
	  
	  document.getElementById('msg_con').innerHTML=content;
	   if (show=='up'){         //如果窗口的高度是0
	   MsgPop.style.display="block";//那么将隐藏的窗口显示出来
	  show=setInterval("changeH('up')",2);//开始以每0.002秒调用函数changeH("up"),即每0.002秒向上移动一次
	   }
	  else {         //否则
		   MsgPop.style.display="none";
	   hide=setInterval("changeH('down')",2);//开始以每0.002秒调用函数changeH("down"),即每0.002秒向下移动一次
	  }
	   
	}
	function changeH(str) {
	 var MsgPop=document.getElementById("winpop");
	 var popH=parseInt(MsgPop.style.height);
	 if(str=="up"){     //如果这个参数是UP
	  if (popH<=150){    //如果转化为数值的高度小于等于100
	  MsgPop.style.height=(popH+4).toString()+"px";//高度增加4个象素
	  }
	  else{
	  clearInterval(show);//否则就取消这个函数调用,意思就是如果高度超过100象度了,就不再增长了
	  }
	 }
	 if(str=="down"){
	  if (popH>=4){       //如果这个参数是down
	  MsgPop.style.height=(popH-4).toString()+"px";//那么窗口的高度减少4个象素
	  }
	  else{        //否则
	  clearInterval(hide);    //否则就取消这个函数调用,意思就是如果高度小于4个象度的时候,就不再减了
	  MsgPop.style.display="none";  //因为窗口有边框,所以还是可以看见1~2象素没缩进去,这时候就把DIV隐藏掉
	  }
	 }
	}
	window.onload=function(){    //加载

	//setTimeout("tips_pop('up','1111')",800);   
	}



	function sound(file){
		
		var str="<embed src='"+file+"' style='display:none;' id='sound_mp3'>";
		return str;
	}
	
	var showsound=true;
	function set_sound(){
        
		document.getElementById('sound_bg').innerHTML='';
		document.getElementById('msg_con').className='mp32';
		showsound=false;
	}
function check_online(){

	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();		
	}
	
	xmlHttp.open('GET','online.php',true);
	xmlHttp.onreadystatechange=function(){

		if(xmlHttp.readyState==4){
		var msg=xmlHttp.responseText;

		if(msg!='yes'){
		//	alert(msg);
			
		var con=	msg.split("|");
		if(con[0]=='timeout' || con[0]=='getout'){
			
			alert(con[1]);
			location.href='index.aspx?mod=login';
		return false;
		}
		
	if(con[0]=='msg' ){
		
		var s=sound('sound/msg.wav');
		if(showsound == true )
		  document.getElementById('sound_bg').innerHTML=s;
		tips_pop('up',con[1],con[2]);
		return false;
		}
	
	if(con[0]=='notice' ){
		


		tips_pop('up',con[1],con[2]);
		return false;
		}
	
		}
		
		else{
			tips_pop('down','111','1111');
			//alert(msg);
			
		}


		}
		
		
	};
	xmlHttp.send(null);
	
	
}
//check_online();
//setInterval("check_online()",3000);
