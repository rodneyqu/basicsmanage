<?php
require_once(dirname(__FILE__).'/../../lib/init.php');



$PipelineID=$_POST['PipelineID'];
$PipelineUpdateRecordID=$_POST['PipelineUpdateRecordID'];
$PipelineVersion=$_POST['PipelineVersion'];
$PipelineName_cn=$_POST['PipelineName_cn'];
$PipelineName_en=$_POST['PipelineName_en'];
$PipelineStatus=$_POST['PipelineStatus'];
$PipelineOnlineDate=$_POST['PipelineOnlineDate'];
$PipelineOfflineDate=$_POST['PipelineOfflineDate'];
$PipelineDescription=$_POST['PipelineDescription'];



updatePipelineUpdateRecord($PipelineID,$PipelineUpdateRecordID,$PipelineVersion,$PipelineName_cn,$PipelineName_en,$PipelineStatus,$PipelineOnlineDate,$PipelineOfflineDate,$PipelineDescription);




function updatePipelineUpdateRecord($PipelineID,$PipelineUpdateRecordID,$PipelineVersion,$PipelineName_cn,$PipelineName_en,$PipelineStatus,$PipelineOnlineDate,$PipelineOfflineDate,$PipelineDescription){
	global $mysql_obj;
	
	$data['PipelineID'] = $PipelineID;
	$data['PipelineVersion'] = $PipelineVersion;
	$data['PipelineName_cn'] = $PipelineName_cn;
	$data['PipelineName_en'] = $PipelineName_en;
	$data['PipelineStatus'] = $PipelineStatus;
	$data['PipelineOnlineDate'] = $PipelineOnlineDate;
	$data['PipelineOfflineDate'] = $PipelineOfflineDate;
	$data['PipelineDescription'] = $PipelineDescription;


	
	$data['LatestUpdateDate'] = date("Y-m-d");

	$where['PipelineUpdateRecordID']=$PipelineUpdateRecordID;
	$result_all = $mysql_obj->updateq("PipelineUpdateRecord",$data,$where);

	echo json_encode($result_all);
}
?>