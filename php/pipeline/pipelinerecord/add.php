<?php
require_once(dirname(__FILE__).'/../../lib/init.php');



$PipelineID=$_POST['PipelineID'];
$PipelineVersion=$_POST['PipelineVersion'];
$PipelineName_cn=$_POST['PipelineName_cn'];
$PipelineName_en=$_POST['PipelineName_en'];
$PipelineStatus=$_POST['PipelineStatus'];
$PipelineOnlineDate=$_POST['PipelineOnlineDate'];
$PipelineOfflineDate=$_POST['PipelineOfflineDate'];
$PipelineDescription=$_POST['PipelineDescription'];



createPipelineUpdateRecord($PipelineID,$PipelineVersion,$PipelineName_cn,$PipelineName_en,$PipelineStatus,$PipelineOnlineDate,$PipelineOfflineDate,$PipelineDescription);




function createPipelineUpdateRecord($PipelineID,$PipelineVersion,$PipelineName_cn,$PipelineName_en,$PipelineStatus,$PipelineOnlineDate,$PipelineOfflineDate,$PipelineDescription){
	global $mysql_obj;
	
	$data['PipelineID'] = $PipelineID;
	$data['PipelineVersion'] = $PipelineVersion;
	$data['PipelineName_cn'] = $PipelineName_cn;
	$data['PipelineName_en'] = $PipelineName_en;
	$data['PipelineStatus'] = $PipelineStatus;
	$data['PipelineOnlineDate'] = $PipelineOnlineDate;
	$data['PipelineOfflineDate'] = $PipelineOfflineDate;
	$data['PipelineDescription'] = $PipelineDescription;


	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("PipelineUpdateRecord",$data);

	echo json_encode($result_all);
}
?>