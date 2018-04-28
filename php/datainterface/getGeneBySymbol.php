<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$Symbol=addslashes($_POST['Symbol']);
if(!isset($Symbol) || ($Symbol === "")){
  $where = "";
}else{
  $where = "Symbol like '%{$Symbol}%' ORDER BY LENGTH(replace(Symbol,'{$Symbol}',''))";
}
$result_all = $mysql_obj->getpageq("Gene",$where,1,20,array('GeneID','Symbol'));
echo json_encode($result_all['data']);
?>
