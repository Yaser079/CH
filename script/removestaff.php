<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$staff=getManager($id);
 $sql="delete FROM staff where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
        $sql="delete FROM staff_skill where staff_id='".$id."';";
        mysqli_query($conn,$sql);
        $action=$_SESSION['name']." remove staff ".$staff['nick_name']." from list.";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>