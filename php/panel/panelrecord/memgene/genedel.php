<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');
$PanelGeneID = $_POST['PanelGeneID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $PanelGeneID;
$result_all = $mysql_obj->deleteq('PanelGene',$where,"PanelGeneID");
echo json_encode($result_all);
?>