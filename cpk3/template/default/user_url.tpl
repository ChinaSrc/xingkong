

<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">

                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->

                <div class="newTab">
                    <a href="home_user_url.html?action=add" class="<!--{if $smarty.get.action eq 'add'}--> router-link-exact-active curr<!--{/if}-->">下级开户</a>
                    <a href="home_user_url.html" class="<!--{if $smarty.get.action neq 'add'}--> router-link-exact-active curr<!--{/if}-->">邀请码管理</a>
                </div>
                <div class="home_rec">
                   <!--{if $smarty.get.action eq 'add'}-->


                    <div  class="openAgent">
                        <form action="?action=addurl" method="post" >

                     <input type="hidden" name="type" id="type" value="0">

                        <ul class="searchType">
                            <li><span>开户类型：</span>
                                <a class="userSearch active" onclick="set_type(0);">代理</a>
                                <!-- <a class="userSearch" onclick="set_type(1);">玩家</a> -->
                                <br /> 返点设置：请先为下级设置返点。
                                <a class="rebateDesLink" onclick="open_url('index_rebatetable.html');">点击查看返点赔率表</a>
                            </li>
                            </ul>
                        <div class="rebateList">
                            <!--{foreach from=$arr_game_code key=key item=item}-->
                            <!--{if $key!='other'}-->
                            <ul>
                                <li><!--{$item}--></li>
                                <li>
                                    <input type="number" name="rebate[<!--{$key}-->]" tag="<!--{$item}-->返点" placeholder="" min="<!--{if $rebates[$key]-$con_system['rebate_cha']>0}--><!--{$rebates[$key]-$con_system['rebate_cha']}--><!--{else}-->0<!--{/if}-->" step="0.01" max="<!--{$rebates[$key]}-->" class="userInput mgl20" required />&nbsp;
                                    <span>（自身返点<!--{$rebates[$key]}-->，可为下级设置返点范围<!--{if $rebates[$key]-$con_system['rebate_cha']>0}--><!--{$rebates[$key]-$con_system['rebate_cha']}--><!--{else}-->0<!--{/if}-->-<!--{$rebates[$key]}-->）</span>
                                </li>
                            </ul>
                            <!--{/if}-->
                            <!--{/foreach}-->

                        </div>
                        <div style="clear: both;margin-top: 10px;padding-left: 200px;">
                            <input type="submit" class="button" value="生成邀请码">

                        </div>
                        </form>
                        <div class="userTip" style="margin-top: 30px;">
                            <p>※ 温馨提示： <br /> 1、不同的返点赔率不同，返点越高赔率越高。 <br /> 2、代理可获得的佣金等于代理自身返点与下级返点的差值，如代理自身返点3，下级返点1，代理可获得下级投注金额的2%，即下级下注100元，代理可获得2元。 <br /> 3、下级返点值设得越低，下级的赔率就越低，建议给下级设置的返点不要过低。 </p>
                        </div>
                    </div>
<SCRIPT>

    function set_type(num) {
        document.getElementById('type').value=num;
       var a= document.querySelectorAll('.userSearch');
      for(var i=0;i<a.length;i++){

          if(i==num) a[i].className='userSearch active';
          else a[i].className='userSearch';

      }
    }


</SCRIPT>


                    <!--{else}-->



                    <div  class="openAgent">
                                <ul class="searchType">
                                    <li><span>开户类型：</span>
                                        <a href="home_user_url.html" class="userSearch <!--{if $smarty.get.type neq '1'}-->active<!--{/if}-->" >代理</a>
                                        <a href="home_user_url.html?type=1"  class="userSearch <!--{if $smarty.get.type eq '1'}-->active<!--{/if}-->" >玩家</a>

                                    </li>
                                </ul>


        <table id="my-datatable" class="my_tbl my list_tbl" cellspacing="0" width="100%" role="grid" style="width: 100%;">
            <tr><th>邀请码</th><th>注册链接</th><th>备注</th><th>生成时间</th><th>状态</th><th>操作</th></tr>

            <!--{foreach from=$list key=key item=item}-->
            <tr>
                <td><input type="text" class="code" style="width: 80px" value="<!--{$item['url']}-->">
                    <i  style="color: #4aa9db; cursor: pointer"data-clipboard-text="<!--{$item['url']}-->" id="click-to-copy">复制</i></td>
                <td><input type="text" value="<!--{$url}--><!--{$item['url']}-->">
                    <i style="color: #4aa9db; cursor: pointer"data-clipboard-text="<!--{$url}--><!--{$item['url']}-->" id="click-to-copy">复制</i></td>
                <td>
                    <!--{if $item['mark']}-->
                    <a href="javascript:DialogResetWindow('设置备注','do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url_mark&id=<!--{$item['id']}-->','380','180')" class="xem"><!--{$item['mark']}--></a>

                <!--{else}-->
                    <a style="color: #4aa9db;" href="javascript:DialogResetWindow('设置备注','do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url_mark&id=<!--{$item['id']}-->','380','180')" >未设置</a>


                    <!--{/if}-->

                </td>
                <td><!--{date('Y-m-d',$item['time'])}--></td>
                <td>注册(<!--{$item['num']}-->)</td>
                <td><a href="javascript:DialogResetWindow('详情','do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url&id=<!--{$item['id']}-->','500','350')" class="detail">详情</a>
                    |
                    <a class="del" href="javascript:DeleteRegUrl('<!--{$item['id']}-->');" >删除</a></td>
            </tr>



                        <!--{/foreach}-->
                     
            </table></div></div><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div></div>



        </div>
<!--{/if}-->

                </div>

       </div>
        
        <!--底部包含文件开始-->
        
        <script type="text/javascript">
     function DeleteRegUrl(id){
 var s=confirm('确定要删除吗? ');

 if(s==true){
var url='home_user_url.html?type=del&id='+id;
location.href=url;
	 }
 else{

return false;
	 }


         }

        
function creaturl(){
	
	var usertype=document.getElementsByName('usertype');
    for(var i=0;i<=usertype.length;i++){
        if(usertype[i].checked)  {
       var type=usertype[i].value;
       break;
            }

        }
    winPop({title:'生成推广链接',width:'300',drag:'true',height:'100',url:'index.aspx?mod=url&code=creat&type='+type});
    //winPop('生成推广链接','index.aspx?mod=url&code=creat&type='+type,'300','100');
	}

var  copy=0;
        function copyToClipboard(id,txt) {


            
            var clip = new ZeroClipboard.Client();  
            ZeroClipboard.setMoviePath("<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/ZeroClipboard.swf");
            clip.setHandCursor(true);  
    
            clip.setText(txt);  
      
            clip.addEventListener('complete', function () {  
                alert("复制成功");
                copy=0;
            });  
            if(copy==0){
                copy=1;
         	   copyToClipboard(id,txt);
                }
                 
            clip.glue(""+id+""); 
     
   
        }
    </script>
        

        
        
        
        
        
        
        
        
        
        
        
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 












