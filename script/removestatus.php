<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$status=getStatus($id);
 $sql="delete FROM project_status where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    
        $action=$_SESSION['name']." remove project Status ".$status['name']." from list.";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>