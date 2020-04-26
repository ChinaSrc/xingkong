


<!DOCTYPE html>
<style>
    .lu_toper {
        width: 100%;
        height: 25px;
        line-height: 25px;
        background: #81878b;
        text-align: right;
        color: #fff;
    }

    .lu_top {
        width: 950px;
        margin: 0 auto;
        font-size: 12px;
    }

    .lu_login {
        width: 100%;
        background: #fff;
        border-bottom: 1px solid #ccc;
        min-height: 60px;
    }

    .lu_log {
        width: 950px;
        margin: 0 auto;
        padding-top: 10px;
    }

    .lu_main {
        width: 950px;
        margin: 0 auto;
        min-height: 500px;
        border-radius: 5px;
        margin-top: 30px;
    }

    .lu_maintop {
        width: 100%;
    }

    .lu_main {
        font-size: 14px;
    }

    .fl {
        float: left;
    }

    .fr {
        float: right;
    }

    .clear {
        clear: both;
    }

    .jaige {
        font-size: 30px;
        color: #3cb034;
        font-weight: 600;
        font-family: "微软雅黑";
        margin-top: -20px;
    }

    .lu_mianer {
        width: 950px;
        min-height: 600px;
        background: #fff;
        border-radius: 1px;
        border-top: 3px solid #ccc;
        border-bottom: 3px solid #ccc;
        margin-top: 10px;
    }

    .erweima {
        width: 200px;
        margin-top: 100px;
        text-align: center;
        margin-left: 366px;
        box-shadow:0 0 5px #ccc; padding:10px;
    }

    .weixn {
        margin-left: 20px;
        margin-top: 200px;
    }

    .banquan {
        width: 100%;
        text-align: center;
        font-size: 12px;
        margin-top: 20px;
        color: #808080;
    }
</style>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript" src="js/qrcode.min.js"></script>  
</head>

<body style="background: #eff1f1; padding: 0; margin: 0;">
<?php
 $amt = $_POST['p3_Amt'];
 $out_trade_no = $_POST['p2_Order'];
 
 $para = "?amt=$amt&orderid=$out_trade_no";
 $url = 'http://'.$_SERVER['HTTP_HOST'].'/wx/mobile.php'.$para;

?>    


        <div class="lu_toper">
            <div class="lu_top">欢迎使用微信付款</div>
        </div>
        <div>
            <div class="lu_login">
                <div class="lu_log">
                    <img src="login.jpg" /></div>
            </div>
            <div class="lu_main">
                <div class="lu_maintop">
                    <p>正在使用即时到账交易<span style="color: #3cb034;">[?]</span></p>
                    <div>
                        <div class="fl"><b><?php echo $_POST['pa_MP'];?></b><span style="margin-left: 10px; font-size: 12px;">收款方：平台</span></div>
                        <div class="fr jaige">
                            ￥<?php echo $amt;?>元
							<input type="hidden" name="dingdan" id="dingdan" value="<?php echo $out_trade_no;?>"/>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="lu_mianer">
                   
                    <div class="fl erweima" style="position:relative;">
                         <div style="position:absolute; left:0; bottom:-25px; font-size:12px; color:#666; width:210px; text-align:center; text-decoration:underline;">首次使用请下载手机微信</div>
						 <div id="qrcode"></div>
                        <div class="fl" style="width:20%; margin-top:10px; margin-left:18px;"><img src="sao.jpg" /></div>
                        <div class="fl" style="width:60%; text-align:center; font-size:12px; line-height:16px; margin-top:5px;">打开手机微信<br />
                            扫一扫继续付款
                        </div>
                    </div>
                   
                    <div class="fl weixn">
                        <img src="weixn.png" /></div>
                </div>
            </div>
            <div class="banquan">weixin 1998 - 2016 Tencent Inc. All Rights Reserved</div>


        </div>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 200,
	height : 200
});

function makeCode () {		

	var str = "<?php echo $url;?>";
	qrcode.makeCode(str);
}

makeCode();

</script>
 <script>	
			
		var timer;
		$(function(){
			var handler = function(){
				var orderId = $("#dingdan").val();
				//orderId="782570";
				$.post("query.php?orderId="+orderId,null,function(msg){
					if(msg == 'SUCCESS'){
						document.location.href="success.html";
						clearInterval(timer);
					}
				});
			}
			timer = setInterval(handler , 5000);
		});
		</script>	
</body>
</html>
