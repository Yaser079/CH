<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
$id=$_GET["id"];
$sql="select * from users where ID='".$id."';";
	$result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
 $sql="delete FROM users where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    
        $action=$_SESSION['name']." deleted  ".$row['name']." Account..";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>