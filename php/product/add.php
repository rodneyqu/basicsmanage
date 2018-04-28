<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];
$ProductName_en=$_POST['ProductName_en'];
$ProductName_cn=$_POST['ProductName_cn'];



$data['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$data['ProductName_enNOSAME'] = $ProductName_en;
$data['ProductName_cnNOSAME'] = $ProductName_cn;


$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

$result_all = $mysql_obj->insertq("Product",$data);

echo json_encode($result_all);
?>
