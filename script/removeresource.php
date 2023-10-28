<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$name=$_GET['name'];
$proj=getProject($_GET['pid']);
 $sql="delete FROM project_resource where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $sql="delete FROM resource_weeks where staff_id='".$_GET["sid"]."' AND pid='".$_GET['pid']."';";
    mysqli_query($conn,$sql);
        $action=$_SESSION['name']." remove resource ".$name." from project ( ".$proj['code']."-".$proj['name']." )";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>