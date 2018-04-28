<?php
require_once(dirname(__FILE__).'../../../lib/init.php');

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$ProductID = $_POST['ProductID'];
$ProductUpdateRecordID = $_POST['ProductUpdateRecordID'];

$where['ProductID'] = $ProductID;
$where['ProductUpdateRecordID'] = $ProductUpdateRecordID;

$sqlwhere = null;

$result_all = $mysql_obj->getpageq("ProductUpdateRecord",$where,$pageNum,$pageSize,null,$sqlwhere);
if(!empty($result_all['data']) && (is_array($result_all['data']))){
	foreach($result_all['data'] as $k =>$v){
		$VariantType_result = '';
		$VariantID_result = '';
			$where_variantid['ProductUpdateRecordID'] = $v['ProductUpdateRecordID'];
			$find_variantid = $mysql_obj->selectq('ProductVariantType',array('VariantTypeID'),$where_variantid);
			$VariantID_result = $find_variantid[0]['VariantTypeID'];
			if(($find_variantid[0]['VariantTypeID'] !== NULL) && ($find_variantid[0]['VariantTypeID'] !== "")){
				$where_variant['VariantTypeID'] = $find_variantid[0]['VariantTypeID'];
				$find_variant = $mysql_obj->selectq('VariantType',array('VariantType'),$where_variant);
				$VariantType_result = $find_variant[0]['VariantType'];
			}
		$result_all['data'][$k]['VariantType'] = $VariantType_result;
		$result_all['data'][$k]['VariantTypeID'] = $VariantID_result;
	}
}
echo json_encode($result_all);

?>
