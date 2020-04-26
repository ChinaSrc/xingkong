function array_contain(array, obj){
    for (var i = 0; i < array.length; i++){
        if (array[i] == obj)//如果要求数据类型也一致，这里可使用恒等号===
            return true;
    }
    return false;
}
function select_auto(num){
	//alert(playlist.playid);
	
	var playid=playlist.playid;

	for(var i=0;i<num;i++){
		var code=get_rand_code(playid);

   if(gametype=='k3' && mobile==1){

   if(playid=='K3HZ'){

       var code_arr=code.split(',');
       var div_line=document.querySelector('#xcaiconter').querySelectorAll('.kk');

       for(var i=0;i<div_line.length;i++){

           if(div_line[i].className=='kk kkon'){
               div_line[i].click();

           }

       }


       for(var i=0;i<div_line.length;i++){

           if(array_contain(code_arr,div_line[i].querySelector('.kkls').querySelector('b').innerHTML)){
               div_line[i].click();
           }

       }



   }else{

       var div_line=document.querySelector('.game_pick_ball').querySelectorAll('.select_div_line');


       var code_arr=code.split(',');
       for(var i=0;i<div_line.length;i++){
           if(div_line[i].id.indexOf('key')>0){
               var span= div_line[i].querySelectorAll('.select_list_5_no_cur');
               for(var j=0;j<span.length;j++){

                   span[j].click();

               }
           }
       }



       for(var i=0;i<div_line.length;i++){
           if(div_line[i].id.indexOf('key')>0){
               var span= div_line[i].querySelectorAll('span');
               for(var j=0;j<span.length;j++){
                   if(array_contain(code_arr,span[j].innerHTML)){
                       span[j].click();
                   }
               }
           }
       }




   }




   }else{

       nums=get_nums(playid,code);

       autoinsertline(code ,nums);
   }

	}

	if(mobile==1 && gamekey!='k3'){

		fly_cart();
	}
}

function get_nums(playid,code){
	var nums=1;
	if(playid=='3X1_zh' || playid=='3X2_zh' || playid=='3X3_zh' || playid=='3R_zh' ) nums=3;
	if(playid=='3X1_zhxhz' || playid=='3X2_zhxhz' || playid=='3X3_zhxhz' || playid=='3X4_zhxhz' || playid=='3R_zhxhz' ){
		var sele_count= new Array('1','3','6','10','15','21','28','36','45','55','63','69','73','75','75','73','69','63','55','45','36','28','21','15','10','6','3','1');
		nums=sele_count[code];
	}
	if(playid=='3X1_kd' || playid=='3X2_kd' || playid=='3X3_kd' || playid=='3X4_kd' || playid=='3R_kd'  ){
		var sele_count= new Array('10','54','96','126','144','150','144','126','96','54');
		nums=sele_count[code];
	}
	if(playid=='3X1_z3' || playid=='3X2_z3' || playid=='3X3_z3' || playid=='3X4_z3' || playid=='3R_kd'  ){
	
		nums=2;
	}
	if(playid=='3X1_zxhz' || playid=='3X2_zxhz' || playid=='3X3_zxhz' ||  playid=='3X4_zxhz' || playid=='3R_zxhz' ){
	  var sele_count= new Array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
		nums=sele_count[code];
	}
	
	if(playid=='3X1_bd' || playid=='3X2_bd' || playid=='3X3_zxhz' || playid=='3X4_zxhz' || playid=='3R_zxhz' ){
		nums=54;
	}
	
	if(playid=='2X_1_2xzhxhz' || playid=='2X_2_2xzhxhz' || playid=='2R_2xzhxhz' ){
		
		 var sele_count= new Array('1','2','3','4','5','6','7','8','9','10','9','8','7','6','5','4','3','2','1');
			nums=sele_count[code];
		
	}
	
	if(playid=='2X_1_2xzxhz' || playid=='2X_2_2xzxhz' || playid=='2R_2xzxhz'){
		 var sele_count= new Array('1','1','2','2','3','3','4','4','5','4','4','3','3','2','2','1','1');
			nums=sele_count[code];
		
	}
	if(playid=='2X_1_2xzxbd' || playid=='2R_2xzxbd' || playid=='2R_2xzxbd' ){
		nums=9;
		
	}

	if(playid=='3BT-HZ'){
		
		 var sele_count= new Array('1','1','2','3','3','3','3','2','1','1');
			nums=sele_count[code];
	}

	
	return nums;
}

