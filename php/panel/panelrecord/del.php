<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $PanelUpdateRecordID;
$result_all = $mysql_obj->deleteq('PanelUpdateRecord',$where,"PanelUpdateRecordID");
echo json_encode($result_all);
?>