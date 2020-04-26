//复式的公式，公式解释：当前为五星，第行各选了1，2，3，4，5个数字，则投注数=1*2*3*4*5 ###########################3
function formula_ssc_fs(selectlist){  //selectlist数组中每个值为对应行选选的个数，如selectlist[2]=第3行所选个数
	var endnum=1;
	for (i=0;i<selectlist.length;i++){
	if(selectlist[i].length-1>=0){
	endnum=endnum*selectlist[i].length;
	}
	else{
	return false;
	}
	}
	return endnum;
}

//k3单选

function  formula_k3_dx(selectlist){


	   var endnum=0;
	   var num=0;
	num=parseInt(selectlist[0].length) * parseInt(selectlist[1].length);

	   	return num;

}


//k3复选




function  formula_k3_fx(selectlist){



	   var num=0;
	   for (i=0;i<selectlist.length;i++){
			num=num+parseInt(selectlist[i].length);
			}

	   if(num>=2) return c_num(num,2);

}

//3不同胆拖

function  formula_k3_dt3(selectlist){

	if(parseInt(selectlist[0].length)==1 && parseInt(selectlist[1].length)>=2)

		 return c_num(parseInt(selectlist[1].length),2);
	else 	if(parseInt(selectlist[0].length)==2){

		return parseInt(selectlist[1].length);

	}


}

function  formula_ssc_dt(selectlist){

	if(parseInt(selectlist[0].length)==1 )

		 return 3*parseInt(selectlist[1].length)*(parseInt(selectlist[1].length)-1);
	else 	if(parseInt(selectlist[0].length)==2){

		return 6*parseInt(selectlist[1].length);

	}


}

function formula_k3_3BTHhz(selectlist){


	var arr = selectlist.toString().split(",");

//	alert(arr.length);

	var num=0;
	for(var i=0;i<arr.length;i++){
		if(arr[i]==6 || arr[i]==7 || arr[i]==14 || arr[i]==15) num=num+1;
		else if(arr[i]==8 || arr[i]==13 ) num=num+2;
		else num=num+3;


	}


	return num;
}

function  formula_ssc_z6dt(selectlist){

	if(parseInt(selectlist[0].length)==1 )

		 return parseInt(selectlist[1].length)*(parseInt(selectlist[1].length)-1)/2;
	else 	if(parseInt(selectlist[0].length)==2){

		return parseInt(selectlist[1].length);

	}
}

function formula_ssc_z3bt(selectlist){
	var temp=0;

	for(var i=0;i<10;i++){

		for(var j=0;j<10;j++){

			if(selectlist[0][i]==selectlist[1][j] && selectlist[0][i]>=0) temp++;

		}


	}


	return parseInt(selectlist[0].length)*parseInt(selectlist[1].length)-temp;
}


function formula_ssc_z6hz(selectlist){
	var num=0;var sum=0;
	for(var i=0;i<selectlist[0].length;i++){
		selectlist[0][i]=parseInt(selectlist[0][i]);
  if(selectlist[0][i]>13) var temp =27-selectlist[0][i];
  else var temp=selectlist[0][i];
   if(temp==3 || temp==4) num=1;
   else if(temp>=5 && temp<=8)num=temp-3;
   else if(temp>=9 && temp<=12)num=temp-2;
   else num=10;


   sum=sum+num;
	}

	return sum;

}
function formula_ssc_z3hz(selectlist){
	var num=0;var sum=0;
	for(var i=0;i<selectlist[0].length;i++){
		selectlist[0][i]=parseInt(selectlist[0][i]);
  if(selectlist[0][i]>13) var temp =27-selectlist[0][i];
  else var temp=selectlist[0][i];

   if(temp==1 || temp==2 ) num=temp;
   else if(temp==3)num=1;
   else if(temp==4 ||temp==5  || temp==6)num=3;
   else if(temp==7 || temp==9 || temp==12)num=4;
   else if(temp==8 || temp===10 || temp==11 || temp==13)num=5;




   sum=sum+num;
	}

	return sum;

}



function  formula_k3_num(selectlist){


	   var num=0;

	   for (i=0;i<selectlist.length;i++){
			num=num+parseInt(selectlist[i].length);
			}

	  return num;

}

function  formula_k3_3bt(selectlist){



	   var num=0;
	   for (i=0;i<selectlist.length;i++){
			num=num+parseInt(selectlist[i].length);
			}

	   if(num>=3) return c_num(num,3);

}


