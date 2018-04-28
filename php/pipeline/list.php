<?php
require_once(dirname(__FILE__).'/../lib/init.php');



$PipelineID=$_POST['PipelineID'];
$PipelineProjectID=$_POST['PipelineProjectID'];
$startDay=$_POST['startDay'];
$overDay=$_POST['overDay'];
$PipelineName_cn=$_POST['PipelineName_cn'];
$PipelineName_en=$_POST['PipelineName_en'];


$page=$_POST['page']; //当前页
$page=(empty($page))?'1':$page;
$count=$_POST['count'];
$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
$count=$count;
listPipelineProject($page,$count,$PipelineID,$PipelineProjectID,$startDay,$overDay,$PipelineName_cn,$PipelineName_en);

function listPipelineProject($page,$count,$PipelineID,$PipelineProjectID,$startDay,$overDay,$PipelineName_cn,$PipelineName_en){
	global $mysql_obj;
	$start=($page-1)*$count;
	$searchArr['p.PipelineID']=$PipelineID;
	$searchArr['p.PipelineProjectID']=$PipelineProjectID;
	$searchArr['p.startDay']=$startDay;
	$searchArr['p.overDay']=$overDay;
	$searchArr['pr.PipelineName_cn']=$PipelineName_cn;
	$searchArr['pr.PipelineName_en']=$PipelineName_en;
	foreach($searchArr as $key=>$value){
		if($value!='' ){

			if($i>0){
				if($key=='startDay'){
					$whereSql .= ' or '.$key.' >= "'. $value.'"';
				}elseif($key=='overDay'){
					$whereSql .= ' or '.$key.' <= "'. $value.'"';
				}else{
					$whereSql .= ' or '.$key.' like "%'. $value.'%"';
				}
			}else{
				if($key=='startDay'){
					$whereSql .= $key.' >= "'. $value.'"';
				}elseif($key=='overDay'){
					$whereSql .= $key.' <= "'. $value.'"';
				}else{
					$whereSql .= $key.' like "%'. $value.'%"';
				}
			}
			$i++;	
		}
	}
	if($whereSql){
		$whereSql=' where '.$whereSql;
	}
	$sql="select pp.ProductPipelineID,pp.ProductUpdateRecordID,pur.Version,pdt.ProductName_cn,p.PipelineID,p.PipelineProjectID,p.CreateDate,p.LatestUpdateDate,pr.PipelineName_cn,pr.PipelineName_en from Pipeline as p
left join PipelineUpdateRecord as pr
on p.PipelineID = pr.PipelineID
join ProductPipeline as pp
on pp.PipelineID = p.PipelineID
join ProductUpdateRecord as pur
on pp.ProductUpdateRecordID = pur.ProductUpdateRecordID
join Product as pdt
on pdt.ProductID = pur.ProductID
".$whereSql." 
order by p.LatestUpdateDate desc limit ".$start.",". $count;

	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(p.PipelineID) as total from Pipeline as p
left join PipelineUpdateRecord as pr
on p.PipelineID = pr.PipelineID
join ProductPipeline as pp
on pp.PipelineID = p.PipelineID
join ProductUpdateRecord as pur
on pp.ProductUpdateRecordID = pur.ProductUpdateRecordID
join Product as pdt
on pdt.ProductID = pur.ProductID
".$whereSql." 
order by p.LatestUpdateDate desc;";
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['data']=$results;
	$arr['num']=$total['0']['total'];

	echo json_encode($arr);
}
?>