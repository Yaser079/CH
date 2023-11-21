<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$others=getCurrentWeekLeavesOfStaff($data->Staff,$data->Week);
    if($others==0)
    {
        $sql="INSERT INTO other_leave( staff_id, week, VACATION, GENERAL, MARKETING, TRAINING, OFFICE, MEDICAL, REMARKS) VALUES
        ('".$data->Staff."','".$data->Week."','','','','','','','');";
        mysqli_query($conn,$sql);
    }
    $others=getCurrentWeekLeavesOfStaff($data->Staff,$data->Week);    
    $staff=getManager($data->Staff);
        $sql="update other_leave set ".$data->Name."='".$data->Hours."' where ID='".$others['ID']."';";
        if (mysqli_query($conn,$sql))
        {
            
            $action=$_SESSION['name']." add ".$data->Hours." hour of ".$staff['nick_name']."  ".$data->Name." Leaves in week  ".$data->Week.".";
            create_log($_SESSION['uid'],$action);
            echo "1";
        }
        else
        {
            echo "0";
            
        }



    
	mysqli_close($conn);
?>
