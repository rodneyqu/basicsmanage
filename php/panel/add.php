<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$ProjectID = $_POST['ProjectID'];
$PanelName_cn=$_POST['PanelName_cn'];
$PanelName_en=$_POST['PanelName_en'];



$data['ProjectID'] = $ProjectID;
$data['PanelName_cnNOSAME'] = $PanelName_cn;
$data['PanelName_enNOSAME'] = $PanelName_en;


$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

$result_all = $mysql_obj->insertq("Panel",$data);

echo json_encode($result_all);
?>