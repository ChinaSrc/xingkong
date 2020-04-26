exports.cp=[{
		title:'北京PK10',
		source:'168开奖网',
		name:'BJPK10',
		enable:true,
		timer:'BJPK10-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/pks/getLotteryPksInfo.do?lotCode=10001',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'BJPK10');
			}catch(err){
				throw('北京PK10从168开奖网解析数据不正确');
			}
		}

		},



	{
		title:'江苏快三',
		source:'360彩票',
		name:'JSK3',
		enable:true,
		timer:'JSK3-1',

			option:{
			host:'cp.360.cn',
			timeout:40000,
			path: '/k3js/',

		},
		parse:function(str){
			try{
				return getFrom360CP(str,'JSK3');
			}catch(err){
				throw('江苏快三从360彩票解析数据不正确');
			}
		}

		},



    {
        title:'湖北快三',
        source:'360彩票',
        name:'HUBK3',
        enable:true,
        timer:'HUBK3-1',

        option:{
            host:'cp.360.cn',
            timeout:40000,
            path: '/k3hb/',

        },
        parse:function(str){
            try{
                return getFrom360CP(str,'HUBK3');
            }catch(err){
                throw('吉林快三从360彩票解析数据不正确');
            }
        }

    },



	{
		title:'江西11选5',
		source:'168开奖网',
		name:'JX11-5',
		enable:true,
		timer:'JX11-5-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/ElevenFive/getElevenFiveInfo.do?lotCode=10015',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'JX11-5');
			}catch(err){
				throw('江西11选5从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'天津时时彩',
		source:'168开奖网',
		name:'TJSSC',
		enable:true,
		timer:'TJSSC-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/CQShiCai/getBaseCQShiCai.do?lotCode=10003',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'TJSSC');
			}catch(err){
				throw('天津时时彩从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'重庆时时彩-1',
		source:'168开奖网',
		name:'CQSSC',
		enable:true,
		timer:'CQSSC-1',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/CQShiCai/getBaseCQShiCai.do?lotCode=10002',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'CQSSC');
			}catch(err){
				throw('重庆时时彩-1从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'新疆时时彩',
		source:'168开奖网',
		name:'XJSSC',
		enable:true,
		timer:'XJSSC-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/CQShiCai/getBaseCQShiCai.do?lotCode=10004',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'XJSSC');
			}catch(err){
				throw('新疆时时彩从168开奖网解析数据不正确');
			}
		}

		},



		{
		title:'山东11选5',
		source:'168开奖网',
		name:'SD11-5',
		enable:true,
		timer:'SD11-5-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/ElevenFive/getElevenFiveInfo.do?lotCode=10008',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'SD11-5');
			}catch(err){
				throw('山东11选5从168开奖网解析数据不正确');
			}
		}

		},
    {
        title:'江苏快三',
        source:'168开奖网',
        name:'JSK3',
        enable:true,
        timer:'JSK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10007',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'JSK3');
            }catch(err){
                throw('江苏快三从168开奖网解析数据不正确');
            }
        }

    },
    {
        title:'安徽快三',
        source:'168开奖网',
        name:'AHK3',
        enable:true,
        timer:'AHK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10030',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'AHK3');
            }catch(err){
                throw('安徽快三从168开奖网解析数据不正确');
            }
        }

    },

    {
		title:'广西快三',
		source:'168开奖网',
		name:'GXK3',
		enable:true,
		timer:'GXK3-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10026',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'GXK3');
			}catch(err){
				throw('广西快三从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'湖北快三',
		source:'168开奖网',
		name:'HUBK3',
		enable:true,
		timer:'HUBK3-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10032',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'HUBK3');
			}catch(err){
				throw('湖北快三从168开奖网解析数据不正确');
			}
		}

		},


    {
        title:'北京快三',
        source:'168开奖网',
        name:'BJK3',
        enable:true,
        timer:'BJK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10033',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'BJK3');
            }catch(err){
                throw('北京快三从168开奖网解析数据不正确');
            }
        }

    },
    {
        title:'河北快三',
        source:'168开奖网',
        name:'HBK3',
        enable:true,
        timer:'HBK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10028',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'HBK3');
            }catch(err){
                throw('河北快三从168开奖网解析数据不正确');
            }
        }

    },
    {
        title:'吉林快三',
        source:'168开奖网',
        name:'JLK3',
        enable:true,
        timer:'JLK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10027',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'JLK3');
            }catch(err){
                throw('吉林快三从168开奖网解析数据不正确');
            }
        }

    },
    {
        title:'内蒙古快三',
        source:'168开奖网',
        name:'NMGK3',
        enable:true,
        timer:'NMGK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10029',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'NMGK3');
            }catch(err){
                throw('内蒙古快三从168开奖网解析数据不正确');
            }
        }

    },

    {
        title:'甘肃快三',
        source:'开奖网',
        name:'GSK3',
        enable:true,
        timer:'GSK3-0',

        option:{
            host:'14.49.15.91',
            timeout:40000,
            path: '/xml/k3/k3_gsks.php',

        },
        parse:function(str){
            try{
                return getFromxmlCP(str,'GSK3');
            }catch(err){
                throw('甘肃快三从168开奖网解析数据不正确');
            }
        }

    },
	
	{
        title:'上海快三',
        source:'开奖网',
        name:'SHK3',
        enable:true,
        timer:'SHK3-0',

        option:{
            host:'14.49.15.91',
            timeout:40000,
            path: '/xml/k3/k3_shks.php',

        },
        parse:function(str){
            try{
                return getFromxmlCP(str,'SHK3');
            }catch(err){
                throw('甘肃快三从168开奖网解析数据不正确');
            }
        }

    },
	
	{
        title:'江西快三',
        source:'开奖网',
        name:'JXK3',
        enable:true,
        timer:'JXK3-0',

        option:{
            host:'14.49.15.91',
            timeout:40000,
            path: '/xml/k3/k3_jxks.php',

        },
        parse:function(str){
            try{
                return getFromxmlCP(str,'JXK3');
            }catch(err){
                throw('甘肃快三从168开奖网解析数据不正确');
            }
        }

    },
	
    {
        title:'广西快三',
        source:'168开奖网',
        name:'FJK3',
        enable:true,
        timer:'FJK3-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/lotteryJSFastThree/getBaseJSFastThree.do?lotCode=10031',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'FJK3');
            }catch(err){
                throw('福建快三从168开奖网解析数据不正确');
            }
        }

    },
		{
		title:'广东11选5 ',
		source:'168开奖网',
		name:'GD11-5',
		enable:true,
		timer:'GD11-5-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/ElevenFive/getElevenFiveInfo.do?lotCode=10006',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'GD11-5');
			}catch(err){
				throw('广东11选5 从168开奖网解析数据不正确');
			}
		}

		},

    {
        title:'上海11选5 ',
        source:'168开奖网',
        name:'SH11-5',
        enable:true,
        timer:'SH11-5-0',

        option:{
            host:'api.api68.com',
            timeout:40000,
            path: '/ElevenFive/getElevenFiveInfo.do?lotCode=10018',

        },
        parse:function(str){
            try{
                return getFrom168APICP(str,'上海11-5');
            }catch(err){
                throw('上海11选5 从168开奖网解析数据不正确');
            }
        }

    },
		{
		title:'北京快乐8 -1',
		source:'168开奖网',
		name:'BJKL8',
		enable:true,
		timer:'BJKL8-1',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/LuckTwenty/getBaseLuckTewnty.do?lotCode=10014',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'BJKL8');
			}catch(err){
				throw('北京快乐8 -1从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'福彩3D',
		source:'168开奖网',
		name:'3D',
		enable:true,
		timer:'3D-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/QuanGuoCai/getLotteryInfo1.do?lotCode=10041',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'3D');
			}catch(err){
				throw('福彩3D从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'排列三',
		source:'168开奖网',
		name:'PL3',
		enable:true,
		timer:'PL3-0',

			option:{
			host:'api.api68.com',
			timeout:40000,
			path: '/QuanGuoCai/getLotteryInfo1.do?lotCode=10043',

		},
		parse:function(str){
			try{
				return getFrom168APICP(str,'PL3');
			}catch(err){
				throw('排列三从168开奖网解析数据不正确');
			}
		}

		},





    {
        title:'北京快乐8',
        source:'开奖网',
        name:'BJKL8',
        enable:true,
        timer:'BJKL8-0',

        option:{
            host:'www.1399klc.com',
            timeout:40000,
            path: '/issuehistory/historyList?lotteryCode=bjkl8&issue_no=0&date=&pageIndex=1&pageSize=10',

        },
        parse:function(str){
            try{

                var con={
                    title:'北京快乐8',
                    source:'开奖网',
                    name:'BJKL8',
                    enable:true,
                    timer:'BJKL8-0',
                    errorSleepTime:15,
                    restartTime:0

                };
                return getFromklc(str,'BJKL8');
            }catch(err){
                throw('北京快乐8从开奖网解析数据不正确');
            }
        }

    },




		];

