

<div  class="winningList box boxShadow"
      style='display:block; border:1px #ddd solid;margin-top:10px;width: calc(100% - 12px);padding: 5px;background-color: #fff;'>
    <div class="listtitle">
        <h3   name="lotteryTitle" class="active"  onclick="change_lot(0);">最新中奖</h3>
        <h3   name="lotteryTitle" onclick="change_lot(1);">昨日排行</h3>

    </div>

    <div  id="Ranking" class="winnerListSlide" style="width: 100%; box-sizing: content-box;">
        <div  name="lotteryInfo"  style="width: 100%; ">
            <div class="firsttitle"  width="100%" style="display: none">
                中奖信息实时更新

            </div>
            <div  class="bd">
                <div  class="tempWrap">
                    <ul  class="winnerList" style="cursor: pointer; clear: both;position: relative; transition: all 0.3s linear;">

                    </ul>
                </div>
            </div>
        </div>
        <div  name="lotteryInfo" style="width: 100%;display: none">

            <div  class="yestoday" >
                <ul id="yestoday_buy"></ul>


            </div>

        </div>
    </div>
</div>




<script type="text/javascript">
var shownum=3;

shownum=parseInt(shownum);
    function change_lot(num) {

        var lotteryTitle   = document.getElementsByName('lotteryTitle');
        var lotteryInfo   = document.getElementsByName('lotteryInfo');
        for(var i=0;i<lotteryTitle.length;i++){

            if(i==num){
                lotteryTitle[i].className='active';
                lotteryInfo[i].style.display='block';
            }
            else{

                lotteryTitle[i].className='';
                lotteryInfo[i].style.display='none';
            }
        }

        if(num==1){

            if(document.querySelector('#yestoday_buy').innerHTML==''){

                document.querySelector('#yestoday_buy').innerHTML="loading...";
                ajaxobj=new AJAXRequest;
                ajaxobj.method="POST";
                ajaxobj.url="do.aspx?mod=ajax&code=show&list=content&active=yestoday_buy&num="+shownum+"&flag=yes&playkey="+gamekey;
                ajaxobj.callback=function(xmlobj){
                    var response = xmlobj.responseText;

                    document.querySelector('#yestoday_buy').innerHTML=response;

                };ajaxobj.send();

            }



        }


    }

    function set_display(div){

        if(document.getElementById(div).style.display=='none')
            document.getElementById(div).style.display='block';
        else
            document.getElementById(div).style.display='none';
    }

    var winli= document.querySelector('.winnerList').querySelectorAll('li');

    var winli_num=0;
    var winlitime1=''
    var winlitime2=''
    function  set_winlist_show() {

        winli_num++;

        if (winli_num > winli.length - shownum-1) winli_num = 0;
        for (var i = 0; i < winli.length; i++) {
            winli[i].style.marginTop='0px';

            winli[i].style.opacity=1;
            if (i >= winli_num && i < winli_num + shownum) {

                winli[i].style.display = 'block';

            }
            else {
                winli[i].style.display = 'none';

            }
        }

        var top = 0;
        var opc=1;
        clearInterval(winlitime2);
        winlitime2 = setInterval(function () {
            top = top - 2;
            opc=opc-1/30;

            try
            {
                winli[winli_num].style.opacity=opc;
                winli[parseInt(winli_num)+parseInt(shownum)].style.opacity=1-opc;

                 if(opc>0.1)
                     winli[parseInt(winli_num)+parseInt(shownum)].style.display = 'none';
                     else
                winli[parseInt(winli_num)+parseInt(shownum)].style.display = 'block';
            }
            catch(err)
            {
                //在这里处理错误
            }


            for (var i = 0; i < winli.length; i++) {
                winli[i].style.top = top + 'px';
            }
            if (top <= -60) {
                try
                {
                    winli[winli_num].style.display='none';

                }
                catch(err)
                {
                    //在这里处理错误
                }

                for (var i = 0; i < winli.length; i++) {
                    winli[i].style.top ='0px';
                }
                clearInterval(winlitime2);
            }


        }, 300 / 30);


        // document.querySelector('.winnerList').style.top=winli_top+'px';
    }



    document.querySelector('.winnerList').onmousemove=function () {
        clearInterval(winlitime1);
    }

    document.querySelector('.winnerList').onmouseleave=function () {

        clearInterval(winlitime1);
        winlitime1=  setInterval(function () {
            set_winlist_show();
        },3000)
    }



    ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.url="do.aspx?mod=ajax&code=show&list=content&active=show_playuserlist&flag=yes&num="+4*shownum+"&playkey="+gamekey;
    ajaxobj.callback=function(xmlobj){
        var response = xmlobj.responseText;

        document.querySelector('.winnerList').innerHTML=response;
        winli= document.querySelector('.winnerList').querySelectorAll('li');
        for (var i = 0; i < winli.length; i++) {
            if (i >= 0 && i <shownum) {
                winli[i].style.display = 'block';
            }
            else {
                winli[i].style.display = 'none';
            }
        }


        clearInterval(winlitime1);
        winlitime1=  setInterval(function () {
            set_winlist_show();
        },3000)
    };ajaxobj.send();
   if(gamekey!=''){
       document.querySelector('.winnerListSlide').querySelector('.firsttitle').style.display='block';

   }

</script>