


<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/ZeroClipboard.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->



<!--{if strpos($bank['bankname'],'银行')!==false}-->

<div class="wap_list">

    <div class="selt_bank paynew">

        <!--手动充值第二步开始-->


        <!--{if $bank['ico']}-->

        <div class="czhihk1"  style='height:230px;text-align: center;font-weight: 600;font-size: 16px;line-height: 30px;'>
            扫描二维码直接付款<br>
            <img src="<!--{$bank['ico']}-->" alt="扫描二维码直接付款" width='200px'/>
        </div>

        <!--{/if}-->



        <div class="czk"  style='height:260px;'>
            <div style='float:left;'>
                <p>充值账号：<span class="org"><!--{$userinfo['username']}--></span> </p>

                <p><b>充值金额：</b> <span class="org"><b><!--{$funds['money']}--></b></span> 元</p>

                <p>汇款银行：
                    <a href="<!--{$bank['url']}-->" target="_blank"  >

                        <!--{$bank['bankname']}-->
                        <!--{if $bank['bank_branch']}-->
                        （<!--{$bank['bank_branch']}-->）
                        <!--{/if}-->
                    </a>
                </p>
                <p>汇款账号：<b><!--{$funds['banknum']}--></b>
                </p>
                <p>汇款户名：<!--{$funds['realname']}-->
                </p>
                <p>汇款编号：<span id="randnum"><!--{$funds['remark']}--></span>
                    (请在汇款附言填写该汇款编号)</p>



            </div>

        </div>



    </div>
</div>


<!--{else}-->
<div class="wap_list" style="text-align: center;height: auto !important;;">
    <div style="font-size:40px;font-weight: 600;height:50px;line-height: 50px;;">

        ￥<!--{$funds['money']}-->
    </div>
    <!--{if $bank['ico']}-->

    <img src="<!--{$bank['ico']}-->" alt="扫描二维码直接付款" style='width:60%;'/>
    <!--{/if}-->
    <div style="font-size: 16px;padding-top: 5px;min-height: 150px;">

        <!--{$config['charge_note2']}-->
    </div>
    <div style="height:30px;line-height: 30px;margin-top:10px;">
        <input type="button" class="button" value="我已支付" style="width: 200px;" onclick="location.href='home.html';">
    </div>
</div>



<!--{/if}-->




						</div>

                    </div>
                    <!--详细内容iframe-end-->

                </div>
            </div>

        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->



    <script type="text/javascript">
        function copyToClipboard(id,txt) {

            var clip = new ZeroClipboard.Client();
            ZeroClipboard.setMoviePath("<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/ZeroClipboard.swf");
            clip.setHandCursor(true);
            clip.setText(txt);
            clip.addEventListener('complete', function () {
                alert("复制成功");
            });
            clip.glue(""+id+"");
        }
    </script>



















