<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
if($data->Type==0)
{
    $sql="insert into staff ( name,nick_name,role_id,office,status) VALUES
 ('".$data->Name."','".$data->Nick."','".$data->Role."','".$data->Office."','1'); ";
    if (mysqli_query($conn,$sql))
    {
        $office=getOffice($data->Office);
        $action=$_SESSION['name']." added a new Staff ( ".$data->Name." in office ".$office['code']." ).";
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
    $sql="update staff set name='".$data->Name."' ,nick_name='".$data->Nick."',role_id='".$data->Role."',office='".$data->Office."'  where ID='".$data->Type."';";
    if (mysqli_query($conn,$sql))
    {
        $office=getOffice($data->Office);
        $action=$_SESSION['name']." update a Staff ( ".$data->Name." in office ".$office['code']." ).";
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
