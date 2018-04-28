<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$sql = "select * from VariantType limit 0,20";
$result_all = $mysql_obj->querySql($sql);
echo json_encode($result_all);
?>