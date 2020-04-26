
<link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/todo/images/common/base.min.css" />
<style>
   .ui-form{font-size:14px;color:#666}

   .ui-form li{margin-top:10px;margin-bottom:10px}
    .ui-form .textarea{width:320px;height:84px;overflow-y:auto;color:#555}
   ui-label {
       width: 140px;
       height: 34px;
       padding-right: 10px;
       margin-right: -4px;
       text-align: right;
       line-height: 34px;
       color: #888;
   }
   .btn {
       position: relative;
       height: 32px;
       border: 1px solid #CACACA;
       padding: 0 15px;
       line-height: 32px;
       text-align: center;
       color: #555;
       cursor: pointer;
       border-radius: 3px;
       background-image: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,.06));
       background-image: -moz-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,.06));
       background-image: -o-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,.06));
       background-image: linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,.06));
       background-color: #FFF;
       box-shadow: 0 1px 2px rgba(0,0,0,.2);
       height: 34px\9;
       line-height: 34px\9;
       border: 0\9;
       -webkit-transition: all .2s ease-in;
       -moz-transition: all .2s ease-in;
       -ms-transition: all .2s ease-in;
       -o-transition: all .2s ease-in;
       transition: all .2s ease-in;
   }
   .confirm {
       color: #FFF;
       border-color: #46495d;
       background-color: #46495d;
   }
</style>
<!--{if $smarty.get.type=='add'}-->

<form action="index_fangan.html?type=sub_add" method="post">
    <input type="hidden" name="info" value="<!--{$info}-->">
    <input type="hidden" name="gamekey" value="<!--{$game['ckey']}-->">
    <input type="hidden" name="money" value="<!--{$info_arr[6]}-->">
    <input type="hidden" name="content" value="<!--{$info_arr[1]}--><!--{$info_arr[2]}--> <!--{$info_arr[12]}-->">
    <ul class="ui-form">

        <li><label for="question1" class="ui-label">方案彩种：</label><!--{$game['fullname']}--></li>
        <li><label for="question1" class="ui-label">方案名称：</label>
            <input type="text" name ='title' class="input" value="<!--{$game['fullname']}-->-<!--{$info_arr[1]}-->_<!--{$info_arr[2]}-->-<!--{$info_arr[12]}-->-<!--{$info_arr[6]}-->元" placeholder="在此输入方案名称"></li>

        <li><label for="answer1" class="ui-label">方案详情：</label>
            <div class="textarea" style="font-size:12px;" name="content"><div style="height:25px;line-height:25px;"><!--{$info_arr[1]}--><!--{$info_arr[2]}--> <!--{$info_arr[12]}--></div></div></li>
        <li><label for="question2" class="ui-label">方案金额：</label><span class="ui-text-info"><span class="color-red"><!--{$info_arr[6]}--></span>元</span></li>
        <li><label for="question2" class="ui-label">付款帐号：</label><span class="ui-text-info"><span class="color-red"><!--{$cur_username}--></span></span></li>
    </ul>
    <div style="text-align: center">
        <input type="submit"  value="加入" class="btn confirm">
        <a style="display: inline-block;" href="javascript:parent.Dialog.close();;" class="btn cancel">取 消<b class="btn-inner"></b></a>

    </div>
</form>
    <!--{/if}-->



<!--{if $smarty.get.type=='buy'}-->

<form action="index_fangan.html?type=sub_buy" method="post">
    <input type="hidden" name="info" value="<!--{$info}-->">
    <input type="hidden" name="gamekey" value="<!--{$game['ckey']}-->">
    <input type="hidden" name="money" value="<!--{$info_arr[6]}-->">
    <input type="hidden" name="content" value="<!--{$info_arr[1]}--><!--{$info_arr[2]}--> <!--{$info_arr[12]}-->">
    <ul class="ui-form">

        <li><label for="question1" class="ui-label">方案彩种：</label><!--{$game['fullname']}--></li>
        <li><label for="question1" class="ui-label">投注期号：</label><!--{$period}-->期</li>
        <li><label for="question1" class="ui-label">方案名称：</label>
            <input type="text" name ='title' class="input" value="<!--{$game['fullname']}-->-<!--{$info_arr[1]}-->_<!--{$info_arr[2]}-->-<!--{$info_arr[12]}-->-<!--{$info_arr[6]}-->元" placeholder="在此输入方案名称"></li>

        <li><label for="answer1" class="ui-label">方案详情：</label>
            <div class="textarea" style="font-size:12px;" name="content"><div style="height:25px;line-height:25px;"><!--{$info_arr[1]}--><!--{$info_arr[2]}--> <!--{$info_arr[12]}--></div></div></li>
        <li><label for="question2" class="ui-label">方案金额：</label><span class="ui-text-info"><span class="color-red"><!--{$info_arr[6]}--></span>元</span></li>

    </ul>
    <div style="text-align: center">
        <input type="submit"  value="投注" class="btn confirm">
        <a style="display: inline-block;" href="javascript:parent.Dialog.close();;" class="btn cancel">取 消<b class="btn-inner"></b></a>

    </div>
</form>
<!--{/if}-->




