<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$LibID = $_POST['LibID'];




deleteLib($LibID);




function deleteLib($LibID){
	global $mysql_obj;
	
	
	$where['LibID'] = $LibID;
	
	$result_all = $mysql_obj->deleteq("Lib",$where['LibID'],'LibID');

	echo json_encode($result_all);
}
?>