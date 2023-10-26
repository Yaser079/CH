<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
$sql="insert into users ( email, password, name, phone, office, picture, status, users) VALUES
 ('".$data->Email."','".$data->Password."','".$data->Name."','".$data->Phone."','".$data->Country."','avatar.png','1','".$data->Admin."'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." created a new user ( ".$data->Name." ).";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
