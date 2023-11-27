<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$project=getProject($data->ID);
 $new_id=0;
if($data->CR!="")
{
    $sql="INSERT INTO project_review( name,status) VALUES
     ('".$data->CR."','1');";
     mysqli_query($conn,$sql);
     $new_id=mysqli_insert_id($conn);
     $sql="INSERT INTO projects_update( pid, week, status, comments) VALUES
     ('".$data->ID."','".$_SESSION['current-week']."','".$new_id."','".$data->Cmnt."');";
}
else{
    $sql="INSERT INTO projects_update( pid, week, status, comments) VALUES
    ('".$data->ID."','".$_SESSION['current-week']."','".$data->Rew."','".$data->Cmnt."');";
}
    
    if (mysqli_query($conn,$sql))
    {   
        
        $action=$_SESSION['name']." add new Review of week ".$_SESSION['current-week']." of project ( ".$project['code']."-".$project['name']." ).";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }


    
	mysqli_close($conn);
?>
