<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
//$office=getOffice($data->Office);
 $date=explode("-", $data->Date);
 $office=explode(" ", $data->Office);
 $orgDate = $date[0];
$date1 = str_replace('-', '/', $orgDate);
$newDate1 = date("d-M-Y", strtotime($date1));
 $firstday=explode("-", $newDate1) ;

$orgDate = $date[1];
$date1 = str_replace('-', '/', $orgDate);
$newDate2 = date("d-M-Y", strtotime($date1));
 
$date4=date_create($newDate1);
$date5=date_create($newDate2);
$diff=date_diff($date4,$date5);
$hours= ($diff->format("%a")+1)*8;
$monday=strtotime("monday this week", mktime(0,0,0, date('m',strtotime($firstday[2])), $firstday[0], $firstday[2]));
$week= date("d-M-Y",$monday);
$of="";
foreach($office as $value)
{
    if($value!="")
    {   
            $sql="insert into office_holidays (office_id, description,week,hours) VALUES ('".$value."','".$data->Des."','".$week."','".$hours."'); ";
            mysqli_query($conn,$sql);
            $sql="insert into holiday (description, date_des,hours,office_id) VALUES ('".$data->Des."','".$newDate1." - ".$newDate2."','".$hours."','".$value."'); ";
            mysqli_query($conn,$sql);
            $of.=getOffice($value)['code']." ";
    }
}

        
  $action=$_SESSION['name']." added a new Holiday of ".$hours." hours in week ".$week." at ".$of." Office.";
   create_log($_SESSION['uid'],$action);
   echo "1";
    


    
	mysqli_close($conn);
?>
