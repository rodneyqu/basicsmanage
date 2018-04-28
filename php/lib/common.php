<?php
/*
* Rodney
* 常用公共函数
*/

//Rodney 
/**
 * @param $birthday 出生年月日（1992-1-3）
 * @return string 年龄
 */
function countage($birthday){
    $year=date('Y');
    $month=date('m');
    if(substr($month,0,1)==0){
        $month=substr($month,1);
    }
    $day=date('d');
    if(substr($day,0,1)==0){
        $day=substr($day,1);
    }
    $arr=explode('-',$birthday);

    $age=$year-$arr[0];
    if($month<$arr[1]){
        $age=$age-1;

    }elseif($month==$arr[1]&&$day<$arr[2]){
        $age=$age-1;

    }

    return $age;

}

?>