<?php
require_once(dirname(__FILE__).'/../lib/init.php');
$SubjectID=$_POST['SubjectID'];
if(is_numeric($SubjectID) or $SubjectID==''){
	getSubjectByNum($SubjectID);
}else{
	return false;
}









function getSubjectByNum($SubjectID){
	global $mysql_obj;
	$sql="select b.SubjectID,b.SubjectName from (
select SubjectID,concat(LastName,FirstName,MiddleName) as SubjectName from SubjectInfo ) as b
where b.SubjectID like '%".$SubjectID."%' limit 20";

	$result_all = $mysql_obj->querySql($sql);

	echo json_encode($result_all);


}

?>