function  get_rand_code(playid){
	

		
		if(playid=='5X_fs' || playid=='5X_zh' ) 
			code="x,x,x,x,x";
		if( playid=='5X_z120' ) 
			code="x,y,z,m,n";	
		if(playid=='5X_ds') 
			code="xxxxx";
		
		
		if(playid=='5X_z60') 
			code="x,yzm";
		if(playid=='5X_z30') 
			code="xy,z";
		if(playid=='5X_z20' || playid=='4X_z12'  || playid=='4R_z12') 
			code="x,yz";
		if(playid=='5X_z10' || playid=='5X_z5'  || playid=='4X_z6'  || playid=='4X_z3' || playid=='4R_z6'  || playid=='4R_z3') 
			code="x,y";
		if(playid=='5X_lhh' ){
			  var sele_count= new Array('龙','虎','和');
			  var rand=getRandom(0,2);
			  
			  return sele_count[rand];
		}
		
		if(playid=='5X_DXDS' ){
			  var sele_count= new Array('大','小','单','双');
			  var rand=getRandom(0,3);
			  
			  return sele_count[rand];
		}
		
		
		if(playid=='QW_yffs' || playid=='QW_hscs' || playid=='QW_sxbx' || playid=='QW_sjfc') code="x";
		
		if(playid=='4X_fs' || playid=='4X_zh' || playid=='4R_fs' || playid=='4R_zh'  ) 
			code="x,x,x,x";
		
		if(playid=='4X_ds' || playid=='4R_ds') 
			code="xxxx";
		if(playid=='4X_z24' || playid=='4R_z24') 
			code="x,y,z,m";	
		
		if(playid=='3X1_fs' || playid=='3X2_fs' || playid=='3X3_fs' || playid=='3X4_fs' || playid=='3R_fs'  || playid=='3X1_zh' || playid=='3X2_zh' || playid=='3X3_zh'  || playid=='3R_zh'  ) 
			code="x,x,x";
		if(playid=='3X1_ds' || playid=='3X2_ds' || playid=='3X3_ds' || playid=='3X4_ds'|| playid=='3R_ds' ) 
			code="xxx";
		if(playid=='3X1_zhxhz' || playid=='3X2_zhxhz' || playid=='3X3_zhxhz' || playid=='3X4_zhxhz'  || playid=='3R_zhxhz' )  return getRandom(0,27);
		
		if(playid=='3X1_kd' || playid=='3X2_kd' || playid=='3X3_kd' || playid=='3X4_kd' || playid=='3R_kd' )  return getRandom(0,9);
		
		if(playid=='3X1_z3' || playid=='3X2_z3' || playid=='3X3_z3' || playid=='3X4_z3' ||  playid=='3R_z3'){
			code="x,y";
		}
		
		
		
		if(playid=='3X1_z3ds' || playid=='3X2_z3ds' || playid=='3X3_z3ds' || playid=='3X4_z3ds' || playid=='3R_z3ds' ){
	
			var num1=getRandom(0,9);
			var num2=getRandom(0,9);
			while(num1==num2){
				num2=getRandom(0,9);
				
			}
			
			num1=num1.toString();
			num2=num2.toString();
			var rand=getRandom(0,2);
		if(rand==0) code=num1+num1+num2;
		if(rand==1) code=num1+num2+num1;	
		if(rand==2) code=num1+num2+num2;	
		
			return code;
		}
		

		if(playid=='3X1_z6' || playid=='3X2_z6' || playid=='3X3_z6'|| playid=='3X4_z6' || playid=='3R_z6ds' || playid=='BDW_wxsm' ){
			code="x,y,z";
		}
		
		if(playid=='3X1_z6ds' || playid=='3X2_z6ds' || playid=='3X3_z6ds' || playid=='3X4_z6ds' || playid=='3R_z6ds'){
			code="xyz";
		}
		
		
		if(playid=='3X1_hhzx' || playid=='3X2_hhzx' || playid=='3X3_hhzx'  || playid=='3X4_hhzx' ||  playid=='3R_zxhz' ){
			code="xxx";
		}
		
		if(playid=='3X1_zxhz' || playid=='3X2_zxhz' || playid=='3X3_zxhz' || playid=='3X4_zxhz'  || playid=='3R_zxhz' ){
			return getRandom(1,26);
		}
		
		if(playid=='3X1_bd' || playid=='3X2_bd' || playid=='3X3_bd' || playid=='3X4_bd'  || playid=='3X1_hzws' || playid=='3X2_hzws' || playid=='3X3_hzws' || playid=='3X4_hzws' ){
			return getRandom(0,9);
		}
		
		if(playid=='3X1_tshm' || playid=='3X1_tshm' || playid=='3X1_tshm' ){
			  var sele_count= new Array('豹子','顺子','对子');
			  var rand=getRandom(0,2);
			  
			  return sele_count[rand];
		}
		
		
		
		if(playid=='2X_1_zhxfs' || playid=='2X_2_zhxfs' || playid=='2X3_1_zhxfs' || playid=='2X3_2_zhxfs' || playid=='2R_zhxfs'  ){
			
			code="x,x";
		}
		
		if(playid=='2X_1_zhxds' || playid=='2X_2_zhxds' || playid=='2X3_1_zhxds'  || playid=='2X3_2_zhxds' || playid=='2R_zhxds'  ){
			
			code="xx";
		}
		if(playid=='2X_1_2xzhxhz' || playid=='2X_2_2xzhxhz' || playid=='2X3_1_2xzhxhz' || playid=='2X3_2_2xzhxhz' || playid=='2R_2xzhxhz' ){
			
			return getRandom(0,18);
			
		}
		
		if(playid=='2X_1_2xzxfs' || playid=='2X_2_2xzxfs' || playid=='2X1_1_2xzxfs' || playid=='2X1_2_2xzxfs' || playid=='2R_2xzxfs' || playid=='BDW_hsem' || playid=='BDW_qsem' || playid=='BDW_sxem' || playid=='BDW_wxem'){
			
			code='x,y';
			
		}
		
		if(playid=='2X3_1_2xzxfs' || playid=='2X3_2_2xzxfs') code='x,y';
if(playid=='2X_1_zxds' || playid=='2X_2_zxds' || playid=='2X3_1_zxds' || playid=='2X3_2_zxds' || playid=='2R_zxds'){
			
			code="xy";
			
		}

if(playid=='2X_1_2xzxhz' || playid=='2X_2_2xzxhz' || playid=='2X3_1_2xzxhz' || playid=='2X3_2_2xzxhz' || playid=='2R_2xzxhz')return getRandom(0,17);

if(playid=='1X_dwd'){
	var rand=getRandom(0,9);
	var num=getRandom(0,4);
	var code='';
for(var i=0;i<5;i++){
	if(i==num) var tt=rand;
	else var  tt='';
	if(i==0) code=tt;
	else code+=','+tt;
	
}
	return code;
}

if(playid=='BDW_hsym' || playid=='BDW_qsym'  || playid=='BDW_sxym' )
	return getRandom(0,9);


	
	if(playid=='DXDS_qedx' || playid=='DXDS_hedx' || playid=='DXDS3_qedx' || playid=='DXDS3_hedx'){
		  var sele_count= new Array('大','小','单','双');
	
		  return  sele_count[getRandom(0,3)]+','+sele_count[getRandom(0,3)];
	}
	
	
	if(playid=='DXDS_hsdx' || playid=='DXDS_qsdx'){
		
		  var sele_count= new Array('大','小','单','双');
			
		  return  sele_count[getRandom(0,3)]+','+sele_count[getRandom(0,3)]+','+sele_count[getRandom(0,3)];
	}
	
	

	if(playid=='3M_zhxfs' || playid=='3M_zxfs' ||  playid=='RXFS_fs3z3'){
	code='x,y,z';
	}
	
	if(playid=='3M_zxds' || playid=="3M_zhxds" ||  playid=='RXDS_3z3'){
		code='x y z';
		}
	
	if(playid=='3M_zxdt'){
		
		code='x,y z'
	}
		
	

	if(playid=='2M_zhxfs' || playid=='2M_zxfs'){
	code='x,y';
	}
	
	if(playid=='2M_zxds' || playid=="2M_zhxds"  || playid=='RXDS_2z2'){
		code='x y';
		}
	
	if(playid=='2M_zxdt' || playid=='RXFS_fs2z2'){
		
		code='x,y'
	}
		
	if(playid=='BDW11_qsym'  || playid=='RXFS_fs1z1' || playid=='RXDS_1z1') code='x';
	
	if(playid=='QWX_dds'){
		
		  var sele_count= new Array('5单0双','4单1双','3单2双','2单3双','1单4双','0单5双');
			
		  return  sele_count[getRandom(0,5)];
		
		
	}
	
	
	if(playid=='DWD_dwd'){
		var rand=getRandom(1,11);
		if(rand<10) rand='0'+rand;
		var num=getRandom(0,4);
		var code='';
	for(var i=0;i<5;i++){
		if(i==num) var tt=rand;
		else var  tt='';
		if(i==0) code=tt;
		else code+=','+tt;
		
	}
	
		return code;
		
		
		
	}
	
	if(playid=='QWX_czw'){
		
		return getRandom(3,9);
	}
	if(playid=='RXFS_fs4z4'){
		code='x,y,z,m';
		
		
		}
		
	
	if(playid=='RXFS_fs5z5'){
		code='x,y,z,m,n';
		}
		
	if(playid=='RXFS_fs6z5'){
		code='x,y,z,m,n,a';
		}
	
	if(playid=='RXFS_fs7z5'){
		code='x,y,z,m,n,a,b';
		}
	
	if(playid=='RXFS_fs8z5'){
		code='x,y,z,m,n,a,b,c';
		}
	
	
	if(playid=='RXDS_4z4'){
		code='x y z m';
		
		
		}
		
	
	if(playid=='RXDS_5z5'){
		code='x y z m n';
		}
		
	if(playid=='RXDS_6z5'){
		code='x y z m n a';
		}
	
	if(playid=='RXDS_7z5'){
		code='x y z m n a b';
		} 
	
	if(playid=='RXDS_8z5'){
		code='x y z m n a b c';
		}
	
	
	
	
	if(playid=='k3_hz'){
		return getRandom(3,18);
	}
	
	
	if(playid=='3TH-tx') return '111 222 333 444 555 666';
	if(playid=='3TH-dx'){
		
		  var sele_count= new Array('111','222','333','444','555','666');
			
		  return  sele_count[getRandom(0,5)];
		
	}
	
	if(playid=='2TH-fx'){
		
		  var sele_count= new Array('11*','22*','33*','44*','55*','66*');
			
		  return  sele_count[getRandom(0,5)];
		
	}
	

	if(playid=='2TH-dx'){
		
		  var num1=getRandom(1,6);
		  
		  var num2=getRandom(1,6);
		  
		  while(num1==num2){
			  num2=getRandom(1,6);
			  
		  }
			
		  return  num1.toString()+num1.toString()+','+num2.toString();
		
	}
	
	
	if(playid=='2TH-ds'){
		
		var num1=getRandom(1,6);
		var num2=getRandom(1,6);
		while(num1==num2){
			num2=getRandom(1,6);
			
		}
		
		num1=num1.toString();
		num2=num2.toString();
		var rand=getRandom(0,2);
	if(rand==0) code=num1+num1+num2;
	if(rand==1) code=num1+num2+num1;	
	if(rand==2) code=num1+num2+num2;	
	
		return code;
		
	}
	
	if(playid=='3BT-dx'){
		
		code='x,y,z';
	}
	
if(playid=='3BT-ds'){
		
		code='xyz';
	}

if(playid=='3BT-HZ'){
	
	return getRandom(6,15);
}

if(playid=='3BT-dt'){
	
	code='x,yz';
}
if(playid=='2BT-bz' || playid=='2BT-dt'){
	
	code='x,y';
}

if(playid=='2BT-ds'){
	
	code='xy';
}

if(playid=='3LH-tx'){
	
	return '123 234 345 456';
}
if(playid=='3LH-dx'){

    var sele_count= new Array('123','234','345','456');

    return  sele_count[getRandom(0,3)];

}



if(playid=='pk10x'){
	var rand=getRandom(1,10);
	if(rand<10) rand='0'+rand;
	var num=getRandom(0,9);
	var code='';
for(var i=0;i<10;i++){
	if(i==num) var tt=rand;
	else var  tt='';
	if(i==0) code=tt;
	else code+=','+tt;
	
}


	return code;
	
	
	
}
if(playid=='pk5x_fs'){
	
	code='x,y,z,m,n';
}
if(playid=='pk5x_ds'){
	
	code='x y z m n';
}
	
if(playid=='pk4x_fs'){
	
	code='x,y,z,m';
}
if(playid=='pk4x_ds'){
	
	code='x y z m';
}
if(playid=='pk3x_fs'){
	
	code='x,y,z';
}
if(playid=='pk3x_ds'){
	
	code='x y z';
}	
if(playid=='pk2x_fs'){
	
	code='x,y';
}
if(playid=='pk2x_ds'){
	
	code='x y';
}	
if(playid=='pk1x_fs'){
	
	code='x';
}

if(playid=='RXX_rx1'){
	code='x,';
}

if(playid=='RXX_rx2'){
	code='x,y,';
}


if(playid=='RXX_rx3'){
	code='x,y,z,';
}

if(playid=='RXX_rx4'){
	code='x,y,z,m,';
}

if(playid=='RXX_rx5'){
	code='x,y,z,m,n,';
}
if(playid=='RXX_rx6'){
	code='x,y,z,m,n,a,';
}
if(playid=='RXX_rx7'){
	code='x,y,z,m,n,a,b,';
}

if(playid=='QWX2_sxp'){
	
	  var sele_count= new Array('上','中','下');
		
	  return  sele_count[getRandom(0,2)];
	
	
}

if(playid=='QWX2_jep'){
	
	  var sele_count= new Array('奇','偶','和');
		
	  return  sele_count[getRandom(0,2)];
	
	
}

    if(playid=='QWX2_5x'){

        var sele_count= new Array('金','木','水','火','土');

        return  sele_count[getRandom(0,4)];


    }




if(playid=='QWX2_hzdxds'){
	
	  var sele_count= new Array('大.单','大.双','小.单','小.双');
		
	  return  sele_count[getRandom(0,3)];
	
	
}



    if(wanfa_cate=='qw'){
        var sele_count=arrPlayList[playid].show_key.split("|");


        return  sele_count[getRandom(0,sele_count.length-1)];

    }


	return 	set_rand_code(code,game_cate);
	
}

