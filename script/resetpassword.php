<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$sql="update  users set password='".$_POST['pass']."' where ID='".$_POST['id'].";' ";
    if (mysqli_query($conn,$sql))
    {
        $user=getAuthUser($_POST['id']);
        $action=$user['name']." Reset his Password.";
        create_log($user['ID'],$action);
    	 $_SESSION['response']=22;
         header("Location:../index.php"); 
	}
    else
    {
        header("Location:../index.php"); 
    }
    
	mysqli_close($conn);
?>