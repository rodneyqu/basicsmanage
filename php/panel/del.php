<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$PanelID = $_POST['PanelID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $PanelID;
$result_all = $mysql_obj->deleteq('Panel',$where,"PanelID");
echo json_encode($result_all);
?>