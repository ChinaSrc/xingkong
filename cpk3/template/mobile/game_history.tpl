<div class='lottery-order'>
    <div class="tab" style="display: none">
        <div id='history_title_1' onclick="change_tabs(1,2);" class="item active">订单记录</div>
        <!--{if $game_type['skey']!='k3' && $game_type['dp']!='k3'}-->
        <div id='history_title_2' onclick="change_tabs(2,2);" class="item">追号记录</div>

        <!--{/if}-->

        <img src='<!--{$file_uri}-->/template/default/images/icons/icon_refresh.png' style='float:right;margin-top:6px;margin-right:10px;cursor:pointer; ' alt='刷新' onclick="Ajax_get_buy();">
    </div>
    <div class="content"  >
        <div id='history_content_1' class="item active" data-init="true">
            <table class="table">
                <thead>
                <tr>

                    <th >期号</th>
                    <th >内容</th>
                    <th >下注金额</th>



                    <th>状态</th>

                </tr>
                </thead>
                <tbody id='history_info_1'>


                </tbody>
            </table>
            <div class="page-list">
                <div class="easy-page"></div>
            </div>
        </div>

        <div  id='history_content_2' class="item" data-init="true">
            <table class="table table-bordered padding-small">
                <thead>
                <tr>


                    <th >起始期号</th>

                    <th >总金额</th>
                    <th >已追/总</th>


                    <th>状态</th>

                </tr>
                </thead>
                <tbody id='history_info_2'></tbody>
            </table>
            <div class="page-list">
                <div class="easy-page"></div>
            </div>
        </div>



    </div>
</div>
