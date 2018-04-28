<?php
require_once(dirname(__FILE__).'../../lib/init.php');





getChr();

function getChr(){
	global $mysql_obj;
	
	$sql="select ChrID ,ChrName,Length,AssemblyVersion from Chr";

	$result_all=$mysql_obj->querySql($sql);
	echo json_encode($result_all);
}
?>
