


<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
	<style type="text/css">
	label{display:block;height:40px;position:relative;}
	.tips {position:absolute; float:left;line-height:38px;left:160px;color:#BCBCBC;cursor:text;}
	.input_txt{border:solid 1px #ccc;box-shadow:0 1px 10px rgba(0,0,0,0.1) inset;height:38px;text-indent:10px; font-size:15px;}
	.input_txt:focus{box-shadow:0 0 4px rgba(255,153,164,0.8);border:solid 1px #6B97B2;}
	</style>





		<!--{if $editpass=="yes"}-->
   <script>winPop({title:'温馨提示',type:'2',width:'400',iclose:'true',drag:'true',height:'90',url:'<div style="padding:20px;color:#222222;">您的登陆密码与资金密码相同，请先进行更改！</div>',next:3,goTo:'<!--{$root_url}-->?mod=safe&code=pass'});</script>
<!--{else}-->
   <!--{if $is_pass=="yes"}-->


	<!--{if $card_num-1>=0}-->
	     <!--{section name=p loop=$u_banks}-->

<div class="wap_list" onclick="location.href='home_safe_recharge.html?method=<!--{$key}-->';" style="    display: table;table-layout: fixed;">
	<div style="display: table-cell;;width:80px;height:60px;line-height: 60px;text-align: center;padding-top: 0px;">
		<!--{if $u_banks[p].bankico}-->
		<img src="<!--{$u_banks[p].bankico|getFileUri}-->"  style="height: 50px;vertical-align:middle ">
		<!--{/if}-->


	</div>
	<div style="display: table-cell;line-height: 25px;font-size: 18px;height: 50px;vertical-align: top;padding-top: 10px;">
		<!--{$u_banks[p].bankname}--><br>
		<span style="color: #999;font-size: 14px">
尾号：<!--{$u_banks[p].number}-->
        </span>

	</div>
	<div style="display: table-cell;padding-right: 10px;text-align: right;width:70px;line-height:60px">

		<!--{if $u_banks[p]['status']==0}-->

		<a href="home_safe_bankinfo_add.html?active=edit&id=<!--{$u_banks[p]['id']}-->" class="button">修改</a>
		<!--{else}-->
		已锁定
		<!--{/if}-->
	</div>


</div>


             <!--{/section}-->
	<!--{else}-->
	   <div class="wap_list">
	   您还未绑定银行卡
	   </div>
	<!--{/if}-->

       <div class="wap_list">
	  <input type='button' <!--{if $card_num-$MaxBank>=0}--> disabled<!--{/if}--> class='button' value='添加绑定'
	  onClick="location.href='home_safe_bankinfo_add.html';">

	  &nbsp;&nbsp;
	  <font color="Red">提示：</font>一个账户最多绑定&nbsp;<font style="font-size:16px;color:#FF3300"><!--{$MaxBank}--></font>&nbsp;张银行卡
	</div>
   <!--{else}-->
      <table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
      <form action="<!--{$do_this_url}-->&falg=yes" method="post" name="form1" id="form1">
        <tr class='table_b_tr_b'>
          <td align="right" style="font-weight:bold;">资金密码：</td>
          <td align="left"><input type="password" name="secpwd" id="secpwd"  value="" style="width:200px;"></td>
        </tr>
        <tr class='table_b_tr_b'>
          <td align="right" style="font-weight:bold;"></td>
          <td align="left"><input type='submit' name='submit' id='btsubmit' value='下一步' class='button_10_25_b' onclick="return winPop({title:'绑定卡号',form:'form1',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true',url:'确定？'})"></td>
        </tr>

        </form>
      </table>
   <!--{/if}-->
<!--{/if}-->
			</div>

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




