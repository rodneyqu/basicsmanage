<?php
require_once(dirname(__FILE__).'/../../../lib/init.php');


$PipelineUpdateRecordID = $_POST['PipelineUpdateRecordID'];
editPipelineMembers($PipelineUpdateRecordID);


function editPipelineMembers($PipelineUpdateRecordID){

	global $mysql_obj;

	$pageNum=$_POST['pageNum']; //当前页
	$pageNum=(empty($pageNum))?'1':$pageNum;
	$pageSize=$_POST['pageSize'];
	$pageSize=(empty($pageSize))?'10':$pageSize;
	$start=($pageNum-1)*$pageSize;
	$sql = "SELECT a.PipelineMemberID,a.Role,a.CreateDate,a.LatestUpdateDate,concat(b.LastName,b.FirstName,b.MiddleName) as Fullname,b.Email FROM PipelineMembers a JOIN Employee b ON a.EmployeeID=b.EmployeeID where  a.PipelineUpdateRecordID = ".$PipelineUpdateRecordID." limit ".$start." , ".$pageSize;
	
	$results = $mysql_obj->querySql($sql);
	$whereSql=" where a.PipelineUpdateRecordID = ".$PipelineUpdateRecordID;

	$sqlTotal="select count(b.LastName) as total FROM PipelineMembers a JOIN Employee b ON a.EmployeeID=b.EmployeeID 
".$whereSql." 
order by a.LatestUpdateDate desc;";
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['data']=$results;
	$arr['num']=$total['0']['total'];


	echo json_encode($arr);


}
?>
