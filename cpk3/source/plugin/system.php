<?php
echo '<div style=\'display:none\'>
<input value=\'';echo $SystemInfor[MinGetCash_amount];;echo '\' id=\'MinGetCash_amount\' name=\'MinGetCash_amount\' style=\'display:none\' alt="最低提现额"> 
<input value=\'';echo $SystemInfor[MaxGetCash_num];;echo '\' id=\'MaxGetCash_num\' name=\'MaxGetCash_num\' style=\'display:none\' alt="每天最多提现次数"> 
<input value=\'';echo $SystemInfor[modes_PutCash];;echo '\' id=\'modes_PutCash\' name=\'modes_PutCash\' style=\'display:none\' alt="充值模式"> 
<input value=\'';echo $SystemInfor[modes_gifts];;echo '\' id=\'modes_gifts\' name=\'modes_gifts\' style=\'display:none\' alt="领取购彩金"> 
<input value=\'';echo $SystemInfor[modes_gifts_money];;echo '\' id=\'modes_gifts_money\' name=\'modes_gifts_money\' style=\'display:none\' alt="单次领取购彩金额"> 
<input value=\'';echo $SystemInfor[MinPutCash_amount];;echo '\' id=\'MinPutCash_amount\' name=\'MinPutCash_amount\' style=\'display:none\' alt="在线最低充值额"> 
<input value=\'';echo $SystemInfor[MinPutCash_ren];;echo '\' id=\'MinPutCash_ren\' name=\'MinPutCash_ren\' style=\'display:none1\' alt="人工最低充值额"> 
<input value=\'';echo $SystemInfor[GetFee_Single];;echo '\' id=\'GetFee_Single\' name=\'GetFee_Single\' style=\'display:none\' alt="扣撤单手续费"> 
<input value=\'';echo $SystemInfor[GetFee_Single_Rate];;echo '\' id=\'GetFee_Single_Rate\' name=\'GetFee_Single_Rate\' style=\'display:none\' alt="撤单手续费率"> 
<input value=\'';echo $SystemInfor[Modes_Rebate];;echo '\' id=\'Modes_Rebate\' name=\'Modes_Rebate\' style=\'display:none\' alt="模式少？返点"> 
<input value=\'';echo $SystemInfor[mention];;echo '\' id=\'mention\' name=\'mention\' style=\'display:none\' alt="提现模式"> 
<input value=\'';echo $SystemInfor[MaxBonus];;echo '\' id=\'MaxBonus\' name=\'MaxBonus\' style=\'display:none\' alt="代理用户最高返点率"> 
<input value=\'';echo $SystemInfor[MinBonus];;echo '\' id=\'MinBonus\' name=\'MinBonus\' style=\'display:none\' alt="下级至少比自已少？返点"> 
<input value=\'';echo $SystemInfor[Auto_JieS_Begin];;echo '\' id=\'Auto_JieS_Begin\' name=\'Auto_JieS_Begin\' style=\'display:none\' alt="提款结算时间"> 
<input value=\'';echo $SystemInfor[Auto_JieS_End];;echo '\' id=\'Auto_JieS_End\' name=\'Auto_JieS_End\' style=\'display:none\' alt="提款结算时间"> 
<input value=\'';echo $SystemInfor[Del_Member_date];;echo '\' id=\'Del_Member_date\' name=\'Del_Member_date\' style=\'display:none\' alt="自动删除?天未上线的会员"> 
<input value=\'';echo $SystemInfor[Modes];;echo '\' id=\'Modes\' name=\'Modes\' style=\'display:none\' alt="奖金模式"> 
<input value=\'';echo $SystemInfor[ReModes];;echo '\' id=\'ReModes\' name=\'ReModes\' style=\'display:none\' alt="是否自由调节奖金模式"> 
<input value=\'';echo $SystemInfor[MaxBank];;echo '\' id=\'MaxBank\' name=\'MaxBank\' style=\'display:none\' alt="一个游戏账户最多绑定？张银行卡"> 
<input value=\'';echo $SystemInfor[IsAngle];;echo '\' id=\'IsAngle\' name=\'IsAngle\' style=\'display:none\' alt="是否开通“角”模式"> 
<input value=\'';echo $SystemInfor[IsPoint];;echo '\' id=\'IsPoint\' name=\'IsPoint\' style=\'display:none\' alt="是否开通“分”模式"> 
<input value=\'';echo $SystemInfor[IsChase];;echo '\' id=\'IsChase\' name=\'IsChase\' style=\'display:none\' alt="是否可以追号"> 
<input value=\'';echo $SystemInfor[Recommend];;echo '\' id=\'Recommend\' name=\'id\' style=\'display:none\' alt="是否启用推荐注册"> 
<input value=\'';echo $SystemInfor[ServiceUrl];;echo '\' id=\'ServiceUrl\' name=\'ServiceUrl\' style=\'display:none\' alt="客服地址">
<input value=\'';echo ROOT_URL;;echo '\' id=\'RootUrl\' name=\'RootUrl\' style=\'display:none\' alt="根地址">  
<input value=\'';echo ROOT_PATH;;echo '\' id=\'RootPath\' name=\'RootPath\' style=\'display:none\' alt="根目录">  
<input value=\'\' id=\'resetiframe\' name=\'resetiframe\' onclick="reinitIframe_height(\'0\')">  
</div>'
?>