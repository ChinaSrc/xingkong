
<!--{include file="<!--{$tplpath}-->head.tpl"}--> 



    <div id="content-wrap">
        
  <div id="subContainerId">
  
  
  <div class="main" id="content">
<!--cont 全部彩种最新开奖汇总 start-->
<div class="row" id="award_content">
    <div class="layout-base main-body cont drawing-cont">

        <div class="row">
            <div class="cont drawing-base">

                <!--table satrt-->
                <div class="drawing-table">
                    <div class="table ta-center" id="drawing_tableAll">
                        <table  style='width:100%;'>
                            <thead>
                                <tr>
                                    <th style=" width: 96px;"><span>彩种</span></th>
                                    <th style=" width: 96px;"><span>期号</span></th>
                                    <th><span>开奖时间</span></th>
                                    <th style=" width: 288px;"><span>开奖号码</span></th>
                                    <th style=" width: 64px;"><span>热门玩法</span></th>
                                    <th><span>投注提示</span></th>
                                    <th style=" width: 64px;"><span>开奖详情</span></th>
                             
                                    <th style=" width: 64px;"><span>购买</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            
                              <!--{foreach from=$game_list key=key item=item}-->
                                    <tr>
                                        <td><span style="color:rgb(30, 80, 162);"><!--{$item['fullname']}--></span></td>
                                        <td><span><!--{$item['period']}--></span></td>
                                        <td><span><!--{$item['lotTime']}--></span></td>
                                        <td>
                                                <div class="list-inline numbers number-circle">
                                      <!--{$item['number']}-->
                                                </div>
                                        </td>
                                            <td><span><!--{$item['firstcode']}--></span></td>
                                            <td><span><!--{$item['content']}--></span></td>
                                        <td><a href="lottery_<!--{$item['ckey']}-->.html">详情</a></td>
                                       
                                        
                                        <td><a href="game_<!--{$item['id']}-->.html">立即投注</a></td>
                                    </tr>
                                    
                                    <!--{/foreach}-->
                              
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--table end-->

            </div>
        </div>
        <!--cont end-->
    </div>
</div>
</div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
</div>



        
    </div>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   



</body>
</html>

