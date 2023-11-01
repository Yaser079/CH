<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update project_phase set status='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $stage=getStage($id);
    if($q=="0")
    {
        $action=$_SESSION['name']." disable ".$stage['short_name']." Phase.";
    }
    else
    {
        $action=$_SESSION['name']." enable ".$stage['short_name']." Phase.";
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