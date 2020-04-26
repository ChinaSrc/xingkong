<!DOCTYPE html>
<html lang="zh-CN" xml:lang="zh-CN">
<head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
    <meta charset="UTF-8" />
<title><!--{$config.sitename}-->-<!--{$config.sitetitle}--></title>
  <link rel="shortcut icon" href="<!--{$con_system['ico']|getFileUri}-->" type="image/x-icon" />
<meta name="description" content="<!--{$config.description}-->" />
<meta name="keywords" content="<!--{$config.keywords}-->" />




    <link href='<!--{$file_uri}-->/<!--{$skinpath}-->style/main.css' rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<!--{$file_uri}-->/static/js/func.js"></script> 

<script type="text/javascript" src="<!--{$file_uri}-->/static/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/common.js"></script>    
  
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/index.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xcConfirm.css"/>
    
        <script src="<!--{$file_uri}-->/static/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>




    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/util.min.css" />
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/default.min.css" />


    <link rel="stylesheet" href="<!--{$root_url}-->/<!--{$skinpath}-->style/fontello.css" />

    <link rel="stylesheet" href="<!--{$tplpath}-->style/lottery.css" type="text/css" />
</head>

<body id="bg-base" style="background:url(<!--{$con_system['pc_bg']|getFileUri}-->) no-repeat left 30px;background-size: 100%;
        <!--{if $smarty.get.from neq 'parent'}--><!--{if $smarty.get.mod neq 'game'}-->	padding-top: 100px;<!--{else}-->padding-top: 100px;<!--{/if}--><!--{/if}-->" oncontextmenu='self.event.returnValue=false'>


<style>
#BgDiv{background-color:#000000; position:fixed; z-index:7777; left:0; top:0;right:0px;bottom:0px; display:none; width:100%; height:100%;opacity:0.7;filter: alpha(opacity=40);-moz-opacity: 0.7;}
</style>


<!--{if $smarty.get.from neq 'parent'}-->

<div id="wrap">

    <div id="header">
        <div  id="nav">
            <div class="topBar-inner" >
            <!--{if $smarty.get.mod eq '' || $smarty.get.mod eq 'home' || $smarty.get.mod eq 'login' || $smarty.get.mod eq 'reg'}-->

                Hi!欢迎来到<!--{$config.sitename}-->

            <!--{else}-->


                <div style="float: left"><a href="index_home.html" >返回首页</a> |  &nbsp; </div>



                <span class="show_menu">
    全部彩票<i class="icon-down-open"></i>
          <div class="menu_list">
<i class="arrow"></i>

              <!--{foreach from=$arr_game_code key=key item=item}-->

              <!--{if count($game_nav[$key])>0}-->
            <div class="line">
                <div class="ico">
                    <img  src="<!--{$file_uri}-->/static/images/ico/<!--{$key}-->.png" />
                </div>
           <div class="info">
                <!--{foreach from=$game_nav[$key] key=key1 item=item1}-->

                <a href="<!--{$root_url}-->game_<!--{$item1['id']}-->.html?nav=<!--{$key}-->" >
                    <!--{$item1['fullname']}-->
                </a>

               <!--{/foreach}-->

           </div>
                <!--{if $key!='other'}-->
                <div style="border-bottom: 1px #eee solid;height:3px;clear: both">&nbsp;</div>
                <!--{/if}-->
 </div>




              <!--{/if}-->


              <!--{/foreach}-->

                        </div>
