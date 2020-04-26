<?
 
$type=$_GET['type'];

if(!$type) $type='list';
$rowss=getsql::sys();
if($ModeType!="aotu"){$modeShow="disabled";}
if($rowss[FixedModes]=="yes"){$FixedModes_check="checked";}
if($rowss[AutoModes]=="yes"){$AutoModes_check="checked";} 
?>
<input id='tpl_url' name='tpl_url' value='<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>' style='display:none'>
<script type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>/zdialog/zdrag.js"></script>
<script type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>zdialog/zdialog.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>js/diags.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>js/window.diags.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL;?>/js/My97DatePicker/WdatePicker.js"></script>


<?php include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?> 


       
       
       <?php if($type=='list'){?>
       
   <? include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");?>
    <table class="my_tbl my_tbltdm" cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 0;">
                        <tr>
                            <th>级别 </th>
                            <th width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" class="my_l_m" width="100%">
                                    <tr>
                                        <td colspan="2" class="myhd1">代理</td>
                                    </tr>
                                    <tr>
                                        <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">返点数</td>
                                        <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">分红比例</td>
                                    </tr>
                                </table>
                            </th>
                            <th>成功提现账户数 </th>
                            <th width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" class="my_l_m" width="100%">
                                    <tr>
                                        <td colspan="2" class="myhd1">团队晋升</td>
                                    </tr>
                                    <tr>
                                        <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">期间投注量</td>
                                        <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">日均投注量</td>
                                    </tr>
                                </table>
                            </th>  
                            <th width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" class="my_l_m" width="100%">
                                    <tr>
                                        <td colspan="2" class="myhd1">团队维持</td>
                                    </tr>
                                    <tr>
                                        <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">期间投注量</td>
                                        <td class="myhd1" style="border-right: 1px solid #D5D5D5;" width="100">日均投注量</td>
                                    </tr>
                                </table>
                            </th>
                        </tr>
                    
                        <tr>
                            <td>1952</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">12.6%</td>
                                        <td width="100">2%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>5</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">300000</td>
                                        <td width="100">20000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">150000</td>
                                        <td width="100">10000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>1954</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">12.7%</td>
                                        <td width="100">5%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>10</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">750000</td>
                                        <td width="100">50000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">375000</td>
                                        <td width="100">25000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>1956</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">12.8%</td>
                                        <td width="100">8%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>15</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">1500000</td>
                                        <td width="100">100000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">750000</td>
                                        <td width="100">50000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>1958</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">12.9%</td>
                                        <td width="100">10%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>20</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">3150000</td>
                                        <td width="100">210000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">1575000</td>
                                        <td width="100">105000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>1960</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">13%</td>
                                        <td width="100">15%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>50</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">7500000</td>
                                        <td width="100">500000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">3750000</td>
                                        <td width="100">250000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>1962</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">13.1%</td>
                                        <td width="100">18%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>100</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">18000000</td>
                                        <td width="100">1200000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">9000000</td>
                                        <td width="100">600000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>1964</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">13.2%</td>
                                        <td width="100">20%</td>
                                    </tr>
                                </table>
                            </td>
                            <td>200</td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">36000000</td>
                                        <td width="100">2400000</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="200" style="border-bottom: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="100">18000000</td>
                                        <td width="100">1200000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                    
                        <tr>
                            <td colspan="7" style="text-align: left;">
                                <p class="shenji3">
                                    团队投注额：是指代理及代理以下所有人的投注总量。
                                    每月<b>1,16</b>日凌晨<b>3</b>点系统自动调整代理分红、返点值。
                                </p>
                            </td>
                        </tr>
                        <tr><td colspan="7" style="text-align: left;"><p class="shenji3"><b class="red">超过日均50万投注量，级别升到1960，15%分红，直接与公司谈直属代理。
该代理直接推荐人享受特别待遇（具体达成后与公司谈）。</b></p></td></tr>
                    </table>
   
   
   
   
       <?php }else if($type=='add'){
       	
       	?>
       	
 <?php        	
       }?> 
    
<? include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");?>