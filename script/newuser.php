<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
$sql="insert into users ( email, password, name, phone, office, picture, status, users) VALUES
 ('".$data->Email."','".$data->Password."','".$data->Name."','".$data->Phone."','".$data->Country."','avatar.png','1','".$data->Admin."'); ";
    if (mysqli_query($conn,$sql))
    {
        $uid=mysqli_insert_id($conn);
        $role=1;
        if($data->Admin==1)
        {
            $role=1;
        }
        else
        {
            $role=3;
        }
        $sql="insert into staff ( name,nick_name,role_id,office,status,uid) VALUES
        ('".$data->Name."','".$data->Name."','".$role."','".$data->Country."','1','".$uid."'); ";
           mysqli_query($conn,$sql);
          
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