// 出错时等待 15
exports.errorSleepTime=15;

// 重启时间间隔，以小时为单位，0为不重启
exports.restartTime=0;

exports.submit={

	host:'',
	path:''
}

global.log=function(log){
	var date=new Date();
	console.log('['+ date.toLocaleTimeString()+'] '+log)
}

function getFromklc(str,type){

	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();

	str=  JSON.parse(str);
var 	len=str.Data.rows.length;
	if(len>5) len=5;
    var  mynumber='';
    var result='';
    var mytime='';
	for(var i=0;i<len;i++){
		var temp=str.Data.rows[i];
        if(mynumber!='') mynumber+='|';
     mynumber +=temp.IssueNo.toString();
        if(result!='') result+='|';
        result +=temp.Result.toString().replace('|',',');
        if(mytime!='') mytime+='|';
        mytime +=temp.CreateDate.toString();

	}


	try{
//
//
		var data={
			type:type,
			time:mytime,
			number:mynumber,
		    data:result
	};

	return data;
	}catch(err){
		throw('klc解析数据失败');
	}
//

}



function getFromCPKssc(str,type){

	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	str=str.substr(str.indexOf('<tr><td><span class="xs0">'),500);
//	if(type=='HGKL8') log(str);
	var reg=/第.*?期/i,
	match=str.match(reg);
	var number=match[0].replace(/第/g, '');
	number=number.replace(/期/g, '');

	//var number=str.substr(27,str.indexOf('期')-27);
	//log(str.indexOf('期')-27);
	str=str.replace(/&nbsp;/g, ',');

	var data11=str.substr(str.indexOf('<span class="xi1 xw1">'),str.indexOf('</span></td><td><span class="xw1">')-str.indexOf('<span class="xi1 xw1">'));
 data11=data11.substr(22,str.indexOf('</span></td><td><span class="xw1">')-str.indexOf('<span class="xi1 xw1">')-22);

 try{
		var data={
			type:type,
			time:mytime,
			number:number,
			data:data11
		}



		return data;
	}catch(err){
		throw('解析数据失败');
	};

}



