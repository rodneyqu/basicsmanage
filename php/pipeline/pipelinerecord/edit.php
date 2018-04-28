<?php
require_once(dirname(__FILE__).'/../../lib/init.php');



$PipelineUpdateRecordID=$_POST['PipelineUpdateRecordID'];

if(empty($PipelineUpdateRecordID)){
	return false;
}else{
	editPipelineUpdateRecord($PipelineUpdateRecordID);
}



function editPipelineUpdateRecord($PipelineUpdateRecordID){
	global $mysql_obj;
	$data['PipelineUpdateRecordID'];
	$data['PipelineID'];
	$data['PipelineVersion'];
	$data['PipelineName_cn'];
	$data['PipelineName_en'];
	$data['PipelineStatus'];
	$data['PipelineOnlineDate'];
	$data['PipelineOfflineDate'];
	$data['PipelineDescription'];
	$data['CreateDate'];
	$data['LatestUpdateDate'];

	$where['PipelineUpdateRecordID']=$PipelineUpdateRecordID;
	
	$result_all = $mysql_obj->selectq("PipelineUpdateRecord",$data,$where);

	echo json_encode($result_all);
	
}
?>