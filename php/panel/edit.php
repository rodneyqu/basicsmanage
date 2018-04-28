<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$PanelID = $_POST['PanelID'];

$ProjectID = $_POST['ProjectID'];
$PanelName_cn=$_POST['PanelName_cn'];
$PanelName_en=$_POST['PanelName_en'];

$where['PanelID'] = $PanelID;

$data['ProjectID'] = $ProjectID;
$data['PanelName_cnNOSAME'] = $PanelName_cn;
$data['PanelName_enNOSAME'] = $PanelName_en;

$data['LatestUpdateDate'] = date("Y-m-d");

$result_all = $mysql_obj->updateq("Panel",$data,$where);

echo json_encode($result_all);
?>
