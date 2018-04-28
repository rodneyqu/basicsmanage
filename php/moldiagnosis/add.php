<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$SubjectID = $_POST['SubjectID'];
$InspectionDate=$_POST['InspectionDate'];
$InspectionInstitution=$_POST['InspectionInstitution'];
$Physician=$_POST['Physician'];
$ProductID=$_POST['ProductID'];
$Status=$_POST['Status'];
$ReporterID=$_POST['ReporterID'];
$ReviewerID=$_POST['ReviewerID'];
$ReportDate=$_POST['ReportDate'];



createMoldiagnosis($SubjectID,$InspectionDate,$InspectionInstitution,$Physician,$ProductID,$Status,$ReporterID,$ReviewerID,$ReportDate);




function createMoldiagnosis($SubjectID,$InspectionDate,$InspectionInstitution,$Physician,$ProductID,$Status,$ReporterID,$ReviewerID,$ReportDate){
	global $mysql_obj;
	
	$data['SubjectID'] = $SubjectID;
	$data['InspectionDate'] = $InspectionDate;
	$data['InspectionInstitution'] = $InspectionInstitution;
	$data['Physician'] = $Physician;
	$data['ProductID'] = $ProductID;
	$data['Status'] = $Status;
	$data['ReporterID'] = $ReporterID;
	$data['ReviewerID'] = $ReviewerID;
	$data['ReportDate'] = $ReportDate;
	
	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("MolDiagnosis",$data);
	
	echo json_encode($result_all);
}
?>