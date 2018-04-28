<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');

$PanelUpdateRecordID = $_POST['PanelUpdateRecordID'];
$EmployeeID=$_POST['EmployeeID'];
$Role=$_POST['Role'];
/* if(($PanelUpdateRecordID === "") || ($PanelUpdateRecordID === NULL)){
	echo json_encode(array("传值错误!",1));
	die;
}
if(($EmployeeID === "") || ($EmployeeID === NULL)){
	echo json_encode(array("传值错误!",1));
	die;
}
$Role=$_POST['Role'];
//先对传的EmployeeID跟PanelUpdateRecordID进行外键判断
$where_employee['EmployeeID']= $EmployeeID;
$find_employee = $mysql_obj->selectq("Employee",array("EmployeeID"),$where_employee);
if(!$find_employee){
		echo json_encode(array("没有该ID的成员!",2));
		die;
}
$where_pauprecord['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$find_pauprecord = $mysql_obj->selectq("PanelUpdateRecord",array("PanelUpdateRecordID"),$where_pauprecord);
if(!$find_pauprecord){
		echo json_encode(array("没有该ID的Panel更新记录!",2));
		die;
} */
//通过后再进行添加操作
$data['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$data['EmployeeID'] = $EmployeeID;
$data['Role'] = $Role;

$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

$result_all = $mysql_obj->insertq("PanelMembers",$data);

echo json_encode($result_all);
?>