function c_num(sum,num){

	var a1=1; var a2=1;
for(var i=sum;i>sum-num;i--){

	a1=a1*i;
}
for(var i=1;i<=num;i++){

	a2=a2*i;
}

return a1/a2;

}









//任二
function formula_ssc_r2(selectlist){
	   var endnum=0;
var num=0;
for (i=0;i<selectlist.length;i++){
	num=num+parseInt(selectlist[i].length);
	}

	return r2_num(num);
}

function  r2_num(num){
	   var endnum=0;
	if(num==2) endnum=1;
	else if(num>2){endnum=(num-1)*num/2;}
	else endnum=0;


	return endnum;
}


function formula_ssc_r2hz(selectlist){
	   var endnum=0;
var num=0;

var fangan_num=document.getElementById('fangan_num').innerHTML;

var str=selectlist[0][1];

for(var i=0;i<selectlist[0].length;i++){

	endnum+=(parseInt(selectlist[0][i])+1)*fangan_num;

}
	return endnum;
}


function formula_ssc_r2zx(selectlist){
	   var endnum=0;
var num=0;

var fangan_num=document.getElementById('fangan_num').innerHTML;

endnum=formula_ssc_r2(selectlist)*fangan_num;
	return endnum;
}


//任三

function formula_ssc_r3(selectlist){
	   var endnum=0;
var num=0;
for (i=0;i<selectlist.length;i++){
	num=num+parseInt(selectlist[i].length);
	}

	return r3_num(num);
}

function  r3_num(num){
	   var endnum=0;
	if(num==3) endnum=1;
	else if(num>3){endnum=num*(num-1)*(num-2)/6;}
	else endnum=0;


	return endnum;
}


function  r3hz(i,num){
	if(i>13)i=27-i;
	if(num==1){
		if(i==0) return 1;
		else return r3hz(i-1,num)+parseInt(i+1);
	}
	else if(num==4){
		if(i==0) return 4;
		else return r3hz(i-1,num)+parseInt(i-1)*4+8;

	}
	else if(num==10){
		if(i==0) return 10;
		else return r3hz(i-1,num)+parseInt(i-1)*10+20;

	}

}



function formula_ssc_r3hz(selectlist){
	   var endnum=0;
var num=0;

var fangan_num=document.getElementById('fangan_num').innerHTML;

var str=selectlist[0][1];

for(var i=0;i<selectlist[0].length;i++){

	endnum+=r3hz(parseInt(selectlist[0][i]),fangan_num);

}
	return endnum;
}


function formula_ssc_r3zx(selectlist){
	   var endnum=0;
var num=0;

var fangan_num=document.getElementById('fangan_num').innerHTML;

endnum=formula_ssc_r3(selectlist)*fangan_num;
	return endnum;
}


//任四



function formula_ssc_r4(selectlist){
	   var endnum=0;
var num=0;
for (i=0;i<selectlist.length;i++){
	num=num+parseInt(selectlist[i].length);
	}

	return r4_num(num);
}
function  r4_num(num){
	   var endnum=0;
	if(num==4) endnum=1;
	else if(num>4){endnum=num*(num-1)*(num-2)*(num-3)/24;}
	else endnum=0;


	return endnum;
}

function formula_ssc_r4zx(selectlist){
	   var endnum=0;
var num=0;

var fangan_num=document.getElementById('fangan_num').innerHTML;

endnum=formula_ssc_r4(selectlist)*fangan_num;
	return endnum;
}

function  r3hz(i,num){
	if(i>13)i=27-i;
	if(num==1){
		if(i==0) return 1;
		else return r3hz(i-1,num)+parseInt(i+1);
	}
	else if(num==4){
		if(i==0) return 4;
		else return r3hz(i-1,num)+parseInt(i-1)*4+8;

	}
	else if(num==10){
		if(i==0) return 10;
		else return r3hz(i-1,num)+parseInt(i-1)*10+20;

	}

}



function formula_ssc_r4hz(selectlist){
	   var endnum=0;
var num=0;

var fangan_num=document.getElementById('fangan_num').innerHTML;

var str=selectlist[0][1];

for(var i=0;i<selectlist[0].length;i++){

	endnum+=r4hz(parseInt(selectlist[0][i]),fangan_num);

}
	return endnum;
}









