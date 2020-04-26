<?php
		    $linetime=date('Y-m-d H:i:s',time()-$con_system['OnLines']*60);
		$online=$db->fetch_first("select * from user_online where userid='{$_SESSION['userid']}' and uptime>'{$linetime}'");
		if(!$online){
	
			$mod="login";
			$_SESSION['userid']='';
			$db->query("delete  from user_online where userid='{$_SESSION['userid']}'");
			echo "timeout|您已经超过{$con_system['OnLines']}没有活动了，系统自动退出";
			exit();
		}
         
		
		$online=$db->fetch_first("select * from user_online where userid='{$_SESSION['userid']}'");
		if(!$online){
				$mod="login";
			$_SESSION['userid']='';
	
			echo "getout|您被管理员强制踢下线";
			exit();
		}
		else{
			
			echo 'yes';
			exit();
		}
?>