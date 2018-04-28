<?php
require_once(dirname(__FILE__).'/../lib/init.php');
require_once(dirname(__FILE__).'/../lib/common.php');


$SubjectID = $_POST['SubjectID'];




listMoldiagnosis($SubjectID);




function listMoldiagnosis($SubjectID){
	global $mysql_obj;
	
	$page=$_POST['pageNum']; //当前页
	$page=(empty($page))?'1':$page;
	$count=$_POST['pageSize'];
	$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
	$count=$count;
	$start=($page-1)*$count;
	if($SubjectID){
		$where=' where m.SubjectID = '.$SubjectID;
	}else{
		$where='';
	}

	$sql="select m.MolDiagnosisID,m.SubjectID,m.InspectionDate,m.InspectionInstitution,m.Physician,m.ReportDate,m.CreateDate,m.LatestUpdateDate,
CONCAT(s.LastName,s.FirstName,s.MiddleName) as Fullname,
s.Gender,
YEAR(CURDATE())-YEAR(s.DateOfBirth)-(RIGHT(CURDATE(),5)<RIGHT(s.DateOfBirth,5)) as Age,
p.ProductID,
p.ProductName_cn,
m.MolDiagnosisID,
m.Status,
CONCAT(e.LastName,e.FirstName,e.MiddleName) as ReporterName,
CONCAT(ee.LastName,ee.FirstName,ee.MiddleName) as ReviewerName
from MolDiagnosis as m 
join SubjectInfo as s
on s.SubjectID = m.SubjectID
join Product as p
on p.ProductID = m.ProductID
join Employee as e
on e.EmployeeID = m.ReporterID
join Employee as ee
on ee.EmployeeID = m.ReviewerID ".$where." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(m.MolDiagnosisID) as total
from MolDiagnosis as m 
join SubjectInfo as s
on s.SubjectID = m.SubjectID
join Product as p
on p.ProductID = m.ProductID 
join Employee as e
on e.EmployeeID = m.ReporterID
join Employee as ee
on ee.EmployeeID = m.ReviewerID ".$where." limit ".$start.",". $count;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['data']=$results;
	$arr['num']=$total['0']['total'];
	echo json_encode($arr);
}
?>