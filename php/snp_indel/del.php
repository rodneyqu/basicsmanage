<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$VariantID = $_POST['VariantID'];




deleteSNP_InDel($VariantID);




function deleteSNP_InDel($VariantID){
	global $mysql_obj;
	
	
	$where['VariantID'] = $VariantID;
	
	$result_all = $mysql_obj->deleteq("SNP_InDel",$where['VariantID'],'VariantID');

	echo json_encode($result_all);
}
?>