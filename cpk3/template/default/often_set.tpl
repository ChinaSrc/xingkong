<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
<meta charset="UTF-8" />
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/often.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/common.js"></script>
<script>

    var ofen_num=<!--{count($often_list)}-->;

</script>

<dl class="betting-details">

        <!--{foreach from=$arr_game_code key=key item=item}-->

        <!--{if count($game_nav[$key])>0}-->
    <dl class="gametype">
        <dt>
            <!--{$item}-->
        </dt>


                <!--{foreach from=$game_nav[$key] key=key1 item=item1}-->

        <!--{if $item1['ckey']!='MMSSC'}-->
        <dd>
            <!--{$item1['fullname']}-->
            <label class="el-switch is-checked" <!--{if $often[$item1['ckey']]!=1}-->style="display: none;"<!--{/if}-->  id='open_<!--{$item1['ckey']}-->'  >
                <div class="el-switch__mask" style="display: none;"></div>
                <input type="checkbox" name="" true-value="true" class="el-switch__input" />
                <span class="el-switch__core" style="width: 30px; border-color: rgb(19, 206, 102); background-color: rgb(19, 206, 102);"><span class="el-switch__button" style="transform: translate(10px, 2px);"></span></span>
                <div class="el-switch__label el-switch__label--left" style="width: 30px;" onclick="set_often('<!--{$item1['ckey']}-->',0);">

                </div>
                <div class="el-switch__label el-switch__label--right" style="width: 30px; display: none;">

                </div>


            </label>


            <label class="el-switch" <!--{if $often[$item1['ckey']]==1}-->style="display: none;"<!--{/if}-->   id='close_<!--{$item1['ckey']}-->' >
                <div class="el-switch__mask" ></div>
                <input type="checkbox" name="" true-value="true" class="el-switch__input" />
                <span class="el-switch__core" style="width: 30px; border-color: rgb(255, 73, 73); background-color: rgb(255, 73, 73);"><span class="el-switch__button" style="transform: translate(2px, 2px);"></span></span>
                <div class="el-switch__label el-switch__label--left" style="width: 30px; display: none;">
                    <!---->
                    <!---->
                </div>
                <div class="el-switch__label el-switch__label--right" style="width: 30px;"  onclick="set_often('<!--{$item1['ckey']}-->',1);">
                    <!---->
                    <!---->
                </div></label>
        </dd>

        <!--{/if}-->
                <!--{/foreach}-->

        </dl>


        <!--{/if}-->


        <!--{/foreach}-->



</div>


    <script>
ofen_num=parseInt(ofen_num);
        function set_often(key,num){

            if(num==1){
                if(ofen_num>=6) {

                    alert('最多可以设置6种彩票');
                    return false;
                }
               ofen_num++;
                document.querySelector('#open_'+key).style.display='block';
                document.querySelector('#close_'+key).style.display='none';


            }else{
                ofen_num--;
                document.querySelector('#open_'+key).style.display='none';
                document.querySelector('#close_'+key).style.display='block';

            }
            ajaxobj=new AJAXRequest;
            ajaxobj.method="POST";
            ajaxobj.content="";
            ajaxobj.url="index_often_set.html?action=set&num="+num+"&key="+key;//alert(ajaxobj.url)
            ajaxobj.callback=function(xmlobj){
                var response = Trim(xmlobj.responseText);

                 parent.start_often();

            }
            ajaxobj.send();
        }


    </script>