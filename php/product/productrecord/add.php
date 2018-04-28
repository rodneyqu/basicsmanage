<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$ProductID = $_POST['ProductID'];
$ProductDescription=$_POST['ProductDescription'];
$ProductStatus=$_POST['ProductStatus'];
$Version = $_POST['Version'];
$ProductOnlineDate=$_POST['ProductOnlineDate'];
$ProductOfflineDate=$_POST['ProductOfflineDate'];

//$insert_nums = 0;
$VariantTypeID = $_POST['VariantTypeID'];
/* if(($VariantTypeID !== "") && ($VariantTypeID !== NULL)){//当填写了产品检测的变异类型
	$where_variant['VariantTypeID'] = $VariantTypeID;
	$find_VarianteType = $mysql_obj->selectq("VariantType",array("VariantTypeID"),$where_variant);
	if(!$find_VarianteType){
		echo json_encode(array("没有该ID的变异类型!",1));
		die;
	}
	$insert_nums ++;
} */

$where_nosame['ProductID'] = $PanelID;
$where_nosame['Version'] = $Version;
$find_same = $mysql_obj->getpageq("ProductUpdateRecord",$where_nosame);
if($find_same['num'] > 0){
	echo json_encode(array('code'=>2,'info'=>'条目重复'));
	die;
}


$data['ProductID'] = $ProductID;
$data['ProductDescription'] = $ProductDescription;
$data['ProductStatus'] = $ProductStatus;
$data['Version'] = $Version;
$data['ProductOnlineDate'] = $ProductOnlineDate;
$data['ProductOfflineDate'] = $ProductOfflineDate;

$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];

if(($VariantTypeID !== "") && ($VariantTypeID !== NULL)){
		$result_all = $mysql_obj->insertq("ProductUpdateRecord",$data,1);//这里传参1表示要返回id
		if($result_all['code'] != 999){
		echo json_encode($result_all);
		die;
	}else{
		$data_variant['VariantTypeID'] = $VariantTypeID;
		$data_variant['ProductUpdateRecordID'] = $result_all['info'];
		$data_variant['CreateDate'] = date("Y-m-d");
		$data_variant['LatestUpdateDate'] = $data_variant['CreateDate'];
		$result_provartype = $mysql_obj->insertq("ProductVariantType",$data_variant);
		echo json_encode($result_provartype);
	
	}
}else{
	$result_all = $mysql_obj->insertq("ProductUpdateRecord",$data);//这里传参1表示要返回id
	echo json_encode($result_all);
	
}

?>
