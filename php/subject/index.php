<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
$mysql_obj = new sqlfunc();

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$SubjectID = $_POST['SubjectID'];
$FirstName = $_POST['FirstName'];
$MiddleName=$_POST['MiddleName'];
$LastName=$_POST['LastName'];
$age = $_POST['Age'];
$Gender = $_POST['Gender'];
$CreateDate = $_POST['CreateDate'];

$date_today = date("Y-m-d"); 
//测试
/* $date_today = "2018-02-28";   */
$today = explode('-',$date_today);

$where['SubjectID'] = $SubjectID;
$where['FirstName'] = $FirstName;
$where['MiddleName'] = $MiddleName;
$where['LastName'] = $LastName;
$where['Gender'] = $Gender;
$sqlwhere = null;

if(!($CreateDate === '') && !($CreateDate === null)){//当查找条件包含创建时间时进行特殊处理
	$sqlwhere = 'CreateDate >='.'"'.$CreateDate[0].'"'.' AND CreateDate <='.'"'.$CreateDate[1].'"';
}

if(!($age === '') && !($age === null)){//当查找条件包含年龄时进行特殊处理
	$early_year = $today[0] - $age -1;
	if($today[2] < 9){
		$earlyday = '0'.($today[2] +1);
	}else{
		$earlyday = ($today[2] +1);
	}
	$earlydate = $early_year.'-'.$today[1].'-'.$earlyday;
	$late_year = $today[0] - $age;
	$latedate = $late_year.'-'.$today[1].'-'.($today[2]);
	if($sqlwhere ===null){
		$sqlwhere = 'DateOfBirth >='.'"'.$earlydate.'"'.' AND DateOfBirth <='.'"'.$latedate.'"';
	}else{
		$sqlwhere .= 'AND DateOfBirth >='.'"'.$earlydate.'"'.' AND DateOfBirth <='.'"'.$latedate.'"';
	}
}

$result_all = $mysql_obj->getpageq("SubjectInfo",$where,$pageNum,$pageSize,null,$sqlwhere);


if(!empty($result_all['data']) && (is_array($result_all['data']))){
	foreach($result_all['data'] as $k => $v){
		$name = $v['LastName'].$v['FirstName'];
		$date_birth = $v['DateOfBirth'];
		$birthdate = explode('-',$date_birth);
		$years = $today[0] - $birthdate[0];
		if($today[1] < $birthdate[1]){
			$years -=1;
		}elseif($today[1] == $birthdate[1]){
			if($today[2] < $birthdate[2]){
				$years -=1;
			}
		}
		$result_all['data'][$k]['Name'] = $name;
		$result_all['data'][$k]['Age'] = $years;
	}
}
echo json_encode($result_all);

?>
