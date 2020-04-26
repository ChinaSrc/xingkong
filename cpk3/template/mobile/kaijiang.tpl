<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<style>
    #drawing-lite {
        position:relative;
        color:#666;
        background-color: #fff;
    }
    #drawing-lite table {
        width:100%;
        table-layout:fixed;
        border-collapse:collapse;
        text-align:center;
    }
    #drawing-lite table tbody tr {
        border-bottom:1px #eee dotted
    }
    #drawing-lite table td,#drawing-lite table th{border: 0px;padding:2px 0px;height:30px;line-height: 30px;}
    #drawing-lite table tr td.numbercode{color: #ff0000;overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap}
    #drawing-lite table tr td:nth-child(3){color: #ff9726}
    #drawing-lite table tr:hover{background-color: #fafafa;}
    #drawing-lite table tr td .color1,#drawing-lite table tr td .color2{display: inline-block;margin: 0 2px;padding:2px 3px;border-radius: 5px;color:#fff;height:16px;line-height: 16px;}
    #drawing-lite table tr td .color1{background-color: #5691d7}
    #drawing-lite table tr td .color2{background-color: #ff9726}
    #drawing-lite table a,#drawing-lite table i,#drawing-lite table em,#drawing-lite table span {
        display:inline-block;
        padding:0 2px;
        line-height:28px;
        font-style:normal
    }
    #drawing-lite table .dl-period {

    }
    #drawing-lite table .dl-number {
        min-width: 150px !important;
    }
    #drawing-lite table .dl-type {
        width:32px
    }
    #drawing-lite table .dl-pattern {
        width:48px
    }
    #drawing-lite table td:last-child{text-align: center;}
    #drawing-lite table td em {
        height:20px;line-height: 20px;
        min-width: 16px;font-size:14px;
        padding-left: 2px;padding-right: 2px;text-align: center;
        margin:0 2px;
        color: #ffffff;
        background-image: -webkit-linear-gradient(top,#ff4444,#ff0000);
        background-image: -moz-linear-gradient(top,#ff4444,#ff0000);
        background-image: -o-linear-gradient(top,#ff4444,#ff0000);
        background-image: linear-gradient(180deg,#ff4444,#ff0000);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff4444",endColorstr="#ff0000",GradientType=0);
        border-radius: 50%;
        border: 0px solid #d67f0a;
    }


</style>
<div id="drawing-lite">
    <table class="table text-center">
        <thead>
        <tr>
            <th class="dl-period"><span>期号</span></th>
            <th class="dl-number"><span>号码</span></th>
            <th style="width: 40px">和值</th>
            <th style="width: 80px">形态</th>
        </tr>
        </thead>
        <tbody id="historylot">



        <!--{foreach from=$lottery_list key=key item=item}-->

        <tr>
            <td><!--{$item['period']}--></td>
            <td class="numbercode">     <!--{$item['Number']}--></td>
            <td><!--{$item['sum']}--></td>
            <td>
                <!--{if $item['sum']>10}-->
                <span class="color1">大</span>
                <!--{else}-->
                <span class="color2">小</span>
                <!--{/if}-->

                <!--{if $item['sum']%2==1}-->
                <span class="color1">单</span>
                <!--{else}-->
                <span class="color2">双</span>
                <!--{/if}-->
            </td>


        </tr>




        <!--{/foreach}-->


       </tbody>
    </table>


</div>



<div class="page">

    <!--{$page}-->
</div>



<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
