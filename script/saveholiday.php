<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$office=getOffice($data->Office);
if($data->Type==0)
{
    $sql="insert into office_holidays (office_id, description,week,hours) VALUES
 ('".$data->Office."','".$data->Des."','".$data->Week."','".$data->Hours."'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." added a new Holiday of ".$data->Hours." hours in week ".$data->Week." at ".$office['code']." Office.";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
}
else
{
    $sql="update office_holidays  set description='".$data->Des."',hours='".$data->Hours."' where ID='".$data->Type."';";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." update Holiday of ".$data->Hours." hours in week ".$data->Week." at ".$office['code']." Office.";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
}

    
	mysqli_close($conn);
?>
