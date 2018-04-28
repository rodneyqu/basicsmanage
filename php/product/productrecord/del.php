<?php
require_once(dirname(__FILE__).'../../../lib/init.php');
$ProductUpdateRecordID = $_POST['ProductUpdateRecordID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $ProductUpdateRecordID;
$result_all = $mysql_obj->deleteq('ProductUpdateRecord',$where,"ProductUpdateRecordID");
echo json_encode($result_all);
?>
