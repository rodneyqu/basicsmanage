<?php
require_once(dirname(__FILE__).'../../lib/init.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$PanelID=$_POST['PanelID'];
if(!isset($PanelID) || ($PanelID === "")){
  $where = "";
}else{
  $where = "PanelID like '%{$PanelID}%' ORDER BY LENGTH(replace(PanelID,'{$PanelID}',''))";
}
//var_dump($where);
$result_all = $mysql_obj->getpageq("PanelUpdateRecord",$where,1,20,array('Version','PanelUpdateRecordID'));
echo json_encode($result_all['data']);
?>