function getFromOffCP(str, type) {

    str=str.substr(str.indexOf('<th>波动值</th>')+30,1800);
 //   log(str);

    var list=str.split('</tr><tr>');
var number='';
var time='';
var data='';
    for(var i=0;i<list.length;i++){

var m1=list[i].substr(19,8)+list[i].substr(28,4);
var m2=list[i].substr(41,19);
var m3=list[i].substr(89,9);


      if(number=='') number=m1;else number+="|"+m1;
        if(time=='') time=m2;else time+="|"+m2;
        if(data=='') data=m3;else data+="|"+m3;

    }


    var data1 ={
        type:type,
        time:time,
        number:number,
        data:data

    };
    //submitData(data, conf);
    return data1;



}

function  getFromTxCP(str, type){


	str=  JSON.parse(str);


	var time =str[0].onlinetime.toString();
	var aa=time.substr(0,4)+time.substr(5,2)+time.substr(8,2);

	var number=aa+parseInt(parseInt(60*time.substr(11,2))+parseInt(time.substr(14,2)));
	var num=0;
	var onlinenumber=str[0].onlinenumber.toString();
	for(var i=0;i<onlinenumber.length;i++){

		num+=parseInt(onlinenumber.substr(i,1));

	}

	var dd=num.toString().substr(num.toString().length-1,1)+','+onlinenumber.substr(onlinenumber.length-4,1)+','+onlinenumber.substr(onlinenumber.length-3,1)+','+onlinenumber.substr(onlinenumber.length-2,1)+','+onlinenumber.substr(onlinenumber.length-1,1);


	//console.log(dd)
		return {
			type:type,
			time:time,
			number:number,
			data:dd
		};

}


function  getFromfh984(str, type){


  //  log(str);
     str=JSON.parse(str);
    var dd1=str.fpreviousresult;
    var number=str.fpreviousperiod;
    var myDate = new Date();
    var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1 ;     //月
    var day = myDate.getDate();            //日
    if(month < 10) month="0"+month;
    if(day < 10) day="0"+day;
    var mytime=year.toString() + month.toString() + day.toString();

//str=str.substr(str.indexOf('<div class="list">'),1000);



    var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
    return {
        type:type,
        time:mytime,
        number:number,
        data:dd1
    };



}

