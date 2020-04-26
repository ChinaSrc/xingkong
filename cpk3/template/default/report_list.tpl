


<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<style>



.todayState {
    margin: 15px;height:100px;
}

.todayState .leftMoney {
    width: 282px;
    height: 75px
}

.todayState .leftMoney span {
    font-size: 30px;
    color: #e4393c;
    font-family: arial
}

.todayState .leftMoney span i {
    font-family: \\5FAE\8F6F\96C5\9ED1;
    font-size: 26px
}

.todayState .leftMoney p {
    margin: 10px 0
}

.todayState .leftMoney p a {
    border-radius: 4px;
    border: 1px solid #ddd;
    margin: 0 3px;
    padding: 2px 10px
}

.todayState .leftMoney p a:nth-child(2) {
    margin-left: 28px
}

.todayState .leftMoney p i {
    font-size: 16px;
    margin-right: 5px
}

.todayState .calculate,.todayState .ykState {
    width: 250px;
    height: 75px
}

.todayState .calculate .defFont,.todayState .ykState .defFont {
    color: #fff;
    background: #fb4046;
    padding: 7px 6px;
    font-size: 44px;
    display: block;
    height: 60px;
    width: 60px;
    border-radius: 4px;
    line-height: 60px;
    float: left
}

.todayState .calculate .ykDetail,.todayState .ykState .ykDetail {
    display: block;
    width: 145px;
    height: 50px;
    float: left;
    padding-left: 10px;
    line-height: 1.4
}

.todayState .calculate .ykDetail p,.todayState .ykState .ykDetail p {
    margin: 0;
    margin-left: 10px
}

.todayState .calculate .ykDetail em,.todayState .ykState .ykDetail em {
    font-size: 28px;
    color: #e4393c;
    font-family: arial;
    line-height: 2
}



.todayState .calculate .ykDetail ins,.todayState .ykState .ykDetail ins {
    margin-left: 10px;
    color: #e4393c;
    display: block;
    margin-top: 18px
}

.todayState .calculate,.todayState .leftMoney,.todayState .ykState {
    float: left;
    padding: 15px
}

.todayState>div+div {
    margin-left: 15px
}

.calculate,.leftMoney,.plMore,.ykState {
    border: 1px solid #ddd;
    border-radius: 6px
}
.plMore {
    display: table;
    width: 910px;
    text-align: center;
    padding: 20px 0;
    margin: 15px;
    border: 1px solid #d5d5d5;
    border-radius: 6px;
    margin-top: 20px;

}

.plMore li {
    display: table-cell
}

.plMore li+li {
    border-left: 1px dotted #d9d8d8
}

.plMore em {
    font-size: 18px
}

.plMore span {
    display: block
}










</style>


        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">


<!--{include file="<!--{$tplpath}-->user_top.tpl"}-->












                    <div class="home_rec clearfix">






                        <div >
                            <div  class="todayState fix">
                                <div  class="leftMoney">
                                    <span >    <i ></i><!--{$cur_amount}--></span>
                                    <p ><i class="defFont icon-money"></i>余额
                                        <a  href="home_safe_recharge.html" class="">充值</a>
                                        <a  href="home_user_platform.html" class="">提现</a>
                                        <a  href="home_user_orders.html" class="">交易记录</a></p>
                                </div>
                                <div  class="ykState">
                                    <i class="defFont icon-chart-line-1"></i>
                                    <div  class="ykDetail">
                                        <p >个人盈亏（元）</p>
                                        <em ><i ></i><!--{$sum.sum}--></em>
                                    </div>
                                </div>
                                <div  class="calculate">
                                    <i  class="defFont icon-calculator"></i>
                                    <div  class="ykDetail">
                                        <p >盈亏计算公式</p>
                                        <ins >
                                            中奖-投注+活动+返佣
                                        </ins>
                                    </div>
                                </div>
                            </div>
                            <ul  class="plMore">
                                <li ><em ><!--{$sum.buy}--></em><span >投注金额</span></li>
                                <li ><em ><!--{$sum.prize}--></em><span >中奖金额</span></li>
                                <li ><em ><!--{$sum.active}--></em><span >活动礼金</span></li>
                                <li ><em ><!--{$sum.rebate}--></em><span >返点佣金</span></li>
                                <li ><em ><!--{$sum.recharge}--></em><span >充值金额</span></li>
                                <li ><em ><!--{$sum.mention}--></em><span >提现金额</span></li>
                            </ul>
                        </div>


     
  

                      
                        </div>
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
       
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 




