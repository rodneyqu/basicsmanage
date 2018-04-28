<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$MolDiagnosisID = $_POST['MolDiagnosisID'];

$InspectionDate=$_POST['InspectionDate'];
$InspectionInstitution=$_POST['InspectionInstitution'];
$Physician=$_POST['Physician'];
$ProductID=$_POST['ProductID'];
$Status=$_POST['Status'];
$ReporterID=$_POST['ReporterID'];
$ReviewerID=$_POST['ReviewerID'];

$ReportDate=$_POST['ReportDate'];

updateMoldiagnosis($MolDiagnosisID,$InspectionDate,$InspectionInstitution,$Physician,$ProductID,$Status,$ReporterID,$ReviewerID,$ReportDate);




function updateMoldiagnosis($MolDiagnosisID,$InspectionDate,$InspectionInstitution,$Physician,$ProductID,$Status,$ReporterID,$ReviewerID,$ReportDate){
	global $mysql_obj;
	
	
	$where['MolDiagnosisID'] = $MolDiagnosisID;

	$data['InspectionDate'] = $InspectionDate;
	$data['InspectionInstitution'] = $InspectionInstitution;
	$data['Physician'] = $Physician;
	$data['ProductID'] = $ProductID;
	$data['Status'] = $Status;
	$data['ReporterID'] = $ReporterID;
	$data['ReviewerID'] = $ReviewerID;
	$data['ReportDate'] = $ReportDate;
	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->updateq("MolDiagnosis",$data,$where);

	echo json_encode($result_all);
}
?>