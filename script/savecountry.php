<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
if($data->Type==0)
{
    $sql="insert into country ( name,tag,color,status) VALUES
 ('".$data->Name."','".$data->Tag."','".$data->Color."','1'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." added a new Country ( ".$data->Name." ).";
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
    $sql="update country  set name='".$data->Name."',tag='".$data->Tag."',color='".$data->Color."' where ID='".$data->Type."';";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." update a country ( ".$data->Name." ).";
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
