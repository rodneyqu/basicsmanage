<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
$NucleicAcidID = $_POST['NucleicAcidID'];
$BiospeciemensID = $_POST['BiospeciemensID'];

$NucleicAcidSGIID=$_POST['NucleicAcidSGIID'];//核酸公司编号
$NAExtractionAmount=$_POST['NAExtractionAmount'];//核酸提取用量(范围)
$NAVolume=$_POST['NAVolume'];//核酸体积(范围)
$NAConc=$_POST['NAConc'];//核酸浓度(范围)
$NAAmount=$_POST['NAAmount'];//核酸总量(范围)
$NAQuality=$_POST['NAQuality'];//核酸质量
$Status=$_POST['Status'];//状态

$NAExtractionDate=$_POST['NAExtractionDate'];//核酸提取日期(范围)
$Name=$_POST['Name'];//提取人

listNucleicAcids($NucleicAcidID,$pageNum,$pageSize,$BiospeciemensID,$NucleicAcidSGIID,$NAExtractionAmount,$NAExtractionDate,$NAVolume,$NAConc,$NAAmount,$NAQuality,$Status,$Name);
	
function listNucleicAcids($NucleicAcidID,$pageNum,$pageSize,$BiospeciemensID,$NucleicAcidSGIID,$NAExtractionAmount,$NAExtractionDate,$NAVolume,$NAConc,$NAAmount,$NAQuality,$Status,$Name){
	global $mysql_obj;
	$sqlwhere = null;
	if(($Name === '') ||($Name === null)){
		$isname = 1;
	}else{
		$isname = 0;
	}
	if(!($NAExtractionDate === '') && !($NAExtractionDate === null)){//当查找条件包含创建时间时进行特殊处理
		if($isname ===1){
			$sqlwhere = 'NAExtractionDate >='.'"'.$NAExtractionDate[0].'"'.' AND NAExtractionDate <='.'"'.$NAExtractionDate[1].'"';
		}else{
			$sqlwhere = 'c.NAExtractionDate >='.'"'.$NAExtractionDate[0].'"'.' AND c.NAExtractionDate <='.'"'.$NAExtractionDate[1].'"';
		}
	}
	$where['NucleicAcidID'] = $NucleicAcidID;
	$where['BiospeciemensID'] = $BiospeciemensID;
	
	$where['NameLIKE'] = $Name;
	
	$where['NucleicAcidSGIID']=$NucleicAcidSGIID;
	$where['NAExtractionAmount']=$NAExtractionAmount;
	$where['NAVolume']=$NAVolume;
	$where['NAConc']=$NAConc;
	$where['NAAmount']=$NAAmount;
	$where['NAQuality']=$NAQuality;
	$where['Status'] = $Status;
	if($isname === 1){
		$result_all = $mysql_obj->getpageq("NucleicAcids",$where,$pageNum,$pageSize,null,$sqlwhere);
		if(!empty($result_all['data']) && (is_array($result_all['data']))){
			foreach($result_all['data'] as $k =>$v){
				$Name = '';
				if(($v['NAExtractionManipulatorID'] !== NULL) && ($v['NAExtractionManipulatorID'] !== "")){
					$where_employee['EmployeeID'] = $v['NAExtractionManipulatorID'];
					$Employee = $mysql_obj->selectq('Employee',array('FirstName','MiddleName','LastName'),$where_employee);
					$Name = $Employee[0]['LastName'].$Employee[0]['MiddleName'].$Employee[0]['FirstName'];
				}		
				$result_all['data'][$k]['Name'] = $Name;
			}
		}
	}else{
		foreach($where as $k => $v){
				if(!($v === '') && !($v === null)){					
							if($sqlwhere === null){
								if(substr($k,-4) === "LIKE"){
									$kr = substr($k,0,-4);
									$sqlwhere .= 'c.'.$kr .' LIKE '. '"%'.addslashes($v).'%"';
								}else{
									$sqlwhere .= 'c.'.$k.'='.'"'.addslashes($v).'"'; 
								}
							}else{
								if(substr($k,-4) === "LIKE"){
									$kr = substr($k,0,-4);
									$sqlwhere .= ' AND c.'.$kr .' LIKE '. '"%'.addslashes($v).'%"';
								}else{
									$sqlwhere .= ' AND c.'.$k.'='.'"'.addslashes($v).'"';
								}
							
							}						
				}
		}
		if(($pageNum ==='') ||($pageNum === null)){
			$pageNum = 1;
		}
		if(($pageSize ==='') ||($pageSize === null)){
			$pageSize = 10;
		}
		$begin_position = ($pageNum-1)*$pageSize;
		$sql_limit .= " limit {$begin_position},{$pageSize}"; 
		$query_sql = "SELECT * FROM (SELECT na.*,CONCAT(LastName,MiddleName,FirstName) as Name FROM NucleicAcids na LEFT JOIN Employee ep ON na.NAExtractionManipulatorID = ep.EmployeeID) c WHERE ".$sqlwhere.$sql_limit;
		$query_sql_num = "SELECT COUNT(NucleicAcidID) as nums FROM (SELECT na.*,CONCAT(LastName,MiddleName,FirstName) as Name FROM NucleicAcids na LEFT JOIN Employee ep ON na.NAExtractionManipulatorID = ep.EmployeeID) c WHERE ".$sqlwhere;
		$result = $mysql_obj->querySql($query_sql);
		$nums =  $mysql_obj->querySql($query_sql_num);
		$result_all=array('data'=>$result,'num'=>$nums[0][nums]);
	}
	
	
	echo json_encode($result_all);
}
	
?>