//3星直选和值的公式，公式解释：当前为3星，选了4和6，则算法应该是：(4*3+2+1)+(6*3+4+3+2+1)###########################
function formula_ssc_zhxhz(selectlist){ //selectlist数组中为所选的数字按小到大组成,如选了4、6，则selectlist值为selectlist('4','6')
    var endnum=0;var listnum;
	var sele_count= new Array('1','3','6','10','15','21','28','36','45','55','63','69','73','75','75','73','69','63','55','45','36','28','21','15','10','6','3','1');
	if(selectlist[0]){
		for (i=0;i<selectlist[0].length;i++){listnum=selectlist[0][i];endnum=endnum+parseInt(sele_count[listnum]);}
	}
	return endnum;
}
//跨度的公式，公式解释：
function formula_ssc_kd(selectlist){
	if(selectlist[0]==""){return false;}var sele_count= new Array('10','54','96','126','144','150','144','126','96','54');
	var endnum=0;var num;for (i=0;i<selectlist.length;i++){num=selectlist[i];if(num-1>=-1){endnum=endnum+parseInt(sele_count[num]);}}return endnum;
}
//新改(new)跨度(3星)的公式，公式解释：
function formula_ssc_kd2(selectlist){
	if(selectlist[0]==""){return false;}var sele_count= new Array('10','54','96','126','144','150','144','126','96','54');
	var endnum=0;var num;for (i=0;i<selectlist[0].length;i++){num=selectlist[0][i];if(num-1>=-1){endnum=endnum+parseInt(sele_count[num]);}}return endnum;
}
//三星组3的公式，公式解释：选择的个数为N，则N*（N-1）为结果，则投注数=1*2*3*4*5 ###########################3
function formula_ssc_z3(selectlist){  //selectlist数组中每个值为对应行选选的个数，如selectlist[2]=第3行所选个数
	var endnum=selectlist*(selectlist-1);return endnum;
}
//三星组6的公式
function formula_ssc_z6(selectlist,codes){
	if(codes=="4X" || codes=="4X1" || codes=="4R"){
		var sele_count= new Array('0','0','1','3','6','10','15','21','28','36','45');
	}else{
		var sele_count= new Array('0','0','0','1','4','10','20','35','56','84','120');
	}
	var endnum=sele_count[selectlist];return endnum;
}
//组选和值的公式
function formula_ssc_zxhz(selectlist){
    var sele_count= new Array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
	var endnum=0;var num;for (i=0;i<selectlist.length;i++){num=selectlist[i]-1;endnum=endnum+parseInt(sele_count[num]);}
	return endnum;
}
//四星组24的公式
function formula_ssc_z24(selectlist,nums){
	if(nums=="24"){var sele_count= new Array('0','0','0','1','5','15','35','70','126','210');}
	else{var sele_count= new Array('0','0','0','0','1','6','21','56','126','252');}
	var endnum=0;var num=selectlist[0].length-1;endnum=parseInt(sele_count[num]);
	return endnum;
}
//四星组12的公式
function formula_ssc_z4(selectlist,nums){
	var endnum=0;var num=0;var a;var b;var c;var d_arr=new Array();
	var sele_count= new Array('0','1','2','3','4','5','6','7','8','9');
    a=selectlist[0].length;b=selectlist[1].length;
    var anum=0;var bnum=0;var c;var d;
	for(e=0;e<selectlist[0].length;e++){
		var this_num=selectlist[0][e];
		d_arr=drop_array_lines(selectlist[1],this_num);
		//alert(this_num+"|"+d_arr);//return false
		endnum+=d_arr.length;
	}
	return endnum;
}
//四星组12的公式
function formula_ssc_z12(selectlist,nums){
	var endnum=0;var num=0;var a;var b;var c;
	var sele_count= new Array('0','1','3','6','10','15','21','28','36');
    a=selectlist[0].length;b=selectlist[1].length;
    var anum=0;var bnum=0;var c;var d;
	num=Sames(selectlist[0],selectlist[1]);
    if(b-1>=0){c=b-1}else{c=0;};
	if(b-2>=0){d=b-2}else{d=0;};
	if(num-1>=0){
		 if(selectlist[0].length-num==0){c=b-2;anum=sele_count[c]*selectlist[0].length;}
		 if(selectlist[0].length-num>0){c=b-2;anum=sele_count[c]*num;anum=anum+sele_count[b-1]*(selectlist[0].length-num);}
	}else{if(b-1>=0){c=b-1}else{c=0;};anum=sele_count[c]*selectlist[0].length;}
	endnum=parseInt(anum);return endnum;
}
//五星组60的公式
function formula_ssc_z60(selectlist,nums){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var c;var d;
	if (nums=="60"){var sele_count= new Array('0','0','0','1','4','10','20','35','56','84');}
	a=selectlist[0].length;b=selectlist[1].length;num=Sames(selectlist[0],selectlist[1]);if(b-1>=0){c=b-1}else{c=0;};
	if(num-1>=0){if(a-num==0){anum=sele_count[c]*a;}if(a-num>0){anum=sele_count[b]*(a-num)+sele_count[c]*num;}}else{anum=sele_count[b]*a;}
	endnum=parseInt(anum);return endnum;
}
//五星组30/20的公式---没有写死，正公式----
function formula_ssc_z30(selectlist,nums){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	if (nums=="30"){alist=selectlist[0];blist=selectlist[1];}
	if (nums=="20"){alist=selectlist[1];blist=selectlist[0];}
	a=alist.length;b=blist.length;
	for (i=0;i<a-1;i++){d=i+1;for (j=d;j<a;j++){for (c=0;c<b;c++){if(alist[i]-blist[c]!=0 && alist[j]-blist[c]!=0){bnum=bnum+1;}}}}
	return bnum
}
//五星组10的公式
function formula_ssc_z10(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	alist=selectlist[0];blist=selectlist[1];a=alist.length;b=blist.length;
	for (i=0;i<a;i++){for (j=0;j<b;j++){if(alist[i]-blist[j]!=0){bnum=bnum+1;}}}
	return bnum;
}
//二星和值的公式
function formula_ssc_2xzhxhz(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	alist=selectlist;a=alist.length;//alert(alist)
	for (i=0;i<a;i++){for (j=0;j<10;j++){for (c=0;c<10;c++){if(j+c-alist[i]==0){bnum=bnum+1;}}}}
	return bnum;
}
//二星跨度的公式
function formula_ssc_2xzhxkd(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	alist=selectlist[0];a=alist.length;//if(alist[0]==0 || alist[0]==""){return false;}
	for (i=0;i<a;i++){for (j=0;j<10;j++){for (c=0;c<10;c++){b=0;if(j-c<0){b=c-j;}else{b=j-c;}if(b-alist[i]==0){bnum=bnum+1;}}}}
	return bnum;
}
//二星组选和值的公式
function formula_ssc_2xzxhz(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	alist=selectlist;a=selectlist.length;
	for (i=0;i<a;i++){b=alist[i];for (j=0;j<10;j++){for (c=j;c<10;c++){if(j-c!=0){if(b-j-c==0){bnum=bnum+1;}}}}}
	return bnum;
}
/*
//二星组选和值的包胆
function formula_ssc_2xzxbd(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	for (j=0;j<10;j++){for (c=j;c<10;c++){if(j-c!=0){if(selectlist-c==0 || selectlist-j==0){bnum=bnum+1;}}}}
	return bnum;
}
*/
//二星组选和值的包胆
function formula_ssc_dwd(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=1;var c;var d;var alist= new Array;var blist= new Array
	alist=selectlist;a=selectlist.length;
	for (i=0;i<a;i++)
	{
		bnum=bnum*alist[i].length;

	}
	return bnum;
}
//一星不定位
function formula_ssc_1Xbdw(selectlist){
	var endnum=0;var num=0;
	for (i=0;i<selectlist.length;i++)
	{
		endnum+=selectlist[i].length;
	}
	return (endnum)
}
//大小单双
function formula_ssc_hedx(selectlist){
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=1;var c;var d;var alist= new Array;var blist= new Array
	alist=selectlist;a=selectlist.length;
	for (i=0;i<a;i++)
	{
		bnum=bnum*alist[i].length;

	}
	return bnum;
}

