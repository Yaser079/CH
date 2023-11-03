<?php
session_start();
 

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';

    $sql="insert into staff_skill ( staff_id,skill_id) VALUES
 ('".$_GET['id']."','".$_GET['skill']."'); ";
    if (mysqli_query($conn,$sql))
    {
        $staff=getManager($_GET['id']);
        $skill=getSkill($_GET['skill']);
        $action=$_SESSION['name']." set a new skill ( ".$skill['name']." ) to ( ".$staff['nick_name']." ).";
        create_log($_SESSION['uid'],$action);
    	 
	}
    $sql2="select * from staff_skill where staff_id='".$_GET['id']."'";
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
    
	mysqli_close($conn);
?>
