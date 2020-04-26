var domActiveOpencode;
var K1=false;		//定义第一次不播放

function ShowActiveOpencode()
{
	domActiveOpencode = new ActiveXObject("Microsoft.XMLDOM");
	domActiveOpencode.onreadystatechange=ShowActiveOpenmsg;
	domActiveOpencode.async = true;
	 //domActiveOpencode.load("index.aspx?controller=default&action=top&flag=account&dq=" + (new Date()).getTime());
	//return;
	//setTimeout("ShowActiveOpencode()",10000)
}

function ShowActiveOpenmsg(){
	if (domActiveOpencode.readyState==4)
	{
		var mod = "//row";
		var row = domActiveOpencode.selectNodes(mod);
		var tbobj = document.all("ShowSound");
			if(row.item(0).attributes.getNamedItem("projectno").nodeValue!=0){
			tbobj.innerHTML = "<div id=\"shengy\"></div>";
			if(K1==true){
		document.getElementById("top_notice").innerHTML ="<img src=\"images/msg/msg01.gif\" width=\"143\" height=\"25\" border=\"0\" align=\"absmiddle\">"
		// document.getElementById("top_notice").innerHTML ="会员要提现,请处理!";
	
			   // document.getElementById("enlightens").innerHTML ="<a  href=\"?controller=account&action=index&flag=withdraw\" target=\"right\">会员要提现,请处理!</a>";
				document.all["shengy"].innerHTML ="<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/source/plugin/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"1\" height=\"1\"> <param name=\"movie\" value=\"swf/message.swf\" /><param name=\"quality\" value=\"high\" /> <embed src=\"swf/message.swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"1\" height=\"1\"></embed></object>";}
			K1=true;
		}
	}
	return;
}
ShowActiveOpencode();