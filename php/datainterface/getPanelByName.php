<?php
require_once(dirname(__FILE__).'../../lib/init.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$PanelName_cn=$_POST['PanelName_cn'];
if(!isset($PanelName_cn) || ($PanelName_cn === "")){
  $where = "";
}else{
  $where = "PanelName_cn like '%{$PanelName_cn}%' ORDER BY LENGTH(replace(PanelName_cn,'{$PanelName_cn}',''))";
}
//var_dump($where);
$result_all = $mysql_obj->getpageq("Panel",$where,1,20,array('PanelID','PanelName_cn'));
echo json_encode($result_all['data']);
?>
