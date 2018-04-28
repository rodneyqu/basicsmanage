<?php
require_once(dirname(__FILE__).'../../lib/init.php');
//use publicfunc\sqlfunc as sqlfunc;
$Email=$_POST['Email'];
/* $Email = "jie";
print_r($Email); */
if(!isset($Email) || ($Email === "")){
  $where = "";
}else{
  $where = "Email like '%{$Email}%' AND Authority=2 OR Authority=3 ORDER BY LENGTH(replace(Email,'{$Email}',''))";
}
//var_dump($where);
$result_all = $mysql_obj->getpageq("Employee",$where,1,20);
echo json_encode($result_all['data']);
?>

