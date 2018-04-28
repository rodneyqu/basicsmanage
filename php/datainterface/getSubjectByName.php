<?php
require_once(dirname(__FILE__).'/../lib/init.php');
$SubjectName=addslashes($_POST['SubjectName']);




getSubjectByName($SubjectName);




function getSubjectByName($SubjectName){
	global $mysql_obj;
	$sql="select b.SubjectID,b.SubjectName from (
select SubjectID,concat(LastName,FirstName,MiddleName) as SubjectName from SubjectInfo ) as b
where b.SubjectName like '%".$SubjectName."%' limit 20";

	$result_all = $mysql_obj->querySql($sql);

	echo json_encode($result_all);
}

?>