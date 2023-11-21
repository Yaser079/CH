<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
$sql="update projects  set 
 code='".$data->Code."', name='".mysqli_real_escape_string($conn,$data->Name)."', manager_id='".$data->Pm."', country_id='".$data->Country."', profit='".$data->Profit."',
  avg_rate='".$data->Rate."', stage='".$data->Stage."', status='".$data->Status."', office_id='".$data->Office."',deadline='".$data->Deadline."' where ID='".$data->ID."' ;  ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." update project details ( ".$data->Code."-".$data->Name." ) .";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
