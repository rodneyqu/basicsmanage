<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');

$PanelMemberID = $_POST['PanelMemberID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $PanelMemberID;

$result_all = $mysql_obj->deleteq('PanelMembers',$where,"PanelMemberID");

echo json_encode($result_all);
?>