//返回每行所选择的数字，组成数组
function btn_Array(maxnum){
	var sele_list= new Array;
	if(maxnum-2==0){sele_list= new Array("(0,4)","(5,9)")}
	if(maxnum-5==0){sele_list= new Array("(0,1)","(2,3)","(4,5)","(6,7)","(8,9)")}
    return sele_list;
}
function btn_contain(ctext){
    if(ctext.indexOf("区")>0){
        return "yes";
    }else if(ctext=="大" || ctext=="小"){
        return "yes";
	}else{
		return "no";
	}
}

//返回每行所选择的数字，组成数组
function select_Array(showlist){
	var sele_list= new Array;var this_value=0;
	for (j=0;j<showlist.length;j++)
	{
		if(G("select_0"+j)){
			if(check_css(G("select_0"+j).className)=="yes"){
				sele_list.push(j);
			}
		}
	}
    return sele_list;
}
//多行时返回每行所选择的数字，并组成数组
function select_Array_num(shownums){
	var sele_listss= new Array;
	for (i=0;i<parseInt(shownums);i++)
	{   sele_listss[i]=Array();
		for (j=0;j<10;j++)
		{
			if(check_css(G("select_"+i+j).className)=="yes"){
			   sele_listss[i].push(j);
			}
		}
	}
    return sele_listss;
}
//多行时返回每行所选择的数字，并组成数组组选120/24时用到此公式
function select_Array_zx(shownums){
	var sele_listss= new Array;
	for (i=0;i<parseInt(shownums);i++)
	{
		for (j=0;j<10;j++)
		{
			if(check_css(G("select_"+i+j).className)=="yes"){
				if(j==0){sele_listss.push(11);}else{sele_listss.push(j);}
			}
		}
	}
    return sele_listss;
}
//多行时返回每行所选择的数字，并组成数组组选120/24时用到此公式
function select_Array_kd(shownums){
	var sele_listss= new Array;
	for (i=0;i<parseInt(shownums);i++)
	{
		for (j=0;j<10;j++)
		{
			if(check_css(G("select_"+i+j).className)=="yes"){
				//if(j==0){sele_listss.push(11);}else{sele_listss.push(j);}
				sele_listss.push(j);
			}
		}
	}
    return sele_listss;
}
//每行选择的个数,返回个数组成的数组
function get_select_1(shownums){
	var sele_num;var sele_list= new Array;
	for (i=0;i<shownums;i++){sele_num=0;for (j=0;j<10;j++){if(check_css(G("select_"+i+j).className)=="yes"){sele_num=sele_num+1;}}sele_list[i]=sele_num;}
	return sele_list;
}
//每行选择的个数,返回个数组成的数组
function get_select_4(shownums,maxnum){
	var sele_num;var sele_list= new Array;
	for (i=0;i<shownums;i++){sele_num=0;for (j=0;j<maxnum;j++){if(check_css(G("keys_"+i+j).className)=="yes"){sele_num=sele_num+1;}}sele_list[i]=sele_num;}
	return sele_list;
}
//只有一行，返回这一行所有选择的数字数组数组第一个值为0
function get_select_2(showlist){
	var sele_list= new Array;var nowi;var maxnum=showlist.length-1;minnum=showlist[0];maxnum=showlist[maxnum];
	for (i=minnum;i<=maxnum;i++){if(check_css(G("select_0"+i).className)=="yes"){sele_list[i]=showlist[i];}}
	return sele_list;
}
//只有一行，返回这一行所有选择的数字数组,数组第一个值为1
function get_select_3(showlist){
	var sele_list= new Array;var nowi;var maxnum=showlist.length-showlist[0];minnum=0;
	for (i=minnum;i<=maxnum;i++){if(check_css(G("select_0"+i).className)=="yes"){sele_list[i]=showlist[i];}}
	return sele_list;
}
//11选5复式的公式，公式解释：当前为3星，第行各选了1，2，3，4，5个数字， ###########################3
function formula_11X5_zhxfs(selectlist){ //selectlist数组中每个值为对应行选选的个数，如selectlist[2]=第3行所选个数
	var endnum=0;var is_yes=0;var value_a="";var value_b;var value_c;
	var array_a=new Array;var array_b=new Array;var array_c=new Array;
	if(selectlist.length==3){
		var array_a=selectlist[0];var array_b=selectlist[1];var array_c=selectlist[2]; //alert(array_a+"|"+array_b+"|"+array_c)
			for(j=0;j<array_a.length;j++){
				value_a=array_a[j];
				for (b=0;b<array_b.length;b++){
					value_b=array_b[b];
					for (c=0;c<array_c.length;c++){
						value_c=array_c[c];
						if(value_a==value_b || value_a==value_c || value_b==value_c){}else{endnum+=1;}
					}
				}
			}
	    if(array_a.length-1>=0 || array_b.length-1>=0 || array_c.length-1>=0){is_yes=1;}
	}
	if(is_yes-1<0){return 0;}else{return endnum;}
}
//11选5复式的公式，公式解释：当前为3星，第行各选了1，2，3，4，5个数字， ###########################3
function formula_11X5_fs(selectlist){  //selectlist数组中每个值为对应行选选的个数，如selectlist[2]=第3行所选个数
	var endnum=0;var is_yes=0;var value_a="";var value_b;var value_c;
	var array_a=new Array;var array_b=new Array;var array_c=new Array;
	if(selectlist.length==2){
		var array_a=selectlist[0];var array_b=selectlist[1]; //alert(array_a+"|"+array_b+"|"+array_c)
			for(j=0;j<array_a.length;j++){
				value_a=array_a[j];
				for (b=0;b<array_b.length;b++){
					value_b=array_b[b];
					if(value_a==value_b){}else{endnum+=1;is_yes=1;}
				}
			}
	}
	if(is_yes-1<0){return 0;}else{return endnum;}
}
//11选5复式的公式，公式解释：当前为3星，第行各选了1，2，3，4，5个数字， ###########################3
function formula_11X5_zxfs(selectlist,num){
	var endnum=0;var is_yes=0;var array_a=new Array;var array_a=selectlist[0];
	var a_num;var b_num;var c_num;var a_end;var b_end;var c_end;var thisnum=0;
	if(array_a.length-num>=0){a_num=0;a_end=array_a.length-num+1;is_yes=1;
		for(i=a_num;i<a_end;i++){b_num=i+1;b_end=a_end+1;
			for(j=i+1;j<b_end;j++){
				thisnum+=1;c_num=j+1;c_end=b_end+1;
				if(num-3>=0){for(a=c_num;a<c_end;a++){endnum+=1;}}
			}
		}
	}
	if(num-2==0){endnum=thisnum;}
	if(is_yes-1<0){return 0;}else{return endnum;}
}
function formula_11X5_dt(selectlist){
	var skey=G("skey").value;var is_yes=0;var endnum=0;var next_go="getCmoreNum";var array_a=selectlist[0];var array_b=selectlist[1];
	var tuo_num=0;var dan_num=0;var end_a=0;var end_b=0;var end_c=0;var end_d=0;var end_e=0;var end_f=0;var end_g=0;
	var b_a=0;var b_b=b_a+1;var b_c=b_b+1;var b_d=b_c+1;var b_e=b_d+1;var b_f=b_e+1;var b_g=b_f+1;

	if(skey=="RXDT_8z5"){next_go=="getCmoreNum";dan_num=8;}
	if(skey=="RXDT_7z5"){next_go=="getCmoreNum";dan_num=7;}
	if(skey=="RXDT_6z5"){next_go=="getCmoreNum";dan_num=6;}
	if(skey=="RXDT_5z5"){next_go=="getCmoreNum";dan_num=5;}
	if(skey=="RXDT_4z4"){next_go=="getCmoreNum";dan_num=4;}
	if(skey=="3M_zx_dt" || skey=="RXDT_3z3"){dan_num=3;next_go="getPlistNum";}
	if(skey=="2M_zx_dt" || skey=="RXDT_2z2"){dan_num=2;next_go="getPlistNum";}

	if(next_go=="getPlistNum"){
	   if(array_a.length-1>=0){
		   tuo_num=dan_num-array_a.length;
		   if(array_b.length-tuo_num>=0){is_yes=1;if(tuo_num==1){endnum=array_b.length}else{endnum=getPlistNum(array_b,tuo_num)}}else{is_yes=0;}}else{is_yes=0;}
	}
	if(next_go=="getCmoreNum"){
		if(array_a.length-1>=0){
			tuo_num=dan_num-array_a.length;
			if(array_b.length-tuo_num>=0){
				is_yes=1;getCmoreNum(dan_num,array_a.length,array_b.length)
			}
		}
	}
	if(is_yes==0){return is_yes;}else{return endnum;}
}
function formula_11X5_fsxzx(funcsele,lengs){
	var endnum=0;var num=0;
	if(funcsele=="formula_11X5_zxfs"){var wfid=playlist.playid;num=wfid.substr(0,1);}
	if(funcsele=="formula_11X5_czw" || funcsele=="formula_11X5_fs1z1"){num=1;}
	if(funcsele=="formula_11X5_fs2z2"){num=2;}
	if(funcsele=="formula_11X5_fs3z3"){num=3;}
	if(funcsele=="formula_11X5_fs4z4"){num=4;}
	if(funcsele=="formula_11X5_fs5z5"){num=5;}
	if(funcsele=="formula_11X5_fs6z5"){num=6;}
	if(funcsele=="formula_11X5_fs7z5"){num=7;}
	if(funcsele=="formula_11X5_fs8z5"){num=8;}
	endnum=C_list(lengs,num)
	return endnum;
}
function formula_11X5_rxdt(funcsele,sele_list){
	var endnum=0;var lostNum=0;
	if(funcsele=="formula_11X5_zxdt"){var wfid=playlist.playid;num=parseInt(wfid.substr(0,1))-sele_list[0].length;}
	if(funcsele=="formula_11X5_2z2"){num=2-sele_list[0].length;}
	if(funcsele=="formula_11X5_3z3"){num=3-sele_list[0].length;}
	if(funcsele=="formula_11X5_4z4"){num=4-sele_list[0].length;}
	if(funcsele=="formula_11X5_5z5"){num=5-sele_list[0].length;}
	if(funcsele=="formula_11X5_6z5"){num=6-sele_list[0].length;}
	if(funcsele=="formula_11X5_7z5"){num=7-sele_list[0].length;}
	if(funcsele=="formula_11X5_8z5"){num=8-sele_list[0].length;}
	endnum=C_list(sele_list[1].length,num)
	return endnum;
}


