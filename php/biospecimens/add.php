<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$MolDiagnosisID = $_POST['MolDiagnosisID'];

$SampleOriID=$_POST['SampleOriID'];
$SampleSGIID=$_POST['SampleSGIID'];
$SampleType=$_POST['SampleType'];
$Site=$_POST['Site'];

$SamplingDate=$_POST['SamplingDate'];
$ReceivedDate=$_POST['ReceivedDate'];
$IsTumorCell=$_POST['IsTumorCell'];
$TumorCellContent=$_POST['TumorCellContent'];

$Quantity=$_POST['Quantity'];
$RecipientsID=$_POST['RecipientsID'];
$Unit=$_POST['Unit'];
$Status=$_POST['Status'];

$PathologicNumber = $_POST['PathologicNumber'];

addBiospeciemens($MolDiagnosisID,$SampleOriID,$SampleSGIID,$SampleType,$Site,$SamplingDate,$ReceivedDate,$IsTumorCell,$TumorCellContent,$Quantity,$RecipientsID,$Unit,$Status,$PathologicNumber);

function addBiospeciemens($MolDiagnosisID,$SampleOriID,$SampleSGIID,$SampleType,$Site,$SamplingDate,$ReceivedDate,$IsTumorCell,$TumorCellContent,$Quantity,$RecipientsID,$Unit,$Status,$PathologicNumber){
	
	global $mysql_obj;	
	
	$data['MolDiagnosisID'] = $MolDiagnosisID;
	
	$data['SampleOriID'] = $SampleOriID;
	$data['SampleSGIID'] = $SampleSGIID;
	$data['SampleType'] = $SampleType;
	$data['Site'] = $Site;
	
	$data['SamplingDate'] = $SamplingDate;
	$data['ReceivedDate'] = $ReceivedDate;
	$data['IsTumorCell'] = $IsTumorCell;
	$data['TumorCellContent'] = $TumorCellContent;
	
	$data['Quantity'] = $Quantity;
	$data['RecipientsID'] = $RecipientsID;
	$data['Unit'] = $Unit;
	$data['Status'] = $Status;
	
	$data['PathologicNumber'] = $PathologicNumber;
	
	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("Biospecimens",$data);

	echo json_encode($result_all);
}

?>