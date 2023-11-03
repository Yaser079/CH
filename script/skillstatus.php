<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$q=$_GET["q"];
$id=$_GET["id"];
$status='';
 $sql="update skill set status='".$q."' where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $skill=getSkill($id);
    if($q=="0")
    {
        $action=$_SESSION['name']." disable ".$skill['name']." Skill.";
    }
    else
    {
        $action=$_SESSION['name']." enable ".$skill['name']." Skill.";
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