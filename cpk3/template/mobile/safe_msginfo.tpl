<!--{include file="<!--{$tplpath}-->head.tpl"}-->
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=2123" type="text/css" rel="stylesheet">
	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/note.css?v==123" type="text/css" rel="stylesheet" />

<style>

    .nano-content::-webkit-scrollbar {
        display: none;
    }
</style>
<div >
    <form name="form" action="home_safe_msginfo.html?id=<!--{$smarty.get.id}-->" method="post">

<div class="nano-content pad-all" tabindex="0" id="chat-div" style="margin-top:20px;height:425px;overflow-y:scroll;">
                <ul class="list-unstyled media-block" id="charlist">

                <!--{foreach from=$list key=key item=item}-->
                            <li class="mar-btm">
                                <div class="media-<!--{$item['css']}-->">
                                    <img src="<!--{$file_uri}-->/static/images/av<!--{if $item['css']=='left'}-->4<!--{else}-->1<!--{/if}-->.png" class="img-circle img-sm" alt="Profile Picture">
                                </div>
                                <div class="media-body pad-hor speech-<!--{$item['css']}-->">
                                    <div class="speech">
                                        <a href="#" class="media-heading"><!--{$item.fromname}--></a>
                                        <p><!--{$item.content}--></p>
                                        <p class="speech-time">
                                            <i class="fa fa-clock-o fa-fw"></i> <!--{$item.creatdate}-->
                                        </p>
                                    </div>
                                </div>
                            </li>


                  <!--{/foreach}-->

                </ul>
            </div>
    <div class="panel-footer">
                <div class="row">

                <table>
                <tr>
                <td>
                          <input id="msgid" value="<!--{$smarty.get.id}-->" type="hidden">
                        <input id="txtContent" name='content' type="text" placeholder="请输入消息内容" class="form-control chat-input" maxlength="500">

                </td>

                <td   style='width:90px;text-align:right;'>
                   <button class="btn btn-info btn-labeled fa fa-comments-o fa-lg" id="btnSender" type="submit" onclick="return sendContent();">发送消息</button>
                </td>
                </tr>

                </table>

                </div>
            </div>
    </form>


</div>


<script type="text/javascript">

function sendContent(){




	   if(document.getElementById('txtContent').value=="") {
			window.wxc.xcConfirm("请输入消息内容",window.wxc.xcConfirm.typeEnum.warning);
			document.getElementById('txtContent').focus();
			return false;
	   }

	   if(document.getElementById('txtContent').value.length<2) {
			window.wxc.xcConfirm("消息内容部能小于2个字符",window.wxc.xcConfirm.typeEnum.warning);
			document.getElementById('txtContent').focus();
			return false;
	   }



                  }



</script>



