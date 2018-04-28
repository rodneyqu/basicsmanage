<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');
$ProductGeneID = $_POST['ProductGeneID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $ProductGeneID;
$result_all = $mysql_obj->deleteq('ProductGene',$where,"ProductGeneID");
echo json_encode($result_all);
?>
