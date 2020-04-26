<?php


$admin=$_GET['admin'];
$id=$_GET['id'];


mysql_query("set names utf8;");
$SerialDate=date("Ymd",time());
$disc="";
if($id!=""){
mysql_query("set names utf8;");
$sql1="select * from user where userid='$id'";
$result1=mysql_query($sql1);


$numl=mysql_num_rows($result1);
if($numl-1>=0){
$user=$rowss=mysql_fetch_array($result1);
if ($_GET['ac_type'] == 'get_rebates') {
  	//----
  
  foreach ($arr_game_code as $key=>$value){

    if($rowss['higherid']){
      $maxrebate=$parent_rebates[$key];
      $minrebate=$maxrebate-$con_system['rebate_cha'];

    }
    else{

      $maxrebate=$con_system['rebates_'.$key];
      $minrebate=$maxrebate-$con_system['rebate_cha'];
    }
    if($minrebate<0) $minrebate=0;

  }
  
  //---
  
    echo json_encode(['username'=>$rowss[username],'min' => $minrebate,'max' => $maxrebate, 'rebates' => unserialize($rowss['rebates'])]);
  	exit;
}
$high=$db->fetch_first("select * from `user` where userid='{$rowss['higherid']}'");
$rowss['pname']=$high['username'];
if($rowss['higherid'])$pids=get_user_pid($id);
$bank=get_user_amount($id);
}
$ctitle="修改会员信息";
$disabled='disabled';
}
else {
	$ctitle="添加用户";
$disabled='';
$rowss[isproxy]=$_GET['isproxy'];

if($_GET['isproxy']==3){$admin='1';$ctitle="添加管理员";}
}
$con_system=getsql::sys();

$show_title=$ctitle;
?>
<script type="text/javascript">

function set_tabs(name,num){




	for(var i=1;i<=5;i++){

if(i==num){
	document.getElementById(name+"_title_"+i).className='current';
	document.getElementById(name+"_con_"+i).style.display='';
}else{

	document.getElementById(name+"_title_"+i).className='';
	document.getElementById(name+"_con_"+i).style.display='none';


}

		}


}




</script>

<div style='margin-top:5px;'>
			  <ul id="navlist">
			  <li><a class="current" id='info_title_1' href="javascript:set_tabs('info',1);">账户信息</a></li>

			    <?php
			    if($id>0){
			    ?>
                    <li ><a id='info_title_2'  href="javascript:set_tabs('info',2);">基本资料</a></li>

			    			  <li ><a id='info_title_3'  href="javascript:set_tabs('info',3);">资金信息</a></li>


			      <li><a id='info_title_4'   href="javascript:set_tabs('info',4);">其他信息</a></li>

			      <?php }?>
              </ul>
		   </div>

<form method="POST" action="?action=save_post&flag=yes&active=user&id=<?php echo $id;?>"  name="form" id="form">
 <input type="hidden" name="admin" value="<?php echo $admin;?>">
