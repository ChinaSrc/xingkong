//投注剩下时间 

var ser_lot_time;var lost_s;
var n_h;var n_m;var n_s;
  
var sr_time;
var xmlHttp;
function Sxmlhttprequest(){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();		
	}
	
}

function get_new_lot1(key){
	

		Sxmlhttprequest();
		xmlHttp.open('POST',"do.aspx?mod=ajax&code=get&list=data&action=lot&flag=yes&play="+key,true);
		xmlHttp.onreadystatechange=function(){
			
			if(xmlHttp.readyState==4){
			var response=xmlHttp.responseText;
			if(response.length-5>0){
			
				var periods=response.split("|");  
				document.getElementById("issue_"+key).innerHTML= "第"+periods[0]+"期"; 
				
	var seconds=periods[5];



		if(periods[5]>1){
			
			setLeftTime22(key,periods[5]);
			
			
		}
		else{
			
			setTimeout(function(){	
				get_new_lot1(key);
			},1000);
			
			
		}

		     return true;
			}

			}
			else{
				
				setTimeout(function(){	
					get_new_lot1(key);
				},1000);
				
				
			}
			
			
		};
		
		xmlHttp.send(null);

}
function get_new_lot2(key){

$.ajax({
	type: "POST",
	url: "do.aspx?mod=ajax&code=get&list=data&action=lot&flag=yes&play="+key,
	data: {},
	dataType:"text",
	success: function(data){
		var periods=data.split("|"); 
		
		document.getElementById("issue_"+key).innerHTML= "第"+periods[0]+"期"; 
		
var seconds=periods[5];



if(periods[5]>1){
	
	setLeftTime22(key,periods[5]);
	
	
}
	}
});
}

function setLeftTime22(key,seconds) {

seconds=parseInt(seconds);

if (seconds <=0 ) {
	
	document.getElementById("issue_"+key).innerHTML="等待销售";
	document.getElementById("endtime_"+key).innerHTML="OO:OO";
	
 return true;
}else {
	
	var timer1 = setInterval(function(){seconds--;
	var day1 = Math.floor(seconds / (60 * 60 * 24));
	var hour = Math.floor((seconds - day1 * 24 * 60 * 60) / 3600);
	var minute = Math.floor((seconds - day1 * 24 * 60 * 60 - hour * 3600) / 60);
	var second = Math.floor(seconds - day1 * 24 * 60 * 60 - hour * 3600 - minute * 60);

	if (seconds <=0  ) {

		document.getElementById("issue_"+key).innerHTML="等待销售...";
		document.getElementById("endtime_"+key).innerHTML="OO:OO";
		
		clearInterval(timer1);
		get_new_lot2(key);

     return true;
	}else {
		if(hour-10<0){hour="0"+(hour);}
		if(minute-10<0){minute="0"+(minute);}
		if(second-10<0){second="0"+(second);}
	
		if(day1>0) var str =day1+"天";else var str='';
		if(hour>0 || day1>0)  str +=hour+":";
		 str +=minute+":";
		
	document.getElementById("endtime_"+key).innerHTML=str+second;
	}
	
},1000);


}


}
	