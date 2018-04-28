<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');


$ProductGeneID = $_POST['ProductGeneID'];
delProductGene($ProductGeneID);
function delProductGene($ProductGeneID){
	global $mysql_obj;

	$where = $ProductGeneID;
	$result_all = $mysql_obj->deleteq('ProductGene',$where,"ProductGeneID");
	echo json_encode($result_all);
}
?>
