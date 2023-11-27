<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
if($data->Type==0)
{
    $role=1;
        if($data->Role==1)
        {
            $role=1;
        }
        else
        {
            $role=3;
        }
    $sql="insert into users ( email, password, name, phone, office, picture, status, users) VALUES
 ('".$data->Email."','".$data->Nick."','".$data->Name."','".$data->Phone."','".$data->Office."','avatar.png','1','".$role."'); ";
    if (mysqli_query($conn,$sql))
    {   
        $uid=mysqli_insert_id($conn);
        $sql="insert into staff ( name,nick_name,role_id,office,status,uid) VALUES
        ('".$data->Name."','".$data->Nick."','".$data->Role."','".$data->Office."','1','".$uid."'); ";
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
 
}
else
{
    $sql="update staff set name='".$data->Name."' ,nick_name='".$data->Nick."',role_id='".$data->Role."',office='".$data->Office."'  where ID='".$data->Type."';";
    if (mysqli_query($conn,$sql))
    {   
        $user=getManager($data->Type);
        $sql="update users set office='".$data->Office."' ,name='".$data->Name."'  where ID='".$user['uid']."';";
        mysqli_query($conn,$sql);
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
