<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$holiday=getOfficeHolidays($id);
$office=getOffice($holiday['office_id']);
 $sql="delete FROM office_holidays where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    
        $action=$_SESSION['name']." remove ".$holiday['hours']." hours Holiday of ".$holiday['week']." week at ".$office['code']." Office.";
        create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>