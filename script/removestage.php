<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$stage=getWeekFullStage($id);
$project=getProject($stage['pid']);
$phase=getStage($stage['stage_id']);
 $sql="delete FROM resource_stage where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    
        $action=$_SESSION['name']." remove ".$phase['short_name']." stage from week ".$stage['week']." in project ( ".$project['code']." -".$project['name']." ) ";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>