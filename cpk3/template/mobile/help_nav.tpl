<style>
    .help_nav{height:50px;}
    .help_nav  ul li {
float: left;height:40px;line-height: 40px; color: #ccc;text-align: center;
        border-bottom: 5px solid #fff;

    }
    .help_nav  ul li a{color: #666;}
    .help_nav  ul li.active {
        background: 0 0;
        border: none;
        color: #ff4444;
        border-bottom: 5px solid #ff4444;
    }

    .help_nav  ul li.active a{        color: #ff4444;}
    .help_list .title{

        color: #fff;
        text-align: left;
        margin: 10px;
         margin-bottom: 5px;
        border-radius: 5px;
        line-height:30px;
        padding-left: 10px;
        height: 30px;background: #ff4444;
        position: relative;overflow: hidden;display: block;clear: both;
    }

    .help_list .content {
        margin: 0 10px;
        padding: 5px 10px;
        line-height: 25px;
        background:#fff;
        width: 90% !important;
        word-wrap: break-word;
        word-break: normal;
        display: none;

    }
    .help_list .content p,    .help_list .content div{
        background: #fff !important;
        color:#666 !important;

    }

    .arrow {
        border: 6px solid transparent;
        width: 0;
        height: 0;
        position: absolute;
        content: ' ';
        margin-left: 8px;
        right:10px;
    }
    .arrow.up{
         top:6px;
        border-bottom: 6px solid #fff;
    }

    .arrow.bott{
        top: 12px;
        border-top: 6px solid #fff;
    }
    .sec_nav{text-align:center;}
    .sec_nav ul li{
        display: inline-block;

        padding: 5px 20px;
        background: #ddd;
        margin: 5px 2px;color:#666;
        border-radius: 5px;
    }
    .sec_nav ul li.cur{    background: #ff4444;}
    .sec_nav ul li a{color:#666;}
    .sec_nav ul li.cur a{    color: #fff;}

    .play-table thead tr th {
        height: 25px;
        color: #fff;
        background-color: #ff4444;
    }
    .play-table td {
        border: 1px solid #e1e1e1;
    }
    .play-table td, .play-table th {
        padding: 2px 3px;
    }
</style>

      <div class="help_nav">
<ul>
    <!--{$width=100/(count($cate_list[0])+1)}-->
    <!--{foreach from=$cate_list[0] key=key item=item}-->
    <li   class="<!--{if $smarty.get.cate eq $item['id']}-->active<!--{/if}-->" style="width: <!--{$width}-->%">
    <a href="index_help.html?cate=<!--{$item['id']}--><!--{if $item['id']!=13}-->&type=help<!--{/if}-->" ><!--{$item['title']}--></a>
    </li>

    <!--{/foreach}-->

    <li  class="<!--{if $smarty.get.mod eq 'wanfa'}-->active<!--{/if}-->" style="width: <!--{$width}-->%">
    <a href="index_wanfa.html?type=ssc" >玩法介绍</a>
    </li>



</ul>


      </div>




