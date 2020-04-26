

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
	var l_t=str.c_t.toString();
	var  mynumber=l_t.substr(0, 8)+l_t.substr(8,3);

	try{
//		
//	
		var data={
			type:type,
			time:mytime,
			number:mynumber,
		data:str.l_r
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
