<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
$id=$_GET["id"];
$sql="select * from projects where ID='".$id."';";
	$result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
 $sql="delete FROM projects where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $sql="delete FROM phase_details where project_id='".$id."';";
    
        $action=$_SESSION['name']." deleted ".$row['code']."-".$row['name']." project..";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>