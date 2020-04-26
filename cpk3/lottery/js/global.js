
function onlyNum() // onkeydown="onlyNum();"
{
if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)||event.keyCode==8||event.keyCode==46))
	event.returnValue=false;
}

function JHshNumberText(str)
{
    if ( !((window.event.keyCode >= 48) && (window.event.keyCode <= 57)) && (window.event.keyCode != 46))
    {
    window.event.keyCode = 0 ;
    }
    var obj11 = window.event.srcElement == null ? window.event.target : window.event.srcElement;
    return parseInt( obj11.getAttribute("keyCode"), 10);
}


function NumberCheck(f) {
	if(!TypeCheck(f.value, "0123456789-,")) {
		msg = "______________________________________________\n\n";
		msg += "只可输入半角字符:0123456789-,\n";
		msg += "\n切换方法:用组合键(Shift+空格键)即可进行全角、半角的转换\n";
		msg += "\n或用鼠标直接在输入法的图标上切换(半月形)\n";
                msg += "_____________________________________________\n";
		
		
		alert(msg + "\n\n");
		
		f.value="";
		f.focus();
		return false;
	}
}

function TypeCheck (s, spc) {
    var i;
    for(i=0; i< s.length; i++) {
        if (spc.indexOf(s.substring(i, i+1)) < 0) {
            return false;
        }
    }
    return true;
}
/* 图片 */
var imgObj;
function checkImg(theURL,winName){
  if (typeof(imgObj) == "object"){
    if ((imgObj.width != 0) && (imgObj.height != 0))
      OpenFullSizeWindow(theURL,winName, ",width=" + (imgObj.width+18) + ",height=" + (imgObj.height+25));
    else
      setTimeout("checkImg('" + theURL + "','" + winName + "')", 100)
  }
}

function OpenFullSizeWindow(theURL,winName,features) {
  var aNewWin, sBaseCmd;
  sBaseCmd = "toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,";
  if (features == null || features == ""){
    imgObj = new Image();
    imgObj.src = theURL;
    checkImg(theURL, winName)
  }
  else{
    aNewWin = window.open(theURL,winName, sBaseCmd + features);
    aNewWin.focus();
  }
}

<!-- Begin
maxLen = 300; // max number of characters allowed

function checkMaxInput(form) {
if (form.content.value.length > maxLen) // if too long.... trim it!
form.content.value = form.content.value.substring(0, maxLen);
// otherwise, update §characters left§ counter
else form.remLen.value = maxLen - form.content.value.length;
}
//  End -->
function getElementsByName(name,tag) {   
    var returns = parent.window.frames[2].document.getElementsByName(name);   
    if(returns.length > 0) return returns;   
    returns = new Array();   
    var e = parent.window.frames[2].document.getElementsByTagName(tag);   
    for(i = 0; i < e.length; i++) {   
              if(e[i].getAttribute("name") == name) {   
                         returns[returns.length] = e[i];   
              }   
     }   
     return returns;   
} 

  function callindex()
  {
    
    window.location.reload(); 

  }

  var url_arr='';
  var url_close='';
  var t=0;
  function openurl(url,title){
		var nav_li=getElementsByName('nav_li','li');
   
   	//	parent.window.frames[3].location.href=url;    	   
   	//	parent.window.frames[2].location.href='index.aspx?action=top';  
		var nav=parent.window.frames[2].document.getElementsByName('nav_name');
		
		var temp=1;

		for(var i=0;i<nav.length;i++ ){
	    if(nav[i].innerHTML==title){
	    	nav[i].className='cur';
	    	temp=0;
	    	nav_li[i].style.display='block';
    if(parent.window.frames[3].document.getElementById('frame_'+i).src.indexOf('#')>0)
	    parent.window.frames[3].document.getElementById('frame_'+i).src=url; 
	    	parent.window.frames[3].document.getElementById('frame_'+i).style.display='block'; 
	    	
	    }
	    else{
	    	nav[i].className='';
		parent.window.frames[3].document.getElementById('frame_'+i).style.display='none'; 

	    }
	    
		}
		
		if(temp==1){
			
			parent.window.frames[2].document.getElementById('navtop').innerHTML 
			+= "<li  name='nav_li' onclick='openurl(\""+url+"\",\""+title+"\");' ><span class='close' title='关闭窗口' onclick='closeurl(\""+title+"\");';></span>" +
					"<a href='#'   class='cur'  name='nav_name'>"+title+"</a><input type='hidden' name='nav_value'  value='"+url+"'/></li>";
			parent.window.frames[3].document.getElementById('frame_'+i).src=url; 
			parent.window.frames[3].document.getElementById('frame_'+i).style.display='block'; 
		}
		

	
		
	}
  
 
  function openurl1(url,title){
	  openurl(url,title);
	
	
		
	}

  
  
  
  
  
  function closeurl(title){
	  

		var nav_name=parent.window.frames[2].document.getElementsByName('nav_name');
		var nav_li=getElementsByName('nav_li','li');
		var nav_value=parent.window.frames[2].document.getElementsByName('nav_value');
		var num=0;

		for(var i=0;i<nav_li.length;i++ ){
			
		if(nav_li[i].style.display!='none')	{num++; }
			
			
		}
		
		
		if(num<2) {
			alert("您就剩下最后"+num+"个窗口了,请不要关闭！");return false;}

		for(var i=0;i<nav_name.length;i++ ){
		    if(nav_name[i].innerHTML==title){
				nav_li[i].onclick='';
		    	nav_li[i].style.display='none';
		    
		   	   parent.window.frames[3].document.getElementById('frame_'+i).src = "#"; 
		   	 
			  	parent.window.frames[3].document.getElementById('frame_'+i).style.display='none'; 
if(	nav_name[i].className =='cur'){

	var tt=0;
	for(var j=i-1;j>=0;j--){
		if(nav_li[j].style.display!='none'){
			 openurl(nav_value[j].value,nav_name[j].innerHTML);
			 tt=1;
 			url_close=nav_value[j].value;
			break;
		}
		
	
	}
	
	if(tt==0){
		
		for(var j=i;j<nav_name.length;j++){
    		if(nav_li[j].style.display!='none'){
    			 openurl(nav_value[j].value,nav_name[j].innerHTML);
    			 tt=1;
    			 url_close=nav_value[j].value;		
    			break;
    		}
    		
		
    	}
    	
	}

}

		    }
		 
		    
			}

  }
  
  
  
  
  
  




  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
