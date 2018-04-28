<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');

$PipelineMemberID = $_POST['PipelineMemberID'];
//$VariantID='{"VariantID":["1","2","3"]}';
delPipelineMembers($PipelineMemberID);

function delPipelineMembers($PipelineMemberID){
	global $mysql_obj;

	$where = $PipelineMemberID;

	$result_all = $mysql_obj->deleteq('PipelineMembers',$where,"PipelineMemberID");

	echo json_encode($result_all);
}
?>
