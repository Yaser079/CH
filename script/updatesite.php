<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
$img1="";
 
if(!empty($_FILES['logo']["name"]))
{
    $errors= array();
    $file_name = basename($_FILES["logo"]["name"]); 
    $file_size =$_FILES['logo']['size'];
    $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['logo']['name'])));
 

    
    if(empty($errors)==true)
    {
       move_uploaded_file($file_tmp,"../dist/img/".$file_name);
       $img1=",logo='".$file_name."' ";
    }
    
}
$img2="";
if(!empty($_FILES['fav']["name"]))
{
    $errors= array();
    $file_name = basename($_FILES["fav"]["name"]); 
    $file_size =$_FILES['fav']['size'];
    $file_tmp =$_FILES['fav']['tmp_name'];
    $file_type=$_FILES['fav']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['fav']['name'])));
 

    
    if(empty($errors)==true)
    {
       move_uploaded_file($file_tmp,"../dist/img/".$file_name);
       $img2=",fav='".$file_name."' ";
    }
    
}
$sql="update  site set 
    site='".$_POST['site']."',
    prefix='".$_POST['prefix']."',
    suffix='".$_POST['suffix']."'
    ". $img1." ".$img2."
     ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." changed the site setting.";
        create_log($_SESSION['uid'],$action);
    	 $_SESSION['response']=1;
         include 'getsite.php';
         header("Location:../Admin/site.php"); 
	}
    else
    {
        header("Location:../Admin/site.php"); 
        $_SESSION['response']=0;
    }
    
	mysqli_close($conn);
?>
