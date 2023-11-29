<?php
session_start();
$data = json_decode(file_get_contents("php://input"));
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$sql="update  projects set deadline='".$data->Deadline."' where ID='".$data->Pid.";' ";
    if (mysqli_query($conn,$sql))
    {
        $project=getProject($data->Pid);
        $action=$_SESSION['name']." update Project Deadline ( ".$project['code']."-".$project['name']." ).";
        create_log($_SESSION['uid'],$action);
    	  echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>