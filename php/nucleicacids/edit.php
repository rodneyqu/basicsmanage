<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$NucleicAcidID = $_POST['NucleicAcidID'];
$BiospeciemensID = $_POST['BiospeciemensID'];

$NucleicAcidSGIID=$_POST['NucleicAcidSGIID'];
$NAExtractionAmount=$_POST['NAExtractionAmount'];
$NAExtractionUnit=$_POST['NAExtractionUnit'];
$NAExtractionDate=$_POST['NAExtractionDate'];

$NAExtractionManipulatorID=$_POST['NAExtractionManipulatorID'];
$NAVolume=$_POST['NAVolume'];
$NAVolumeUnit=$_POST['NAVolumeUnit'];
$NAConc=$_POST['NAConc'];

$NAConcUnit=$_POST['NAConcUnit'];
$NAAmount=$_POST['NAAmount'];
$NAAmountUnit=$_POST['NAAmountUnit'];
$NAQuality=$_POST['NAQuality'];

$NAType=$_POST['NAType'];
$Status=$_POST['Status'];


addNucleicAcids($NucleicAcidID,$BiospeciemensID,$NucleicAcidSGIID,$NAExtractionAmount,$NAExtractionUnit,$NAExtractionDate,$NAExtractionManipulatorID,$NAVolume,$NAVolumeUnit,$NAConc,$NAConcUnit,$NAAmount,$NAAmountUnit,$NAQuality,$NAType,$Status);

function addNucleicAcids($NucleicAcidID,$BiospeciemensID,$NucleicAcidSGIID,$NAExtractionAmount,$NAExtractionUnit,$NAExtractionDate,$NAExtractionManipulatorID,$NAVolume,$NAVolumeUnit,$NAConc,$NAConcUnit,$NAAmount,$NAAmountUnit,$NAQuality,$NAType,$Status){
	
	global $mysql_obj;	
	
	$data['BiospeciemensID'] = $BiospeciemensID;
	
	$data['NucleicAcidSGIID'] = $NucleicAcidSGIID;
	$data['NAExtractionAmount'] = $NAExtractionAmount;
	$data['NAExtractionUnit'] = $NAExtractionUnit;
	$data['NAExtractionDate'] = $NAExtractionDate;
	
	$data['NAExtractionManipulatorID'] = $NAExtractionManipulatorID;
	$data['NAVolume'] = $NAVolume;
	$data['NAVolumeUnit'] = $NAVolumeUnit;
	$data['NAConc'] = $NAConc;
	
	$data['NAConcUnit'] = $NAConcUnit;
	$data['NAAmount'] = $NAAmount;
	$data['NAAmountUnit'] = $NAAmountUnit;
	$data['NAQuality'] = $NAQuality;
	
	$data['NAType'] = $NAType;
	$data['Status'] = $Status;
	
	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];
	
	$where['NucleicAcidID'] = $NucleicAcidID;
	$result_all = $mysql_obj->updateq("NucleicAcids",$data,$where);

	echo json_encode($result_all);
}

?>