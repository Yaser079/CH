<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update users set status='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $sql="select * from users where ID='".$id."';";
	$result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if($q=="0")
    {
        $action=$_SESSION['name']." disable ".$row['name']." Account.";
    }
    else
    {
        $action=$_SESSION['name']." enable ".$row['name']." Account.";
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