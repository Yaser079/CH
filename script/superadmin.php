<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update users set users='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $sql="select * from users where ID='".$id."';";
	$result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if($q=="0")
    {
        $action=$_SESSION['name']." remove ".$row['name']." from Super Admin.";
    }
    else
    {
        $action=$_SESSION['name']." make ".$row['name']." Super Admin.";
    }
        
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>