


<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />




	<style type="text/css">
	label{display:block;height:40px;position:relative;}
	.tips {position:absolute; float:left;line-height:38px;left:160px;color:#BCBCBC;cursor:text;}
	.input_txt{border:solid 1px #ccc;box-shadow:0 1px 10px rgba(0,0,0,0.1) inset;height:38px;text-indent:10px; font-size:15px;}
	.input_txt:focus{box-shadow:0 0 4px rgba(255,153,164,0.8);border:solid 1px #6B97B2;}

    .bindBankCard {
        padding: 24px;
        clear: both;
        min-height: 100px;
        display: block;;
        overflow: hidden;
    }

    .bindBankCard .cardEmpty {
        box-shadow: none;
        border: 1px dashed #ddd;
        text-align: center;
        line-height: 135px;
        font-size: 14px;
        color: #4aa9db
    }

    .bindBankCard .cardEmpty:hover {
        box-shadow: none
    }

    .cardItems {
        float: left;
        border-radius: 5px;
        border: 1px solid #e4e4e4;
        box-shadow: 0 1px 1px #c9c9c9;
        box-sizing: border-box;
        width: 249px;
        height: 140px;
        position: relative;
        margin-right: 13px;
        margin-bottom: 13px
    }

    .cardItems:last-child {
        margin-right: 0
    }

    .cardItems:hover {
        border-radius: 5px;
        border: 1px solid #c9c9c9;
        box-shadow: 0 0 10px #c9c9c9
    }

    .cardItems:nth-child(3n+3) {
        margin-right: 0
    }

    .cardItems i {
        display: inline-block;
        width: 20px;
        height: 20px;
        background-size: 20px!important;
        vertical-align: sub;
        margin-right: 8px
    }

    .cardItems .bankName {
        padding: 10px 0;
        margin: 0 14px;
        border-bottom: 1px dotted #d9d9d9;
        font-size: 14px
    }

    .cardItems .bankAccount {
        position: absolute;
        top: 10px;
        right: 14px;
        text-align: right;
        font-size: 12px
    }

    .cardItems .cardInfo {
        height: 28px;

        font-size: 14px;
        padding-top: 13px;
        width: 100%
    }

    .cardItems .cardInfo .cardType {
        width: 88px;
        height: 25px;
        line-height: 25px;
        color: #eee;
        font-weight: 100;
        text-align: center;
        float: left;
        background: #2e4158;
        border-radius: 0 3px 0 0;
        padding-left: 5px
    }

    .cardItems .cardInfo .cardType em {
        display: inline-block;
        width: 9px;
        height: 23px;
        border-left: 9px solid transparent;
        border-bottom: 20px solid #fff;
        float: right
    }

    .cardItems .cardInfo .cardAction {
        width: 110px;
        height: 26px;
        line-height: 26px;
        padding-right: 14px;
        text-align: right;
        float: right
    }

    .cardItems .cardInfo .cardAction a {
        margin-left: 5px
    }

    .cardItems .cardBot {
        margin-top: 22px;
        height: 32px;
        line-height: 34px;
        padding-left: 10px;
        color: #666;
        background: #f8f8f8;
        border-top: 1px solid #e7e7e7
    }

    .cardItems .cardBot em {
        float: right;
        padding-right: 15px
    }

    .noticeList {
        margin: 0 auto;
        height: auto;
        overflow: hidden;
        padding: 15px 30px;
        border: 1px solid #e3e3e3;
        min-height: 705px;
        background: #fff
    }

    .noticeList li {
        height: 35px;
        line-height: 35px;
        border-bottom: 1px dashed #ddd
    }


    </style>



        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">


<!--{include file="<!--{$tplpath}-->user_top.tpl"}-->





<div class="home_rec">


    <div class="bindBankCard">
        <div class="fix">

            <!--{section name=p loop=$u_banks}-->

            <div class="cardItems">
                <div class="bankName">
                    <!--{if $u_banks[p].bankico}-->
                    <img src="<!--{$u_banks[p].bankico|getFileUri}-->" style="height: 20px">
                    <!--{/if}-->


                    <!--{$u_banks[p].bankname}-->
                </div>
                <div class="bankAccount">
                    尾号：<!--{$u_banks[p].number}-->
                </div>
                <div class="cardInfo fix">
                    <div class="cardType">
                        <!--{$u_banks[p].realname}-->
                    </div>
                    <div class="cardAction">
                        <!--{if $u_banks[p]['status']==0}-->
                        <span class="_islock">未锁定</span>
                        <a onclick="DialogResetWindow('编辑银行卡','<!--{$this_url}-->&list=add&active=edit&id=<!--{$u_banks[p].id}-->&from=parent','560','400');" class="">修改</a>
                        <!--{else}-->
                        <span class="_islock">已锁定</span>
                        <!--{/if}-->
                    </div>
                </div>
                <div class="cardBot">
                    <span>绑卡日期：<!--{substr($u_banks[p].creatdate,0,10)}--></span>

                </div>
            </div>

            <!--{/section}-->

            <a tag="div"  <!--{if $card_num-$MaxBank<0}-->   onClick="DialogResetWindow('绑定银行卡','<!--{$this_url}-->&list=add&active=add&from=parent','560','400');"<!--{/if}--> class="cardEmpty cardItems ClickShade">立即添加银行卡</a>
        </div>
        <div class="userTip mgt15">
            <p><i class="icon-warning"></i>您已绑定<!--{$card_num}-->张银行卡，一共可以绑定<!--{$MaxBank}-->张银行卡。为了您的资金安全，成功提现的银行卡会自动锁定，无法删除和修改。</p>
        </div>
    </div>


			</div>
		
		</div>
	</div>
	

                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
            </div>
  
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 

   <script type="text/javascript" language="javascript"> 
	<!--{if $disabled !='disabled'}-->
	addressInit('province', 'city', 'area');
<!--{else}-->
addressInit('province', 'city', 'area','<!--{$bank['province']}-->','<!--{$bank['city']}-->','<!--{$bank['area']}-->');
<!--{/if}--> 
	$(document).ready(function(){

		//文本框提示语

		$(".yhk .input_txt").each(function(){
		 var thisVal = $(this).val();
		 //判断文本框的值是否为空，有值的情况就隐藏提示语，没有值就显示
		 if(thisVal!=""){
		   $(this).siblings(".tips").hide();
		  }else{
		   $(this).siblings(".tips").show();
		  }
		 //聚焦型输入框验证 
		 $(this).focus(function(){
		   $(this).siblings(".tips").hide();
		  }).blur(function(){
			var val=$(this).val();
			if(val!=""){
			 $(this).siblings(".tips").hide();
			}else{
			 $(this).siblings(".tips").show();
			} 
		  });
		});   

	});

   function  check_sub(){
	 var   banknum=document.getElementById('banknum').value;
	 
      if(document.getElementById('bankname').value==''){
        alert('请选择银行！');
     return false;

          }

      if(document.getElementById('bankAdress').value==''){
          alert('请输入开户银行');
       return false;

            }

      if(document.getElementById('realname').value==''){
          alert('请输入真实姓名！');
       return false;

            }

      var ltn=document.getElementById('realname').value;
	   var reg = /^([u4E00-u9FA5])*$/;
	   if(ltn.length<2 || ltn.length>4 || reg.test(ltn)==true){
	       alert("真实姓名必须是2到4位的中文");
	       return false;
	   }
	 if(document.getElementById('bankname').value!=='支付宝'  && document.getElementById('bankname').value!=='财付通') {

		 if(luhmCheck(banknum) == false )
		 return false;

		 }

     if(document.getElementById('password').value==''){
         alert('请输入提现密码！');
      return false;

           }
     if(document.getElementById('password').value.length<6){
         alert('提现密码最少为6位');
      return false;

           }
	 if(confirm('信息填写无误? 确认提交')==true){
       return true;
		 }
	 else return false;
	   }


	</script>	




