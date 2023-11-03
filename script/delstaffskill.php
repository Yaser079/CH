<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$_GET["id"];
$skill=getStaffSkills($id);
 $sql="delete FROM staff_skill where ID='".$id."';";
if(mysqli_query($conn,$sql))
{
    $skil=getSkill($skill['skill_id']);
    $staff=getManager($skill['staff_id']);
    $action=$_SESSION['name']." remove ".$skil['name']." from staff ".$staff['nick_name']." .";
    create_log($_SESSION['uid'],$action);

    $sql2="select * from staff_skill where staff_id='".$skill['staff_id']."'";
    $result=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result) > 0 )
    {
        while($row = mysqli_fetch_array($result))
        {       
            $skil=getSkill($row['skill_id']);
            echo '<span class="badge badge-info fs-1">'.$skil['name'].' &nbsp; 
                    <a href="javascript:void(0)" onclick="DeleteSkill('.$row['ID'].')">
                            <i class="nav-icon fas fa-trash text-white"></i>
                    </a>
                    </span>&nbsp;';    
        }
    }
    
}

mysqli_close($conn);
?>