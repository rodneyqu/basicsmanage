<?php
require_once(dirname(__FILE__).'/../lib/init.php');

$LibID = $_POST['LibID'];
$NucleicAcidID = $_POST['NucleicAcidID'];
$LibSGIID=$_POST['LibSGIID'];
$LibConsDate=$_POST['LibConsDate'];
$LibConsManipulatorID=$_POST['LibConsManipulatorID'];
$LibConsAmount=$_POST['LibConsAmount'];
$LibConsUnit=$_POST['LibConsUnit'];
$LibQuality=$_POST['LibQuality'];
$LibVolume=$_POST['LibVolume'];
$LibVolumeUnit=$_POST['LibVolumeUnit'];
$LibConc=$_POST['LibConc'];

$LibConcUnit=$_POST['LibConcUnit'];
$LibAmount=$_POST['LibAmount'];
$LibAmountUnit=$_POST['LibAmountUnit'];
$LibInsSize=$_POST['LibInsSize'];
$LibInsSizeUnit=$_POST['LibInsSizeUnit'];
$Status=$_POST['Status'];


if(empty($LibID) || empty($NucleicAcidID) || empty($LibSGIID)){
	echo json_encode($mysql_obj->return_array(5));
	die();
}else{
	updateLib($LibID,$NucleicAcidID,$LibSGIID,$LibConsDate,$LibConsManipulatorID,$LibConsAmount,$LibConsUnit,$LibQuality,$LibVolume,$LibVolumeUnit,$LibConc,$LibConcUnit,$LibAmount,$LibAmountUnit,$LibInsSize,$LibInsSizeUnit,$Status);
}


function updateLib($NucleicAcidID,$LibSGIID,$LibConsDate,$LibConsManipulatorID,$LibConsAmount,$LibConsUnit,$LibQuality,$LibVolume,$LibVolumeUnit,$LibConc,$LibConcUnit,$LibAmount,$LibAmountUnit,$LibInsSize,$LibInsSizeUnit,$Status){
	global $mysql_obj;
	
	
	$where['LibID'] = $LibID;

	$data['NucleicAcidID'] = $NucleicAcidID;
	$data['LibSGIID'] = $LibSGIID;
	$data['LibConsDate'] = $LibConsDate;
	$data['LibConsManipulatorID'] = $LibConsManipulatorID;
	$data['LibConsAmount'] = $LibConsAmount;
	$data['LibConsUnit'] = $LibConsUnit;
	$data['LibQuality'] = $LibQuality;
	$data['LibVolume'] = $LibVolume;
	$data['LibVolumeUnit'] = $LibVolumeUnit;
	
	$data['LibConc'] = $LibConc;
	$data['LibConcUnit'] = $LibConcUnit;
	$data['LibAmount'] = $LibAmount;
	$data['LibAmountUnit'] = $LibAmountUnit;
	$data['LibInsSize'] = $LibInsSize;
	$data['LibInsSizeUnit'] = $LibInsSizeUnit;
	$data['Status'] = $Status;
	$data['CreateDate'] = date("Y-m-d");
	

	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->updateq("Lib",$data,$where);

	echo json_encode($result_all);
}
?>