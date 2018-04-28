<?php
require_once(dirname(__FILE__).'../../lib/init.php');





getEmployeeName();

function getEmployeeName(){
	global $mysql_obj;
	
	$sql="select EmployeeID ,CONCAT(LastName,FirstName,MiddleName) as Fullname from Employee where Authority =2 or Authority=3 ";

	$result_all=$mysql_obj->querySql($sql);
	echo json_encode($result_all);
}
?>
