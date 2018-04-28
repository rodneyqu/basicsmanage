<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];
$PanelID =$_POST['PanelID'];

$where['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$where['PanelID'] = $PanelID;

$sqlwhere = null;

$result_all = $mysql_obj->getpageq("PanelUpdateRecord",$where,$pageNum,$pageSize,null,$sqlwhere);

echo json_encode($result_all);

?>
