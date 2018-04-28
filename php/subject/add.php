<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
$mysql_obj = new sqlfunc();

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
$SubjectSGIID = $_POST['SubjectSGIID'];


$data['FirstName'] = $FirstName;
$data['MiddleName'] = $MiddleName;
$data['LastName'] = $LastName;
$data['Gender'] = $Gender;
$data['DateOfBirth'] = $DateOfBirth;
$data['IDType'] = $IDType;
$data['IDNumber'] = $IDNumber;
$data['PhoneNumber'] = $PhoneNumber;
$data['Email'] = $Email;
$data['FamilyHistory'] = $FamilyHistory;
$data['SubjectSGIID'] = $SubjectSGIID;

$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

$result_all = $mysql_obj->insertq("SubjectInfo",$data);

echo json_encode($result_all);
?>
