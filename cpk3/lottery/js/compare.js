
/* $Id : compare.js  Powered by Goldtimes.net $ */

function cellItem(nid)
{
	this.id = nid;
	this.status=0;
	this.num=0;
}
function cellItemObject()
{
	this.count = -1;
	this.item = new cellItem;
	this.find = cellItemFind;
	this.add = cellItemAdd;
}
function cellItemFind(nid)
{
	var foundItem = -1;
	for (var i = 0; i <= this.count; i++)
	{
		if(this.item[i]==null) continue;
		if (this.item[i].id == nid)
		{
			foundItem = i;
			break;
		}
	}
	return foundItem;
}
function cellItemAdd(n)
{
	var i = this.find(n);
	if (i == -1)
	{
		i = ++this.count;
		this.item[i] = new cellItem(n);
	}
}
function onclick_op(form1)
{
	
		
	
		var allselected=0;
		var needSelectCount=0;
		var kk=new cellItemObject;
		for(var index=0;index<form1.elements.length;index++)
		{
			if(form1.elements[index].type.toUpperCase()=="RADIO" || form1.elements[index].type.toUpperCase()=="CHECKBOX" )
			{
				var elid=form1.elements[index].id.toUpperCase();
				var pos=elid.indexOf("_");
				if(pos!=-1)
				{
					elid=elid.substring(0,pos);
				}
				kk.add(elid);
				if(form1.elements[index].checked)
				{
					var i=kk.find(elid);
					if(i!=-1) {kk.item[i].status=1;kk.item[i].num++;}
				}
			}
		}
		needSelectCount=kk.count+1;

			if(kk.item[0].num<1)
		{       alert(kk.item[0].num);
				alert("对不起，银行设置必须选1个或以上！");
				return false;
		}
		for(var i=0;i<=kk.count;i++)  allselected=allselected+((kk.item[i].status==1)?1:0);

		
				form1.action="?controller=system&action=userbank" ;
				form1.submit();
				return true ;
}
/*

变换颜色

ckBoxObj 触发点击事件的checkbox对象

*/

function changeColor(ckBoxObj)

{

  var rowObj = ckBoxObj.parentElement;//当前对象父对象的父对象

  if(ckBoxObj.checked){

    rowObj.style.backgroundColor = "#D6DBE4";

  }else{

    rowObj.style.backgroundColor = "#FFFFFF";

  }

}
