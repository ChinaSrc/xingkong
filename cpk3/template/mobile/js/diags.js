function open1()
{
	Dialog.open({URL:"test.html"});
}
function open2(title,url)
{
	var diag = new Dialog();
	diag.Width = 600;
	diag.Height = 300;
	diag.Title = title;
	diag.URL = url;
	diag.show();
}
function openReturn(title,url)
{
	var diag = new Dialog();
	diag.Width = 350;
	diag.Height = 160;
	diag.Title = title;
	diag.URL = url; 
	diag.show();//window.location.reload(); 
}
function openReturn(title,url)
{
	var diag = new Dialog();
	diag.Width = 350;
	diag.Height = 160;
	diag.Title = title;
	diag.URL = url; 
	diag.show();//window.location.reload(); 
}
function PutGameBuy(title,url,width,height)
{
	var diag = new Dialog();
	diag.Width = width;
	if(height-800>0){height=800;}
	diag.Height = height;
	diag.Title = title;
	diag.URL = url;
	OKEvent=function(){DoGameBuy();};
	diag.show();
}
function open3(title,url,width,height)
{
	var diag = new Dialog();
	diag.Width = width;
	if(height-800>0){height=800;}
	diag.Height = height;
	diag.Title = title;
	diag.URL = url;
	diag.show();
}
function open4()
{
	var diag = new Dialog();
	diag.Width = 300;
	diag.Height = 100;
	diag.Title = "内容页为html代码的窗口";
	diag.InnerHtml='<div style="text-align:center;color:red;font-size:14px;">直接输出html，使用 <b>InnerHtml</b> 属性。</div>'
	diag.OKEvent = function(){diag.close();};//点击确定后调用的方法
	diag.show();
}
function open5()
{
	var diag = new Dialog();
	diag.Width = 300;
	diag.Height = 150;
	diag.Title = "内容页为隐藏的元素的html";
	diag.InvokeElementId="forlogin"
	diag.OKEvent = function(){topWin.$id("username").value||Dialog.alert("用户名不能为空");topWin.$id("userpwd").value||Dialog.alert("密码不能为空")};//点击确定后调用的方法
	diag.show();
}
function open6()
{
	var diag = new Dialog();
	diag.Modal = false;
	diag.Left = 400;
	diag.Title = "弹出没有遮罩层的窗口";
	diag.URL = "test.html";
	diag.show();
}
function closdlg()
{
    Dialog.close();
}
function open7()
{
	var diag = new Dialog();
	diag.Width = 200;
	diag.Height = 100;
	diag.Modal = false;
	diag.Title = "在指定位置弹出窗口";
	diag.Top="100%";
	diag.Left="100%";
	diag.URL = "test.html";
	diag.show();
}
function open8()
{
	var diag = new Dialog();
	diag.Title = "返回值到调用页面";
	diag.URL = "test.html";
	diag.OKEvent = function(){$id('getval').value = diag.innerFrame.contentWindow.document.getElementById('a').value;diag.close();};
	diag.show();
	var doc=diag.innerFrame.contentWindow.document;
	doc.open();
	doc.write('<html><body><input id="a" type="text"/>请在文本框里输入一些值</body></html>') ;
	doc.close();
}
function open9(title)
{
	Dialog.alert("提示："+title);
}
function open10(title)
{
	Dialog.confirm('警告：您确认要'+title+'吗？',function(){Dialog.alert("yeah，周末到了，正是好时候")});
}
function open11(url)
{
	var diag = new Dialog();
	diag.Title = "创建其它按钮";
	diag.URL = "test.html";
	diag.show();
	diag.addButton("next","下一步",function(){
		var doc=diag.innerFrame.contentWindow.document;
		doc.open();
		doc.write('<html><body>进入了下一步</body></html>') ;
		doc.close();
		diag.removeButton(this);
	})
}
function open12()
{
	var diag = new Dialog();
	diag.Title = "带有说明栏的新窗口";
	diag.Width = 900;
	diag.Height = 400;
	diag.URL = "test.html";
	diag.MessageTitle = "泽元网站内容管理系统";
	diag.Message = "泽元网站内容管理系统是一个基于J2EE及AJAX技术的企业级网站内容管理系统";
	diag.show();
}

function open13()
{
	var diag = new Dialog();
	diag.URL = "test.html";
	diag.show();
}

function open14()
{
	var diag = new Dialog();
	diag.OnLoad=function(){alert("页面载入完成")};
	diag.URL = "test.html";
	diag.show();
}
function open15()
{
	var diag = new Dialog();
	diag.Title = "点击取消或关闭按钮时执行方法";
	diag.ShowButtonRow=true;
	diag.CancelEvent=function(){alert("点击取消或关闭按钮时执行方法");diag.close();};
	diag.URL = "test.html";
	diag.show();
}
function open16(title,url)
{
	var diag = new Dialog();
	diag.Title = "修改中窗体尺寸";
	diag.URL = "javascript:void(document.write(\'这是弹出窗口中的内容\'))";
	diag.OKEvent = function(){
		var doc=diag.innerFrame.contentWindow.document;
		doc.open();
		doc.write('<html><body>窗口尺寸改为600*300</body></html>') ;
		doc.close();
		diag.setSize(600,300);
		diag.okButton.disabled=true;
	};
	diag.show();
	diag.okButton.value="改变窗口大小"
}

function open17(val)
{
	var diag = new Dialog();
	diag.AutoClose=5;
	diag.ShowCloseButton=false;
	diag.URL = "javascript:void(document.write(\'"+val+"\'))";
	diag.show();
}

function open18()
{
	var diag = new Dialog();
	diag.Title="设置确定按钮及取消按钮的属性";
	diag.ShowButtonRow=true;
	diag.URL = "javascript:void(document.write('确定改为OK，取消改为Cancel'))";
	diag.show();
	diag.okButton.value=" OK ";
	diag.cancelButton.value="Cancel";
}


function open19()
{
	var diag = new Dialog();
	diag.Title = "窗体内的按钮操作父Dialog";
	diag.URL = "test.html";
	diag.CancelEvent=function(){alert("我要关闭了");diag.close();};
	diag.show();
	var doc=diag.innerFrame.contentWindow.document;
	doc.open();
	doc.write('<html><body><input type="button" id="a" value="修改父Dialog尺寸" onclick="parentDialog.setSize(function(min,max){return Math.round(min+(Math.random()*(max-min)))}(300,800))" /> <input type="button" id="b" value="关闭父窗口" onclick="parentDialog.close()" /> <input type="button" id="b" value="点击窗口取消按钮" onclick="parentDialog.cancelButton.onclick()" /></body></html>') ;
	doc.close();
}
function test(){
	var diag = new Dialog();
	diag.OKEvent=function(){
		Dialog.alert("提交成功",function(){diag.close()})
	};
	diag.show();
}
 //parent.window.top.frames['mainframe'].document.location.reload();