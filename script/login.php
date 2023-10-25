<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
$sql="select * from users where email='".$data->username."' AND password='".$data->password."' AND status='1' ;";
	$result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['uid']=$row['ID'];
        $_SESSION['name']=$row['name'];
        $_SESSION['admin']=$row['users'];
        $action=$row['name']." Logged in.";
        create_log($row['ID'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>