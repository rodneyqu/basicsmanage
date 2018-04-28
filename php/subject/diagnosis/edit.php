<?php
require_once(dirname(__FILE__).'../../../lib/init.php');
$DiagnosisID = $_POST['DiagnosisID'];
$SubjectID = $_POST['SubjectID'];
$DiagnosisDesc=$_POST['DiagnosisDesc'];
$DiseaseStagingAndGrading=$_POST['DiseaseStagingAndGrading'];
$TreatmentDescription=$_POST['TreatmentDescription'];

editDiagnosis($DiagnosisID,$SubjectID,$DiagnosisDesc,$DiseaseStagingAndGrading,$TreatmentDescription);

function editDiagnosis($DiagnosisID,$SubjectID,$DiagnosisDesc,$DiseaseStagingAndGrading,$TreatmentDescription){
	
	global $mysql_obj;	
	$data['SubjectID'] = $SubjectID;	
	$data['DiagnosisDesc'] = $DiagnosisDesc;
	$data['DiseaseStagingAndGrading'] = $DiseaseStagingAndGrading;
	$data['TreatmentDescription'] = $TreatmentDescription;
	$data['LatestUpdateDate'] = date("Y-m-d");
	$where['DiagnosisID'] = $DiagnosisID;
	$result_all = $mysql_obj->updateq("Diagnosis",$data,$where);

	echo json_encode($result_all);
}

?>
