<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$SubjectID = $_POST['SubjectID'];

delSubjectID($SubjectID);
function delSubjectID($SubjectID){
	global $mysql_obj;
	$where = $SubjectID;
	$result_all = $mysql_obj->deleteq('Subject',$where,"SubjectID");
	echo json_encode($result_all);
}

?>