<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$sql="select * from users where email='".$data->username."' AND password='".$data->password."' AND status='1' ;";
	$result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['uid']=$row['ID'];
        $_SESSION['name']=$row['name'];
        $_SESSION['admin']=$row['users'];
        $_SESSION['picture']=$row['picture'];
        $_SESSION['nav']='dashboard';
        $action=$row['name']." Logged in.";
        $_SESSION['body']="hold-transition sidebar-mini pace-white accent-primary text-sm sidebar-collapse";
        $time = date('d-M',strtotime('monday this week'));
        $_SESSION['weekly-resource']=$time;
        $_SESSION['current-week']=$time;
        $_SESSION['role']=getUserStaff($row['ID'])['role_id'];
        create_log($row['ID'],$action);
        
    	echo $_SESSION['role'];
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>