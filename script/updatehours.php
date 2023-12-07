<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$project=getProject($data->Pid);
$staff=getManager($data->Sid);
if(getResourceWeek($data->Pid,$data->Sid,$data->Week)!="")
{
    $sql="update resource_weeks set hours='".$data->Hours."' where pid='".$data->Pid."' AND  staff_id='".$data->Sid."' AND week='".$data->Week."' ;";
}
else{
    
    $sql="insert into resource_weeks ( pid,staff_id,hours,week) VALUES
 ('".$data->Pid."','".$data->Sid."','".$data->Hours."','".$data->Week."'); ";
}
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." add ".$data->Hours." hours of ".$staff['nick_name']." in week ".$data->Week." in project ( ".$project['code']." -".$project['name']." ) .";
        create_log($_SESSION['uid'],$action);
        $project=getProject($data->Pid);
        $staffHours=getStaffHours($data->Pid,$data->Sid);
        $hours=gethours($data->Pid);
        $budgthour=getbudgetHours($data->Pid);
        $remaining=$hours-($budgthour+(int)$project['minus_hours']);
        $data = [ 'rh' => $remaining, 'bh' => $budgthour ,'sh'=>$staffHours];
        header('Content-type: application/json');
        echo json_encode( $data );
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
