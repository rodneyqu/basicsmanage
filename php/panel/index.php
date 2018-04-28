<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$PanelID = $_POST['PanelID'];

$ProjectID = $_POST['ProjectID'];
$PanelName_cn=$_POST['PanelName_cn'];
$PanelName_en=$_POST['PanelName_en'];
$CreateDate=$_POST['CreateDate'];
$LatestUpdateDate=$_POST['LatestUpdateDate'];

$where['PanelID'] = $PanelID;

$where['ProjectID'] = $ProjectID;
$where['PanelName_cnLIKE'] = $PanelName_cn;
$where['PanelName_enLIKE'] = $PanelName_en;
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

$result_all = $mysql_obj->getpageq("Panel",$where,$pageNum,$pageSize,null,$sqlwhere);

echo json_encode($result_all);

?>
