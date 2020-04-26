<?php
$blank=$db->exec("select * from user_bank_list where id='{$_GET['id']}'");
$user=$db->exec("select * from user where userid='{$blank['userid']}'");
if($_POST){

    $bank=$db->exec("select * from system_bank_list where id='{$_POST['bankid']}'");
$_POST['bankname']=$bank['name'];
    foreach ($_POST as $key=>$value){
   if($key)
     $db->query("update user_bank_list set `{$key}`='{$value}' where id='{$_GET['id']}'");

    }

    add_adminlog( "修改{$user['username']}的银行卡信息");
    echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>修改成功</font></div>";
    echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
    echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";

    exit();
}

$bank_list=$db->fetch_all("select * from system_bank_list where status='1' order by sortnum asc,id asc");

?>


<BODY bgColor=#FFFFFF>

<script src="/static/js/script_area.js"></script>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0  style="margin-top:10px;">
    <TBODY>
    <TR>

        <TD  align="center" bgColor=#f3f3f3>
            <form method="post" action="?controller=user&action=bank_edit&id=<?php echo $_GET['id'];?>&type=edit" >

                <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=left>
                    <TR align=left>
                        <td width="30%" bgcolor="#FFFFFF"><div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>用户名</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                         <?php echo $user['username']?>
                        </td>
                    </tr>

                    <tr bgcolor="#A4B6D7" align=left>
                        <td width="30%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>银行信息</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                            <select name="bankid">
                                <?php
                                foreach ($bank_list as $value){
                                    ?>
                                    <option  value="<?php echo $value['id'] ?>" <?php if($value['id']==$blank['bankid']) echo "selected";?>><?php echo $value['name']?></option>
                                    <?php
                                }
                                ?>

                            </select>

                        </td>
                    </tr>
                    <tr bgcolor="#A4B6D7" align=left>
                        <td width="30%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>所在地区</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                            <select id="province" name='province'></select>
                            <select id="city"  name='city'></select>
                            <select id="area"  name='area' ></select>
                            <script type="text/javascript">
                                addressInit('province', 'city', 'area','<?php echo $blank['province'];?>','<?php echo $blank['city'];?>','<?php echo $blank['area']?>');
                            </script>

                        </td>
                    </tr>
                    <tr bgcolor="#A4B6D7" align=left>
                        <td width="30%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>分行名称</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                            <input value="<?php echo $blank['bankAdress']?>" name="bankAdress">

                        </td>
                    </tr>
                    <tr bgcolor="#A4B6D7" align=left>
                        <td width="30%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>开户名</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                            <input value="<?php echo $blank['realname']?>" name="realname">

                        </td>
                    </tr>

                    <tr bgcolor="#A4B6D7" align=left>
                        <td width="30%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>卡号</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                            <input value="<?php echo $blank['banknum']?>" name="banknum">

                        </td>
                    </tr>

                    <tr bgcolor="#A4B6D7" align=left>
                        <td width="30%" bgcolor="#FFFFFF" height="25"><div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>状态</div></td>
                        <td width="70%" bgcolor="#FFFFFF">
                            <div style='margin-left:5px;text-algin:left'>
                                <input type="radio" name='status' value='0'  <?php if(!$blank['status']) echo "checked";?>>正常
                                <input type="radio" name='status' value='1' <?php if($blank['status']) echo "checked";?>>锁定
                            </div>
                        </td>
                    </tr>



                    <tr bgcolor="#A4B6D7" align=left>
                        <td colspan=2 bgcolor="#FFFFFF"><div style='height:30px;line-height:30px;text-align:center;margin:10px;'>
                                <input type="submit" class='button' value="保存" type="submit"  id='submit' >
                                &nbsp;&nbsp;
                            </div>
                        </td>
                    </tr>

                </table>

            </form> </TD>
    </TR>
    </TBODY>
</TABLE>

