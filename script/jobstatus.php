<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update job set status='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $job=getJob($id);
    if($q=="0")
    {
        $action=$_SESSION['name']." disable ".$job['name']." Job Tile.";
    }
    else
    {
        $action=$_SESSION['name']." enable ".$job['name']." Job Tile.";
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