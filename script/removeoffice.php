<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$country=getOffice($id);
 $sql="delete FROM office where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    
        $action=$_SESSION['name']." remove office ".$country['name']." from list.";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>