<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 11:42
 */



$user=get_user_info($_GET['id']);
$username= substr($user['username'],0,2).'*****'.substr($user['username'],strlen($user['username'])-1,1);
$group=$db->exec("select * from user_group where id='{$user['groupid']}'");
$str.=' <ul  class="cardIconList">';

                            $playlist=unserialize($user['playlist']);
                            $gamelist=$db->fetch_all("select * from game_type where status='0' order by icon1 desc ,`sort` asc limit 0,8");
                            foreach ($gamelist as $value1){

                               $str.=' <a href="game_'.$value1['id'].'.html" title="'.$value1['fullname'].'">
                                    <img src="'.$value1['ico'].'"';

                                if (!$playlist || !in_array($value1['ckey'],$playlist)) $str.='class="hui" ';
                                  $str.=' > </a>';

                            }

                       $str.=' </ul>';

$tpl->assign('user',$user);
$tpl->assign('group',$group);
$tpl->assign('username',$username);
$tpl->assign('game_str',$str);
$tpl->assign('navtitle','玩家信息');