function formula_pk10_fs5(selectlist){ //selectlist数组中每个值为对应行选选的个数，如selectlist[2]=第3行所选个数
	var endnum=0;var is_yes=0;var value_a="";var value_b;var value_c;var value_d;var value_e;
	var array_a=new Array;var array_b=new Array;var array_c=new Array;var array_d=new Array;var array_e=new Array;
	if(selectlist.length==5){
		var array_a=selectlist[0];var array_b=selectlist[1];var array_c=selectlist[2]; var array_d=selectlist[3]; var array_e=selectlist[4]; //alert(array_a+"|"+array_b+"|"+array_c)
			for(j=0;j<array_a.length;j++){
				value_a=array_a[j];
				for (b=0;b<array_b.length;b++){
					value_b=array_b[b];
					for (c=0;c<array_c.length;c++){
						value_c=array_c[c];

						for (d=0;d<array_d.length;d++){
							value_d=array_d[d];

							for (e=0;e<array_e.length;e++){
								value_e=array_e[e];

								if(value_a!=value_b && value_a!=value_c && value_a!=value_d && value_a!=value_e && value_b!=value_c  && value_b!=value_d && value_b!=value_e && value_c!=value_d && value_c!=value_e && value_d!=value_e)endnum+=1;
							}


						}


					}
				}
			}
	    if(array_a.length-1>=0 || array_b.length-1>=0 || array_c.length-1>=0  || array_d.length-1>=0 || array_e.length-1>=0){is_yes=1;}
	}
	if(is_yes-1<0){return 0;}else{return endnum;}
}


