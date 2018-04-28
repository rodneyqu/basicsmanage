<?php
require_once(dirname(__FILE__).'/../lib/init.php');



$PipelineID=$_POST['PipelineID'];
$PipelineProjectID=$_POST['PipelineProjectID'];
$ProductUpdateRecordID=$_POST['ProductUpdateRecordID'];
if(empty($PipelineProjectID)|| empty($ProductUpdateRecordID)){
	return false;
}else{

	updatePipelineProjectID($PipelineID,$PipelineProjectID,$ProductUpdateRecordID);

}


function updatePipelineProjectID($PipelineID,$PipelineProjectID,$ProductUpdateRecordID){
	global $mysql_obj;
	
	$sql="select * from Pipeline as p
	join ProductPipeline as pp
	on p.PipelineID = pp.PipelineID
	where PipelineProjectID='".$PipelineProjectID."'";
	$result_all = $mysql_obj->querySql($sql);

/*
	if(count($result_all)>0){
		$result_all=$mysql_obj->return_array(2);
		echo json_encode($result_all);
		die();
	}
*/
	$LatestUpdateDate=date("Y-m-d");
	if(count($result_all)>0){
		$sql="update Pipeline as p
	join ProductPipeline as pp
	on p.PipelineID = pp.PipelineID
	set pp.ProductUpdateRecordID = ".$ProductUpdateRecordID."
	,pp.LatestUpdateDate = '".$LatestUpdateDate."'
	where pp.PipelineID=".$PipelineID;

	}else{
		$sql="update Pipeline as p
		join ProductPipeline as pp
		on p.PipelineID = pp.PipelineID
		set pp.ProductUpdateRecordID = ".$ProductUpdateRecordID."
		,p.PipelineProjectID='".$PipelineProjectID."'
		,pp.LatestUpdateDate = '".$LatestUpdateDate."'
		,p.LatestUpdateDate = '".$LatestUpdateDate."'
		where pp.PipelineID=".$PipelineID;
	}
	$result_all = $mysql_obj->delSql($sql);
	if($result_all){
		echo json_encode($mysql_obj->return_array(0));
	}else{
		echo json_encode($mysql_obj->return_array(6));
	}

}
?>