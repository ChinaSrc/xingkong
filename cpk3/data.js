var weburl="http://lecai500.com";

var played={}, mysql=require('mysql'),
    http=require('http'),
    https=require('https'),
    url=require('url'),
    crypto=require('crypto'),
    querystring=require('querystring'),

    config=require('./config.js'),

    calc=require('./kj-data/kj-calc-time.js'),
    exec=require('child_process').exec,
    execPath=process.argv.join(" "),
    parse=require('./kj-data/parse-calc-count.js');
require('./String-ext.js');
var zlib = require('zlib');
//console.log(cofig1);
//config.cp=config1.cp;
// 抛出未知出错时处理
process.on('uncaughtException', function(e){
    console.log(e.stack);
});

// 自动重启
if(config.restartTime){
    setTimeout(function(exec, execPath){
        exec(execPath);
        process.exit(0);
    }, config.restartTime * 3600 * 1000, exec, execPath);
}

var timers={};		// 任务记时器列表
var encrypt_key='cc40bfe6d972ce96fe3a47d0f7342cb0';

http.request=(function(_request){
    return function(options,callback){
        var timeout=options['timeout'],
            timeoutEventId;
        var req=_request(options,function(res){
            res.on('end',function(){
                clearTimeout(timeoutEventId);
                //console.log('response end...');
            });

            res.on('close',function(){
                clearTimeout(timeoutEventId);
                //console.log('response close...');
            });

            res.on('abort',function(){
                //console.log('abort...');
            });

            callback(res);
        });

        //超时
        req.on('timeout',function(){
            //req.res && req.res.abort();
            //req.abort();
            req.end();
        });

        //如果存在超时
        timeout && (timeoutEventId=setTimeout(function(){
            req.emit('timeout',{message:'have been timeout...'});
        },timeout));
        return req;
    };
})(http.request);

//console.log(config);
getPlayedFun(runTask);

//{{{
function getPlayedFun(cb){
    cb();

}

function runTask(){
    if(config.cp.length) config.cp.forEach(function(conf){
        timers[conf.name]={};
        timers[conf.name][conf.timer]={timer:null, option:conf};
        try{
            if(conf.enable) run(conf);
        }catch(err){
            //timers[conf.name][conf.timer].timer=setTimeout(run, config.errorSleepTime*1000, conf);
            restartTask(conf, config.errorSleepTime);
        }
    });
}

function restartTask(conf, sleep, flag){

    if(sleep<=0) sleep=config.errorSleepTime;

    if(!timers[conf.name]) timers[conf.name]={};
    if(!timers[conf.name][conf.timer]) timers[conf.name][conf.timer]={timer:null,option:conf};

    if(flag){
        var opt;
        for(var t in timers[conf.name]){
            opt=timers[conf.name][t].option;
            clearTimeout(timers[opt.name][opt.timer].timer);
            timers[opt.name][opt.timer].timer=setTimeout(run, sleep*1000, opt);


            log('休眠'+sleep+'秒后从'+opt.source+'采集'+opt.title+'数据...');
        }
    }else{
        clearTimeout(timers[conf.name][conf.timer].timer);
        timers[conf.name][conf.timer].timer=setTimeout(run, sleep*1000, conf);
        log('休眠'+sleep+'秒后从'+conf.source+'采集'+conf.title+'数据...');
    }
}

