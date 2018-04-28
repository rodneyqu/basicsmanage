<?php
require_once(dirname(__FILE__).'/../lib/init.php');
require_once(dirname(__FILE__).'/../lib/common.php');


$LibID = $_POST['LibID'];




listSnp_indel($LibID);




function listSnp_indel($LibID){
	global $mysql_obj;
	
	$page=$_POST['pageNum']; //当前页
	$page=(empty($page))?'1':$page;
	$count=$_POST['pageSize'];
	$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
	$count=$count;
	$start=($page-1)*$count;
	if($LibID){
		$where=' where s.LibID = '.$LibID;
	}else{
		$where='';
	}

	$sql="select  s.VariantID,s.LibID,s.ChrName,s.Position,s.Ref,s.Alt,s.VariantType,s.Genotype,s.MinorAlleleFraction,s.DepthOfCoverage,s.Consequence,s.Impact,s.Symbol,s.Location,s.exon_intron,s.transcript,s.HGVSc,s.HGVSp,s.rsID,s.Clin_Sig,s.Flag,s.CreateDate,s.LatestUpdateDate
from SNP_InDel as s ".$where." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select  count(s.VariantID) as total
from SNP_InDel as s ".$where." limit ".$start.",". $count;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['data']=$results;
	$arr['num']=$total['0']['total'];
	echo json_encode($arr);
}
?>