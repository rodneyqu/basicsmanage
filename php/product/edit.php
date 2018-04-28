<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$ProductID = $_POST['ProductID'];

$ProductName_cn=$_POST['ProductName_cn'];
$ProductName_en=$_POST['ProductName_en'];
$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];

$where['ProductID'] = $ProductID;

$data['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$data['ProductName_cnNOSAME'] = $ProductName_cn;
$data['ProductName_enNOSAME'] = $ProductName_en;

$data['LatestUpdateDate'] = date("Y-m-d");

$result_all = $mysql_obj->updateq("Product",$data,$where);

echo json_encode($result_all);
?>
