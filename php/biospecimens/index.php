<?php
require_once(dirname(__FILE__).'../../lib/init.php');

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
$MolDiagnosisID = $_POST['MolDiagnosisID'];
$BiospeciemensID = $_POST['BiospeciemensID'];

$SampleSGIID=$_POST['SampleSGIID'];//样本公司编号
$PathologicNumber = $_POST['PathologicNumber'];//病理编号
$SampleType=$_POST['SampleType'];//样本类型
$Site=$_POST['Site'];//取样部位

$SamplingDate=$_POST['SamplingDate'];//取样日期(范围)
$ReceivedDate=$_POST['ReceivedDate'];//收样日期(范围)
$Name =$_POST['Name'];//收样人姓名(拼接)

$IsTumorCell=$_POST['IsTumorCell'];//是否肿瘤细胞
$TumorCellContent=$_POST['TumorCellContent'];//肿瘤细胞含量
$Quantity=$_POST['Quantity'];//样本量

listBiospeciemens($MolDiagnosisID,$pageNum,$pageSize,$BiospeciemensID,$SampleSGIID,$PathologicNumber,$SampleType,$Site,$SamplingDate,$ReceivedDate,$Name,$IsTumorCell,$TumorCellContent,$Quantity);
	
function listBiospeciemens($MolDiagnosisID,$pageNum,$pageSize,$BiospeciemensID,$SampleSGIID,$PathologicNumber,$SampleType,$Site,$SamplingDate,$ReceivedDate,$Name,$IsTumorCell,$TumorCellContent,$Quantity){
	global $mysql_obj;
	$sqlwhere = null;
	if(($Name === '') ||($Name === null)){
		$isname = 1;
	}else{
		$isname = 0;
	}
	
	if(!($SamplingDate === '') && !($SamplingDate === null)){//当查找条件包含创建时间时进行特殊处理
		if($isname ===1){
			$sqlwhere = 'SamplingDate >='.'"'.$SamplingDate[0].'"'.' AND SamplingDate <='.'"'.$SamplingDate[1].'"';
		}else{
			$sqlwhere = 'c.SamplingDate >='.'"'.$SamplingDate[0].'"'.' AND c.SamplingDate <='.'"'.$SamplingDate[1].'"';
		}
	}
	if(!($ReceivedDate === '') && !($ReceivedDate === null)){//当查找条件包含创建时间时进行特殊处理
		if($sqlwhere ===null){
			if($isname ===1){
				$sqlwhere = 'ReceivedDate >='.'"'.$ReceivedDate[0].'"'.' AND ReceivedDate <='.'"'.$ReceivedDate[1].'"';
			}else{
				$sqlwhere = 'c.ReceivedDate >='.'"'.$ReceivedDate[0].'"'.' AND c.ReceivedDate <='.'"'.$ReceivedDate[1].'"';
			}
		}else{
			if($isname ===1){
				$sqlwhere = 'AND ReceivedDate >='.'"'.$ReceivedDate[0].'"'.' AND ReceivedDate <='.'"'.$ReceivedDate[1].'"';
			}else{
				$sqlwhere = 'AND c.ReceivedDate >='.'"'.$ReceivedDate[0].'"'.' AND c.ReceivedDate <='.'"'.$ReceivedDate[1].'"';
			}		
		}
	}
	$where['NameLIKE'] = $Name;
	
	$where['SampleSGIID']=$SampleSGIID;
	$where['PathologicNumber']=$PathologicNumber;
	$where['SampleType']=$SampleType;
	$where['Site']=$Site;
	$where['IsTumorCell']=$IsTumorCell;
	$where['TumorCellContent']=$TumorCellContent;
	$where['Quantity']=$Quantity;
	
	$where['MolDiagnosisID'] = $MolDiagnosisID;
	$where['BiospeciemensID'] = $BiospeciemensID;
	
	if($isname === 1){
		$result_all = $mysql_obj->getpageq("Biospecimens",$where,$pageNum,$pageSize,null,$sqlwhere);
		if(!empty($result_all['data']) && (is_array($result_all['data']))){
		foreach($result_all['data'] as $k =>$v){
			$Name = '';
			if(($v['RecipientsID'] !== NULL) && ($v['RecipientsID'] !== "")){
				$where_employee['EmployeeID'] = $v['RecipientsID'];
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
		$query_sql = "SELECT * FROM (SELECT bs.*,CONCAT(LastName,MiddleName,FirstName) as Name FROM Biospecimens bs LEFT JOIN Employee ep ON bs.RecipientsID = ep.EmployeeID) c WHERE ".$sqlwhere.$sql_limit;
		$query_sql_num = "SELECT COUNT(BiospeciemensID) as nums FROM (SELECT bs.*,CONCAT(LastName,MiddleName,FirstName) as Name FROM Biospecimens bs LEFT JOIN Employee ep ON bs.RecipientsID = ep.EmployeeID) c WHERE ".$sqlwhere;
		$result = $mysql_obj->querySql($query_sql);
		$nums =  $mysql_obj->querySql($query_sql_num);

		$result_all=array('data'=>$result,'num'=>$nums[0][nums]);
	}
	echo json_encode($result_all);
}
	
?>
