<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update role set status='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $role=getRole($id);
    if($q=="0")
    {
        $action=$_SESSION['name']." disable ".$role['name']." Role.";
    }
    else
    {
        $action=$_SESSION['name']." enable ".$role['name']." Role.";
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