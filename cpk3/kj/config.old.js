exports.cp=[{
		title:'北京PK10',
		source:'168开奖网',
		name:'BJPK10',
		enable:true,
		timer:'BJPK10-0',

			option:{
			host:'kj.1680api.com',
			timeout:40000,
			path: '/Open/GroupsOpen?codes=10016',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'BJPK10');
			}catch(err){
				throw('北京PK10从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'腾讯分分彩',
		source:'腾讯',
		name:'TXSSC',
		enable:true,
		timer:'TXSSC-0',

			option:{
			host:'www.77tj.org',
			timeout:40000,
			path: '/api/tencent/onlineim',

		},
		parse:function(str){
			try{
				return getFromTxCP(str,'TXSSC');
			}catch(err){
				throw('腾讯分分彩从腾讯解析数据不正确');
			}
		}

		},

		{
		title:'重庆时时彩',
		source:'360彩票',
		name:'CQSSC',
		enable:true,
		timer:'CQSSC-0',

			option:{
			host:'cp.360.cn',
			timeout:40000,
			path: '/ssccq/',

		},
		parse:function(str){
			try{
				return getFrom360CP(str,'CQSSC');
			}catch(err){
				throw('重庆时时彩从360彩票解析数据不正确');
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
		title:'吉林快三',
		source:'360彩票',
		name:'JLK3',
		enable:true,
		timer:'JLK3-1',

			option:{
			host:'cp.360.cn',
			timeout:40000,
			path: '/k3jl/',

		},
		parse:function(str){
			try{
				return getFrom360CP(str,'JLK3');
			}catch(err){
				throw('吉林快三从360彩票解析数据不正确');
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
				throw('湖北快三从360彩票解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=1006',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'JSK3');
			}catch(err){
				throw('江苏快三从168开奖网解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=1001',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'JX11-5');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10021',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'TJSSC');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10011',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'CQSSC');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10022',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'XJSSC');
			}catch(err){
				throw('新疆时时彩从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'腾讯分分彩-1',
		source:'6cvs',
		name:'TXSSC',
		enable:true,
		timer:'TXSSC-1',

			option:{
			host:'www.6vcs.cn',
			timeout:40000,
			path: '/online',

		},
		parse:function(str){
			try{
				return getFrom6vcsCP(str,'TXSSC');
			}catch(err){
				throw('腾讯分分彩-1从6cvs解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=1003',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'SD11-5');
			}catch(err){
				throw('山东11选5从168开奖网解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10013',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'JLK3');
			}catch(err){
				throw('吉林快三从168开奖网解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10080',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'HUBK3');
			}catch(err){
				throw('湖北快三从168开奖网解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=1007',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'GD11-5');
			}catch(err){
				throw('广东11选5 从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'台湾宾果-1',
		source:'168开奖网',
		name:'TWKL8',
		enable:true,
		timer:'TWKL8-1',

			option:{
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10050',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'TWKL8');
			}catch(err){
				throw('台湾宾果-1从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:' 加拿大卑诗快乐8-1',
		source:'168开奖网',
		name:'JNDKL8',
		enable:true,
		timer:'JNDKL8-1',

			option:{
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10041',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'JNDKL8');
			}catch(err){
				throw(' 加拿大卑诗快乐8-1从168开奖网解析数据不正确');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=10014',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'BJKL8');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=2002',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'3D');
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
			host:'kj.1680api.com',
			timeout:40000,
			path: '/open/GroupsOpen?codes=2007',

		},
		parse:function(str){
			try{
				return getFrom168CP(str,'PL3');
			}catch(err){
				throw('排列三从168开奖网解析数据不正确');
			}
		}

		},

		{
		title:'韩国快乐8',
		source:'开奖网',
		name:'HGKL8',
		enable:true,
		timer:'HGKL8-0',

			option:{
			host:'ssc1710.local.com',
			timeout:40000,
			path: '/test.aspx?name=hgklb&format=xml5&uid=691079&token=656ea43450887b4e4ea8d2685c7e5056d56798c4'

		},
		parse:function(str){
			try{

				var con={
						title:'东京快乐8',
						source:'开奖网',
						name:'DJKL8',
						enable:true,
						timer:'DJKL8-0',
						errorSleepTime:15,
						restartTime:0

				};

				return getFromxml5CP(str,'HGKL8',con);
			}catch(err){
				throw('韩国快乐8从开奖网解析数据不正确');
			}
		}

		},

		{
		title:'东京快乐8',
		source:'开奖网',
		name:'DJKL8',
		enable:true,
		timer:'DJKL8-0',

			option:{
			host:'ssc1710.local.com',
			timeout:40000,
			path: '/test.aspx?name=djklb&format=xml5&uid=691079&token=656ea43450887b4e4ea8d2685c7e5056d56798c4',

		},
		parse:function(str){
			try{

				var con={
						title:'东京快乐8',
						source:'开奖网',
						name:'DJKL8',
						enable:true,
						timer:'DJKL8-0',
						errorSleepTime:15,
						restartTime:0

				};
				return getFromxml5CP(str,'DJKL8',con);
			}catch(err){
				throw('东京快乐8从开奖网解析数据不正确');
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

function  getFromxmlCP(str, type){

	//str=str.substr(0,200);
	var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/;
	//<row expect="2013072213" opencode="07,16,03,17,01,05,13,12" opentime="2013-07-22 02:03:20" />
	var m;

	if(m=str.match(reg)){


		return {
			type:type,
			time:m[3],
			number:m[1].replace(/^(\d{8})(\d{2})$/, '$1-0$2'),
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
