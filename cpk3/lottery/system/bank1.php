<?

$playkey=$_GET['playkey'];
if($playkey==""){$playkey="3D";}


$curpath = dirname($_SERVER["REQUEST_URI"]);//路径 (../
$curpath=str_replace("/","",$headpath);

?>
<?$body_top_title="平台银行帐户管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?>


    <table> <tr align="left" height=40>
            <td colspan="15" bgcolor="#FFFFFF">
                &nbsp;<input type="button" class='button' onclick="winPop({title:'添加提现银行',width:'400',drag:'true',height:'300',url:'<?echo ROOT_URL."/".$AdminPath;?>/?controller=system&action=bank1_add&active=new'})" value='添加提现银行'>

            </td>
        </tr>
        <tr align="center" bgcolor="#FFFFFF">
            <th >显示顺序</th>
            <th bgcolor="#FFFFFF">银行名称</th>
            <th  bgcolor="#FFFFFF">Logo</th>


            <th  bgcolor="#FFFFFF">状态</th>
            <th bgcolor="#FFFFFF">操作</th>
        </tr>
        <form name="myform" id="myform" method="post" action="../<?echo $headpath;?>/save_post.aspx?active=lotTime" >
            <input name="flag" type="hidden" value="save" />
            <input name="playkey" type="hidden" value="<?echo $playkey;?>" />
            <?
            $sql_id="select * from system_bank_list order  by sortnum asc";
            $result3=mysql_query($sql_id);
            while($rows3=mysql_fetch_array($result3)){
                if($rows3['logo']) $logo="<img src='../{$rows3['logo']}' height='20px'>";
                else $logo='未上传';
                echo "<tr id='del14' align='center' bgcolor='#FFFFFF'>";
                echo "<td>".$rows3[sortnum]."</td>";
                echo "<td>".$rows3[name]."</td>";
                echo "<td>".$logo."</td>";


                if($rows3['status']==1)$status="启用";else $status="关闭";
                echo "<td>".$status."</td>";
                echo "<td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'',width:'500',drag:'true',height:'300',url:'".ROOT_URL."/".$AdminPath."/?controller=system&action=bank1_add&id=".$rows3[id]."'})\">修改</a>&nbsp;&nbsp;<a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=system_bank_list&id=".$rows3[id]."'})\">删除</a></div></td>";
                echo "</tr>";
            }
            ?>
        </form>

    </table>
    <br>
<? include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");?>