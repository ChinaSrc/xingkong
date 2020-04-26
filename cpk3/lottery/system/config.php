<?

$type = $_GET['type'];

if (!$type) $type = 'basic';
$rowss = getsql::sys();
if ($ModeType != "aotu") {
    $modeShow = "disabled";
}
if ($rowss[FixedModes] == "yes") {
    $FixedModes_check = "checked";
}
if ($rowss[AutoModes] == "yes") {
    $AutoModes_check = "checked";
}

include(ROOT_PATH . "/" . $AdminPath . "/body_line_top.php"); ?>
    <style>


    </style>

    <form method="POST" action="index.aspx?action=save_post&active=system&flag=yes" name="form" id="form"
          enctype="multipart/form-data">
        <input name="flag" type="hidden" value="save"/>
        <input name="playkey" type="hidden" value="<? echo $playkey; ?>"/>
        <table width="100%" border="0" cellpadding="4" cellspacing="1">


        <?php if ($type == 'basic') { ?>

                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>晋级奖励封面图片</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="active_vip_pic" type="file" size="15" value="">
                            <? if ($rowss['active_vip_pic']) { ?>
                                <a href='../<?php echo $rowss['active_vip_pic'] ?>' target='_blank'>查看</a>

                            <?php } ?>
                        </div>

                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>直属会员</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="sys_user_open" id="sys_user_open1" value="1">开启
                            <input type=radio name="sys_user_open" id="sys_user_open2" value="2">关闭

                            &nbsp;&nbsp;<font color='#777777'>开启之后，删除用户其下级用户归直属会员所有，否则归其上级所有(如其上级不存在，也为直属会员所有)</font>
                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[sys_user_open];?>';
                        if (selacc == '1') {
                            G('sys_user_open1').checked = true;
                        } else {
                            G('sys_user_open2').checked = true;
                        }
                    </script>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>系统直属会员</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="sys_user" type="text" size="10" value="<? echo $rowss['sys_user']; ?>">

                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>代理最高层数</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="user_leve" type="text" size="10" value="<? echo $rowss['user_leve']; ?>">层

                            (如果填写10，超过10层不参与返点)
                        </div>
                    </td>

                </tr>

                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>新用户注册多久才能推荐注册</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="reg_hours" type="text" size="10" value="<? echo $rowss['reg_hours']; ?>">小时

                            (默认1小时才能推荐注册，代理除外，不限制请填写0)
                        </div>
                    </td>

                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>异常单检测时间</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="error_check" type="text" size="10" value="<? echo $rowss['error_check']; ?>">分钟
                        </div>
                    </td>

                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>单注盈利超过多少将为异常单</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="error_max" type="text" size="10" value="<? echo $rowss['error_max']; ?>">
                        </div>
                    </td>

                </tr>
                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>中奖显示金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>


                            <input name="prize_min" type="text" size="8" value="<? echo $rowss[prize_min]; ?>">

                            -

                            <input name="prize_max" type="text" size="8" value="<? echo $rowss[prize_max]; ?>">元
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>邀请码位数</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="code_num" type="text" size="10" value="<? echo $rowss['code_num']; ?>">
                        </div>
                    </td>

                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>用户最高返点</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <?php
                            foreach ($arr_game_code as $key => $value) {

                                ?>
                                <span style="width:150px;display: inline-block;text-align: right">
                                    <?php

                                    echo $value;
                                    ?>
                                    :<input type="number" style="width: 80px" name="rebates_<?php echo $key; ?>"
                                            step="0.1" value="<?php echo $rowss['rebates_' . $key]; ?>" required>%


                                </span>
                                <?php
                            }

                            ?>

                        </div>
                    </td>

                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>上下级最大返点差</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="rebate_cha" type="text" size="10" value="<? echo $rowss['rebate_cha']; ?>">%
                        </div>
                    </td>

                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>每个用户最多绑定银行卡数量</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MaxBank" type="text" size="10" value="<? echo $rowss['MaxBank']; ?>">张
                        </div>
                    </td>

                </tr>


                <tr style="display: none">
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>默认奖金模式</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left' onload=>
                            <input name="modes" id="modes" type="text" size="10" value="<? echo $rowss['modes']; ?>">

                        </div>
                    </td>

                </tr>


                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>开奖前多少秒不能投注/撤单</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="Limit_Betting" id="Limit_Betting" type="text" size="8"
                                   value="<? echo $rowss[Limit_Betting]; ?>"> 秒
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>会员在线响应时长</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="OnLines" id="OnLines" type="text" size="10"
                                   value="<? echo $rowss[OnLines]; ?>">分钟
                            &nbsp;&nbsp;<font color='#777777'>提示：如设置“30”，则用户超过30分钟没有活动，系统认为其已不在线。</font>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>首页通知弹窗</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type="radio" name="index_note"
                                   value="1" <?php if ($rowss['index_note'] == 1) echo "checked"; ?>>始终弹窗 &nbsp;

                            <input type="radio" name="index_note"
                                   value="0" <?php if ($rowss['index_note'] != 1) echo "checked"; ?>>只弹一次 &nbsp;


                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>邀请码状态</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type="radio" name="regcode_status"
                                   value="1" <?php if ($rowss['regcode_status'] == 1) echo "checked"; ?>>必填 &nbsp;

                            <input type="radio" name="regcode_status"
                                   value="2" <?php if ($rowss['regcode_status'] == 2) echo "checked"; ?>>选填 &nbsp;

                            <input type="radio" name="regcode_status"
                                   value="3" <?php if ($rowss['regcode_status'] == 3) echo "checked"; ?>>隐藏
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>系统默认邀请码</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="regcode" type="text" size="50" value="<? echo $rowss[regcode]; ?>">

                            （务必填写正确的邀请码，否则注册会出现异常）
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>注册地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="regUrl" type="text" size="50" value="<? echo $rowss[regUrl]; ?>">

                            （注册地址可以去代理中心生成）
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>客服地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="ServiceUrl" id="ServiceUrl" type="text" size="50"
                                   value="<? echo $rowss[ServiceUrl]; ?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>IOS安装包下载地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="downios" type="text" size="50" value="<? echo $rowss[downios]; ?>">
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>Iphone下载二维码</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="qrcodeIos" type="file" size="50" value="<? echo $rowss['qrcodeIos']; ?>">


                            <?php if ($rowss['qrcodeIos']) { ?>
                                &nbsp;
                                <a href='../<?php echo $rowss['qrcodeIos']; ?>' target='_blank'>查看</a>

                            <?php } ?>


                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>购卡地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="rechargecard" type="text" size="50" value="<? echo $rowss[rechargecard]; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>Android安装包下载地址
                        </div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="downAndroid" type="text" size="50" value="<? echo $rowss[downAndroid]; ?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>Android下载二维码</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="qrcodeAndriod" type="file" size="50" value="<? echo $rowss[qrcodeAndriod]; ?>">
                            <?php if ($rowss['qrcodeAndriod']) { ?>
                                &nbsp;
                                <a href='../<?php echo $rowss['qrcodeAndriod']; ?>' target='_blank'>查看</a>

                            <?php } ?>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>PC端首页购彩页面背景图片</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="mobile_bg" type="file" size="50" value="<? echo $rowss[mobile_bg]; ?>">
                            <?php if ($rowss['mobile_bg']) { ?>
                                &nbsp;
                                <a href='../<?php echo $rowss['mobile_bg']; ?>' target='_blank'>查看</a>

                            <?php } ?>
                        </div>
                    </td>
                </tr>


                <tr style="display: none;">
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>pc客户端下载地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="downpc" type="text" size="50" value="<? echo $rowss[downpc]; ?>">
                        </div>
                    </td>
                </tr>

                <?php

                for ($i = 1;
                 $i <= 3;
                 $i++) {
                ?>
                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>
                            开奖地址密钥<?php echo $i; ?></div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="lotapi_<?php echo $i; ?>" type="password" size="50"
                                   value="<? echo $rowss['lotapi_' . $i]; ?>">
                        </div>
                    </td>
                </tr>

                <?php } ?>
            <?php } else if ($type == 'pc'){ ?>
                <script charset="utf-8" src="../static/js/kindeditor/kindeditor.js"></script>
                <script charset="utf-8" src="../static/js/kindeditor/lang/zh_CN.js"></script>
                <script>
                    var editor;
                    KindEditor.ready(function (K) {
                        editor = K.create('textarea[name="user_content",name="index_content",name="hall_content"]', {
                            allowFileManager: true
                        });

                    });
                </script>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>PC页面背景图片</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="pc_bg" type="file" size="15" value="">
                            <? if ($rowss['pc_bg']) { ?>
                                <a href='../<?php echo $rowss['pc_bg'] ?>' target='_blank'>查看</a>

                            <?php } ?>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>首页下部图片</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="index_bottom_bg" type="file" size="50"
                                   value="<? echo $rowss[index_bottom_bg]; ?>">
                            <?php if ($rowss['index_bottom_bg']) { ?>
                                &nbsp;
                                <a href='../<?php echo $rowss['index_bottom_bg']; ?>' target='_blank'>查看</a>

                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>代理介绍封面图片</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="user_pic" type="file" size="15" value="">
                            <? if ($rowss['user_pic']) { ?>
                                <a href='../<?php echo $rowss['user_pic'] ?>' target='_blank'>查看</a>

                            <?php } ?>
                        </div>

                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>代理介绍内容</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                     <textarea name="user_content" style="width: 100%;height:300px">
                         <?php
                         echo $rowss['user_content'];
                         ?>

                     </textarea>
                        </div>

                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>首页自定义区域高度</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <input type="number" min="0" name="index_height" value="<?php echo $rowss['index_height']; ?>">px
                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>首页自定义内容</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                     <textarea name="index_content" style="width: 100%;height:300px">
                         <?php
                         echo $rowss['index_content'];
                         ?>

                     </textarea>
                        </div>

                    </td>
                </tr>

                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>彩票大厅区域高度</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <input type="number" min="0" name="hall_height" value="<?php echo $rowss['hall_height']; ?>">px
                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>彩票大厅自定义内容</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                     <textarea name="hall_content" style="width: 100%;height:300px">
                         <?php
                         echo $rowss['hall_content'];
                         ?>

                     </textarea>
                        </div>

                    </td>
                </tr>

            <?php }else if ($type == 'chat'){ ?>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>聊天室状态</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="chat_open" id="chat_open1" value="1">开启
                            <input type=radio name="chat_open" id="chat_open0" value="0">关闭


                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[chat_open];?>';
                        if (selacc == '1') {
                            G('chat_open1').checked = true;
                        } else {
                            G('chat_open0').checked = true;
                        }
                    </script>
                </tr>

                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>聊天室关闭原因</div>
                    </td>
                    <td width="80%" style="text-align: left">
                        <div style=margin-left:5px;text-algin:left>
                            <textarea name="chat_close"
                                      style="width: 100%"><?php echo $rowss['chat_close'] ?></textarea> (支持HTML)
                        </div>

                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>聊天室地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="chat_url" type="text" size="50" value="<? echo $rowss[chat_url]; ?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>聊天室秘钥</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="chat_key" type="text" size="50" value="<? echo $rowss[chat_key]; ?>">
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>测试账户向聊天室转账</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type="radio" name="user_chat_tranfer"
                                   value="1" <?php if ($rowss['user_chat_tranfer'] == 1) echo "checked"; ?>>允许 &nbsp;

                            <input type="radio" name="user_chat_tranfer"
                                   value="2" <?php if ($rowss['user_chat_tranfer'] == 2) echo "checked"; ?>>禁止 &nbsp;
                        </div>
                    </td>
                </tr>

            <?php }else if ($type == 'permissions') { ?>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>测速页面</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="sys_welcome" id="sys_welcome1" value="1">开启
                            <input type=radio name="sys_welcome" id="sys_welcome2" value="2">关闭


                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[sys_welcome];?>';
                        if (selacc == '1') {
                            G('sys_welcome1').checked = true;
                        } else {
                            G('sys_welcome2').checked = true;
                        }
                    </script>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>手机WAP</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="mobile_open" id="mobile_open1" value="1">开启
                            <input type=radio name="mobile_open" id="mobile_open2" value="0">关闭


                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[mobile_open];?>';
                        if (selacc == '1') {
                            G('mobile_open1').checked = true;
                        } else {
                            G('mobile_open2').checked = true;
                        }
                    </script>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>调试模式</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="ip_open" id="ip_open1" value="1">开启
                            <input type=radio name="ip_open" id="ip_open2" value="0">关闭
                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[ip_open];?>';
                        if (selacc == '1') {
                            G('ip_open1').checked = true;
                        } else {
                            G('ip_open2').checked = true;
                        }
                    </script>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>调试IP</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea rows="5" cols="80" name='ip_access'><?php echo $rowss['ip_access'] ?></textarea>
                            (用“|”分割)
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>禁止访问IP</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea rows="5" cols="80" name='ip_deny'><?php echo $rowss['ip_deny'] ?></textarea>
                            (用“|”分割)
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>后台域名</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea rows="5" cols="80" name='admin_url'><?php echo $rowss['admin_url'] ?></textarea>
                            (用“|”分割,不填写代表任意域名都可以访问后台)
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>会员清理</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="sys_user_del" id="sys_user_del1" value="1">开启
                            <input type=radio name="sys_user_del" id="sys_user_del2" value="2">关闭


                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[sys_user_del];?>';
                        if (selacc == '1') {
                            G('sys_user_del1').checked = true;
                        } else {
                            G('sys_user_del2').checked = true;
                        }
                    </script>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>会员清理条件</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="Del_Member_date" id="Del_Member_date" type="text" size="10"
                                   value="<? echo $rowss[Del_Member_date]; ?>">天未登录

                            &nbsp; &nbsp;

                            账户余额低于<input name="Del_Member_money" id="Del_Member_money" type="text" size="10"
                                         value="<? echo $rowss[Del_Member_money]; ?>">元
                        </div>
                    </td>
                </tr>


            <?php }else if ($type == 'view') { ?>

                <tr>
                    <td width="200px" height="25">

                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>登陆通知</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="loginnote" id="loginnote1" value="yes">启用
                            <input type=radio name="loginnote" id="loginnote2" value="no">停用
                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[loginnote];?>';
                        if (selacc == 'yes') {
                            G('loginnote1').checked = true;
                        } else {
                            G('loginnote2').checked = true;
                        }
                    </script>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>通知标题</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="note_title" type="text" size="50" value="<? echo $rowss[note_title]; ?>">
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>通知内容</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea rows="5" cols="80"
                                      name='note_content'><?php echo $rowss['note_content'] ?></textarea>

                            支持HTML
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>客服代码</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea rows="5" cols="80"
                                      name='ServiceCode'><?php echo $rowss['ServiceCode'] ?></textarea>

                        </div>
                    </td>
                </tr>


                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>走势地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="zsurl" type="text" size="50" value="<? echo $rowss[zsurl]; ?>">
                        </div>
                    </td>
                </tr>

                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>遗漏数据地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="ylurl" type="text" size="50" value="<? echo $rowss[ylurl]; ?>">
                        </div>
                    </td>
                </tr>
                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>导航注册</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type=radio name="navreg_open" id="navreg_open1" value="1">开启
                            <input type=radio name="navreg_open" id="navreg_open2" value="2">关闭
                        </div>
                    </td>
                    <script>var selacc = '<?echo $rowss[navreg_open];?>';
                        if (selacc == '1') {
                            G('navreg_open1').checked = true;
                        } else {
                            G('navreg_open2').checked = true;
                        }
                    </script>
                </tr>

                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>导航注册地址</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="navreg_url" type="text" size="50" value="<? echo $rowss[navreg_url]; ?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>后台翻页页数</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <select name='admin_pagenum'>
                                <?php
                                for ($i = 5; $i <= 50; $i = $i + 5) {
                                    ?>
                                    <option value='<?php echo $i; ?>' <?php if ($i == $rowss['admin_pagenum']) echo "selected"; ?>><?php echo $i; ?></option>

                                    <?php

                                }

                                ?>

                            </select>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>前台翻页页数</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <select name='user_pagenum'>
                                <?php
                                for ($i = 5; $i <= 50; $i = $i + 5) {
                                    ?>
                                    <option value='<?php echo $i; ?>' <?php if ($i == $rowss['user_pagenum']) echo "selected"; ?>><?php echo $i; ?></option>

                                    <?php

                                }

                                ?>

                            </select>

                        </div>
                    </td>
                </tr>


            <?php }else if ($type == 'recharge') { ?>
                <tr style="display: none">
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>充值模式</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type="checkbox" name="cash_type[]"
                                   value="1" <?php if (strpos($rowss['cash_type'], '1') !== false) echo "checked"; ?>>自动模式
                            <input type="checkbox" name="cash_type[]"
                                   value="2" <?php if (strpos($rowss['cash_type'], '2') !== false) echo "checked"; ?>>手工模式

                        </div>
                    </td>

                </tr>
                <?php $recharge_type = unserialize($rowss['recharge_type']); ?>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>充值渠道</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>

                            <?php
                            foreach ($recharge_type_arr as $key => $value) {

                                ?>

                                <input type="checkbox" name="recharge_type[]"
                                       value="<?php echo $key; ?>" <?php if (in_array($key, $recharge_type)) echo 'checked'; ?>><?php echo $value; ?>&nbsp;


                                <?php
                            }

                            ?>
                        </div>
                    </td>

                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>首选充值渠道</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <select name="recharge_first">

                                <?php
                                foreach ($recharge_type_arr as $key => $value) {
                                    if (in_array($key, $recharge_type)) {

                                        ?>

                                        <option value="<?php echo $key; ?>" <?php if ($rowss['recharge_first'] == $key) echo "selected"; ?>><?php echo $value; ?></option>

                                        <?php
                                    }
                                }

                                ?>

                            </select>

                        </div>
                    </td>

                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>
                            充值提现审核成功，是否发送站内信通知
                        </div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input type="radio" name="auto_msg"
                                   value="1" <?php if ($rowss['auto_msg'] == 1) echo "checked"; ?>> 发送 &nbsp;

                            <input type="radio" name="auto_msg"
                                   value="0" <?php if ($rowss['auto_msg'] != 1) echo "checked"; ?>> 不发送
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>在线支付单笔最低金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MinPutCash_amount" id="MinPutCash_amount" type="text" size="15"
                                   value="<? echo $rowss[MinPutCash_amount]; ?>"> 元
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>在线支付单笔最高金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MaxPutCash_amount" id="MaxPutCash_amount" type="text" size="15"
                                   value="<? echo $rowss[MaxPutCash_amount]; ?>"> 元
                        </div>
                    </td>
                </tr>
          
          		<tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>绿色通道最高金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MaxGreen_amount" id="MaxGreen_amount" type="text" size="15"
                                   value="<? echo $rowss[MaxGreen_amount]; ?>"> 元
                        </div>
                    </td>
                </tr>
          
                <tr style="display: none">
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>微信支付最低金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MinPutCash_wxpay" id="MinPutCash_wxpay" type="text" size="15"
                                   value="<? echo $rowss[MinPutCash_wxpay]; ?>"> 元
                        </div>
                    </td>
                </tr>


                <tr style="display: none">
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>支付宝最低金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MinPutCash_alipay" id="MinPutCash_alipay" type="text" size="15"
                                   value="<? echo $rowss[MinPutCash_alipay]; ?>"> 元
                        </div>
                    </td>
                </tr>
                <tr style="display: none">
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>在线支付提示信息</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea name='charge_note0' cols='100'
                                      rows='4'><?php echo $rowss['charge_note0'] ?></textarea>
                            (支持HTML)
                        </div>
                    </td>
                </tr>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>充值卡充值提示信息</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea name='charge_note1' cols='100'
                                      rows='4'><?php echo $rowss['charge_note1'] ?></textarea>
                            (支持HTML)
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>充值提示信息</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <textarea name='charge_note2' cols='100'
                                      rows='4'><?php echo $rowss['charge_note2'] ?></textarea>
                            (支持HTML)
                        </div>
                    </td>
                </tr>

                <tr style='display:none;'>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>最长付款时间</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="long_pay" type="text" size="15" value="<? echo $rowss["long_pay"]; ?>">小时
                            (手动充值超过此时间，订单将自动关闭)
                        </div>
                    </td>
                </tr>

                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>单笔最少提现金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MinGetCash_amount" id="MinGetCash_amount" type="text" size="15"
                                   value="<? echo $rowss[MinGetCash_amount]; ?>"> 元
                        </div>
                    </td>
                </tr>
                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>单笔最大提现金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MaxGetCash_amount" type="text" size="15"
                                   value="<? echo $rowss[MaxGetCash_amount]; ?>"> 元
                        </div>
                    </td>
                </tr>
                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>每天最大提现金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MaxGetCash_amount1" type="text" size="15"
                                   value="<? echo $rowss[MaxGetCash_amount1]; ?>"> 元
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>每天最多提现次数</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="MaxGetCash_num" id="MaxGetCash_num" type="text" size="15"
                                   value="<? echo $rowss[MaxGetCash_num]; ?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>洗码率</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="pay_pre" id="pay_pre" type="text" size="6" value="<? echo $rowss[pay_pre]; ?>">%


                            (30%表示充值100元 ， 洗码金额增加30元，洗码金额为0才能允许提现)
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>积分兑换率</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="score_pre" id="pay_pre" type="text" size="6"
                                   value="<? echo $rowss[score_pre]; ?>">%


                            (80%表示充值100元 ，充值100元 ， 积分增加80)
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px" bgcolor="#FFFFFF" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>充值时间</div>
                    </td>
                    <td width="80%" bgcolor="#FFFFFF">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="recharge_begin" type="text" size="6"
                                   value="<? echo $rowss[recharge_begin]; ?>">　－
                            <input name="recharge_end" type="text" size="6" value="<? echo $rowss[recharge_end]; ?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="200px" bgcolor="#FFFFFF" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>提现时间</div>
                    </td>
                    <td width="80%" bgcolor="#FFFFFF">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="Auto_JieS_Begin" id="Auto_JieS_Begin" type="text" size="6"
                                   value="<? echo $rowss[Auto_JieS_Begin]; ?>">　－
                            <input name="Auto_JieS_End" id="Auto_JieS_End" type="text" size="6"
                                   value="<? echo $rowss[Auto_JieS_End]; ?>">
                        </div>
                    </td>
                </tr>

            <?php } else if ($type == 'url') { ?>


                <tr align=left style="display: none">
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>网址数量</div>
                    </td>
                    <td width="80%">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="url_num" type="text" size="15" value="<? echo $rowss['url_num']; ?>">
                            （如6表示下面显示6条网址，刷新后生效）

                        </div>

                    </td>
                </tr>

                <?php


            for ($i = 0;
                 $i < $rowss['url_num'];
                 $i++) {
                ?>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;><?php if ($i < 2) echo "特别推荐线路"; elseif ($i < 4) echo "一般推荐线路"; else echo "普通线路"; ?></div>
                    </td>
                    <td width="80%">
                        <input name="url_<?php echo $i ?>" type="text" size="50"
                               value="<? echo $rowss['url_' . $i]; ?>">
                    </td>
                </tr>


            <?php } ?>
            <?php }else if ($type == 'hm') { ?>


                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否开启合买功能</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>

                            <input type="radio" name='hm_open' value='1'>开启 &nbsp;
                            <input type="radio" name='hm_open' value='2'>关闭 &nbsp;

                        </div>
                    </td>
                    <script>
                        chkcheckboxNew('hm_open', '<?echo $rowss['hm_open'];?>')
                    </script>
                </tr>

                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>合买最高盈利</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="hm_max" type="text" size="15" value="<? echo $rowss['hm_max']; ?>">%
                        </div>
                    </td>
                </tr>
                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>最低成交比例</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="hm_sueccss" type="text" size="15" value="<? echo $rowss['hm_sueccss']; ?>">%
                            &nbsp;

                            （90%表示：方案进度+保底>=90%，即可出票）
                        </div>
                    </td>
                </tr>
                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>合买最低金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="hm_min" type="text" size="15" value="<? echo $rowss['hm_min']; ?>">元
                        </div>
                    </td>
                </tr>


                <tr align='left'>
                    <td width="200px" bgcolor="#fff">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>每份最低金额</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>
                            <input name="hm_min_money" type="text" size="15" value="<? echo $rowss['hm_min_money']; ?>">元
                            &nbsp;

                        </div>
                    </td>
                </tr>


            <?php }else if ($type == 'banner') { ?>


                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>图片数量</div>
                    </td>
                    <td width="80%">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="banner_num" type="text" size="15" value="<? echo $rowss['banner_num']; ?>">
                            （如4表示下面显示4张图片，刷新后生效）

                        </div>

                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>图片地址及链接</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-algin:left;'>
                            <table>
                                <?php
                                for ($i = 0; $i < $rowss['banner_num']; $i++) {
                                    ?>
                                    <tr style='height:30px;'>
                                        <td>图片<?php echo $i + 1; ?>： <input name="banner_img_<?php echo $i ?>"
                                                                            type="file" size="80" value=""></td>
                                        <td style='padding-left:10px;'>
                                            <?php if ($rowss['banner_img_' . $i]) echo "<a href='../" . $rowss['banner_img_' . $i] . "' target='_blank'>查看</a>"; ?>
                                        </td>

                                    </tr>
                                    <tr style='height:30px;'>
                                        <td>链接<?php echo $i + 1; ?>： <input name="banner_url_<?php echo $i ?>"
                                                                            type="text" size="80"
                                                                            value="<? echo $rowss['banner_url_' . $i]; ?>">
                                        </td>
                                        <td style='padding-left:10px;'>

                                        </td>

                                    </tr>


                                <?php } ?>
                            </table>
                        </div>
                    </td>
                </tr>

            <?php }else if ($type == 'banner_hall') { ?>


                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>图片数量</div>
                    </td>
                    <td width="80%">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="banner_hall_num" type="text" size="15"
                                   value="<? echo $rowss['banner_hall_num']; ?>"> （如4表示下面显示4张图片，刷新后生效）

                        </div>

                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>图片地址及链接</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-algin:left;'>
                            <table>
                                <?php
                                for ($i = 0; $i < $rowss['banner_hall_num']; $i++) {
                                    ?>
                                    <tr style='height:30px;'>
                                        <td>图片<?php echo $i + 1; ?>： <input name="banner_hall_img_<?php echo $i ?>"
                                                                            type="file" size="80" value=""></td>
                                        <td style='padding-left:10px;'>
                                            <?php if ($rowss['banner_hall_img_' . $i]) echo "<a href='../" . $rowss['banner_hall_img_' . $i] . "' target='_blank'>查看</a>"; ?>
                                        </td>

                                    </tr>
                                    <tr style='height:30px;'>
                                        <td>链接<?php echo $i + 1; ?>： <input name="banner_hall_url_<?php echo $i ?>"
                                                                            type="text" size="80"
                                                                            value="<? echo $rowss['banner_hall_url_' . $i]; ?>">
                                        </td>
                                        <td style='padding-left:10px;'>

                                        </td>

                                    </tr>


                                <?php } ?>
                            </table>
                        </div>
                    </td>
                </tr>
            <?php }else if ($type == 'update') { ?>

                <tr>
                    <td width="200px" height="25">
                        <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>代理升级方式</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-align:left'>

                            <input type="radio" name='daili_sj' value='1'>手动 &nbsp;
                            <input type="radio" name='daili_sj' value='2'>自动 &nbsp;

                        </div>
                    </td>
                    <script>
                        chkcheckboxNew('daili_sj', '<?echo $rowss['daili_sj'];?>')
                    </script>
                </tr>
                <TR align=left>
                    <td width="20%">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>统计时间</div>
                    </td>
                    <td width="80%">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="update_begin" class="Wdate" style='width:180px;' type="text"
                                   value="<?php echo $rowss['update_begin']; ?>"
                                   onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})">
                            -
                            <input name="update_end" class="Wdate" style='width:180px;' type="text"
                                   value="<?php echo $rowss['update_end']; ?>"
                                   onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})">

                        </div>
                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>升级规则</div>
                    </td>
                    <td width="80%">
                        <div style=margin-left:5px;text-algin:left>
                            <input name="update_num" type="text" size="15" value="<? echo $rowss['update_num']; ?>">
                            （如4表示下面显示4条升级规则，刷新后生效）

                        </div>

                    </td>
                </tr>
                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>升级规则</div>
                    </td>
                    <td width="80%">
                        <div style='margin-left:5px;text-algin:left;'>
                            <table class="my_tbl my_tbltdm">
                                <tr>

                                    <th width="200" style="border-bottom: 0;">
                                        <table cellpadding="0" cellspacing="0" class="my_l_m" width="100%">
                                            <tr>
                                                <td colspan="2" class="myhd1">代理</td>
                                            </tr>
                                            <tr>
                                                <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">
                                                    返点数
                                                </td>
                                                <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">
                                                    分红比例
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <th>成功提现账户数</th>
                                    <th width="200" style="border-bottom: 0;">
                                        <table cellpadding="0" cellspacing="0" class="my_l_m" width="100%">
                                            <tr>
                                                <td colspan="2" class="myhd1">团队晋升</td>
                                            </tr>
                                            <tr>
                                                <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">
                                                    期间投注量
                                                </td>
                                                <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">
                                                    日均投注量
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <th width="200" style="border-bottom: 0;">
                                        <table cellpadding="0" cellspacing="0" class="my_l_m" width="100%">
                                            <tr>
                                                <td colspan="2" class="myhd1">团队维持</td>
                                            </tr>
                                            <tr>
                                                <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">
                                                    期间投注量
                                                </td>
                                                <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">
                                                    日均投注量
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>

                                <?php
                                for ($i = 0; $i < $rowss['update_num']; $i++) {
                                    ?>
                                    <tr>

                                        <td width="200" style="border-bottom: 0;">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="100"><input name="update_fandian_<?php echo $i; ?>"
                                                                           type="text" size="6"
                                                                           value="<? echo $rowss['update_fandian_' . $i]; ?>">%
                                                    </td>
                                                    <td width="100"><input name="update_fenhong_<?php echo $i; ?>"
                                                                           type="text" size="6"
                                                                           value="<? echo $rowss['update_fenhong_' . $i]; ?>">%
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td><input name="update_tixian_<?php echo $i; ?>" type="text" size="6"
                                                   value="<? echo $rowss['update_tixian_' . $i]; ?>"></td>
                                        <td width="200" style="border-bottom: 0;">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="100"><input name="update_from1_<?php echo $i; ?>"
                                                                           type="text" size="8"
                                                                           value="<? echo $rowss['update_from1_' . $i]; ?>">
                                                    </td>
                                                    <td width="100"><input name="update_to1_<?php echo $i; ?>"
                                                                           type="text" size="8"
                                                                           value="<? echo $rowss['update_to1_' . $i]; ?>">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="200" style="border-bottom: 0;">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="100"><input name="update_from2_<?php echo $i; ?>"
                                                                           type="text" size="8"
                                                                           value="<? echo $rowss['update_from2_' . $i]; ?>">
                                                    </td>
                                                    <td width="100"><input name="update_to2_<?php echo $i; ?>"
                                                                           type="text" size="8"
                                                                           value="<? echo $rowss['update_to2_' . $i]; ?>">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </table>


                        </div>

                    </td>
                </tr>

                <tr align=left>
                    <td width="20%" height="25">
                        <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>升级描述</div>
                    </td>
                    <td width="80%">
                        <div style=margin-left:5px;text-algin:left>
                            <textarea rows="8" cols="120" name='update_con'><? echo $rowss['update_con']; ?></textarea>

                            （支持HTML）

                        </div>

                    </td>
                </tr>
            <?php } ?>


            <tr>
                <td></td>
                <td align=left>&nbsp;
                    <input type="submit" class="button" name="submit" value="保存配置">
                </td>
            </tr>

        </table>
    </form>
<?php include(ROOT_PATH . "/" . $AdminPath . "/body_line_bottom.php"); ?>