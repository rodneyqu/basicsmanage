<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
$SubjectID = $_POST['SubjectID'];
$DiagnosisID = $_POST['DiagnosisID'];

listDiagnosis($SubjectID,$pageNum,$pageSize,$DiagnosisID);
	
function listDiagnosis($SubjectID,$pageNum,$pageSize,$DiagnosisID){
	global $mysql_obj;
	$where['SubjectID'] = $SubjectID;
	$where['DiagnosisID'] = $DiagnosisID;
	$result_all = $mysql_obj->getpageq("Diagnosis",$where,$pageNum,$pageSize);
	echo json_encode($result_all);
}
	
?>
