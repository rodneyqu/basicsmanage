<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');

$pageNum=$_POST['pageNum']; //当前页
$pageNum=(empty($pageNum))?'1':$pageNum;
$pageSize=$_POST['pageSize'];
$pageSize=(empty($pageSize))?'10':$pageSize;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
$begin_position = ($pageNum-1)*$pageSize;
$sql_limit .= " limit {$begin_position},{$pageSize}"; 

$ProductUpdateRecordID = $_POST['ProductUpdateRecordID'];
if(($ProductUpdateRecordID ==="") ||($ProductUpdateRecordID === null)){
	echo json_encode(array('code'=>5,'info'=>"传参为空"));
}

/* $result_all = $mysql_obj->getpageq("Product",$where,$pageNum,$pageSize,null,$sqlwhere); */
$joinsql = "SELECT a.ProductGeneID,a.GeneID,a.ProductUpdateRecordID,a.CreateDate,a.LatestUpdateDate,b.Symbol FROM 
ProductGene a LEFT JOIN Gene b 
ON a.GeneID=b.GeneID 
WHERE a.ProductUpdateRecordID='{$ProductUpdateRecordID}' {$sql_limit}";
$joinsql_num = "SELECT count(a.GeneID) as nums FROM 
ProductGene a LEFT JOIN Gene b 
ON a.GeneID=b.GeneID 
WHERE a.ProductUpdateRecordID='{$ProductUpdateRecordID}'";
$result_all = $mysql_obj->querySql($joinsql);
$nums =  $mysql_obj->querySql($joinsql_num);
echo json_encode(array('data'=>$result_all,'num'=>$nums[0][nums]));

?>
