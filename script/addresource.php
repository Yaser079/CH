<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$project=getProject($data->Pid);
$staff=getManager($data->Res);
$sql="insert into project_resource ( pid,staff_id) VALUES
 ('".$data->Pid."','".$data->Res."'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." add ".$staff['nick_name']." as new resource to ( ".$project['code']." -".$project['name']." ) .";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
