<?php
session_start();
 
include '../Inc/DBcon.php';
include 'log.php';
$sql="insert into users ( email, password, name, phone, office, picture, status, users) VALUES
 ('".$_POST['email']."','".$_POST['pass']."','".$_POST['name']."','".$_POST['phone']."','".$_POST['office']."','avatar.png','1','0'); ";
    if (mysqli_query($conn,$sql))
    {
        $uid=mysqli_insert_id($conn);
        $role=3;
        $sql="insert into staff ( name,nick_name,role_id,office,status,uid) VALUES
        ('".$_POST['name']."','".$_POST['name']."','".$role."','".$_POST['office']."','1','".$uid."'); ";
           mysqli_query($conn,$sql);
          
        $action="Created new account under name ( ".$_POST['name']." ).";
        create_log($uid,$action);
        $_SESSION['response']="true";
     header('location:../register.php?response=true');
	}
    else
    {
        header('location:../register.php?response=false');
        
    }
	mysqli_close($conn);
?>
