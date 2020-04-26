//判断当前选择数字的情况########################################################################################
function count_select(sele_list){
	var playid=playlist.playid;
	var paly_arr=playid.split("_");
	var formulakey=paly_arr[paly_arr.length-1];
	var listnum;

	var funcsele;var items;

	 if(gamekey.indexOf('SSC')>0 || gamekey.indexOf('FC')>0 )items="ssc";
	 if(gamekey.indexOf('11-5')>0  )items="11X5";
	 if(gamekey.indexOf('K3')>0)items="k3";
	 if(gamekey.indexOf('KL8')>0)items="jrx";
	 if(gamekey=='3D' || gamekey=='P5(P3)' || gamekey=='PL3' || gamekey=='LF3d')items="ssc";
	 if(gamekey.indexOf('PK10')>0)items="pk10";
	funcsele= "formula_"+items+"_"+formulakey;
	var codenum=playid.substring(0,1);
	var codeid=paly_arr[0];

	switch(funcsele){

	case "formula_k3_2TH-dx":case "formula_k3_2BT-dt":
		listnum=formula_k3_dx(sele_list);

		break;

	case "formula_k3_2BT-bz":
		listnum=formula_k3_fx(sele_list);

		break;
	case "formula_k3_3TH-dx":case "formula_k3_3TH-tx":case "formula_k3_2TH-fx":case "formula_k3_3LH-dx":case "formula_k3_3LH-tx":

		listnum=formula_k3_num(sele_list);

		break;

case "formula_k3_3BT-dt":
		listnum=formula_k3_dt3(sele_list);

		break;

case "formula_k3_3BT-dx":
	listnum=formula_k3_3bt(sele_list);

	break;

case "formula_k3_hz":
		listnum=listnum=formula_ssc_1Xbdw(sele_list);

		break;

case "formula_k3_3BT-HZ":
	listnum=listnum=formula_k3_3BTHhz(sele_list);

	break;

		case "formula_ssc_fs":case "formula_dpx_fs":case "formula_ssc_zhxfs":case "formula_dpx_zhxfs":  //复式
                if(playid.indexOf('2R')>-1 || playid.indexOf('3R')>-1 || playid.indexOf('4R')>-1 )
                {

                   listnum=choose(sele_list,codenum);

                }

                else{
			if(sele_list.length-parseInt(codenum,10)==0){listnum=formula_ssc_fs(sele_list);}

			}
			break;
		case "formula_ssc_fs5z2":
		listnum=formula_ssc_r2(sele_list);break;
		case "formula_ssc_fs2z2":
			listnum=formula_ssc_r2zx(sele_list);break;
        case "formula_ssc_5z2":case "formula_ssc_zx5z2":
			listnum=formula_ssc_r2hz(sele_list);break;

		case "formula_ssc_fs5z3":
			listnum=formula_ssc_r3(sele_list);break;
			case "formula_ssc_fs3z3":
				listnum=formula_ssc_r3zx(sele_list);break;
	        case "formula_ssc_5z3":case "formula_ssc_zx5z3":
				listnum=formula_ssc_r3hz(sele_list);break;



			case "formula_ssc_fs5z4":
				listnum=formula_ssc_r4(sele_list);break;
				case "formula_ssc_fs4z4":
					listnum=formula_ssc_r4zx(sele_list);break;
		        case "formula_ssc_5z4":case "formula_ssc_zx5z4":
					listnum=formula_ssc_r4hz(sele_list);break;



		case "formula_ssc_zhxhz":case "formula_dpx_zhxhz"://直选和值
			listnum=formula_ssc_zhxhz(sele_list);
			break;
		case "formula_ssc_zh"://组选
			listnum=formula_ssc_fs(sele_list);
		    listnum=listnum*codenum; //与复式不同的是为三星时要乘以3，所以计算公式还是用复式的.
			for (i=0;i<sele_list.length;i++){if (sele_list[i]==0){listnum="0";break;}}
			break;
		case "formula_ssc_z120"://五星组12
			if(sele_list[0].length-5>=0){listnum=formula_ssc_z24(sele_list,"120");}
			break;
		case "formula_ssc_z60"://五星组60
			listnum=formula_ssc_z60(sele_list,"60");
			break;
		case "formula_ssc_z30"://五星组30
			listnum=formula_ssc_z30(sele_list,"30");
			break;
		case "formula_ssc_z20"://五星组20
			listnum=formula_ssc_z30(sele_list,"20");
			break;
		case "formula_ssc_z10"://五星组10
			listnum=formula_ssc_z10(sele_list);
			break;
		case "formula_ssc_z5"://五星组5
			listnum=formula_ssc_z10(sele_list);
			break;
		case "formula_ssc_z24"://四星组24
			if(sele_list[0].length-4>=0){listnum=formula_ssc_z24(sele_list,"24");}
			break;
		case "formula_ssc_z12"://四星组12  isok
            listnum=formula_ssc_z12(sele_list,"12");
			break;
		case "formula_ssc_z4"://四星组4  isok
            listnum=formula_ssc_z4(sele_list,"4");
			break;
		case "formula_ssc_kd"://三星跨度 isok
		    listnum=formula_ssc_kd2((sele_list));
			break;
		case "formula_ssc_z3":case "formula_dpx_z3":
		    if(sele_list[0].length-1>0){listnum=formula_ssc_z3(sele_list[0].length)}
			break;
		case "formula_ssc_z6":case "formula_dpx_z6"://三星组6 isok
		    if(sele_list[0].length-1>0){listnum=formula_ssc_z6(sele_list[0].length,codeid)}
			break;
		case "formula_dpx_zxhz"://三星组选和值  isok
		    listnum=formula_ssc_zxhz(sele_list[0]);
			break;
		case "formula_ssc_bd"://三星组选和值 isok
		    if(sele_list[0].length-1>=0){listnum=54;}
			break;
		case "formula_ssc_hzws":case "formula_ssc_tshm"://isok
		    if(sele_list[0].length-1>=0){listnum=sele_list[0].length;}
			break;
		case "formula_ssc_2xzhxhz"://二星直选和值isok
			listnum=formula_ssc_2xzhxhz(sele_list[0]);
			break;
		case "formula_ssc_2xzhxkd"://二星直选跨度  isok
			listnum=formula_ssc_2xzhxkd(sele_list);
			break;
		case "formula_ssc_2xzxbd"://二星直选包胆  isok
			if(sele_list[0].length-1>=0){listnum="9"};
			break;
		case "formula_ssc_2xzxfs":case "formula_dpx_2xzxfs"://二星组选复式  isok
			listnum=teamnum(sele_list[0].length);
			break;
		case "formula_ssc_2xzxhz"://二星组选和值  isok
			listnum=formula_ssc_2xzxhz(sele_list[0]);
			break;
		case "formula_ssc_dwd":case "formula_dpx_dwd":	case "formula_11X5_dwd":  case "formula_ssc_lhh":  case "formula_ssc_DXDS":
			case "formula_ssc_01":case "formula_ssc_02":case "formula_ssc_03":case "formula_ssc_04":case "formula_ssc_12":case "formula_ssc_13":case "formula_ssc_14":case "formula_ssc_23":case "formula_ssc_24":case "formula_ssc_34":
        case "formula_pk10_0":case "formula_pk10_1":case "formula_pk10_2":
        listnum=formula_ssc_1Xbdw(sele_list);
			break;
		case "formula_ssc_hsym":case "formula_dpx_hsym":case "formula_ssc_qsym":case "formula_dpx_qsym":case "formula_ssc_sxym":case "formula_ssc_zsym"://不定位后三一码
			listnum=sele_list[0].length;
			break;
		case "formula_ssc_hsem":case "formula_ssc_qsem":case "formula_dpx_qsem":case "formula_ssc_sxem":case "formula_ssc_wxem":case "formula_ssc_zsem":
			listnum=teamnum(sele_list[0].length);
			break;

		case "formula_11X5_hsym":case "formula_11X5_hsym":case "formula_11X5_qsym":case "formula_11X5_qsym":case "formula_11X5_sxym":case "formula_11X5_zsym"://不定位后三一码
			listnum=sele_list[0].length;
			break;
		case "formula_11X5_hsem":case "formula_11X5_qsem":case "formula_11X5_qsem":case "formula_11X5_sxem":case "formula_11X5_wxem":case "formula_11X5_zsem":
			listnum=teamnum(sele_list[0].length);
			break;


		case "formula_ssc_wxsm"://不定位五星3码
			listnum=teamnum3(sele_list[0]);
			break;
		case "formula_ssc_hedx":case "formula_dpx_hedx"://大小单双后二，
			if(sele_list.length-2==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_hsdx"://大小单双后3，
			if(sele_list.length-3==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_qedx":case "formula_dpx_qedx"://大小单双前二，
			if(sele_list.length-2==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_qsdx"://大小单双前3
			if(sele_list.length-3==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_wmqwsx":case "formula_ssc_wmqjsx"://趣味-五码趣味3星
			if(sele_list.length-5==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_smqwsx":case "formula_ssc_smqjsx"://趣味-四码趣味3星
		    if(sele_list.length-4==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_hsqwex":case "formula_ssc_qsqwex":case "formula_ssc_qsqjex":case "formula_ssc_hsqjex"://趣味-后三趣味2星
		    if(sele_list.length-3==0){listnum=formula_ssc_hedx(sele_list)};
			break;
		case "formula_ssc_yffs":case "formula_ssc_hscs": case "formula_ssc_sxbx": case "formula_ssc_sjfc":
			listnum=sele_list[0].length;
			break;
		case "formula_11X5_zhxfs"://复式
			if(codeid=="3M"  || codeid=="3M1"  || codeid=="3M2"){var listnum=formula_11X5_zhxfs(sele_list);}
			if(codeid=="2M"  || codeid=="2M1"  || codeid=="2M2"){var listnum=formula_11X5_fs(sele_list);}
			break;
	case "formula_11X5_2z2":case "formula_11X5_3z3":case "formula_11X5_4z4":case "formula_11X5_5z5":case "formula_11X5_6z5":case "formula_11X5_7z5":case "formula_11X5_8z5"://组选复式
			if(sele_list[0].length-1>=0){
				listnum=formula_11X5_rxdt(funcsele,sele_list);
			}else{listnum=0;}
			break;


		case "formula_11X5_dds":
			listnum=sele_list[0].length;
			break;
		case "formula_11X5_czw":case "formula_11X5_fs1z1": case "formula_11X5_zxfs":case "formula_11X5_fs2z2":case "formula_11X5_fs3z3":case "formula_11X5_fs4z4":case "formula_11X5_fs5z5":case "formula_11X5_fs6z5":case "formula_11X5_fs7z5":case "formula_11X5_fs8z5":
			var listnum=formula_11X5_fsxzx(funcsele,sele_list[0].length);
			break;
		case "formula_jrx_sxp":case "formula_jrx_jep":case "formula_jrx_hzdxds":case "formula_jrx_5x":case "formula_jrx_hzdx":case "formula_jrx_hzds":
			listnum=sele_list[0].length;
			break;
		case "formula_jrx_rx1":case "formula_jrx_rx2":case "formula_jrx_rx3":case "formula_jrx_rx4":case "formula_jrx_rx5":case "formula_jrx_rx6":case "formula_jrx_rx7":case "formula_jrx_rx8":case "formula_jrx_rx9":case "formula_jrx_rx10":
			var len=funcsele.substr(funcsele.length-1,1);

			if(len==0) len=10;
			listnum=parseInt(C_list(sele_list[0].length,len));
			break;


		case "formula_ssc_dt":	case "formula_11X5_zhxdt":
			if(codeid=="2M"  || codeid=="2M1"  || codeid=="2M2"){ listnum=2*formula_11X5_fs(sele_list);}
			else
			listnum=formula_ssc_dt(sele_list);

			break;

		case "formula_11X5_zxdt":
			if(codeid=="2M"  || codeid=="2M1"  || codeid=="2M2"){ listnum=formula_11X5_fs(sele_list);}
			else
			listnum=formula_ssc_z6dt(sele_list);

			break;

		case "formula_ssc_z6dt":
			listnum=formula_ssc_z6dt(sele_list);

			break;

		case "formula_ssc_zsbt":case "formula_ssc_z3bt":
			listnum=formula_ssc_z3bt(sele_list);

			break;
		case "formula_ssc_z6hz":

			listnum=formula_ssc_z6hz(sele_list);

			break;

		case "formula_ssc_zxhz":
		    listnum=formula_ssc_z3hz(sele_list);
			break;
		case "formula_pk10_pk10x":
		    listnum=formula_ssc_1Xbdw(sele_list);
			break;
		case "formula_pk10_fs":
		if(codeid=="pk5x"  ) listnum=formula_pk10_fs5(sele_list);
		if(codeid=="pk4x"  ) listnum=formula_pk10_fs4(sele_list);
		if(codeid=="pk3x"  ) listnum=formula_11X5_zhxfs(sele_list);

		if(codeid=="pk2x"  ) listnum=formula_11X5_fs(sele_list);
		if(codeid=="pk1x"  ) listnum=formula_ssc_1Xbdw(sele_list);
		break;
	}




	if(listnum){G("base_num").value = G("lt_sel_nums").innerHTML = listnum;Count_Money();}
	else{G("lt_sel_nums").innerHTML = "0";G("lt_sel_money").innerHTML = "0";G("lt_prize_money").innerHTML="0";G("base_num").value = "0";
        if(mobile==1)
	document.getElementById('lt_sel_insert').querySelector('span').style.color='#fff';

	}


}
