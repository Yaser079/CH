<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
 
$sql="insert into projects ( code, name, manager_id, country_id, profit, avg_rate, stage, status, office_id) VALUES
 ('".$data->Code."','".mysqli_real_escape_string($conn,$data->Name)."','".$data->Pm."','".$data->Country."','".$data->Profit."','".$data->Rate."','".$data->Stage."','".$data->Status."','".$data->Office."'); ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." created a new project ( ".$data->Code." -".$data->Name."  ) .";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
