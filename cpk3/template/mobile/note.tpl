
<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>


<!--{include file="<!--{$tplpath}-->navi.tpl"}-->


<!--{if $smarty.get.id>0}-->

        <div class='wap_list'>


<div class='wap_title11'  style='text-align:center;'><!--{$news['title']}--></div>

<div class='wap_content' style='text-align:center;'>发布时间：<!--{date('Y-m-d H:i:s',$news['time'])}--></div>

<div style='word-break: break-all; word-wrap:break-word;'>
<!--{$news['content']}-->
</div>
        </div>


<!--{else}-->

                 <!--{foreach from=$note_list key=key   item=item}-->

                           <div class='wap_list'  onclick='location.href="index_note.html?mobile=1&id=<!--{$item['id']}-->";'>
<table>
<tr><td>

<div class='wap_title11'><!--{$item['title']}--></div>

<div class='wap_content'>发布时间：<!--{date('Y-m-d H:i:s',$item['time'])}--></div>
  </td>

                                  <td style='width:25px;'>

                                  <img src='static/images/mobile/next.png' width='25px' >
                                  </td>

		                        </tr>


		                        </table>



                       </div>

                 <!--{/foreach}-->



<!--{/if}-->






<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
