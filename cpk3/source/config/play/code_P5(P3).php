<?
$con_play_arr=array('code'=>array('P3_ZHX','P3_ZX','P3_BDW','P5_2M','P5_DXDS','P5_DWD'),'firstcode'=>'P3_ZHX','lot_date'=>'','lot_num'=>'');
$con_title_arr=array(
  'P3_ZHX'=>array('fullname'=>'P3直选','mode'=>'default'),
  'P3_ZX'=>array('fullname'=>'P3组选','mode'=>'default'),
  'P3_BDW'=>array('fullname'=>'P3不定位','mode'=>'fix'),
  'P5_2M'=>array('fullname'=>'P5二码','mode'=>'default'),
  'P5_DXDS'=>array('fullname'=>'P5大小单双','mode'=>'fix'),
  'P5_DWD'=>array('fullname'=>'P5定位胆','mode'=>'default')
);

$con_code_arr=array(
  'P3_BDW'=>array(
      'BDW_qsym'=>array('ListKey'=>'BDW_qsym','CodeTile'=>'P3 [一码不定位]','ShowTile'=>'前三一码不定位','Rebates'=>'Second','MaxNote'=>''),
      'BDW_qsem'=>array('ListKey'=>'BDW_qsem','CodeTile'=>'P3 [二码不定位]','ShowTile'=>'前三二码不定位','Rebates'=>'Second','MaxNote'=>'')
  ),
  'P3_ZHX'=>array(
      '3X1_fs'=>array('ListKey'=>'3X1_fs','CodeTile'=>'P3直选','ShowTile'=>'P3 [直选]','Rebates'=>'Normal','MaxNote'=>''),
      '3X1_ds'=>array('ListKey'=>'3X1_ds','CodeTile'=>'P3直选','ShowTile'=>'P3 [单式]','Rebates'=>'Normal','MaxNote'=>''),
      '3X1_zhxhz'=>array('ListKey'=>'3X1_zhxhz','CodeTile'=>'P3直选','ShowTile'=>'P3 [直选和值]','Rebates'=>'Normal','MaxNote'=>'')
  ),
  'P3_ZX'=>array(
      '3X1_z3'=>array('ListKey'=>'3X1_z3','CodeTile'=>'P3组选','ShowTile'=>'P3 [组三]','Rebates'=>'Normal','MaxNote'=>''),
      '3X1_z6'=>array('ListKey'=>'3X1_z6','CodeTile'=>'P3组选','ShowTile'=>'P3 [组六]','Rebates'=>'Normal','MaxNote'=>''),
      '3X1_hhzx'=>array('ListKey'=>'3X1_hhzx','CodeTile'=>'P3组选','ShowTile'=>'P3 [混合组选]','Rebates'=>'Normal','MaxNote'=>''),
      '3X1_zxhz'=>array('ListKey'=>'3X1_zxhz','CodeTile'=>'P3组选','ShowTile'=>'P3 [组选和值]','Rebates'=>'Normal','MaxNote'=>'')
  ),
  'P5_2M'=>array(
      '2X_1_zhxfs'=>array('ListKey'=>'2X_1_zhxfs','CodeTile'=>'P5二码','ShowTile'=>'P3 [前二直选]','Rebates'=>'Normal','MaxNote'=>''),
      '2X_1_2xzxfs'=>array('ListKey'=>'2X_1_2xzxfs','CodeTile'=>'P5二码','ShowTile'=>'P3 [前二组选]','Rebates'=>'Normal','MaxNote'=>''),
      '2X_2_zhxfs'=>array('ListKey'=>'2X_2_zhxfs','CodeTile'=>'P5二码','ShowTile'=>'P5 [后二直选]','Rebates'=>'Normal','MaxNote'=>''),
      '2X_2_2xzxfs'=>array('ListKey'=>'2X_2_2xzxfs','CodeTile'=>'P5二码','ShowTile'=>'P5 [后二组选]','Rebates'=>'Normal','MaxNote'=>'')
  ),
  'P5_DWD'=>array(
      '1X_dwd'=>array('ListKey'=>'1X_dwd','CodeTile'=>'定位胆','ShowTile'=>'定位胆','Rebates'=>'Normal','MaxNote'=>'')
  ),
  'P5_DXDS'=>array(
      'DXDS_qedx'=>array('ListKey'=>'DXDS_qedx','CodeTile'=>'P5大小单双','ShowTile'=>'P3 前二 [大小单双]','Rebates'=>'Normal','MaxNote'=>''),
      'DXDS_hedx'=>array('ListKey'=>'DXDS_hedx','CodeTile'=>'P5大小单双','ShowTile'=>'P5 后二 [大小单双]','Rebates'=>'Normal','MaxNote'=>'')
  )
);
$con_play_pri=array(
  'DXDS_qedx'=>array('','','','7.72'),
  'DXDS_hedx'=>array('','','','7.72'),
  '2X_2_2xzxfs'=>array('','','','96.5'),
  '2X_1_2xzxfs'=>array('','','','96.5'),
  '2X_2_zhxfs'=>array('','','','193'),
  '3X1_zxhz'=>array('','','','965'),
  '2X_1_zhxfs'=>array('','','','193'),
  '3X1_hhzx'=>array('','','','965'),
  '3X1_z6'=>array('','','','965'),
  '3X1_z3'=>array('','','','965'),
  '3X1_ds'=>array('','','','1930'),
  '3X1_zhxhz'=>array('','','','1930'),
  '3X1_fs'=>array('','','','1930'),
  'BDW_qsym'=>array('','','','7.118'),
  'BDW_qsem'=>array('','','','35.717'),
  '1X_dwd'=>array('','','','19.3')
);

$con_play_time=array(
  'DXDS_qedx'=>array('','',''),
  'DXDS_hedx'=>array('','',''),
  '2X_2_2xzxfs'=>array('','',''),
  '2X_1_2xzxfs'=>array('','',''),
  '2X_2_zhxfs'=>array('','',''),
  '3X1_zxhz'=>array('','',''),
  '2X_1_zhxfs'=>array('','',''),
  '3X1_hhzx'=>array('','',''),
  '3X1_z6'=>array('','',''),
  '3X1_z3'=>array('','',''),
  '3X1_ds'=>array('','',''),
  '3X1_zhxhz'=>array('','',''),
  '3X1_fs'=>array('','',''),
  'BDW_qsym'=>array('','',''),
  'BDW_qsem'=>array('','',''),
  '1X_dwd'=>array('','','')
);

?>