var code_temp=Array();
function set_rand_code(code,cate){
	 code_temp=Array();

	var num='';
	for(var i=0;i<code.length;i++){
		
		
		if(code[i]=='x' || code[i]=='y' || code[i]=='z' || code[i]=='m' || code[i]=='n' || code[i]=='a' || code[i]=='b' || code[i]=='c' || code[i]=='d'){
			
			num+=rand_code_cate(cate);
			
		}
		else 
			
			num+=code[i];
		
		
	}
	
	
	
if(cate!=='11x5' && cate!=='pk10' && cate!=='kl8'){

	for(var i=0;i<code.length-1;i++){
		for(var j=i+1;j<num.length;j++){
			if(code[i]!=code[j]  && num[i]==num[j] && code[i]!=','){
				
				return set_rand_code(code,cate);
				
			}
			
			
		}
	}

}





	return num;
	
}

function  rand_code_cate(cate){

	
	if(cate=='ssc' || cate=='dp') return getRandom(0,9);
	if(cate=='k3') return getRandom(1,6);
	if(cate=='11x5' || cate=='pk10' || cate=='kl8') {
		if(cate=='11x5') var max=11;
		else if(cate=='pk10') var max=10;
		else {
			var max=80;
		}
	var num1=	getRandom(1,max);
	if(num1<10) num1='0'+num1;

	for(var i=0;i<code_temp.length;i++){
		if(num1==code_temp[i]) return rand_code_cate(cate);
		
		
	}
	code_temp[code_temp.length]=num1;
	
		return num1;
	}
	
}

