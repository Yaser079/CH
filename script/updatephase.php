<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$phase=getPhase($data->Pid,$data->Sid);
$project=getProject($data->Pid);
if($phase==0)
{
    $sql="insert into phase_details ( project_id, phase_id, budget, hours) VALUES
 ('".$data->Pid."','".$data->Sid."','".$data->Budget."','".$data->Hours."'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." add Budget and Hours in Phase ".$data->Phase."  of project ( ".$project['code']."-".$project['name']." ).";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
}
else
{
    $sql="update phase_details set  budget='".$data->Budget."', hours='".$data->Hours."' where  project_id='".$data->Pid."' AND phase_id='".$data->Sid."' ";
       if (mysqli_query($conn,$sql))
       {
           
           $action=$_SESSION['name']." Update Budget and Hours in Phase ".$data->Phase."  of project ( ".$project['code']."-".$project['name']." ).";
           create_log($_SESSION['uid'],$action);
           echo "1";
       }
       else
       {
           echo "0";
           
       }
}


    
	mysqli_close($conn);
?>
