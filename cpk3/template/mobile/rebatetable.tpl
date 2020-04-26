
<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/rebatecommon.css" rel="stylesheet" />
<style>
    .detail .info span[data-v-ca276c6c]{
        width: 49%;
    }

</style>

<body style="font-size: 21.7589px;">
<div id="common" class="rebateTable">
    <div id="shadow" style="display: none;"></div>
    <header class="top">

        <span>返点赔率表</span>

        <div class="back" style="top:2px;" onclick="location.href='home_user_url.html?action=add';">

            <img src="static/images/return(new).png" border="0" style="height: 25px;">
        </div>
        <span class="right" style="padding-top: 0px; line-height: 2.26em; display: none;"><a title="在线客服" class="kefu">客服</a></span>
    </header>

    <div data-v-ca276c6c="" id="ssc_nav" style="display: none;">
        <div data-v-ca276c6c="" class="blackBg"></div>
        <div data-v-ca276c6c="" class="filter">
            <div data-v-ca276c6c="" class="tp">
                <!--{foreach from=$arr_game_code key=key item=item}-->

                <span data-v-ca276c6c="" style="width: 25%;" onclick="location.href='?type=<!--{$key}-->';" <!--{if $key==$type}-->class="on"<!--{/if}-->><!--{$item}--></span>
                <!--{/foreach}-->

            </div>
        </div>
    </div>
    <div data-v-ca276c6c="" class="main" s="[object Object]" style="padding-top: 0px;">
        <!--{if $type!='k3'}-->
        <div data-v-ca276c6c="" class="tip">该彩种以每注2元或2角为基数，奖金=赔率*2</div>
        <!--{/if}-->

        <div data-v-ca276c6c="" class="dataType" onclick="set_nav();">
            <em data-v-ca276c6c=""><!--{$arr_game_code[$type]}--></em><i class="icon-hourglass-1"></i>
        </div>
        <div data-v-ca276c6c="">




            <!--{foreach from=$code_list key=key item=item}-->
            <!--{foreach from=$item['list'] key=key1 item=item1}-->

            <div data-v-ca276c6c="" class="member" id="title_<!--{$key}-->_<!--{$key1}-->"  onclick="set_detail('<!--{$key}-->_<!--{$key1}-->');">
              <i class="icon-right-open-1" data-v-ca276c6c=""></i>


            <!--{if $type=='k3'}-->
                <p data-v-ca276c6c=""><!--{$item1['ShowTile']}--></p>

            <!--{else}-->
                <p data-v-ca276c6c=""><!--{$item['fullname']}--><!--{$item1['CodeTile']}--><!--{$item1['ShowTile']}--></p>

            <!--{/if}-->
            </div>


            <div data-v-ca276c6c="" class="detail" id="detail_<!--{$key}-->_<!--{$key1}-->" style="display: none;">
                <div data-v-ca276c6c="" class="info-border">
                    <div data-v-ca276c6c="" class="info title">
                        <span data-v-ca276c6c="">返点</span>
                        <span data-v-ca276c6c="" class="s2">赔率</span>
                    </div>
                </div>

                <!--{foreach from=$rebate_arr key=key item=item}-->
                <div data-v-ca276c6c="" class="info-border">
                    <div data-v-ca276c6c="" class="info">
                        <span data-v-ca276c6c=""><!--{$item}--></span>
                        <span data-v-ca276c6c="" class="s2"><!--{if $type=='k3'}--><!--{number_show(set_prize( $item1['minrate'],$item1['maxrate'], $item,$type),3)}--><!--{else}--><!--{number_show(set_prize( $item1['minrate'],$item1['maxrate'], $item,$type)/2,3)}--><!--{/if}--></span>
                    </div>
                </div>



                <!--{/foreach}-->


            </div>


            <!--{/foreach}-->
            <!--{/foreach}-->

    </div>
</div>

    <script>
        function set_nav() {

            if(document.getElementById('ssc_nav').style.display=='none'){

                document.getElementById('ssc_nav').style.display='block';
            }else{

                document.getElementById('ssc_nav').style.display='none';
            }


        }

        function set_detail(key) {
         var title  = document.querySelectorAll('.member');

            var detail  = document.querySelectorAll('.detail');
            for(var i=0;i<title.length;i++){

                if(title[i].id=='title_'+key){
                    if(  detail[i].style.display=='block'){
            detail[i].style.display='none';
                        title[i].querySelector('i').className='icon-right-open-1';
                   } else{

            detail[i].style.display='block';
                        title[i].querySelector('i').className='icon-down-open-1';
        }
                }else{

                    detail[i].style.display='none';
                    title[i].querySelector('i').className='icon-right-open-1';
                }

            }

        }

    </script>
</body>
</html>