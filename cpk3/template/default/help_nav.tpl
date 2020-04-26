<div class="left-aside">
    <div class="header">
        <i class="control-icon"></i>
        <span>帮助中心</span>
    </div>
    <div class="content">
        <!--{foreach from=$cate_list[0] key=key item=item}-->
        <div class="row  <!--{if $smarty.get.cate eq $item['id']}-->active<!--{/if}-->">
            <a href="index_help.html?cate=<!--{$item['id']}--><!--{if $item['id']!=13}-->&type=help<!--{/if}-->" >
                <i class="arrow-right"></i><span><!--{$item['title']}--></span>
            </a>
        </div>

        <!--{/foreach}-->

        <div class="row  <!--{if $smarty.get.mod eq 'wanfa'}-->active<!--{/if}-->">
            <a href="index_wanfa.html?type=ssc" >
                <i class="arrow-right"></i><span>玩法介绍</span>
            </a>
        </div>


    </div>
</div>
<div class="right-aside">



    <div  class='eject'>

        <div class="tab">
            <!--{$navtitle}-->

        </div>

    </div>


