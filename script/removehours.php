<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$week=getProjectResource($id);
$project=getProject($week['pid']);
$staff=getManager($week['staff_id']);
 $sql="delete FROM resource_weeks where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    
        $action=$_SESSION['name']." remove ".$week['hours']." hours from week ".$week['week']." of ".$staff['nick_name']." in project ( ".$project['code']." -".$project['name']." ) ";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>