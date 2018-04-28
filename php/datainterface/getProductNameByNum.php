<?php
require_once(dirname(__FILE__).'/../lib/init.php');
$ProductName_cn=addslashes($_POST['ProductName_cn']);




getProductNameByName($ProductName_cn);




function getProductNameByName($ProductName_cn){
	global $mysql_obj;
	$sql="select pur.ProductUpdateRecordID ,p.ProductName_cn,pur.Version from Product as p join ProductUpdateRecord as pur
on p.ProductID=pur.ProductID where p.ProductName_cn like '%".$ProductName_cn."%' limit 20";

	$result_all = $mysql_obj->querySql($sql);

	echo json_encode($result_all);
}

?>