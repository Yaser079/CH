<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$project=getProject($data->Pid);
$stage=getStage($data->Stage);
if(getResourceStageWeek($data->Pid,$data->Week)!="")
{
    $sql="update resource_stage set stage_id='".$data->Stage."' where pid='".$data->Pid."' AND  week='".$data->Week."' ;";
}
else{
    $sql="insert into resource_stage ( pid,stage_id,week) VALUES
 ('".$data->Pid."','".$data->Stage."','".$data->Week."'); ";
}
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." add ".$stage['short_name']." in week ".$data->Week." in project ( ".$project['code']." -".$project['name']." ) .";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
