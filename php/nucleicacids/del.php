<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$NucleicAcidID = $_POST['NucleicAcidID'];

delNucleicAcids($NucleicAcidID);
function delNucleicAcids($NucleicAcidID){
	global $mysql_obj;
	$where = $NucleicAcidID;
	$result_all = $mysql_obj->deleteq('NucleicAcids',$where,"NucleicAcidID");
	echo json_encode($result_all);
}

?>