</span>

                <!--{/if}-->
            </div>
            <div id="navbar">
                <ul>

                    <!--{if $smarty.session.userid}-->
                    <!--{if $smarty.get.mod eq 'game'}-->

                    <li id="toogle_bell" class="bell_<!--{if $userinfo['vedio']==1}-->on<!--{else}-->off<!--{/if}-->"   onclick="set_vedio();"><!--TEST BELL 03 --></li>
                    <!--{/if}-->
                    <li>
                        <span>
                            <img src="<!--{avatar()}-->" class="avatar">

                        </span>
                        <a href="home_safe_info.html"><strong><!--{if $userinfo['nickname']}--><!--{$userinfo['nickname']}--><!--{else}--><!--{$userinfo['username']}--><!--{/if}--></strong></a>
                   <!--{show_user_info($userinfo['userid'])}-->

                    </li>

                    <li style="margin-left: 0px;">
                        <a href="home_safe_msg.html" style="position: relative">
                            <i class="icon-mail "></i>
                            <!--{if $msg_num>0}-->
                            <span  style='position:absolute;right:-10px;top:-5px;display:block;background-color:#ff0000;color:#fff;font-size:12px;width: 16px;height:16px;line-height:16px;border-radius:50%;text-align: center;' ><!--{$msg_num}--></span>

                            <!--{/if}-->
                        </a>

                    </li>
                    <li class="show_menu">
                        <a href="home.html">我的账户<i class="icon-down-open"></i></a>

                        <div class="menu_list">
                            <i class="arrow"></i>


                            <a href="home_user_buy.html">
                               投注记录

                            </a><br>
                            <a href="home_user_orders.html">
                     交易记录

                            </a>
                            <br>
                            <a href="home_safe_info.html">

                                个人信息

                            </a>  <br>
                            <a href="home.html">

                                安全中心

                            </a>  <br>

                            <a href="home_user_list.html">

                                代理中心

                            </a><br>

                        </div>

                    </li>
                    <li class="balance">
                        <span>余额：</span>
                        <span class="J-balance-show"  id='newmoney'><!--{$cur_amount}--></span>
                      <span id="money_hide" style="display: none">****</span>
                        <span style="padding-left: 10px;">洗码：</span>
                        <span   id='low_amount'><!--{$low_amount}--></span>

                        <a  onclick="GetNewMoney();" id="money_fresh"><i class="icon-recycle"></i></a>
                        <span id="xima_hide" style="display: none">****</span>
                        <i class="icon-eye" onclick="show_money();"></i>
                    </li>

                </ul>
                <script>
                    function show_money() {
                        if(document.getElementById('newmoney').style.display=='none'){
                            document.getElementById('newmoney').style.display='';
                            document.getElementById('money_hide').style.display='none';
                            document.getElementById('xima_hide').style.display='none';
                            document.getElementById('low_amount').style.display='';
                            document.getElementById('money_fresh').style.display='';
                            document.querySelector('.icon-eye').className='icon-eye-off';
                        }else{

                            document.getElementById('newmoney').style.display='none';
                            document.getElementById('money_hide').style.display='';
                            document.getElementById('xima_hide').style.display='';
                            document.getElementById('low_amount').style.display='none';
                            document.getElementById('money_fresh').style.display='none';
                            document.querySelector('.icon-eye-off').className='icon-eye';
                        }

                    }


                </script>
                <div id="settings">

                    <a href="home_safe_recharge.html"><i class="icon-money-1"></i>充值</a>
                    <a href="home_safe_platform.html"><i class="icon-ok"></i>提现						</a>
                    <a href="home_safe_chat.html"><i class="icon-squares"></i>聊天室充值						</a>
                    <a href="logout.aspx"><i class="icon-logout"></i>登出						</a>
                    <a href="<!--{$ServiceUrl}-->" target="_blank" ><i class="icon-menu-4"></i>在线客服</a>
                </div>

                    <!--{else}-->
                <div id="settings">


                 <a href="login.html"><i class="icon-user"></i>请登录</a>



                <a href="<!--{$con_system['regUrl']}-->"><i class="icon-edit"></i>免费注册</a>
                    <a href="<!--{$ServiceUrl}-->" target="_blank" ><i class="icon-menu-4"></i>在线客服</a>
                </div>
                    <!--{/if}-->


            </div><!-- navbar -->
        </div><!-- nav -->
    </div><!-- header -->


    <div id="menu-container">
        <div  id="menu" style="height: 60px">
            <ul class="left">


                    <a href="index_home.html">
                        <img src="<!--{$file_uri}-->/<!--{$config.logo}-->" style="border:none;height:50px;margin-top: 5px;">
                    </a>



            </ul>
            <ul class="right">

                <li <!--{if $smarty.get.mod=='home' || !$smarty.get.mod}-->class="active" <!--{/if}-->><a href="index_home.html">
                    <i class=" icon-home "></i>
                    <h5>首页</h5>

                </a></li>
                <li  class="header-dropdown <!--{if $smarty.get.mod=='hall'}-->active <!--{/if}--> " id="all-games">
                    <a href="index_hall.html">
                    <i class="icon-menu-3 "></i>
                    <h5>购彩大厅</h5>

                </a>


                </li>
                <li <!--{if $smarty.get.mod=='active'}-->class="active" <!--{/if}-->>
                <a href="index_active.html">
                    <i class="icon-gift "></i>
                    <h5>活动中心</h5>

                </a></li>


                <li <!--{if $smarty.get.mod=='mobile'}-->class="active" <!--{/if}-->>
                <a href="index_mobile.html">
                    <i class="icon-mobile "></i>
                    <h5>手机购彩</h5>

                </a></li>


                <li <!--{if ($smarty.get.mod=='safe' || ($smarty.get.mod=='report' && $smarty.get.code!='list' )) && $smarty.get.code!='recharge'  && $smarty.get.code!='msg' && $smarty.get.code!='platform'}-->class="active" <!--{/if}-->>

                <a href="home.html">
                    <i class="icon-user "></i>
                    <h5>我的帐户</h5>
                </a>

                </li>


                <li <!--{if $smarty.get.mod=='chat'}-->class="active" <!--{/if}--> style="position: relative;">

                <a href="index_chat.html" target="_blank">
                    <i class="icon-chat "></i>
                    <h5>聊天交流</h5>
                </a>

                </li>



                <li <!--{if $smarty.get.mod=='help'}-->class="active" <!--{/if}-->>
                <a href="index_help.html">
                    <i class="icon-help "></i>
                    <h5>帮助中心</h5>

                </a>

                </li>

            </ul>
        </div>

    </div>
    <!--{/if}-->
</div>








<em  id='lostmoney' name='lostmoney'  style='display:none;'><!--{$cur_amount}--></em>


<div id="BgDiv" ></div>



<!--{if !$smarty.session.userid  && $smarty.get.mod!='login' && $smarty.get.code!='wage' && $smarty.get.code!='fenhong' && $smarty.get.code!='quota'}-->

<!--{/if}-->