function getFromcnnbxx(str,type){
  //  log(str);
    var myDate = new Date();
    var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1 ;     //月
    var day = myDate.getDate();            //日
    if(month < 10) month="0"+month;
    if(day < 10) day="0"+day;
    var mytime=year.toString() + month.toString() + day.toString();

//str=str.substr(str.indexOf('<div class="list">'),1000);

    var reg=/第.*?期/g;

    //str=str.substr(str.indexOf('<div class="a1">'),5);
    match=str.match(reg);
  var   number=match[0].substr(1,13);
  number=number.replace('-','');
    var reg=/<h2>.*?<\/h2>/g;
    str=str.substr(str.indexOf('cqssc-nums'),82);
  str=str.substr(18,57);
    var dd1=str.replace(/<\/span><span>/g, ",");
//     console.log(number);
// console.log(dd1);

    var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
    return {
        type:type,
        time:mytime,
        number:number,
        data:dd1
    };


}

function  getFrom901060(str, type){



	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1 ;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year.toString() + month.toString() + day.toString();

//str=str.substr(str.indexOf('<div class="list">'),1000);

	var reg=/第.*?期/g;

	//str=str.substr(str.indexOf('<div class="a1">'),5);
	match=str.match(reg);
number=match[0].substr(1,12);
var reg=/<div class="txffc-nums">.*?<\/div>/g;
str=str.substr(str.indexOf('txffc-nums'),82);
str=str.substr(21,82);
var dd1=str.replace(/<\/span><span >/g, ",");



	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	return {
			type:type,
			time:mytime,
			number:number,
			data:dd1
		};



}

function getFromHappy(str, type) {
    str=str.substr(1,str.length-2);

    str=  JSON.parse(str.toString());


   var data=str.table[0].number;
   var title=str.table[0].title;
    if(type=='BJPK10'){

    }else{
        if(type.indexOf('11-5')){
            var temp=title.split('-');
            if(temp[1].length==2) temp[1]='0'+temp[1];
            title=temp[0]+temp[1];
        }
        else{
            if(title.indexOf('-')>-1)
                title=title.replace('-','');
        }


	}







    var myDate = new Date();
    var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1 ;     //月
    var day = myDate.getDate();            //日
    if(month < 10) month="0"+month;
    if(day < 10) day="0"+day;

    var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
    //console.log(mytime);
    return {
        type:type,
        time:mytime,
        number:title,
        data:data
    };
}



function  getFrom51hzdj(str, type){


	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1 ;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year.toString() + month.toString() + day.toString()

str=str.substr(str.indexOf('<div class="list">'),1000);

	var reg=/<div class="a2">.*?<\/div>/g;

	//str=str.substr(str.indexOf('<div class="a1">'),5);
	match=str.match(reg);

	var dd=match[0].substr(16,5);
	var dd1='';
	for(var i=0;i<dd.length;i++){
	if(dd1.length>0) dd1+=',';
	dd1+=dd[i];

	}


		var reg=/<div class="a1">.*?<\/div>/g;

	//str=str.substr(str.indexOf('<div class="a1">'),5);
	match=str.match(reg);

	var number=mytime+match[0].substr(16,4);


	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	return {
			type:type,
			time:mytime,
			number:number,
			data:dd1
		};



}



function  getFromTxCP1(str, type){


	str=  JSON.parse(str);


	var time =str[0].onlinetime.toString();
	var aa=time.substr(0,4)+time.substr(5,2)+time.substr(8,2);

	var number=str[0].issuenumber.toString();;


	var dd=str[0].opennumber.toString();


		return {
			type:type,
			time:time,
			number:number,
			data:dd
		};

}


function getFrom6vcsCP(str,type){


	str=str.substr(str.indexOf(' <th>在线人数</th>'),470);
	var reg=/<td>.*?<\/td>/g;
	var match=str.match(reg);

	var time=match[0].replace(/<td>/g, '');
	time=time.replace(/<\/td>/g, '').toString();
	var aa=time.substr(0,4)+time.substr(5,2)+time.substr(8,2);
	var number=aa+parseInt(parseInt(60*time.substr(11,2))+parseInt(time.substr(14,2)));
	var num=0;
	var onlinenumber=match[1].replace(/<td>/g, '');
	onlinenumber=onlinenumber.replace(/<\/td>/g, '').toString();
	for(var i=0;i<onlinenumber.length;i++){

		num+=parseInt(onlinenumber.substr(i,1));

	}

	var dd=num.toString().substr(num.toString().length-1,1)+','+onlinenumber.substr(onlinenumber.length-4,1)+','+onlinenumber.substr(onlinenumber.length-3,1)+','+onlinenumber.substr(onlinenumber.length-2,1)+','+onlinenumber.substr(onlinenumber.length-1,1);


	return {
		type:type,
		time:time,
		number:number,
		data:dd
	};

}




