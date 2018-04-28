<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$PanelID = $_POST['PanelID'];
/* $where_panel['PanelID']= $PanelID;
$find_panel = $mysql_obj->selectq("Panel",array("PanelID"),$where_panel);
if(!$find_panel){
		echo json_encode(array("没有该Panel!",1));
		die;
} */
$PanelMethod=$_POST['PanelMethod'];
$Version=$_POST['Version'];
$PanelStatus=$_POST['PanelStatus'];
$PanelLanchDate=$_POST['PanelLanchDate'];
$PanelCompleteDate=$_POST['PanelCompleteDate'];
$PanelDescription=$_POST['PanelDescription'];

$where_nosame['PanelID'] = $PanelID;
$where_nosame['Version'] = $Version;
$find_same = $mysql_obj->getpageq("PanelUpdateRecord",$where_nosame);
if($find_same['num'] > 0){
	echo json_encode(array('code'=>2,'info'=>'条目重复'));
	die;
}
$data['PanelID'] = $PanelID;
$data['PanelMethod'] = $PanelMethod;
$data['Version'] = $Version;
$data['PanelStatus'] = $PanelStatus;
$data['PanelLanchDate'] = $PanelLanchDate;
$data['PanelCompleteDate'] = $PanelCompleteDate;
$data['PanelDescription'] = $PanelDescription;

$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

$result_all = $mysql_obj->insertq("PanelUpdateRecord",$data);

echo json_encode($result_all);
?>