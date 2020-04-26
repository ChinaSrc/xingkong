<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22
 * Time: 13:00
 */


if($_FILES['csv']) {
$file=$_FILES['csv'];
    if ($file and $file["size"] > 0) {

        $str = explode('.', $file["name"]);

        $filename = time() . rand(1000, 9999) . "." . $str[count($str) - 1];

        $tmp_name = $file["tmp_name"];


        if (move_uploaded_file($tmp_name, 'user/'.$filename)) {



       $file= 'user/'.$filename;

       include_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

            $objReader = PHPExcel_IOFactory::createReaderForFile($file);; //准备打开文件
            $objPHPExcel = $objReader->load($file);   //载入文件

                $sheet=$objPHPExcel->getActiveSheet();

            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumm = $sheet->getHighestColumn(); // 取得总列数

            /** 循环读取每个单元格的数据 */
            $dataset=array();
            echo "<table border=1>";
//for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
//for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始


                for ($row =2; $row <= $highestRow; $row++) {//列数是以A列开始

                //    echo "<tr>";
                    for ($column = 'A'; $column <= $highestColumm; $column++) {//行数是以第1行开始
                        $data[$row][] = $sheet->getCell($column.$row)->getValue();

                       // echo "<td>" . $sheet->getCell($column . $row)->getValue() . "</td>";
                    }
                 //   echo "</tr>";
                }


            echo "</table>";




unlink($file);

if(count($data)>0){
    $num=0;
    foreach ($data as $value){

        $arr=array();
        $bank=array();
        $arr['username']=$value[0];
        $arr['nickname']=$value[1];
        if($value[2]=='') $arr['higherid']=0;else {
            $parent=$db->exec("select * from user where username='{$value[2]}'");
            if($parent['userid']) $arr['higherid']=$parent['userid'];
            else $arr['higherid']=0;
        }
        $arr['isproxy']=$value[3];
        $arr['virtual']=$value[4];
        $rebates=array();
        foreach ($arr_game_code as $k1=>$v1){

            if($k1=='k3') $tt=$value[5];
            else $tt=5;
            $rebates[$k1]=$tt;
        }
        $arr['rebates']=serialize($rebates);
        $arr['password']=$value[6];
        $bank['password']=$value[7];
        $bank['hig_amount']=$value[8];
        $bank['low_amount']=$value[9];
        $arr['score']=$value[10];
        $arr['rid']=$value[11];
        $sex='';
        if($arr[12]==1) $sex='男';
        if($arr[12]==2) $sex='女';
        $arr['sex']=$sex;
//        $arr['mobilephone']=$value[13];
//        $arr['qq']=$value[14];
//        $arr['weixin']=$value[15];
        $arr['birth']=$value[16];
        $arr['status']=$value[17];
        $arr['registertime']=date('Y-m-d H:i:s',$value[18]);;
        $group=$db->exec("select * from user_group where score<='{$arr['score']}' and sys='0' order by score desc limit 0,1");
        $arr['groupid']=  $arr['groupid1']=$group['id'];
        $db->query("delete from `user` where username='{$arr['username']}' and admin='0' ");
        $id='';


            $db->query ( "insert into `user`(`username`) values('{$arr['username']}')" );
            $id=$db->insert_id();


        if($id>0){
$num++;
            foreach ($arr as $k1=>$v1){

                $db->query("update user set `{$k1}`='{$v1}' where userid='{$id}'");
            }
            $db->query ( "delete from `user_bank` where userid='{$userid}'" );
            $db->query ( "insert into `user_bank`(`userid`,`password`) values('{$id}','{$bank['password']}')" );
            foreach ($bank as $k1=>$v1){

                $db->query("update user_bank set `{$k1}`='{$v1}' where userid='{$id}'");
            }
            field_add($id,1,$value[15]);
            field_add($id,2,$value[14]);
            field_add($id,3,$value[13]);
        }





    }

add_adminlog("共导入了{$num}条数据");
    show_message("共导入了{$num}条数据",$_SERVER['HTTP_REFERER']);
echo "共导入了{$num}条数据";
}
        }
    }


}

?>