<?php
require_once(dirname(__FILE__).'../../../lib/init.php');
$ProductUpdateRecordID = $_POST['ProductUpdateRecordID'];

$ProductDescription=$_POST['ProductDescription'];
$ProductStatus=$_POST['ProductStatus'];
$Version = $_POST['Version'];
$ProductOnlineDate=$_POST['ProductOnlineDate'];
$ProductOfflineDate=$_POST['ProductOfflineDate'];
$VariantTypeID=$_POST['VariantTypeID'];

$where_ProductID['ProductUpdateRecordID'] = $ProductUpdateRecordID;
$find_Product = $mysql_obj->getpageq("ProductUpdateRecord",$where_PanelID);
$find_ProductID = $find_Product['data'][0]['ProductID'];
$where_nosame['ProductID'] = $find_ProductID;
$where_nosame['Version'] = $Version;
	
	$find_exits2 = $mysql_obj->getpageq("ProductUpdateRecord",$where_nosame);
	if($find_exits2['num'] > 1){
		echo json_encode($mysql_obj->return_array(2));
		die;
	}elseif($find_exits2['num'] == 1){
		if($find_exits2['data']['0']['ProductUpdateRecordID'] != $ProductUpdateRecordID){
			echo json_encode($mysql_obj->return_array(2));
			die;
		}
	}

$where['ProductUpdateRecordID'] = $ProductUpdateRecordID;

$data['ProductDescription'] = $ProductDescription;
$data['Version'] = $Version;
$data['ProductStatus'] = $ProductStatus;
$data['ProductOnlineDate'] = $ProductOnlineDate;
$data['ProductOfflineDate'] = $ProductOfflineDate;

$data['LatestUpdateDate'] = date("Y-m-d");

$result_all = $mysql_obj->updateq("ProductUpdateRecord",$data,$where);
if(is_array($result_all)){
	if($result_all['code'] != 0){
		echo json_encode($result_all);
		die;
	}
}

if(($VariantTypeID !== "") && ($VariantTypeID !== NULL)){//当填写了产品检测的变异类型
	$data_variant['VariantTypeID'] = $VariantTypeID;
	$where_variant['ProductUpdateRecordID'] = $ProductUpdateRecordID;
	$data_variant['LatestUpdateDate'] = $data['LatestUpdateDate'];
	$result_provartype = $mysql_obj->updateq("ProductVariantType",$data_variant,$where_variant);
	echo json_encode($result_provartype);
}else{
	echo json_encode($result_all);
}
?>
