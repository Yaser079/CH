<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$job=getStaffJob($id);
 $sql="delete FROM staff_job where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $jobb=getJob($job['job_id']);
    $staff=getManager($job['staff_id']);
    $action=$_SESSION['name']." remove ".$jobb['name']." from staff ".$staff['nick_name']." .";
    create_log($_SESSION['uid'],$action);
    $sql2="select * from staff_job where staff_id='".$job['staff_id']."'";
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
             
    
}

mysqli_close($conn);
?>