<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$SubjectID = $_POST['SubjectID'];

$DiagnosisDesc=$_POST['DiagnosisDesc'];
$DiseaseStagingAndGrading=$_POST['DiseaseStagingAndGrading'];
$TreatmentDescription=$_POST['TreatmentDescription'];

addDiagnosis($SubjectID,$DiagnosisDesc,$DiseaseStagingAndGrading,$TreatmentDescription);

function addDiagnosis($SubjectID,$DiagnosisDesc,$DiseaseStagingAndGrading,$TreatmentDescription){
	
	global $mysql_obj;	
	
	$data['SubjectID'] = $SubjectID;
	
	$data['DiagnosisDesc'] = $DiagnosisDesc;
	$data['DiseaseStagingAndGrading'] = $DiseaseStagingAndGrading;
	$data['TreatmentDescription'] = $TreatmentDescription;

	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("Diagnosis",$data);

	echo json_encode($result_all);
}

?>