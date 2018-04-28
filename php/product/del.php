<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$ProductID = $_POST['ProductID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $ProductID;
$result_all = $mysql_obj->deleteq('Product',$where,"ProductID");
echo json_encode($result_all);
?>