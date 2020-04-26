var last_value="";var play_id="";var show_pri="";var go_fun="";
var title_list=new Array();var pri_list=new Array();var pernum=0;
  //=================================================
  var prize = document.getElementsByTagName("i");
  //for (i=28;i<prize.length;i++)
  for (i=0;i<prize.length;i++)
  {   pernum=i+1;
	  play_id=prize[i].id;//玩法ID
	  play_max=play_id.substr(0,1);//玩法ID
	  var innerHTML=prize[i].innerHTML;//奖金额度  
	  //alert(play_id+"|"+innerHTML)
	  //######################################################################
	  //根据玩法判断是否显示多种奖金的情况---------------
	  go_fun="";//return false; 
	  if(innerHTML.indexOf("|")>0){go_fun="arrays";}
	  if(play_id.indexOf("hhzx")>0 || play_id.indexOf("zxhz")>0){go_fun="hhzx";}
	  if(play_id.indexOf("tshm")>0){go_fun="tshm";}
	  if(play_id=="RXX_rx3"){go_fun="RXX_rx3";}
	  if(play_id=="RXX_rx4"){go_fun="RXX_rx4";}
	  if(play_id=="RXX_rx5"){go_fun="RXX_rx5";}
	  if(play_id=="RXX_rx6"){go_fun="RXX_rx6";}
	  if(play_id=="RXX_rx7"){go_fun="RXX_rx7";}
	  if(play_id=="QWX_czw"){go_fun="QWX_czw";}
	  if(play_id=="QWX_dds"){go_fun="QWX_dds";} 
	  //list_dds=Array("0d5s","5d0s","1d4s","4d1s","2d3s","3d2s"); 
      //list_czw=Array("3|9","4|8","5|7","6");
	  //多种奖金情况显示的抬头---------------------------
	  switch (go_fun){
 	  	  case 'hhzx':case 'zxhz':
			  	title_list=new Array("组三","组六");break;
 		  case 'tshm':
				  title_list=new Array("豹子","顺子","对子");break;
 		  case 'RXX_rx3':
				  title_list=new Array("选3中3","选3中2");break;
 		  case 'RXX_rx4':
				  title_list=new Array("选4中4","选4中3","选4中2");break;
 		  case 'RXX_rx5':
				  title_list=new Array("选5中5","选5中4","选5中3");break;
 		  case 'RXX_rx6':
				  title_list=new Array("选6中6","选6中5","选6中5","选6中3");break;
 		  case 'RXX_rx7':
				  title_list=new Array("选7中7","选7中6","选7中5","选7中4","选7中3");break;
 		  case 'QWX_dds':
				  title_list=new Array("0单5双","5单0双","1单4双","4单1双","2单3双","3单2双");break;
 		  case 'QWX_czw':
				  title_list=new Array("3、9","4、8","5、7","6");break;
 		  default:
				title_list=new Array("一等奖","二等奖","三等奖","四等奖","五等奖");break;
	  }
	  //#######################################################################
	   
	  if(innerHTML.indexOf("|")>0){  
		  var pri_list=innerHTML.split("|");show_pri="";
		  for (j=0;j<pri_list.length;j++)
		  {
			  last_value=moneyFormat(pri_list[j]);
			  show_pri+="<div><span>"+title_list[j]+"</span>：<i>"+last_value+"</i></div>"; 
		  }
		  G("div_"+play_id).innerHTML=show_pri; 
	  }else{ 
		  last_value=moneyFormat(innerHTML);
		  prize[i].innerHTML=last_value;
	  } 
	  //特殊奖金显示##########################################################
	  if((go_fun=="hhzx" || go_fun=="zxhz") && parseInt(play_max)-2>0){ 
		  var playid=play_id.split("_");var codes=playid[0];
		  show_pri="<div><span>"+title_list[0]+"</span>：<i>"+moneyFormat(G("em_"+codes+"_z3").innerHTML)+"</i></div>";
		  show_pri+="<div><span>"+title_list[1]+"</span>：<i>"+moneyFormat(G("em_"+codes+"_z6").innerHTML)+"</i></div>";
		  G("div_"+play_id).innerHTML=show_pri; 
	  }
	  if((play_id=="5X_zh" || play_id=="4X_zh" || play_id=="3X1_zh" || play_id=="3X2_zh" || play_id=="3X3_zh") && parseInt(play_max)-2>0){ 
		  var playid=play_id.split("_");var codes=playid[0];show_pri="";
		  if(codes=="5X"){var codes_list=new Array("5X_fs","4X_fs","3X2_fs","2X_2_zhxfs","1X_dwd");}
		  if(codes=="4X"){var codes_list=new Array("4X_fs","3X2_fs","2X_2_zhxfs","1X_dwd");}
		  if(codes=="3X1"){var codes_list=new Array("3X1_fs","2X_2_zhxfs","1X_dwd");}
		  if(codes=="3X2"){var codes_list=new Array("3X2_fs","2X_2_zhxfs","1X_dwd");}
		  if(codes=="3X3"){var codes_list=new Array("3X3_fs","2X_2_zhxfs","1X_dwd");}
		  for (a=0;a<codes_list.length;a++)
		  {
			  show_pri+="<div><span>"+title_list[a]+"</span>：<i>"+moneyFormat(G("em_"+codes_list[a]).innerHTML)+"</i></div>";
		  } 
		  G("div_"+play_id).innerHTML=show_pri; 
	  } 
  } 
  //var hig_amount_s=moneyFormat(G("hig_amount").innerHTML);
  //G("hig_amount").innerHTML=hig_amount_s;