<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$SubjectID = $_POST['SubjectID'];

$FirstName = $_POST['FirstName'];
$MiddleName=$_POST['MiddleName'];
$LastName=$_POST['LastName'];
$Gender = $_POST['Gender'];
$DateOfBirth = $_POST['DateOfBirth'];
$IDType = $_POST['IDType'];
$IDNumber=$_POST['IDNumber'];
$PhoneNumber = $_POST['PhoneNumber'];
$Email = $_POST['Email'];
$FamilyHistory = $_POST['FamilyHistory'];

$where['SubjectID'] = $SubjectID;

$data['FirstName'] = $FirstName;
$data['MiddleName'] = $MiddleName;
$data['LastName'] = $LastName;
$data['Gender'] = $Gender;
$data['DateOfBirth'] = $DateOfBirth;
$data['IDType'] = $IDType;
$data['IDNumber'] = $IDNumber;
$data['Email'] = $Email;
$data['FamilyHistory'] = $_POST['FamilyHistory'];

$data['LatestUpdateDate'] = date("Y-m-d");

$result_all = $mysql_obj->updateq("SubjectInfo",$data,$where);

echo json_encode($result_all);
?>
