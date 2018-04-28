<?php
require_once(dirname(__FILE__).'../../lib/init.php');
//use publicfunc\sqlfunc as sqlfunc;
$GeneName=$_POST['GeneName'];
if(!isset($GeneName) || ($GeneName === "")){
  $where = "";
}else{
  $where = "GeneName like '%{$GeneName}%' ORDER BY LENGTH(replace(GeneName,'{$GeneName}',''))";
}
//var_dump($where);
$result_all = $mysql_obj->getpageq("Gene",$where,1,20);
echo json_encode($result_all['data']);
?>
