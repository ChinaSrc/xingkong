if(document.getElementById("go_Service")){
	var isService=getCookie("isService");
	if(isService=="1"){G('go_Service').style.display="";}
}
function readyCloseOCSWin()
{
	if ( document.getElementById("livechatbutton") != null)
	{
		subWindow.close();
	}
}
function openService(){
	var ServiceUrl=getCookie("ServiceUrl");
	if(ServiceUrl==""){alert("未能获取客服地址，请重新登陆再试！")
	}else{
		window.open(ServiceUrl)
	}
}