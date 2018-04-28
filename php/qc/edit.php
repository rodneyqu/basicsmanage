<?php
require_once(dirname(__FILE__).'/../lib/init.php');
require_once(dirname(__FILE__).'/../lib/common.php');


$LibID = $_POST['LibID'];




listQc($LibID);




function listQc($LibID){
	global $mysql_obj;
	
	$page=$_POST['pageNum']; //当前页
	$page=(empty($page))?'1':$page;
	$count=$_POST['pageSize'];
	$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
	$count=$count;
	$start=($page-1)*$count;
	if($LibID){
		$where=' where q.LibID = '.$LibID;
	}else{
		$where='';
	}

	$sql="select  q.QCID,q.LibID,q.TotalBases,q.TotalReadNumber,q.DuplicationRate,q.MappingRate,
q.ReadLength,q.CaptureEfficacy,q.ProbeMeanDepth,q.ProbeMedianDepth,q.ProbeUniformity,
q.DepthGT1Rate,q.DepthGT30Rate,q.CreateDate,q.LatestUpdateDate,q.Status
from QC as q ".$where." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select  count(q.QCID) as total
from QC as q ".$where." limit ".$start.",". $count;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['data']=$results;
	$arr['num']=$total['0']['total'];
	echo json_encode($arr);
}
?>