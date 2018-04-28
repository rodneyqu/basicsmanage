<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$LibID = $_POST['LibID'];
$ChrName=$_POST['ChrName'];
$Position=$_POST['Position'];
$Ref=$_POST['Ref'];
$Alt=$_POST['Alt'];
$VariantType=$_POST['VariantType'];
$Genotype=$_POST['Genotype'];
$MinorAlleleFraction=$_POST['MinorAlleleFraction'];
$DepthOfCoverage=$_POST['DepthOfCoverage'];

$Consequence=$_POST['Consequence'];
$Impact=$_POST['Impact'];
$Symbol=$_POST['Symbol'];

$Location=$_POST['Location'];
$exon_intron=$_POST['exon_intron'];
$transcript=$_POST['transcript'];
$HGVSc=$_POST['HGVSc'];
$HGVSp=$_POST['HGVSp'];

$rsID=$_POST['rsID'];
$Clin_Sig=$_POST['Clin_Sig'];

$Flag=$_POST['Flag'];


//$CreateDate=$_POST['CreateDate'];
//$LatestUpdateDate=$_POST['LatestUpdateDate'];

if(empty($LibID) || empty($ChrName)){
	echo json_encode($mysql_obj->return_array(5));
	die();
}else{
	createVariant($LibID,$ChrName,$Position,$Ref,$Alt,$VariantType,$Genotype,$MinorAlleleFraction,$DepthOfCoverage,$Consequence,$Impact,$Symbol,$Location,$exon_intron,$transcript,$HGVSc,$HGVSp,$rsID,$Clin_Sig,$Flag);
}



function createVariant($LibID,$ChrName,$Position,$Ref,$Alt,$VariantType,$Genotype,$MinorAlleleFraction,$DepthOfCoverage,$Consequence,$Impact,$Symbol,$Location,$exon_intron,$transcript,$HGVSc,$HGVSp,$rsID,$Clin_Sig,$Flag){
	global $mysql_obj;
	
	$data['LibID'] = $LibID;
	$data['ChrName'] = $ChrName;
	$data['Position'] = $Position;
	$data['Ref'] = $Ref;
	$data['Alt'] = $Alt;
	$data['VariantType'] = $VariantType;
	$data['Genotype'] = $Genotype;
	$data['MinorAlleleFraction'] = $MinorAlleleFraction;
	$data['DepthOfCoverage'] = $DepthOfCoverage;
	
	$data['Consequence'] = $Consequence;
	$data['Impact'] = $Impact;
	$data['Symbol'] = $Symbol;
	$data['Location'] = $Location;
	$data['exon_intron'] = $exon_intron;
	$data['transcript'] = $transcript;
	$data['HGVSc'] = $HGVSc;
	$data['HGVSp'] = $HGVSp;
	$data['rsID'] = $rsID;
	$data['Clin_Sig'] = $Clin_Sig;
	$data['Flag'] = $Flag;
	$data['CreateDate'] = date("Y-m-d");
	$data['LatestUpdateDate'] = $data['CreateDate'];

	$result_all = $mysql_obj->insertq("SNP_InDel",$data);
	
	echo json_encode($result_all);
}
?>