<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');

$ProductMemberID = $_POST['ProductMemberID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $ProductMemberID;

$result_all = $mysql_obj->deleteq('ProductMembers',$where,"ProductMemberID");

echo json_encode($result_all);
?>
