<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$BiospeciemensID = $_POST['BiospeciemensID'];

delBiospeciemens($BiospeciemensID);
function delBiospeciemens($BiospeciemensID){
	global $mysql_obj;
	$where = $BiospeciemensID;
	$result_all = $mysql_obj->deleteq('Biospeciemens',$where,"BiospeciemensID");
	echo json_encode($result_all);
}

?>
