<?php
require_once(dirname(__FILE__).'../../../lib/init.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];

$PanelMethod=$_POST['PanelMethod'];
$Version=$_POST['Version'];
$PanelStatus=$_POST['PanelStatus'];
$PanelLanchDate=$_POST['PanelLanchDate'];
$PanelCompleteDate=$_POST['PanelCompleteDate'];
$PanelDescription=$_POST['PanelDescription'];

$where_PanelID['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$find_Panel = $mysql_obj->getpageq("PanelUpdateRecord",$where_PanelID);
$find_PanelID = $find_Panel['data'][0]['PanelID'];
$where_nosame['PanelID'] = $find_PanelID;
$where_nosame['Version'] = $Version;
	
	$find_exits2 = $mysql_obj->getpageq("PanelUpdateRecord",$where_nosame);
//	print_r($find_exits2);
	if($find_exits2['num'] > 1){
		echo json_encode($mysql_obj->return_array(2));
		die;
	}elseif($find_exits2['num'] == 1){
		if($find_exits2['data']['0']['PanelUpdateRecordID'] != $PanelUpdateRecordID){
			echo json_encode($mysql_obj->return_array(2));
			die;
		}
	}

$where['PanelUpdateRecordID'] = $PanelUpdateRecordID;

$data['PanelMethod'] = $PanelMethod;
$data['Version'] = $Version;
$data['PanelStatus'] = $PanelStatus;
$data['PanelLanchDate'] = $PanelLanchDate;
$data['PanelCompleteDate'] = $PanelCompleteDate;
$data['PanelDescription'] = $PanelDescription;

$data['LatestUpdateDate'] = date("Y-m-d");

$result_all = $mysql_obj->updateq("PanelUpdateRecord",$data,$where);

echo json_encode($result_all);
?>
