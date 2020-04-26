<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="email=no" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="screen-orientation" content="portrait" />
    <meta name="x5-orientation" content="portrait" />
    <meta name="full-screen" content="yes" />
    <meta name="x5-fullscreen" content="true" />
    <meta name="browsermode" content="application" />
    <meta name="x5-page-mode" content="app" />
    <meta name="msapplication-tap-highlight" content="no" />
    <title>返点赔率</title>

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/rebatecommon.css" rel="stylesheet" />
<style>
    .rebateTable ul[data-v-c64576ce]:first-child{
        width: 130px;
    }

</style>
</head>
<body>
<div id="common" class="rebateTable">
    <!---->
    <div data-v-c64576ce="" class="rebateDes" s="[object Object]">
        <div data-v-c64576ce="" id="rebateNav" class="rebateNav fix">

            <!--{foreach from=$arr_game_code key=key item=item}-->

            <a data-v-c64576ce="" href="?type=<!--{$key}-->" <!--{if $key==$type}-->class="curr"<!--{/if}-->><!--{$item}--></a>

            <!--{/foreach}-->


        </div>
        <!--{if $type!='k3'}-->

        <div data-v-c64576ce="" id="testShow" class="testShow">
            温馨提示：该彩种以每注2元或2角为基数，要换算成奖金，只需将赔率乘2
        </div>
        <!--{/if}-->

        <!---->
        <div data-v-c64576ce="" class="rebateContent fix">
            <ul data-v-c64576ce="" id="rebateTitle" class="rebateTitle">
                <li data-v-c64576ce=""><i data-v-c64576ce="">玩法</i><span data-v-c64576ce=""></span><em data-v-c64576ce="">返点</em></li>

              <!--{foreach from=$code_list key=key item=item}-->
                <!--{foreach from=$item['list'] key=key1 item=item1}-->
                <!--{if $type=='k3'}-->

                <li data-v-c64576ce=""><!--{$item1['ShowTile']}--></li>
                <!--{else}-->

                <li data-v-c64576ce=""><!--{$item['fullname']}--><!--{$item1['CodeTile']}--><!--{$item1['ShowTile']}--></li>

                <!--{/if}-->
                <!--{/foreach}-->
                <!--{/foreach}-->

            </ul>
            <div data-v-c64576ce="" class="rebateTableCon" style="" id="tabletitle">
                <i data-v-c64576ce=""></i>
                <em data-v-c64576ce=""></em>
                <div data-v-c64576ce="" class="rebateTable fix">
                    <!--{foreach from=$rebate_arr key=key item=item}-->
                    <ul data-v-c64576ce="" id="<!--{$item}-->" class="<!--{if $key==0 || !strpos($item,'.')}-->isClass<!--{else}-->noneed<!--{/if}-->" onclick="set_rebate(this);">
                        <li data-v-c64576ce=""><!--{$item}--><!--{if !strpos($item,'.')}-->.0<!--{/if}--></li>


                        <!--{foreach from=$code_list key=key2 item=item2}-->
                        <!--{foreach from=$item2['list'] key=key1 item=item1}-->


                        <li data-v-c64576ce="">赔率<!--{if $type=='k3'}--><!--{number_show(set_prize( $item1['minrate'],$item1['maxrate'], $item,$type),3)}--><!--{else}--><!--{number_show(set_prize( $item1['minrate'],$item1['maxrate'], $item,$type)/2,3)}--><!--{/if}--></li>

                        <!--{/foreach}-->
                        <!--{/foreach}-->

                    </ul>

                    <!--{/foreach}-->


                </div>
            </div>
        </div>

    </div>

</div>

<script>

    function  set_rebate(div) {

      var ul=  document.querySelector('.rebateTable').querySelectorAll('ul');
      for(var i=1;i<ul.length;i++){

      if(document.querySelector('#tabletitle').className!='rebateTableCon minx')    {

          if(ul[i].className=='isClass'){
              if(ul[i].id==div.id){
                  ul[i].style.display=''

              }
              else{
                  ul[i].style.display='none'
              }

          }
          else{

              ul[i].className=''
              if((parseFloat(div.id)!=parseInt(div.id) && parseFloat(ul[i].id)<parseFloat(div.id)  && ul[i].id>parseInt(div.id) ) || (parseFloat(div.id)==parseInt(div.id) && parseFloat(ul[i].id)<parseFloat(div.id)  && parseFloat(ul[i].id)>parseInt(div.id)-1 )){
                  ul[i].style.display=''

              }
              else
                  ul[i].style.display='none'
          }

      }

      else{

            if(ul[i].className=='isClass'){

                    ul[i].style.display=''


            }
            else{

                    ul[i].style.display='none'
            }

        }

        }

     //   alert(div.id)
        if(document.querySelector('#tabletitle').className!='rebateTableCon minx')    {


            document.querySelector('#tabletitle').className='rebateTableCon minx'


        }

        else{

            document.querySelector('#tabletitle').className='rebateTableCon'
        }
    }
</script>
</body>
</html>