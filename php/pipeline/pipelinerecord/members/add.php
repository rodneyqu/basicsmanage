<?php
require_once(dirname(__FILE__).'/../../../lib/init.php');

$PipelineUpdateRecordID = $_POST['PipelineUpdateRecordID'];
$EmployeeID=$_POST['EmployeeID'];
$Role=$_POST['Role'];


$Role='test';
if(empty($EmployeeID) || empty($PipelineUpdateRecordID) || empty($Role)){
	return false;
}else{
	pipelineMembers($EmployeeID,$PipelineUpdateRecordID,$Role);
}

function pipelineMembers($EmployeeID,$PipelineUpdateRecordID,$Role){
	global $mysql_obj;
	$data['PipelineUpdateRecordID'] = $PipelineUpdateRecordID;
	$data['EmployeeID'] = $EmployeeID;
	$data['Role'] = $Role;

	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("PipelineMembers",$data);

	echo json_encode($result_all);

}
?>