function getRandom(min, max){
    var r = Math.random() * (max - min);
    var re = Math.round(r + min);
    re = Math.max(Math.min(re, max), min)
     
    return re;
}

function randomSort(a,b){  return Math.random()>0.5?-1:1;}

function autoinsertline(lines,nums){ 

	var flags="yes";

	var wei_item='';
	

	if(play_item=='2R' || play_item=='3R' ||  play_item=='4R'){
		if(play_item=='2R') var arr=[0,0,0,1,1];
		if(play_item=='3R') var arr=[0,0,1,1,1];
		if(play_item=='4R') var arr=[0,1,1,1,1];		
		
		var wei_value=arr.sort(randomSort);
		
		
		
		wei_item="^"+wei_value;
	}
	else {wei_item='';}
	
	var showNums="";var innerHTML="";var showHTML="";

	var money=2.000;

	var code= selplay.code;
	var titles= selplay.plays;
	var playid= playlist.playid;
	var prize= G('lt_prize_money').innerHTML;
	var modes=document.getElementById("lt_project_modes").value;
	if((selplay.modes=="yuan") || (selplay.modes=="元")){modes="元";}  
	var CurMode= document.getElementById("select_mode").value;
	var CurModeType= selplay.CurModeType;
	var times=document.getElementById("lt_sel_times").value;;
	var lotpriod= selplay.lotpriod; 
	var showcode="["+code+"-"+titles+"]"+lines;
	
	money=money*times*nums;
	
	
	if(modes=='yuan') modes='元';

	if((modes=="jiao") || (modes=="角")){
		modes="角";
	money=money/10;
	} 
	if((modes=="fen") || (modes=="分")){
		modes="分";
		money=money/100;
	} 
	
	if((modes=="li") || (modes=="厘")){
		modes="厘";
		money=money/1000;
	} 


	//判断字段是否为空
	if(nums=="0" || typeof(nums)=="undefined"){flags="no";}
	if(gamekey=="" || typeof(gamekey)=="undefined"){flags="no";}
	if(playid=="" || typeof(playid)=="undefined"){flags="no";}
	if(modes=="" || typeof(modes)=="undefined"){flags="no";}
	if(CurMode=="" || typeof(CurMode)=="undefined"){flags="no";}
	if(CurModeType=="" || typeof(CurModeType)=="undefined"){flags="no";}
	if(times=="" || typeof(times)=="undefined"){flags="no";}
	if(lotpriod=="" || typeof(lotpriod)=="undefined"){flags="no";}
	if(lines=="" || typeof(lines)=="undefined"){flags="no";}
	if(showcode=="" || typeof(showcode)=="undefined"){flags="no";}

	var MaxNote=arrPlays[selplay.coteid][playid].MaxNote;
	if(parseInt(MaxNote,10)-1>=0){
		if(parseInt(nums,10)-parseInt(MaxNote,10)>0){DialogAlert("超过系统设置的最大注数:"+MaxNote);
		return false;}
	}
	//if(arrPlays[].MaxNote nums)
	var ids="";
	if(showcode.length-30>0){showNums="["+code+"-"+titles+"]"+"...";}else{showNums=showcode;}
	
	ids=RndNum(5);
	innerHTML=gamekey+"^"+code+"^"+titles+"^"+playid+"^"+modes+"^"+nums+"^"+money+"^"+CurMode+"^"+CurModeType+"^"+times+"^"+lotpriod+"^"+ids+"^"+lines+wei_item;

	var msgObj=document.createElement("div"); 
	msgObj.id="div_"+playid+"_"+ids;
	msgObj.className="sel_div";
	msgObj.title="投注号码："+lines;

	msgObj.innerHTML=set_shopcar_html(ids,playid,code,lines,titles,modes,times,nums,money,showNums,innerHTML);

	set_buylist(innerHTML);
	
	G('lt_cf_content').appendChild(msgObj);

	var shownum=parseInt(playlist.shownum,10); 
	var minnum=parseInt(playlist.minnum,10);  
	var maxnum=parseInt(playlist.maxnum,10);  
	var max_select=parseInt(playlist.max_select,10);  
	var min_select=parseInt(playlist.min_select,10);
	var playid=playlist.playid;
	var lastcss="";var newcss="";
	for (i=0;i<5;i++)
	{
		for (j=0;j<80;j++)
		{
			if(G("select_"+i+"_"+j)){
				lastcss=G("select_"+i+"_"+j).className;
				newcss=get_css(lastcss,"nocheck");
				G("select_"+i+"_"+j).className=newcss;
			}
		}
	} 
	selists=[];
	G('lt_cf_count').innerHTML=parseInt(G('lt_cf_count').innerHTML,10)+1;
	G('lt_cf_nums').innerHTML=parseInt(G('lt_cf_nums').innerHTML,10)+parseInt(nums,10);
	var comoney=parseFloat(G('lt_cf_money').innerHTML,10)+parseFloat(money,10);	hm_check();
	comoney=comoney.toFixed(3);
	G('lt_cf_money').innerHTML=comoney;
    set_cf_count_display();
}