function getFrom168CP(str, type){
	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();


	str=  JSON.parse(str);
	str=str.list[0];
	var l_t=str.c_t.toString();

	var  mynumber=l_t.substr(0, 8)+l_t.substr(8,3);

	try{
//
//
		var data={
			type:type,
			time:mytime,
			number:mynumber,
		data:str.c_r
	};

	return data;
	}catch(err){
		throw('168解析数据失败');
	}
//


}

function getFrom168APICP(str, type){
	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();


	str=  JSON.parse(str);
str=str.result.data;



	var  mynumber=str.preDrawIssue.toString();

	try{
//
//
		var data={
			type:type,
			time:mytime,
			number:mynumber,
		data:str.preDrawCode.toString()
	};

	return data;
	}catch(err){
		throw('168解析数据失败');
	}
//


}

function  getFromxmlCP(str, type){

	//str=str.substr(0,200);
	var reg=/expect="(.*?)" opencode="(.*?)" opentime="(.*?)"/;
	//<row expect="2013072213" opencode="07,16,03,17,01,05,13,12" opentime="2013-07-22 02:03:20" />
	var m;

	if(m=str.match(reg)){


		return {
			type:type,
			time:m[3],
			number:m[1],
			data:m[2]
		};
	}

}

function  getFromxml5CP(str, type,config){

	//str=str.substr(0,200);
	var reg=/<row expect="(\d+?)" opentime="([\d\:\- ]+?)" opencode="([\d\,]+?)"/g;
	var reg1=/<row expect="(\d+?)" opentime="([\d\:\- ]+?)" opencode="([\d\,]+?)"/;
	//<row expect="2013072213" opencode="07,16,03,17,01,05,13,12" opentime="2013-07-22 02:03:20" />
	var m;
	var number='';
	var data='';
	var time='';
	if(m=str.match(reg)){

		for(var i=0;i<m.length;i++){
			var temp=m[i];
			var m1=temp.match(reg1)	;
			if(number=='') number=m1[1];else number+="|"+m1[1];
			if(time=='') time=m1[2];else time+="|"+m1[2];
			if(data=='') data=m1[3];else data+="|"+m1[3];

		}


		var data1 ={
				type:type,
				time:time,
				number:number,
				data:data

		};
		 //submitData(data, conf);
		return data1;
	}

}

function getFrom168K3(str, type){
	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();


	str=  JSON.parse(str);
	var l_t=str.l_t.toString();
	var  mynumber='20' + l_t.substr(0, 6)+'-0'+str.l_c;
	//log('++++++++++++'+l_t.substring(0,8));
	try{
//
//
		var data={
			type:type,
			time:mytime,
			number:mynumber,
		data:str.l_r
	};
	log(mynumber);
	return data;
	}catch(err){
		throw('168解析数据失败');
	}
//


}





function getFrom360CP(str, type){

	str=str.substr(str.indexOf('<em class="red" id="open_issue">'),380);
	//console.log(str);
	var reg=/[\s\S]*?(\d+)<\/em>[\s\S].*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	//console.log(match);
	if(match.length>1){
		if(match[1].length==7) match[1]=year+match[1].replace(/(\d{8})(\d{3})/,'$1-$2');
		if(match[1].length==6) match[1]=year+match[1].replace(/(\d{4})(\d{2})/,'$1-0$2');
		if(match[1].length==9) match[1]='20'+match[1].replace(/(\d{6})(\d{2})/,'$1-$2');
		if(match[1].length==10) match[1]=match[1].replace(/(\d{8})(\d{2})/,'$1-0$2');
		var mynumber=match[1].replace(/(\d{8})(\d{3})/,'$1-$2');
		mynumber=mynumber.replace('-',"");
		try{
			var data={
				type:type,
				time:mytime,
				number:mynumber
			}

			reg=/<li class=".*?">(\d+)<\/li>/g;
			data.data=match[2].match(reg).map(function(v){
				var reg=/<li class=".*?">(\d+)<\/li>/;
				return v.match(reg)[1];
			}).join(',');

			//console.log(data);
			return data;
		}catch(err){
			throw('解析数据失败');
		}
	}
}

