<?php
require_once(dirname(__FILE__).'/../lib/init.php');
$QCID=$_POST['QCID'];
$LibID = $_POST['LibID'];
$TotalBases=$_POST['TotalBases'];
$TotalReadNumber=$_POST['TotalReadNumber'];
$DuplicationRate=$_POST['DuplicationRate'];
$MappingRate=$_POST['MappingRate'];
$ReadLength=$_POST['ReadLength'];
$CaptureEfficacy=$_POST['CaptureEfficacy'];
$ProbeMeanDepth=$_POST['ProbeMeanDepth'];
$ProbeMedianDepth=$_POST['ProbeMedianDepth'];
$ProbeUniformity=$_POST['ProbeUniformity'];

$DepthGT1Rate=$_POST['DepthGT1Rate'];
$DepthGT30Rate=$_POST['DepthGT30Rate'];
$Status=$_POST['Status'];


if(empty($QCID) || empty($LibID) || empty($TotalBases) || empty($TotalReadNumber)){
	 echo json_encode($mysql_obj->return_array(5));
	 die();
}else{
	updateQc($QCID,$LibID,$TotalBases,$TotalReadNumber,$DuplicationRate,$MappingRate,$ReadLength,$CaptureEfficacy,$ProbeMeanDepth,$ProbeMedianDepth,$ProbeUniformity,$DepthGT1Rate,$DepthGT30Rate,$Status);
}


function updateQc($QCID,$LibID,$TotalBases,$TotalReadNumber,$DuplicationRate,$MappingRate,$ReadLength,$CaptureEfficacy,$ProbeMeanDepth,$ProbeMedianDepth,$ProbeUniformity,$DepthGT1Rate,$DepthGT30Rate,$Status){
	global $mysql_obj;
	
	
	$where['QCID'] = $QCID;
	$data['LibID'] = $LibID;
	$data['TotalBases'] = $TotalBases;
	$data['TotalReadNumber'] = $TotalReadNumber;
	$data['DuplicationRate'] =$DuplicationRate;
	$data['MappingRate'] = $MappingRate;
	$data['ReadLength'] = $ReadLength;
	$data['CaptureEfficacy'] = $CaptureEfficacy;
	$data['ProbeMeanDepth'] = $ProbeMeanDepth;
	$data['ProbeMedianDepth'] = $ProbeMedianDepth;
	$data['ProbeUniformity'] = $ProbeUniformity;
	$data['DepthGT1Rate'] = $DepthGT1Rate;
	
	$data['DepthGT30Rate'] = $DepthGT30Rate;
	$data['Status'] = $Status;
	$data['CreateDate'] = date("Y-m-d");
	

	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->updateq("QC",$data,$where);

	echo json_encode($result_all);
}
?>