<?php
require_once(dirname(__FILE__).'/../../../lib/init.php');

$PipelineUpdateRecordID = $_POST['PipelineUpdateRecordID'];
if(($PipelineUpdateRecordID ==="") ||($PipelineUpdateRecordID === null)){
	$result_all=$mysql_obj->return_array(5);
	echo json_encode($result_all);
	die();
}else{

	getGeneByProduct($PipelineUpdateRecordID);

}
function getGeneByProduct($PipelineUpdateRecordID){
	global $mysql_obj;
	$pageNum=$_POST['pageNum']; //当前页
	$pageNum=(empty($pageNum))?'1':$pageNum;
	$pageSize=$_POST['pageSize'];
	$pageSize=(empty($pageSize))?'10':$pageSize;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
	$begin_position = ($pageNum-1)*$pageSize;
	$sql_limit = " limit ".$begin_position." , ".$pageSize; 

	
	$sql = "select * from ProductPipeline as pp
join ProductUpdateRecord as pur
on pp.ProductUpdateRecordID = pur.ProductUpdateRecordID
join ProductGene as pg
on pg.ProductUpdateRecordID=pur.ProductUpdateRecordID
join Gene as g
on g.GeneID = pg.GeneID
join Pipeline as p
on p.PipelineID= pp.PipelineID
join PipelineUpdateRecord as plur
on plur.PipelineID=pp.PipelineID
	WHERE plur.PipelineUpdateRecordID=".$PipelineUpdateRecordID.$sql_limit;

	$joinsql_num = "SELECT count(g.GeneID) as nums from ProductPipeline as pp
join ProductUpdateRecord as pur
on pp.ProductUpdateRecordID = pur.ProductUpdateRecordID
join ProductGene as pg
on pg.ProductUpdateRecordID=pur.ProductUpdateRecordID
join Gene as g
on g.GeneID = pg.GeneID
join Pipeline as p
on p.PipelineID= pp.PipelineID
join PipelineUpdateRecord as plur
on plur.PipelineID=pp.PipelineID
	WHERE plur.PipelineUpdateRecordID=".$PipelineUpdateRecordID;

	$result_all = $mysql_obj->querySql($sql);
	$nums =  $mysql_obj->querySql($joinsql_num);

	echo json_encode(array('data'=>$result_all,'num'=>$nums[0][nums]));
}
?>
