<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$img2="";
if(!empty($_FILES['img']["name"]))
{
    $errors= array();
    $file_name = basename($_FILES["img"]["name"]); 
    $file_size =$_FILES['img']['size'];
    $file_tmp =$_FILES['img']['tmp_name'];
    $file_type=$_FILES['img']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['img']['name'])));
 

    
    if(empty($errors)==true)
    {
       move_uploaded_file($file_tmp,"../dist/img/".$file_name);
       $img2=",picture='".$file_name."' ";
    }
    
}
$sql="update  users set 
    name='".$_POST['name']."',
    phone='".$_POST['phone']."' ".$img2." where ID='".$_SESSION['uid'].";' ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." updated their Profile.";
        create_log($_SESSION['uid'],$action);
    	 $_SESSION['response']=1;
        $user=getAuthUser($_SESSION['uid']);
         $_SESSION['name']=$user['name'];
         $_SESSION['picture']=$user['picture'];
         header("Location:../Admin/profile.php"); 
	}
    else
    {
        $_SESSION['response']=0;
        header("Location:../Admin/profile.php"); 
        
    }
    
	mysqli_close($conn);
?>