function getCQsscGw(str, type,gameName){


	str = str.substr(str.indexOf('name="description"'),100).replace(/[\r\n]+/g,'');
	var reg =new RegExp(gameName+"第(\\d+-\\d+)期开奖号码:(\\d+),开奖时间","");

	var match=str.match(reg);

	if(!match) throw new Error('-------------------------'+gameName+'官网数据不正确');


	var ano =  match[1];

	var data= match[2]+'';
	var data = data.split("").join(',');

	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();



	try{
		var data={
			type:type,
			time:mytime,
			number:ano,
			data:data
		}

	//	console.log(gameName);
		//console.log(data);
		return data;
	}catch(err){
		throw('解析'+gameName+'官网数据失败');
	}
}


function getFromXJFLCPWeb(str, type){
	str=str.substr(str.indexOf('<td><a href="javascript:detatilssc'), 300).replace(/[\r\n]+/g,'');

	var reg=/(\d{10}).+(\d{2}\:\d{2}).+<p>([\d ]{9})<\/p>/,
	match=str.match(reg);

	if(!match) throw new Error('数据不正确');
	//console.log('期号：%s，开奖时间：%s，开奖数据：%s', match[1], match[2], match[3]);

	try{
		var data={
			type:type,
			time:match[1].replace(/^(\d{4})(\d{2})(\d{2})\d{2}/, '$1-$2-$3 ')+match[2],
			number:match[1].replace(/^(\d{8})(\d{2})$/, '$1-$2'),
			data:match[3].split(' ').join(',')
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFrom360sd11x5(str, type){

	str=str.substr(str.indexOf('<em class="red" id="open_issue">'),380);
	//console.log(str);
	var reg=/[\s\S]*?(\d+)<\/em>[\s\S].*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	//console.log(mytime);
	//console.log(match);

	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:mytime,
			number:year+match[1].replace(/(\d{4})(\d{2})/,'$1-0$2')
		}

		reg=/<li class=".*?">(\d+)<\/li>/g;
		data.data=match[2].match(reg).map(function(v){
			var reg=/<li class=".*?">(\d+)<\/li>/;
			return v.match(reg)[1];
		}).join(',');

		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromPK10(str, type){
	str=str.substr(str.indexOf('<div class="lott_cont">'),118).replace(/[\r\n]+/g,'');
	var reg=/<td class=".*?">(\d+)<\/td>[\s\S]*?<td>(.*)<\/td>[\s\S]*?<td class=".*?">([\d\:\- ]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	var myDate = new Date();
	var year = myDate.getFullYear();
	var mytime=year + "-" + match[3];
	try{
		var data={
			type:type,
			time:mytime,
			number:match[1],
			data:match[2]
		};
		return data;
	}catch(err){
		throw('解析数据失败');
	}

}


function getPk10Fromcj(str, type){

	str = str.substr(str.indexOf('id="n_bjpk10"'),1050).replace(/[\r\n]+/g,'');


	var reg =/value='(\d+)'/g;

	var data='';
	while(reg.test(str)){
		data+=RegExp.$1+",";

		}

	if(data.length==0){
		throw new Error('pk10数据不正确');

	}
	data=data.substr(0,data.length-1);
	reg=/<td class="qihao">(\d+)[\s\S]*?<\/td>/;
	var match=str.match(reg);
	if(!match) throw new Error('pk10数据不正确');

	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	var ano = match[1];




	try{
		var data={
			type:type,
			time:mytime,

			number:ano,
			data:data
		}


		return data;
	}catch(err){
		throw('解析pk10数据失败');
	}
}

function getFrom360CPK3(str, type){

	str=str.substr(str.indexOf('<em class="red" id="open_issue">'),380);
	//console.log(str);
	var reg=/[\s\S]*?(\d+)<\/em>[\s\S].*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年
    var month = myDate.getMonth() + 1;     //月
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	//console.log(match);
	match[1]=match[1].replace(/(\d{4})(\d{2})/,'$1$2');

		try{
			var data={
				type:type,
				time:mytime,
				number:match[1]
			}

			reg=/<li class=".*?">(\d+)<\/li>/g;
			data.data=match[2].match(reg).map(function(v){
				var reg=/<li class=".*?">(\d+)<\/li>/;
				return v.match(reg)[1];
			}).join(',');

			//console.log(data);
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}
