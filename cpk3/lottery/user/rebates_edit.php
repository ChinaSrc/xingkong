<form method="POST" action="?action=save_post&flag=yes&active=save_rebates&id=<?php echo $_GET['id']?>"  name="form" id="form">
<table width="100%" border="0" cellpadding="4" cellspacing="1" align="left" id="info_con_1" class="table_add">

        <tbody><tr align="left">
            <td><div style="text-align:right;margin-right:5px;">用户名：</div></td>
            <td id="username"></td>
        </tr>
        <tr align="left">
                    <td width="20%" height="25"> <div style="height:20px;line-height:20px;text-align:right;margin-right:5px;">返点比例</div></td>
                    <td width="80%">

                        <div>
                                                            <span style="width:48%;display: inline-block;text-align: left">
                                    快三                                    :<input type="number" style="width: 60px" id="rebates" name="rebates[k3]" step="0.01" value="" required="">%
                                    <span class="tips" id="tips"></span>
                                </span>
                                
                        </div>


					</td>
				 </tr>
          <tr align="left">
                    <td width="20%" height="25"> <div style="height:20px;line-height:20px;text-align:right;margin-right:5px;">上级代理</div></td>
                    <td width="80%">
                      <input  style="width: 100px" disabled id="sjdl"  value="">
                      <span class="tips" id="bzdjsm"></span>
					</td>
				 </tr>


    </tbody></table>
    <table width="100%" border="0" cellpadding="4" cellspacing="1" style='clear:both;' class="table_add">
    <tr align=left>
      <td colspan=2>
        <div style=height:30px;line-height:30px;text-align:left;margin:10px;padding-left:20%;>
          <input type="submit" class=button value="保存" type="submit" id=submit name="submit">
          &nbsp;&nbsp;
          <input type="button" value='关闭' class='button' onclick='parent.pop.close(); '>
        </div>
      </td>
    </tr>

  </table>
  </form>
  <script src="style/mar-admin/js/jquery.min.js"></script>
  <script>
  $(function() {
    $.get('api.php?ac=get_rebates&id=<?php echo $_GET['id']?>&ac_type=get_rebates', function(response) {
      $('#username').html(response.username);
      $('#tips').html('范围' + response.min + '-' + response.max);
      $('#rebates').val(response.rebates.k3).attr({'min': response.min, 'max': response.max});
      $('#sjdl').val(response.sjdl);
      $('#bzdjsm').html('(推荐关系:' + response.bzdjsm+')');
    }, 'JSON');
  })
  </script>
