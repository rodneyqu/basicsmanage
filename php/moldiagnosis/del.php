<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$MolDiagnosisID = $_POST['MolDiagnosisID'];




deleteMoldiagnosis($MolDiagnosisID);




function deleteMoldiagnosis($MolDiagnosisID){
	global $mysql_obj;
	
	
	$where['MolDiagnosisID'] = $MolDiagnosisID;
	
	$result_all = $mysql_obj->deleteq("MolDiagnosis",$where['MolDiagnosisID'],'MolDiagnosisID');

	echo json_encode($result_all);
}
?>