
<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/Help.css" type="text/css" rel="stylesheet" />


<div id='hd'   >






    <div class="helpList">
        <h2>帮助指南</h2>
        <ul class="helpTitle">


            <!--{foreach from=$list key=key item=item}-->
            <li  <!--{if $item['id']==$news['id']}-->class="curr"<!--{/if}--> ><a href="index_help.html?itemid=<!--{$item['id']}-->"><!--{$item['title']}--></a><i></i></li>

            <!--{/foreach}-->

        </ul>

        <div class="helpContent">
            <h4> <!--{$news['title']}--></h4>
            <div class="helpArticle">

                <!--{$news['content']}-->
   </div>
        </div>
    </div>














            </div>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 
