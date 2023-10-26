<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
$sql="update  users set 
    email='".$data->Email."',
    password='".$data->Password."',
    name='".$data->Name."', 
    phone='".$data->Phone."',
    office='".$data->Country."'
    where ID='".$data->ID."' ;";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." update data of user ( ".$data->Name." ).";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
