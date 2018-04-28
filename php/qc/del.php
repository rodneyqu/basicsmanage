<?php
require_once(dirname(__FILE__).'/../lib/init.php');


$QCID = $_POST['QCID'];




deleteQc($QCID);




function deleteQc($QCID){
	global $mysql_obj;
	
	
	$where['QCID'] = $QCID;
	
	$result_all = $mysql_obj->deleteq("QC",$where['QCID'],'QCID');

	echo json_encode($result_all);
}
?>