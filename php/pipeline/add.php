<?php
require_once(dirname(__FILE__).'/../lib/init.php');



$PipelineProjectID=$_POST['PipelineProjectID'];

$ProductUpdateRecordID=$_POST['ProductUpdateRecordID'];


createPipelineProject($PipelineProjectID,$ProductUpdateRecordID);




function createPipelineProject($PipelineProjectID,$ProductUpdateRecordID){
	global $mysql_obj;
	
	$data['PipelineProjectID'] = $PipelineProjectID;
	

	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("Pipeline",$data);
	$sql='select last_insert_id();';
	$PipelineArr=$mysql_obj->querySql($sql);
	
	$PipelineID=$PipelineArr[0]['last_insert_id()'];
	unset($data['PipelineProjectID']);
	$data['PipelineID']=$PipelineID;
	$data['ProductUpdateRecordID']=$ProductUpdateRecordID;
	$result_all = $mysql_obj->insertq("ProductPipeline",$data);
	echo json_encode($result_all);
}
?>