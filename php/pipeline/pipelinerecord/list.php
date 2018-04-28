<?php
require_once(dirname(__FILE__).'/../../lib/init.php');



$PipelineID=$_POST['PipelineID'];

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

listPipelineUpdateRecord($PipelineID,$pageNum,$pageSize);




function listPipelineUpdateRecord($PipelineID,$pageNum,$pageSize){
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
	$where['PipelineID']=$PipelineID;
	//$sqlwhere='order LatestUpdateDate by desc';
	$orderBy['LatestUpdateDate']='desc';
	$result_all = $mysql_obj->getpageq("PipelineUpdateRecord",$where,$pageNum,$pageSize,$data,$sqlwhere,$orderBy);

	echo json_encode($result_all);
	
}
?>