<?php
require_once(dirname(__FILE__).'../../lib/init.php');
$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$ProductID = $_POST['ProductID'];

$ProductName_en=$_POST['ProductName_en'];
$ProductName_cn=$_POST['ProductName_cn'];
$CreateDate=$_POST['CreateDate'];
$LatestUpdateDate=$_POST['LatestUpdateDate'];


$where['ProductID'] = $ProductID;

$where['ProductName_enLIKE'] = $ProductName_en;
$where['ProductName_cnLIKE'] = $ProductName_cn;


$sqlwhere = null;

if(!($CreateDate === '') && !($CreateDate === null)){//当查找条件包含创建时间时进行特殊处理
	$sqlwhere = 'CreateDate >='.'"'.$CreateDate[0].'"'.' AND CreateDate <='.'"'.$CreateDate[1].'"';
}
if(!($LatestUpdateDate === '') && !($LatestUpdateDate === null)){
	if($sqlwhere ===null){
		$sqlwhere = 'LatestUpdateDate >='.'"'.$LatestUpdateDate[0].'"'.' AND LatestUpdateDate <='.'"'.$LatestUpdateDate[1].'"';
	}else{
		$sqlwhere .= 'AND LatestUpdateDate >='.'"'.$LatestUpdateDate[0].'"'.' AND LatestUpdateDate <='.'"'.$LatestUpdateDate[1].'"';
	}	
}

/* $joinsql = "SELECT c.*,d.PanelName_cn FROM (SELECT a.*,b.Version,b.PanelID FROM Product a LEFT JOIN PanelUpdateRecord b ON a.PanelUpdateRecordID=b.PanelUpdateRecordID  ) c LEFT JOIN Panel d ON c.PanelID = d.PanelID";
$result_all = $mysql_obj->querySql($joinsql); */
$result_all = $mysql_obj->getpageq("Product",$where,$pageNum,$pageSize,null,$sqlwhere);
if(!empty($result_all['data']) && (is_array($result_all['data']))){
	foreach($result_all['data'] as $k =>$v){
			$PanelName_cn_result = '';
			$Version_result = '';
			if(($v['PanelUpdateRecordID'] !== NULL) && ($v['PanelUpdateRecordID'] !== "")){
				$where_paneluprecord['PanelUpdateRecordID'] = $v['PanelUpdateRecordID'];
				$find_panelVs = $mysql_obj->selectq('PanelUpdateRecord',array('Version','PanelID'),$where_paneluprecord);
				$Version_result = $find_panelVs[0]['Version'];
				if(($find_panelVs[0]['PanelID'] !== NULL) && ($find_panelVs[0]['PanelID'] !== "")){
					$where_panelname_cn['PanelID'] = $find_panelVs[0]['PanelID'];
					$find_panelName_cn = $mysql_obj->selectq('Panel',array('PanelName_cn'),$where_panelname_cn);
					$PanelName_cn_result = $find_panelName_cn[0]['PanelName_cn'];			
				}
			}
			$result_all['data'][$k]['PanelName_cn'] = $PanelName_cn_result;
			$result_all['data'][$k]['Version'] = $Version_result;
	}
} 
echo json_encode($result_all);
?>