function run(conf){
    //console.log(timers);
    if(timers[conf.name][conf.timer].timer) clearTimeout(timers[conf.name][conf.timer].timer);
    //console.log(timers);

    log('开始从'+conf.source+'采集'+conf.title+'数据');
    var option=JSON.parse(JSON.stringify(conf.option));
    //option.path+='?'+(new Date()).getTime();
    //log(option.host);

    if(option.host.indexOf("caipiaokong") > 0  || option.host.indexOf("1399klc") > 0 || option.host.indexOf("1060") > 0 ){
        //log(option.host);
        https.request(option, function(res){

            var data="";
            res.on("data", function(_data){
                //console.log(_data.toString());
                data+=_data.toString();
            });

            res.on("end", function(){

                try{
                    try{
                        //data=onparse[conf.name](data);
                        data=conf.parse(data);
                    }catch(err){
                        throw('解析'+conf.title+'数据出错：'+err);
                    }

                    //console.log(data);

                    try{

                        if(data.number.indexOf('|')>0){

                            var number11=data.number.split("|");
                            var time11=data.time.split("|");

                            var data11=data.data.split("|");
                            for(var i=number11.length-1;i>=0;i--){

                                var data1 ={
                                    type:data.type,
                                    time:time11[i],
                                    number:number11[i],
                                    data:data11[i]

                                };
                                submitData(data1, conf);
                            }

                        }
                        else{
                            submitData(data, conf);

                        }

                    }catch(err){
                        //console.log(err);
                        throw('提交出错：'+err);
                    }

                }catch(err){
                    log('运行出错：%s，休眠%f秒'.format(err, config.errorSleepTime));
                    restartTask(conf, config.errorSleepTime);
                }

            });

            res.on("error", function(err){

                log(err);
                restartTask(conf, config.errorSleepTime);

            });

        }).on('timeout', function(err){
            log('从'+conf.source+'采集'+conf.title+'数据超时');
            restartTask(conf, config.errorSleepTime);
        }).on("error", function(err){
            // 一般网络出问题会引起这个错

            log(err);
            restartTask(conf, config.errorSleepTime);

        }).end();

    }

    else{

        http.request(option, function(res){

            var data="";
            res.on("data", function(_data){
                //console.log(_data.toString());
                data+=_data.toString();
            });

            res.on("end", function(){

                try{
                    try{
                        //data=onparse[conf.name](data);
                        data=conf.parse(data);
                    }catch(err){
                        throw('解析'+conf.title+'数据出错：'+err);
                    }

                    //console.log(data);

                    try{

                        if(data.number.indexOf('|')>0){

                            var number11=data.number.split("|");
                            var time11=data.time.split("|");

                            var data11=data.data.split("|");
                            for(var i=number11.length-1;i>=0;i--){

                                var data1 ={
                                    type:data.type,
                                    time:time11[i],
                                    number:number11[i],
                                    data:data11[i]

                                };
                                submitData(data1, conf);
                            }

                        }
                        else{
                            submitData(data, conf);

                        }



                    }catch(err){
                        //console.log(err);
                        throw('提交出错：'+err);
                    }

                }catch(err){
                    log('运行出错：%s，休眠%f秒'.format(err, config.errorSleepTime));
                    restartTask(conf, config.errorSleepTime);
                }

            });

            res.on("error", function(err){

                log(err);
                restartTask(conf, config.errorSleepTime);

            });

        }).on('timeout', function(err){
            log('从'+conf.source+'采集'+conf.title+'数据超时');
            restartTask(conf, config.errorSleepTime);
        }).on("error", function(err){
            // 一般网络出问题会引起这个错

            log(err);
            restartTask(conf, config.errorSleepTime);

        }).end();


    }

}

function cryptPwd(password) {
    var md5 = crypto.createHash('md5');
    return md5.update(password).digest('hex');
}

function submitData(data, conf){
    log('提交从'+conf.source+'采集的'+conf.title+'第'+data.number+'数据：'+data.data);
    var salt=Math.floor(Math.random()*100);
    var pwdstr=cryptPwd(cryptPwd('zgqsoft')+salt);

    var gourl=weburl+'/api1.aspx?type=lottery_add&playkey='+conf.name+'&period='+data.number+'&number='+encodeURI(data.data)+'&pwdstr='+pwdstr+'&salt='+salt;

    var number=data.number;
    restartTask(conf, config.errorSleepTime);
    http.get(gourl, function(res) {

        res.on('data', function(data) {

            data = data.toString().replace(/ /g,'')

            if(data.toString().indexOf('|')>0){
                var arr=data.toString().split("|");
                if(arr[0].toString().indexOf('true')>-1){

                    log('写入'+conf['title']+'第'+number+'期数据成功');
                    if(arr[1]){

                        restartTask(conf, arr[1].toString(), true);
                    }
                    else{


                        restartTask(conf, config.errorSleepTime);
                    }


                }
                else{

                    log('写入'+conf['title']+'第'+number+'期数据失败');
                    restartTask(conf, config.errorSleepTime);

                }


            }
            else{

                log('写入'+conf['title']+'第'+number+'期数据失败');
                restartTask(conf, config.errorSleepTime);
            }

            //var json=JSON.parse(data.toString());

            //log(data);

            //    if(conf.name=='BJKL8') console.log(gourl);







        });
    }).on('error', function(e) {

    	log(e);
        console.log("Got error: " + e.message);
    });


    return true;

}
