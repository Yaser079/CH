<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update country set status='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $country=getCountry($id);
    if($q=="0")
    {
        $action=$_SESSION['name']." disable ".$country['name']." country.";
    }
    else
    {
        $action=$_SESSION['name']." enable ".$country['name']." country.";
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