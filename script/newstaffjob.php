<?php
session_start();
 

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';

    $sql="insert into staff_job ( staff_id,job_id) VALUES
 ('".$_GET['id']."','".$_GET['job']."'); ";
    if (mysqli_query($conn,$sql))
    {
        $staff=getManager($_GET['id']);
        $job=getJob($_GET['job']);
        $action=$_SESSION['name']." set a new job ( ".$job['name']." ) to ( ".$staff['nick_name']." ).";
        create_log($_SESSION['uid'],$action);
    	 
	}
 
    $sql2="select * from staff_job where staff_id='".$_GET['id']."';";
    $result=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result) > 0 )
    {
        while($row = mysqli_fetch_array($result))
        {       
            $job=getJob($row['job_id']);
            echo '<span class="badge badge-info fs-1">'.$job['name'].' &nbsp; 
                    <a href="javascript:void(0)" onclick="DeleteJobs('.$row['ID'].')">
                            <i class="nav-icon fas fa-trash text-white"></i>
                    </a>
                 </span>&nbsp;';    
        }
    }
 
    
	mysqli_close($conn);
?>
