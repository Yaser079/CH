<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
$sql="update  users set 
    password='".$_POST['pass']."' where ID='".$_SESSION['uid'].";' ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." updated their Password.";
        create_log($_SESSION['uid'],$action);
    	 $_SESSION['response']=11;
         header("Location:../Admin/profile.php"); 
	}
    else
    {
        $_SESSION['response']=0;
        header("Location:../Admin/profile.php"); 
        
    }
    
	mysqli_close($conn);
?>