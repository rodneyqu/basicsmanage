<?php
require_once(dirname(__FILE__).'/../lib/init.php');
require_once(dirname(__FILE__).'/../lib/common.php');


$NucleicAcidID = $_POST['NucleicAcidID'];
$LibID =$_POST['LibID'];
$searchArr['NucleicAcidID']=$NucleicAcidID;
$searchArr['LibID']=$LibID;

listLib($searchArr);




function listLib($searchArr){
	global $mysql_obj;
	
	$page=$_POST['pageNum']; //当前页
	$page=(empty($page))?'1':$page;
	$count=$_POST['pageSize'];
	$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
	$count=$count;
	$start=($page-1)*$count;
	foreach($searchArr as $key=>$value){
		if($searchArr['NucleicAcidID']){
			$where=' where l.NucleicAcidID = '.$searchArr['NucleicAcidID'];
		}elseif($searchArr['LibID']){
			$where=' where l.LibID = '.$searchArr['LibID'];
		}else{
			$where='';
		}
	}
	

	$sql="select l.LibID,l.NucleicAcidID,l.LibSGIID, l.LibConsDate, l.LibConsManipulatorID,
l.LibConsAmount,l.LibConsUnit,l.LibQuality,l.LibVolume,l.LibVolumeUnit,l.LibConc,
l.LibConcUnit,l.LibAmount,l.LibAmountUnit,l.LibInsSize,l.LibInsSizeUnit,
l.`Status`,l.CreateDate,l.LatestUpdateDate,
CONCAT(e.LastName,e.FirstName,e.MiddleName) as LibConsManipulator
from Lib as l
join Employee as e
on l.LibConsManipulatorID = e.EmployeeID ".$where." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(l.LibID) as total
from Lib as l
join Employee as e
on l.LibConsManipulatorID = e.EmployeeID ".$where." limit ".$start.",". $count;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['data']=$results;
	$arr['num']=$total['0']['total'];
	echo json_encode($arr);
}
?>