<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');
$pageNum=$_POST['pageNum']; //当前页
$pageNum=(empty($pageNum))?'1':$pageNum;
$pageSize=$_POST['pageSize'];
$pageSize=(empty($pageSize))?'10':$pageSize;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
$begin_position = ($pageNum-1)*$pageSize;
$sql_limit .= " limit {$begin_position},{$pageSize}"; 

//$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];
$PanelUpdateRecordID = 10;
if(($PanelUpdateRecordID ==="") ||($PanelUpdateRecordID === null)){
	echo json_encode(array('code'=>5,'info'=>"传参为空"));
}

$joinsql = "SELECT a.PanelMemberID,a.PanelUpdateRecordID,a.EmployeeID,a.Role,a.CreateDate,a.LatestUpdateDate,CONCAT(b.LastName,b.FirstName,b.MiddleName) as Name,b.Email FROM 
PanelMembers a LEFT JOIN Employee b 
ON a.EmployeeID=b.EmployeeID 
WHERE a.PanelUpdateRecordID='{$PanelUpdateRecordID}' {$sql_limit}";
$joinsql_num = "SELECT count(a.EmployeeID) as nums FROM 
PanelMembers a LEFT JOIN Employee b 
ON a.EmployeeID=b.EmployeeID 
WHERE a.PanelUpdateRecordID='{$PanelUpdateRecordID}'";

$result_all = $mysql_obj->querySql($joinsql);
$nums =  $mysql_obj->querySql($joinsql_num);
echo json_encode(array('data'=>$result_all,'num'=>$nums[0][nums]));
?>

