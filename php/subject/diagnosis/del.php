<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$DiagnosisID = $_POST['DiagnosisID'];

delDiagnosis($DiagnosisID);
function delDiagnosis($DiagnosisID){
	global $mysql_obj;
	$where = $DiagnosisID;
	$result_all = $mysql_obj->deleteq('Diagnosis',$where,"DiagnosisID");
	echo json_encode($result_all);
}

?>