<input type='hidden' name='backurl' value='<?php echo $_SERVER['HTTP_REFERER'];?>' />
 <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_1' class="table_add" >
        <TR align=left>
                    <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>账号</div></td>
                    <td width="80%" >

					   <input name="username" id="username" type="text" size="30" value="<?php echo $rowss[username];?>"  <?php echo $disabled;?> >

					</td>
                  </tr>
     <TR align=left>
         <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>昵称</div></td>
         <td width="80%" >

             <input name="extral[nickname]" type="text" size="30" autocomplete="off" value="<?php echo $rowss[nickname];?>"   >

         </td>
     </tr>

			     <tr  align=left>
         <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>类型</div></td>
         <td width="80%" >

                 <select id=isproxy name=isproxy>
                     <option value="0" >代理</option>
                     <option value="1"  <?php if($rowss['isproxy']==1) echo "selected";?>>会员</option>
                 </select>

                 <select name='extral[virtual]'>
                     <option value="0" >真实账号</option>
                     <option value="1"  <?php if($rowss['virtual']==1) echo "selected";?>>内部账号</option>
                 </select>

             <select name='extral[istry]'>
                 <option value="0" >正式账户</option>
                 <option value="1"  <?php if($rowss['istry']==1) echo "selected";?>>试用账户</option>
             </select>
         </td>
     </tr>

     <tr  align=left>
         <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>会员组</div></td>
         <td width="80%" >

                 <select name='extral[groupid]'>
                     <?php
                     $query=$db->query("select * from user_group order by id asc");

                     while ($row=$db->fetch_array($query)){
                         ?>
                         <option value="<?php echo $row['id']?>" <?php if($row['id']==$rowss['groupid']) echo "selected";?>><?php echo $row['title'].'-'.$row['touxian'];?></option>

                         <?php
                     }

                     ?>


                 </select>



         </td>
     </tr>

     <tr  align=left>
         <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>彩金分组</div></td>
         <td width="80%" >

             <select name='user_tab'>
                 <option value="0" <?php if('0'==$rowss['user_tab']) echo "selected";?>>重名不送彩金</option>
                 <option value="1" <?php if('1'==$rowss['user_tab']) echo "selected";?>>重名可送彩金</option>
                 <option value="2" <?php if('2'==$rowss['user_tab']) echo "selected";?>>不送用户彩金</option>
             </select>
         </td>
     </tr>

				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>用户状态</div></td>
                    <td width="80%" >
                        
					     <input type="radio" name='status' value='0'  <?php if(!$rowss['status']) echo "checked";?>>正常
					     <input type="radio" name='status' value='1' <?php if($rowss['status']=='1') echo "checked";?>>锁定
					</td>
				 </tr>

				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>登录密码</div></td>
                    <td width="80%" >
					  
					     <input name="password" id="password" type="password" size="18" autocomplete="off" value="">&nbsp;&nbsp;<font color=#777777>不改密码时无需填写。</font>
					  
					</td>
				 </tr>
				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>资金密码</div></td>
                    <td width="80%" >
					 
					     <input name="bank_pass" id="bank_pass" type="password" size="18"  autocomplete="off" value="">&nbsp;&nbsp;<font color=#777777>不改密码时无需填写。</font>
				
					</td>
				 </tr>


				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>返点比例</div></td>
                    <td width="80%" >

                        <div>
                            <?php

                            $rebates=unserialize($rowss['rebates']);
                            if($rowss['higherid']){
                                $parent=   get_user_info($rowss['higherid']);
                               $parent_rebates=unserialize($parent['rebates']);
                            }

                            foreach ($arr_game_code as $key=>$value){

                                if($rowss['higherid']){
                                    $maxrebate=$parent_rebates[$key];
                                    $minrebate=$maxrebate-$con_system['rebate_cha'];

                                }
                                else{

                                   $maxrebate=$con_system['rebates_'.$key];
                                    $minrebate=$maxrebate-$con_system['rebate_cha'];
                                }
                                if($minrebate<0) $minrebate=0;

                                ?>
                                <span style="width:48%;display: inline-block;text-align: left">
                                    <?php

                                    echo $value;
                                    ?>
                                    :<input type="number" style="width: 60px" name="rebates[<?php echo $key;?>]" step="0.01" value="<?php echo $rebates[$key];?>"  min="<?php echo $minrebate ; ?>" max="<?php echo $maxrebate?>" required>%
                                    <span class="tips">范围：<?php echo $minrebate.'-'.$maxrebate;?></span>
                                </span>
                                <?php
                            }

                            ?>

                        </div>


					</td>
				 </tr>




				 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>上级代理用户名</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					     <input type=text name=pname id=pname size=20  value='<?php echo $rowss[pname];?>' style='width:200px;'>
                        <?php
                           if($pids){
                           ?>
                               <span class="tips">
(推荐关系:
             <?php
             $str='';
             for($i=count($pids)-1;$i>=0;$i--){

                 if($str=='')
                     $str=$pids[$i]['username'];
                 else  $str.="&gt;".$pids[$i]['username'];


             }

             echo $str;
             ?>
                             )

                         </span>
 <?php }?>
					   </div>
					</td>
				 </tr>
  <tr  align=left>
         <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>多地同时登陆</div></td>
         <td width="80%" >

             <input type="radio" name='extral[sharelogin]' value='0'  <?php if(!$rowss['sharelogin']) echo "checked";?>>禁止
             <input type="radio" name='extral[sharelogin]' value='1' <?php if($rowss['sharelogin']=='1') echo "checked";?>>允许
         </td>
     </tr> 

				 </table>
    <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_2' class="table_add"  style='display:none;'>


        <?php
        $field_list=$db->fetch_all("select * from field where `show`=1 order by sortnum asc");
        if(count($field_list)>0){

            foreach ($field_list as $k1=>$v1){

            ?>

                <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;><?php echo $v1['title'] ?></div></td>
                    <td width="80%" >
                        <div style=margin-left:5px;text-algin:left>
                            <input type="text" name="field[<?php echo $v1['id'] ?>]" value="<?php echo field_show($rowss['userid'],$v1['id']); ?>" style="width: 200px" disabled>
<SPAN style="color: #999;">
 <?php
 if(!field_show($rowss['userid'],$v1['id'])){
     if($v1['id']==1) echo $rowss['weixin'];
     if($v1['id']==2) echo $rowss['qq'];
     if($v1['id']==3) echo $rowss['mobilephone'];
 }
 ?>

</SPAN>

                        </div>
                    </td>
                </tr>
        <?php

            }
        }
        ?>


        <tr  align=left>
            <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>聊天室房间ID</div></td>
            <td width="80%" >
                <div style=margin-left:5px;text-algin:left>
                    <input type="text" name="extral[rid]" value="<?php echo $rowss['rid'] ?>" style="width: 200px">
                </div>
            </td>
        </tr>

        <tr  align=left>
            <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>性别</div></td>
            <td width="80%" >
                <div style=margin-left:5px;text-algin:left>
                    <input type="radio" name="sex" value="男" <?php if($rowss['sex']=='男') echo "checked";?>>男 &nbsp;

                    <input type="radio" name="sex" value="女" <?php if($rowss['sex']=='女') echo "checked";?>>女 &nbsp;
                    <input type="radio" name="sex" value="保密" <?php if($rowss['sex']=='保密') echo "checked";?>>保密
                </div>
            </td>
        </tr>
        <tr  align=left>
            <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>出生日期</div></td>
            <td width="80%" >
                <div style=margin-left:5px;text-algin:left>
                    <input type="text" name="extral[birth]" value="<?php echo $rowss['birth'] ?>" style="width: 200px">
                </div>
            </td>
        </tr>


    </table>
				  <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_3' class="table_add"  style='display:none;'>
				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>资金锁定</div></td>
                    <td width="80%" >
					    <div style=margin-left:5px;text-algin:left>
					     <input type="radio" name='bank[status]' value='0'  <?php if(!$bank['status']) echo "checked";?>>正常
					     <input type="radio" name='bank[status]' value='1' <?php if($bank['status']) echo "checked";?>>锁定

					     (锁定后，无法提现)
					   </div>

					</td>
				 </tr>
				  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>可用资金</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

					    <?php echo $bank['hig_amount']?>元
					   </div>
					</td>
				 </tr>
                      <tr  align=left>
                          <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>洗码金额</div></td>
                          <td width="80%" >
                              <div style=margin-left:5px;text-algin:left>
                                 <?php echo $bank['low_amount']?>
                                 元
                              </div>
                          </td>
                      </tr>


	  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>冻结资金</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					    <?php echo $bank['frze_amount']?>元
					   </div>
					</td>
				 </tr>

	  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>全部资金</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					    <?php echo $bank['total_amount']?>元
					   </div>
					</td>
				 </tr>

                      <tr  align=left>
                          <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>累计中奖总额</div></td>
                          <td width="80%" >
                              <div style=margin-left:5px;text-algin:left>
                                 <input type="text" name="extral[prize]" value="<?php echo $rowss['prize'] ?>" style="width: 200px">元
                              </div>
                          </td>
                      </tr>

                      <tr  align=left>
                          <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>积分</div></td>
                          <td width="80%" >
                              <div style=margin-left:5px;text-algin:left>
                                  <input type="text" name="extral[score]" value="<?php echo $rowss['score'] ?>" style="width: 200px">
                              </div>
                          </td>
                      </tr>


                </table>


				  <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left class="table_add"   id='info_con_4'  style='display:none;'>


                      <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注册时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <?php echo $rowss[registertime];?>
					   </div>
					</td>
				 </tr>
				  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>登陆次数</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					      <?php echo $rowss['loginnum'];?>次
					   </div>
					</td>
				 </tr>
				 		  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>最近登陆时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					      <?php echo $rowss['lastlogintime'];?>
					   </div>
					</td>
				 </tr>
				 		  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>最近登陆IP</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					      <?php echo $rowss['lastloginip'];?>
					   </div>
					</td>
				 </tr>
				 		  <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>备注</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <textarea rows="4" cols="60" name='mark'><?php echo $rowss['mark']?></textarea>

					   (支持HTML)

					   </div>
					</td>
				 </tr>


                </table>

<table  width="100%" border="0" cellpadding="4" cellspacing="1"  style='clear:both;' class="table_add" >
	 <tr  align=left>
				    <td colspan=2 >
				    <div style=height:30px;line-height:30px;text-align:left;margin:10px;padding-left:20%; >
				    <input type="submit" class=button value="保存" type="submit"  id=submit name="submit">
						&nbsp;&nbsp;
						  <input type="button" value='返回' class='button' onclick='parent.pop.close(); '>
			    </div>
				    </td>
				 </tr>

                </table>

</form>