function formula_pk10_fs4(selectlist){ //selectlist数组中每个值为对应行选选的个数，如selectlist[2]=第3行所选个数
	var endnum=0;var is_yes=0;var value_a="";var value_b;var value_c;var value_d;var value_e;
	var array_a=new Array;var array_b=new Array;var array_c=new Array;var array_d=new Array;var array_e=new Array;
	if(selectlist.length==4){
		var array_a=selectlist[0];var array_b=selectlist[1];var array_c=selectlist[2]; var array_d=selectlist[3]; //alert(array_a+"|"+array_b+"|"+array_c)
			for(j=0;j<array_a.length;j++){
				value_a=array_a[j];
				for (b=0;b<array_b.length;b++){
					value_b=array_b[b];
					for (c=0;c<array_c.length;c++){
						value_c=array_c[c];

						for (d=0;d<array_d.length;d++){
							value_d=array_d[d];


								if(value_a!=value_b && value_a!=value_c && value_a!=value_d && value_b!=value_c && value_b!=value_d  && value_c!=value_d )endnum+=1;



						}


					}
				}
			}
	    if(array_a.length-1>=0 || array_b.length-1>=0 || array_c.length-1>=0  || array_d.length-1>=0){is_yes=1;}
	}
	if(is_yes-1<0){return 0;}else{return endnum;}
}