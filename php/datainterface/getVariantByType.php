<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$VariantType=addslashes($_POST['VariantType']);
if(!isset($VariantType) || ($VariantType === "")){
  $where = "";
}else{
  $where = "VariantType like '%{$VariantType}%' ORDER BY LENGTH(replace(VariantType,'{$VariantType}',''))";
}
$result_all = $mysql_obj->getpageq("VariantType",$where,1,20,array('VariantTypeID','VariantType'));
echo json_encode($result_all['data']);
?>
