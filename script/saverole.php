<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
if($data->Type==0)
{
    $sql="insert into role ( name,status) VALUES
 ('".$data->Name."','1'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." added a new Role ( ".$data->Name." ).";
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
    $sql="update role  set name='".$data->Name."' where ID='".$data->Type."';";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." update a role ( ".$data->Name." ).";
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
