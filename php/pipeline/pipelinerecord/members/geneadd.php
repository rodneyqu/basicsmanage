<?php
require_once(dirname(__FILE__).'../../../../lib/init.php');

$ProductUpdateRecordID = $_POST['ProductUpdateRecordID'];
$GeneID=$_POST['GeneID'];
/* if(($PanelUpdateRecordID === "") || ($PanelUpdateRecordID === NULL)){
	echo json_encode(array("传值错误!",1));
	die;
}
if(($GeneID === "") || ($GeneID === NULL)){
	echo json_encode(array("传值错误!",1));
	die;
}
//先对传的EmployeeID跟PanelUpdateRecordID进行外键判断
$where_gene['GeneID']= $GeneID;
$find_gene = $mysql_obj->selectq("Gene",array("GeneID"),$where_gene);
if(!$find_gene){
		echo json_encode(array("没有该编号的基因!",1));
		die;
}
$where_pauprecord['PanelUpdateRecordID'] = $PanelUpdateRecordID;
$find_pauprecord = $mysql_obj->selectq("PanelUpdateRecord",array("PanelUpdateRecordID"),$where_pauprecord);
if(!$find_pauprecord){
		echo json_encode(array("没有该ID的Panel更新记录!",1));
		die;
} */
//通过后再进行添加操作
$data['ProductUpdateRecordID'] = $ProductUpdateRecordID;
$data['GeneID'] = $GeneID;

$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

$result_all = $mysql_obj->insertq("ProductGene",$data);

echo json_encode($result_all);
?>