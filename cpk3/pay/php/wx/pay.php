<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <title>微信扫码支付</title>
    <link rel="stylesheet" type="text/css" href="wxres/Comm_weixin.css" />
    <link rel="stylesheet" type="text/css" href="wxres/WeixinPay.css" />


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/qrcode.min.js"></script>
</head>
<body>
<?
 $amt =$_GET['amount'];;
 //$amt ="0.01";
 $out_trade_no =$_GET['charge_id'];;
 
 $para = "?amt=$amt&orderid=$out_trade_no";
 $backurl=$_GET['url']."&success=1&payid=".$_GET['charge_id'];
 $url = 'http://'.$_SERVER['HTTP_HOST']."/pay/php/wx/mobile.aspx?amount={$_GET['amount']}&charge_id={$_GET['charge_id']}&userid={$_GET['userid']}&url={$backurl}";

?>

    <input name="hidShopID" type="hidden" id="hidShopID" value="141027161101330617" />
    <input name="hidIsBuyPay" type="hidden" id="hidIsBuyPay" value="1" />
    <div class="wx_header">
        <div class="wx_logo"><img title="微信支付" alt="微信支付标志" src="wxres/wxlogo_pay.png" /></div>
    </div>
    <div class="weixin">
        <div class="weixin2">
            <b class="wx_box_corner left pngFix"></b><b class="wx_box_corner right pngFix"></b>
            <div class="wx_box pngFix">
                <div class="wx_box_area">
                    <div class="pay_box qr_default">
                        <div class="area_bd"><span class="wx_img_wrapper"  id="qr_box">
                           <div align="center" id="qrcode" class="ewm_wrapper"></div>
						   <div id="resmsgdiv"></div>
                            <img style="left: 50%; opacity: 0; display: none; margin-left: -101px;" class="guide pngFix" src="wxres/wxwebpay_guide.png" alt="" id="guide" />
                        </span>
                            <div class="msg_default_box"><i class="icon_wx pngFix"></i>
                                <p>
                                    请使用微信扫描<br/>
                                    二维码以完成支付
                                </p>
                            </div>
                            <div class="msg_box"><i class="icon_wx pngFix"></i>
                                <p><strong>扫描成功</strong>请在手机确认支付</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wx_hd">
                    <div class="wx_hd_img icon_wx"></div>
                </div>
                <div class="wx_money"><span>￥</span><?php echo $amt;?></div>
                <!--支付订单号-->
                <div class="wx_pay">
                    <p><span  class="wx_left">支付订单号</span>
					<span id="dingdan"  ddcode="<?php echo $out_trade_no;?>"  class="wx_right" ><?php echo $out_trade_no;?></span></p>
					 <p><span  class="wx_left">订单时间</span>
					<span  class="wx_right" ><?php echo date("Y-m-d H:i:s",time());?></span></p>
                    <p><span class="wx_left">商品名称</span><span class="wx_right">充值</span></p>
                </div>
                <div class="wx_kf">
                    <div class="wx_kf_img icon_wx"></div>
                    <div class="wx_kf_wz">
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 

<input id="text" type="hidden" value="<?=$url?>" style="width:80%" /><br />
<div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 100,
	height : 100
});

function makeCode () {		

	var str = "<?php echo $url;?>";
	qrcode.makeCode(str);
}

makeCode();

</script>

 <script>	
			
 function  get_next(){
		if(window.ActiveXObject){
			var xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		else if(window.XMLHttpRequest){
			var xmlHttp = new XMLHttpRequest();
		}

		xmlHttp.open('GET',"/index_payreturn.html<?php echo "?type=getshow&id=".$_GET['chrage_id'];?>&rand="+Math.random(),true);
		xmlHttp.onreadystatechange=function(){


			var msg=xmlHttp.responseText;

	if(msg==1) {


		location.href='/index_payreturn.html?return=success';
	}


		};
		xmlHttp.send(null);

	}
	get_next();
			setInterval(function(){get_next();} , 5000);

		</script>	
